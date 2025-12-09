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

                    <form action="{{ route('paciente.reservar-cita.store') }}" method="POST">
                        {{-- CSRF es necesario en formularios de Laravel, aunque este no envíe datos --}}
                        @csrf

                            {{-- Campo: Especialidad --}}
                            <div class="form-group mb-3">
                                <label for="especialidad" class="form-label">Especialidad</label>
                                <select class="form-control @error('especialidad') is-invalid @enderror" id="especialidad" name="especialidad">
                                    <option value="">-- Seleccione una especialidad --</option>
                                    @if(!empty($especialidades) && $especialidades->count() > 0)
                                        @foreach($especialidades as $esp)
                                            <option value="{{ $esp->id }}" {{ old('especialidad') == $esp->id ? 'selected' : '' }}>{{ $esp->nombre }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('especialidad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Campo: Médico --}}
                            <div class="form-group mb-3">
                                <label for="medico" class="form-label">Médico</label>
                                <select class="form-control @error('medico') is-invalid @enderror" id="medico" name="medico">
                                    <option value="">-- Seleccione un médico --</option>
                                    @if(!empty($medicos) && $medicos->count() > 0)
                                        @foreach($medicos as $m)
                                            @php
                                                $espIds = $m->medico && $m->medico->especialidades ? $m->medico->especialidades->pluck('id')->toArray() : [];
                                                $dataEsp = implode(',', $espIds);
                                            @endphp
                                            <option value="{{ $m->id }}" data-especialidades="{{ $dataEsp }}" {{ (old('medico') && old('medico') == $m->id) || (isset($selectedDoctorId) && $selectedDoctorId == $m->id) ? 'selected' : '' }}>
                                                {{ $m->name }}@if($m->medico && $m->medico->especialidades->count()>0) ({{ $m->medico->especialidades->pluck('nombre')->join(', ') }})@endif
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                    @error('medico')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                            <input type="date" class="form-control @error('fecha') is-invalid @enderror" id="fecha" name="fecha" value="{{ old('fecha') }}">
                            @error('fecha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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

                    {{-- Script para filtrar médicos por especialidad y manejar doctor_id en query --}}
                    @push('scripts')
                    <script>
                        (function(){
                            const especialidadSelect = document.getElementById('especialidad');
                            const medicoSelect = document.getElementById('medico');

                            function filterMedicos() {
                                const espId = especialidadSelect.value;
                                for (const opt of medicoSelect.options) {
                                    if (!opt.value) continue; // placeholder
                                    const data = opt.getAttribute('data-especialidades') || '';
                                    if (!espId) {
                                        opt.style.display = '';
                                    } else {
                                        const list = data.split(',').filter(Boolean);
                                        if (list.includes(espId)) {
                                            opt.style.display = '';
                                        } else {
                                            opt.style.display = 'none';
                                            // if this option was selected but no longer valid, unselect it
                                            if (opt.selected) opt.selected = false;
                                        }
                                    }
                                }
                            }

                            especialidadSelect && especialidadSelect.addEventListener('change', filterMedicos);

                            // Si viene doctor preseleccionado, intentar seleccionar su especialidad en el select
                            const selectedDoctorId = @json($selectedDoctorId ?? '');
                            if (selectedDoctorId) {
                                const opt = medicoSelect.querySelector('option[value="' + selectedDoctorId + '"]');
                                if (opt) {
                                    const data = opt.getAttribute('data-especialidades') || '';
                                    const ids = data.split(',').filter(Boolean);
                                    if (ids.length === 1) {
                                        const espOpt = especialidadSelect.querySelector('option[value="' + ids[0] + '"]');
                                        if (espOpt) espOpt.selected = true;
                                    }
                                }
                            }

                            // Ejecutar filtrado inicial
                            filterMedicos();
                        })();
                    </script>
                    @endpush

                </div>
            </div>
        </div>
    </div>
</div>
@endsection