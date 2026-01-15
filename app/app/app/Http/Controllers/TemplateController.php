<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * TemplateController - Bezpieczne serwowanie szablonów
 * 
 * Funkcje zabezpieczeń:
 * - Tokeny jednorazowe (CSRF-like)
 * - Rate limiting
 * - Obfuskacja kodu przed wysyłką
 * - Szyfrowanie odpowiedzi
 * - Blokowanie botów/scraperów
 */
class TemplateController extends Controller
{
    /**
     * Katalog z szablonami
     */
    protected string $templatesPath;
    
    /**
     * Dozwolone szablony
     */
    protected array $allowedTemplates = [
        'business',
        'portfolio', 
        'restaurant',
        'ecommerce'
    ];
    
    /**
     * Klucz szyfrowania (pobierany z .env)
     */
    protected string $encryptionKey;
    
    public function __construct()
    {
        $this->templatesPath = public_path('templates');
        $this->encryptionKey = config('app.key');
    }
    
    /**
     * Generuje token dostępu do szablonu
     */
    public function generateToken(Request $request): \Illuminate\Http\JsonResponse
    {
        // Rate limiting
        $ip = $request->ip();
        $cacheKey = "template_token_limit:{$ip}";
        $attempts = Cache::get($cacheKey, 0);
        
        if ($attempts > 10) {
            return response()->json([
                'error' => 'Too many requests'
            ], 429);
        }
        
        Cache::put($cacheKey, $attempts + 1, now()->addMinutes(1));
        
        // Generuj token
        $token = Str::random(64);
        $tokenData = [
            'ip' => $ip,
            'user_agent' => $request->userAgent(),
            'created_at' => now()->timestamp,
            'expires_at' => now()->addMinutes(5)->timestamp
        ];
        
        Cache::put("template_token:{$token}", $tokenData, now()->addMinutes(5));
        
        return response()->json([
            'token' => $token,
            'expires_in' => 300
        ]);
    }
    
    /**
     * Serwuje zabezpieczony szablon
     */
    public function show(Request $request, string $template): \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
    {
        // Walidacja szablonu
        if (!in_array($template, $this->allowedTemplates)) {
            abort(404, 'Template not found');
        }
        
        // Weryfikacja tokenu
        $token = $request->header('X-Template-Token') ?? $request->get('_token');
        
        if (!$token || !$this->validateToken($token, $request)) {
            return response()->json([
                'error' => 'Invalid or expired token'
            ], 403);
        }
        
        // Sprawdź czy to nie bot/scraper
        if ($this->detectBot($request)) {
            return response()->json([
                'error' => 'Access denied'
            ], 403);
        }
        
        // Pobierz szablon
        $filePath = "{$this->templatesPath}/{$template}.html";
        
        if (!File::exists($filePath)) {
            abort(404, 'Template not found');
        }
        
        $html = File::get($filePath);
        
        // Obfuskuj szablon
        $obfuscated = $this->obfuscateTemplate($html);
        
        // Usuń token (jednorazowy)
        Cache::forget("template_token:{$token}");
        
        // Zwróć jako zaszyfrowany JSON
        return response($obfuscated, 200)
            ->header('Content-Type', 'text/html; charset=utf-8')
            ->header('X-Content-Type-Options', 'nosniff')
            ->header('X-Frame-Options', 'DENY')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    }
    
