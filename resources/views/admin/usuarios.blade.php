@extends('layouts.app')

@section('title', 'Admin - Usuarios')

@section('content')
<link rel="stylesheet" href="{{ asset('css/branding.css') }}">

<div class="container py-3" style="max-width:1200px;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h3 mb-0">Gestión de Usuarios</h1>
            <p class="text-muted small mb-0">Usuarios registrados en la plataforma</p>
        </div>
        <div>
            <a href="{{ route('admin.registrar-medico') }}" class="btn" style="background-color: #155b7b; color: white; border-color: #155b7b;">
                <i class="bi bi-person-plus me-1"></i> Nuevo Médico
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-2">

            <div class="table-responsive admin-table-wrapper">
                <table class="table table-hover table-sm align-middle admin-table mb-0">
                    <thead class="table-light small">
                        <tr>
                            <th class="ps-3">Usuario</th>
                            <th>Email</th>
                            <th class="text-center">Rol</th>
                            <th class="text-center">Estado</th>
                            <th class="text-end pe-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($usuarios as $u)
                        <tr>
                            <td class="ps-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-sm bg-primary-10 text-primary d-inline-flex align-items-center justify-content-center">{{ strtoupper(substr($u->name,0,1)) }}</div>
                                    <div>
                                        <div class="fw-semibold">{{ $u->name }}</div>
                                        <div class="small text-muted">ID: {{ $u->id }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="small"><span class="text-muted" title="{{ $u->email }}">{{ $u->email }}</span></td>

                            <td class="text-center">
                                <span class="badge bg-secondary text-white small">{{ ucfirst($u->rol) }}</span>
                            </td>

                            <td class="text-center">
                                @if ($u->bloqueado)
                                    <span class="badge badge-admin-bloqueado">Bloqueado</span>
                                @else
                                    <span class="badge badge-admin-activo">Activo</span>
                                @endif
                            </td>

                            <td class="text-end pe-3">
                                <a href="{{ route('admin.usuarios.show', $u->id) }}" class="btn btn-sm btn-outline-primary" title="Ver">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <form action="{{ route('admin.usuarios.bloquear', $u->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-warning" title="Bloquear/Desbloquear">
                                        <i class="bi bi-lock"></i>
                                    </button>
                                </form>

                                <form action="{{ route('admin.usuarios.destroy', $u->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">No hay usuarios registrados.</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            {{-- PAGINACIÓN --}}
            <div class="mt-3 d-flex justify-content-end">
                {{ $usuarios->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
