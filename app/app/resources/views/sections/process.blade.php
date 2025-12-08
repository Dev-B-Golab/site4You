{{-- 
    SEKCJA PROCES
    Kroki tworzenia strony
    Używa komponentów: x-section-header, x-image, x-process-step
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
        <x-process-step 
            :number="$index + 1"
            :title="$step['title']"
            :description="$step['desc']"
            :delay="$index * 150" />
        @endforeach
    </div>
</div>
