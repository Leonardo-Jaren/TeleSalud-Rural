@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Mi Dashboard (Paciente)</h2>
    <p>Bienvenido a tu portal. Desde aquí podrás gestionar tus citas.</p>

    <div class="row">

        {{-- Card para "Reservar Cita" --}}
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Reservar Cita</h5>
                    <p class="card-text">Agenda una nueva cita con nuestros especialistas.</p>
                    {{-- Este link AHORA apunta a tu nueva RUTA --}}
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