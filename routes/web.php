<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\MedicoControlador;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ------------- Rutas por Rol -------------
Route::middleware(['auth'])->group(function () {

    // DASHBOARD GENERAL
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        switch ($user->rol) {
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
        Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('admin.usuarios');
        Route::get('/usuarios/{id}', [AdminController::class, 'show'])->name('admin.usuarios.show');
        Route::post('/usuarios/{id}/bloquear', [AdminController::class, 'bloquear'])->name('admin.usuarios.bloquear');
        Route::delete('/usuarios/{id}', [AdminController::class, 'destroy'])->name('admin.usuarios.destroy');
    });

    // MÉDICO 
    Route::prefix('medico')->middleware('role:medico')->group(function () {
        Route::view('/dashboard', 'medico.dashboard')->name('medico.dashboard');
        Route::view('/horarios', 'medico.horarios');
        Route::view('/pacientes', 'medico.pacientes');
        Route::view('/citas', 'medico.citas');
        
        // Rutas de perfil y horarios con controlador
        Route::get('/perfil', [MedicoControlador::class, 'editarPerfil'])->name('medico.perfil');
        Route::post('/perfil', [MedicoControlador::class, 'actualizarPerfil'])->name('medico.perfil.actualizar');
        Route::get('/horarios', [MedicoControlador::class, 'gestionarHorarios'])->name('medico.horarios');
        Route::post('/horarios', [MedicoControlador::class, 'guardarHorario'])->name('medico.horarios.guardar');
        Route::delete('/horarios/{id}', [MedicoControlador::class, 'eliminarHorario'])->name('medico.horarios.eliminar');
    });

    // PACIENTE
    Route::prefix('paciente')->middleware('role:paciente')->group(function () {
        Route::get('/dashboard', [PacienteController::class, 'dashboard'])->name('paciente.dashboard');
        Route::get('/reservar-cita', [PacienteController::class, 'reservarCita'])->name('paciente.reservar-cita');
        Route::get('/historial', [PacienteController::class, 'historial'])->name('paciente.historial');
        Route::get('/perfil-medico', [PacienteController::class, 'perfilMedico'])->name('paciente.perfil-medico');
        
        // Rutas de búsqueda de médicos
        Route::get('/medicos/search', [PacienteController::class, 'searchDoctors'])->name('paciente.search-doctors');
        Route::get('/medicos/by-specialty/{specialtyId}', [PacienteController::class, 'getDoctorsBySpecialty'])->name('paciente.doctors-by-specialty');
    });
});
