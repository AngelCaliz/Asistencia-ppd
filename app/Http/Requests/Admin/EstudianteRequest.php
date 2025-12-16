<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EstudianteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Determinamos el ID del estudiante para ignorarlo en la validación de unicidad (solo si estamos en la ruta 'update')
        $estudianteId = $this->route('estudiante') ? $this->route('estudiante')->id_estudiante : null;
        $userId = $this->route('estudiante') ? $this->route('estudiante')->user->id : null;

        $rules = [
            // Validación para la tabla USERS
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($userId)],
            
            // Validación para la tabla ESTUDIANTES
            'dni' => ['required', 'string', 'size:8', Rule::unique('estudiantes', 'dni')->ignore($estudianteId, 'id_estudiante')],
            'codigo_institucional' => ['required', 'string', 'max:15', Rule::unique('estudiantes', 'codigo_institucional')->ignore($estudianteId, 'id_estudiante')],
            
            'nombres' => 'required|string|max:60',
            'apellidos' => 'required|string|max:60',
            'grupo_id' => 'required|exists:grupos,id_grupo', // Debe existir en la tabla grupos
        ];

        // Reglas específicas para la CREACIÓN (el campo 'password' es obligatorio)
        if ($this->method() == 'POST') {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        return $rules;
    }
}