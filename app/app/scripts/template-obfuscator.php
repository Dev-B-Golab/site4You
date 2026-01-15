#!/usr/bin/env php
<?php

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
 * Użycie: php scripts/template-obfuscator.php
 */

class TemplateObfuscator
{
    private string $sourceDir;
    private string $outputDir;
    private string $manifestFile;
    private int $splitChunks = 4;
    private bool $addAntiDebug = true;
    private bool $minify = true;
    
    public function __construct()
    {
        $this->sourceDir = __DIR__ . '/../public/templates';
        $this->outputDir = __DIR__ . '/../public/templates-protected';
        $this->manifestFile = $this->outputDir . '/manifest.json';
    }
    
    /**
     * Generuje losowy identyfikator
     */
    private function generateRandomId(int $length = 8): string
    {
        $chars = 'abcdefghijklmnopqrstuvwxyz';
        $result = $chars[random_int(0, strlen($chars) - 1)];
        
        $allChars = $chars . '0123456789';
        for ($i = 1; $i < $length; $i++) {
            $result .= $allChars[random_int(0, strlen($allChars) - 1)];
        }
        
        return $result;
    }
    
    /**
     * Minifikuje HTML
     */
    private function minifyHTML(string $html): string
    {
        // Usuń komentarze HTML
        $html = preg_replace('/<!--(?!<!)[^\[>].*?-->/', '', $html);
        
        // Usuń komentarze CSS
        $html = preg_replace('/\/\*.*?\*\//s', '', $html);
        
        // Kompresuj białe znaki
        $html = preg_replace('/\s+/', ' ', $html);
        
        // Usuń spacje wokół tagów
        $html = preg_replace('/>\s+</', '><', $html);
        
        return trim($html);
    }
    
    /**
     * Obfuskuje nazwy klas CSS
     */
    private function obfuscateClasses(string $html): array
    {
        $classMap = [];
        
        // Znajdź definicje klas w CSS
        preg_match_all('/\.([a-zA-Z][\w-]*)\s*[{:,\s]/', $html, $matches);
        
        $bootstrapPrefixes = [
            'bi-', 'col-', 'row', 'container', 'btn-', 'nav', 'd-', 
            'text-', 'bg-', 'm-', 'p-', 'g-', 'justify-', 'align-', 'flex-',
            'sm-', 'md-', 'lg-', 'xl-', 'xxl-', 'mb-', 'mt-', 'ms-', 'me-',
            'py-', 'px-', 'pt-', 'pb-', 'ps-', 'pe-', 'w-', 'h-', 'form-',
            'input-', 'dropdown', 'modal', 'collapse', 'accordion', 'card',
            'list-', 'table', 'badge', 'alert', 'toast', 'spinner', 'progress'
        ];
        
        foreach ($matches[1] as $className) {
            $isBootstrap = false;
            foreach ($bootstrapPrefixes as $prefix) {
                if (str_starts_with($className, $prefix) || $className === trim($prefix, '-')) {
                    $isBootstrap = true;
                    break;
                }
            }
            
            if (!$isBootstrap && !isset($classMap[$className])) {
                $classMap[$className] = $this->generateRandomId();
            }
        }
        
        // Zamień klasy
        foreach ($classMap as $original => $replacement) {
            // W CSS
            $html = preg_replace(
                '/\.' . preg_quote($original, '/') . '(?=[\s{:,])/',
                '.' . $replacement,
                $html
            );
            
            // W atrybutach class
            $html = preg_replace(
                '/(class=["\'][^"\']*)\b' . preg_quote($original, '/') . '\b([^"\']*["\'])/',
                '$1' . $replacement . '$2',
                $html
            );
        }
        
        return ['html' => $html, 'classMap' => $classMap];
    }
    
    /**
     * XOR szyfrowanie
     */
    private function xorEncrypt(string $str, string $key): string
    {
        $result = '';
        $keyLength = strlen($key);
        
        for ($i = 0; $i < strlen($str); $i++) {
            $result .= chr(ord($str[$i]) ^ ord($key[$i % $keyLength]));
        }
        
        return $result;
    }
    
    /**
     * Enkoduje HTML na zabezpieczony format
     */
    private function encodeTemplate(string $html, string $key): string
    {
        // XOR + Base64
        $xored = $this->xorEncrypt($html, $key);
        $base64 = base64_encode($xored);
        
        // Dodatkowe zaciemnienie
        $obfuscated = str_replace(['A', 'Z', '='], ['§', '¥', '€'], $base64);
        
        return $obfuscated;
    }
    
