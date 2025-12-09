@extends('layouts.app')

@section('content')
<div class="container py-4" style="max-width: 1200px;">
    {{-- Header --}}
    <div class="mb-4">
        <h2 class="h3 fw-bold mb-2">Dashboard - Paciente</h2>
        <p class="text-muted mb-0">Bienvenido, {{ auth()->user()->name ?? 'Paciente' }}. Gestiona tus citas médicas desde aquí.</p>
    </div>

    {{-- Sección de Próxima Cita --}}
    @if(isset($proximaCita) && $proximaCita)
        <div class="card border-0 shadow-sm mb-4" style="border-left: 4px solid #10b981 !important;">
            <div class="card-body">
                <h5 class="card-title text-success mb-3">
                    <i class="bi bi-calendar-check me-2"></i>Próxima Cita
                </h5>
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-2">
                            <strong><i class="bi bi-person-badge me-2"></i>Médico:</strong>
                            {{ $proximaCita->medico->name ?? 'Por asignar' }}
                        </p>
                        <p class="mb-2">
                            <strong><i class="bi bi-calendar3 me-2"></i>Fecha:</strong>
                            {{ optional($proximaCita->fecha) ? \Carbon\Carbon::parse($proximaCita->fecha)->format('d/m/Y') : '—' }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2">
                            <strong><i class="bi bi-clock me-2"></i>Hora:</strong>
                            {{ optional($proximaCita->hora) ? \Carbon\Carbon::parse($proximaCita->hora)->format('h:i A') : '—' }}
                        </p>
                        <p class="mb-2">
                            <strong><i class="bi bi-tag me-2"></i>Tipo:</strong>
                            {{ ucfirst($proximaCita->type ?? 'presencial') }}
                        </p>
                    </div>
                </div>
                @if(($proximaCita->type ?? '') === 'telemedicina' && $proximaCita->telemedicine_link)
                    <a href="{{ $proximaCita->telemedicine_link }}" target="_blank" class="btn btn-success mt-2">
                        <i class="bi bi-camera-video me-2"></i>Acceder a Videollamada
                    </a>
                @endif
            </div>
        </div>
    @else
        <div class="alert alert-info border-0 shadow-sm mb-4 d-flex align-items-center" style="background: linear-gradient(135deg, rgba(14,165,233,0.08) 0%, rgba(16,185,129,0.08) 100%);">
            <i class="bi bi-info-circle me-3 text-info" style="font-size: 1.75rem;"></i>
            <div>
                <h6 class="alert-heading mb-1 fw-bold">No tienes citas próximas</h6>
                <p class="mb-0">
                    <a href="{{ route('paciente.reservar-cita') }}" class="alert-link fw-bold text-primary">Agenda una cita ahora</a> 
                    y comienza a recibir atención médica de calidad.
                </p>
            </div>
        </div>
    @endif

    {{-- Tarjetas de Acceso Rápido --}}
    <div class="row g-4 mb-4">
        {{-- Card para "Reservar Cita" --}}
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm hover-lift">
                <div class="card-body text-center d-flex flex-column p-4">
                    <div class="mb-3">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background-color: rgba(14,165,233,0.1);">
                            <i class="bi bi-calendar-plus text-primary" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <h5 class="card-title fw-bold">Reservar Cita</h5>
                    <p class="card-text text-muted grow">Agenda una nueva cita con nuestros especialistas disponibles.</p>
                    <a href="{{ route('paciente.reservar-cita') }}" class="btn btn-primary w-100 mt-auto">
                        <i class="bi bi-plus-circle me-2"></i>Agendar Ahora
                    </a>
                </div>
            </div>
        </div>

        {{-- Card para "Historial de Citas" --}}
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm hover-lift">
                <div class="card-body text-center d-flex flex-column p-4">
                    <div class="mb-3">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background-color: rgba(16,185,129,0.1);">
                            <i class="bi bi-clock-history text-success" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <h5 class="card-title fw-bold">Historial de Citas</h5>
                    <p class="card-text text-muted flex-grow-1">Revisa todas tus citas pasadas y el registro de consultas.</p>
                    <a href="{{ route('paciente.historial') }}" class="btn btn-outline-success w-100 mt-auto">
                        <i class="bi bi-list-check me-2"></i>Ver Historial
                    </a>
                </div>
            </div>
        </div>

        {{-- Card para "Médicos Disponibles" --}}
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm hover-lift">
                <div class="card-body text-center d-flex flex-column p-4">
                    <div class="mb-3">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background-color: rgba(139,92,246,0.1);">
                            <i class="bi bi-people" style="font-size: 2rem; color: #8b5cf6;"></i>
                        </div>
                    </div>
                    <h5 class="card-title fw-bold">Médicos Disponibles</h5>
                    <p class="card-text text-muted flex-grow-1">Conoce a nuestros profesionales y sus especialidades.</p>
                    <a href="{{ route('paciente.perfil-medico') }}" class="btn w-100 mt-auto" style="border: 1px solid #8b5cf6; color: #8b5cf6; background: transparent;">
                        <i class="bi bi-search me-2"></i>Explorar Médicos
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Información Adicional --}}
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-3">
                        <i class="bi bi-info-circle me-2 text-primary"></i>¿Cómo funciona?
                    </h5>
                    <ol class="mb-0 ps-3">
                        <li class="mb-2">Busca y selecciona un médico según tu necesidad</li>
                        <li class="mb-2">Elige un horario disponible que se ajuste a ti</li>
                        <li class="mb-2">Confirma tu cita y recibe un recordatorio</li>
                        <li class="mb-0">Únete a la videollamada en el horario programado</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-3">
                        <i class="bi bi-shield-check me-2"></i>Tu Salud es Prioridad
                    </h5>
                    <p class="mb-3 opacity-90">
                        Estamos comprometidos con brindarte atención médica de calidad, 
                        accesible y confiable en todo momento.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-2"></i>Seguro
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-2"></i>Rápido
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-2"></i>Confiable
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
    box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1) !important;
}
</style>
@endsection
