<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Docente;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Estudiante;
use App\Http\Controllers\Admin\AsignacionController;
use App\Http\Controllers\Admin\ReporteController;
use App\Http\Controllers\Docente\DocenteController;


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
    Route::resource('asignaciones', AsignacionController::class);

    Route::get('/admin/reportes', [ReporteController::class, 'index'])->name('admin.reportes.index');
    Route::post('/admin/reportes/pdf', [ReporteController::class, 'generarPdf'])->name('admin.reportes.pdf');
});

// Panel del Docente (Acceso a CU02, CU03: Generación de sesiones, toma de asistencia)
Route::middleware(['auth', 'role:docente'])->group(function () {

    Route::get('/docente/panel', [DocenteController::class, 'index'])->name('docente.panel');
    
    // Aquí irán las rutas específicas del Docente

    // Rutas para CU02: Generar Sesión de Clase
    Route::get('/docente/sesiones/create', [Docente\SesionClaseController::class, 'create'])->name('docente.sesiones.create');
    Route::post('/docente/sesiones', [Docente\SesionClaseController::class, 'store'])->name('docente.sesiones.store');
    Route::get('/docente/sesiones/{sesion}', [Docente\SesionClaseController::class, 'show'])->name('docente.sesiones.show');

    // RUTAS NUEVAS PARA CU03: Monitorear Asistencia
    Route::get('/docente/sesiones', [Docente\SesionClaseController::class, 'index'])->name('docente.sesiones.index');
    Route::get('/docente/sesiones/{sesion}/monitor', [Docente\SesionClaseController::class, 'monitor'])->name('docente.sesiones.monitor');

    Route::get('/docente/dashboard', [DocenteController::class, 'index'])->name('docente.dashboard');
    Route::get('/docente/curso/{id_asignacion}', [DocenteController::class, 'showCurso'])->name('docente.curso');
});

// Panel del Estudiante (Acceso a CU04: Registro de asistencia)
Route::middleware(['auth', 'role:estudiante'])->group(function () {
    Route::get('/estudiante/panel', [App\Http\Controllers\Estudiante\AsistenciaController::class, 'index'])->name('estudiante.panel');

    // Aquí irán las rutas específicas del Estudiante
    
    // Rutas para CU05: Registrar Asistencia
    Route::get('/estudiante/asistencia/registrar', [Estudiante\AsistenciaController::class, 'create'])->name('estudiante.asistencia.create');
    Route::post('/estudiante/asistencia', [Estudiante\AsistenciaController::class, 'store'])->name('estudiante.asistencia.store');
    // Nueva ruta para ver el historial completo si fuera necesario (opcional)
    Route::get('/estudiante/historial', [Estudiante\AsistenciaController::class, 'historial'])->name('estudiante.historial');
});

// Panel del Administrador (CU06/CU07)
Route::middleware(['auth', 'role:administrador'])->group(function () {
    
    // Panel principal del administrador
    Route::get('/admin/panel', [Admin\AdminController::class, 'panel'])->name('admin.panel');
    
    // Aquí irán rutas futuras de gestión (ej: /admin/docentes, /admin/cursos)

    // Gestión de Docentes (CRUD - CU07)
    Route::resource('admin/docentes', Admin\DocenteController::class);

    // Gestión de Cursos (NUEVO)
    Route::resource('cursos', App\Http\Controllers\Admin\CursoController::class)->names('cursos');

    // Gestión de Grupos (NUEVO)
    Route::resource('grupos', App\Http\Controllers\Admin\GrupoController::class)->names('grupos');

    // Gestión de Estudiantes (NUEVO)
    Route::resource('estudiantes', App\Http\Controllers\Admin\EstudianteController::class)->names('estudiantes');
});

// Rutas de Perfil (Accesibles para cualquier rol)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas generadas por Breeze (login, registro, etc.)
require __DIR__.'/auth.php';