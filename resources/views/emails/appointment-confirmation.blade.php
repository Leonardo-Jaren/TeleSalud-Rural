@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 600px;">
    <div class="card">
        <div class="card-body">
            <h3 class="mb-3">Confirmación de Cita - TeleSalud Rural</h3>

            <p>Estimado/a <strong>{{ $patient->name ?? 'Paciente' }}</strong>,</p>

            <p>Tu cita ha sido reservada exitosamente. A continuación encontrarás los detalles:</p>

            <div class="alert alert-info">
                <h5>Detalles de tu Cita</h5>
                <ul>
                    <li><strong>Médico:</strong> {{ $doctor->name ?? 'Dr. Por asignar' }}</li>
                    <li><strong>Fecha:</strong> {{ $appointment->schedule_date ?? 'Por confirmar' }}</li>
                    <li><strong>Hora:</strong> {{ $appointment->schedule_time ?? 'Por confirmar' }}</li>
                    <li><strong>Tipo:</strong> {{ ucfirst($appointment->type ?? 'Presencial') }}</li>
                    <li><strong>Estado:</strong> <span class="badge bg-success">{{ ucfirst($appointment->status ?? 'Pendiente') }}</span></li>
                    @if($appointment->type === 'telemedicina' && $appointment->link_telemedicina)
                        <li><strong>Link de Telemedicina:</strong> <a href="{{ $appointment->link_telemedicina }}">Acceder aquí</a></li>
                    @endif
                </ul>
            </div>

            <p>Si necesitas cancelar o reprogramar tu cita, puedes hacerlo desde tu dashboard.</p>

            <p>
                <a href="{{ url('/paciente/dashboard') }}" class="btn btn-primary">Ver tu Dashboard</a>
            </p>

            <hr>

            <p class="text-muted small">Este es un correo automático. Por favor, no responder a este mensaje.</p>
        </div>
    </div>
</div>
@endsection
