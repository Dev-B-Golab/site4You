{{-- 
    SEKCJA: Podgląd szablonów stron
    Wyświetla interaktywny podgląd szablonów z przełączaniem urządzeń
--}}

<section class="templates-preview-section">
    <div class="container">
        <x-section-header 
            :title="__('site.templates.title')"
            :subtitle="__('site.templates.subtitle')"
            :centered="true" />
        
        {{-- Wybór szablonu --}}
        <div class="template-selector mb-4" data-aos="fade-up">
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <button class="template-btn active" data-template="business">
                    <i class="bi bi-building me-2"></i>{{ __('site.templates.business') }}
                </button>
                <button class="template-btn" data-template="portfolio">
                    <i class="bi bi-person-workspace me-2"></i>{{ __('site.templates.portfolio') }}
                </button>
                <button class="template-btn" data-template="restaurant">
                    <i class="bi bi-cup-hot me-2"></i>{{ __('site.templates.restaurant') }}
                </button>
                <button class="template-btn" data-template="ecommerce">
                    <i class="bi bi-cart3 me-2"></i>{{ __('site.templates.ecommerce') }}
                </button>
            </div>
        </div>
        
        {{-- Przełącznik urządzeń --}}
        <div class="device-switcher mb-4 d-none d-md-block" data-aos="fade-up" data-aos-delay="100">
            <div class="d-flex justify-content-center gap-2">
                <button class="device-btn active" data-device="desktop" title="Desktop (1920px)">
                    <i class="bi bi-display"></i>
                </button>
                <button class="device-btn" data-device="laptop" title="Laptop (1366px)">
                    <i class="bi bi-laptop"></i>
                </button>
                <button class="device-btn" data-device="tablet" title="Tablet (768px)">
                    <i class="bi bi-tablet"></i>
                </button>
                <button class="device-btn" data-device="mobile" title="Mobile (375px)">
                    <i class="bi bi-phone"></i>
                </button>
            </div>
        </div>
        {{-- Info dla mobile - tylko widok mobilny --}}
        <div class="d-md-none text-center mb-3">
            <span class="badge bg-secondary"><i class="bi bi-phone me-1"></i>{{ __('site.templates.mobile_only') }}</span>
        </div>
        
        @php
    $cacheBuster = '?v=' . time();
@endphp

        {{-- Podgląd iframe --}}
        <div class="preview-container" data-aos="fade-up" data-aos-delay="200">
            <div class="preview-frame desktop" id="previewFrame">
                <div class="preview-header">
                    <div class="browser-dots">
                        <span class="dot red"></span>
                        <span class="dot yellow"></span>
                        <span class="dot green"></span>
                    </div>
                    <div class="browser-url">
                        <i class="bi bi-lock-fill me-1"></i>
                        <span class="url-text">www.twoja-strona.pl</span>
                    </div>
                    <a href="{{ route('templates.demo', 'business') }}{{ $cacheBuster }}" target="_blank" class="preview-external" title="{{ __('site.templates.open_new') }}">
                        <i class="bi bi-box-arrow-up-right"></i>
                    </a>
                </div>
                <div class="preview-body">
                    <iframe src="{{ route('templates.demo', 'business') }}{{ $cacheBuster }}" class="preview-iframe" id="templatePreview"></iframe>
                </div>
            </div>
        </div>
        
        {{-- Info o szablonie --}}
        <div class="template-info text-center mt-4" data-aos="fade-up" data-aos-delay="300">
            <p class="text-gray mb-3">
                <i class="bi bi-info-circle me-2"></i>{{ __('site.templates.info') }}
            </p>
            <x-button href="#contact-section" variant="primary" icon="bi-chat-dots">
                {{ __('site.templates.cta') }}
            </x-button>
        </div>
    </div>
</section>

<style>
.templates-preview-section {
    padding: 80px 0;
    background: var(--bg-darker);
}

/* Template Selector */
.template-btn {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    color: var(--text-gray);
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
    cursor: pointer;
}
.template-btn:hover {
    border-color: var(--text-white);
    color: var(--text-white);
}
.template-btn.active {
    background: var(--text-white);
    border-color: var(--text-white);
    color: var(--bg-dark);
}

