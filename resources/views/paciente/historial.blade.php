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
                            <th>Médico</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Modalidad</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($citas as $cita)
                        <tr>
                            <td>{{ $cita->doctor->name ?? 'N/A' }}</td>

                            <td>{{ \Carbon\Carbon::parse($cita->schedule_date)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($cita->schedule_time)->format('H:i') }}</td>

                            <td>{{ $cita->type === 'telemedicina' ? 'Telemedicina' : 'Presencial' }}</td>

                            <td>
                                @if($cita->status === 'confirmada')
                                    <span class="badge bg-success">Confirmada</span>
                                @elseif($cita->status === 'cancelada')
                                    <span class="badge bg-danger">Cancelada</span>
                                @elseif($cita->status === 'pendiente')
                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                @else
                                    <span class="badge bg-primary">{{ ucfirst($cita->status) }}</span>
                                @endif
                            </td>

                            <td>
                                {{-- Ver detalle simple --}}
                                <a href="#" class="btn btn-sm btn-outline-info">Ver</a>

                                {{-- Formulario para cancelar --}}
                                @if($cita->status !== 'cancelada')
                                    <form action="{{ route('appointments.cancel', $cita->id) }}" method="POST" style="display:inline-block">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Cancelar</button>
                                    </form>
                                @endif

                                @if($cita->type === 'telemedicina' && $cita->link_telemedicina)
                                    @php
                                        $fechaHora = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $cita->schedule_date . ' ' . $cita->schedule_time . ':00');
                                        $puedeEntrar = now()->greaterThanOrEqualTo($fechaHora->subMinutes(10));
                                    @endphp

                                    @if($puedeEntrar)
                                        <a href="{{ $cita->link_telemedicina }}" target="_blank" class="btn btn-sm btn-primary mt-1">Unirse</a>
                                    @else
                                        <span class="text-muted d-block mt-1" style="font-size: 0.85em;">Disponible 10 min antes</span>
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
