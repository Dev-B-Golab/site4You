{{-- 
    KOMPONENT: Karta
    Użycie: <x-card icon="bi-window" title="Tytuł" description="Opis" :link="route('...')" linkText="Zobacz więcej" />
    
    Props:
    - icon: klasa ikony Bootstrap Icons (np. "bi-window")
    - title: tytuł karty
    - description: opis karty
    - link: opcjonalny link (jeśli podany, karta staje się linkiem)
    - linkText: tekst "dowiedz się więcej" (opcjonalny)
    - delay: opóźnienie animacji AOS (domyślnie: 0)
--}}

@props([
    'icon' => null,
    'title' => '',
    'description' => '',
    'link' => null,
    'linkText' => null,
    'delay' => 0,
])

@if($link)
<a href="{{ $link }}" class="text-decoration-none d-block h-100" data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $delay }}">
@else
<div data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $delay }}">
@endif

<div {{ $attributes->merge(['class' => 'card-custom']) }}>
    @if($icon)
    <div class="card-icon" aria-hidden="true">
        <i class="bi {{ $icon }}"></i>
    </div>
    @endif
    
    @if($title)
    <h3 class="card-title">{{ $title }}</h3>
    @endif
    
    @if($description)
    <p class="card-text">{{ $description }}</p>
    @else
    <div class="card-text">{{ $slot }}</div>
    @endif
    
    @if($linkText && $link)
    <span class="card-read-more">
        {{ $linkText }} <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
    </span>
    @endif
</div>

@if($link)
</a>
@else
</div>
@endif
