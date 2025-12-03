@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h2>Dashboard - Paciente</h2>
        <p class="text-muted">Bienvenido a tu portal de telemedicina, {{ auth()->user()->name ?? 'Paciente' }}. Desde aquí podrás gestionar tus citas.</p>
    </div>

    {{-- Sección de Próxima Cita (Dinámica cuando Johan entregue) --}}
    @if(isset($proximaCita) && $proximaCita)
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="alert alert-success">
                    <h5 class="alert-heading">Próxima Cita</h5>
                    <p class="mb-0">
                        <strong>Médico:</strong> {{ $proximaCita->doctor->user->name ?? 'Por asignar' }} <br>
                        <strong>Fecha:</strong> {{ $proximaCita->schedule_date }} <br>
                        <strong>Hora:</strong> {{ $proximaCita->schedule_time }} <br>
                        <strong>Tipo:</strong> {{ ucfirst($proximaCita->type) }}
                        @if($proximaCita->type === 'telemedicina' && $proximaCita->link_telemedicina)
                            | <a href="{{ $proximaCita->link_telemedicina }}" target="_blank">Acceder a videollamada</a>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    @else
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="alert alert-info">
                    No tienes citas próximas. <a href="{{ url('/paciente/reservar-cita') }}">Agendar una ahora</a>
                </div>
            </div>
        </div>
    @endif

    {{-- Tarjetas de Acceso Rápido --}}
    <div class="row">

        {{-- Card para "Reservar Cita" --}}
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Reservar Cita</h5>
                    <p class="card-text">Agenda una nueva cita con nuestros especialistas.</p>
                    <a href="{{ url('/paciente/reservar-cita') }}" class="btn btn-primary">Agendar ahora</a>
                </div>
            </div>
        </div>

        {{-- Card para "Historial de Citas" --}}
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Historial de Citas</h5>
                    <p class="card-text">Revisa todas tus citas pasadas y futuras.</p>
                    <a href="{{ url('/paciente/historial') }}" class="btn btn-secondary">Ver historial</a>
                </div>
            </div>
        </div>

        {{-- Card para "Perfil del Médico" --}}
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Perfiles de Médicos</h5>
                    <p class="card-text">Conoce a los médicos disponibles.</p>
                    <a href="{{ url('/paciente/perfil-medico') }}" class="btn btn-info">Ver médicos</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection