@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0">Nuestros Médicos</h2>
            <p class="text-muted mb-0">Especialistas disponibles en la plataforma.</p>
        </div>
        <div>
            <a href="{{ url('/paciente/dashboard') }}" class="btn btn-secondary">Volver al Dashboard</a>
        </div>
    </div>

    {{-- Barra de búsqueda por especialidad --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <form method="GET" action="{{ route('paciente.search-doctors') }}" class="input-group">
                <input 
                    type="text" 
                    class="form-control" 
                    name="especialidad" 
                    placeholder="Buscar por especialidad (ej: Cardiología)"
                    value="{{ $especialidadFiltro ?? '' }}"
                >
                <button class="btn btn-outline-primary" type="submit">Buscar</button>
            </form>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('paciente.perfil-medico') }}" class="btn btn-outline-secondary">Limpiar filtro</a>
        </div>
    </div>

    <div class="row">
        @forelse($medicos ?? [] as $medico)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        {{-- Avatar: usar avatar del usuario si existe, sino placeholder local --}}
                        <img 
                            src="{{ $medico->avatar ? asset('storage/' . $medico->avatar) : asset('images/avatar-placeholder.png') }}" 
                            class="rounded-circle mb-3" 
                            alt="Foto de {{ $medico->name }}"
                            style="width:100px;height:100px;object-fit:cover"
                        >

                        <h5 class="card-title">{{ $medico->name }}</h5>

                        {{-- Especialidades (usando relación User->medico->especialidades) --}}
                        @if($medico->medico && $medico->medico->especialidades->count() > 0)
                            <p class="mb-1 text-primary small">
                                {{ $medico->medico->especialidades->pluck('nombre')->join(', ') }}
                            </p>
                        @else
                            <p class="mb-1 text-secondary small">Especialidad no asignada</p>
                        @endif

                        {{-- Código CMP y biografía desde modelo Doctor --}}
                        @if($medico->medico && $medico->medico->codigo_cmp)
                            <p class="card-text text-muted small mb-1">Nro. Colegiatura: {{ $medico->medico->codigo_cmp }}</p>
                        @endif

                        @if($medico->medico && $medico->medico->biografia)
                            <p class="card-text small">{{ Str::limit($medico->medico->biografia, 140) }}</p>
                        @else
                            <p class="card-text text-muted small">Biografía no disponible.</p>
                        @endif

                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <a href="#" class="btn btn-outline-secondary btn-sm">Ver Horarios</a>
                            <a href="{{ url('/paciente/reservar-cita?doctor_id=' . $medico->id) }}" class="btn btn-primary btn-sm">Agendar Cita</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    No hay médicos registrados actualmente. Contacta al administrador si crees que esto es un error.
                </div>
            </div>
        @endforelse
    </div>

    {{-- Opcional: listado de especialidades como filtros rápidos --}}
    @if(!empty($especialidades) && $especialidades->count() > 0)
        <div class="mt-4">
            <h6>Filtrar por especialidad</h6>
            <div class="d-flex flex-wrap gap-2">
                @foreach($especialidades as $esp)
                    <a href="{{ route('paciente.doctors-by-specialty', $esp->id) }}" class="btn btn-sm btn-outline-secondary">{{ $esp->nombre }}</a>
                @endforeach
            </div>
        </div>
    @endif

</div>
@endsection