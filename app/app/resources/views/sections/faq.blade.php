{{-- 
    SEKCJA FAQ
    Najczęściej zadawane pytania
    Używa komponentów: x-section-header, x-accordion-item, x-button
--}}

<section id="faq">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-right" data-aos-duration="1000">
                <x-section-header 
                    :title="__('site.faq.title')" 
                    :subtitle="__('site.faq.subtitle')" 
                    :centered="false" />
                <p class="text-gray">
                    {{ __('site.faq.cta_text') }}
                </p>
                <x-button href="{{ route('home') }}" variant="primary" data-scroll="contact" class="mt-3">
                    {{ __('site.faq.cta_button') }}
                </x-button>
            </div>
            <div class="col-lg-6 offset-lg-1" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                <div class="accordion accordion-custom" id="faqAccordion">
                    @foreach(__('site.faq.items') as $index => $faq)
                    <x-accordion-item 
                        :id="'faq' . $index"
                        :question="$faq['question']"
                        :answer="$faq['answer']"
                        :open="$index === 0" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
