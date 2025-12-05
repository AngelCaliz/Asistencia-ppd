<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estudiante extends Model
{
    protected $primaryKey = 'id_estudiante';

    protected $fillable = [
        'user_id', 'grupo_id', 'dni', 'nombres', 'apellidos', 'codigo_institucional',
    ];

    /**
     * Un Estudiante pertenece a un User (para el login).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Un Estudiante pertenece a un Grupo.
     */
    public function grupo(): BelongsTo
    {
        return $this->belongsTo(Grupo::class, 'grupo_id', 'id_grupo');
    }

    /**
     * Un Estudiante tiene muchos registros de Asistencia.
     */
    public function asistencias(): HasMany
    {
        // Se usa el tercer parámetro 'id_estudiante' para la PK personalizada
        return $this->hasMany(Asistencia::class, 'estudiante_id', 'id_estudiante');
    }
}