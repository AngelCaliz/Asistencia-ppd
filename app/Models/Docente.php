<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Docente extends Model
{
    protected $primaryKey = 'id_docente';

    protected $fillable = [
        'user_id', 'dni', 'nombres', 'apellidos',
    ];

    /**
     * Un Docente pertenece a un User (para el login).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Un Docente dicta muchas Sesiones de Clase.
     */
    public function sesionesClase(): HasMany
    {
        // Se usa el tercer parámetro 'id_docente' para la PK personalizada
        return $this->hasMany(SesionClase::class, 'docente_id', 'id_docente');
    }
    public function asignaciones() {
    return $this->hasMany(Asignacion::class, 'docente_id', 'id_docente');
}
}