<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PacienteController extends Controller
{
    /**
     * Mostrar dashboard del paciente con próxima cita
     */
    public function dashboard()
    {
        // Obtener próxima cita del usuario logueado (cuando Johan entregue Appointment)
        // $proximaCita = auth()->user()->appointmentsAsPatient()
        //     ->where('status', '!=', 'cancelada')
        //     ->orderBy('schedule_date')
        //     ->first();

        return view('paciente.dashboard', [
            // 'proximaCita' => $proximaCita,
        ]);
    }

    /**
     * Mostrar formulario para reservar cita
     */
    public function reservarCita()
    {
        return view('paciente.reservar');
    }

    /**
     * Mostrar historial de citas del paciente
     */
    public function historial()
    {
        // Obtener todas las citas del usuario logueado (cuando Johan entregue Appointment)
        // $citas = auth()->user()->appointmentsAsPatient()
        //     ->orderBy('schedule_date', 'desc')
        //     ->get();

        $citas = []; // Array vacío temporal hasta que se implemente la funcionalidad completa

        return view('paciente.historial', [
            'citas' => $citas,
        ]);
    }

    /**
     * Mostrar lista de médicos disponibles
     */
    public function perfilMedico()
    {
        // Obtener todos los médicos con su especialidad
        // Cuando Leonardo entregue los modelos Doctor y Specialty:
        // $medicos = User::where('role', 'medico')
        //     ->with('doctor.specialties')
        //     ->get();

        return view('paciente.perfil-medico', [
            // 'medicos' => $medicos,
        ]);
    }

    /**
     * Buscar médicos por especialidad (parámetro GET)
     * Uso: GET /paciente/medicos/search?especialidad=cardiologia
     */
    public function searchDoctors(Request $request)
    {
        $specialty = $request->query('especialidad');

        if (!$specialty) {
            return redirect()->route('paciente.perfil-medico');
        }

        // Cuando Leonardo entregue los modelos:
        // $medicos = User::where('role', 'medico')
        //     ->with(['doctor.specialties' => function($query) use ($specialty) {
        //         $query->where('name', 'ilike', "%{$specialty}%");
        //     }])
        //     ->whereHas('doctor.specialties', function($query) use ($specialty) {
        //         $query->where('name', 'ilike', "%{$specialty}%");
        //     })
        //     ->get();

        return view('paciente.perfil-medico', [
            // 'medicos' => $medicos,
            'especialidadFiltro' => $specialty,
        ]);
    }

    /**
     * Obtener médicos filtrados por especialidad (JSON para AJAX)
     * Uso: GET /paciente/medicos/by-specialty/{specialtyId}
     */
    public function getDoctorsBySpecialty($specialtyId)
    {
        // Cuando Leonardo entregue los modelos:
        // $medicos = User::where('role', 'medico')
        //     ->with(['doctor.specialties'])
        //     ->whereHas('doctor.specialties', function($query) use ($specialtyId) {
        //         $query->where('id', $specialtyId);
        //     })
        //     ->get(['id', 'name', 'email']);

        // return response()->json([
        //     'medicos' => $medicos,
        // ]);

        return response()->json([
            'message' => 'Funcionalidad disponible cuando los modelos Doctor y Specialty estén listos',
        ]);
    }
}
