{{-- 
    KOMPONENT: Statystyka z animacją
    Użycie: <x-stat value="100" suffix="+" label="Projektów" />
    
    Props:
    - value: wartość końcowa (liczba)
    - suffix: znak po liczbie (np. "+", "%")
    - prefix: znak przed liczbą (opcjonalny)
    - label: etykieta pod liczbą
    - start: wartość początkowa (domyślnie: 0)
    - duration: czas animacji w sekundach (domyślnie: 2)
--}}

@props([
    'value' => 0,
    'suffix' => '',
    'prefix' => '',
    'label' => '',
    'start' => 0,
    'duration' => 2,
])

<div {{ $attributes->merge(['class' => 'text-center']) }}>
    <h3 class="stat-number">
        {{ $prefix }}<span class="purecounter"
              data-purecounter-start="{{ $start }}"
              data-purecounter-end="{{ $value }}"
              data-purecounter-duration="{{ $duration }}">0</span>{{ $suffix }}
    </h3>
    @if($label)
    <p class="stat-label">{{ $label }}</p>
    @endif
</div>
