{{-- 
    HEADER / NAVBAR
    Nawigacja strony z przełącznikiem języka
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
                    <a class="nav-link" href="{{ route('home') }}" data-scroll="intro">{{ __('site.nav.home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}" data-scroll="about">{{ __('site.nav.about') }}</a>
                </li>
                {{-- DROPDOWN USŁUGI --}}
                <li class="nav-item dropdown">
                    <a class="nav-link {{ request()->is('uslugi/*') || request()->routeIs('service.show') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown">
                        {{ __('site.nav.services') }} <i class="bi bi-chevron-down small"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li>
                            <a class="dropdown-item" href="{{ route('home') }}" data-scroll="services">
                                <i class="bi bi-grid me-2"></i>{{ __('site.nav.all_services') }}
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        @foreach(['websites', 'ecommerce', 'webapps', 'seo', 'responsive', 'support'] as $serviceKey)
                        <li>
                            <a class="dropdown-item" href="{{ route('service.show', $serviceKey) }}">
                                {{ __('site.services.items.' . $serviceKey . '.title') }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}" data-scroll="faq">{{ __('site.nav.faq') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}" data-scroll="contact">{{ __('site.nav.contact') }}</a>
                </li>
                {{-- PRZEŁĄCZNIK JĘZYKA --}}
                <li class="nav-item dropdown ms-lg-3">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-globe me-1"></i>{{ strtoupper(app()->getLocale()) }} <i class="bi bi-chevron-down small"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                        <li>
                            <a class="dropdown-item {{ app()->getLocale() === 'pl' ? 'active' : '' }}" 
                               href="{{ route('lang.switch', 'pl') }}">
                                🇵🇱 Polski
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ app()->getLocale() === 'en' ? 'active' : '' }}" 
                               href="{{ route('lang.switch', 'en') }}">
                                🇬🇧 English
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
