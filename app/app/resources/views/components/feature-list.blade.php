{{-- 
    KOMPONENT: Feature box / lista cech
    Użycie: <x-feature-list :features="['Szybka realizacja', 'Wsparcie 24/7']" />
    
    Props:
    - features: tablica cech
    - icon: ikona dla wszystkich (domyślnie: bi-check-circle-fill)
    - iconColor: kolor ikony (domyślnie: text-primary)
    - columns: liczba kolumn (1, 2, 3 - domyślnie: 1)
--}}

@props([
    'features' => [],
    'icon' => 'bi-check-circle-fill',
    'iconColor' => 'text-primary',
    'columns' => 1,
])

@php
$colClass = match($columns) {
    2 => 'col-md-6',
    3 => 'col-md-4',
    default => 'col-12',
};
@endphp

<div class="row">
    @foreach($features as $feature)
    <div class="{{ $colClass }} mb-2">
        <div class="d-flex align-items-start">
            <i class="bi {{ $icon }} {{ $iconColor }} me-2 mt-1"></i>
            <span>{{ $feature }}</span>
        </div>
    </div>
    @endforeach
</div>
