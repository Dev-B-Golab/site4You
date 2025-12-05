@extends('layouts.app')

@section('title', __('site.contact.success_page.title') . ' - ' . config('site.name'))

@section('content')
<section class="hero-section d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center" data-aos="fade-up" data-aos-duration="1000">
                {{-- IKONA SUKCESU --}}
                <div class="success-icon mb-4">
                    <div class="icon-circle mx-auto" style="width: 120px; height: 120px; background: linear-gradient(135deg, var(--accent-color), var(--accent-hover)); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-check-lg text-white" style="font-size: 4rem;"></i>
                    </div>
                </div>
                
                {{-- TYTUŁ --}}
                <h1 class="hero-title mb-3">
                    {{ __('site.contact.success_page.heading') }}
                </h1>
                
                {{-- OPIS --}}
                <p class="hero-subtitle mb-4">
                    {{ __('site.contact.success_page.message') }}
                </p>
                <p class="text-gray mb-4">
                    {{ __('site.contact.success_page.response_time') }}
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
