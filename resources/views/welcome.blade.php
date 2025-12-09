@extends('layouts.app')

@section('mainClass', '')

@section('content')
    <!-- Hero Section -->
    <div class="hero-section"
        style="background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%); color: white; min-height: 100vh; display: flex; align-items: center; overflow: hidden; position: relative;">
        <div class="container" style="max-width: 1200px;">
            <div
                style="display: flex; align-items: center; justify-content: space-between; width: 100%; flex-wrap: wrap;">
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
                            $dashboardRoute = match ($role) {
                                'admin' => route('admin.dashboard'),
                                'medico' => route('medico.dashboard'),
                                default => route('paciente.dashboard'),
                            };
                        @endphp
                        <a href="{{ $dashboardRoute }}" class="btn btn-light btn-lg px-5 py-3 shadow-sm">
                            <i class="bi bi-speedometer2 me-2"></i>Ir a mi Dashboard
                        </a>
                    @endguest
                </div>
                <div style="flex: 0 0 350px; display: flex; justify-content: center; align-items: center;"
                    class="d-none d-lg-flex" data-aos="fade-left">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 300px; height: 300px; opacity: 0.9;"
                        viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
                        <circle cx="12" cy="12" r="10" stroke-width="0.5" fill="rgba(255,255,255,0.1)" />
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" transform="translate(6, -3)" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                </div>
                <!-- Divisor futurista -->
                <div class="tech-divider">
                    <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
                        <path
                            d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"
                            opacity=".25"></path>
                        <path
                            d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z"
                            opacity=".5"></path>
                        <path
                            d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z">
                        </path>
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
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
                    <div class="card h-100 border-0 shadow-sm"
                        style="transition: transform 0.3s ease, box-shadow 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'"
                        onmouseout="this.style.transform=''; this.style.boxShadow=''">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 80px; height: 80px; background-color: rgba(16, 185, 129, 0.1);">
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
                    <div class="card h-100 border-0 shadow-sm"
                        style="transition: transform 0.3s ease, box-shadow 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'"
                        onmouseout="this.style.transform=''; this.style.boxShadow=''">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 80px; height: 80px; background-color: rgba(14, 165, 233, 0.1);">
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
                    <div class="card h-100 border-0 shadow-sm"
                        style="transition: transform 0.3s ease, box-shadow 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'"
                        onmouseout="this.style.transform=''; this.style.boxShadow=''">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 80px; height: 80px; background-color: rgba(139, 92, 246, 0.1);">
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
                    <div class="card h-100 border-0 shadow-sm"
                        style="transition: transform 0.3s ease, box-shadow 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)'"
                        onmouseout="this.style.transform=''; this.style.boxShadow=''">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start">
                                <div class="shrink-0 me-3">
                                    <div class="rounded-circle bg-primary bg-opacity-10 p-3"
                                        style="width: 65px; height: 65px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-camera-video text-primary" style="font-size: 1.5rem;"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-2">Consultas por Videollamada</h5>
                                    <p class="text-muted mb-0">
                                        Realiza consultas médicas desde la comodidad de tu hogar mediante videollamadas
                                        seguras.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100 border-0 shadow-sm"
                        style="transition: transform 0.3s ease, box-shadow 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)'"
                        onmouseout="this.style.transform=''; this.style.boxShadow=''">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start">
                                <div class="shrink-0 me-3">
                                    <div class="rounded-circle bg-success bg-opacity-10 p-3"
                                        style="width: 65px; height: 65px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-calendar-check text-success" style="font-size: 1.5rem;"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-2">Agendamiento Fácil</h5>
                                    <p class="text-muted mb-0">
                                        Sistema intuitivo para agendar citas con los especialistas disponibles en tiempo
                                        real.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5" data-aos="fade-up" data-aos-delay="200">
                    <div class="card h-100 border-0 shadow-sm"
                        style="transition: transform 0.3s ease, box-shadow 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)'"
                        onmouseout="this.style.transform=''; this.style.boxShadow=''">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start">
                                <div class="shrink-0 me-3">
                                    <div class="rounded-circle bg-info bg-opacity-10 p-3"
                                        style="width: 65px; height: 65px; display: flex; align-items: center; justify-content: center;">
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
                    <div class="card h-100 border-0 shadow-sm"
                        style="transition: transform 0.3s ease, box-shadow 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)'"
                        onmouseout="this.style.transform=''; this.style.boxShadow=''">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start">
                                <div class="shrink-0 me-3">
                                    <div class="rounded-circle bg-warning bg-opacity-10 p-3"
                                        style="width: 65px; height: 65px; display: flex; align-items: center; justify-content: center;">
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

    <!-- Stats Section (mejorada: tarjetas glass para distinguir del footer) -->
    <div class="py-5 stats-section" style="background: linear-gradient(135deg, #f8fafc 0%, #eef2f7 100%);">
        <div class="container py-5" style="max-width: 1200px;">
            <div class="text-center mb-4" data-aos="fade-up">
                <h2 class="display-5 fw-bold text-dark mb-2">Nuestro Impacto</h2>
                <p class="lead text-muted mb-0">Resultados que marcan la diferencia para las comunidades</p>
            </div>

            <div class="row g-4 justify-content-center mt-4">
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="0">
                    <div class="stats-card p-4 text-center">
                        <div class="stat-number fw-bold mb-2 text-success">1000+</div>
                        <div class="text-muted stat-label">Consultas Realizadas</div>
                    </div>
                </div>

                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="stats-card p-4 text-center">
                        <div class="stat-number fw-bold mb-2 text-info">50+</div>
                        <div class="text-muted stat-label">Médicos Registrados</div>
                    </div>
                </div>

                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="stats-card p-4 text-center">
                        <div class="stat-number fw-bold mb-2 text-purple">10</div>
                        <div class="text-muted stat-label">Especialidades</div>
                    </div>
                </div>

                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="stats-card p-4 text-center">
                        <div class="stat-number fw-bold mb-2 text-warning">95%</div>
                        <div class="text-muted stat-label">Satisfacción</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* Tech Divider */
        .tech-divider {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
        }

        .tech-divider svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 80px;
            fill: #f8f9fa;
        }
        /* Stats section styles */
        .stats-section { position: relative; }
        .stats-card{
            background: #ffffff;
            border: 1px solid rgba(2,6,23,0.06);
            border-radius: 12px;
            min-height: 120px;
            display:flex; align-items:center; justify-content:center; flex-direction:column;
            transition: transform .18s ease, box-shadow .18s ease;
            box-shadow: 0 4px 12px rgba(2,6,23,0.06);
        }
        .stats-card:hover{ transform: translateY(-6px); box-shadow: 0 14px 40px rgba(2,6,23,0.08); }
        .stat-number{ font-size:2.25rem; line-height:1; color: #0f172a; }
        .stat-label{ font-size:0.98rem; }
        .text-purple{ color: #8b5cf6 !important; }
        @media (max-width: 575.98px){
            .stat-number{ font-size:1.5rem }
            .stats-card{ min-height: 100px }
        }
    </style>
@endsection
