<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Especialidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function usuarios()
    {
        $usuarios = User::orderBy('id', 'ASC')->paginate(10);
        return view('admin.usuarios', compact('usuarios'));
    }

    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return view('admin.show', compact('usuario'));
    }

    public function bloquear($id)
    {
        $u = User::findOrFail($id);
        $u->bloqueado = !$u->bloqueado;
        $u->save();

        return back()->with('msg', 'Estado actualizado.');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return back()->with('msg', 'Usuario eliminado correctamente.');
    }

    /**
     * Mostrar el formulario de registro de médico
     */
    public function registrarMedico()
    {
        $especialidades = Especialidad::orderBy('nombre', 'ASC')->get();
        return view('admin.registrar-medico', compact('especialidades'));
    }

    /**
     * Guardar el nuevo médico en la base de datos
     */
    public function storeMedico(Request $request)
    {
        // Validación de datos
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefono' => ['required', 'string', 'max:20'],
            'documento_identidad' => ['required', 'string', 'max:20', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'codigo_cmp' => ['required', 'string', 'max:50', 'unique:medicos'],
            'especialidades' => ['required', 'array', 'min:1'],
            'especialidades.*' => ['exists:especialidades,id'],
            'biografia' => ['nullable', 'string', 'max:1000'],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'Este correo ya está registrado.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'documento_identidad.required' => 'El documento de identidad es obligatorio.',
            'documento_identidad.unique' => 'Este documento ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'codigo_cmp.required' => 'El código CMP es obligatorio.',
            'codigo_cmp.unique' => 'Este código CMP ya está registrado.',
            'especialidades.required' => 'Debe seleccionar al menos una especialidad.',
            'especialidades.min' => 'Debe seleccionar al menos una especialidad.',
        ]);

        DB::beginTransaction();
        
        try {
            // Crear usuario con rol médico
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'documento_identidad' => $request->documento_identidad,
                'password' => Hash::make($request->password),
                'rol' => 'medico',
            ]);

            // Crear perfil de médico
            $medico = Doctor::create([
                'usuario_id' => $user->id,
                'codigo_cmp' => $request->codigo_cmp,
                'biografia' => $request->biografia,
            ]);

            // Asociar especialidades
            $medico->especialidades()->attach($request->especialidades);

            DB::commit();

            return redirect()
                ->route('admin.registrar-medico')
                ->with('success', 'Médico registrado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al registrar el médico: ' . $e->getMessage());
        }
    }
}
