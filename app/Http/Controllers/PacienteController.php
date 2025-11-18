<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PacienteController extends Controller
{
    // Método para tu Dashboard
    public function dashboard()
    {
        // Simplemente devuelve la vista
        return view('paciente.dashboard');
    }

    // Método para "Reservar Cita"
    public function reservarCita()
    {
        return view('paciente.reservar');
    }

    // Método para "Historial de Citas"
    public function historial()
    {
        return view('paciente.historial');
    }

    // Método para "Perfil del Médico"
    public function perfilMedico()
    {
        return view('paciente.perfil-medico');
    }
}
