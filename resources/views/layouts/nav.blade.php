@php use Illuminate\Support\Facades\Auth; @endphp
<div class="bg-light border-bottom">
    <div class="container py-2">
        @if(Auth::check())
            @php $role = Auth::user()->role ?? 'paciente'; @endphp
            <ul class="nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Inicio</a></li>

                @if($role === 'admin')
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Administración</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.usuarios') }}">Usuarios</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.registrar-medico') }}">Registrar Médico</a></li>
                @endif

                @if($role === 'medico')
                    <li class="nav-item"><a class="nav-link" href="{{ route('medico.dashboard') }}">Mis Horarios</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Pacientes</a></li>
                @endif

                @if($role === 'paciente')
                    <li class="nav-item"><a class="nav-link" href="{{ route('paciente.dashboard') }}">Reservar Cita</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Historial</a></li>
                @endif

                <li class="nav-item ms-auto">
                    <span class="text-muted">Rol: {{ $role }}</span>
                </li>
            </ul>
        @endif
    </div>
</div>
