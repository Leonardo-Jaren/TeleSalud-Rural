@extends('layouts.app')

@section('mainClass', '')
@section('content')
    <div class="min-vh-100 d-flex align-items-center justify-content-center "
        style="background: linear-gradient(135deg, var(--bg-page) 0%, #e9ecef 100%);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card shadow-lg border-0 rounded-4"
                        style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">

                        {{-- Header con ícono --}}
                        <div class="card-body p-4 p-md-5">
                            <div class="text-center mb-4">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 shadow"
                                    style="width: 64px; height: 64px; background: linear-gradient(135deg, var(--brand-primary) 0%, var(--brand-primary-600) 100%);">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-white" width="32" height="32"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                </div>
                                <h2 class="h2 fw-bold mb-2"
                                    style="background: linear-gradient(135deg, var(--brand-primary) 0%, var(--brand-primary-600) 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                                    {{ __('Iniciar Sesión') }}
                                </h2>
                                <p class="text-muted mb-1">
                                    Accede para ver horarios y agendar tus citas de TeleSalud
                                </p>
                                <p class="text-muted small mb-0">
                                    ¿No tienes cuenta?
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="text-decoration-none fw-semibold"
                                            style="color: var(--brand-primary-400);">
                                            Regístrate aquí
                                        </a>
                                    @endif
                                </p>
                            </div>

                            {{-- Formulario --}}
                            <form method="POST" action="{{ route('login') }}" novalidate>
                                @csrf

                                {{-- Email --}}
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold text-secondary label">
                                        {{ __('Correo electrónico') }}
                                    </label>
                                    <div class="position-relative">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="position-absolute text-muted"
                                            style="left: 12px; top: 50%; transform: translateY(-50%); pointer-events: none;"
                                            width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <rect x="2" y="4" width="20" height="16" rx="2" />
                                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                                        </svg>
                                        <input id="email" type="email"
                                            class="form-control input ps-5 @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autocomplete="email"
                                            autofocus placeholder="email@ejemplo.com"
                                            style="border: 1px solid rgba(16,24,40,0.06); transition: all 0.3s ease;">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Contraseña --}}
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-semibold text-secondary label">
                                        {{ __('Contraseña') }}
                                    </label>
                                    <div class="position-relative">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="position-absolute text-muted"
                                            style="left: 12px; top: 50%; transform: translateY(-50%); pointer-events: none;"
                                            width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <rect x="3" y="11" width="18" height="11" rx="2"
                                                ry="2" />
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                        </svg>
                                        <input id="password" type="password"
                                            class="form-control input ps-5 pe-5 @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="current-password" placeholder="••••••••"
                                            style="border: 1px solid rgba(16,24,40,0.06); transition: all 0.3s ease;">
                                        <button type="button" class="btn btn-link position-absolute text-muted p-0"
                                            style="right: 12px; top: 50%; transform: translateY(-50%); text-decoration: none;"
                                            onclick="togglePassword()">
                                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="20"
                                                height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24" />
                                                <path
                                                    d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68" />
                                                <path
                                                    d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61" />
                                                <line x1="2" x2="22" y1="2" y2="22" />
                                            </svg>
                                        </button>
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Recordarme y Olvidaste contraseña --}}
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }} style="border-color: #dee2e6;">
                                        <label class="form-check-label text-secondary small label" for="remember">
                                            {{ __('Recordarme') }}
                                        </label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}"
                                            class="text-decoration-none small fw-semibold"
                                            style="color: var(--brand-primary-400);">
                                            {{ __('¿Olvidaste tu contraseña?') }}
                                        </a>
                                    @endif
                                </div>

                                {{-- Botón de Login --}}
                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn text-white fw-semibold shadow"
                                        style="background: linear-gradient(135deg, var(--brand-primary) 0%, var(--brand-primary-600) 100%); border: none; transition: all 0.3s ease;">
                                        {{ __('Iniciar Sesión') }}
                                    </button>
                                </div>

                                {{-- Divider --}}
                                <div class="text-center mb-3">
                                    <span class="text-muted small">o continúa con</span>
                                </div>

                                {{-- Botón de Google (placeholder) --}}
                                <div class="d-grid mb-3">
                                    <button type="button"
                                        class="btn btn-outline-secondary d-flex align-items-center justify-content-center gap-2">
                                        <svg width="20" height="20" viewBox="0 0 24 24">
                                            <path fill="#4285F4"
                                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                                            <path fill="#34A853"
                                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                                            <path fill="#FBBC05"
                                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                                            <path fill="#EA4335"
                                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                                        </svg>
                                        Iniciar sesión con Google
                                    </button>
                                </div>
                            </form>

                            {{-- Link de registro inferior --}}
                            <div class="text-center mt-4 pt-4 border-top">
                                <p class="text-muted mb-0 small">
                                    ¿No tienes una cuenta?
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="text-decoration-none fw-semibold"
                                            style="color: var(--brand-primary-400);">
                                            Registrarse
                                        </a>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Footer con términos --}}
                    <div class="text-center mt-4">
                        <p class="text-muted small mb-1">Al iniciar sesión, aceptas nuestros</p>
                        <div class="d-flex justify-content-center gap-3 small">
                            <a href="#" class="text-muted text-decoration-none">Términos de Servicio</a>
                            <span class="text-muted">•</span>
                            <a href="#" class="text-muted text-decoration-none">Política de Privacidad</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Estilos generales para el botón de Google */
        .btn-outline-secondary {
            border: 1px solid rgba(16, 24, 40, 0.08);
            color: var(--brand-neutral-900);
            background-color: transparent;
            padding: 10px 20px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Hover en el botón de Google */
        .btn-outline-secondary:hover {
            background-color: var(--bg-surface);
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.06);
            border-color: rgba(16, 24, 40, 0.08);
        }

        /* Icono dentro del botón */
        .btn-outline-secondary svg {
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        /* Efecto de hover en el icono */
        .btn-outline-secondary:hover svg {
            opacity: 0.8;
        }

        /* Focus state */
        .btn-outline-secondary:focus {
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
        }



        /* Efectos de hover para inputs */
        .form-control:focus {
            border-color: var(--brand-primary-400) !important;
            box-shadow: 0 0 0 0.2rem rgba(24, 111, 154, 0.12) !important;
        }

        /* Hover en botón principal */
        .btn[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(24, 111, 154, 0.18) !important;
        }

        /* Hover en botón de Google */
        /* Google button: keep border and text color on hover */
        .btn-outline-secondary {
            border: 1px solid rgba(16, 24, 40, 0.08);
            color: var(--brand-neutral-900);
            background-color: transparent;
        }

        .btn-outline-secondary svg {
            opacity: 1;
        }

        .btn-outline-secondary:hover {
            background-color: var(--bg-surface);
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.06);
            color: var(--brand-neutral-900) !important;
            border-color: rgba(16, 24, 40, 0.08) !important;
        }

        /* Hover en links */
        a:hover {
            opacity: 0.8;
            transition: opacity 0.2s ease;
        }

        /* Animación del card */
        .card {
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Checkbox personalizado */
        .form-check-input:checked {
            background-color: var(--brand-primary);
            border-color: var(--brand-primary);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .card-body {
                padding: 2rem 1.5rem !important;
            }
        }

        /* Reduce padding from layout main for this page when empty */
        main.py-4 {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `
                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                <circle cx="12" cy="12" r="3"/>
            `;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `
                <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
                <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
                <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/>
                <line x1="2" x2="22" y1="2" y2="22"/>
            `;
            }
        }

        // Auto-clear validation errors on input
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('is-invalid');
            });
        });
    </script>
@endpush
