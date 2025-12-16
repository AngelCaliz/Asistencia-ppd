<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DocenteRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     */
    public function authorize(): bool
    {
        return true; // Permitimos el acceso ya que está bajo el middleware 'role:administrador'
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     */
    public function rules(): array
    {
        // 1. Determinar IDs para ignorar en la validación de unicidad (solo si estamos editando)
        $docenteId = $this->route('docente') ? $this->route('docente')->id_docente : null;
        $userId = $this->route('docente') ? $this->route('docente')->user->id : null;

        $rules = [
            // Reglas para la tabla USERS
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($userId)],
            
            // Reglas para la tabla DOCENTES
            'nombres' => 'required|string|max:60',
            'apellidos' => 'required|string|max:60',
            'dni' => ['required', 'string', 'size:8', Rule::unique('docentes', 'dni')->ignore($docenteId, 'id_docente')],
        ];

        // 2. Reglas de Contraseña (Diferentes para CREAR y ACTUALIZAR)
        
        if ($this->method() == 'POST') {
            // CREACIÓN: Contraseña es obligatoria
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        if ($this->method() == 'PUT') {
            // ACTUALIZACIÓN: Contraseña es opcional, pero si se envía, debe ser validada
            $rules['password'] = 'nullable|string|min:8|confirmed';
        }

        return $rules;
    }
    
    /**
     * Personaliza los atributos de validación.
     */
    public function attributes(): array
    {
        return [
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'dni' => 'DNI',
            'email' => 'Email de Acceso',
            'password' => 'Contraseña',
        ];
    }
}