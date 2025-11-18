<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas por rol (mock views)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard')->middleware('role:admin');

    Route::get('/medico', function () {
        return view('medico.dashboard');
    })->name('medico.dashboard')->middleware('role:medico');

    Route::get('/paciente', function () {
        return view('paciente.dashboard');
    })->name('paciente.dashboard')->middleware('role:paciente');
});

// Ruta de ejemplo para redirección según rol al login
Route::get('/dashboard', function () {
    $user = auth()->user();
    if (! $user) {
        return redirect()->route('login');
    }

    switch ($user->role) {
        case 'admin':
            return redirect()->route('admin.dashboard');
        case 'medico':
            return redirect()->route('medico.dashboard');
        default:
            return redirect()->route('paciente.dashboard');
    }
})->middleware('auth')->name('dashboard');
