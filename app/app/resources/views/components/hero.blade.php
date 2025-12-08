{{-- 
    KOMPONENT: Hero section
    Użycie: <x-hero title="Witaj" subtitle="Tworzę strony" :buttons="[...]" />
    
    Props:
    - title: główny tytuł (opcjonalny, można użyć slot:title)
    - subtitle: podtytuł (opcjonalny)
    - description: opis (opcjonalny)
    - buttons: tablica przycisków [['text' => 'CTA', 'href' => '#', 'variant' => 'primary']]
    - minHeight: minimalna wysokość (domyślnie: 100vh)
    - overlay: czy ciemne overlay (domyślnie: true)
    - bgImage: obrazek tła (opcjonalny)
--}}

@props([
    'title' => null,
    'subtitle' => null,
    'description' => null,
    'buttons' => [],
    'minHeight' => '100vh',
    'overlay' => true,
    'bgImage' => null,
])

<section id="hero" 
    class="hero-section d-flex align-items-center" 
    style="min-height: {{ $minHeight }}; @if($bgImage) background-image: url('{{ asset($bgImage) }}'); background-size: cover; background-position: center; @endif"
    {{ $attributes }}>
    
    @if($overlay)
    <div class="hero-overlay"></div>
    @endif
    
    <div class="container position-relative z-1">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                
                @if($subtitle)
                <p class="lead text-primary mb-3" data-aos="fade-up">{{ $subtitle }}</p>
                @endif
                
                @if($title)
                <h1 class="display-3 fw-bold mb-4" data-aos="fade-up" data-aos-delay="100">
                    {!! $title !!}
                </h1>
                @elseif(isset($titleSlot))
                <h1 class="display-3 fw-bold mb-4" data-aos="fade-up" data-aos-delay="100">
                    {{ $titleSlot }}
                </h1>
                @endif
                
                @if($description)
                <p class="lead mb-5 text-white-50" data-aos="fade-up" data-aos-delay="200">
                    {{ $description }}
                </p>
                @endif
                
                @if(count($buttons) > 0)
                <div class="d-flex flex-wrap justify-content-center gap-3" data-aos="fade-up" data-aos-delay="300">
                    @foreach($buttons as $button)
                    <x-button 
                        :href="$button['href'] ?? '#'" 
                        :variant="$button['variant'] ?? 'primary'"
                        :icon="$button['icon'] ?? null">
                        {{ $button['text'] ?? 'Przycisk' }}
                    </x-button>
                    @endforeach
                </div>
                @endif
                
                {{ $slot }}
                
            </div>
        </div>
    </div>
</section>
