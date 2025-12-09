@extends('layouts.app')

@section('content')
<div class="container py-4" style="max-width: 1200px;">
    {{-- Header --}}
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('paciente.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Historial de Citas</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2 class="h3 fw-bold mb-2">Historial de Citas</h2>
                <p class="text-muted mb-0">Consulta todas tus citas pasadas y futuras en un solo lugar.</p>
            </div>
            <a href="{{ route('paciente.reservar-cita') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Nueva Cita
            </a>
        </div>
    </div>

    {{-- Filtros --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-3">
            <div class="row g-3 align-items-center">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" placeholder="Buscar por médico o especialidad...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option value="">Todos los estados</option>
                        <option value="pendiente">Pendiente</option>
                        <option value="completada">Completada</option>
                        <option value="cancelada">Cancelada</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control" placeholder="Filtrar por fecha">
                </div>
                <div class="col-md-2 text-end">
                    <button class="btn btn-outline-primary w-100">
                        <i class="bi bi-funnel me-1"></i>Filtrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabla de Citas --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #f8fafc;">
                        <tr>
                            <th class="px-4 py-3 fw-semibold text-muted">Especialidad</th>
                            <th class="py-3 fw-semibold text-muted">Médico</th>
                            <th class="py-3 fw-semibold text-muted">Fecha y Hora</th>
                            <th class="py-3 fw-semibold text-muted">Modalidad</th>
                            <th class="py-3 fw-semibold text-muted">Estado</th>
                            <th class="py-3 fw-semibold text-muted text-end pe-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($citas as $cita)
                        <tr>
                            <td class="px-4">
                                <span class="fw-medium">{{ $cita->especialidad->nombre ?? 'N/A' }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 36px; height: 36px; background-color: rgba(14,165,233,0.1);">
                                        <i class="bi bi-person text-primary"></i>
                                    </div>
                                    <span>{{ $cita->medico->name ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="fw-medium">{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</span>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($cita->hora)->format('h:i A') }}</small>
                                </div>
                            </td>
                            <td>
                                @if($cita->type === 'telemedicina')
                                    <span class="badge rounded-pill" style="background-color: rgba(16,185,129,0.1); color: #10b981;">
                                        <i class="bi bi-camera-video me-1"></i>Telemedicina
                                    </span>
                                @else
                                    <span class="badge rounded-pill" style="background-color: rgba(14,165,233,0.1); color: #0ea5e9;">
                                        <i class="bi bi-building me-1"></i>Presencial
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($cita->estado === 'completada')
                                    <span class="badge bg-success rounded-pill">
                                        <i class="bi bi-check-circle me-1"></i>Completada
                                    </span>
                                @elseif($cita->estado === 'cancelada')
                                    <span class="badge bg-danger rounded-pill">
                                        <i class="bi bi-x-circle me-1"></i>Cancelada
                                    </span>
                                @elseif($cita->estado === 'pendiente')
                                    <span class="badge bg-warning text-dark rounded-pill">
                                        <i class="bi bi-clock me-1"></i>Pendiente
                                    </span>
                                @else
                                    <span class="badge bg-secondary rounded-pill">{{ ucfirst($cita->estado) }}</span>
                                @endif
                            </td>
                            <td class="pe-4">
                                <div class="d-flex justify-content-end gap-2 flex-wrap">
                                    <a href="{{ route('paciente.cita.detalle', $cita->id) }}" class="btn btn-sm btn-outline-primary" title="Ver Detalle">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    @if($cita->estado !== 'cancelada' && now()->lt($cita->fecha_hora))
                                        <a href="{{ route('paciente.cita.cancelar', $cita->id) }}" class="btn btn-sm btn-outline-danger" title="Cancelar">
                                            <i class="bi bi-x-lg"></i>
                                        </a>
                                    @endif

                                    @if($cita->estado !== 'cancelada' && $cita->estado !== 'completada')
                                        <a href="{{ route('paciente.cita.reprogramar', $cita->id) }}" class="btn btn-sm btn-outline-secondary" title="Reprogramar">
                                            <i class="bi bi-calendar2-event"></i>
                                        </a>
                                    @endif

                                    @if($cita->type === 'telemedicina')
                                        @php
                                            $fechaHora = \Carbon\Carbon::parse($cita->fecha . ' ' . $cita->hora);
                                            $puedeEntrar = now()->greaterThanOrEqualTo($fechaHora->subMinutes(10));
                                        @endphp

                                        @if($puedeEntrar)
                                            <a href="{{ $cita->telemedicine_link }}" target="_blank" class="btn btn-sm btn-success" title="Unirse a Videollamada">
                                                <i class="bi bi-camera-video-fill"></i>
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; background-color: rgba(14,165,233,0.1);">
                                        <i class="bi bi-calendar-x text-primary" style="font-size: 2rem;"></i>
                                    </div>
                                    <h6 class="fw-bold mb-2">No tienes citas registradas</h6>
                                    <p class="text-muted mb-3">Agenda tu primera cita con nuestros especialistas.</p>
                                    <a href="{{ route('paciente.reservar-cita') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-circle me-2"></i>Agendar Cita
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Leyenda --}}
    <div class="mt-4">
        <div class="d-flex flex-wrap gap-4 small text-muted">
            <span><i class="bi bi-eye me-1"></i>Ver detalle</span>
            <span><i class="bi bi-x-lg me-1"></i>Cancelar</span>
            <span><i class="bi bi-calendar2-event me-1"></i>Reprogramar</span>
            <span><i class="bi bi-camera-video-fill me-1"></i>Unirse a videollamada</span>
        </div>
    </div>
</div>
@endsection
