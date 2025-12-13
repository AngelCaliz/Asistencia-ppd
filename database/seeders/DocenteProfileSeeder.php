<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Docente;

class DocenteProfileSeeder extends Seeder
{
    public function run(): void
    {
        // Buscar el usuario con rol 'docente' creado previamente
        $userDocente = User::where('email', 'docente@pedropdiaz.edu.pe')->first();

        if ($userDocente) {
            Docente::create([
                'user_id' => $userDocente->id,
                'dni' => '45678912',
                'nombres' => 'Juan Carlos',
                'apellidos' => 'Paredes Quispe',
            ]);
        }
        
        //agregar más docentes por aqui :v
    }
}