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

<div {{ $attributes->merge(['class' => 'col-md-6 col-lg-3 mb-4']) }} 
     data-aos="fade-up" 
     data-aos-delay="{{ $delay }}">
    <div class="process-step text-center h-100 p-4">
        <div class="process-number mb-3">{{ $number }}</div>
        <h4>{{ $title }}</h4>
        <p class="text-white-50 mb-0">{{ $description }}</p>
    </div>
</div>
