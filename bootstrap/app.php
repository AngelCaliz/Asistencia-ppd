<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckUserRole::class,
        ]);

        // 2. CONFIGURAR GRUPOS WEB/API (Opcional, si quieres añadirlo a grupos)
        $middleware->web(append: [
            // Aquí se pueden añadir Middlewares que van a todas las rutas web
        ]);

        $middleware->api(prepend: [
            // Aquí se pueden añadir Middlewares que van a todas las rutas API
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
