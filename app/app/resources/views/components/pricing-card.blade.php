{{-- 
    KOMPONENT: Cennik / Pricing card
    Użycie: <x-pricing-card name="Basic" price="999" :features="[...]" />
    
    Props:
    - name: nazwa pakietu
    - price: cena (bez waluty)
    - currency: waluta (domyślnie: zł)
    - period: okres (domyślnie: null, np. 'mies.')
    - features: tablica funkcji
    - featured: czy wyróżniony (domyślnie: false)
    - buttonText: tekst przycisku (domyślnie: 'Wybierz')
    - buttonHref: link przycisku (domyślnie: '#contact')
    - delay: opóźnienie AOS (domyślnie: 0)
--}}

@props([
    'name',
    'price',
    'currency' => 'zł',
    'period' => null,
    'features' => [],
    'featured' => false,
    'buttonText' => 'Wybierz',
    'buttonHref' => '#contact',
    'delay' => 0,
])

<div {{ $attributes->merge(['class' => 'pricing-card p-4 h-100 text-center' . ($featured ? ' featured' : '')]) }} 
     data-aos="fade-up" 
     data-aos-delay="{{ $delay }}">
    
    @if($featured)
    <div class="featured-badge mb-3">
        <span class="badge bg-primary">Polecany</span>
    </div>
    @endif
    
    <h4 class="mb-3">{{ $name }}</h4>
    
    <div class="price mb-4">
        <span class="display-4 fw-bold">{{ $price }}</span>
        <span class="currency">{{ $currency }}</span>
        @if($period)
        <span class="period text-white-50">/{{ $period }}</span>
        @endif
    </div>
    
    <ul class="list-unstyled mb-4 text-start">
        @foreach($features as $feature)
        <li class="mb-2 d-flex align-items-start">
            @if(is_array($feature))
                @if($feature['included'] ?? true)
                <i class="bi bi-check-circle-fill text-primary me-2 mt-1"></i>
                @else
                <i class="bi bi-x-circle text-muted me-2 mt-1"></i>
                @endif
                <span class="{{ ($feature['included'] ?? true) ? '' : 'text-muted' }}">{{ $feature['text'] }}</span>
            @else
                <i class="bi bi-check-circle-fill text-primary me-2 mt-1"></i>
                <span>{{ $feature }}</span>
            @endif
        </li>
        @endforeach
    </ul>
    
    <x-button :href="$buttonHref" :variant="$featured ? 'primary' : 'outline'" class="w-100">
        {{ $buttonText }}
    </x-button>
</div>
