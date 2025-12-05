<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user) {
            switch ($user->role) {
                case 'administrador':
                    return redirect()->route('admin.panel');
                case 'docente':
                    return redirect()->route('docente.panel');
                case 'estudiante':
                    return redirect()->route('estudiante.panel');
                default:
                    // Si el rol no es válido
                    Auth::logout();
                    return redirect('/login');
            }
        }
        
        // Si por alguna razón llega aquí sin usuario, redirige al login
        return redirect('/login');
    }
}