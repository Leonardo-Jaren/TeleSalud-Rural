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
        return redirect()->route('dashboard')->with('error', 'Acceso denegado por rol.');
    }
}
