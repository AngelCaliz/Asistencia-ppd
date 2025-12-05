<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Verificar si el usuario está autenticado
        if (! $request->user()) {
            return redirect('/login'); 
        }

        // Comprobar si el rol del usuario coincide con el rol requerido
        if ($request->user()->role === $role) {
            return $next($request);
        }

        // Si el rol no coincide, redirigir a un lugar seguro (ej. el dashboard general)
        return redirect('/dashboard')->withErrors('Acceso denegado. No tienes el rol necesario para esta área.');
    }
}