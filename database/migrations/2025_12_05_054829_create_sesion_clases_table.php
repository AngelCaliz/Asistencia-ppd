<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sesion_clases', function (Blueprint $table) {
            $table->id('id_sesion');
            
            // Referencia a docentes.id_docente
            $table->unsignedBigInteger('docente_id'); // Tipo de dato de la FK
            $table->foreign('docente_id')->references('id_docente')->on('docentes')->onDelete('cascade');
            
            //  Referencia a cursos.id_curso
            $table->unsignedBigInteger('curso_id');
            $table->foreign('curso_id')->references('id_curso')->on('cursos')->onDelete('cascade');

            $table->string('codigo_sesion', 6)->unique();
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->string('aula', 20);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesion_clases');
    }
};
