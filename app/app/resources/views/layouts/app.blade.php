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
    
    {{-- SEO META TAGS --}}
    <title>@yield('title', config('site.name') . ' - Tworzenie Stron Internetowych')</title>
    <meta name="description" content="@yield('meta_description', config('site.description'))">
    <meta name="keywords" content="@yield('meta_keywords', 'tworzenie stron internetowych, strony www, sklepy internetowe, aplikacje webowe, SEO, responsywne strony, Krosno, Polska')">
    <meta name="author" content="{{ config('site.name') }}">
    <meta name="robots" content="@yield('robots', 'index, follow')">
    <link rel="canonical" href="{{ url()->current() }}">
    
    {{-- OPEN GRAPH / FACEBOOK --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', config('site.name') . ' - Tworzenie Stron Internetowych')">
    <meta property="og:description" content="@yield('meta_description', config('site.description'))">
    <meta property="og:image" content="@yield('og_image', asset('img/og-image.jpg'))">
    <meta property="og:locale" content="{{ app()->getLocale() == 'pl' ? 'pl_PL' : 'en_US' }}">
    <meta property="og:site_name" content="{{ config('site.name') }}">
    
    {{-- TWITTER CARD --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', config('site.name') . ' - Tworzenie Stron Internetowych')">
    <meta name="twitter:description" content="@yield('meta_description', config('site.description'))">
    <meta name="twitter:image" content="@yield('og_image', asset('img/og-image.jpg'))">
    
    {{-- FAVICON --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }}">
    
    {{-- PRECONNECT DLA WYDAJNOŚCI --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    
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
    
    {{-- SCHEMA.ORG STRUCTURED DATA --}}
    @yield('schema')
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "{{ config('site.name') }}",
        "description": "{{ config('site.description') }}",
        "url": "{{ url('/') }}",
        "telephone": "{{ config('site.phone') }}",
        "email": "{{ config('site.email') }}",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "Krosno",
            "addressCountry": "PL"
        },
        "priceRange": "$$",
        "openingHours": "Mo-Fr 09:00-17:00",
        "sameAs": [
            "{{ config('site.social.facebook') }}",
            "{{ config('site.social.instagram') }}",
            "{{ config('site.social.linkedin') }}",
            "{{ config('site.social.github') }}"
        ]
    }
    </script>
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
