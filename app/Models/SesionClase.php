<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SesionClase extends Model
{
    protected $primaryKey = 'id_sesion';

    protected $fillable = [
        'docente_id', 'curso_id', 'codigo_sesion', 'fecha_inicio', 'fecha_fin', 'aula',
    ];

    /**
     * La Sesión pertenece a un Docente.
     */
    public function docente(): BelongsTo
    {
        return $this->belongsTo(Docente::class, 'docente_id', 'id_docente');
    }

    /**
     * La Sesión pertenece a un Curso.
     */
    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class, 'curso_id', 'id_curso');
    }

    /**
     * La Sesión tiene muchos registros de Asistencia.
     */
    public function asistencias(): HasMany
    {
        // Se usa el tercer parámetro 'id_sesion' para la PK personalizada
        return $this->hasMany(Asistencia::class, 'sesion_clase_id', 'id_sesion');
    }
}