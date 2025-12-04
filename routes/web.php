<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\AdminController;

// ---------------- INICIO ----------------
>>>>>>> dac3fd7 (Mis cambios recientes en vistas y rutas)

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

<<<<<<< HEAD
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
=======
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');

// ------------- Rutas por Rol -------------
Route::middleware(['auth'])->group(function () {

    // DASHBOARD GENERAL
    Route::get('/dashboard', function () {
        $user = Auth::user();

        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'medico':
                return redirect()->route('medico.dashboard');
            default:
                return redirect()->route('paciente.dashboard');
        }
    })->name('dashboard');

    // ADMINISTRADOR 
    Route::prefix('admin')->middleware('role:admin')->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        // Gestión de usuarios (BD real)
        Route::get('/usuarios', [AdminController::class, 'usuarios'])
            ->name('admin.usuarios');

        Route::get('/usuarios/{id}', [AdminController::class, 'show'])
            ->name('admin.usuarios.show');

        Route::post('/usuarios/{id}/bloquear', [AdminController::class, 'bloquear'])
            ->name('admin.usuarios.bloquear');

        Route::delete('/usuarios/{id}', [AdminController::class, 'destroy'])
            ->name('admin.usuarios.destroy');
    });

    //  MÉDICO 
    Route::prefix('medico')->middleware('role:medico')->group(function () {

        Route::view('/dashboard', 'medico.dashboard')->name('medico.dashboard');
        Route::view('/horarios', 'medico.horarios');
        Route::view('/pacientes', 'medico.pacientes');
        Route::view('/citas', 'medico.citas');
        Route::view('/perfil', 'medico.perfil');

    });

    // PACIENTE
    Route::prefix('paciente')->middleware('role:paciente')->group(function () {

        Route::get('/dashboard', [PacienteController::class, 'dashboard'])
            ->name('paciente.dashboard');

        Route::get('/reservar-cita', [PacienteController::class, 'reservarCita']);
        Route::get('/historial', [PacienteController::class, 'historial']);
        Route::get('/perfil-medico', [PacienteController::class, 'perfilMedico']);
    });
});
>>>>>>> dac3fd7 (Mis cambios recientes en vistas y rutas)
