{{-- 
    SEKCJA KONTAKT
    Formularz kontaktowy + dane kontaktowe
--}}

<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-right" data-aos-duration="1000">
                <h2 class="section-title">{{ __('site.contact.title') }}</h2>
                <p class="section-subtitle">{{ __('site.contact.subtitle') }}</p>
                <p class="text-gray mb-4">
                    {{ __('site.contact.description') }}
                </p>
                
                {{-- DANE KONTAKTOWE --}}
                <div class="d-flex align-items-center mb-3">
                    <div class="card-icon me-3" style="width: 50px; height: 50px;">
                        <i class="bi bi-envelope" style="font-size: 1.2rem;"></i>
                    </div>
                    <div>
                        <p class="mb-0 text-muted-small">{{ __('site.contact.labels.email') }}</p>
                        <p class="mb-0">{{ config('site.email') }}</p>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <div class="card-icon me-3" style="width: 50px; height: 50px;">
                        <i class="bi bi-phone" style="font-size: 1.2rem;"></i>
                    </div>
                    <div>
                        <p class="mb-0 text-muted-small">{{ __('site.contact.labels.phone') }}</p>
                        <p class="mb-0">{{ config('site.phone') }}</p>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="card-icon me-3" style="width: 50px; height: 50px;">
                        <i class="bi bi-geo-alt" style="font-size: 1.2rem;"></i>
                    </div>
                    <div>
                        <p class="mb-0 text-muted-small">{{ __('site.contact.labels.location') }}</p>
                        <p class="mb-0">{{ config('site.address') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 offset-lg-1" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                {{-- ALERT SUKCESU --}}
                @if(session('success'))
                    <div class="alert alert-success-custom mb-4">
                        <i class="bi bi-check-circle me-2"></i>{{ __('site.contact.form.success') }}
                    </div>
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
                            <button type="submit" class="btn btn-custom w-100">
                                <i class="bi bi-send me-2"></i>{{ __('site.contact.form.submit') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
