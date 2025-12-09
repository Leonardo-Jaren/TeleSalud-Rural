@extends('layouts.app')

@section('content')
<div class="container py-4" style="max-width: 900px;">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item"><a href="{{ route('paciente.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('paciente.historial') }}">Historial</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detalle de Cita</li>
        </ol>
    </nav>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h4 class="mb-3">Detalle de la Cita</h4>

            <dl class="row">
                <dt class="col-sm-4">Especialidad</dt>
                <dd class="col-sm-8">{{ $cita->especialidad->nombre ?? 'N/A' }}</dd>

                <dt class="col-sm-4">Médico</dt>
                <dd class="col-sm-8">{{ $cita->medico->name ?? 'N/A' }}</dd>

                <dt class="col-sm-4">Fecha</dt>
                <dd class="col-sm-8">{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</dd>

                <dt class="col-sm-4">Hora</dt>
                <dd class="col-sm-8">{{ \Carbon\Carbon::parse($cita->hora)->format('h:i A') }}</dd>

                <dt class="col-sm-4">Modalidad</dt>
                <dd class="col-sm-8">{{ $cita->type === 'telemedicina' ? 'Telemedicina' : 'Presencial' }}</dd>

                <dt class="col-sm-4">Estado</dt>
                <dd class="col-sm-8">{{ ucfirst($cita->estado) }}</dd>

                <dt class="col-sm-4">Motivo</dt>
                <dd class="col-sm-8">{{ $cita->motivo ?? '-' }}</dd>
            </dl>

            <div class="d-flex gap-2">
                <a href="{{ route('paciente.historial') }}" class="btn btn-outline-secondary">Volver</a>
                @if($cita->estado !== 'cancelada' && now()->lt($cita->fecha_hora))
                    <a href="{{ route('paciente.cita.cancelar', $cita->id) }}" class="btn btn-danger">Cancelar</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
