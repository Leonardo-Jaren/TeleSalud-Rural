@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Nuestros Médicos</h2>
    <p class="text-muted mb-4">Conoce a los especialistas disponibles en nuestra plataforma.</p>

    <div class="row">

        {{-- INICIO: Maqueta de Perfil de Médico 1 --}}
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    {{-- Simulación de foto de perfil --}}
                    <img src="https://via.placeholder.com/100" class="rounded-circle mb-3" alt="Foto de perfil">

                    {{-- Datos del User --}}
                    <h5 class="card-title">Dr. Ricardo Morales</h5>

                    {{-- Datos de Especialidad --}}
                    <h6 class="card-subtitle mb-2 text-primary">Cardiología</h6>

                    {{-- Datos de Medico --}}
                    <p class="card-text text-muted small">Nro. Colegiatura: 12345</p>
                    <p class="card-text">
                        {{-- Biografia (Medico) --}}
                        "Especialista con 10 años de experiencia en salud cardiovascular. Comprometido con el bienestar del paciente."
                    </p>

                    {{-- Botones de acción --}}
                    <a href="#" class="btn btn-outline-secondary btn-sm">Ver Horarios</a>
                    <a href="{{ url('/paciente/reservar-cita') }}" class="btn btn-primary btn-sm">Agendar Cita</a>
                </div>
            </div>
        </div>
        {{-- FIN: Maqueta de Perfil 1 --}}

        {{-- INICIO: Maqueta de Perfil de Médico 2 --}}
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
        {{-- FIN: Maqueta de Perfil 2 --}}

        {{-- INICIO: Maqueta de Perfil de Médico 3 --}}
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
        {{-- FIN: Maqueta de Perfil 3 --}}

    </div>

    <div class="text-start">
        <a href="{{ url('/paciente/dashboard') }}" class="btn btn-secondary mt-3">Volver al Dashboard</a>
    </div>

</div>
@endsection