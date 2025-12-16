<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Curso;
use App\Models\SesionClase;
use Illuminate\Support\Str;

class SesionClaseController extends Controller
{
    /**
     * Muestra el formulario para crear una nueva sesión de clase.
     */
    public function create()
    {
        // Obtener el ID del Docente autenticado
        $docenteId = Auth::user()->docente->id_docente;

        // Obtener solo los cursos asociados a este docente (Implementación futura)
        // Por ahora, listamos todos los cursos para simplificar el formulario.
        $cursos = Curso::all(); 

        return view('docente.sesiones.create', compact('cursos'));
    }

    /**
     * Almacena una nueva sesión de clase en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id_curso',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'aula' => 'required|string|max:20',
        ]);

        // 1. Obtener el ID del Docente autenticado
        $docenteId = Auth::user()->docente->id_docente;
        
        // 2. Generar código único (ej: 6 caracteres alfanuméricos)
        $codigoSesion = strtoupper(Str::random(6));

        // 3. Crear la Sesión de Clase
        $sesion = SesionClase::create([
            'docente_id' => $docenteId,
            'curso_id' => $request->curso_id,
            'codigo_sesion' => $codigoSesion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'aula' => $request->aula,
        ]);

        // Redirigir al Docente a la vista de detalle con el código generado
        return redirect()->route('docente.sesiones.show', $sesion->id_sesion)
                         ->with('success', 'Sesión de clase creada exitosamente. Código: ' . $codigoSesion);
    }
    
    /**
     * Muestra el detalle de la sesión creada (incluyendo el código).
     */
    public function show(SesionClase $sesion)
    {
        // Asegúrate de que solo el docente que la creó pueda verla
        if ($sesion->docente_id !== Auth::user()->docente->id_docente) {
             abort(403, 'Acceso no autorizado.');
        }

        return view('docente.sesiones.show', compact('sesion'));
    }
    
    /**
     * Muestra la lista de todas las sesiones creadas por el docente autenticado.
     */
    public function index()
    {
        // 1. Obtener el ID del Docente autenticado
        $docenteId = Auth::user()->docente->id_docente;

        // 2. Obtener las sesiones del docente, ordenadas por más recientes
        $sesiones = SesionClase::where('docente_id', $docenteId)
                               ->orderBy('fecha_inicio', 'desc')
                               ->get();

        return view('docente.sesiones.index', compact('sesiones'));
    }
    
    /**
     * Muestra la lista de asistencia de una sesión específica (CU03).
     */

    public function monitor(SesionClase $sesion)
    {
        // 1. Verificar autorización: Solo el docente creador puede monitorear
        if ($sesion->docente_id !== Auth::user()->docente->id_docente) {
             abort(403, 'Acceso no autorizado.');
        }

        // 2. Cargar las asistencias y los detalles del estudiante.
        // Asistencia pertenece a Estudiante, SesionClase pertenece a Curso
        $asistencias = $sesion->asistencias()->with('estudiante.grupo')->get();

        // 3. Devolver la vista de monitoreo
        return view('docente.sesiones.monitor', compact('sesion', 'asistencias'));
    }
}