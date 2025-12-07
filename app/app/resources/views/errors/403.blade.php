{{--
|--------------------------------------------------------------------------
| STRONA BŁĘDU 403 - BRAK DOSTĘPU
|--------------------------------------------------------------------------
--}}

@extends('layouts.app')

@section('title', __('site.errors.403.title') . ' - ' . config('site.name'))

@section('content')
<section class="error-section">
    <div class="container">
        <div class="row min-vh-100 align-items-center justify-content-center">
            <div class="col-lg-8 col-xl-6 text-center">
                
                {{-- Kod błędu --}}
                <div class="error-code mb-4" data-aos="fade-up">
                    <span class="error-number error-danger">403</span>
                </div>
                
                {{-- Ikona --}}
                <div class="error-icon mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon-wrapper icon-danger">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                
                {{-- Nagłówek --}}
                <h1 class="error-title mb-3" data-aos="fade-up" data-aos-delay="200">
                    {{ __('site.errors.403.heading') }}
                </h1>
                
                {{-- Opis --}}
                <p class="error-message mb-5" data-aos="fade-up" data-aos-delay="300">
                    {{ __('site.errors.403.message') }}
                </p>
                
                {{-- Przyciski --}}
                <div class="error-actions" data-aos="fade-up" data-aos-delay="400">
                    <a href="{{ url('/') }}" class="btn btn-custom me-2 mb-2">
                        <i class="bi bi-house-door me-2"></i>
                        {{ __('site.errors.back_home') }}
                    </a>
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
