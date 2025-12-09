@extends('layouts.app')

@section('content')
<div class="container py-4" style="max-width: 1200px;">
    {{-- Header --}}
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('paciente.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Médicos Disponibles</li>
            </ol>
        </nav>
        <h2 class="h3 fw-bold mb-2">Nuestros Médicos</h2>
        <p class="text-muted mb-0">Conoce a los especialistas disponibles en nuestra plataforma de telemedicina.</p>
    </div>

    {{-- Barra de búsqueda --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('paciente.search-doctors') }}">
                <div class="row g-3 align-items-center">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0" name="especialidad" placeholder="Buscar por especialidad (ej: Cardiología)" value="{{ $especialidadFiltro ?? '' }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select" name="modalidad">
                            <option value="">Todas las modalidades</option>
                            <option value="presencial">Presencial</option>
                            <option value="telemedicina">Telemedicina</option>
                            <option value="ambas">Presencial y Telemedicina</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button class="btn btn-primary grow" type="submit">
                            <i class="bi bi-search me-1"></i>Buscar
                        </button>
                        <a href="{{ route('paciente.perfil-medico') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Grid de Médicos --}}
    <div class="row g-4">
        @forelse($medicos ?? [] as $medico)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center p-4">
                        {{-- Foto de perfil --}}
                        <div class="mb-3">
                            <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);">
                                <i class="bi bi-person-fill text-white" style="font-size: 3rem;"></i>
                            </div>
                        </div>

                        {{-- Nombre del médico --}}
                        <h5 class="card-title fw-bold mb-1">{{ $medico->name ?? 'Dr. Nombre' }}</h5>

                        {{-- Especialidad(es) --}}
                        @if($medico->medico && $medico->medico->especialidades && $medico->medico->especialidades->isNotEmpty())
                            <div class="mb-2">
                                @foreach($medico->medico->especialidades as $specialty)
                                    <span class="badge rounded-pill" style="background-color: rgba(14,165,233,0.1); color: #0ea5e9;">{{ $specialty->nombre }}</span>
                                @endforeach
                            </div>
                        @else
                            <span class="badge rounded-pill bg-secondary mb-2">Especialidad no asignada</span>
                        @endif

                        {{-- Número de colegiatura --}}
                        @if($medico->medico && $medico->medico->codigo_cmp)
                            <p class="text-muted small mb-2">
                                <i class="bi bi-card-text me-1"></i>CMP: {{ $medico->medico->codigo_cmp }}
                            </p>
                        @endif

                        {{-- Biografía --}}
                        @if($medico->medico && $medico->medico->biografia)
                            <p class="card-text text-muted small mb-3">{{ Str::limit($medico->medico->biografia, 100) }}</p>
                        @else
                            <p class="card-text text-muted small mb-3">Información del médico no disponible.</p>
                        @endif

                        {{-- Botones de acción --}}
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="#" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-calendar3 me-1"></i>Horarios
                            </a>
                            <a href="{{ url('/paciente/reservar-cita?doctor_id=' . $medico->id) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-calendar-plus me-1"></i>Agendar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            {{-- Datos de demostración --}}
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);">
                                <i class="bi bi-person-fill text-white" style="font-size: 3rem;"></i>
                            </div>
                        </div>
                        <h5 class="card-title fw-bold mb-1">Dr. Ricardo Morales</h5>
                        <span class="badge rounded-pill mb-2" style="background-color: rgba(14,165,233,0.1); color: #0ea5e9;">Cardiología</span>
                        <p class="text-muted small mb-2"><i class="bi bi-card-text me-1"></i>CMP: 12345</p>
                        <p class="card-text text-muted small mb-3">"Especialista con 10 años de experiencia en salud cardiovascular."</p>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="#" class="btn btn-outline-primary btn-sm"><i class="bi bi-calendar3 me-1"></i>Horarios</a>
                            <a href="{{ url('/paciente/reservar-cita') }}" class="btn btn-primary btn-sm"><i class="bi bi-calendar-plus me-1"></i>Agendar</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; background: linear-gradient(135deg, #8b5cf6 0%, #d946ef 100%);">
                                <i class="bi bi-person-fill text-white" style="font-size: 3rem;"></i>
                            </div>
                        </div>
                        <h5 class="card-title fw-bold mb-1">Dra. Ana Fuentes</h5>
                        <span class="badge rounded-pill mb-2" style="background-color: rgba(139,92,246,0.1); color: #8b5cf6;">Medicina General</span>
                        <p class="text-muted small mb-2"><i class="bi bi-card-text me-1"></i>CMP: 23456</p>
                        <p class="card-text text-muted small mb-3">"Enfocada en atención primaria y prevención de enfermedades."</p>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="#" class="btn btn-outline-primary btn-sm"><i class="bi bi-calendar3 me-1"></i>Horarios</a>
                            <a href="{{ url('/paciente/reservar-cita') }}" class="btn btn-primary btn-sm"><i class="bi bi-calendar-plus me-1"></i>Agendar</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);">
                                <i class="bi bi-person-fill text-white" style="font-size: 3rem;"></i>
                            </div>
                        </div>
                        <h5 class="card-title fw-bold mb-1">Dr. Juan Torres</h5>
                        <span class="badge rounded-pill mb-2" style="background-color: rgba(245,158,11,0.1); color: #f59e0b;">Dermatología</span>
                        <p class="text-muted small mb-2"><i class="bi bi-card-text me-1"></i>CMP: 34567</p>
                        <p class="card-text text-muted small mb-3">"Experto en salud de la piel y procedimientos dermatológicos."</p>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="#" class="btn btn-outline-primary btn-sm"><i class="bi bi-calendar3 me-1"></i>Horarios</a>
                            <a href="{{ url('/paciente/reservar-cita') }}" class="btn btn-primary btn-sm"><i class="bi bi-calendar-plus me-1"></i>Agendar</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Aviso de datos de demostración --}}
            <div class="col-12">
                <div class="alert border-0 shadow-sm d-flex align-items-center" style="background-color: rgba(14,165,233,0.08);">
                    <i class="bi bi-info-circle text-primary me-3" style="font-size: 1.5rem;"></i>
                    <div>
                        <strong>Nota:</strong> Estás viendo datos de demostración. Los médicos reales aparecerán cuando estén registrados en el sistema.
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Volver al Dashboard --}}
    <div class="mt-4">
        <a href="{{ route('paciente.dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Volver al Dashboard
        </a>
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