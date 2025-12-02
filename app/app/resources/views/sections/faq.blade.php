{{-- 
    SEKCJA FAQ
    Najczęściej zadawane pytania
--}}

<section id="faq" class="bg-darker">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-right" data-aos-duration="1000">
                <h2 class="section-title">{{ __('site.faq.title') }}</h2>
                <p class="section-subtitle">{{ __('site.faq.subtitle') }}</p>
                <p class="text-gray">
                    {{ __('site.faq.cta_text') }}
                </p>
                <a href="#contact" class="btn btn-custom mt-3">{{ __('site.faq.cta_button') }}</a>
            </div>
            <div class="col-lg-6 offset-lg-1" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                <div class="accordion accordion-custom" id="faqAccordion">
                    @foreach(__('site.faq.items') as $index => $faq)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" 
                                    type="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#faq{{ $index }}">
                                {{ $faq['question'] }}
                            </button>
                        </h2>
                        <div id="faq{{ $index }}" 
                             class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" 
                             data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                {{ $faq['answer'] }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
