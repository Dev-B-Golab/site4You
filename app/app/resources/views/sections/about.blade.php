{{-- 
    SEKCJA O MNIE
    Prezentacja autora strony
    Używa komponentów: x-section-header, x-image, x-stat
--}}

<section id="about" class="bg-darker" aria-labelledby="about-title">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-right" data-aos-duration="1000">
                <x-image 
                    src="img/its-me.jpg" 
                    alt="Webdeveloper - zdjęcie profilowe" 
                    height="450px" />
            </div>
            <div class="col-lg-6 offset-lg-1" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                <x-section-header 
                    :title="__('site.about.title')" 
                    :subtitle="__('site.about.subtitle')" 
                    :centered="false" 
                    titleId="about-title" />
                
                <p class="text-gray mb-4">
                    {{ __('site.about.text1') }}
                </p>
                <p class="text-gray mb-4">
                    {{ __('site.about.text2') }}
                </p>
                
                {{-- STATYSTYKI z PureCounter --}}
                <div class="row mt-4" role="list" aria-label="Statystyki">
                    <div class="col-4 text-center" role="listitem">
                        <x-stat :value="1000000" suffix="+" :label="__('site.about.stats.line_code')" />
                    </div>
                    <div class="col-4 text-center" role="listitem">
                        <x-stat :value="3" suffix="+" :label="__('site.about.stats.experience')" />
                    </div>
                    <div class="col-4 text-center" role="listitem">
                        <x-stat :value="100" suffix="%" :label="__('site.about.stats.satisfaction')" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
