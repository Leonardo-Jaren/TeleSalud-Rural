@extends('layouts.app')

@section('title', 'Admin - Dashboard')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Dashboard - Administración</h1>
            <p class="text-muted mb-0">Panel de control del sistema</p>
        </div>
        <div>
            <span class="badge bg-success">En línea</span>
        </div>
    </div>

    <!-- Estadísticas Principales -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                                <i class="bi bi-people text-primary" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1 text-muted">Total Usuarios</h6>
                            <h3 class="mb-0">{{ \App\Models\User::count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="rounded-circle bg-success bg-opacity-10 p-3">
                                <i class="bi bi-hospital text-success" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1 text-muted">Médicos</h6>
                            <h3 class="mb-0">{{ \App\Models\Doctor::count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="rounded-circle bg-info bg-opacity-10 p-3">
                                <i class="bi bi-person-check text-info" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1 text-muted">Pacientes</h6>
                            <h3 class="mb-0">{{ \App\Models\Patient::count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                                <i class="bi bi-stethoscope text-warning" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1 text-muted">Especialidades</h6>
                            <h3 class="mb-0">{{ \App\Models\Especialidad::count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Acciones Rápidas -->
    <div class="row g-3 mb-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <i class="bi bi-lightning-charge me-2"></i>Acciones Rápidas
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <a href="{{ route('admin.registrar-medico') }}" class="btn btn-primary w-100 py-3">
                                <i class="bi bi-person-plus-fill me-2"></i>Registrar Médico
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('admin.usuarios') }}" class="btn btn-outline-primary w-100 py-3">
                                <i class="bi bi-people-fill me-2"></i>Ver Usuarios
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-primary text-white h-100">
                <div class="card-body d-flex flex-column justify-content-center text-center">
                    <i class="bi bi-shield-check" style="font-size: 3rem; opacity: 0.8;"></i>
                    <h5 class="mt-3 mb-2">Sistema Activo</h5>
                    <p class="mb-0 small opacity-75">Todos los servicios funcionando correctamente</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Información del Sistema -->
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-bar-chart me-2"></i>Resumen
                    </h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Usuarios Activos
                            <span class="badge bg-success rounded-pill">{{ \App\Models\User::where('bloqueado', false)->count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Usuarios Bloqueados
                            <span class="badge bg-danger rounded-pill">{{ \App\Models\User::where('bloqueado', true)->count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Administradores
                            <span class="badge bg-primary rounded-pill">{{ \App\Models\User::where('rol', 'admin')->count() }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-info-circle me-2"></i>Información
                    </h5>
                    <p class="text-muted">
                        Desde este panel puedes gestionar todos los aspectos del sistema TeleSalud Rural.
                    </p>
                    <div class="d-flex gap-2 mt-3">
                        <a href="{{ route('admin.usuarios') }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-gear me-1"></i>Gestionar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

