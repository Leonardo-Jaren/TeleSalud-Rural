<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Especialidad;
use App\Models\Doctor;
use App\Models\Horario;
use App\Models\Appointment;

class MedicoControlador extends Controller
{
    
    public function editarPerfil()
    {
        // Obtener el médico logueado
        $medico = Auth::user()->medico;

        // Verificar si el usuario tiene un perfil de médico asociado
        if (!$medico) {
            return redirect()->route('dashboard')->withErrors(['error' => 'No tienes un perfil de médico asociado.']);
        }

        // Obtener todas las especialidades
        $especialidades = Especialidad::all();

        // Retornar la vista con los datos
        return view('medico.perfil', [
            'medico' => $medico,
            'especialidades' => $especialidades
        ]);
    }

    public function actualizarPerfil(Request $request)
    {
        // Validar los campos requeridos
        $request->validate([
            'CMP' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'especialidades' => 'nullable|array',
        ]);

        // Obtener el médico logueado
        $medico = Auth::user()->medico;
        $usuario = Auth::user();

        // Actualizar los datos del médico
        $medico->update([
            'codigo_cmp' => $request->CMP,
        ]);

        // Actualizar el teléfono en la tabla de usuarios
        $usuario->telefono = $request->telefono;
        $usuario->save();

        // Sincronizar las especialidades
        if ($request->has('especialidades')) {
            $medico->especialidades()->sync($request->especialidades);
        }

        // Redirigir con un mensaje de éxito
        return redirect()->route('medico.perfil')->with('success', 'Perfil actualizado correctamente.');
    }

    public function gestionarHorarios()
    {
        // Obtener el médico logueado
        $medico = Auth::user()->medico;

        // Obtener los horarios del médico
        $horarios = $medico->horarios;

        // Retornar la vista con los horarios
        return view('medico.horarios', [
            'horarios' => $horarios
        ]);
    }

    public function guardarHorario(Request $request)
    {
        // Validar que hora_fin sea mayor a hora_inicio
        $request->validate([
            'dia' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
        ]);

        // Obtener el médico logueado
        $medico = Auth::user()->medico;

        // Validar solapamiento de horarios
        $existeSolapamiento = Horario::where('medico_id', $medico->id)
            ->where('dia', $request->dia)
            ->where(function ($query) use ($request) {
                $query->whereBetween('hora_inicio', [$request->hora_inicio, $request->hora_fin])
                      ->orWhereBetween('hora_fin', [$request->hora_inicio, $request->hora_fin]);
            })
            ->exists();

        if ($existeSolapamiento) {
            return back()->withErrors(['error' => 'Ya existe un horario en este rango de horas para el día seleccionado.']);
        }

        // Crear el nuevo horario
        Horario::create([
            'medico_id' => $medico->id,
            'dia' => $request->dia,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
        ]);

        return redirect()->route('medico.horarios')->with('success', 'Horario guardado correctamente.');
    }

    public function eliminarHorario($id)
    {
        // Obtener el médico logueado
        $medico = Auth::user()->medico;

        // Buscar el horario y verificar que pertenezca al médico logueado
        $horario = Horario::where('id', $id)->where('medico_id', $medico->id)->first();

        if (!$horario) {
            return back()->withErrors(['error' => 'El horario no existe o no pertenece a este médico.']);
        }

        // Eliminar el horario
        $horario->delete();

        return redirect()->route('medico.horarios')->with('success', 'Horario eliminado correctamente.');
    }

    /**
     * Mostrar las citas del médico
     */
    public function verCitas()
    {
        // Obtener el médico logueado
        $usuario = Auth::user();
        $medicoPerfil = $usuario->medico;

        if (!$medicoPerfil) {
            return redirect()->route('dashboard')->withErrors(['error' => 'No tienes un perfil de médico.']);
        }

        $citas = Appointment::where('medico_id', $usuario->id)
            ->orderBy('scheduled_at', 'desc')
            ->get();

        return view('medico.citas', [
            'citas' => $citas
        ]);
    }

    /**
     * Aceptar una cita (médico)
     */
    public function aceptarCita(Request $request, $id)
    {
        $usuario = Auth::user();
        $cita = Appointment::where('id', $id)->where('medico_id', $usuario->id)->first();
        if (!$cita) {
            return back()->withErrors(['error' => 'La cita no existe o no te pertenece.']);
        }

        $cita->status = 'aceptada';
        // Si es telemedicina, se puede generar link automático (ya lo hace el accessor)
        $cita->save();

        return back()->with('success', 'Cita aceptada correctamente.');
    }

    /**
     * Rechazar / cancelar una cita (médico)
     */
    public function rechazarCita(Request $request, $id)
    {
        $usuario = Auth::user();
        $cita = Appointment::where('id', $id)->where('medico_id', $usuario->id)->first();
        if (!$cita) {
            return back()->withErrors(['error' => 'La cita no existe o no te pertenece.']);
        }

        $cita->status = 'cancelada';
        $cita->save();

        return back()->with('success', 'Cita cancelada correctamente.');
    }

}
