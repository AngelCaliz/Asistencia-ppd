<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Estudiante;
use App\Models\Grupo; // Necesario para obtener un grupo

class EstudianteProfileSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buscar el usuario con rol 'estudiante'
        $userEstudiante = User::where('email', 'estudiante@pedropdiaz.edu.pe')->first();
        
        // 2. Obtener un grupo de prueba (ej: el primer grupo creado)
        $grupoDSI = Grupo::where('nombre', 'DSI-I-A')->first() ?? Grupo::first();

        if ($userEstudiante && $grupoDSI) {
            Estudiante::create([
                'user_id' => $userEstudiante->id,
                'grupo_id' => $grupoDSI->id_grupo, // Usamos el ID del grupo
                'dni' => '98765432',
                'nombres' => 'María Del Mar',
                'apellidos' => 'Quispe Huamán',
                'codigo_institucional' => 'E1002025001',
            ]);
        }
        
        // ¡Importante! Si no creaste el grupo 'DSI-I-A' en el seeder anterior,
        // asegúrate de que Grupo::first() te devuelva algo.
    }
}