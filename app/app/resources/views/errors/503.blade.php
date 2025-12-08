{{--
|--------------------------------------------------------------------------
| STRONA BŁĘDU 503 - SERWIS NIEDOSTĘPNY (MAINTENANCE)
|--------------------------------------------------------------------------
--}}

@extends('layouts.app')

@section('title', __('site.errors.503.title') . ' - ' . config('site.name'))

@section('robots', 'noindex, nofollow')

@section('content')
<section class="error-section">
    <div class="container">
        <div class="row min-vh-100 align-items-center justify-content-center">
            <div class="col-lg-8 col-xl-6 text-center">
                
                {{-- Kod błędu --}}
                <div class="error-code mb-4" data-aos="fade-up">
                    <span class="error-number error-info">503</span>
                </div>
                
                {{-- Ikona --}}
                <div class="error-icon mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon-wrapper icon-info spin-slow">
                        <i class="bi bi-gear-wide-connected"></i>
                    </div>
                </div>
                
                {{-- Nagłówek --}}
                <h1 class="error-title mb-3" data-aos="fade-up" data-aos-delay="200">
                    {{ __('site.errors.503.heading') }}
                </h1>
                
                {{-- Opis --}}
                <p class="error-message mb-4" data-aos="fade-up" data-aos-delay="300">
                    {{ __('site.errors.503.message') }}
                </p>
                
                {{-- Informacja dodatkowa --}}
                <div class="card-custom mb-5" data-aos="fade-up" data-aos-delay="400">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="bi bi-clock me-3 fs-4"></i>
                        <span class="text-gray">{{ __('site.errors.503.info') }}</span>
                    </div>
                </div>
                
                {{-- Przyciski --}}
                <div class="error-actions" data-aos="fade-up" data-aos-delay="500">
                    <button onclick="location.reload()" class="btn btn-custom me-2 mb-2">
                        <i class="bi bi-arrow-clockwise me-2"></i>
                        {{ __('site.errors.try_again') }}
                    </button>
                    <a href="{{ url('/#contact') }}" class="btn btn-outline-custom mb-2">
                        <i class="bi bi-envelope me-2"></i>
                        {{ __('site.errors.contact_us') }}
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</section>
@endsection
