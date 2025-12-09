@extends('layouts.app')

@section('title', 'Médico - Citas')

@section('content')
<link rel="stylesheet" href="{{ asset('css/branding.css') }}">

<div class="py-3">
    <h1 class="h3 mb-3">Mis Citas</h1>

    <div class="card">
        <div class="card-body">
            <p class="text-muted">Listado de citas reales. Si la cita es de telemedicina verás el botón para unirse.</p>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Fecha / Hora</th>
                            <th>Paciente</th>
                            <th>Motivo</th>
                            <th>Modalidad</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($citas as $cita)
                        <tr>
                            <td>{{ $cita->scheduled_at ? $cita->scheduled_at->format('d/m/Y H:i') : '-' }}</td>
                            <td>{{ $cita->paciente ? $cita->paciente->name : 'Paciente' }}</td>
                            <td>{{ $cita->motivo ?? 'Sin motivo' }}</td>
                            <td>{{ $cita->type === 'telemedicina' ? 'Telemedicina' : 'Presencial' }}</td>
                            <td>
                                @if($cita->status === 'aceptada')
                                    <span class="badge bg-success">Aceptada</span>
                                @elseif($cita->status === 'pendiente')
                                    <span class="badge bg-warning">Pendiente</span>
                                @elseif($cita->status === 'cancelada')
                                    <span class="badge bg-secondary">Cancelada</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($cita->status) }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    @if($cita->status === 'pendiente')
                                        <form action="{{ route('medico.citas.aceptar', $cita->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-success">Aceptar</button>
                                        </form>
                                        <form action="{{ route('medico.citas.rechazar', $cita->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-danger">Rechazar</button>
                                        </form>
                                    @else
                                        @if($cita->type === 'telemedicina' && $cita->status === 'aceptada')
                                            <a href="{{ $cita->telemedicine_link }}" target="_blank" class="btn btn-sm btn-primary">Unirse</a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">No tienes citas.</td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>

@endsection
