{{-- 
    KOMPONENT: Testimonial / Opinia
    Użycie: <x-testimonial name="Jan Kowalski" role="CEO" text="Świetna praca!" />
    
    Props:
    - name: imię i nazwisko
    - role: stanowisko/firma (opcjonalne)
    - text: treść opinii
    - avatar: ścieżka do zdjęcia (opcjonalne)
    - rating: ocena 1-5 gwiazdek (opcjonalne)
    - delay: opóźnienie AOS (domyślnie: 0)
--}}

@props([
    'name',
    'role' => null,
    'text',
    'avatar' => null,
    'rating' => null,
    'delay' => 0,
])

<div {{ $attributes->merge(['class' => 'testimonial-card p-4 h-100']) }} 
     data-aos="fade-up" 
     data-aos-delay="{{ $delay }}">
    
    @if($rating)
    <div class="rating mb-3">
        @for($i = 1; $i <= 5; $i++)
            <i class="bi {{ $i <= $rating ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}"></i>
        @endfor
    </div>
    @endif
    
    <blockquote class="mb-4">
        <i class="bi bi-quote fs-2 text-primary opacity-50"></i>
        <p class="mb-0 text-white-50">{{ $text }}</p>
    </blockquote>
    
    <div class="d-flex align-items-center">
        @if($avatar)
        <img src="{{ asset($avatar) }}" 
             alt="{{ $name }}" 
             class="rounded-circle me-3" 
             width="50" 
             height="50"
             loading="lazy">
        @else
        <div class="avatar-placeholder rounded-circle me-3 d-flex align-items-center justify-content-center" 
             style="width: 50px; height: 50px; background: var(--primary-color);">
            <span class="fw-bold text-dark">{{ mb_substr($name, 0, 1) }}</span>
        </div>
        @endif
        
        <div>
            <strong class="d-block">{{ $name }}</strong>
            @if($role)
            <small class="text-white-50">{{ $role }}</small>
            @endif
        </div>
    </div>
</div>
