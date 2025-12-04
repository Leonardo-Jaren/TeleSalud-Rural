@extends('layouts.app')

@section('title', 'Médico - Citas del día')

@section('content')
<link rel="stylesheet" href="{{ asset('css/branding.css') }}">

<div class="py-3">
    <h1 class="h3 mb-3">Citas del día</h1>

    <div class="card">
        <div class="card-body">
            <p class="text-muted">Listado de citas reales. Si la cita es de telemedicina verás el botón para unirse.</p>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Hora</th>
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
                            <td>{{ \Carbon\Carbon::parse($cita->hora)->format('H:i') }}</td>

                            <td>{{ $cita->paciente->name ?? 'Paciente' }}</td>

                            <td>{{ $cita->motivo ?? 'Sin motivo' }}</td>

                            <td>
                                {{ $cita->type === 'telemedicina' ? 'Telemedicina' : 'Presencial' }}
                            </td>

                            <td>
                                @if($cita->estado === 'confirmada')
                                    <span class="badge bg-success">Confirmada</span>
                                @elseif($cita->estado === 'pendiente')
                                    <span class="badge bg-warning">Pendiente</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($cita->estado) }}</span>
                                @endif
                            </td>

                            <td>
                                {{-- BOTÓN TELEMEDICINA --}}
                                @if($cita->type === 'telemedicina')
                                    <a href="{{ $cita->telemedicine_link }}" target="_blank"
                                       class="btn btn-sm btn-primary">
                                        Unirse a Videollamada
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">
                                No tienes citas para hoy.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>

@endsection
