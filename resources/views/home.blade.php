@extends('layouts.app')

@section('mainClass', '')

@section('content')
<!-- Hero Section -->
<div class="hero-section" style="background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%); color: white; min-height: 100vh; display: flex; align-items: center; overflow: hidden; position: relative;">
    <div class="container" style="max-width: 1200px;">
        <div style="display: flex; align-items: center; justify-content: space-between; width: 100%; flex-wrap: wrap;">
            <div style="flex: 1 1 auto; min-width: 300px; max-width: 600px; padding-right: 2rem;" data-aos="fade-right">
                <h1 class="display-3 fw-bold mb-4" style="line-height: 1.2;">
                    Atención Médica Remota de Calidad
                </h1>
                <p class="lead mb-4" style="font-size: 1.15rem; line-height: 1.6;">
                    Conectamos comunidades rurales con profesionales de la salud a través de telemedicina, 
                    facilitando el acceso a consultas médicas sin importar la distancia.
                </p>
                @guest
                    <div class="d-flex flex-column flex-sm-row gap-3">
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5 py-3 shadow-sm">
                            <i class="bi bi-person-plus me-2"></i>Registrarse
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-5 py-3">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
                        </a>
                    </div>
                @else
                    @php 
                        $role = Auth::user()->rol ?? 'paciente';
                        $dashboardRoute = match($role) {
                            'admin' => route('admin.dashboard'),
                            'medico' => route('medico.dashboard'),
                            default => route('paciente.dashboard')
                        };
                    @endphp
                    <a href="{{ $dashboardRoute }}" class="btn btn-light btn-lg px-5 py-3 shadow-sm">
                        <i class="bi bi-speedometer2 me-2"></i>Ir a mi Dashboard
                    </a>
                @endguest
            </div>
            <div style="flex: 0 0 350px; display: flex; justify-content: center; align-items: center;" class="d-none d-lg-flex" data-aos="fade-left">
                <svg xmlns="http://www.w3.org/2000/svg" style="width: 300px; height: 300px; opacity: 0.9;" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
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
    <div class="container py-4" style="max-width: 1200px;">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold mb-3">¿Por qué elegir TeleSalud Rural?</h2>
            <p class="lead text-muted mb-0">Facilitamos el acceso a la salud para todos</p>
        </div>
        
        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                <div class="card h-100 border-0 shadow-sm" style="transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'" onmouseout="this.style.transform=''; this.style.boxShadow=''">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 80px; height: 80px; background-color: rgba(16, 185, 129, 0.1);">
                                <i class="bi bi-clock-history" style="font-size: 2.5rem; color: #10b981;"></i>
                            </div>
                        </div>
                        <h5 class="card-title fw-bold mb-3">Atención 24/7</h5>
                        <p class="card-text text-muted mb-0">
                            Accede a consultas médicas en cualquier momento del día, adaptándonos a tus horarios.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-sm" style="transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'" onmouseout="this.style.transform=''; this.style.boxShadow=''">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 80px; height: 80px; background-color: rgba(14, 165, 233, 0.1);">
                                <i class="bi bi-hospital" style="font-size: 2.5rem; color: #0ea5e9;"></i>
                            </div>
                        </div>
                        <h5 class="card-title fw-bold mb-3">Profesionales Certificados</h5>
                        <p class="card-text text-muted mb-0">
                            Médicos especialistas con amplia experiencia y certificaciones vigentes.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 col-xl-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-sm" style="transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'" onmouseout="this.style.transform=''; this.style.boxShadow=''">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 80px; height: 80px; background-color: rgba(139, 92, 246, 0.1);">
                                <i class="bi bi-shield-check" style="font-size: 2.5rem; color: #8b5cf6;"></i>
                            </div>
                        </div>
                        <h5 class="card-title fw-bold mb-3">Seguro y Confidencial</h5>
                        <p class="card-text text-muted mb-0">
                            Tus datos médicos están protegidos con los más altos estándares de seguridad.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Services Section -->
