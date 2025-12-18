<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asignacion extends Model
{
    protected $table = 'asignaciones'; // Laravel por defecto buscaría 'asignacions'
    protected $primaryKey = 'id_asignacion';

    protected $fillable = [
        'docente_id',
        'curso_id',
        'grupo_id',
        'periodo',
        'activo',
    ];

    public function docente(): BelongsTo
    {
        return $this->belongsTo(Docente::class, 'docente_id', 'id_docente');
    }

    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class, 'curso_id', 'id_curso');
    }

    public function grupo(): BelongsTo
    {
        return $this->belongsTo(Grupo::class, 'grupo_id', 'id_grupo');
    }
}