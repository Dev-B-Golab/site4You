{{-- 
    KOMPONENT: Przycisk
    Użycie: <x-button href="/link" variant="primary">Tekst</x-button>
    
    Props:
    - href: link (jeśli brak, renderuje <button>)
    - variant: "primary" | "outline" (domyślnie: primary)
    - icon: ikona Bootstrap Icons (opcjonalna)
    - type: typ przycisku dla <button> (domyślnie: button)
    - dataScroll: sekcja do scrollowania (opcjonalna)
--}}

@props([
    'href' => null,
    'variant' => 'primary',
    'icon' => null,
    'type' => 'button',
    'dataScroll' => null,
])

@php
    $classes = $variant === 'outline' ? 'btn btn-outline-custom' : 'btn btn-custom';
@endphp

@if($href)
<a href="{{ $href }}" 
   {{ $attributes->merge(['class' => $classes]) }}
   @if($dataScroll) data-scroll="{{ $dataScroll }}" @endif>
    @if($icon)<i class="bi {{ $icon }} me-2"></i>@endif{{ $slot }}
</a>
@else
<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    @if($icon)<i class="bi {{ $icon }} me-2"></i>@endif{{ $slot }}
</button>
@endif
