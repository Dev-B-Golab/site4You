/**
 * Template Obfuscator - Profesjonalna ochrona szablonów HTML
 * 
 * Wielowarstwowa obfuskacja:
 * 1. Minifikacja HTML/CSS/JS
 * 2. Zamiana identyfikatorów na losowe
 * 3. Enkodowanie Base64 + XOR
 * 4. Fragmentacja kodu
 * 5. Dodanie anti-debugging
 * 
 * Użycie: node scripts/template-obfuscator.js
 */

import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';
import crypto from 'crypto';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// Konfiguracja
const CONFIG = {
    sourceDir: path.join(__dirname, '../public/templates'),
    outputDir: path.join(__dirname, '../public/templates-protected'),
    manifestFile: path.join(__dirname, '../public/templates-protected/manifest.json'),
    encryptionKey: crypto.randomBytes(16).toString('hex'),
    splitChunks: 4, // Na ile części podzielić szablon
    addAntiDebug: true,
    minify: true
};

/**
 * Generuje losowy identyfikator klasy/id
 */
function generateRandomId(length = 8) {
    const chars = 'abcdefghijklmnopqrstuvwxyz';
    let result = chars[Math.floor(Math.random() * chars.length)];
    const allChars = chars + '0123456789';
    for (let i = 1; i < length; i++) {
        result += allChars[Math.floor(Math.random() * allChars.length)];
    }
    return result;
}

/**
 * Minifikuje HTML
 */
