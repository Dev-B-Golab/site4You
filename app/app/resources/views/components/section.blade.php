{{-- 
    KOMPONENT: Sekcja strony
    Użycie: <x-section id="about" title="O nas" :padding="true">...zawartość...</x-section>
    
    Props:
    - id: identyfikator sekcji (wymagany dla nawigacji)
    - title: tytuł sekcji (opcjonalny)
    - subtitle: podtytuł sekcji (opcjonalny)
    - titleCentered: czy tytuł wycentrowany (domyślnie: true)
    - padding: czy dodać standardowy padding (domyślnie: true)
    - container: typ kontenera (container, container-fluid, none - domyślnie: container)
    - bg: klasa tła (opcjonalna)
--}}

@props([
    'id' => null,
    'title' => null,
    'subtitle' => null,
    'titleCentered' => true,
    'padding' => true,
    'container' => 'container',
    'bg' => null,
])

<section 
    @if($id) id="{{ $id }}" @endif
    {{ $attributes->merge(['class' => ($padding ? 'section-padding' : '') . ($bg ? ' ' . $bg : '')]) }}>
    
    @if($container !== 'none')
    <div class="{{ $container }}">
    @endif
    
        @if($title)
        <x-section-header 
            :title="$title" 
            :subtitle="$subtitle" 
            :centered="$titleCentered" 
            :titleId="$id ? $id . '-title' : null" />
        @endif
        
        {{ $slot }}
    
    @if($container !== 'none')
    </div>
    @endif
</section>
