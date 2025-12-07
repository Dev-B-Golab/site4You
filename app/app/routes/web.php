<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Strona główna (domyślnie PL)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Strony z prefixem języka
Route::prefix('{locale}')->where(['locale' => 'pl|en'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.locale');
});

// Podstrony usług
Route::get('/uslugi/{slug}', [HomeController::class, 'service'])->name('service.show');

// Formularz kontaktowy
Route::post('/contact', [HomeController::class, 'contact'])->name('contact.submit');
Route::get('/contact/success', function () {
    return view('contact-success');
})->name('contact.success');

// Zmiana języka
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['pl', 'en'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
        
        return redirect()->back()->withCookie(cookie('locale', $locale, 60 * 24 * 30));
    }
    return redirect()->back();
})->name('lang.switch');

// Sitemap XML
Route::get('/sitemap.xml', function () {
    return response()
        ->view('sitemap')
        ->header('Content-Type', 'application/xml');
})->name('sitemap');
