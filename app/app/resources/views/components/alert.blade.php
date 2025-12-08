{{-- 
    KOMPONENT: Alert / Powiadomienie
    Użycie: <x-alert type="success" title="Sukces!" message="Operacja zakończona." />
    
    Props:
    - type: typ alertu (success, danger, warning, info - domyślnie: info)
    - title: tytuł (opcjonalny)
    - message: treść wiadomości (opcjonalna, można użyć slot)
    - dismissible: czy można zamknąć (domyślnie: false)
    - icon: ikona Bootstrap (opcjonalna, automatyczna dla typów)
--}}

@props([
    'type' => 'info',
    'title' => null,
    'message' => null,
    'dismissible' => false,
    'icon' => null,
])

@php
$icons = [
    'success' => 'bi-check-circle-fill',
    'danger' => 'bi-exclamation-triangle-fill',
    'warning' => 'bi-exclamation-circle-fill',
    'info' => 'bi-info-circle-fill',
];
$alertIcon = $icon ?? ($icons[$type] ?? 'bi-info-circle-fill');
@endphp

<div {{ $attributes->merge(['class' => "alert alert-{$type}" . ($dismissible ? ' alert-dismissible fade show' : '')]) }} role="alert">
    <div class="d-flex align-items-start">
        <i class="bi {{ $alertIcon }} me-2 mt-1"></i>
        <div class="flex-grow-1">
            @if($title)
            <strong>{{ $title }}</strong>
            <br>
            @endif
            @if($message)
                {{ $message }}
            @else
                {{ $slot }}
            @endif
        </div>
    </div>
    @if($dismissible)
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Zamknij"></button>
    @endif
</div>
