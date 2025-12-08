{{-- 
    KOMPONENT: Wrapper na row z kolumnami
    Użycie: <x-grid cols="3" gap="4">...karty...</x-grid>
    
    Props:
    - cols: liczba kolumn na desktop (2, 3, 4, 6 - domyślnie: 3)
    - colsMd: liczba kolumn na tablet (opcjonalne)
    - gap: gap między elementami (0-5 - domyślnie: 4)
    - centered: czy elementy wycentrowane (domyślnie: false)
--}}

@props([
    'cols' => 3,
    'colsMd' => null,
    'gap' => 4,
    'centered' => false,
])

@php
$colClass = match((int)$cols) {
    2 => 'col-lg-6',
    3 => 'col-lg-4',
    4 => 'col-lg-3',
    6 => 'col-lg-2',
    default => 'col-lg-4',
};

$colMdClass = $colsMd ? match((int)$colsMd) {
    2 => 'col-md-6',
    3 => 'col-md-4',
    4 => 'col-md-3',
    6 => 'col-md-2',
    default => 'col-md-6',
} : 'col-md-6';
@endphp

<div {{ $attributes->merge(['class' => "row g-{$gap}" . ($centered ? ' justify-content-center' : '')]) }}>
    {{ $slot }}
</div>

@pushOnce('grid-styles')
<style>
.row > [class*="col-"] {
    display: flex;
    flex-direction: column;
}
</style>
@endPushOnce
