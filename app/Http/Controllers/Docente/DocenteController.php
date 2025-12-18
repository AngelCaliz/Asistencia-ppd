<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use App\Models\Asignacion;
use Illuminate\Support\Facades\Auth;

class DocenteController extends Controller
{
    public function index()
    {
        $docente = Auth::user()->docente;

        $misAsignaciones = Asignacion::with(['curso', 'grupo'])
            ->where('docente_id', $docente->id_docente)
            ->where('activo', true)
            ->get();

        return view('docente.panel', compact('misAsignaciones')); // Cambiado a docente.panel
    }
    public function showCurso($id_asignacion)
{
    // 1. Buscar la asignación con sus relaciones
    // Usamos el ID que viene de la URL
    $asignacion = Asignacion::with(['curso', 'grupo.estudiantes.user'])
        ->findOrFail($id_asignacion);

    // 2. SEGURIDAD: Verificar que esta asignación realmente le pertenezca al docente logueado
    // Esto evita que un docente vea cursos de otro cambiando el ID en la URL
    if ($asignacion->docente_id !== Auth::user()->docente->id_docente) {
        return redirect()->route('docente.panel')->with('error', 'No tienes permiso para acceder a este curso.');
    }

    // 3. Retornar la vista con los datos del curso y sus estudiantes
    return view('docente.curso_detalle', compact('asignacion'));
}
}
