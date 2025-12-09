@php use Illuminate\Support\Facades\Auth; @endphp
<footer class="bg-dark text-white mt-auto">
    <div class="container py-4">
        @if(Auth::check())
            <div class="row">
                <div class="col-md-8 mb-3 mb-md-0">
                    <h5 class="mb-3">
                        <span class="logo me-2">TS</span>
                        {{ config('app.name', 'TeleSalud Rural') }}
                    </h5>
                    <p class="text-white-50 small mb-0">
                        Atención médica remota de calidad para comunidades rurales
                    </p>
                </div>
            </div>

            <hr class="my-3 border-secondary">
            
            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-white-50 small mb-0">
                        &copy; {{ date('Y') }} {{ config('app.name', 'TeleSalud Rural') }}. Todos los derechos reservados.
                    </p>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h5 class="mb-3">
                        <span class="logo me-2">TS</span>
                        {{ config('app.name', 'TeleSalud Rural') }}
                    </h5>
                    <p class="text-white-50 small">
                        Atención médica remota de calidad para comunidades rurales
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">Iniciar Sesión</a>
                    <a href="{{ route('register') }}" class="btn btn-light btn-sm">Registrarse</a>
                </div>
            </div>
            
            <hr class="my-3 border-secondary">
            
            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-white-50 small mb-0">
                        &copy; {{ date('Y') }} {{ config('app.name', 'TeleSalud Rural') }}. Todos los derechos reservados.
                    </p>
                </div>
            </div>
        @endif
    </div>
</footer>

<style>
footer a:hover {
    color: #fff !important;
    transition: color 0.3s ease;
}
footer .logo {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, var(--brand-primary, #10b981) 0%, var(--brand-primary-600, #059669) 100%);
    border-radius: 8px;
    font-weight: 700;
    font-size: 14px;
    color: white;
}
</style>
