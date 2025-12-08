{{-- 
    KOMPONENT: Obrazek z placeholderem
    Użycie: <x-image src="img/photo.jpg" alt="Opis" height="400px" />
    
    Props:
    - src: ścieżka do obrazka (względna do public/)
    - alt: tekst alternatywny
    - height: wysokość kontenera (domyślnie: 300px)
    - placeholder: tekst placeholdera jeśli brak obrazka (opcjonalny)
    - lazy: czy lazy loading (domyślnie: true)
--}}

@props([
    'src' => null,
    'alt' => '',
    'height' => '300px',
    'placeholder' => null,
    'lazy' => true,
])

<div {{ $attributes->merge(['class' => 'img-placeholder']) }} style="height: {{ $height }};">
    @if($src)
    <img src="{{ asset($src) }}" 
         alt="{{ $alt }}" 
         @if($lazy) loading="lazy" @endif>
    @elseif($placeholder)
    <div class="text-center">
        <i class="bi bi-image"></i>
        <p class="mt-2">{{ $placeholder }}</p>
    </div>
    @endif
</div>
