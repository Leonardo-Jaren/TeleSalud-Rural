@extends('layouts.app')

@section('title', 'Médico - Horarios')

@section('content')
<link rel="stylesheet" href="{{ asset('css/branding.css') }}">

<div class="py-3">
  <h1 class="h3 mb-3">Gestión de Horarios</h1>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <ul class="mb-0">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <!-- Formulario para agregar nuevo horario -->
  <div class="card mb-4">
    <div class="card-body">
      <h5 class="card-title mb-3">Agregar Nuevo Horario</h5>
      <form method="POST" action="{{ route('medico.horarios.guardar') }}">
        @csrf
        <div class="row">
          <div class="col-md-3">
            <label for="dia" class="form-label">Día <span class="text-danger">*</span></label>
            <select class="form-select @error('dia') is-invalid @enderror" id="dia" name="dia" required>
              <option value="">Seleccionar...</option>
              <option value="Lunes">Lunes</option>
              <option value="Martes">Martes</option>
              <option value="Miércoles">Miércoles</option>
              <option value="Jueves">Jueves</option>
              <option value="Viernes">Viernes</option>
              <option value="Sábado">Sábado</option>
              <option value="Domingo">Domingo</option>
            </select>
            @error('dia')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-3">
            <label for="hora_inicio" class="form-label">Hora Inicio <span class="text-danger">*</span></label>
            <input type="time" class="form-control @error('hora_inicio') is-invalid @enderror" id="hora_inicio" name="hora_inicio" required>
            @error('hora_inicio')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-3">
            <label for="hora_fin" class="form-label">Hora Fin <span class="text-danger">*</span></label>
            <input type="time" class="form-control @error('hora_fin') is-invalid @enderror" id="hora_fin" name="hora_fin" required>
            @error('hora_fin')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Agregar Horario</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Tabla de horarios existentes -->
  <div class="card">
    <div class="card-body">
      <h5 class="card-title mb-3">Horarios Actuales</h5>
      @if($horarios->count() > 0)
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Día</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($horarios as $horario)
                <tr>
                  <td>{{ $horario->dia }}</td>
                  <td>{{ \Carbon\Carbon::parse($horario->hora_inicio)->format('H:i') }}</td>
                  <td>{{ \Carbon\Carbon::parse($horario->hora_fin)->format('H:i') }}</td>
                  <td>
                    <form method="POST" action="{{ route('medico.horarios.eliminar', $horario->id) }}" class="d-inline" onsubmit="return confirm('¿Está seguro de eliminar este horario?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <p class="text-muted mb-0">No hay horarios registrados. Agregue un nuevo horario usando el formulario de arriba.</p>
      @endif
    </div>
  </div>
</div>

@endsection
