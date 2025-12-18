<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('docentes', function (Blueprint $table) {
            $table->id('id_docente');
            
            // FK a la tabla 'users' para la autenticación (usa la PK por defecto 'id').
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->unique();

            $table->string('dni', 8)->unique();
            $table->string('nombres', 60);
            $table->string('apellidos', 60);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('docentes');
    }
};