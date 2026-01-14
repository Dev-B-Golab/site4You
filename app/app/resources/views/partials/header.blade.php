{{-- 
    HEADER / NAVBAR
    Nawigacja strony z przełącznikiem języka
    Używa komponentów: x-nav-link, x-language-switcher
--}}

<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container position-relative">
        <a class="navbar-brand" href="{{ route('home') }}" data-scroll="intro">
           <img src="{{ asset('img/logo.png') }}" alt="Logo" class="navbar-logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <x-nav-link scroll="intro">{{ __('site.nav.home') }}</x-nav-link>
                </li>
                <!-- <li class="nav-item">
                    <x-nav-link scroll="about">{{ __('site.nav.about') }}</x-nav-link>
                </li> -->
                {{-- DROPDOWN USŁUGI --}}
                <li class="nav-item dropdown">
                    <x-nav-link :dropdown="true" :active="request()->is('uslugi/*') || request()->routeIs('service.show')">
                        {{ __('site.nav.services') }}
                    </x-nav-link>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li>
                            <a class="dropdown-item" href="{{ route('home') }}" data-scroll="services">
                                <i class="bi bi-grid me-2"></i>{{ __('site.nav.all_services') }}
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        @foreach(['websites', 'ecommerce', 'webapps'] as $serviceKey)
                        <li>
                            <a class="dropdown-item" href="{{ route('service.show', $serviceKey) }}">
                                {{ __('site.services.items.' . $serviceKey . '.title') }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <x-nav-link scroll="templates">{{ __('site.nav.templates') }}</x-nav-link>
                </li>
                <li class="nav-item">
                    <x-nav-link scroll="faq">{{ __('site.nav.faq') }}</x-nav-link>
                </li>
                <li class="nav-item">
                    <x-nav-link scroll="contact">{{ __('site.nav.contact') }}</x-nav-link>
                </li>
                {{-- PRZEŁĄCZNIK JĘZYKA --}}
                <x-language-switcher />
            </ul>
        </div>
    </div>
</nav>
