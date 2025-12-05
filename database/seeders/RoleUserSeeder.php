<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleUserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Administrador de Prueba
        User::create([
            'name' => 'Admin PPD', // <-- CAMPO REQUERIDO
            'email' => 'admin@pedropdiaz.edu.pe',
            'password' => Hash::make('password'),
            'role' => 'administrador',
        ]);

        // 2. Docente de Prueba
        User::create([
            'name' => 'Docente PPD', // <-- CAMPO REQUERIDO
            'email' => 'docente@pedropdiaz.edu.pe',
            'password' => Hash::make('password'),
            'role' => 'docente',
        ]);

        // 3. Estudiante de Prueba
        User::create([
            'name' => 'Estudiante PPD', // <-- CAMPO REQUERIDO
            'email' => 'estudiante@pedropdiaz.edu.pe',
            'password' => Hash::make('password'),
            'role' => 'estudiante',
        ]);
    }
}