<?php

namespace App\Http\Controllers\Estudiante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SesionClase;
use App\Models\Asistencia;
use Carbon\Carbon;

class AsistenciaController extends Controller
{
    /**
     * Muestra el formulario para ingresar el código de sesión.
     */
    public function create()
    {
        return view('estudiante.asistencia.create');
    }

    /**
     * Procesa el registro de asistencia con el código de sesión.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo_sesion' => 'required|string|size:6',
        ]);

        $codigo = strtoupper($request->codigo_sesion);
        $currentTime = Carbon::now();
        $user = Auth::user();

        // 1. Buscar la sesión por el código
        $sesion = SesionClase::where('codigo_sesion', $codigo)->first();

        if (!$sesion) {
            return back()->withErrors(['codigo_sesion' => 'Código de sesión no válido.'])->withInput();
        }

        // 2. Validar que la sesión esté activa (fecha_inicio <= ahora <= fecha_fin)
        if ($currentTime->isBefore($sesion->fecha_inicio)) {
            return back()->withErrors(['codigo_sesion' => 'La sesión aún no ha iniciado.'])->withInput();
        }

        if ($currentTime->isAfter($sesion->fecha_fin)) {
            return back()->withErrors(['codigo_sesion' => 'La sesión ha finalizado.'])->withInput();
        }

        // 3. Obtener el ID del Estudiante asociado al usuario
        $estudianteId = $user->estudiante->id_estudiante;

        // 4. Verificar si ya existe un registro para esta sesión
        $asistenciaExistente = Asistencia::where('estudiante_id', $estudianteId)
            ->where('sesion_clase_id', $sesion->id_sesion)
            ->exists();

        if ($asistenciaExistente) {
            return back()->with('error', '¡Ya registraste tu asistencia para esta sesión!');
        }

        // 5. Determinar el tipo de asistencia (Asistió o Tardanza)
        $tipoAsistencia = ($currentTime->diffInMinutes($sesion->fecha_inicio) <= 15) // Ejemplo: 15 minutos de tolerancia
            ? 'Asistió'
            : 'Tardanza';

        // 6. Registrar la Asistencia
        Asistencia::create([
            'estudiante_id' => $estudianteId,
            'sesion_clase_id' => $sesion->id_sesion,
            'fecha_hora_registro' => $currentTime,
            'tipo' => $tipoAsistencia,
            'ip_registro' => $request->ip(), // Para validación futura
        ]);

        return redirect()->route('estudiante.panel')->with('success', '¡Asistencia registrada como: ' . $tipoAsistencia . '!');
    }

    // Añade este método al final de la clase
    public function index()
    {
        $estudianteId = Auth::user()->estudiante->id_estudiante;

        // Obtenemos las asistencias con la sesión y el curso relacionado
        $asistencias = Asistencia::with(['sesionClase.asignacion.curso'])
            ->where('estudiante_id', $estudianteId)
            ->orderBy('fecha_hora_registro', 'desc')
            ->take(5) // Mostramos las últimas 5 en el panel
            ->get();

        return view('estudiante.panel', compact('asistencias'));
    }
}
