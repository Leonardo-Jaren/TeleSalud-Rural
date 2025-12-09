{{-- Navbar principal - Archivo separado para mejor mantenimiento --}}
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
            {{-- Left Side Of Navbar - Navegación por Rol --}}
            <ul class="navbar-nav me-auto">
                @auth
                    @php $role = Auth::user()->rol ?? 'paciente'; @endphp

                    @if($role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2 rounded" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-speedometer2 me-2"></i>Administración
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2 rounded" href="{{ route('admin.usuarios') }}">
                                <i class="bi bi-people me-2"></i>Usuarios
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2 rounded" href="{{ route('admin.registrar-medico') }}">
                                <i class="bi bi-person-plus me-2"></i>Registrar Médico
                            </a>
                        </li>
                    @endif

                    @if($role === 'medico')
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2 rounded" href="{{ route('medico.dashboard') }}">
                                <i class="bi bi-speedometer2 me-2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2 rounded" href="{{ route('medico.horarios') }}">
                                <i class="bi bi-calendar-check me-2"></i>Mis Horarios
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2 rounded" href="{{ route('medico.perfil') }}">
                                <i class="bi bi-person-badge me-2"></i>Mi Perfil
                            </a>
                        </li>
                    @endif

                    @if($role === 'paciente')
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2 rounded" href="{{ route('paciente.reservar-cita') }}">
                                <i class="bi bi-calendar-plus me-2"></i>Reservar Cita
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2 rounded" href="{{ route('paciente.historial') }}">
                                <i class="bi bi-clock-history me-2"></i>Historial
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2 rounded" href="{{ route('paciente.perfil-medico') }}">
                                <i class="bi bi-person-lines-fill me-2"></i>Médicos Disponibles
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>

            {{-- Right Side Of Navbar --}}
            <ul class="navbar-nav ms-auto">
                {{-- Authentication Links --}}
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
                        <span class="badge rounded-pill px-3 py-2" style="background-color: rgba(24,111,154,0.1); color: #186f9a; font-weight: 500;">
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

<style>
    .navbar-professional .nav-link {
        color: #374151;
        transition: all 0.2s ease;
    }
    .navbar-professional .nav-link:hover {
        color: #186f9a;
        background-color: rgba(24,111,154,0.06);
    }
    .navbar-professional .dropdown-item:hover {
        background-color: rgba(24,111,154,0.06);
    }
</style>