function minifyHTML(html) {
    return html
        // Usuń komentarze HTML
        .replace(/<!--[\s\S]*?-->/g, '')
        // Usuń komentarze CSS
        .replace(/\/\*[\s\S]*?\*\//g, '')
        // Usuń komentarze JS (ale ostrożnie)
        .replace(/(?<!:)\/\/[^\n]*/g, '')
        // Kompresuj białe znaki
        .replace(/\s+/g, ' ')
        // Usuń spacje wokół tagów
        .replace(/>\s+</g, '><')
        // Usuń spacje na początku i końcu
        .trim();
}

/**
 * Obfuskuje nazwy klas CSS
 */
function obfuscateClasses(html) {
    const classMap = new Map();
    
    // Znajdź wszystkie definicje klas w CSS
    const cssClassRegex = /\.([a-zA-Z][\w-]*)\s*[{:,\s]/g;
    let match;
    
    while ((match = cssClassRegex.exec(html)) !== null) {
        const className = match[1];
        // Pomiń klasy Bootstrap i zewnętrzne
        if (!className.startsWith('bi-') && 
            !className.startsWith('col-') && 
            !className.startsWith('row') &&
            !className.startsWith('container') &&
            !className.startsWith('btn-') &&
            !className.startsWith('nav') &&
            !className.startsWith('d-') &&
            !className.startsWith('text-') &&
            !className.startsWith('bg-') &&
            !className.startsWith('m-') &&
            !className.startsWith('p-') &&
            !className.startsWith('g-') &&
            !className.startsWith('justify-') &&
            !className.startsWith('align-') &&
            !className.startsWith('flex-') &&
            !className.match(/^(sm|md|lg|xl|xxl)-/)) {
            if (!classMap.has(className)) {
                classMap.set(className, generateRandomId());
            }
        }
    }
    
    // Zamień klasy w HTML
    let obfuscated = html;
    for (const [original, replacement] of classMap) {
        // Zamień w definicjach CSS
        const cssRegex = new RegExp(`\\.${original}(?=[\\s{:,])`, 'g');
        obfuscated = obfuscated.replace(cssRegex, `.${replacement}`);
        
        // Zamień w atrybutach class=""
        const classAttrRegex = new RegExp(`(class=["'][^"']*?)\\b${original}\\b([^"']*?["'])`, 'g');
        obfuscated = obfuscated.replace(classAttrRegex, `$1${replacement}$2`);
    }
    
    return { html: obfuscated, classMap };
}

/**
 * XOR szyfrowanie
 */
function xorEncrypt(str, key) {
    let result = '';
    for (let i = 0; i < str.length; i++) {
        result += String.fromCharCode(str.charCodeAt(i) ^ key.charCodeAt(i % key.length));
    }
    return result;
}

/**
 * Enkoduje HTML na zabezpieczony format
 */
function encodeTemplate(html, key) {
    // XOR + Base64
    const xored = xorEncrypt(html, key);
    const base64 = Buffer.from(xored, 'binary').toString('base64');
    
    // Dodatkowe zaciemnienie - zamiana znaków
    const obfuscated = base64
        .replace(/A/g, '§')
        .replace(/Z/g, '¥')
        .replace(/=/g, '€');
    
    return obfuscated;
}

/**
 * Dzieli zakodowany szablon na fragmenty
 */
function splitIntoChunks(encoded, numChunks) {
    const chunkSize = Math.ceil(encoded.length / numChunks);
    const chunks = [];
    
    for (let i = 0; i < numChunks; i++) {
        const start = i * chunkSize;
        const chunk = encoded.slice(start, start + chunkSize);
        chunks.push({
            id: crypto.randomBytes(8).toString('hex'),
            data: chunk,
            order: i
        });
    }
    
    // Wymieszaj kolejność (ale zachowaj order do odtworzenia)
    return chunks.sort(() => Math.random() - 0.5);
}

/**
 * Generuje kod loadera anti-debug
 */
function generateAntiDebugCode() {
    return `
<script>
(function(){
    var d=new Date();
    debugger;
    if(new Date()-d>100){
        document.body.innerHTML='';
        window.location.href='about:blank';
    }
    
    // Blokowanie DevTools
    var t=null;
    function c(){
        var w=window.outerWidth-window.innerWidth>160;
        var h=window.outerHeight-window.innerHeight>160;
        if(w||h){
            document.body.innerHTML='<div style="padding:50px;text-align:center;font-size:24px;">Podgląd kodu źródłowego jest zablokowany.</div>';
        }
    }
    setInterval(c,1000);
    
    // Blokowanie prawego przycisku myszy
    document.addEventListener('contextmenu',function(e){e.preventDefault();});
    
    // Blokowanie skrótów klawiszowych
    document.addEventListener('keydown',function(e){
        if(e.key==='F12'||(e.ctrlKey&&e.shiftKey&&e.key==='I')||(e.ctrlKey&&e.key==='u')){
            e.preventDefault();
        }
    });
})();
</script>`;
}

/**
 * Generuje loader JS dla szablonu
 */
function generateTemplateLoader(templateId, chunks, key) {
    const chunksJson = JSON.stringify(chunks);
    
    return `
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading...</title>
    <style>
        .tpl-loader{position:fixed;inset:0;background:#0f172a;display:flex;align-items:center;justify-content:center;z-index:9999}
        .tpl-spinner{width:50px;height:50px;border:3px solid #334155;border-top-color:#3b82f6;border-radius:50%;animation:spin 1s linear infinite}
        @keyframes spin{to{transform:rotate(360deg)}}
    </style>
</head>
<body>
    <div class="tpl-loader"><div class="tpl-spinner"></div></div>
    <script>
    (function(){
        var _0x${crypto.randomBytes(3).toString('hex')}=${chunksJson};
        var _k='${key}';
        
        function _d(s,k){
            var r='';
            for(var i=0;i<s.length;i++){
                r+=String.fromCharCode(s.charCodeAt(i)^k.charCodeAt(i%k.length));
            }
            return r;
        }
        
        function _b(e){
            return e.replace(/§/g,'A').replace(/¥/g,'Z').replace(/€/g,'=');
        }
        
        function _l(){
            var c=_0x${crypto.randomBytes(3).toString('hex')};
            c.sort(function(a,b){return a.order-b.order});
            var e='';
            for(var i=0;i<c.length;i++){e+=c[i].data;}
            var b=_b(e);
            var d=atob(b);
            var h=_d(d,_k);
            document.open();
            document.write(h);
            document.close();
        }
        
        // Opóźnione ładowanie
        setTimeout(_l,${100 + Math.floor(Math.random() * 200)});
    })();
    </script>
</body>
</html>`;
}

/**
 * Przetwarza pojedynczy szablon
 */
function processTemplate(filePath, outputDir) {
    console.log(`\n📄 Przetwarzanie: ${path.basename(filePath)}`);
    
    let html = fs.readFileSync(filePath, 'utf-8');
    const originalSize = html.length;
    
    // Krok 1: Minifikacja
    if (CONFIG.minify) {
        html = minifyHTML(html);
        console.log(`   ✓ Minifikacja: ${originalSize} → ${html.length} bajtów`);
    }
    
    // Krok 2: Obfuskacja klas
    const { html: obfuscatedHtml, classMap } = obfuscateClasses(html);
    html = obfuscatedHtml;
    console.log(`   ✓ Obfuskacja klas: ${classMap.size} klas zamienionych`);
    
    // Krok 3: Dodanie anti-debug
    if (CONFIG.addAntiDebug) {
        html = html.replace('</head>', generateAntiDebugCode() + '</head>');
        console.log(`   ✓ Dodano zabezpieczenia anti-debug`);
    }
    
    // Krok 4: Enkodowanie
    const templateKey = crypto.randomBytes(8).toString('hex');
    const encoded = encodeTemplate(html, templateKey);
    console.log(`   ✓ Enkodowanie XOR+Base64 ukończone`);
    
    // Krok 5: Fragmentacja
    const chunks = splitIntoChunks(encoded, CONFIG.splitChunks);
    console.log(`   ✓ Podzielono na ${chunks.length} fragmentów`);
    
    // Krok 6: Generowanie loadera
    const loader = generateTemplateLoader(
        path.basename(filePath, '.html'),
        chunks,
        templateKey
    );
    
    // Zapisz plik
    const outputPath = path.join(outputDir, path.basename(filePath));
    fs.writeFileSync(outputPath, loader, 'utf-8');
    console.log(`   ✓ Zapisano: ${outputPath}`);
    
    return {
        original: path.basename(filePath),
        protected: path.basename(outputPath),
        originalSize,
        protectedSize: loader.length,
        classesObfuscated: classMap.size,
        chunks: chunks.length
    };
}

/**
 * Główna funkcja
 */
async function main() {
    console.log('╔════════════════════════════════════════════════════════════╗');
    console.log('║     🔒 TEMPLATE OBFUSCATOR - Profesjonalna Ochrona        ║');
    console.log('╠════════════════════════════════════════════════════════════╣');
    console.log('║  Warstwy zabezpieczeń:                                     ║');
    console.log('║  • Minifikacja HTML/CSS/JS                                 ║');
    console.log('║  • Obfuskacja nazw klas CSS                                ║');
    console.log('║  • Szyfrowanie XOR + Base64                                ║');
    console.log('║  • Fragmentacja kodu                                       ║');
    console.log('║  • Zabezpieczenia anti-debugging                           ║');
    console.log('╚════════════════════════════════════════════════════════════╝');
    
    // Sprawdź czy folder źródłowy istnieje
    if (!fs.existsSync(CONFIG.sourceDir)) {
        console.error(`\n❌ Folder źródłowy nie istnieje: ${CONFIG.sourceDir}`);
        process.exit(1);
    }
    
    // Utwórz folder wyjściowy
    if (!fs.existsSync(CONFIG.outputDir)) {
        fs.mkdirSync(CONFIG.outputDir, { recursive: true });
    }
    
    // Znajdź wszystkie pliki HTML
    const files = fs.readdirSync(CONFIG.sourceDir)
        .filter(f => f.endsWith('.html'))
        .map(f => path.join(CONFIG.sourceDir, f));
    
    if (files.length === 0) {
        console.error('\n❌ Nie znaleziono plików HTML do przetworzenia');
        process.exit(1);
    }
    
    console.log(`\n📁 Znaleziono ${files.length} szablonów do przetworzenia`);
    
    // Przetwórz każdy szablon
    const results = [];
    for (const file of files) {
        try {
            const result = processTemplate(file, CONFIG.outputDir);
            results.push(result);
        } catch (error) {
            console.error(`   ❌ Błąd: ${error.message}`);
        }
    }
    
    // Zapisz manifest
    const manifest = {
        generated: new Date().toISOString(),
        version: '1.0.0',
        encryptionType: 'XOR+Base64',
        templates: results.map(r => ({
            name: r.original.replace('.html', ''),
            file: r.protected
        }))
    };
    
    fs.writeFileSync(CONFIG.manifestFile, JSON.stringify(manifest, null, 2));
    
    // Podsumowanie
    console.log('\n╔════════════════════════════════════════════════════════════╗');
    console.log('║                    📊 PODSUMOWANIE                         ║');
    console.log('╠════════════════════════════════════════════════════════════╣');
    
    let totalOriginal = 0;
    let totalProtected = 0;
    
    for (const r of results) {
        console.log(`║  ${r.original.padEnd(25)} ${(r.originalSize/1024).toFixed(1)}KB → ${(r.protectedSize/1024).toFixed(1)}KB`);
        totalOriginal += r.originalSize;
        totalProtected += r.protectedSize;
    }
    
    console.log('╠════════════════════════════════════════════════════════════╣');
    console.log(`║  Razem: ${(totalOriginal/1024).toFixed(1)}KB → ${(totalProtected/1024).toFixed(1)}KB`);
    console.log('╠════════════════════════════════════════════════════════════╣');
    console.log(`║  ✅ Chronione szablony: ${CONFIG.outputDir}`);
    console.log('╚════════════════════════════════════════════════════════════╝');
}

main().catch(console.error);
