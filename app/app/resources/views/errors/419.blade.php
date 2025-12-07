{{--
|--------------------------------------------------------------------------
| STRONA BŁĘDU 419 - SESJA WYGASŁA
|--------------------------------------------------------------------------
--}}

@extends('layouts.app')

@section('title', __('site.errors.419.title') . ' - ' . config('site.name'))

@section('content')
<section class="error-section">
    <div class="container">
        <div class="row min-vh-100 align-items-center justify-content-center">
            <div class="col-lg-8 col-xl-6 text-center">
                
                {{-- Kod błędu --}}
                <div class="error-code mb-4" data-aos="fade-up">
                    <span class="error-number error-warning">419</span>
                </div>
                
                {{-- Ikona --}}
                <div class="error-icon mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon-wrapper icon-warning">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                </div>
                
                {{-- Nagłówek --}}
                <h1 class="error-title mb-3" data-aos="fade-up" data-aos-delay="200">
                    {{ __('site.errors.419.heading') }}
                </h1>
                
                {{-- Opis --}}
                <p class="error-message mb-5" data-aos="fade-up" data-aos-delay="300">
                    {{ __('site.errors.419.message') }}
                </p>
                
                {{-- Przyciski --}}
                <div class="error-actions" data-aos="fade-up" data-aos-delay="400">
                    <button onclick="location.reload()" class="btn btn-custom me-2 mb-2">
                        <i class="bi bi-arrow-clockwise me-2"></i>
                        {{ __('site.errors.refresh_page') }}
                    </button>
                    <a href="{{ url('/') }}" class="btn btn-outline-custom mb-2">
                        <i class="bi bi-house-door me-2"></i>
                        {{ __('site.errors.back_home') }}
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</section>
@endsection
