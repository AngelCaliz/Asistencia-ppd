<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asignacion;
use App\Models\Docente;
use App\Models\Curso;
use App\Models\Grupo;
use Illuminate\Http\Request;

class AsignacionController extends Controller
{
    public function index()
    {
        // Traemos las asignaciones con sus relaciones para evitar el problema N+1
        $asignaciones = Asignacion::with(['docente', 'curso', 'grupo'])->paginate(10);
        return view('admin.asignaciones.index', compact('asignaciones'));
    }

    public function create()
    {
        // Necesitamos listar todos para los selects del formulario
        $docentes = Docente::all();
        $cursos = Curso::where('activo', true)->get();
        $grupos = Grupo::all();
        
        return view('admin.asignaciones.create', compact('docentes', 'cursos', 'grupos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'docente_id' => 'required|exists:docentes,id_docente',
            'curso_id'   => 'required|exists:cursos,id_curso',
            'grupo_id'   => 'required|exists:grupos,id_grupo',
            'periodo'    => 'required|string|max:20',
        ]);

        // Intentar crear la asignación
        try {
            Asignacion::create([
                'docente_id' => $request->docente_id,
                'curso_id'   => $request->curso_id,
                'grupo_id'   => $request->grupo_id,
                'periodo'    => $request->periodo,
                'activo'     => true,
            ]);

            return redirect()->route('asignaciones.index')
                ->with('success', 'Asignación creada correctamente.');

        } catch (\Illuminate\Database\QueryException $e) {
            // Manejar el error de la llave ÚNICA que definimos en la migración
            if ($e->errorInfo[1] == 1062) {
                return back()->withInput()->with('error', 'Esta asignación exacta ya existe para ese periodo.');
            }
            throw $e;
        }
    }

    public function destroy(Asignacion $asignacione) // Nota: Laravel a veces pluraliza raro, revisa con php artisan route:list
    {
        $asignacione->delete();
        return redirect()->route('asignaciones.index')->with('success', 'Asignación eliminada.');
    }
}