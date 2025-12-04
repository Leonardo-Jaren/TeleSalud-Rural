<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\AppointmentController;

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

Route::middleware('auth')->group(function () {
    Route::get('/paciente/reservar', [AppointmentController::class, 'create'])->name('appointments.create')->middleware('role:paciente');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::post('/appointments/{id}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
});
// ----- RUTAS TEMPORALES -----
Route::view('/medico/dashboard', 'medico.dashboard');
Route::view('/medico/horarios', 'medico.horarios');
Route::view('/medico/pacientes', 'medico.pacientes');
Route::view('/medico/citas', 'medico.citas');
Route::view('/medico/perfil', 'medico.perfil');

Route::view('/admin/dashboard', 'admin.dashboard');
Route::view('/admin/usuarios', 'admin.usuarios');
