@extends('layouts.app')

@section('mainClass','')
@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center p-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card shadow-lg border-0 rounded-4" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                    
                    {{-- Header --}}
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 shadow" 
                                 style="width: 64px; height: 64px; background: linear-gradient(135deg, var(--brand-primary) 0%, var(--brand-primary-600) 100%);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-white" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                    <circle cx="8.5" cy="7" r="4"/>
                                    <polyline points="17 11 19 13 23 9"/>
                                </svg>
                            </div>
                            <h2 class="h2 fw-bold mb-2" style="background: linear-gradient(135deg, var(--brand-primary) 0%, var(--brand-primary-600) 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                                Registrar Nuevo Médico
                            </h2>
                            <p class="text-muted mb-0">
                                Complete el formulario para añadir un nuevo médico al sistema
                            </p>
                        </div>

                        {{-- Mensajes de éxito/error --}}
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        {{-- Formulario --}}
                        <form method="POST" action="{{ route('admin.medico.store') }}" novalidate>
                            @csrf

                            <div class="row">
                                {{-- Datos de Usuario --}}
                                <div class="col-12">
                                    <h5 class="mb-3 text-secondary">
                                        <i class="bi bi-person-circle me-2"></i>Datos de Usuario
                                    </h5>
                                </div>

                                {{-- Nombre completo --}}
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label fw-semibold text-secondary">
                                        Nombre completo <span class="text-danger">*</span>
                                    </label>
                                    <input 
                                        id="name" 
                                        type="text" 
                                        class="form-control @error('name') is-invalid @enderror" 
                                        name="name" 
                                        value="{{ old('name') }}" 
                                        required 
                                        placeholder="Dr. Juan Pérez"
                                    >
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label fw-semibold text-secondary">
                                        Correo electrónico <span class="text-danger">*</span>
                                    </label>
                                    <input 
                                        id="email" 
                                        type="email" 
                                        class="form-control @error('email') is-invalid @enderror" 
                                        name="email" 
                                        value="{{ old('email') }}" 
                                        required 
                                        placeholder="medico@ejemplo.com"
                                    >
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Teléfono --}}
                                <div class="col-md-6 mb-3">
                                    <label for="telefono" class="form-label fw-semibold text-secondary">
                                        Teléfono <span class="text-danger">*</span>
                                    </label>
                                    <input 
                                        id="telefono" 
                                        type="text" 
                                        class="form-control @error('telefono') is-invalid @enderror" 
                                        name="telefono" 
                                        value="{{ old('telefono') }}" 
                                        required 
                                        placeholder="+51 987 654 321"
                                    >
                                    @error('telefono')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Documento de identidad --}}
                                <div class="col-md-6 mb-3">
                                    <label for="documento_identidad" class="form-label fw-semibold text-secondary">
                                        Documento de identidad <span class="text-danger">*</span>
                                    </label>
                                    <input 
                                        id="documento_identidad" 
                                        type="text" 
                                        class="form-control @error('documento_identidad') is-invalid @enderror" 
                                        name="documento_identidad" 
                                        value="{{ old('documento_identidad') }}" 
                                        required 
                                        placeholder="12345678"
                                    >
                                    @error('documento_identidad')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Contraseña --}}
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label fw-semibold text-secondary">
                                        Contraseña <span class="text-danger">*</span>
                                    </label>
                                    <input 
                                        id="password" 
                                        type="password" 
                                        class="form-control @error('password') is-invalid @enderror" 
                                        name="password" 
                                        required 
                                        placeholder="Mínimo 8 caracteres"
                                    >
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Confirmar contraseña --}}
                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label fw-semibold text-secondary">
                                        Confirmar contraseña <span class="text-danger">*</span>
                                    </label>
                                    <input 
                                        id="password_confirmation" 
                                        type="password" 
                                        class="form-control" 
                                        name="password_confirmation" 
                                        required 
                                        placeholder="Repita la contraseña"
                                    >
                                </div>

                                {{-- Datos Profesionales --}}
                                <div class="col-12 mt-4">
                                    <h5 class="mb-3 text-secondary">
                                        <i class="bi bi-hospital me-2"></i>Datos Profesionales
                                    </h5>
                                </div>

                                {{-- Código CMP --}}
                                <div class="col-md-6 mb-3">
                                    <label for="codigo_cmp" class="form-label fw-semibold text-secondary">
                                        Código CMP <span class="text-danger">*</span>
                                    </label>
                                    <input 
                                        id="codigo_cmp" 
                                        type="text" 
                                        class="form-control @error('codigo_cmp') is-invalid @enderror" 
                                        name="codigo_cmp" 
                                        value="{{ old('codigo_cmp') }}" 
                                        required 
                                        placeholder="CMP-12345"
                                    >
                                    @error('codigo_cmp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Especialidades --}}
                                <div class="col-md-6 mb-3">
                                    <label for="especialidades" class="form-label fw-semibold text-secondary">
                                        Especialidades <span class="text-danger">*</span>
                                    </label>
                                    <select 
                                        id="especialidades" 
                                        class="form-select @error('especialidades') is-invalid @enderror" 
                                        name="especialidades[]" 
                                        multiple 
                                        required
                                        size="3"
                                    >
                                        @foreach($especialidades as $especialidad)
                                            <option value="{{ $especialidad->id }}" 
                                                {{ (collect(old('especialidades'))->contains($especialidad->id)) ? 'selected' : '' }}>
                                                {{ $especialidad->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">Mantenga presionado Ctrl (Cmd en Mac) para seleccionar varias</small>
                                    @error('especialidades')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Biografía --}}
                                <div class="col-12 mb-3">
                                    <label for="biografia" class="form-label fw-semibold text-secondary">
                                        Biografía
                                    </label>
                                    <textarea 
                                        id="biografia" 
                                        class="form-control @error('biografia') is-invalid @enderror" 
                                        name="biografia" 
                                        rows="4" 
                                        placeholder="Información profesional, experiencia, áreas de interés..."
                                    >{{ old('biografia') }}</textarea>
                                    @error('biografia')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Botones --}}
                            <div class="d-flex gap-2 mt-4">
                                <button type="submit" class="btn btn-primary flex-grow-1">
                                    <i class="bi bi-check-circle me-2"></i>Registrar Médico
                                </button>
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-2"></i>Cancelar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control:focus, .form-select:focus {
    border-color: var(--brand-primary, #10b981);
    box-shadow: 0 0 0 0.25rem rgba(16, 185, 129, 0.25);
}

.btn-primary {
    background: linear-gradient(135deg, var(--brand-primary) 0%, var(--brand-primary-600) 100%);
    border: none;
}

.btn-primary:hover {
    background: linear-gradient(135deg, var(--brand-primary-600) 0%, var(--brand-primary-700) 100%);
}

.form-select[multiple] {
    min-height: 120px;
}
</style>
@endsection
