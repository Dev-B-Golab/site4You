{{-- 
    SEKCJA HERO (INTRO)
    Główny baner strony z tytułem i przyciskami
--}}

<section id="intro" class="hero-section" aria-label="Sekcja powitalna">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right" data-aos-duration="1000">
                <h1 class="hero-title">
                    {{ __('site.hero.title') }}<br>
                    <span class="text-muted-custom">{{ __('site.hero.subtitle') }}</span>
                </h1>
                <p class="hero-subtitle">
                    {{ __('site.hero.description') }}
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('home') }}" data-scroll="contact" class="btn btn-custom" aria-label="Przejdź do formularza kontaktowego">{{ __('site.hero.btn_primary') }}</a>
                    <a href="{{ route('home') }}" data-scroll="services" class="btn btn-outline-custom" aria-label="Zobacz oferowane usługi">{{ __('site.hero.btn_secondary') }}</a>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                <div class="img-placeholder" style="height: 400px;">
                   <img src="{{ asset('img/intro-code.jpg') }}" alt="Profesjonalne tworzenie stron internetowych - kod źródłowy" loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>