/* Device Switcher */
.device-btn {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    color: var(--text-gray);
    width: 48px;
    height: 48px;
    border-radius: 8px;
    font-size: 1.25rem;
    transition: all 0.3s ease;
    cursor: pointer;
}
.device-btn:hover {
    border-color: var(--text-white);
    color: var(--text-white);
}
.device-btn.active {
    background: var(--text-white);
    border-color: var(--text-white);
    color: var(--bg-dark);
}

/* Preview Container */
.preview-container {
    display: flex;
    justify-content: center;
    padding: 20px;
    background: var(--bg-card);
    border-radius: 16px;
    min-height: 600px;
}

.preview-frame {
    background: #1a1a2e;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 25px 50px rgba(0,0,0,0.3);
    transition: width 0.4s ease;
    width: 100%;
    max-width: 1200px;
}
.preview-frame.desktop { width: 100%; }
.preview-frame.laptop { width: 1024px; }
.preview-frame.tablet { width: 768px; }
.preview-frame.mobile { width: 375px; }

/* Browser Header */
.preview-header {
    background: #2d2d44;
    padding: 12px 16px;
    display: flex;
    align-items: center;
    gap: 16px;
}
.browser-dots {
    display: flex;
    gap: 8px;
}
.browser-dots .dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
}
.browser-dots .dot.red { background: #ff5f57; }
.browser-dots .dot.yellow { background: #febc2e; }
.browser-dots .dot.green { background: #28c840; }

.browser-url {
    flex: 1;
    background: #1a1a2e;
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 0.85rem;
    color: #888;
    display: flex;
    align-items: center;
}
.browser-url i { color: #28c840; }
.browser-url .url-text { color: #aaa; }

.preview-external {
    color: var(--text-gray);
    font-size: 1rem;
    padding: 8px;
    transition: color 0.3s ease;
}
.preview-external:hover { color: var(--text-white); }

/* Iframe */
.preview-body {
    height: 550px;
    background: white;
}
.preview-iframe {
    width: 100%;
    height: 100%;
    border: none;
}

/* Responsive */
@media (max-width: 1200px) {
    .preview-frame.laptop { width: 100%; }
}
@media (max-width: 992px) {
    .preview-frame.tablet { width: 100%; }
    .preview-body { height: 500px; }
}
@media (max-width: 768px) {
    .preview-frame,
    .preview-frame.mobile,
    .preview-frame.tablet,
    .preview-frame.laptop,
    .preview-frame.desktop { 
        width: 100% !important; 
        max-width: 100% !important;
    }
    .preview-container {
        padding: 10px;
        min-height: auto;
    }
    .preview-body { height: 500px; }
    .template-btn { padding: 0.6rem 1rem; font-size: 0.9rem; }
    .preview-header { padding: 8px 12px; gap: 8px; }
    .browser-dots .dot { width: 8px; height: 8px; }
    .browser-url { padding: 6px 10px; font-size: 0.75rem; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const templateBtns = document.querySelectorAll('.template-btn');
    const deviceBtns = document.querySelectorAll('.device-btn');
    const previewFrame = document.getElementById('previewFrame');
    const previewIframe = document.getElementById('templatePreview');
    const externalLink = document.querySelector('.preview-external');
    const urlText = document.querySelector('.url-text');
    
    // Cache buster - wymusza odświeżenie iframe
    const cacheBuster = '?v=' + Date.now();
    
    // Na mobile automatycznie ustaw widok mobilny
    if (window.innerWidth < 768) {
        previewFrame.className = 'preview-frame mobile';
    }
    
    const templates = {
        business: '{{ route("templates.demo", "business") }}' + cacheBuster,
        portfolio: '{{ route("templates.demo", "portfolio") }}' + cacheBuster,
        restaurant: '{{ route("templates.demo", "restaurant") }}' + cacheBuster,
        ecommerce: '{{ route("templates.demo", "ecommerce") }}' + cacheBuster
    };
    
    const templateUrls = {
        business: 'www.firma-konsultingowa.pl',
        portfolio: 'www.jan-developer.pl',
        restaurant: 'www.restauracja-savoria.pl',
        ecommerce: 'www.techstore-sklep.pl'
    };
    
    // Template switching
    templateBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            templateBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const template = this.dataset.template;
            previewIframe.src = templates[template];
            externalLink.href = templates[template];
            urlText.textContent = templateUrls[template];
        });
    });
    
    // Device switching
    deviceBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            deviceBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const device = this.dataset.device;
            previewFrame.className = 'preview-frame ' + device;
        });
    });
});
</script>
