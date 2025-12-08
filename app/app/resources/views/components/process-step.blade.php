{{-- 
    KOMPONENT: Krok procesu
    Użycie: <x-process-step number="1" title="Tytuł" description="Opis kroku" />
    
    Props:
    - number: numer kroku
    - title: tytuł kroku
    - description: opis kroku
    - delay: opóźnienie animacji AOS (domyślnie: 0)
--}}

@props([
    'number',
    'title',
    'description' => '',
    'delay' => 0,
])

<div {{ $attributes->merge(['class' => 'process-step']) }} 
     data-aos="fade-up" 
     data-aos-duration="800"
     data-aos-delay="{{ $delay }}">
    <div class="step-number">{{ $number }}</div>
    <h5 class="step-title">{{ $title }}</h5>
    <p class="step-desc">{{ $description }}</p>
</div>
