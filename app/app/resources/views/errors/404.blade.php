{{--
|--------------------------------------------------------------------------
| STRONA BŁĘDU 404 - NIE ZNALEZIONO
|--------------------------------------------------------------------------
--}}

@extends('layouts.app')

@section('title', __('site.errors.404.title') . ' - ' . config('site.name'))

@section('content')
<section class="error-section">
    <div class="container">
        <div class="row min-vh-100 align-items-center justify-content-center">
            <div class="col-lg-8 col-xl-6 text-center">
                
                {{-- Kod błędu --}}
                <div class="error-code mb-5" data-aos="fade-up">
                    <span class="error-number error-large">404</span>
                </div>
                
                {{-- Nagłówek --}}
                <h1 class="error-title mb-3" data-aos="fade-up" data-aos-delay="100">
                    {{ __('site.errors.404.heading') }}
                </h1>
                
                {{-- Opis --}}
                <p class="error-message mb-5" data-aos="fade-up" data-aos-delay="200">
                    {{ __('site.errors.404.message') }}
                </p>
                
                {{-- Sugestie --}}
                <div class="card-custom mb-5" data-aos="fade-up" data-aos-delay="300">
                    <p class="text-white mb-3 fw-500">{{ __('site.errors.404.suggestions_title') }}</p>
                    <ul class="error-suggestions list-unstyled mb-0">
                        <li>
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ __('site.errors.404.suggestion_1') }}
                        </li>
                        <li>
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ __('site.errors.404.suggestion_2') }}
                        </li>
                        <li>
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ __('site.errors.404.suggestion_3') }}
                        </li>
                    </ul>
                </div>
                
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
