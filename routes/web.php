<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ----- RUTAS TEMPORALES -----
Route::view('/medico/dashboard', 'medico.dashboard');
Route::view('/medico/horarios', 'medico.horarios');
Route::view('/medico/pacientes', 'medico.pacientes');
Route::view('/medico/citas', 'medico.citas');
Route::view('/medico/perfil', 'medico.perfil');

Route::view('/admin/dashboard', 'admin.dashboard');
Route::view('/admin/usuarios', 'admin.usuarios');
