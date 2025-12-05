<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asistencia extends Model
{
    protected $primaryKey = 'id_asistencia';

    protected $fillable = [
        'estudiante_id', 'sesion_clase_id', 'fecha_hora_registro', 'tipo', 'ip_registro',
    ];

    /**
     * Una Asistencia pertenece a un Estudiante.
     */
    public function estudiante(): BelongsTo
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id', 'id_estudiante');
    }

    /**
     * Una Asistencia pertenece a una Sesión de Clase.
     */
    public function sesionClase(): BelongsTo
    {
        return $this->belongsTo(SesionClase::class, 'sesion_clase_id', 'id_sesion');
    }
}