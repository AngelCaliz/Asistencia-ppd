<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\Docente;
use App\Models\Estudiante;
use App\Models\SesionClase;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Muestra el panel de control del Administrador con estadísticas clave.
     */
    public function panel()
    {
        // Obtener estadísticas para el dashboard
        $totalCursos = Curso::count();
        $totalDocentes = Docente::count();
        $totalEstudiantes = Estudiante::count();
        $totalSesiones = SesionClase::count();

        // Puedes añadir más lógica aquí para mostrar la asistencia general, etc.

        return view('admin.panel', compact(
            'totalCursos', 
            'totalDocentes', 
            'totalEstudiantes', 
            'totalSesiones'
        ));
    }
}