@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-4">
        <h2 class="mb-2">Dashboard - Paciente</h2>
        <p class="text-muted">Bienvenido, {{ auth()->user()->name ?? 'Paciente' }}. Gestiona tus citas médicas desde aquí.</p>
    </div>

    {{-- Sección de Próxima Cita --}}
    @if(isset($proximaCita) && $proximaCita)
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm border-start border-success border-5">
                    <div class="card-body">
                        <h5 class="card-title text-success">
                            <i class="bi bi-calendar-check me-2"></i>Próxima Cita
                        </h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong><i class="bi bi-person-badge me-2"></i>Médico:</strong> 
                                    {{ $proximaCita->doctor->user->name ?? 'Por asignar' }}
                                </p>
                                <p class="mb-2">
                                    <strong><i class="bi bi-calendar3 me-2"></i>Fecha:</strong> 
                                    {{ $proximaCita->schedule_date }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong><i class="bi bi-clock me-2"></i>Hora:</strong> 
                                    {{ $proximaCita->schedule_time }}
                                </p>
                                <p class="mb-2">
                                    <strong><i class="bi bi-tag me-2"></i>Tipo:</strong> 
                                    {{ ucfirst($proximaCita->type) }}
                                </p>
                            </div>
                        </div>
                        @if($proximaCita->type === 'telemedicina' && $proximaCita->link_telemedicina)
                            <a href="{{ $proximaCita->link_telemedicina }}" target="_blank" class="btn btn-success mt-2">
                                <i class="bi bi-camera-video me-2"></i>Acceder a Videollamada
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-info border-0 shadow-sm">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-info-circle me-3" style="font-size: 2rem;"></i>
                        <div>
                            <h5 class="alert-heading mb-1">No tienes citas próximas</h5>
                            <p class="mb-0">
                                <a href="{{ route('paciente.reservar-cita') }}" class="alert-link fw-bold">Agenda una cita ahora</a> 
                                y comienza a recibir atención médica de calidad.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Tarjetas de Acceso Rápido --}}
    <div class="row g-3 mb-4">
        {{-- Card para "Reservar Cita" --}}
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm hover-lift">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex p-3">
                            <i class="bi bi-calendar-plus text-primary" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <h5 class="card-title fw-bold">Reservar Cita</h5>
                    <p class="card-text text-muted">Agenda una nueva cita con nuestros especialistas disponibles.</p>
                    <a href="{{ route('paciente.reservar-cita') }}" class="btn btn-primary w-100 mt-3">
                        <i class="bi bi-plus-circle me-2"></i>Agendar Ahora
                    </a>
                </div>
            </div>
        </div>

        {{-- Card para "Historial de Citas" --}}
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm hover-lift">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="rounded-circle bg-success bg-opacity-10 d-inline-flex p-3">
                            <i class="bi bi-clock-history text-success" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <h5 class="card-title fw-bold">Historial de Citas</h5>
                    <p class="card-text text-muted">Revisa todas tus citas pasadas y el registro de consultas.</p>
                    <a href="{{ route('paciente.historial') }}" class="btn btn-outline-success w-100 mt-3">
                        <i class="bi bi-list-check me-2"></i>Ver Historial
                    </a>
                </div>
            </div>
        </div>

        {{-- Card para "Perfil del Médico" --}}
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm hover-lift">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="rounded-circle bg-info bg-opacity-10 d-inline-flex p-3">
                            <i class="bi bi-people text-info" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <h5 class="card-title fw-bold">Médicos Disponibles</h5>
                    <p class="card-text text-muted">Conoce a nuestros profesionales y sus especialidades.</p>
                    <a href="{{ route('paciente.perfil-medico') }}" class="btn btn-outline-info w-100 mt-3">
                        <i class="bi bi-search me-2"></i>Explorar Médicos
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Información Adicional --}}
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="bi bi-info-circle me-2"></i>¿Cómo funciona?
                    </h5>
                    <ol class="mb-0">
                        <li class="mb-2">Busca y selecciona un médico según tu necesidad</li>
                        <li class="mb-2">Elige un horario disponible que se ajuste a ti</li>
                        <li class="mb-2">Confirma tu cita y recibe un recordatorio</li>
                        <li class="mb-0">Únete a la videollamada en el horario programado</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm bg-gradient text-white" style="background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="bi bi-shield-check me-2"></i>Tu Salud es Prioridad
                    </h5>
                    <p class="mb-3">
                        Estamos comprometidos con brindarte atención médica de calidad, 
                        accesible y confiable en todo momento.
                    </p>
                    <div class="d-flex gap-3">
                        <div>
                            <i class="bi bi-check-circle me-1"></i>Seguro
                        </div>
                        <div>
                            <i class="bi bi-check-circle me-1"></i>Rápido
                        </div>
                        <div>
                            <i class="bi bi-check-circle me-1"></i>Confiable
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}
</style>
@endsection
