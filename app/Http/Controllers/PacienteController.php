<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Especialidad;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
    public function reservarCita(Request $request)
    {
        // Cargar especialidades existentes
        $especialidades = Especialidad::orderBy('nombre')->get();

        // Cargar médicos existentes con su perfil
        $medicos = User::where('rol', 'medico')
            ->with(['medico.especialidades'])
            ->get();

        // Si se proporciona doctor_id en la query, verificar que exista
        $selectedDoctorId = $request->query('doctor_id');
        if ($selectedDoctorId) {
            $existe = $medicos->contains('id', $selectedDoctorId);
            if (!$existe) {
                $selectedDoctorId = null; // no existe, limpiar selección
            }
        }

        return view('paciente.reservar', [
            'especialidades' => $especialidades,
            'medicos' => $medicos,
            'selectedDoctorId' => $selectedDoctorId,
        ]);
    }

    /**
     * Procesar la creación de una reserva (form POST)
     */
    public function crearReserva(Request $request)
    {
        // Validación básica
        $data = $request->validate([
            'especialidad' => 'nullable|integer|exists:especialidades,id',
            'medico' => 'required|integer|exists:users,id',
            'modalidad' => 'required|in:presencial,remota',
            'fecha' => 'required|date|after_or_equal:today',
            'motivo' => 'nullable|string|max:1000',
        ]);

        // Verificar que el médico exista y tenga rol 'medico'
        $medico = User::find($data['medico']);
        if (!$medico || ($medico->rol ?? null) !== 'medico') {
            return back()->withErrors(['medico' => 'El médico seleccionado no existe.'])->withInput();
        }

        // Si se indicó especialidad, verificar que exista y que el médico tenga dicha especialidad
        if (!empty($data['especialidad'])) {
            $espId = $data['especialidad'];
            $tiene = $medico->medico && $medico->medico->especialidades ? $medico->medico->especialidades->contains('id', $espId) : false;
            if (!$tiene) {
                return back()->withErrors(['especialidad' => 'La especialidad seleccionada no corresponde al médico seleccionado.'])->withInput();
            }
        }

        // Crear appointment completo
        $type = $data['modalidad'] === 'remota' ? 'telemedicina' : 'presencial';

        // Combinar fecha (date) en scheduled_at con hora por defecto (09:00)
        $scheduled = Carbon::parse($data['fecha'])->setTime(9,0,0);

        $appointment = Appointment::create([
            'type' => $type,
            'paciente_id' => Auth::id(),
            'medico_id' => $medico->id,
            'scheduled_at' => $scheduled,
            'motivo' => $data['motivo'] ?? null,
            'status' => 'pendiente',
        ]);

        return redirect()->route('paciente.historial')->with('success', 'Cita creada correctamente y enviada al médico.');
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

        $user = auth()->user();
        $citas = \App\Models\Appointment::where('paciente_id', $user->id)
            ->orderBy('scheduled_at', 'desc')
            ->get();

        return view('paciente.historial', [
            'citas' => $citas,
        ]);
    }

    /**
     * Cancelar una cita por parte del paciente
     */
    public function cancelarCita(Request $request, $id)
    {
        $user = auth()->user();
        $cita = Appointment::where('id', $id)->where('paciente_id', $user->id)->first();
        if (!$cita) {
            return back()->withErrors(['error' => 'La cita no existe o no te pertenece.']);
        }

        if ($cita->status === 'cancelada') {
            return back()->withErrors(['error' => 'La cita ya fue cancelada.']);
        }

        $cita->status = 'cancelada';
        $cita->save();

        return back()->with('success', 'Cita cancelada correctamente.');
    }

    /**
     * Mostrar lista de médicos disponibles
     */
    public function perfilMedico()
    {
        // Obtener todos los usuarios con rol 'medico' y cargar su perfil de médico y especialidades
        $medicos = User::where('rol', 'medico')
            ->with(['medico.especialidades'])
            ->get();

        // Cargar todas las especialidades para filtros en la UI
        $especialidades = Especialidad::orderBy('nombre')->get();

        return view('paciente.perfil-medico', [
            'medicos' => $medicos,
            'especialidades' => $especialidades,
        ]);
    }

    /**
     * Buscar médicos por especialidad (parámetro GET)
     * Uso: GET /paciente/medicos/search?especialidad=cardiologia
     */
    public function searchDoctors(Request $request)
    {
        $specialty = $request->query('especialidad');

        $query = User::where('rol', 'medico')
            ->with(['medico.especialidades']);

        if ($specialty) {
            $query->whereHas('medico.especialidades', function ($q) use ($specialty) {
                $q->where('nombre', 'like', "%{$specialty}%");
            });
        }

        $medicos = $query->get();

        $especialidades = Especialidad::orderBy('nombre')->get();

        return view('paciente.perfil-medico', [
            'medicos' => $medicos,
            'especialidadFiltro' => $specialty,
            'especialidades' => $especialidades,
        ]);
    }

    /**
     * Obtener médicos filtrados por especialidad (JSON para AJAX)
     * Uso: GET /paciente/medicos/by-specialty/{specialtyId}
     */
    public function getDoctorsBySpecialty($specialtyId)
    {
        $medicos = User::where('rol', 'medico')
            ->with(['medico.especialidades'])
            ->whereHas('medico.especialidades', function ($q) use ($specialtyId) {
                $q->where('id', $specialtyId);
            })
            ->get(['id', 'name', 'email']);

        return response()->json([
            'medicos' => $medicos,
        ]);
    }
}
