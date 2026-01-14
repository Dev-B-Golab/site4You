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
                <x-button href="{{ route('home') }}" variant="outline" icon="bi-arrow-left" data-scroll="services" class="mb-4">
                    {{ __('site.services.back') }}
                </x-button>
                <h1 class="hero-title">{{ __('site.services.items.' . $service . '.title') }}</h1>
                <p class="hero-subtitle">{{ __('site.services.items.' . $service . '.desc') }}</p>
                <x-button href="#contact-section" variant="primary" class="mt-3">
                    {{ __('site.services.cta') }}
                </x-button>
            </div>
        </div>
    </div>
</section>

{{-- SZCZEGÓŁY USŁUGI --}}
<section class="bg-darker">
    <div class="container">
        <div class="row">
            <div class="col-lg-8" data-aos="fade-up" data-aos-duration="1000">
                <x-section-header 
                    :title="__('site.services.details.' . $service . '.heading')"
                    :subtitle="__('site.services.details.' . $service . '.subheading')"
                    :centered="false" />
                
                <div class="text-gray">
                    {!! __('site.services.details.' . $service . '.content') !!}
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                <div class="card-custom">
                    <h4 class="card-title mb-4">{{ __('site.services.includes') }}</h4>
                    <x-feature-list :features="__('site.services.details.' . $service . '.features')" />
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
                <x-section-header 
                    :title="__('site.services.contact_title')"
                    :subtitle="__('site.services.contact_subtitle')"
                    :centered="true" />
                <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
                    <x-button 
                        href="{{ route('home', ['service' => __('site.services.items.' . $service . '.title')]) }}#contact" 
                        variant="primary" 
                        icon="bi-envelope">
                        {{ __('site.services.contact_btn') }}
                    </x-button>
                    <x-button href="tel:{{ str_replace(' ', '', config('site.phone')) }}" variant="outline" icon="bi-telephone">
                        {{ config('site.phone') }}
                    </x-button>
                    <x-button href="tel:{{ str_replace(' ', '', config('site.phone2')) }}" variant="outline" icon="bi-telephone">
                        {{ config('site.phone2') }}
                    </x-button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
