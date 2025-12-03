<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PacienteController;

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
    $user = Auth::user();
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

// ----- RUTAS TEMPORALES -----
Route::view('/medico/dashboard', 'medico.dashboard');
Route::view('/medico/horarios', 'medico.horarios');
Route::view('/medico/pacientes', 'medico.pacientes');
Route::view('/medico/citas', 'medico.citas');
Route::view('/medico/perfil', 'medico.perfil');

Route::view('/admin/dashboard', 'admin.dashboard');
Route::view('/admin/usuarios', 'admin.usuarios');

// Rutas para Paciente
Route::get('/paciente/dashboard', [PacienteController::class, 'dashboard'])->name('paciente.dashboard');
Route::get('/paciente/reservar-cita', [PacienteController::class, 'reservarCita'])->name('paciente.reservar-cita');
Route::get('/paciente/historial', [PacienteController::class, 'historial'])->name('paciente.historial');
Route::get('/paciente/perfil-medico', [PacienteController::class, 'perfilMedico'])->name('paciente.perfil-medico');

// Rutas de búsqueda de médicos (Integrante 4 - Eduardo)
Route::get('/paciente/medicos/search', [PacienteController::class, 'searchDoctors'])->name('paciente.search-doctors');
Route::get('/paciente/medicos/by-specialty/{specialtyId}', [PacienteController::class, 'getDoctorsBySpecialty'])->name('paciente.doctors-by-specialty');
