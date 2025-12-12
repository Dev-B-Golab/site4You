{{-- 
    SEKCJA USŁUGI
    Karty usług + proces tworzenia strony
    Używa komponentów: x-section-header, x-card
--}}

<section id="services" aria-labelledby="services-title">
    <div class="container">
        <x-section-header 
            :title="__('site.services.title')" 
            :subtitle="__('site.services.subtitle')" 
            :centered="true" 
            titleId="services-title" />

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
            <article class="col-md-6 col-lg-4" role="listitem">
                <x-card 
                    :icon="$service['icon']"
                    :title="__('site.services.items.' . $service['key'] . '.title')"
                    :description="__('site.services.items.' . $service['key'] . '.desc')"
                    :link="route('service.show', $service['key'])"
                    :linkText="__('site.services.read_more')"
                    :delay="$index * 100" />
            </article>
            @endforeach
        </div>
    </div>
</section>

{{-- PODGLĄD SZABLONÓW --}}
@include('sections.templates-preview')

{{-- PROCES TWORZENIA STRONY --}}
<section id="process" aria-labelledby="process-title">
    <div class="container">
        @include('sections.process')
    </div>
</section>
