@extends('layouts.app')

@section('title', config('site.name') . ' - Profesjonalne strony internetowe')

@section('meta_description', 'Strona wizytówka, sklep internetowy czy dedykowana aplikacja webowa? Zaufaj specjalistom i zacznij budować swoją obecność w sieci już dziś.')

@section('meta_keywords', 'strony internetowe, profesjonalne strony www, sklep internetowy, aplikacje webowe, tworzenie stron, webdeveloper, strony dla firm, strony internnetowe krosno, strony internetowe podkarpacie, tanie strony internetowe, sklepy e-commerce')

@section('schema')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "LocalBusiness",
    "name": "{{ config('site.name') }}",
    "description": "Strona wizytówka, sklep internetowy czy dedykowana aplikacja webowa? Zaufaj specjalistom i zacznij budować swoją obecność w sieci.",
    "url": "{{ route('home') }}",
    "telephone": "{{ config('site.phone') }}",
    "email": "{{ config('site.email') }}",
    "address": {
        "@@type": "PostalAddress",
        "addressLocality": "Krosno",
        "addressRegion": "Podkarpackie",
        "addressCountry": "PL"
    },
    "areaServed": [
        {"@@type": "City", "name": "Krosno"},
        {"@@type": "State", "name": "Podkarpackie"},
        {"@@type": "Country", "name": "Polska"}
    ],
    "priceRange": "$$",
    "openingHours": "Mo-Fr 09:00-17:00",
    "sameAs": [
        "{{ config('site.social.instagram') }}",
        "{{ config('site.social.linkedin') }}",
        "{{ config('site.social.github') }}"
    ],
    "hasOfferCatalog": {
        "@@type": "OfferCatalog",
        "name": "Usługi tworzenia stron internetowych",
        "itemListElement": [
            {
                "@@type": "Offer",
                "itemOffered": {
                    "@@type": "Service",
                    "name": "Strony internetowe",
                    "description": "Profesjonalne strony internetowe dla firm"
                }
            },
            {
                "@@type": "Offer",
                "itemOffered": {
                    "@@type": "Service",
                    "name": "Sklepy internetowe",
                    "description": "Funkcjonalne sklepy e-commerce"
                }
            },
            {
                "@@type": "Offer",
                "itemOffered": {
                    "@@type": "Service",
                    "name": "Aplikacje webowe",
                    "description": "Dedykowane aplikacje internetowe"
                }
            }
        ]
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