    /**
     * Dzieli zakodowany szablon na fragmenty
     */
    private function splitIntoChunks(string $encoded, int $numChunks): array
    {
        $chunkSize = (int) ceil(strlen($encoded) / $numChunks);
        $chunks = [];
        
        for ($i = 0; $i < $numChunks; $i++) {
            $chunks[] = [
                'id' => bin2hex(random_bytes(8)),
                'data' => substr($encoded, $i * $chunkSize, $chunkSize),
                'order' => $i
            ];
        }
        
        // Wymieszaj kolejność
        shuffle($chunks);
        
        return $chunks;
    }
    
    /**
     * Generuje kod loadera anti-debug
     */
    private function generateAntiDebugCode(): string
    {
        return '
<script>
(function(){
    var d=new Date();
    debugger;
    if(new Date()-d>100){
        document.body.innerHTML="";
        window.location.href="about:blank";
    }
    
    setInterval(function(){
        var w=window.outerWidth-window.innerWidth>160;
        var h=window.outerHeight-window.innerHeight>160;
        if(w||h){
            document.body.innerHTML="<div style=\'padding:50px;text-align:center;font-size:24px;\'>Podgląd kodu źródłowego jest zablokowany.</div>";
        }
    },1000);
    
    document.addEventListener("contextmenu",function(e){e.preventDefault();});
    
    document.addEventListener("keydown",function(e){
        if(e.key==="F12"||(e.ctrlKey&&e.shiftKey&&e.key==="I")||(e.ctrlKey&&e.key==="u")){
            e.preventDefault();
        }
    });
})();
</script>';
    }
    
    /**
     * Generuje loader JS dla szablonu
     */
    private function generateTemplateLoader(string $templateId, array $chunks, string $key): string
    {
        $chunksJson = json_encode($chunks);
        $varName1 = '_0x' . bin2hex(random_bytes(3));
        $varName2 = '_0x' . bin2hex(random_bytes(3));
        $delay = 100 + random_int(0, 200);
        
        return '<!DOCTYPE html>
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
        var ' . $varName1 . '=' . $chunksJson . ';
        var _k="' . $key . '";
        
        function _d(s,k){
            var r="";
            for(var i=0;i<s.length;i++){
                r+=String.fromCharCode(s.charCodeAt(i)^k.charCodeAt(i%k.length));
            }
            return r;
        }
        
        function _b(e){
            return e.replace(/§/g,"A").replace(/¥/g,"Z").replace(/€/g,"=");
        }
        
        function _l(){
            var c=' . $varName1 . ';
            c.sort(function(a,b){return a.order-b.order});
            var e="";
            for(var i=0;i<c.length;i++){e+=c[i].data;}
            var b=_b(e);
            var d=atob(b);
            var h=_d(d,_k);
            document.open();
            document.write(h);
            document.close();
        }
        
        setTimeout(_l,' . $delay . ');
    })();
    </script>
