<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Support\Facades\Log;

class PacienteController extends Controller
{
    /**
     * Mostrar dashboard del paciente con próxima cita
     */
    public function dashboard()
    {
        // Intentar obtener la próxima cita del usuario logueado
        try {
            $proximaCita = auth()->user()->appointmentsAsPatient()
                ->where('estado', '!=', 'cancelada')
                ->orderBy('fecha')
                ->with('medico')
                ->first();
        } catch (\Throwable $e) {
            $proximaCita = null;
        }

        return view('paciente.dashboard', [
            'proximaCita' => $proximaCita,
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
     * Procesar el formulario de reserva (POST)
     */
    public function storeReserva(Request $request)
    {
        $data = $request->validate([
            'especialidad' => 'nullable|string|max:255',
            'medico' => 'nullable|integer',
            'fecha' => 'required|date',
            'hora' => 'required|string',
            'modalidad' => 'required|string|in:presencial,telemedicina',
            'motivo' => 'nullable|string|max:1000',
        ]);
        // Resolver especialidad: puede venir como id o como nombre
        $especialidadId = null;
        if (!empty($data['especialidad'])) {
            // Intentar por id
            if (is_numeric($data['especialidad'])) {
                $especial = \App\Models\Especialidad::find((int)$data['especialidad']);
                $especialidadId = $especial ? $especial->id : null;
            } else {
                $especial = \App\Models\Especialidad::where('nombre', 'like', "%{$data['especialidad']}%")->first();
                $especialidadId = $especial ? $especial->id : null;
            }
        }

        // Determinar medico_id si se proporcionó
        $medicoId = null;
        if (!empty($data['medico']) && is_numeric($data['medico'])) {
            $medicoId = (int)$data['medico'];
        }

        try {
            $appointment = Appointment::create([
                'type' => $data['modalidad'] === 'telemedicina' ? 'telemedicina' : 'presencial',
                'paciente_id' => auth()->id(),
                'medico_id' => $medicoId,
                'fecha' => $data['fecha'],
                'hora' => $data['hora'],
                'motivo' => $data['motivo'] ?? null,
                'especialidad_id' => $especialidadId,
                'estado' => 'pendiente',
            ]);
        } catch (\Throwable $e) {
            Log::error('Error creando appointment: ' . $e->getMessage());
            return redirect()->route('paciente.reservar-cita')
                ->with('error', 'No se pudo crear la cita. Inténtalo de nuevo.');
        }

        return redirect()->route('paciente.historial')
            ->with('success', 'Cita reservada correctamente. Recibirás confirmación por email si está disponible.');
    }

    /**
     * Mostrar historial de citas del paciente
     */
    public function historial()
    {
        // Intentar obtener las citas reales del usuario (si la tabla y relaciones están disponibles)
        try {
            $citas = auth()->user()->appointmentsAsPatient()
                ->orderBy('fecha', 'desc')
                ->get();
        } catch (\Throwable $e) {
            // Si falla (por columnas ausentes), devolver array vacío para no romper la vista
            $citas = [];
        }

        return view('paciente.historial', [
            'citas' => $citas,
        ]);
    }

    /**
     * Mostrar lista de médicos disponibles
     */
    public function perfilMedico()
    {
        // Obtener todos los médicos (usuarios con rol 'medico') junto con su perfil de doctor
        $medicos = User::where('rol', 'medico')
            ->with('medico.especialidades')
            ->get();

        return view('paciente.perfil-medico', [
            'medicos' => $medicos,
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

        // Buscar médicos por nombre de especialidad (columna 'nombre' en tabla especialidades)
        $medicos = User::where('rol', 'medico')
            ->whereHas('medico.especialidades', function ($query) use ($specialty) {
                $query->where('nombre', 'like', "%{$specialty}%");
            })
            ->with('medico.especialidades')
            ->get();

        return view('paciente.perfil-medico', [
            'medicos' => $medicos,
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

    /**
     * Mostrar detalle de una cita (propiedad del paciente)
     */
    public function detalle($id)
    {
        $cita = Appointment::with(['medico', 'especialidad'])
            ->where('id', $id)
            ->where('paciente_id', auth()->id())
            ->firstOrFail();

        return view('paciente.cita-detalle', [
            'cita' => $cita,
        ]);
    }

    /**
     * Cancelar una cita (acción simple, disponible vía GET por ahora)
     */
    public function cancelar($id)
    {
        try {
            $cita = Appointment::where('id', $id)
                ->where('paciente_id', auth()->id())
                ->firstOrFail();

            $cita->estado = 'cancelada';
            $cita->save();

            return redirect()->route('paciente.historial')->with('success', 'Cita cancelada correctamente.');
        } catch (\Throwable $e) {
            return redirect()->route('paciente.historial')->with('error', 'No se pudo cancelar la cita.');
        }
    }

    /**
     * Reprogramar: redirige al formulario de reservar con datos básicos (preselección)
     */
    public function reprogramar($id)
    {
        try {
            $cita = Appointment::where('id', $id)
                ->where('paciente_id', auth()->id())
                ->firstOrFail();

            // Redirigir al formulario de reservar con parámetros para prellenar
            $params = [];
            if ($cita->medico_id) $params['doctor_id'] = $cita->medico_id;
            if ($cita->especialidad_id) $params['especialidad'] = $cita->especialidad_id;
            if ($cita->fecha) $params['fecha'] = $cita->fecha;
            if ($cita->hora) $params['hora'] = $cita->hora;

            return redirect()->route('paciente.reservar-cita', $params)
                ->with('info', 'Puedes reprogramar la cita; edita fecha/hora y confirma.');
        } catch (\Throwable $e) {
            return redirect()->route('paciente.historial')->with('error', 'No se pudo iniciar la reprogramación.');
        }
    }
}
