@extends('layouts.app')

@section('title', config('site.name') . ' - Profesjonalne Tworzenie Stron Internetowych')

@section('meta_description', 'Tworzenie stron internetowych, sklepów online i aplikacji webowych. Nowoczesne, responsywne i zoptymalizowane pod SEO. Krosno i cała Polska.')

@section('meta_keywords', 'tworzenie stron internetowych, strony www Krosno, sklepy internetowe, aplikacje webowe, SEO, responsywne strony, webdeveloper Krosno')

@section('schema')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "WebPage",
    "name": "{{ config('site.name') }} - Strona Główna",
    "description": "Tworzenie stron internetowych, sklepów online i aplikacji webowych",
    "url": "{{ route('home') }}",
    "mainEntity": {
        "@type": "Service",
        "name": "Tworzenie stron internetowych",
        "provider": {
            "@type": "LocalBusiness",
            "name": "{{ config('site.name') }}"
        }
    }
}
</script>
@endsection

@section('content')

    {{-- SEKCJA 1: HERO --}}
    @include('sections.hero', [
        'title' => config('site.hero.title'),
        'subtitle' => config('site.hero.subtitle'),
        'description' => config('site.hero.description'),
        'btnPrimary' => config('site.hero.btn_primary'),
        'btnSecondary' => config('site.hero.btn_secondary'),
    ])

    <!-- {{-- SEKCJA 2: O MNIE --}}
    @include('sections.about', [
        'about' => config('site.about'),
        'stats' => config('site.about.stats'),
    ]) -->

    {{-- SEKCJA 3: USŁUGI + PROCES --}}
    @include('sections.services', [
        'services' => config('site.services'),
        'steps' => config('site.steps'),
    ])

    {{-- SEKCJA 4: FAQ --}}
    @include('sections.faq', [
        'faqs' => config('site.faqs'),
    ])

    {{-- SEKCJA 5: KONTAKT --}}
    @include('sections.contact', [
        'contactInfo' => [
            ['icon' => 'bi-envelope', 'label' => 'Email', 'value' => config('site.email')],
            ['icon' => 'bi-phone', 'label' => 'Telefon', 'value' => config('site.phone')],
            ['icon' => 'bi-geo-alt', 'label' => 'Lokalizacja', 'value' => config('site.address')],
        ],
    ])

@endsection
