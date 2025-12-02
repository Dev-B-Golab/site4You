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
    'name' => 'Web 4 You',
    'email' => 'golabwebdev@gmail.com',
    'phone' => '+48 451079977',
    'address' => 'Krosno, Polska',
    'description' => 'Tworzę nowoczesne strony internetowe, które pomagają firmom rozwijać się w świecie cyfrowym.',

    // ========================================
    // SOCIAL MEDIA
    // ========================================
    'social' => [
        'facebook' => '#',
        'instagram' => '#',
        'linkedin' => '#',
        'github' => '#',
    ],

    // ========================================
    // SEKCJA HERO
    // ========================================
    'hero' => [
        'title' => 'Tworzę strony internetowe,',
        'subtitle' => 'które sprzedają',
        'description' => 'Nowoczesne, responsywne i zoptymalizowane pod kątem SEO strony internetowe. Pomagam firmom budować silną obecność w internecie i przyciągać nowych klientów.',
        'btn_primary' => 'Rozpocznij projekt',
        'btn_secondary' => 'Zobacz usługi',
    ],

    // ========================================
    // SEKCJA O MNIE
    // ========================================
    'about' => [
        'text1' => 'Cześć! Jestem webdeveloperem z pasją do tworzenia pięknych i funkcjonalnych stron internetowych. Od ponad X lat pomagam firmom i przedsiębiorcom budować ich obecność w internecie.',
        'text2' => 'Specjalizuję się w tworzeniu responsywnych stron wizytówek, sklepów internetowych oraz zaawansowanych aplikacji webowych. Każdy projekt traktuję indywidualnie, dbając o najmniejsze szczegóły.',
        'stats' => [
            ['value' => '20', 'label' => 'Projektów'],
            ['value' => '3', 'label' => 'Lat doświadczenia'],
            ['value' => '100%', 'label' => 'Satysfakcji'],
        ],
    ],

    // ========================================
    // USŁUGI
    // ========================================
    'services' => [
        ['icon' => 'bi-window', 'title' => 'Strony wizytówki', 'desc' => 'Profesjonalne strony prezentujące Twoją firmę. Idealne rozwiązanie dla małych i średnich przedsiębiorstw.'],
        ['icon' => 'bi-cart3', 'title' => 'Sklepy internetowe', 'desc' => 'Funkcjonalne sklepy e-commerce z systemem płatności i zarządzaniem produktami. Gotowe do sprzedaży od pierwszego dnia.'],
        ['icon' => 'bi-code-square', 'title' => 'Aplikacje webowe', 'desc' => 'Dedykowane rozwiązania dopasowane do Twoich potrzeb biznesowych. Od prostych narzędzi po złożone systemy.'],
        ['icon' => 'bi-search', 'title' => 'Pozycjonowanie SEO', 'desc' => 'Optymalizacja strony pod kątem wyszukiwarek, aby Twoja strona była widoczna dla potencjalnych klientów.'],
        ['icon' => 'bi-phone', 'title' => 'Responsywność', 'desc' => 'Każda strona wygląda idealnie na wszystkich urządzeniach - komputerach, tabletach i smartfonach.'],
        ['icon' => 'bi-gear', 'title' => 'Wsparcie techniczne', 'desc' => 'Ciągła opieka nad stroną, aktualizacje i pomoc techniczna. Zawsze możesz na mnie liczyć.'],
    ],

    // ========================================
    // PROCES TWORZENIA STRONY
    // ========================================
    'steps' => [
        ['title' => 'Konsultacja i analiza', 'desc' => 'Poznajemy Twoje potrzeby, cele biznesowe i oczekiwania. Analizuję konkurencję i określamy zakres projektu.'],
        ['title' => 'Projekt graficzny', 'desc' => 'Tworzę makietę strony dopasowaną do Twojej marki. Przedstawiam projekt do akceptacji i wprowadzam poprawki.'],
        ['title' => 'Programowanie', 'desc' => 'Koduję stronę z wykorzystaniem najnowszych technologii. Dbam o szybkość działania i bezpieczeństwo.'],
        ['title' => 'Testy i optymalizacja', 'desc' => 'Testuję stronę na różnych urządzeniach i przeglądarkach. Optymalizuję pod kątem SEO i wydajności.'],
        ['title' => 'Publikacja i wsparcie', 'desc' => 'Wdrażam stronę na serwer produkcyjny i zapewniam szkolenie. Oferuję stałe wsparcie techniczne.'],
    ],

    // ========================================
    // FAQ - PYTANIA I ODPOWIEDZI
    // ========================================
    'faqs' => [
        [
            'question' => 'Ile kosztuje stworzenie strony internetowej?',
            'answer' => 'Cena zależy od zakresu projektu. Prosta strona wizytówka to koszt od X zł, natomiast rozbudowany sklep internetowy od Y zł. Każdy projekt wyceniam indywidualnie po poznaniu Twoich potrzeb.'
        ],
        [
            'question' => 'Jak długo trwa realizacja projektu?',
            'answer' => 'Czas realizacji zależy od złożoności projektu. Prosta strona wizytówka to zazwyczaj 1-2 tygodnie, natomiast sklep internetowy lub aplikacja webowa może zająć od 4 do 8 tygodni.'
        ],
        [
            'question' => 'Czy będę mógł samodzielnie edytować stronę?',
            'answer' => 'Tak! Jeśli tego potrzebujesz, wyposażę stronę w intuicyjny panel administracyjny, dzięki któremu będziesz mógł samodzielnie edytować treści, dodawać zdjęcia i zarządzać zawartością strony.'
        ],
        [
            'question' => 'Czy zajmujesz się też hostingiem i domeną?',
            'answer' => 'Tak, pomagam w wyborze odpowiedniego hostingu i rejestracji domeny. Mogę też zająć się całą konfiguracją techniczną, abyś nie musiał martwić się szczegółami.'
        ],
        [
            'question' => 'Co jeśli po wdrożeniu będę potrzebował zmian?',
            'answer' => 'Oferuję pakiety wsparcia technicznego, które obejmują drobne poprawki i aktualizacje. Większe modyfikacje wyceniam indywidualnie. Zawsze możesz na mnie liczyć!'
        ],
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
