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
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Sprawdź parametr URL
        $locale = $request->segment(1);

        // Jeśli to prawidłowy język
        if (in_array($locale, $this->locales)) {
            App::setLocale($locale);
            session(['locale' => $locale]);
        } 
        // Sprawdź sesję
        elseif (session()->has('locale')) {
            App::setLocale(session('locale'));
        }
        // Sprawdź nagłówek przeglądarki
        else {
            $browserLocale = substr($request->server('HTTP_ACCEPT_LANGUAGE', 'pl'), 0, 2);
            $locale = in_array($browserLocale, $this->locales) ? $browserLocale : 'pl';
            App::setLocale($locale);
        }

        return $next($request);
    }
}
