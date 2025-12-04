@extends('layouts.app')

@section('title', 'Médico - Dashboard')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Dashboard Médico</h1>
            <p class="text-muted mb-0">Bienvenido, Dr. {{ Auth::user()->name }}</p>
        </div>
        <div>
            <span class="badge bg-success">Disponible</span>
        </div>
    </div>

    <!-- Estadísticas del Día -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                                <i class="bi bi-calendar-check text-primary" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1 text-muted">Citas Hoy</h6>
                            <h3 class="mb-0">0</h3>
                            <small class="text-success">
                                <i class="bi bi-arrow-up"></i>En progreso
                            </small>
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
                                <i class="bi bi-people text-success" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1 text-muted">Pacientes</h6>
                            <h3 class="mb-0">0</h3>
                            <small class="text-muted">Total atendidos</small>
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
                                <i class="bi bi-clock text-warning" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1 text-muted">Próxima Cita</h6>
                            <p class="mb-0 fw-semibold">No programada</p>
                            <small class="text-muted">—</small>
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
                                <i class="bi bi-star text-info" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1 text-muted">Calificación</h6>
                            <h3 class="mb-0">—</h3>
                            <small class="text-muted">Promedio</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Acciones Rápidas y Horarios -->
    <div class="row g-3 mb-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <i class="bi bi-lightning-charge me-2"></i>Acciones Rápidas
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <a href="{{ route('medico.horarios') }}" class="btn btn-primary w-100 py-3">
                                <i class="bi bi-calendar3 me-2"></i>Gestionar Horarios
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('medico.perfil') }}" class="btn btn-outline-primary w-100 py-3">
                                <i class="bi bi-person-badge me-2"></i>Editar Perfil
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('medico.citas') }}" class="btn btn-outline-secondary w-100 py-3">
                                <i class="bi bi-list-check me-2"></i>Ver Citas
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="#" class="btn btn-outline-secondary w-100 py-3">
                                <i class="bi bi-people me-2"></i>Mis Pacientes
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-gradient text-white h-100" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <div class="card-body d-flex flex-column justify-content-center">
                    <div class="text-center">
                        <i class="bi bi-calendar-heart" style="font-size: 3rem; opacity: 0.9;"></i>
                        <h5 class="mt-3 mb-2">Agenda del Día</h5>
                        <p class="mb-0 small opacity-90">No hay citas programadas para hoy</p>
                        <a href="{{ route('medico.horarios') }}" class="btn btn-light btn-sm mt-3">
                            Configurar Horarios
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Información y Estadísticas -->
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-clipboard-data me-2"></i>Resumen Semanal
                    </h5>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Consultas completadas</span>
                        <span class="fw-bold">0</span>
                    </div>
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 0%"></div>
                    </div>
                    <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i>Estadística de la semana actual
                    </small>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-stethoscope me-2"></i>Especialidades
                    </h5>
                    @php
                        $medico = Auth::user()->medico;
                        $especialidades = $medico ? $medico->especialidades : collect([]);
                    @endphp
                    
                    @if($especialidades->count() > 0)
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($especialidades as $especialidad)
                                <span class="badge bg-primary">{{ $especialidad->nombre }}</span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted mb-0">No hay especialidades registradas</p>
                        <a href="{{ route('medico.perfil') }}" class="btn btn-sm btn-outline-primary mt-2">
                            Agregar Especialidades
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

