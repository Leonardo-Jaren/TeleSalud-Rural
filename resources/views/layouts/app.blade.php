<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TeleSalud Rural') }}</title>
    <meta name="description" content="Plataforma de telemedicina para comunidades rurales - Atención médica remota de calidad">

    <!-- Brand typography (Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Scripts and app assets -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- Branding stylesheet (overrides and tokens) -->
    <link rel="stylesheet" href="{{ asset('css/branding.css') }}">
    @stack('styles')
</head>
<body class="brand-root d-flex flex-column min-vh-100" style="font-family: 'Inter', sans-serif;">
    <div id="app" class="d-flex flex-column min-vh-100">
        @include('layouts.nav')

        {{-- Hero fondo: aparece en páginas de dashboard y se oculta al hacer scroll --}}
        @if(request()->routeIs('*dashboard'))
            <div id="hero-fondo" class="hero-fondo" style="background-image: url('{{ asset('fondo.jpg') }}');">
                <div class="hero-fondo-inner"></div>
            </div>
        @endif

        <main class="@yield('mainClass','py-4') grow">
            @if(session('success'))
                <div class="container" style="max-width:1200px;">
                    <div class="alert alert-success">{{ session('success') }}</div>
                </div>
            @endif
            @if(session('error'))
                <div class="container" style="max-width:1200px;">
                    <div class="alert alert-danger">{{ session('error') }}</div>
                </div>
            @endif
            @yield('content')
        </main>

        @include('layouts.footer')
    </div>
    @stack('scripts')
    <script>
        (function(){
            // Solo si existe el hero-fondo
            var hero = document.getElementById('hero-fondo');
            if(!hero) return;
            var lastScroll = 0;
            var ticking = false;
            function onScroll(){
                var sc = window.scrollY || window.pageYOffset;
                if(sc > 60){
                    hero.classList.add('hero-hidden');
                } else {
                    hero.classList.remove('hero-hidden');
                }
            }
            window.addEventListener('scroll', onScroll, {passive:true});
            // Initial check
            onScroll();
        })();
    </script>
</body>
</html>
