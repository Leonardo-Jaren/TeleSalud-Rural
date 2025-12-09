<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TeleSalud Rural') }}</title>
    <meta name="description" content="Plataforma de telemedicina para comunidades rurales - Atención médica remota de calidad">

    <!-- Brand typography (Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Scripts and app assets -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- Branding stylesheet (overrides and tokens) -->
    <link rel="stylesheet" href="{{ asset('css/branding.css') }}">
    @stack('styles')
</head>
<body class="brand-root d-flex flex-column min-vh-100" style="font-family: 'Inter', sans-serif;">
    <div id="app" class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top navbar-professional">
            <div class="container" style="max-width: 1200px;">
                <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ url('/') }}">
                    <img src="{{ asset('logo.png') }}" alt="{{ config('app.name', 'TeleSalud') }}" class="logo-img me-2">
                    {{ config('app.name', 'TeleSalud') }}
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar - Navegación por Rol -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            @php $role = Auth::user()->rol ?? 'paciente'; @endphp

                            @if($role === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link px-3 py-2 rounded" href="{{ route('admin.dashboard') }}" style="transition: all 0.3s ease;">
                                        <i class="bi bi-speedometer2 me-2"></i>Administración
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-3 py-2 rounded" href="{{ route('admin.usuarios') }}" style="transition: all 0.3s ease;">
                                        <i class="bi bi-people me-2"></i>Usuarios
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-3 py-2 rounded" href="{{ route('admin.registrar-medico') }}" style="transition: all 0.3s ease;">
                                        <i class="bi bi-person-plus me-2"></i>Registrar Médico
                                    </a>
                                </li>
                            @endif

                            @if($role === 'medico')
                                <li class="nav-item">
                                    <a class="nav-link px-3 py-2 rounded" href="{{ url('medico/horarios') }}" style="transition: all 0.3s ease;">
                                        <i class="bi bi-calendar-check me-2"></i>Mis Horarios
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-3 py-2 rounded" href="{{ route('medico.perfil') }}" style="transition: all 0.3s ease;">
                                        <i class="bi bi-person-badge me-2"></i>Mi Perfil
                                    </a>
                                </li>
                            @endif

                            @if($role === 'paciente')
                                <li class="nav-item">
                                    <a class="nav-link px-3 py-2 rounded" href="{{ route('paciente.dashboard') }}" style="transition: all 0.3s ease;">
                                        <i class="bi bi-calendar-plus me-2"></i>Reservar Cita
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link px-3 py-2 rounded" href="{{ route('paciente.historial') }}" style="transition: all 0.3s ease;">
                                        <i class="bi bi-clock-history me-2"></i>Historial
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link px-3 text-primary auth-action" href="{{ route('login') }}">Iniciar Sesión</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-outline-primary btn-sm px-4 auth-action" href="{{ route('register') }}">Registrarse</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item d-flex align-items-center me-2">
                                <span class="badge rounded-pill px-3 py-2" style="background-color: rgba(255,255,255,0.2); font-weight: 500;">
                                    {{ ucfirst(Auth::user()->rol ?? 'paciente') }}
                                </span>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center px-3" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="bi bi-person-circle me-2" style="font-size: 1.25rem;"></i>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="navbarDropdown" style="min-width: 12rem;">
                                    <a class="dropdown-item py-2" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="@yield('mainClass','py-4') flex-grow-1">
            @yield('content')
        </main>

        @include('layouts.footer')
    </div>
    @stack('scripts')
</body>
</html>
