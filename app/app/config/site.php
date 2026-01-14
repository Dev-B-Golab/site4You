<?php

/*
|--------------------------------------------------------------------------
| KONFIGURACJA STRONY
|--------------------------------------------------------------------------
| Tutaj edytujesz wszystkie dane strony w jednym miejscu.
| Po zmianie wyczyść cache: php artisan config:clear
|--------------------------------------------------------------------------
*/

return [

    // ========================================
    // DANE FIRMY / KONTAKT
    // ========================================
    'name' => 'WebsiteForYou',
    'email' => 'golabwebdev@gmail.com',
    'phone' => '+48 451 079 977',
    'phone2' => '+48 516 307 696',
    'address' => 'Krosno, Polska',
    'description' => 'Tworzę nowoczesne strony internetowe, które pomagają firmom rozwijać się w świecie cyfrowym.',

    // ========================================
    // SOCIAL MEDIA
    // ========================================
    'social' => [
        'instagram' => 'https://www.instagram.com/websiteforyou.pl',
        'linkedin' => 'https://www.linkedin.com/in/bartek-gołąb-391b22255',
        'github' => 'https://github.com/Dev-B-Golab',
    ],


    // ========================================
    // MENU NAWIGACJI
    // ========================================
    'menu' => [
        ['href' => '#intro', 'label' => 'Start'],
        ['href' => '#about', 'label' => 'O mnie'],
        ['href' => '#services', 'label' => 'Usługi'],
        ['href' => '#faq', 'label' => 'FAQ'],
        ['href' => '#contact', 'label' => 'Kontakt'],
    ],

];
