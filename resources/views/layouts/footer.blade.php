@php
    use Illuminate\Support\Facades\Auth;
@endphp
<footer class="text-white mt-auto w-100" style="background: linear-gradient(135deg, #0b1220 0%, #0f172a 100%);">
    <div class="container-fluid py-5">
        <div class="container" style="max-width: 1200px;">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-3">
                        <img src="{{ asset('logo.png') }}" alt="{{ config('app.name', 'TeleSalud Rural') }}" class="logo-img">
                        <div>
                            <h5 class="mb-1 fw-bold">{{ config('app.name', 'TeleSalud Rural') }}</h5>
                            <p class="text-white-50 mb-0 small">Atención médica remota de calidad para comunidades rurales</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 text-center text-md-end">
                    <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center justify-content-md-end gap-3">
                        <div class="text-white-50 small">
                            <i class="bi bi-envelope me-2"></i>info@telesalud.com
                        </div>
                        <div class="text-white-50 small">
                            <i class="bi bi-telephone me-2"></i>+56 9 1234 5678
                        </div>
                        <div class="d-inline-flex gap-3">
                            <a href="#" class="text-white-50" aria-label="facebook"><i class="bi bi-facebook" style="font-size: 1.25rem;"></i></a>
                            <a href="#" class="text-white-50" aria-label="twitter"><i class="bi bi-twitter" style="font-size: 1.25rem;"></i></a>
                            <a href="#" class="text-white-50" aria-label="instagram"><i class="bi bi-instagram" style="font-size: 1.25rem;"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4 border-secondary opacity-15">

            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-white-50 small mb-0">&copy; {{ date('Y') }} {{ config('app.name', 'TeleSalud Rural') }}. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
footer a { transition: all 0.18s ease; }
footer a:hover { color: #fff !important; transform: translateY(-2px); }
footer .logo {
    display: inline-flex; align-items: center; justify-content: center;
    width: 56px; height: 56px; background: linear-gradient(135deg, #0ea5e9 0%, #10b981 100%);
    border-radius: 12px; font-weight: 800; font-size: 18px; color: white;
    box-shadow: 0 8px 24px rgba(2,6,23,0.6);
}
@media (max-width: 575.98px) {
    footer .logo { width: 48px; height: 48px; font-size: 16px; }
    footer .container { padding-left: 16px; padding-right: 16px; }
    footer .text-white-50 { font-size: 13px; }
}
</style>
