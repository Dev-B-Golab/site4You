{{-- 
    SEKCJA O MNIE
    Prezentacja autora strony
--}}

<section id="about" class="bg-darker">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-right" data-aos-duration="1000">
                {{-- MIEJSCE NA ZDJĘCIE PROFILOWE - zamień na <img> --}}
                <div class="img-placeholder" style="height: 450px;">
                <img src="{{ asset('img/its-me.jpg') }}" alt="Profile photo">
                </div>
            </div>
            <div class="col-lg-6 offset-lg-1" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                <h2 class="section-title">{{ __('site.about.title') }}</h2>
                <p class="section-subtitle">{{ __('site.about.subtitle') }}</p>
                
                <p class="text-gray mb-4">
                    {{ __('site.about.text1') }}
                </p>
                <p class="text-gray mb-4">
                    {{ __('site.about.text2') }}
                </p>
                
                {{-- STATYSTYKI z PureCounter --}}
                <div class="row mt-4">
                    @foreach([
                        ['start' => 0, 'end' => 50, 'suffix' => '+', 'key' => 'projects'],
                        ['start' => 0, 'end' => 5, 'suffix' => '+', 'key' => 'experience'],
                        ['start' => 0, 'end' => 100, 'suffix' => '%', 'key' => 'satisfaction'],
                    ] as $stat)
                    <div class="col-4 text-center">
                        <h3 class="stat-number">
                            <span class="purecounter"
                                  data-purecounter-start="{{ $stat['start'] }}"
                                  data-purecounter-end="{{ $stat['end'] }}"
                                  data-purecounter-suffix="{{ $stat['suffix'] }}"
                                  data-purecounter-duration="2">0</span>
                        </h3>
                        <p class="stat-label">{{ __('site.about.stats.' . $stat['key']) }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
