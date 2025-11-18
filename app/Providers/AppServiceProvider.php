<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Registrar alias de middleware de roles para usar en rutas
        if ($this->app->runningInConsole() === false) {
            $router = $this->app->make('router');
            // aliasMiddleware está disponible en el router
            if (method_exists($router, 'aliasMiddleware')) {
                $router->aliasMiddleware('role', \App\Http\Middleware\RoleMiddleware::class);
            }
        }
    }
}
