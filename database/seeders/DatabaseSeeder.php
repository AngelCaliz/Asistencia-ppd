<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // 1. Usuarios y Roles (Crea la FK para DocenteProfileSeeder)
            RoleUserSeeder::class, 
            
            // 2. Tablas Maestras (Requeridas por perfiles y sesiones)
            CursosSeeder::class, 
            GruposSeeder::class, 
            
            // 3. Perfiles (Vincula usuarios con tablas de perfil)
            DocenteProfileSeeder::class,
            
            EsudianteProfileSeeder::class,
        ]);
    }
}
