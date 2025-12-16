<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CursoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Regla para la unicidad del nombre, ignorando el curso actual si estamos editando
        $nombreRule = Rule::unique('cursos', 'nombre');
        
        // El campo 'codigo' también debe ser único
        $codigoRule = Rule::unique('cursos', 'codigo');
        
        if ($this->route('curso')) {
            // Si estamos en la ruta de edición (update), ignoramos el ID del curso que se está modificando
            $nombreRule->ignore($this->route('curso')->id_curso, 'id_curso');
            $codigoRule->ignore($this->route('curso')->id_curso, 'id_curso');
        }

        return [
            'nombre' => ['required', 'string', 'max:100', $nombreRule],
            'codigo' => ['required', 'string', 'max:15', $codigoRule], // <- Incluir la validación del código
            'descripcion' => ['nullable', 'string', 'max:500'],
            'activo' => ['required', 'boolean'],
        ];
    }
    
    public function attributes(): array
    {
        return [
            'nombre' => 'Nombre del Curso',
            'codigo' => 'Código del Curso',
            'descripcion' => 'Descripción',
            'activo' => 'Estado Activo',
        ];
    }
}