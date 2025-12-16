<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Docente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Http\Requests\Admin\DocenteRequest;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource (R - Read/Index).
     */
    public function index()
    {
        // Trae todos los docentes y precarga la información de su usuario
        $docentes = Docente::with('user')->get();
        return view('admin.docentes.index', compact('docentes'));
    }

    /**
     * Show the form for creating a new resource (C - Create Form).
     */
    public function create()
    {
        return view('admin.docentes.create');
    }

    /**
     * Store a newly created resource in storage (C - Store Logic).
     */
    public function store(DocenteRequest $request) // <-- CAMBIAR de Request a DocenteRequest
{
    $validatedData = $request->validated(); // Usar datos validados del FormRequest

    // 1. Crear el registro en la tabla users
    $user = User::create([
        // Usar nombres y apellidos para construir el 'name' de users
        'name' => $validatedData['nombres'] . ' ' . $validatedData['apellidos'], 
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'role' => 'docente',
    ]);

    // 2. Crear el registro en la tabla docentes (perfil)
    Docente::create([
        'user_id' => $user->id,
        'dni' => $validatedData['dni'],
        'nombres' => $validatedData['nombres'],
        'apellidos' => $validatedData['apellidos'],
    ]);

    return redirect()->route('docentes.index')->with('success', 'Docente registrado exitosamente.');
}
    
    // ... Métodos show, edit, update, destroy se implementan de forma similar usando la doble capa.
    
    public function show(Docente $docente)
    {
        return view('admin.docentes.show', compact('docente'));
    }
    
    /**
     * Show the form for editing the specified resource (U - Edit Form).
     */
    public function edit(Docente $docente)
    {
        return view('admin.docentes.edit', compact('docente'));
    }
    
    /**
     * Update the specified resource in storage (U - Update Logic).
     */
    public function update(DocenteRequest $request, Docente $docente) // <-- CAMBIAR de Request a DocenteRequest
{
    $validatedData = $request->validated(); // Usar datos validados del FormRequest

    // 1. Actualizar la tabla users
    $docente->user->update([
        // Usar nombres y apellidos para construir el 'name' de users
        'name' => $validatedData['nombres'] . ' ' . $validatedData['apellidos'], 
        'email' => $validatedData['email'],
        // La contraseña solo se actualiza si se proporciona una nueva
        'password' => $validatedData['password'] ? Hash::make($validatedData['password']) : $docente->user->password,
    ]);

    // 2. Actualizar la tabla docentes (perfil)
    // El 'update' toma automáticamente solo los campos que están en $fillable
    $docente->update($validatedData); 

    return redirect()->route('docentes.index')->with('success', 'Docente actualizado exitosamente.');
}

    /**
     * Remove the specified resource from storage (D - Delete Logic).
     */
    public function destroy(Docente $docente)
    {
        // Laravel, gracias a la relación `foreignId('user_id')->constrained('users')->onDelete('cascade')`
        // en la migración de 'docentes', al borrar el User, se borrará automáticamente el Docente.
        
        $docente->user->delete(); // Esto elimina el registro en 'users' y en 'docentes'

        return redirect()->route('docentes.index')->with('success', 'Docente eliminado exitosamente.');
    }
}