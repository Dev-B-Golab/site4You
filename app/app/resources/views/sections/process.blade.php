{{-- 
    SEKCJA PROCES
    Kroki tworzenia strony
    Używa komponentów: x-section-header, x-image
--}}

<div class="row mt-5 pt-5">
    <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-right" data-aos-duration="1000">
        <x-section-header 
            :title="__('site.process.title')" 
            :subtitle="__('site.process.subtitle')" 
            :centered="false" />
        
        {{-- MIEJSCE NA ILUSTRACJĘ PROCESU --}}
        <x-image 
            src="img/project-website.png" 
            alt="Code process" 
            height="450px" />
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
