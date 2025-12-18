<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_curso';

    // Asegurarse de que 'codigo' esté en los fillable
    protected $fillable = [
        'nombre',
        'codigo', // <--- AGREGAR ESTA LÍNEA
        'descripcion',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];
    
    public function asignaciones() {
    return $this->hasMany(Asignacion::class, 'curso_id', 'id_curso');
}
}