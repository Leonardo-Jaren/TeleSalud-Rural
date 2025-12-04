@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Historial de Citas</h2>

    <div class="card">
        <div class="card-body">
            <p class="card-text text-muted">
                Aquí puedes ver tus citas pasadas y futuras. Si la cita es por telemedicina,
                podrás unirte cuando se acerque la hora.
            </p>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Especialidad</th>
                            <th>Médico</th>
                            <th>Fecha y Hora</th>
                            <th>Modalidad</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($citas as $cita)
                        <tr>
                            <td>{{ $cita->especialidad->nombre ?? 'N/A' }}</td>

                            <td>{{ $cita->medico->name ?? 'N/A' }}</td>

                            <td>
                                {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}
                                {{ \Carbon\Carbon::parse($cita->hora)->format('h:i A') }}
                            </td>

                            <td>{{ $cita->type === 'telemedicina' ? 'Telemedicina' : 'Presencial' }}</td>

                            <td>
                                @if($cita->estado === 'completada')
                                    <span class="badge bg-success">Completada</span>
                                @elseif($cita->estado === 'cancelada')
                                    <span class="badge bg-danger">Cancelada</span>
                                @elseif($cita->estado === 'pendiente')
                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                @else
                                    <span class="badge bg-primary">{{ ucfirst($cita->estado) }}</span>
                                @endif
                            </td>

                            <td>
                                {{-- Botón Ver Detalle --}}
                                <a href="{{ route('paciente.cita.detalle', $cita->id) }}"
                                   class="btn btn-sm btn-outline-info">
                                   Ver Detalle
                                </a>

                                {{-- Botón Cancelar (si aún no pasó) --}}
                                @if($cita->estado !== 'cancelada' && now()->lt($cita->fecha_hora))
                                    <a href="{{ route('paciente.cita.cancelar', $cita->id) }}"
                                       class="btn btn-sm btn-outline-danger">
                                       Cancelar
                                    </a>
                                @endif

                                {{-- Botón Reprogramar --}}
                                @if($cita->estado !== 'cancelada' && $cita->estado !== 'completada')
                                    <a href="{{ route('paciente.cita.reprogramar', $cita->id) }}"
                                       class="btn btn-sm btn-outline-secondary">
                                       Reprogramar
                                    </a>
                                @endif

                                {{-- SOLO TELEMEDICINA --}}
                                @if($cita->type === 'telemedicina')
                                    @php
                                        $fechaHora = \Carbon\Carbon::parse($cita->fecha . ' ' . $cita->hora);
                                        // Permitir entrar 10 minutos antes
                                        $puedeEntrar = now()->greaterThanOrEqualTo($fechaHora->subMinutes(10));
                                    @endphp

                                    @if($puedeEntrar)
                                        <a href="{{ $cita->telemedicine_link }}"
                                           target="_blank"
                                           class="btn btn-sm btn-primary mt-1">
                                           Unirse a Videollamada
                                        </a>
                                    @else
                                        <span class="text-muted d-block mt-1" style="font-size: 0.85em;">
                                            Disponible 10 min antes
                                        </span>
                                    @endif
                                @endif
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                No tienes citas registradas.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <a href="{{ url('/paciente/dashboard') }}" class="btn btn-secondary mt-3">
                Volver al Dashboard
            </a>

        </div>
    </div>
</div>
@endsection
