{{-- 
    KOMPONENT: Ikona z tekstem (contact info, feature list)
    Użycie: <x-icon-text icon="bi-envelope" label="Email" value="test@test.com" />
    
    Props:
    - icon: klasa ikony Bootstrap Icons
    - label: mała etykieta nad wartością (opcjonalna)
    - value: główna wartość/tekst
    - href: link (opcjonalny - dla email/telefon)
--}}

@props([
    'icon' => 'bi-circle',
    'label' => null,
    'value' => '',
    'href' => null,
])

<div {{ $attributes->merge(['class' => 'd-flex align-items-center mb-3']) }}>
    <div class="card-icon me-3" style="width: 50px; height: 50px; flex-shrink: 0;">
        <i class="bi {{ $icon }}" style="font-size: 1.2rem;"></i>
    </div>
    <div>
        @if($label)
        <p class="mb-0 text-muted-small">{{ $label }}</p>
        @endif
        @if($href)
        <a href="{{ $href }}" class="mb-0 text-white text-decoration-none">{{ $value }}</a>
        @else
        <p class="mb-0">{{ $value }}</p>
        @endif
    </div>
</div>
