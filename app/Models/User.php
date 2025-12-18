<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne; // Importamos HasOne

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Asegúrate de incluir 'role' si lo añadiste a la migración de users
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // RELACIONES

    /**
     * Un User tiene un perfil de Docente.
     */
    public function docente(): HasOne
    {
        return $this->hasOne(Docente::class, 'user_id');
    }

    /**
     * Un User tiene un perfil de Estudiante.
     */
    public function estudiante(): HasOne
    {
        return $this->hasOne(Estudiante::class);
    }
}