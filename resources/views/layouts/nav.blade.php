@php use Illuminate\Support\Facades\Auth; @endphp
@if(Auth::check())
<div class="bg-white border-bottom">
    <div class="container" style="max-width: 1200px;">
        @php $role = Auth::user()->role ?? 'paciente'; @endphp
        <nav class="secondary-nav" aria-label="Navegación secundaria">
            <ul class="nav d-flex flex-column flex-sm-row align-items-center gap-2 gap-sm-3 py-2 m-0">
                @if($role === 'admin')
                    <li class="nav-item"><a class="nav-link px-3 py-2 rounded text-muted" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-1"></i>Administración</a></li>
                    <li class="nav-item"><a class="nav-link px-3 py-2 rounded text-muted" href="{{ route('admin.usuarios') }}"><i class="bi bi-people me-1"></i>Usuarios</a></li>
                    <li class="nav-item"><a class="nav-link px-3 py-2 rounded text-muted" href="{{ route('admin.registrar-medico') }}"><i class="bi bi-person-plus me-1"></i>Registrar Médico</a></li>
                @endif

                @if($role === 'medico')
                    <li class="nav-item"><a class="nav-link px-3 py-2 rounded text-muted" href="{{ route('medico.dashboard') }}"><i class="bi bi-calendar-check me-1"></i>Mis Horarios</a></li>
                    <li class="nav-item"><a class="nav-link px-3 py-2 rounded text-muted" href="#"><i class="bi bi-people-fill me-1"></i>Pacientes</a></li>
                @endif

                @if($role === 'paciente')
                    <li class="nav-item"><a class="nav-link px-3 py-2 rounded text-muted" href="{{ route('paciente.dashboard') }}"><i class="bi bi-calendar-plus me-1"></i>Reservar Cita</a></li>
                    <li class="nav-item"><a class="nav-link px-3 py-2 rounded text-muted" href="#"><i class="bi bi-clock-history me-1"></i>Historial</a></li>
                @endif

                <li class="nav-item ms-sm-auto">
                    <span class="badge rounded-pill bg-light text-dark px-3 py-2">{{ ucfirst($role) }}</span>
                </li>
            </ul>
        </nav>
    </div>
</div>
@endif

<style>
.secondary-nav .nav-link { color: #374151; transition: all 0.15s ease; }
.secondary-nav .nav-link:hover { color: #0b1220; background-color: rgba(14,165,233,0.06); transform: translateY(-1px); }
.secondary-nav .badge { font-weight: 600; }
@media (max-width: 575.98px) {
    .secondary-nav .nav-link { width: 100%; text-align: center; }
    .secondary-nav .nav-item.ms-sm-auto { margin-left: 0 !important; }
}
</style>
