{{-- 
    SEKCJA USŁUGI
    Karty usług + proces tworzenia strony
--}}

<section id="services">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="1000">
            <h2 class="section-title mx-auto" style="display: table;">{{ __('site.services.title') }}</h2>
            <p class="section-subtitle">{{ __('site.services.subtitle') }}</p>
        </div>

        {{-- KARTY USŁUG --}}
        <div class="row g-4 mb-5">
            @foreach([
                ['icon' => 'bi-window', 'key' => 'websites'],
                ['icon' => 'bi-cart3', 'key' => 'ecommerce'],
                ['icon' => 'bi-code-square', 'key' => 'webapps'],
                ['icon' => 'bi-search', 'key' => 'seo'],
                ['icon' => 'bi-phone', 'key' => 'responsive'],
                ['icon' => 'bi-gear', 'key' => 'support'],
            ] as $index => $service)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $index * 100 }}">
                <div class="card-custom">
                    <div class="card-icon">
                        <i class="bi {{ $service['icon'] }}"></i>
                    </div>
                    <h4 class="card-title">{{ __('site.services.items.' . $service['key'] . '.title') }}</h4>
                    <p class="card-text">{{ __('site.services.items.' . $service['key'] . '.desc') }}</p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- PROCES TWORZENIA STRONY --}}
        @include('sections.process')
    </div>
</section>
