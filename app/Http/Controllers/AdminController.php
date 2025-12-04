<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        $u->blocked = !$u->blocked;
        $u->save();

        return back()->with('msg', 'Estado actualizado.');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return back()->with('msg', 'Usuario eliminado correctamente.');
    }
}
