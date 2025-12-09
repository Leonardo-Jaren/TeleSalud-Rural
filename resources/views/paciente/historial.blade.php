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
                            <td>{{ $cita->medico && $cita->medico->medico ? $cita->medico->medico->especialidades->pluck('nombre')->join(', ') : '-' }}</td>
                            <td>{{ $cita->medico ? $cita->medico->name : 'N/A' }}</td>
                            <td>{{ $cita->scheduled_at ? $cita->scheduled_at->format('d/m/Y H:i') : '-' }}</td>
                            <td>{{ $cita->type === 'telemedicina' ? 'Telemedicina' : 'Presencial' }}</td>
                            <td>
                                @if($cita->status === 'aceptada')
                                    <span class="badge bg-success">Aceptada</span>
                                @elseif($cita->status === 'pendiente')
                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                @elseif($cita->status === 'cancelada')
                                    <span class="badge bg-danger">Cancelada</span>
                                @else
                                    <span class="badge bg-primary">{{ ucfirst($cita->status) }}</span>
                                @endif
                            </td>
                            <td>
                                {{-- Ver detalle (no implementado) --}}
                                <a href="#" class="btn btn-sm btn-outline-info">Ver Detalle</a>

                                {{-- Cancelar si está pendiente --}}
                                @if($cita->status === 'pendiente')
                                    <form action="{{ route('paciente.cita.cancelar', $cita->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-danger">Cancelar</button>
                                    </form>
                                @endif

                                {{-- Telemedicina: permitir unirse si aceptada y hora cercana --}}
                                @if($cita->type === 'telemedicina' && $cita->status === 'aceptada')
                                    @php
                                        $ahora = \Carbon\now();
                                        $minAntes = $cita->scheduled_at ? $cita->scheduled_at->copy()->subMinutes(10) : null;
                                    @endphp
                                    @if($minAntes && $ahora->greaterThanOrEqualTo($minAntes))
                                        <a href="{{ $cita->telemedicine_link }}" target="_blank" class="btn btn-sm btn-primary">Unirse</a>
                                    @else
                                        <span class="text-muted d-block mt-1">Disponible 10 min antes</span>
                                    @endif
                                @endif
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No tienes citas registradas.</td>
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
