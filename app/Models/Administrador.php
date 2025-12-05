<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Administrador extends Model
{
    // Si usas una tabla 'administradors' separada
    protected $table = 'administradores'; 
    protected $primaryKey = 'id_administrador'; // Asumiendo que tu PK se llama así

    protected $fillable = [
        'user_id', 'nombres', 'apellidos', 'puesto', // u otros campos específicos
    ];

    /**
     * Un Administrador pertenece a un User (para el login y autenticación).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}