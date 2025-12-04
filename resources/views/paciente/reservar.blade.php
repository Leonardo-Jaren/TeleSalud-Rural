@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Reservar Cita</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="doctor_id" class="form-label">Médico</label>
            <select name="doctor_id" id="doctor_id" class="form-select" required>
                <option value="">-- Seleccione un médico --</option>
                @foreach($medicos as $med)
                    <option value="{{ $med->id }}" {{ old('doctor_id') == $med->id ? 'selected' : '' }}>{{ $med->name }} ({{ $med->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="schedule_date" class="form-label">Fecha</label>
                <input type="date" name="schedule_date" id="schedule_date" class="form-control" value="{{ old('schedule_date') }}" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="schedule_time" class="form-label">Hora</label>
                <input type="time" name="schedule_time" id="schedule_time" class="form-control" value="{{ old('schedule_time') }}" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="type" class="form-label">Modalidad</label>
                <select name="type" id="type" class="form-select">
                    <option value="presencial">Presencial</option>
                    <option value="telemedicina">Telemedicina</option>
                </select>
            </div>
        </div>

        <button class="btn btn-primary">Reservar</button>
        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
