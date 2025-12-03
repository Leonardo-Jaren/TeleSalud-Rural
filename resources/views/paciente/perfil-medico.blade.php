@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Nuestros Médicos</h2>
    <p class="text-muted mb-4">Conoce a los especialistas disponibles en nuestra plataforma.</p>

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

    {{-- Mostrar médicos dinámicos o maqueta si no hay datos --}}
    <div class="row">
        @forelse($medicos ?? [] as $medico)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        {{-- Foto de perfil (placeholder si no existe) --}}
                        <img 
                            src="https://via.placeholder.com/100" 
                            class="rounded-circle mb-3" 
                            alt="Foto de {{ $medico->name }}"
                        >

                        {{-- Nombre del médico --}}
                        <h5 class="card-title">{{ $medico->name ?? 'Dr. Nombre' }}</h5>

                        {{-- Especialidad(es) --}}
                        @if($medico->doctor && $medico->doctor->specialties)
                            @foreach($medico->doctor->specialties as $specialty)
                                <h6 class="card-subtitle mb-2 text-primary">{{ $specialty->name }}</h6>
                            @endforeach
                        @else
                            <h6 class="card-subtitle mb-2 text-secondary">Especialidad no asignada</h6>
                        @endif

                        {{-- Número de colegiatura --}}
                        @if($medico->doctor && $medico->doctor->cmp_code)
                            <p class="card-text text-muted small">Nro. Colegiatura: {{ $medico->doctor->cmp_code }}</p>
                        @endif

                        {{-- Biografía --}}
                        @if($medico->doctor && $medico->doctor->bio)
                            <p class="card-text">{{ $medico->doctor->bio }}</p>
                        @else
                            <p class="card-text text-muted">Información del médico no disponible aún.</p>
                        @endif

                        {{-- Botones de acción --}}
                        <a href="#" class="btn btn-outline-secondary btn-sm">Ver Horarios</a>
                        <a href="{{ url('/paciente/reservar-cita?doctor_id=' . $medico->id) }}" class="btn btn-primary btn-sm">Agendar Cita</a>
                    </div>
                </div>
            </div>
        @empty
            {{-- Mostrar maqueta si no hay médicos en BD (durante desarrollo) --}}
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <img src="https://via.placeholder.com/100" class="rounded-circle mb-3" alt="Foto de perfil">
                        <h5 class="card-title">Dr. Ricardo Morales</h5>
                        <h6 class="card-subtitle mb-2 text-primary">Cardiología</h6>
                        <p class="card-text text-muted small">Nro. Colegiatura: 12345</p>
                        <p class="card-text">
                            "Especialista con 10 años de experiencia en salud cardiovascular. Comprometido con el bienestar del paciente."
                        </p>
                        <a href="#" class="btn btn-outline-secondary btn-sm">Ver Horarios</a>
                        <a href="{{ url('/paciente/reservar-cita') }}" class="btn btn-primary btn-sm">Agendar Cita</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <img src="https://via.placeholder.com/100" class="rounded-circle mb-3" alt="Foto de perfil">
                        <h5 class="card-title">Dra. Ana Fuentes</h5>
                        <h6 class="card-subtitle mb-2 text-primary">Medicina General</h6>
                        <p class="card-text text-muted small">Nro. Colegiatura: 23456</p>
                        <p class="card-text">
                            "Enfocada en la atención primaria y prevención. Lista para ayudarte con cualquier consulta general vía telemedicina."
                        </p>
                        <a href="#" class="btn btn-outline-secondary btn-sm">Ver Horarios</a>
                        <a href="{{ url('/paciente/reservar-cita') }}" class="btn btn-primary btn-sm">Agendar Cita</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <img src="https://via.placeholder.com/100" class="rounded-circle mb-3" alt="Foto de perfil">
                        <h5 class="card-title">Dr. Juan Torres</h5>
                        <h6 class="card-subtitle mb-2 text-primary">Dermatología</h6>
                        <p class="card-text text-muted small">Nro. Colegiatura: 34567</p>
                        <p class="card-text">
                            "Experto en salud de la piel y procedimientos dermatológicos. Atención presencial y remota."
                        </p>
                        <a href="#" class="btn btn-outline-secondary btn-sm">Ver Horarios</a>
                        <a href="{{ url('/paciente/reservar-cita') }}" class="btn btn-primary btn-sm">Agendar Cita</a>
                    </div>
                </div>
            </div>

            <div class="alert alert-info mt-3">
                <strong>Nota:</strong> Estás viendo datos de demostración. Cuando los médicos estén registrados en la base de datos, aparecerán aquí automáticamente.
            </div>
        @endforelse
    </div>

    <div class="text-start">
        <a href="{{ url('/paciente/dashboard') }}" class="btn btn-secondary mt-3">Volver al Dashboard</a>
    </div>

</div>
@endsection