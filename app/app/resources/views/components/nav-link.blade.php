{{-- 
    KOMPONENT: Link nawigacyjny
    Użycie: <x-nav-link scroll="about">O nas</x-nav-link>
    
    Props:
    - href: adres URL (opcjonalny)
    - scroll: sekcja do scrollowania (opcjonalny, np. "about", "services")
    - active: czy aktywny (domyślnie: false)
    - dropdown: czy to dropdown toggle (domyślnie: false)
--}}

@props([
    'href' => null,
    'scroll' => null,
    'active' => false,
    'dropdown' => false,
])

@php
$linkHref = $href ?? ($scroll ? route('home') : '#');
@endphp

@if($dropdown)
<a class="nav-link dropdown-toggle {{ $active ? 'active' : '' }}" 
   href="#" 
   role="button" 
   data-bs-toggle="dropdown" 
   aria-expanded="false"
   {{ $attributes }}>
    {{ $slot }}
</a>
@else
<a class="nav-link {{ $active ? 'active' : '' }}" 
   href="{{ $linkHref }}"
   @if($scroll) data-scroll="{{ $scroll }}" @endif
   {{ $attributes }}>
    {{ $slot }}
</a>
@endif
