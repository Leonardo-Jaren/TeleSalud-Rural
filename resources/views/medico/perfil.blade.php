@extends('layouts.app')

@section('title', 'Médico - Perfil')

@section('content')

<div class="container py-4" style="max-width: 1200px;">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Perfil del Médico</h1>
  </div>

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

  <div class="row g-4 align-items-start">
    <div class="col-sm-4 mb-3 mb-sm-0">
      <div class="card h-100">
        <div class="card-body text-start">
          <div class="d-flex align-items-center gap-3 mb-3">
            <img src="{{ asset('images/avatar-placeholder.png') }}" alt="Avatar" class="rounded-circle img-fluid" style="width:96px;height:96px;object-fit:cover;">
            <div>
              <h4 class="mb-0 fw-bold">Dr. {{ Auth::user()->name }}</h4>
              <p class="text-muted mb-0">
                @if($medico->especialidades->count() > 0)
                  {{ $medico->especialidades->pluck('nombre')->join(', ') }}
                @else
                  Sin especialidad
                @endif
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-8">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="card-title mb-3">Editar Información</h5>
          <form method="POST" action="{{ route('medico.perfil.actualizar') }}">
            @csrf
            
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="text" class="form-control" value="{{ Auth::user()->email }}" disabled>
            </div>

            <div class="mb-3">
              <label for="CMP" class="form-label">CMP <span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('CMP') is-invalid @enderror" id="CMP" name="CMP" value="{{ old('CMP', $medico->codigo_cmp) }}" required>
              @error('CMP')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="telefono" class="form-label">Teléfono <span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ old('telefono', Auth::user()->telefono) }}" required>
              @error('telefono')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="especialidades" class="form-label">Especialidades</label>
              <select class="form-select @error('especialidades') is-invalid @enderror" id="especialidades" name="especialidades[]" multiple size="5">
                @foreach($especialidades as $especialidad)
                  <option value="{{ $especialidad->id }}" 
                    {{ $medico->especialidades->contains($especialidad->id) ? 'selected' : '' }}>
                    {{ $especialidad->nombre }}
                  </option>
                @endforeach
              </select>
              <small class="text-muted">Mantén presionado Ctrl (Cmd en Mac) para seleccionar múltiples especialidades</small>
              @error('especialidades')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="d-flex justify-content-end gap-2">
              <a href="{{ route('medico.dashboard') }}" class="btn btn-secondary">Cancelar</a>
              <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection
