@extends('layouts.app')

@section('content')
<div class="container py-4" style="max-width: 1200px;">
    {{-- Header --}}
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('paciente.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Reservar Cita</li>
            </ol>
        </nav>
        <h2 class="h3 fw-bold mb-2">Reservar Nueva Cita</h2>
        <p class="text-muted mb-0">Complete el formulario para agendar su consulta médica.</p>
    </div>

    <div class="row g-4">
        {{-- Formulario Principal --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('paciente.reservar-cita.store') }}" method="POST">
                        @csrf

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <div class="row g-3">
                            {{-- Campo: Especialidad --}}
                            <div class="col-md-6">
                                <label for="especialidad" class="form-label fw-semibold">
                                    <i class="bi bi-bandaid me-1 text-primary"></i>Especialidad
                                </label>
                                <select class="form-select" id="especialidad" name="especialidad" required>
                                    <option value="">-- Seleccione una especialidad --</option>
                                    <option value="medicina_general">Medicina General</option>
                                    <option value="cardiologia">Cardiología</option>
                                    <option value="dermatologia">Dermatología</option>
                                    <option value="pediatria">Pediatría</option>
                                </select>
                            </div>

                            {{-- Campo: Médico --}}
                            <div class="col-md-6">
                                <label for="medico" class="form-label fw-semibold">
                                    <i class="bi bi-person-badge me-1 text-primary"></i>Médico
                                </label>
                                <select class="form-select" id="medico" name="medico" required>
                                    <option value="">-- Seleccione un médico --</option>
                                    <option value="1">Dr. Apellido (Cardiología)</option>
                                    <option value="2">Dra. Apellido (Medicina General)</option>
                                </select>
                            </div>

                            {{-- Campo: Fecha --}}
                            <div class="col-md-6">
                                <label for="fecha" class="form-label fw-semibold">
                                    <i class="bi bi-calendar3 me-1 text-primary"></i>Fecha de la Cita
                                </label>
                                <input type="date" class="form-control" id="fecha" name="fecha" required>
                            </div>

                            {{-- Campo: Hora --}}
                            <div class="col-md-6">
                                <label for="hora" class="form-label fw-semibold">
                                    <i class="bi bi-clock me-1 text-primary"></i>Hora Disponible
                                </label>
                                <select class="form-select" id="hora" name="hora" required>
                                    <option value="">-- Seleccione un horario --</option>
                                    <option value="09:00">09:00 AM</option>
                                    <option value="10:00">10:00 AM</option>
                                    <option value="11:00">11:00 AM</option>
                                    <option value="14:00">02:00 PM</option>
                                    <option value="15:00">03:00 PM</option>
                                </select>
                            </div>

                            {{-- Campo: Modalidad --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-laptop me-1 text-primary"></i>Modalidad de Atención
                                </label>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-check card border-0 shadow-sm p-3 h-100">
                                            <input class="form-check-input" type="radio" name="modalidad" id="modalidad_presencial" value="presencial" checked>
                                            <label class="form-check-label d-flex align-items-center ms-2" for="modalidad_presencial">
                                                <div class="rounded-circle d-inline-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; background-color: rgba(14,165,233,0.1);">
                                                    <i class="bi bi-building text-primary" style="font-size: 1.25rem;"></i>
                                                </div>
                                                <div>
                                                    <strong class="d-block">Presencial</strong>
                                                    <small class="text-muted">Asiste al centro de salud</small>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check card border-0 shadow-sm p-3 h-100">
                                            <input class="form-check-input" type="radio" name="modalidad" id="modalidad_remota" value="telemedicina">
                                            <label class="form-check-label d-flex align-items-center ms-2" for="modalidad_remota">
                                                <div class="rounded-circle d-inline-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px; background-color: rgba(16,185,129,0.1);">
                                                    <i class="bi bi-camera-video text-success" style="font-size: 1.25rem;"></i>
                                                </div>
                                                <div>
                                                    <strong class="d-block">Telemedicina</strong>
                                                    <small class="text-muted">Consulta por videollamada</small>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Campo: Motivo --}}
                            <div class="col-12">
                                <label for="motivo" class="form-label fw-semibold">
                                    <i class="bi bi-chat-left-text me-1 text-primary"></i>Motivo de la Consulta
                                </label>
                                <textarea class="form-control" id="motivo" name="motivo" rows="4" placeholder="Describa brevemente sus síntomas o motivo de consulta..."></textarea>
                                <div class="form-text">Esta información ayudará al médico a preparar mejor su consulta.</div>
                            </div>
                        </div>

                        {{-- Botones --}}
                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                            <a href="{{ route('paciente.dashboard') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-check-circle me-2"></i>Confirmar Cita
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Panel Lateral de Información --}}
        <div class="col-lg-4">
            {{-- Info Card --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-info-circle me-2 text-primary"></i>Información Importante
                    </h6>
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex mb-3">
                            <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                            <span class="text-muted small">Recibirás una confirmación por email al agendar tu cita.</span>
                        </li>
                        <li class="d-flex mb-3">
                            <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                            <span class="text-muted small">Puedes cancelar o reprogramar hasta 24 horas antes.</span>
                        </li>
                        <li class="d-flex">
                            <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                            <span class="text-muted small">Para telemedicina, recibirás el enlace en tu correo.</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Contact Card --}}
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);">
                <div class="card-body p-4 text-white">
                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-headset me-2"></i>¿Necesitas Ayuda?
                    </h6>
                    <p class="small opacity-90 mb-3">
                        Si tienes dudas sobre cómo agendar tu cita, contáctanos.
                    </p>
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-telephone me-2"></i>
                        <span class="small">+51 123 456 789</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-envelope me-2"></i>
                        <span class="small">soporte@telesalud.com</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection