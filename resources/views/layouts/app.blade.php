<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Brand typography (Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Scripts and app assets -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- Branding stylesheet (overrides and tokens) -->
    <link rel="stylesheet" href="{{ asset('css/branding.css') }}">
    @stack('styles')
</head>
<body class="brand-root d-flex flex-column min-vh-100">
    <div id="app" class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-md navbar-brand-bg">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <span class="logo">TS</span>
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar - Navegación por Rol -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            @php $role = Auth::user()->rol ?? 'paciente'; @endphp
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">
                                    <i class="bi bi-house-door me-1"></i>Inicio
                                </a>
                            </li>

                            @if($role === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-1"></i>Administración
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.usuarios') }}">
                                        <i class="bi bi-people me-1"></i>Usuarios
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.registrar-medico') }}">
                                        <i class="bi bi-person-plus me-1"></i>Registrar Médico
                                    </a>
                                </li>
                            @endif

                            @if($role === 'medico')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('medico.dashboard') }}">
                                        <i class="bi bi-calendar-check me-1"></i>Mis Horarios
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('medico.perfil') }}">
                                        <i class="bi bi-person-badge me-1"></i>Mi Perfil
                                    </a>
                                </li>
                            @endif

                            @if($role === 'paciente')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('paciente.dashboard') }}">
                                        <i class="bi bi-calendar-plus me-1"></i>Reservar Cita
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('paciente.historial') }}">
                                        <i class="bi bi-clock-history me-1"></i>Historial
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
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <span class="navbar-text me-3">
                                    <span class="badge bg-light text-dark">{{ ucfirst(Auth::user()->rol ?? 'paciente') }}</span>
                                </span>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
