<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Http\Requests\Admin\CursoRequest; // Asegúrate de que esta ruta sea correcta si moviste el Request

class CursoController extends Controller
{
    /**
     * Muestra la lista de cursos.
     */
    public function index()
    {
        $cursos = Curso::orderBy('nombre')->paginate(10);
        return view('admin.cursos.index', compact('cursos'));
    }

    /**
     * Muestra el formulario para crear un nuevo curso.
     */
    public function create()
    {
        return view('admin.cursos.create');
    }

    /**
     * Almacena un curso recién creado en la base de datos.
     */
    public function store(CursoRequest $request)
    {
        // El request.validated() usa las reglas que definimos en CursoRequest.php
        Curso::create($request->validated());

        return redirect()->route('cursos.index')
            ->with('success', 'El Curso ' . $request->nombre . ' ha sido creado exitosamente.');
    }

    /**
     * Muestra el formulario para editar el curso especificado.
     */
    public function edit(Curso $curso)
    {
        return view('admin.cursos.edit', compact('curso'));
    }

    /**
     * Actualiza el curso especificado en la base de datos.
     */
    public function update(CursoRequest $request, Curso $curso)
    {        
        $curso->update($request->validated());

        return redirect()->route('cursos.index')
            ->with('success', 'El Curso ' . $curso->nombre . ' ha sido actualizado exitosamente.');
    }

    /**
     * Elimina el curso especificado de la base de datos.
     */
    public function destroy(Curso $curso)
    {
        $nombre = $curso->nombre;
        // NOTA: Si hay sesiones o asistencias relacionadas con este curso, 
        // la base de datos debería estar configurada con ON DELETE CASCADE o 
        // deberías borrar las dependencias primero.
        $curso->delete();

        return redirect()->route('cursos.index')
            ->with('success', 'El Curso ' . $nombre . ' ha sido eliminado correctamente.');
    }
}