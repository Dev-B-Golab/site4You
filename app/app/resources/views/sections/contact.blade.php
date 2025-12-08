{{-- 
    SEKCJA KONTAKT
    Formularz kontaktowy + dane kontaktowe
    Używa komponentów: x-section-header, x-icon-text, x-alert, x-button
--}}

<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-right" data-aos-duration="1000">
                <x-section-header 
                    :title="__('site.contact.title')" 
                    :subtitle="__('site.contact.subtitle')" 
                    :centered="false" />
                <p class="text-gray mb-4">
                    {{ __('site.contact.description') }}
                </p>
                
                {{-- DANE KONTAKTOWE --}}
                <x-icon-text 
                    icon="bi-envelope" 
                    :label="__('site.contact.labels.email')" 
                    :value="config('site.email')" 
                    class="mb-3" />
                <x-icon-text 
                    icon="bi-phone" 
                    :label="__('site.contact.labels.phone')" 
                    :value="config('site.phone')" 
                    class="mb-3" />
                <x-icon-text 
                    icon="bi-geo-alt" 
                    :label="__('site.contact.labels.location')" 
                    :value="config('site.address')" />
            </div>
            <div class="col-lg-6 offset-lg-1" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                {{-- ALERT SUKCESU --}}
                @if(session('success'))
                    <x-alert type="success" :message="__('site.contact.form.success')" class="mb-4" />
                @endif

                {{-- FORMULARZ KONTAKTOWY --}}
                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">{{ __('site.contact.form.name') }} *</label>
                            <input type="text" 
                                   class="form-control form-control-custom @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   placeholder="{{ __('site.contact.form.name_placeholder') }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">{{ __('site.contact.form.email') }} *</label>
                            <input type="email" 
                                   class="form-control form-control-custom @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   placeholder="{{ __('site.contact.form.email_placeholder') }}" 
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="phone" class="form-label">{{ __('site.contact.form.phone') }}</label>
                            <input type="tel" 
                                   class="form-control form-control-custom" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone') }}" 
                                   placeholder="{{ __('site.contact.form.phone_placeholder') }}">
                        </div>
                        <div class="col-12">
                            <label for="message" class="form-label">{{ __('site.contact.form.message') }} *</label>
                            <textarea class="form-control form-control-custom @error('message') is-invalid @enderror" 
                                      id="message" 
                                      name="message" 
                                      rows="5" 
                                      placeholder="{{ __('site.contact.form.message_placeholder') }}" 
                                      required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <x-button type="submit" variant="primary" icon="bi-send" class="w-100">
                                {{ __('site.contact.form.submit') }}
                            </x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
