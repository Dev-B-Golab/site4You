{{-- 
    KOMPONENT: Przełącznik języka
    Użycie: <x-language-switcher />
    
    Props:
    - current: aktualny język (domyślnie: z sesji)
    - languages: dostępne języki (domyślnie: ['pl', 'en'])
--}}

@props([
    'current' => null,
    'languages' => ['pl', 'en'],
])

@php
$currentLang = $current ?? app()->getLocale();

$flags = [
    'pl' => '🇵🇱',
    'en' => '🇬🇧',
    'de' => '🇩🇪',
    'fr' => '🇫🇷',
    'es' => '🇪🇸',
];

$names = [
    'pl' => 'Polski',
    'en' => 'English',
    'de' => 'Deutsch',
    'fr' => 'Français',
    'es' => 'Español',
];
@endphp

<li class="nav-item dropdown ms-lg-3">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
        <i class="bi bi-globe me-1"></i>{{ strtoupper($currentLang) }}
    </a>
    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
        @foreach($languages as $lang)
        <li>
            <a class="dropdown-item {{ $currentLang === $lang ? 'active' : '' }}" 
               href="{{ route('lang.switch', $lang) }}">
                {{ $flags[$lang] ?? '' }} {{ $names[$lang] ?? strtoupper($lang) }}
            </a>
        </li>
        @endforeach
    </ul>
</li>
