{{-- 
    HEADER / NAVBAR
    Nawigacja strony z przełącznikiem języka
--}}

<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#intro">
           <img src="{{ asset('img/logo.png') }}" alt="Logo" style="height: 60px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#intro">{{ __('site.nav.home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">{{ __('site.nav.about') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#services">{{ __('site.nav.services') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#faq">{{ __('site.nav.faq') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">{{ __('site.nav.contact') }}</a>
                </li>
                {{-- PRZEŁĄCZNIK JĘZYKA --}}
                <li class="nav-item dropdown ms-lg-3">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-globe me-1"></i>{{ strtoupper(app()->getLocale()) }}
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
