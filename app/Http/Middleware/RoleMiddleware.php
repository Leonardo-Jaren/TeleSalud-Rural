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
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Usage in routes: ->middleware('role:admin') or ->middleware('role:medico|admin')
     */
    public function handle(Request $request, Closure $next, $roles = null)
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if (! $roles) {
            return $next($request);
        }

        $allowed = explode('|', $roles);

        if ($user->hasRole(...$allowed)) {
            return $next($request);
        }

        // unauthorized - you can change to abort(403) if preferred
        return redirect()->route('home')->with('error', 'Acceso denegado por rol.');
    }
}
