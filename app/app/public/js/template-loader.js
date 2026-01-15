/**
 * Template Loader - Bezpieczne ładowanie szablonów
 * 
 * Ten skrypt ładuje zaszyfrowane szablony z backendu,
 * deszyfruje je i renderuje w przeglądarce.
 */

class TemplateLoader {
    constructor(options = {}) {
        this.baseUrl = options.baseUrl || '/api/templates';
        this.tokenEndpoint = options.tokenEndpoint || '/api/templates/token';
        this.container = options.container || document.body;
        this.onLoad = options.onLoad || null;
        this.onError = options.onError || null;
        this.token = null;
    }

    /**
     * Pobiera token dostępu
     */
    async getToken() {
        try {
            const response = await fetch(this.tokenEndpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': this.getCsrfToken()
                }
            });

            if (!response.ok) {
                throw new Error('Failed to get token');
            }

            const data = await response.json();
            this.token = data.token;
            return this.token;
        } catch (error) {
            console.error('Token error:', error);
            throw error;
        }
    }

    /**
     * Pobiera CSRF token
     */
    getCsrfToken() {
        const meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute('content') : '';
    }

    /**
     * Ładuje szablon
     */
    async load(templateName) {
        try {
            // Pokaż loader
            this.showLoader();

            // Pobierz token
            await this.getToken();

            // Pobierz zaszyfrowany szablon
            const response = await fetch(`${this.baseUrl}/${templateName}/encrypted`, {
                method: 'GET',
                headers: {
                    'X-Template-Token': this.token,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) {
                throw new Error(`Failed to load template: ${response.status}`);
            }

            const data = await response.json();

            // Deszyfruj
            const html = this.decrypt(data);

            // Renderuj
            this.render(html);

            // Callback
            if (this.onLoad) {
                this.onLoad(templateName);
            }

        } catch (error) {
            console.error('Load error:', error);
            this.hideLoader();
            
            if (this.onError) {
                this.onError(error);
            }
        }
    }

    /**
     * Deszyfruje dane
     */
    decrypt(data) {
        // Odkoduj klucz
        const key = atob(data.k);

        // Posortuj fragmenty
        const chunks = data.c.sort((a, b) => a.o - b.o);

        // Złóż string
        let encoded = '';
        for (const chunk of chunks) {
            encoded += chunk.d;
        }

        // Odwróć zaciemnienie
        const base64 = encoded
            .replace(/§/g, 'A')
            .replace(/¥/g, 'Z')
            .replace(/€/g, '=');

        // Dekoduj Base64
        const encrypted = atob(base64);

        // XOR decrypt
        let html = '';
        for (let i = 0; i < encrypted.length; i++) {
            html += String.fromCharCode(
                encrypted.charCodeAt(i) ^ key.charCodeAt(i % key.length)
            );
        }

        return html;
    }

    /**
     * Renderuje HTML
     */
    render(html) {
        // Opcja 1: Zamień cały dokument
        if (this.container === document.body || this.container === document) {
            document.open();
            document.write(html);
            document.close();
        } 
        // Opcja 2: Wstaw do kontenera
        else {
            if (typeof this.container === 'string') {
                this.container = document.querySelector(this.container);
            }
            
            // Użyj shadow DOM dla izolacji
            if (this.container.attachShadow) {
                const shadow = this.container.attachShadow({ mode: 'closed' });
                shadow.innerHTML = html;
            } else {
                this.container.innerHTML = html;
            }
            
            this.hideLoader();
        }
    }

    /**
     * Pokazuje loader
     */
    showLoader() {
        // Usuń istniejący loader
        this.hideLoader();

        const loader = document.createElement('div');
        loader.id = 'template-loader';
        loader.innerHTML = `
            <style>
                #template-loader {
                    position: fixed;
                    inset: 0;
                    background: #0f172a;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    z-index: 99999;
                }
                #template-loader .spinner {
                    width: 50px;
                    height: 50px;
                    border: 3px solid #334155;
                    border-top-color: #3b82f6;
                    border-radius: 50%;
                    animation: tpl-spin 1s linear infinite;
                }
                @keyframes tpl-spin {
                    to { transform: rotate(360deg); }
                }
            </style>
            <div class="spinner"></div>
        `;
        document.body.appendChild(loader);
    }

    /**
     * Ukrywa loader
     */
    hideLoader() {
        const loader = document.getElementById('template-loader');
        if (loader) {
            loader.remove();
        }
    }

    /**
     * Ładuje szablon do iframe (najbezpieczniejsza opcja)
     */
    loadInIframe(templateName, iframeElement) {
        return new Promise(async (resolve, reject) => {
            try {
                await this.getToken();

                const response = await fetch(`${this.baseUrl}/${templateName}/encrypted`, {
                    headers: {
                        'X-Template-Token': this.token
                    }
                });

                if (!response.ok) {
                    throw new Error('Failed to load');
                }

                const data = await response.json();
                const html = this.decrypt(data);

                // Wstaw do iframe
                const iframe = typeof iframeElement === 'string' 
                    ? document.querySelector(iframeElement) 
                    : iframeElement;

                const doc = iframe.contentDocument || iframe.contentWindow.document;
                doc.open();
                doc.write(html);
                doc.close();

                // Zablokuj dostęp do kodu źródłowego w iframe
                try {
                    iframe.contentWindow.document.addEventListener('contextmenu', e => e.preventDefault());
                    iframe.contentWindow.document.addEventListener('keydown', e => {
                        if (e.key === 'F12' || (e.ctrlKey && e.key === 'u')) {
                            e.preventDefault();
                        }
                    });
                } catch (e) {
                    // Cross-origin może zablokować
                }

                resolve();
            } catch (error) {
                reject(error);
            }
        });
    }
}

// Export dla modułów
if (typeof module !== 'undefined' && module.exports) {
    module.exports = TemplateLoader;
}

// Globalna instancja
window.TemplateLoader = TemplateLoader;

/**
 * Prosty helper do ładowania szablonu
 */
window.loadTemplate = async function(templateName, container = null) {
    const loader = new TemplateLoader({
        container: container || document.body
    });
    await loader.load(templateName);
};
