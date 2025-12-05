<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curso extends Model
{
    protected $primaryKey = 'id_curso';

    protected $fillable = [
        'nombre', 'codigo',
    ];

    /**
     * Un Curso tiene muchas Sesiones de Clase.
     */
    public function sesionesClase(): HasMany
    {
        // Se usa el tercer parámetro 'id_curso' para la PK personalizada
        return $this->hasMany(SesionClase::class, 'curso_id', 'id_curso');
    }
}