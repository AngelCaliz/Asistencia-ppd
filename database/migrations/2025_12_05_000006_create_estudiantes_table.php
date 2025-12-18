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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id('id_estudiante');

            // Foreign Key a 'users' (usa el nombre por defecto 'id', así que 'foreignId' es válido aquí)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->unique();

            //  Referencia a grupos.id_grupo
            $table->unsignedBigInteger('grupo_id');
            $table->foreign('grupo_id')->references('id_grupo')->on('grupos')->onDelete('restrict');

            $table->string('dni', 8)->unique();
            $table->string('nombres', 60);
            $table->string('apellidos', 60);
            $table->string('codigo_institucional', 15)->unique();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