<div class="py-5" style="background-color: #ffffff;">
    <div class="container py-4" style="max-width: 1200px;">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold mb-3">Nuestros Servicios</h2>
            <p class="lead text-muted mb-0">Soluciones completas de telemedicina</p>
        </div>
        
        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-5" data-aos="fade-up" data-aos-delay="0">
                <div class="card h-100 border-0 shadow-sm" style="transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)'" onmouseout="this.style.transform=''; this.style.boxShadow=''">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start">
                            <div class="shrink-0 me-3">
                                <div class="rounded-circle bg-primary bg-opacity-10 p-3" style="width: 65px; height: 65px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-camera-video text-primary" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2">Consultas por Videollamada</h5>
                                <p class="text-muted mb-0">
                                    Realiza consultas médicas desde la comodidad de tu hogar mediante videollamadas seguras.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-5" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-sm" style="transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)'" onmouseout="this.style.transform=''; this.style.boxShadow=''">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start">
                            <div class="shrink-0 me-3">
                                <div class="rounded-circle bg-success bg-opacity-10 p-3" style="width: 65px; height: 65px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-calendar-check text-success" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2">Agendamiento Fácil</h5>
                                <p class="text-muted mb-0">
                                    Sistema intuitivo para agendar citas con los especialistas disponibles en tiempo real.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-5" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-sm" style="transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)'" onmouseout="this.style.transform=''; this.style.boxShadow=''">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start">
                            <div class="shrink-0 me-3">
                                <div class="rounded-circle bg-info bg-opacity-10 p-3" style="width: 65px; height: 65px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-file-medical text-info" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2">Historial Médico Digital</h5>
                                <p class="text-muted mb-0">
                                    Accede a tu historial de consultas y mantén un registro completo de tu salud.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-5" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100 border-0 shadow-sm" style="transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)'" onmouseout="this.style.transform=''; this.style.boxShadow=''">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start">
                            <div class="shrink-0 me-3">
                                <div class="rounded-circle bg-warning bg-opacity-10 p-3" style="width: 65px; height: 65px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-people text-warning" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2">Múltiples Especialidades</h5>
                                <p class="text-muted mb-0">
                                    Accede a médicos generales y especialistas en diversas áreas de la salud.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-camera-video text-primary" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-2">Consultas por Videollamada</h5>
                        <p class="text-muted mb-0">
                            Realiza consultas médicas desde la comodidad de tu hogar mediante videollamadas seguras.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-5" data-aos="fade-up" data-aos-delay="100">
                <div class="d-flex align-items-start p-3 rounded" style="transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.backgroundColor=''">
                    <div class="shrink-0 me-3">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-calendar-check text-success" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-2">Agendamiento Fácil</h5>
                        <p class="text-muted mb-0">
                            Sistema intuitivo para agendar citas con los especialistas disponibles en tiempo real.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-5" data-aos="fade-up" data-aos-delay="200">
                <div class="d-flex align-items-start p-3 rounded" style="transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.backgroundColor=''">
                    <div class="shrink-0 me-3">
                        <div class="rounded-circle bg-info bg-opacity-10 p-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-file-medical text-info" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-2">Historial Médico Digital</h5>
                        <p class="text-muted mb-0">
                            Accede a tu historial de consultas y mantén un registro completo de tu salud.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-5" data-aos="fade-up" data-aos-delay="300">
                <div class="d-flex align-items-start p-3 rounded" style="transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='#f8f9fa'" onmouseout="this.style.backgroundColor=''">
                    <div class="shrink-0 me-3">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-people text-warning" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-2">Múltiples Especialidades</h5>
                        <p class="text-muted mb-0">
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
    <div class="container py-4" style="max-width: 1200px;">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center" data-aos="zoom-in">
                <h2 class="display-5 fw-bold mb-4">¿Listo para comenzar?</h2>
                <p class="lead text-muted mb-4">
                    Regístrate hoy y accede a atención médica de calidad desde cualquier lugar
                </p>
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5 py-3">
                        <i class="bi bi-person-plus me-2"></i>Crear Cuenta
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg px-5 py-3">
                        Ya tengo cuenta
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endguest

<!-- Stats Section -->
<div class="py-5 text-white" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">
    <div class="container py-4" style="max-width: 1200px;">
        <div class="row text-center g-4 justify-content-center">
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="0">
                <div class="p-3">
                    <h2 class="display-4 fw-bold mb-2" style="color: #10b981;">1000+</h2>
                    <p class="text-white-50 mb-0">Consultas Realizadas</p>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
                <div class="p-3">
                    <h2 class="display-4 fw-bold mb-2" style="color: #0ea5e9;">50+</h2>
                    <p class="text-white-50 mb-0">Médicos Registrados</p>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="200">
                <div class="p-3">
                    <h2 class="display-4 fw-bold mb-2" style="color: #8b5cf6;">10</h2>
                    <p class="text-white-50 mb-0">Especialidades</p>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="300">
                <div class="p-3">
                    <h2 class="display-4 fw-bold mb-2" style="color: #f59e0b;">95%</h2>
                    <p class="text-white-50 mb-0">Satisfacción</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

