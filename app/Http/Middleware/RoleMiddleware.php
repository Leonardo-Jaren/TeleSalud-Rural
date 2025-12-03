<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles  Roles permitidos (admin, medico, paciente)
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Verificar que el usuario esté autenticado
        if (!$request->user()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión.');
        }

        // Verificar que el usuario tenga uno de los roles permitidos
        if (!in_array($request->user()->rol, $roles)) {
            abort(403, 'No tienes permiso para acceder a esta sección.');
        }

        return $next($request);
    }
}
