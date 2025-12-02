{{--
|--------------------------------------------------------------------------
| GŁÓWNY LAYOUT STRONY
|--------------------------------------------------------------------------
| Style: resources/css/app.css (kompilowane przez Vite)
| Skrypty: resources/js/app.js (kompilowane przez Vite)
| Header i Footer jako osobne komponenty
|--------------------------------------------------------------------------
--}}

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Profesjonalne tworzenie stron internetowych - nowoczesne, responsywne i skuteczne rozwiązania webowe">
    <title>@yield('title', 'WebStudio - Tworzenie Stron Internetowych')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- AOS Animate On Scroll -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    
    {{-- STYLE WŁASNE --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    {{-- HEADER / NAVBAR --}}
    @include('partials.header')

    {{-- GŁÓWNA TREŚĆ --}}
    @yield('content')

    {{-- FOOTER --}}
    @include('partials.footer')

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- PureCounter -->
    <script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs/dist/purecounter_vanilla.js"></script>
    <!-- AOS Animate On Scroll -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    
    {{-- SKRYPTY WŁASNE --}}
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
