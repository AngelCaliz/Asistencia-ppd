<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grupo extends Model
{
    protected $primaryKey = 'id_grupo';

    protected $fillable = [
        'nombre', 'carrera',
    ];

    /**
     * Un Grupo tiene muchos Estudiantes.
     */
    public function estudiantes(): HasMany
    {
        return $this->hasMany(Estudiante::class, 'grupo_id', 'id_grupo');
    }
}