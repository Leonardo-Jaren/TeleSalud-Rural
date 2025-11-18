@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Reservar Nueva Cita</h4>
                </div>
                <div class="card-body">

                    <p class="card-text text-muted">Complete el formulario para agendar su cita.</p>

                    {{-- Como no hay BD, el 'action' no irá a ningún lado por ahora --}}
                    <form action="#" method="POST">
                        {{-- CSRF es necesario en formularios de Laravel, aunque este no envíe datos --}}
                        @csrf

                        {{-- Campo: Especialidad --}}
                        <div class="form-group mb-3">
                            <label for="especialidad" class="form-label">Especialidad</label>
                            <select class="form-control" id="especialidad" name="especialidad">
                                <option value="">-- Seleccione una especialidad --</option>
                                <option value="medicina_general">Medicina General</option>
                                <option value="cardiologia">Cardiología</option>
                                <option value="dermatologia">Dermatología</option>
                                <option value="pediatria">Pediatría</option>
                            </select>
                        </div>

                        {{-- Campo: Médico (Dependería de la especialidad, pero por ahora es un select simple) --}}
                        <div class="form-group mb-3">
                            <label for="medico" class="form-label">Médico</label>
                            <select class="form-control" id="medico" name="medico">
                                <option value="">-- Seleccione un médico --</option>
                                {{-- Estos datos estarían vacíos o vendrían de la BD --}}
                                <option value="1">Dr. Apellido (Cardiología)</option>
                                <option value="2">Dra. Apellido (Medicina General)</option>
                            </select>
                        </div>

                        {{-- Campo: Modalidad --}}
                        <div class="form-group mb-3">
                            <label class="form-label">Modalidad de Atención</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="modalidad" id="modalidad_presencial" value="presencial" checked>
                                <label class="form-check-label" for="modalidad_presencial">
                                    Presencial
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="modalidad" id="modalidad_remota" value="remota">
                                <label class="form-check-label" for="modalidad_remota">
                                    Remota (Teleconsulta)
                                </label>
                            </div>
                        </div>

                        {{-- Campo: Fecha --}}
                        <div class="form-group mb-3">
                            <label for="fecha" class="form-label">Fecha de la Cita</label>
                            <input type="date" class="form-control" id="fecha" name="fecha">
                        </div>

                        {{-- Campo: Motivo --}}
                        <div class="form-group mb-3">
                            <label for="motivo" class="form-label">Motivo de la Cita</slabel>
                            <textarea class="form-control" id="motivo" name="motivo" rows="3" placeholder="Describa brevemente sus síntomas..."></textarea>
                        </div>

                        {{-- Botones --}}
                        <div class="text-end">
                            <a href="{{ url('/paciente/dashboard') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Confirmar Cita</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection