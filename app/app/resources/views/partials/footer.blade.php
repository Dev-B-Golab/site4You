{{-- 
    FOOTER / STOPKA
    Stopka strony z tłumaczeniami
--}}

<footer class="footer">
    <div class="container">
        <div class="row">
            {{-- KOLUMNA 1: Logo i opis --}}
            <div class="col-lg-4 mb-4 mb-lg-0">
                <a href="{{ route('home') }}" class="footer-brand">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" style="height: 200px;">
                </a>
                <p class="footer-text">
                    {{ __('site.footer.description') }}
                </p>
            </div>
            
            {{-- KOLUMNA 2: Nawigacja --}}
            <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                <h5 class="footer-title">{{ __('site.footer.navigation') }}</h5>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}" data-scroll="intro">{{ __('site.nav.home') }}</a></li>
                    <li><a href="{{ route('home') }}" data-scroll="about">{{ __('site.nav.about') }}</a></li>
                    <li><a href="{{ route('home') }}" data-scroll="services">{{ __('site.nav.services') }}</a></li>
                    <li><a href="{{ route('home') }}" data-scroll="faq">{{ __('site.nav.faq') }}</a></li>
                    <li><a href="{{ route('home') }}" data-scroll="contact">{{ __('site.nav.contact') }}</a></li>
                </ul>
            </div>
            
            {{-- KOLUMNA 3: Usługi --}}
            <div class="col-lg-3 col-md-4 mb-4 mb-md-0">
                <h5 class="footer-title">{{ __('site.footer.services') }}</h5>
                <ul class="footer-links">
                    <li><a href="{{ route('service.show', 'websites') }}">{{ __('site.services.items.websites.title') }}</a></li>
                    <li><a href="{{ route('service.show', 'ecommerce') }}">{{ __('site.services.items.ecommerce.title') }}</a></li>
                    <li><a href="{{ route('service.show', 'webapps') }}">{{ __('site.services.items.webapps.title') }}</a></li>
                    <li><a href="{{ route('service.show', 'seo') }}">{{ __('site.services.items.seo.title') }}</a></li>
                </ul>
            </div>
            
            {{-- KOLUMNA 4: Kontakt --}}
            <div class="col-lg-3 col-md-4">
                <h5 class="footer-title">{{ __('site.footer.contact') }}</h5>
                <ul class="footer-contact">
                    <li><i class="bi bi-envelope"></i> {{ config('site.email') }}</li>
                    <li><i class="bi bi-phone"></i> {{ config('site.phone') }}</li>
                    <li><i class="bi bi-geo-alt"></i> {{ config('site.address') }}</li>
                </ul>
                {{-- SOCIAL MEDIA --}}
                <div class="footer-social mt-3">
                    @foreach(config('site.social') as $platform => $url)
                    <a href="{{ $url }}" aria-label="{{ ucfirst($platform) }}">
                        <i class="bi bi-{{ $platform }}"></i>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        
        {{-- COPYRIGHT --}}
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} {{ config('site.name') }}. {{ __('site.footer.copyright') }}</p>
        </div>
    </div>
</footer>
