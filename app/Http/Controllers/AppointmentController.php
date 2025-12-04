<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('medico')) {
            $citas = Appointment::where('doctor_id', $user->id)->orderBy('schedule_date', 'desc')->get();
        } else {
            $citas = Appointment::where('patient_id', $user->id)->orderBy('schedule_date', 'desc')->get();
        }

        return view('paciente.historial', compact('citas'));
    }

    public function create()
    {
        $medicos = User::where('role', 'medico')->get();
        return view('paciente.reservar', compact('medicos'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'schedule_date' => 'required|date',
            'schedule_time' => 'required',
            'type' => 'required|in:presencial,telemedicina',
        ]);

        $doctor = User::findOrFail($data['doctor_id']);

        $exists = Appointment::where('doctor_id', $doctor->id)
            ->where('schedule_date', $data['schedule_date'])
            ->where('schedule_time', $data['schedule_time'])
            ->where('status', '!=', 'cancelada')
            ->exists();

        if ($exists) {
            return back()->withErrors(['schedule' => 'El médico no está disponible en ese horario.'])->withInput();
        }

        $appointmentData = array_merge($data, [
            'patient_id' => Auth::id(),
            'status' => 'pendiente',
        ]);

        if ($data['type'] === 'telemedicina') {
            $appointmentData['link_telemedicina'] = 'https://meet.example.com/' . Str::random(12);
        }

        $cita = Appointment::create($appointmentData);

        return redirect()->route('appointments.index')->with('success', 'Cita creada correctamente.');
    }

    public function cancel($id)
    {
        $user = Auth::user();
        $cita = Appointment::findOrFail($id);

        if ($user->id !== $cita->patient_id && $user->id !== $cita->doctor_id && ! $user->hasRole('admin')) {
            abort(403);
        }

        $cita->status = 'cancelada';
        $cita->save();

        return redirect()->back()->with('success', 'Cita cancelada.');
    }
}
