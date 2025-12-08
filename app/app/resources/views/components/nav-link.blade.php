{{-- 
    KOMPONENT: Link nawigacyjny
    Użycie: <x-nav-link href="#about" :active="true">O nas</x-nav-link>
    
    Props:
    - href: adres URL lub sekcja (#about)
    - active: czy aktywny (domyślnie: false)
    - scroll: czy to link do sekcji na stronie (domyślnie: auto-detect #)
    - dropdown: czy to dropdown toggle (domyślnie: false)
--}}

@props([
    'href' => '#',
    'active' => false,
    'scroll' => null,
    'dropdown' => false,
])

@php
$isScroll = $scroll ?? str_starts_with($href, '#');
$sectionId = $isScroll ? ltrim($href, '#') : null;
@endphp

@if($dropdown)
<a class="nav-link dropdown-toggle {{ $active ? 'active' : '' }}" 
   href="{{ $href }}" 
   role="button" 
   data-bs-toggle="dropdown" 
   aria-expanded="false"
   {{ $attributes }}>
    {{ $slot }}
</a>
@else
<a class="nav-link {{ $active ? 'active' : '' }}" 
   href="{{ $href }}"
   @if($isScroll && $sectionId) data-scroll="{{ $sectionId }}" @endif
   {{ $attributes }}>
    {{ $slot }}
</a>
@endif
