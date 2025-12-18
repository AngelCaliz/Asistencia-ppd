<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->id('id_asignacion');

            // Relaciones
            $table->unsignedBigInteger('docente_id');
            $table->foreign('docente_id')->references('id_docente')->on('docentes')->onDelete('cascade');

            $table->unsignedBigInteger('curso_id');
            $table->foreign('curso_id')->references('id_curso')->on('cursos')->onDelete('cascade');

            $table->unsignedBigInteger('grupo_id');
            $table->foreign('grupo_id')->references('id_grupo')->on('grupos')->onDelete('cascade');

            // Datos
            $table->string('periodo', 20); // Removido .placeholder
            $table->boolean('activo')->default(true);

            $table->timestamps();

            // Restricción única
            $table->unique(['docente_id', 'curso_id', 'grupo_id', 'periodo'], 'asignacion_unica');
        });
    }

    public function down(): void
    {
        // Corregido de 'asignacions' a 'asignaciones'
        Schema::dropIfExists('asignaciones');
    }
};