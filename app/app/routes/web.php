<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Strona główna (domyślnie PL)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Strony z prefixem języka
Route::prefix('{locale}')->where(['locale' => 'pl|en'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.locale');
});

// Formularz kontaktowy
Route::post('/contact', [HomeController::class, 'contact'])->name('contact.submit');

// Zmiana języka
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['pl', 'en'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }
    return redirect()->back();
})->name('lang.switch');
