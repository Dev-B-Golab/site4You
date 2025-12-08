{{-- 
    SEKCJA USŁUGI
    Karty usług + proces tworzenia strony
--}}

<section id="services" aria-labelledby="services-title">
    <div class="container">
        <header class="text-center mb-5" data-aos="fade-up" data-aos-duration="1000">
            <h2 id="services-title" class="section-title mx-auto" style="display: table;">{{ __('site.services.title') }}</h2>
            <p class="section-subtitle">{{ __('site.services.subtitle') }}</p>
        </header>

        {{-- KARTY USŁUG --}}
        <div class="row g-4 mb-5" role="list" aria-label="Lista usług">
            @foreach([
                ['icon' => 'bi-window', 'key' => 'websites'],
                ['icon' => 'bi-cart3', 'key' => 'ecommerce'],
                ['icon' => 'bi-code-square', 'key' => 'webapps'],
                ['icon' => 'bi-search', 'key' => 'seo'],
                ['icon' => 'bi-phone', 'key' => 'responsive'],
                ['icon' => 'bi-gear', 'key' => 'support'],
            ] as $index => $service)
            <article class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $index * 100 }}" role="listitem">
                <a href="{{ route('service.show', $service['key']) }}" class="text-decoration-none" aria-label="Dowiedz się więcej o usłudze: {{ __('site.services.items.' . $service['key'] . '.title') }}">
                    <div class="card-custom">
                        <div class="card-icon" aria-hidden="true">
                            <i class="bi {{ $service['icon'] }}"></i>
                        </div>
                        <h3 class="card-title">{{ __('site.services.items.' . $service['key'] . '.title') }}</h3>
                        <p class="card-text">{{ __('site.services.items.' . $service['key'] . '.desc') }}</p>
                        <span class="card-read-more">
                            {{ __('site.services.read_more') }} <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
                        </span>
                    </div>
                </a>
            </article>
            @endforeach
        </div>

        {{-- PROCES TWORZENIA STRONY --}}
        @include('sections.process')
    </div>
</section>
