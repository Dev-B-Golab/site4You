{{-- 
    SEKCJA PROCES
    Kroki tworzenia strony
--}}

<div class="row mt-5 pt-5">
    <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-right" data-aos-duration="1000">
        <h3 class="section-title">{{ __('site.process.title') }}</h3>
        <p class="section-subtitle">{{ __('site.process.subtitle') }}</p>
        
        {{-- MIEJSCE NA ILUSTRACJĘ PROCESU --}}
        <div class="img-placeholder" style="height: 450px;">
            <img src="{{ asset('img/project-website.png') }}" alt="Code process">
        </div>
    </div>
    <div class="col-lg-6 offset-lg-1">
        {{-- KROKI PROCESU --}}
        @foreach(__('site.process.steps') as $index => $step)
        <div class="process-step" data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $index * 150 }}">
            <div class="step-number">{{ $index + 1 }}</div>
            <h5 class="step-title">{{ $step['title'] }}</h5>
            <p class="step-desc">{{ $step['desc'] }}</p>
        </div>
        @endforeach
    </div>
</div>