</body>
</html>';
    }
    
    /**
     * Przetwarza pojedynczy szablon
     */
    private function processTemplate(string $filePath): array
    {
        $fileName = basename($filePath);
        echo "\n📄 Przetwarzanie: {$fileName}\n";
        
        $html = file_get_contents($filePath);
        $originalSize = strlen($html);
        
        // Krok 1: Minifikacja
        if ($this->minify) {
            $html = $this->minifyHTML($html);
            echo "   ✓ Minifikacja: {$originalSize} → " . strlen($html) . " bajtów\n";
        }
        
        // Krok 2: Obfuskacja klas
        $result = $this->obfuscateClasses($html);
        $html = $result['html'];
        $classCount = count($result['classMap']);
        echo "   ✓ Obfuskacja klas: {$classCount} klas zamienionych\n";
        
        // Krok 3: Dodanie anti-debug
        if ($this->addAntiDebug) {
            $html = str_replace('</head>', $this->generateAntiDebugCode() . '</head>', $html);
            echo "   ✓ Dodano zabezpieczenia anti-debug\n";
        }
        
        // Krok 4: Enkodowanie
        $templateKey = bin2hex(random_bytes(8));
        $encoded = $this->encodeTemplate($html, $templateKey);
        echo "   ✓ Enkodowanie XOR+Base64 ukończone\n";
        
        // Krok 5: Fragmentacja
        $chunks = $this->splitIntoChunks($encoded, $this->splitChunks);
        echo "   ✓ Podzielono na " . count($chunks) . " fragmentów\n";
        
        // Krok 6: Generowanie loadera
        $loader = $this->generateTemplateLoader(
            pathinfo($filePath, PATHINFO_FILENAME),
            $chunks,
            $templateKey
        );
        
        // Zapisz plik
        $outputPath = $this->outputDir . '/' . $fileName;
        file_put_contents($outputPath, $loader);
        echo "   ✓ Zapisano: {$outputPath}\n";
        
        return [
            'original' => $fileName,
            'protected' => $fileName,
            'originalSize' => $originalSize,
            'protectedSize' => strlen($loader),
            'classesObfuscated' => $classCount,
            'chunks' => count($chunks)
        ];
    }
    
    /**
     * Główna funkcja
     */
    public function run(): void
    {
        echo "╔════════════════════════════════════════════════════════════╗\n";
        echo "║     🔒 TEMPLATE OBFUSCATOR - Profesjonalna Ochrona        ║\n";
        echo "╠════════════════════════════════════════════════════════════╣\n";
        echo "║  Warstwy zabezpieczeń:                                     ║\n";
        echo "║  • Minifikacja HTML/CSS/JS                                 ║\n";
        echo "║  • Obfuskacja nazw klas CSS                                ║\n";
        echo "║  • Szyfrowanie XOR + Base64                                ║\n";
        echo "║  • Fragmentacja kodu                                       ║\n";
        echo "║  • Zabezpieczenia anti-debugging                           ║\n";
        echo "╚════════════════════════════════════════════════════════════╝\n";
        
        // Sprawdź czy folder źródłowy istnieje
        if (!is_dir($this->sourceDir)) {
            echo "\n❌ Folder źródłowy nie istnieje: {$this->sourceDir}\n";
            exit(1);
        }
        
        // Utwórz folder wyjściowy
        if (!is_dir($this->outputDir)) {
            mkdir($this->outputDir, 0755, true);
        }
        
        // Znajdź wszystkie pliki HTML
        $files = glob($this->sourceDir . '/*.html');
        
        if (empty($files)) {
            echo "\n❌ Nie znaleziono plików HTML do przetworzenia\n";
            exit(1);
        }
        
        echo "\n📁 Znaleziono " . count($files) . " szablonów do przetworzenia\n";
        
        // Przetwórz każdy szablon
        $results = [];
        foreach ($files as $file) {
            try {
                $results[] = $this->processTemplate($file);
            } catch (\Exception $e) {
                echo "   ❌ Błąd: " . $e->getMessage() . "\n";
            }
        }
        
        // Zapisz manifest
        $manifest = [
            'generated' => date('c'),
            'version' => '1.0.0',
            'encryptionType' => 'XOR+Base64',
            'templates' => array_map(function ($r) {
                return [
                    'name' => pathinfo($r['original'], PATHINFO_FILENAME),
                    'file' => $r['protected']
                ];
            }, $results)
        ];
        
        file_put_contents($this->manifestFile, json_encode($manifest, JSON_PRETTY_PRINT));
        
        // Podsumowanie
        echo "\n╔════════════════════════════════════════════════════════════╗\n";
        echo "║                    📊 PODSUMOWANIE                         ║\n";
        echo "╠════════════════════════════════════════════════════════════╣\n";
        
        $totalOriginal = 0;
        $totalProtected = 0;
        
        foreach ($results as $r) {
            $name = str_pad($r['original'], 25);
            $origKB = number_format($r['originalSize'] / 1024, 1);
            $protKB = number_format($r['protectedSize'] / 1024, 1);
            echo "║  {$name} {$origKB}KB → {$protKB}KB\n";
            $totalOriginal += $r['originalSize'];
            $totalProtected += $r['protectedSize'];
        }
        
        $totalOrigKB = number_format($totalOriginal / 1024, 1);
        $totalProtKB = number_format($totalProtected / 1024, 1);
        
        echo "╠════════════════════════════════════════════════════════════╣\n";
        echo "║  Razem: {$totalOrigKB}KB → {$totalProtKB}KB\n";
        echo "╠════════════════════════════════════════════════════════════╣\n";
        echo "║  ✅ Chronione szablony: {$this->outputDir}\n";
        echo "╚════════════════════════════════════════════════════════════╝\n";
    }
}

// Uruchom
$obfuscator = new TemplateObfuscator();
$obfuscator->run();
