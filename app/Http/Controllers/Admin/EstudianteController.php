<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Estudiante;
use App\Models\Grupo;
use App\Models\User;
use App\Http\Requests\Admin\EstudianteRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource (R - Index).
     */
    public function index()
    {
        // Precargar user y grupo para evitar la consulta N+1
        $estudiantes = Estudiante::with(['user', 'grupo'])->paginate(10);
        return view('admin.estudiantes.index', compact('estudiantes'));
    }

    /**
     * Show the form for creating a new resource (C - Create Form).
     */
    public function create()
    {
        $grupos = Grupo::select('id_grupo', 'carrera', 'nombre')->orderBy('carrera')->get();
        return view('admin.estudiantes.create', compact('grupos'));
    }

    /**
     * Store a newly created resource in storage (C - Store Logic).
     */
    public function store(EstudianteRequest $request)
    {
        $validatedData = $request->validated();
        
        // 1. Crear el registro en la tabla users
        $user = User::create([
            'name' => $validatedData['nombres'] . ' ' . $validatedData['apellidos'], // <--- ¡ASEGÚRATE DE QUE ESTA LÍNEA EXISTA!
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'estudiante',
        ]);

        // 2. Crear el registro en la tabla estudiantes (perfil)
        Estudiante::create([
            'user_id' => $user->id,
            'grupo_id' => $validatedData['grupo_id'],
            'dni' => $validatedData['dni'],
            'nombres' => $validatedData['nombres'],
            'apellidos' => $validatedData['apellidos'],
            'codigo_institucional' => $validatedData['codigo_institucional'],
        ]);

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante registrado exitosamente.');
    }
    
    /**
     * Show the form for editing the specified resource (U - Edit Form).
     */
    public function edit(Estudiante $estudiante)
    {
        $grupos = Grupo::select('id_grupo', 'carrera', 'nombre')->orderBy('carrera')->get();
        // Carga la relación 'user' si no está cargada
        $estudiante->load('user'); 
        
        return view('admin.estudiantes.edit', compact('estudiante', 'grupos'));
    }
    
    /**
     * Update the specified resource in storage (U - Update Logic).
     */
    public function update(EstudianteRequest $request, Estudiante $estudiante)
    {
        $validatedData = $request->validated();
        
        // 1. Actualizar la tabla users
        $estudiante->user->update([
            'name' => $validatedData['nombres'] . ' ' . $validatedData['apellidos'],
            'email' => $validatedData['email'],
            // Si se proporciona una nueva contraseña, la actualizamos
            'password' => $request->password ? Hash::make($request->password) : $estudiante->user->password,
        ]);

        // 2. Actualizar la tabla estudiantes (perfil)
        $estudiante->update($validatedData);

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage (D - Delete Logic).
     */
    public function destroy(Estudiante $estudiante)
    {
        // La restricción de FK en la migración de 'estudiantes' (onDelete('cascade'))
        // borrará al estudiante cuando borremos al usuario.
        
        $estudiante->user->delete();

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante eliminado exitosamente.');
    }
}