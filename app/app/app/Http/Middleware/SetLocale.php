<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Obsługiwane języki
     */
    protected array $locales = ['pl', 'en'];

    /**
     * Domyślny język (dla niewspieranych języków)
     */
    protected string $defaultLocale = 'en';

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Sprawdź parametr URL
        $locale = $request->segment(1);

        // Jeśli to prawidłowy język w URL
        if (in_array($locale, $this->locales)) {
            App::setLocale($locale);
            session(['locale' => $locale]);
        } 
        // Sprawdź sesję
        elseif (session()->has('locale') && in_array(session('locale'), $this->locales)) {
            App::setLocale(session('locale'));
        }
        // Sprawdź cookie (dla przypadków gdy sesja nie jest dostępna)
        elseif ($request->cookie('locale') && in_array($request->cookie('locale'), $this->locales)) {
            App::setLocale($request->cookie('locale'));
        }
        // Sprawdź nagłówek przeglądarki (Accept-Language)
        else {
            $locale = $this->getPreferredLocaleFromBrowser($request);
            App::setLocale($locale);
            session(['locale' => $locale]);
        }

        $response = $next($request);

        // Zapisz język w cookie dla przyszłych requestów (włącznie z błędami)
        $response->cookie('locale', App::getLocale(), 60 * 24 * 30); // 30 dni

        return $response;
    }

    /**
     * Pobierz preferowany język z nagłówka Accept-Language przeglądarki
     */
    protected function getPreferredLocaleFromBrowser(Request $request): string
    {
        $acceptLanguage = $request->server('HTTP_ACCEPT_LANGUAGE', '');
        
        if (empty($acceptLanguage)) {
            return $this->defaultLocale;
        }

        // Parsuj nagłówek Accept-Language (np. "pl-PL,pl;q=0.9,en-US;q=0.8,en;q=0.7")
        $languages = [];
        
        foreach (explode(',', $acceptLanguage) as $part) {
            $part = trim($part);
            
            // Rozdziel język od priorytetu (q=)
            if (strpos($part, ';') !== false) {
                list($lang, $q) = explode(';', $part, 2);
                $q = (float) str_replace('q=', '', $q);
            } else {
                $lang = $part;
                $q = 1.0;
            }
            
            // Wyciągnij kod języka (np. "pl" z "pl-PL")
            $langCode = strtolower(substr($lang, 0, 2));
            
            // Dodaj tylko jeśli jeszcze nie ma (zachowaj wyższy priorytet)
            if (!isset($languages[$langCode])) {
                $languages[$langCode] = $q;
            }
        }

        // Sortuj po priorytecie (malejąco)
        arsort($languages);

        // Znajdź pierwszy wspierany język
        foreach (array_keys($languages) as $langCode) {
            if (in_array($langCode, $this->locales)) {
                return $langCode;
            }
        }

        // Jeśli żaden nie jest wspierany, zwróć domyślny (angielski)
        return $this->defaultLocale;
    }
}
