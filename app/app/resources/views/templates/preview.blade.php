<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Podgląd Szablonu</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: #0f172a;
            min-height: 100vh;
            color: #e2e8f0;
        }
        
        .template-header {
            background: #1e293b;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #334155;
        }
        
        .template-header h1 {
            font-size: 1.25rem;
            font-weight: 600;
        }
        
        .template-header .badge {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .back-link {
            color: #94a3b8;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            transition: color 0.2s;
        }
        
        .back-link:hover {
            color: white;
        }
        
        .template-selector {
            display: flex;
            gap: 0.5rem;
        }
        
        .template-selector button {
            background: #334155;
            border: none;
            color: #94a3b8;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.875rem;
            transition: all 0.2s;
        }
        
        .template-selector button:hover {
            background: #475569;
            color: white;
        }
        
        .template-selector button.active {
            background: #3b82f6;
            color: white;
        }
        
        .preview-container {
            height: calc(100vh - 60px);
        }
        
        .preview-container iframe {
            width: 100%;
            height: 100%;
            border: none;
            background: white;
        }
        
        .loading-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.9);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
        }
        
        .loading-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        .spinner {
            width: 50px;
            height: 50px;
            border: 3px solid #334155;
            border-top-color: #3b82f6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        .loading-text {
            color: #94a3b8;
            font-size: 0.9rem;
        }
        
        .security-badge {
            position: fixed;
            bottom: 1rem;
            right: 1rem;
            background: rgba(30, 41, 59, 0.95);
            backdrop-filter: blur(10px);
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-size: 0.75rem;
            color: #94a3b8;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            z-index: 100;
        }
        
        .security-badge svg {
            width: 16px;
            height: 16px;
            color: #22c55e;
        }
    </style>
</head>
<body>
    <header class="template-header">
        <div style="display: flex; align-items: center; gap: 2rem;">
            <a href="{{ route('home') }}" class="back-link">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Powrót
            </a>
            <h1>Podgląd Szablonu: <span id="current-template">{{ ucfirst($template) }}</span></h1>
            <span class="badge">Chroniony</span>
        </div>
        
        <div class="template-selector">
            <button onclick="loadTemplate('business')" {{ $template === 'business' ? 'class=active' : '' }}>
                Business
            </button>
            <button onclick="loadTemplate('portfolio')" {{ $template === 'portfolio' ? 'class=active' : '' }}>
                Portfolio
            </button>
            <button onclick="loadTemplate('restaurant')" {{ $template === 'restaurant' ? 'class=active' : '' }}>
                Restaurant
            </button>
            <button onclick="loadTemplate('ecommerce')" {{ $template === 'ecommerce' ? 'class=active' : '' }}>
                E-commerce
            </button>
        </div>
    </header>
    
    <div class="preview-container">
        <iframe id="preview-frame" sandbox="allow-scripts allow-same-origin"></iframe>
    </div>
    
    <div class="loading-overlay" id="loading">
        <div class="spinner"></div>
        <div class="loading-text">Ładowanie chronionego szablonu...</div>
    </div>
    
    <div class="security-badge">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
        </svg>
        Szablon zabezpieczony
    </div>
    
    <script src="{{ asset('js/template-loader.js') }}"></script>
    <script>
        const iframe = document.getElementById('preview-frame');
        const loading = document.getElementById('loading');
        const currentTemplateSpan = document.getElementById('current-template');
        
        // Loader szablonów
        const loader = new TemplateLoader({
            baseUrl: '/api/templates',
            tokenEndpoint: '/api/templates/token'
        });
        
        async function loadTemplate(name) {
            // Aktualizuj UI
            loading.classList.add('active');
            currentTemplateSpan.textContent = name.charAt(0).toUpperCase() + name.slice(1);
            
            // Aktualizuj przyciski
            document.querySelectorAll('.template-selector button').forEach(btn => {
                btn.classList.remove('active');
                if (btn.textContent.trim().toLowerCase() === name) {
                    btn.classList.add('active');
                }
            });
            
            // Aktualizuj URL
            window.history.pushState({}, '', `/preview/templates/${name}`);
            
            try {
                await loader.loadInIframe(name, iframe);
            } catch (error) {
                console.error('Failed to load template:', error);
                iframe.srcdoc = `
                    <div style="padding: 50px; text-align: center; font-family: system-ui;">
                        <h2>Nie udało się załadować szablonu</h2>
                        <p style="color: #666; margin-top: 1rem;">Spróbuj odświeżyć stronę</p>
                    </div>
                `;
            } finally {
                loading.classList.remove('active');
            }
        }
        
        // Załaduj początkowy szablon
        loadTemplate('{{ $template }}');
    </script>
</body>
</html>
