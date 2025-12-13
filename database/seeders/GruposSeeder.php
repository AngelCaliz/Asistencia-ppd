<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grupo;

class GruposSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Contabilidad (Semestre III)
        Grupo::create(['nombre' => 'CONT-III-A', 'carrera' => 'Contabilidad']);
        
        // 2. Desarrollo de Sistemas de Información (Semestre IV)
        Grupo::create(['nombre' => 'DSI-IV-B', 'carrera' => 'Desarrollo de Sistemas de Información']);
        
        // 3. Mecánica Industrial (Semestre V)
        Grupo::create(['nombre' => 'MI-V-A', 'carrera' => 'Mecánica Industrial']);
        
        // 4. Otro ejemplo: DSI Semestre I
        Grupo::create(['nombre' => 'DSI-I-A', 'carrera' => 'Desarrollo de Sistemas de Información']);
    }
}