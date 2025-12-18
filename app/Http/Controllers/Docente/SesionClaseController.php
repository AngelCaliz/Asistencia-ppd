<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Curso;
use App\Models\Asignacion;
use App\Models\SesionClase;
use Illuminate\Support\Str;


class SesionClaseController extends Controller
{
    /**
     * Muestra el formulario para crear una nueva sesión de clase.
     */
    public function create(Request $request)
    {
        $docente = Auth::user()->docente;

        // 1. Capturamos si viene un ID de asignación por la URL
        $asignacionId = $request->query('asignacion');

        // 2. Obtenemos las asignaciones del docente para el select
        $misAsignaciones = Asignacion::with(['curso', 'grupo'])
            ->where('docente_id', $docente->id_docente)
            ->where('activo', true)
            ->get();

        // 3. Si no tiene asignaciones, algo anda mal
        if ($misAsignaciones->isEmpty()) {
            return redirect()->route('docente.panel')->with('error', 'No tienes cursos asignados para iniciar sesiones.');
        }

        return view('docente.sesiones.create', compact('misAsignaciones', 'asignacionId'));
    }

    /**
     * Almacena una nueva sesión de clase en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'asignacion_id' => 'required|exists:asignaciones,id_asignacion',
            'fecha_inicio'  => 'required|date',
            'fecha_fin'     => 'required|date|after:fecha_inicio',
            'aula'          => 'required|string|max:20',
        ]);

        // 1. Obtener la asignación para sacar el curso_id
        $asignacion = Asignacion::findOrFail($request->asignacion_id);

        // 2. Seguridad: Verificar que la asignación sea del docente logueado
        if ($asignacion->docente_id !== Auth::user()->docente->id_docente) {
            abort(403, 'No tienes permiso para crear sesiones en este curso.');
        }

        // 3. Generar código único de 6 caracteres
        $codigoSesion = strtoupper(Str::random(6));

        // 4. Crear la Sesión de Clase
        $sesion = SesionClase::create([
            'docente_id'    => Auth::user()->docente->id_docente,
            'asignacion_id' => $asignacion->id_asignacion, // Importante para saber qué grupo es
            'curso_id'      => $asignacion->curso_id,      // Mantenemos tu estructura original
            'codigo_sesion' => $codigoSesion,
            'fecha_inicio'  => $request->fecha_inicio,
            'fecha_fin'     => $request->fecha_fin,
            'aula'          => $request->aula,
            'estado'        => 'abierta',
        ]);

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
