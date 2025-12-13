<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Curso;

class CursosSeeder extends Seeder
{
    public function run(): void
    {
        // Cursos de ejemplo
        Curso::create(['nombre' => 'Desarrollo Web Integrado', 'codigo' => 'DWI25']);
        Curso::create(['nombre' => 'Base de Datos', 'codigo' => 'BD2025']);
        Curso::create(['nombre' => 'Análisis de Sistemas', 'codigo' => 'ADS25']);
        Curso::create(['nombre' => 'Redes y Comunicación', 'codigo' => 'RC25']);
    }
}