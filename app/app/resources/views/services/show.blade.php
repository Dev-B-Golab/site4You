@extends('layouts.app')

@section('title', __('site.services.items.' . $service . '.title') . ' - ' . config('site.name'))

@section('meta_description', __('site.services.items.' . $service . '.desc'))

@section('meta_keywords', __('site.services.items.' . $service . '.title') . ', tworzenie stron, webdeveloper, ' . config('site.address'))

@section('schema')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "Service",
    "name": "{{ __('site.services.items.' . $service . '.title') }}",
    "description": "{{ __('site.services.items.' . $service . '.desc') }}",
    "provider": {
        "@type": "LocalBusiness",
        "name": "{{ config('site.name') }}",
        "telephone": "{{ config('site.phone') }}",
        "email": "{{ config('site.email') }}"
    },
    "areaServed": {
        "@type": "Country",
        "name": "Poland"
    }
}
</script>
@endsection

@section('content')
{{-- HERO USŁUGI --}}
<section class="hero-section" style="min-height: 60vh; padding-top: 120px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8" data-aos="fade-up" data-aos-duration="1000">
                <a href="{{ route('home') }}#services" class="btn btn-outline-custom mb-4">
                    <i class="bi bi-arrow-left me-2"></i>{{ __('site.services.back') }}
                </a>
                <h1 class="hero-title">{{ __('site.services.items.' . $service . '.title') }}</h1>
                <p class="hero-subtitle">{{ __('site.services.items.' . $service . '.desc') }}</p>
                <a href="#" data-scroll="contact-section" class="btn btn-custom mt-3">{{ __('site.services.cta') }}</a>
            </div>
        </div>
    </div>
</section>

{{-- SZCZEGÓŁY USŁUGI --}}
<section class="bg-darker">
    <div class="container">
        <div class="row">
            <div class="col-lg-8" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="section-title">{{ __('site.services.details.' . $service . '.heading') }}</h2>
                <p class="section-subtitle">{{ __('site.services.details.' . $service . '.subheading') }}</p>
                
                <div class="text-gray">
                    {!! __('site.services.details.' . $service . '.content') !!}
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                <div class="card-custom">
                    <h4 class="card-title mb-4">{{ __('site.services.includes') }}</h4>
                    <ul class="list-unstyled">
                        @foreach(__('site.services.details.' . $service . '.features') as $feature)
                        <li class="mb-3">
                            <i class="bi bi-check-circle text-white me-2"></i>
                            <span class="text-gray">{{ $feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FORMULARZ KONTAKTOWY --}}
<section id="contact-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="section-title mx-auto" style="display: table;">{{ __('site.services.contact_title') }}</h2>
                <p class="section-subtitle">{{ __('site.services.contact_subtitle') }}</p>
                <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
                    <a href="{{ route('home') }}#contact" class="btn btn-custom">
                        <i class="bi bi-envelope me-2"></i>{{ __('site.services.contact_btn') }}
                    </a>
                    <a href="tel:{{ config('site.phone') }}" class="btn btn-outline-custom">
                        <i class="bi bi-telephone me-2"></i>{{ config('site.phone') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
