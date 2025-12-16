<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GrupoController extends Controller
{
    /**
     * Muestra la lista de grupos.
     */
    public function index()
    {
        $grupos = Grupo::orderBy('carrera')->orderBy('nombre')->paginate(10);
        return view('admin.grupos.index', compact('grupos'));
    }

    /**
     * Muestra el formulario para crear un nuevo grupo.
     */
    public function create()
    {
        return view('admin.grupos.create');
    }

    /**
     * Almacena un grupo recién creado.
     */
    public function store(Request $request)
    {
        $request->validate([
            // La combinación de nombre (Sección) y carrera debe ser única
            'nombre' => ['required', 'string', 'max:50', 
                         Rule::unique('grupos')->where(fn ($query) => $query->where('carrera', $request->carrera))],
            'carrera' => 'required|string|max:100',
        ]);

        Grupo::create($request->all());

        return redirect()->route('grupos.index')
            ->with('success', 'El Grupo (' . $request->nombre . ' - ' . $request->carrera . ') ha sido creado exitosamente.');
    }

    /**
     * Muestra el formulario para editar el grupo.
     */
    public function edit(Grupo $grupo)
    {
        return view('admin.grupos.edit', compact('grupo'));
    }

    /**
     * Actualiza el grupo especificado.
     */
    public function update(Request $request, Grupo $grupo)
    {
        $request->validate([
            // La validación de unicidad debe ignorar el grupo actual
            'nombre' => ['required', 'string', 'max:50', 
                         Rule::unique('grupos')->where(fn ($query) => $query->where('carrera', $request->carrera))->ignore($grupo->id_grupo, 'id_grupo')],
            'carrera' => 'required|string|max:100',
        ]);

        $grupo->update($request->all());

        return redirect()->route('grupos.index')
            ->with('success', 'El Grupo ha sido actualizado exitosamente.');
    }

    /**
     * Elimina el grupo especificado.
     */
    public function destroy(Grupo $grupo)
{
    // Verificar si el grupo tiene estudiantes asociados
    // (Asumimos que la relación 'estudiantes' existe en el modelo Grupo)
    if ($grupo->estudiantes()->count() > 0) {
        $nombre = $grupo->nombre . ' - ' . $grupo->carrera;
        
        // Devolver un error si hay dependencias
        return redirect()->route('grupos.index')
            ->with('error', 'No se puede eliminar el grupo "' . $nombre . '" porque tiene estudiantes vinculados. Reasigne o elimine a los estudiantes primero.');
    }
    
    // Si no hay estudiantes, proceder con la eliminación
    $nombre = $grupo->nombre . ' - ' . $grupo->carrera;
    $grupo->delete();

    return redirect()->route('grupos.index')
        ->with('success', 'El Grupo ' . $nombre . ' ha sido eliminado correctamente.');
}
}