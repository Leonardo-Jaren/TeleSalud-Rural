@extends('layouts.app')

@section('mainClass', '')

@section('content')
<!-- Hero Section -->
<div class="hero-section" style="background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%); color: white; padding: 80px 0;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h1 class="display-4 fw-bold mb-4">
                    Atención Médica Remota de Calidad
                </h1>
                <p class="lead mb-4">
                    Conectamos comunidades rurales con profesionales de la salud a través de telemedicina, 
                    facilitando el acceso a consultas médicas sin importar la distancia.
                </p>
                @guest
                    <div class="d-flex gap-3">
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4">
                            <i class="bi bi-person-plus me-2"></i>Registrarse
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-4">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
                        </a>
                    </div>
                @else
                    @php $role = Auth::user()->rol ?? 'paciente'; @endphp
                    <a href="{{ $role === 'admin' ? route('admin.dashboard') : ($role === 'medico' ? route('medico.dashboard') : route('paciente.dashboard')) }}" 
                       class="btn btn-light btn-lg px-4">
                        <i class="bi bi-speedometer2 me-2"></i>Ir a mi Dashboard
                    </a>
                @endguest
            </div>
            <div class="col-lg-6 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="400" height="400" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" style="opacity: 0.9;">
                    <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                    <circle cx="12" cy="12" r="10" stroke-width="0.5" fill="rgba(255,255,255,0.1)"/>
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" transform="translate(6, -3)"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3">¿Por qué elegir TeleSalud Rural?</h2>
            <p class="lead text-muted">Facilitamos el acceso a la salud para todos</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="bi bi-clock-history" style="font-size: 3rem; color: #10b981;"></i>
                        </div>
                        <h5 class="card-title fw-bold">Atención 24/7</h5>
                        <p class="card-text text-muted">
                            Accede a consultas médicas en cualquier momento del día, adaptándonos a tus horarios.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="bi bi-hospital" style="font-size: 3rem; color: #0ea5e9;"></i>
                        </div>
                        <h5 class="card-title fw-bold">Profesionales Certificados</h5>
                        <p class="card-text text-muted">
                            Médicos especialistas con amplia experiencia y certificaciones vigentes.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="bi bi-shield-check" style="font-size: 3rem; color: #8b5cf6;"></i>
                        </div>
                        <h5 class="card-title fw-bold">Seguro y Confidencial</h5>
                        <p class="card-text text-muted">
                            Tus datos médicos están protegidos con los más altos estándares de seguridad.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Services Section -->
<div class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3">Nuestros Servicios</h2>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0 me-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                            <i class="bi bi-camera-video text-primary" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold">Consultas por Videollamada</h5>
                        <p class="text-muted">
                            Realiza consultas médicas desde la comodidad de tu hogar mediante videollamadas seguras.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0 me-3">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3">
                            <i class="bi bi-calendar-check text-success" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold">Agendamiento Fácil</h5>
                        <p class="text-muted">
                            Sistema intuitivo para agendar citas con los especialistas disponibles en tiempo real.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0 me-3">
                        <div class="rounded-circle bg-info bg-opacity-10 p-3">
                            <i class="bi bi-file-medical text-info" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold">Historial Médico Digital</h5>
                        <p class="text-muted">
                            Accede a tu historial de consultas y mantén un registro completo de tu salud.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0 me-3">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                            <i class="bi bi-people text-warning" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold">Múltiples Especialidades</h5>
                        <p class="text-muted">
                            Accede a médicos generales y especialistas en diversas áreas de la salud.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
@guest
<div class="py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="display-5 fw-bold mb-4">¿Listo para comenzar?</h2>
                <p class="lead text-muted mb-4">
                    Regístrate hoy y accede a atención médica de calidad desde cualquier lugar
                </p>
                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5">
                        <i class="bi bi-person-plus me-2"></i>Crear Cuenta
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg px-5">
                        Ya tengo cuenta
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endguest

<!-- Stats Section -->
<div class="py-5 bg-dark text-white">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 mb-4 mb-md-0">
                <h2 class="display-4 fw-bold">1000+</h2>
                <p class="text-white-50">Consultas Realizadas</p>
            </div>
            <div class="col-md-3 mb-4 mb-md-0">
                <h2 class="display-4 fw-bold">50+</h2>
                <p class="text-white-50">Médicos Registrados</p>
            </div>
            <div class="col-md-3 mb-4 mb-md-0">
                <h2 class="display-4 fw-bold">10</h2>
                <p class="text-white-50">Especialidades</p>
            </div>
            <div class="col-md-3">
                <h2 class="display-4 fw-bold">95%</h2>
                <p class="text-white-50">Satisfacción</p>
            </div>
        </div>
    </div>
</div>

@endsection

