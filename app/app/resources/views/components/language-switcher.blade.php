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

<div {{ $attributes->merge(['class' => 'language-switcher d-flex gap-2']) }}>
    @foreach($languages as $lang)
    <a href="{{ route('locale', $lang) }}" 
       class="lang-link {{ $currentLang === $lang ? 'active' : '' }}" 
       title="{{ $names[$lang] ?? strtoupper($lang) }}"
       aria-label="{{ $names[$lang] ?? strtoupper($lang) }}">
        <span class="flag">{{ $flags[$lang] ?? strtoupper($lang) }}</span>
    </a>
    @endforeach
</div>