    /**
     * Endpoint API - zwraca zaszyfrowane dane
     */
    public function getEncrypted(Request $request, string $template): \Illuminate\Http\JsonResponse
    {
        // Walidacja
        if (!in_array($template, $this->allowedTemplates)) {
            return response()->json(['error' => 'Not found'], 404);
        }
        
        // Weryfikacja tokenu
        $token = $request->header('X-Template-Token');
        
        if (!$token || !$this->validateToken($token, $request)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        // Sprawdź bota
        if ($this->detectBot($request)) {
            return response()->json(['error' => 'Forbidden'], 403);
        }
        
        $filePath = "{$this->templatesPath}/{$template}.html";
        
        if (!File::exists($filePath)) {
            return response()->json(['error' => 'Not found'], 404);
        }
        
        $html = File::get($filePath);
        
        // Przetwórz i zaszyfruj
        $processed = $this->processTemplate($html);
        
        // Usuń token
        Cache::forget("template_token:{$token}");
        
        return response()->json($processed)
            ->header('Cache-Control', 'no-store');
    }
    
    /**
     * Walidacja tokenu
     */
    protected function validateToken(string $token, Request $request): bool
    {
        $tokenData = Cache::get("template_token:{$token}");
        
        if (!$tokenData) {
            return false;
        }
        
        // Sprawdź wygaśnięcie
        if (now()->timestamp > $tokenData['expires_at']) {
            Cache::forget("template_token:{$token}");
            return false;
        }
        
        // Sprawdź IP (opcjonalnie)
        // if ($tokenData['ip'] !== $request->ip()) {
        //     return false;
        // }
        
        return true;
    }
    
    /**
     * Wykrywanie botów/scraperów
     */
    protected function detectBot(Request $request): bool
    {
        $userAgent = strtolower($request->userAgent() ?? '');
        
        $botPatterns = [
            'curl', 'wget', 'python', 'scrapy', 'phantomjs',
            'headless', 'crawler', 'spider', 'bot', 'scraper',
            'httpclient', 'java/', 'libwww', 'lwp-', 'perl'
        ];
        
        foreach ($botPatterns as $pattern) {
            if (str_contains($userAgent, $pattern)) {
                return true;
            }
        }
        
        // Sprawdź czy ma JavaScript (prosty fingerprint)
        if (!$request->hasHeader('Accept-Language')) {
            return true;
        }
        
        return false;
    }
    
    /**
     * Obfuskacja szablonu HTML
     */
    protected function obfuscateTemplate(string $html): string
    {
        // Minifikacja
        $html = $this->minifyHtml($html);
        
        // Obfuskacja nazw klas CSS
        $html = $this->obfuscateClasses($html);
        
        // Dodaj zabezpieczenia anti-debug
        $antiDebug = $this->getAntiDebugScript();
        $html = str_replace('</head>', $antiDebug . '</head>', $html);
        
        return $html;
    }
    
    /**
     * Przetwarzanie szablonu do formatu zaszyfrowanego
     */
    protected function processTemplate(string $html): array
    {
        // Minifikacja
        $html = $this->minifyHtml($html);
        
        // Obfuskacja klas
        $html = $this->obfuscateClasses($html);
        
        // Dodaj anti-debug
        $antiDebug = $this->getAntiDebugScript();
        $html = str_replace('</head>', $antiDebug . '</head>', $html);
        
        // Szyfrowanie XOR
        $key = Str::random(16);
        $encrypted = $this->xorEncrypt($html, $key);
        
        // Base64
        $encoded = base64_encode($encrypted);
        
        // Zaciemnienie
        $obfuscated = str_replace(['A', 'Z', '='], ['§', '¥', '€'], $encoded);
        
        // Podziel na fragmenty
        $chunks = $this->splitIntoChunks($obfuscated, 4);
        
        return [
            'k' => base64_encode($key),
            'c' => $chunks,
            't' => time()
        ];
    }
    
    /**
     * Minifikacja HTML
     */
    protected function minifyHtml(string $html): string
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
     * Obfuskacja nazw klas CSS
     */
    protected function obfuscateClasses(string $html): string
    {
        $classMap = [];
        
        // Znajdź definicje klas w CSS
        preg_match_all('/\.([a-zA-Z][\w-]*)\s*[{:,\s]/', $html, $matches);
        
        $bootstrapPrefixes = [
            'bi-', 'col-', 'row', 'container', 'btn-', 'nav', 'd-', 
            'text-', 'bg-', 'm-', 'p-', 'g-', 'justify-', 'align-', 'flex-',
            'sm-', 'md-', 'lg-', 'xl-', 'xxl-'
        ];
        
        foreach ($matches[1] as $className) {
            // Pomiń klasy Bootstrap
            $isBootstrap = false;
            foreach ($bootstrapPrefixes as $prefix) {
                if (str_starts_with($className, $prefix)) {
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
            $html = preg_replace('/\.' . preg_quote($original, '/') . '(?=[\s{:,])/', '.' . $replacement, $html);
            
            // W atrybutach class
            $html = preg_replace(
                '/(class=["\'][^"\']*)\b' . preg_quote($original, '/') . '\b([^"\']*["\'])/',
                '$1' . $replacement . '$2',
                $html
            );
        }
        
        return $html;
    }
    
    /**
     * Generuje losowy identyfikator
     */
    protected function generateRandomId(int $length = 8): string
    {
        return 'x' . Str::random($length - 1);
    }
    
    /**
     * Szyfrowanie XOR
     */
    protected function xorEncrypt(string $str, string $key): string
    {
        $result = '';
        $keyLength = strlen($key);
        
        for ($i = 0; $i < strlen($str); $i++) {
            $result .= chr(ord($str[$i]) ^ ord($key[$i % $keyLength]));
        }
        
        return $result;
    }
    
    /**
     * Dzieli string na fragmenty
     */
    protected function splitIntoChunks(string $str, int $numChunks): array
    {
        $chunkSize = (int) ceil(strlen($str) / $numChunks);
        $chunks = [];
        
        for ($i = 0; $i < $numChunks; $i++) {
            $chunks[] = [
                'i' => Str::random(8),
                'd' => substr($str, $i * $chunkSize, $chunkSize),
                'o' => $i
            ];
        }
        
        // Wymieszaj kolejność
        shuffle($chunks);
        
        return $chunks;
    }
    
    /**
     * Skrypt anti-debug
     */
    protected function getAntiDebugScript(): string
    {
        return '<script>!function(){var e=new Date;debugger;if(new Date-e>100)document.body.innerHTML="",window.location.href="about:blank";setInterval(function(){window.outerWidth-window.innerWidth>160||window.outerHeight-window.innerHeight>160?document.body.innerHTML="<div style=\'padding:50px;text-align:center\'>Podgląd zablokowany</div>":void 0},1e3),document.addEventListener("contextmenu",function(e){e.preventDefault()}),document.addEventListener("keydown",function(e){"F12"!==e.key&&(!e.ctrlKey||!e.shiftKey||"I"!==e.key)&&(!e.ctrlKey||"u"!==e.key)||e.preventDefault()})}();</script>';
    }
}
