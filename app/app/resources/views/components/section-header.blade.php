{{-- 
    KOMPONENT: Nagłówek sekcji
    Użycie: <x-section-header title="Tytuł" subtitle="Podtytuł" centered />
    
    Props:
    - title: główny tytuł sekcji
    - subtitle: podtytuł sekcji (opcjonalny)
    - centered: czy wyśrodkować (domyślnie: false)
    - id: id dla tytułu (opcjonalne, do aria-labelledby)
--}}

@props([
    'title' => '',
    'subtitle' => null,
    'centered' => false,
    'id' => null,
])

<header {{ $attributes->merge(['class' => $centered ? 'text-center mb-5' : 'mb-5']) }} data-aos="fade-up" data-aos-duration="1000">
    <h2 @if($id) id="{{ $id }}" @endif 
        class="section-title {{ $centered ? 'mx-auto' : '' }}" 
        @if($centered) style="display: table;" @endif>
        {{ $title }}
    </h2>
    @if($subtitle)
    <p class="section-subtitle">{{ $subtitle }}</p>
    @endif
    {{ $slot }}
</header>
