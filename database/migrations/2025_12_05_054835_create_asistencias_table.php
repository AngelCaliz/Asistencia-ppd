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
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id('id_asistencia');

            // CORRECCIÓN 1: Foreign Key a la tabla 'estudiantes'
            $table->unsignedBigInteger('estudiante_id');
            $table->foreign('estudiante_id')->references('id_estudiante')->on('estudiantes')->onDelete('cascade');
            
            // CORRECCIÓN 2: Foreign Key a la tabla 'sesion_clases'
            $table->unsignedBigInteger('sesion_clase_id');
            $table->foreign('sesion_clase_id')->references('id_sesion')->on('sesion_clases')->onDelete('cascade');

            $table->dateTime('fecha_hora_registro');
            $table->string('tipo', 20); // 'Asistió', 'Tardanza', etc.
            $table->ipAddress('ip_registro')->nullable(); // Para la validación por IP del aula

            // Restricción: Un estudiante no puede tener más de una asistencia en la misma sesión de clase.
            $table->unique(['estudiante_id', 'sesion_clase_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};