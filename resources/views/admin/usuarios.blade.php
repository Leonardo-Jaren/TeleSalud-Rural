@extends('layouts.app')

@section('title', 'Admin - Usuarios')

@section('content')
<link rel="stylesheet" href="{{ asset('css/branding.css') }}">

<div class="py-3">
    <h1 class="h3 mb-3">Gestión de Usuarios</h1>

    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between mb-3">
                <p class="text-muted m-0">Usuarios registrados en la plataforma</p>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th width="160">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($usuarios as $u)
                        <tr>
                            <td>{{ $u->id }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->role }}</td>
                            <td>
                                @if ($u->blocked)
                                    <span class="badge bg-danger">Bloqueado</span>
                                @else
                                    <span class="badge bg-success">Activo</span>
                                @endif
                            </td>

                            <td>
                                {{-- Botón ver --}}
                                <a href="{{ route('admin.usuarios.show', $u->id) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    Ver
                                </a>

                                {{-- Bloquear/Desbloquear --}}
                                <form action="{{ route('admin.usuarios.bloquear', $u->id) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-warning">
                                        {{ $u->blocked ? 'Desbloquear' : 'Bloquear' }}
                                    </button>
                                </form>

                                {{-- Eliminar --}}
                                <form action="{{ route('admin.usuarios.destroy', $u->id) }}" 
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">
                                No hay usuarios registrados.
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            {{-- PAGINACIÓN --}}
            <div class="mt-3">
                {{ $usuarios->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
