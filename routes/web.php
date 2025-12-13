<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Docente;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Estudiante;

// Ruta de bienvenida (Página pública principal)
Route::get('/', function () {
    return view('welcome');
});

// 1. RUTA DE DASHBOARD (Lógica de Redirección CU01)
// Cuando el usuario inicia sesión, es dirigido aquí. El DashboardController
// verifica el campo 'role' y redirige a la ruta específica del rol (ej. admin.panel)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified']) 
    ->name('dashboard');

// 2. RUTAS PROTEGIDAS POR ROL

// Panel del Administrador (Acceso a CU05, CU06, CU07: Gestión de usuarios y reportes)
Route::middleware(['auth', 'role:administrador'])->group(function () {
    Route::get('/admin/panel', function () {
        return view('admin.panel');
    })->name('admin.panel');
    // Aquí irán las rutas específicas del Administrador
});

// Panel del Docente (Acceso a CU02, CU03: Generación de sesiones, toma de asistencia)
Route::middleware(['auth', 'role:docente'])->group(function () {
    Route::get('/docente/panel', function () {
        return view('docente.panel');
    })->name('docente.panel');
    // Aquí irán las rutas específicas del Docente
    // Rutas para CU02: Generar Sesión de Clase
    Route::get('/docente/sesiones/create', [Docente\SesionClaseController::class, 'create'])->name('docente.sesiones.create');
    Route::post('/docente/sesiones', [Docente\SesionClaseController::class, 'store'])->name('docente.sesiones.store');
    Route::get('/docente/sesiones/{sesion}', [Docente\SesionClaseController::class, 'show'])->name('docente.sesiones.show');
});

// Panel del Estudiante (Acceso a CU04: Registro de asistencia)
Route::middleware(['auth', 'role:estudiante'])->group(function () {
    Route::get('/estudiante/panel', function () {
        return view('estudiante.panel');
    })->name('estudiante.panel');
    // Aquí irán las rutas específicas del Estudiante
    // Rutas para CU05: Registrar Asistencia
    Route::get('/estudiante/asistencia/registrar', [Estudiante\AsistenciaController::class, 'create'])->name('estudiante.asistencia.create');
    Route::post('/estudiante/asistencia', [Estudiante\AsistenciaController::class, 'store'])->name('estudiante.asistencia.store');
});


// Rutas de Perfil (Accesibles para cualquier rol)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas generadas por Breeze (login, registro, etc.)
require __DIR__.'/auth.php';