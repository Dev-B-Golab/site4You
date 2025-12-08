{{-- 
    KOMPONENT: Feature box / lista cech
    Użycie: <x-feature-list :features="['Szybka realizacja', 'Wsparcie 24/7']" />
    
    Props:
    - features: tablica cech
    - icon: ikona dla wszystkich (domyślnie: bi-check-circle)
    - iconColor: kolor ikony (domyślnie: text-white)
    - columns: liczba kolumn (1, 2, 3 - domyślnie: 1)
--}}

@props([
    'features' => [],
    'icon' => 'bi-check-circle',
    'iconColor' => 'text-white',
    'columns' => 1,
])

@php
$colClass = match($columns) {
    2 => 'col-md-6',
    3 => 'col-md-4',
    default => 'col-12',
};
@endphp

<ul class="list-unstyled">
    @foreach($features as $feature)
    <li class="mb-3">
        <i class="bi {{ $icon }} {{ $iconColor }} me-2"></i>
        <span class="text-gray">{{ $feature }}</span>
    </li>
    @endforeach
</ul>
