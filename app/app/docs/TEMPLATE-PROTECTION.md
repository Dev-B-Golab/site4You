# 🔒 Template Protection System

Profesjonalny system ochrony szablonów HTML przed nieautoryzowanym kopiowaniem i podglądaniem kodu źródłowego.

## ⚡ Szybki start

### Obfuskacja statycznych szablonów

```bash
php scripts/template-obfuscator.php
```

Szablony zostaną przetworzone i zapisane w `public/templates-protected/`.

### Użycie przez API (Laravel)

```javascript
// Na stronie z podglądem szablonu
const loader = new TemplateLoader({
    baseUrl: '/api/templates',
    tokenEndpoint: '/api/templates/token'
});

// Załaduj szablon do iframe
await loader.loadInIframe('business', '#preview-iframe');

// Lub bezpośrednio do dokumentu
await loader.load('portfolio');
```

---

## 🛡️ Warstwy zabezpieczeń

### 1. Minifikacja HTML/CSS/JS
- Usuwanie komentarzy
- Kompresja białych znaków
- Optymalizacja rozmiaru

### 2. Obfuskacja nazw klas CSS
- Automatyczna zamiana nazw klas na losowe identyfikatory
- Klasy Bootstrap pozostają niezmienione (kompatybilność)

### 3. Szyfrowanie XOR + Base64
- Kod źródłowy jest zaszyfrowany
- Nie można go odczytać bezpośrednio z pliku

### 4. Fragmentacja kodu
- Szablon dzielony na 4 części
- Części są pomieszane w losowej kolejności
- Składane są dopiero przy renderowaniu

### 5. Zabezpieczenia Anti-debugging
- Blokowanie DevTools
- Blokowanie prawego przycisku myszy
- Blokowanie F12, Ctrl+U, Ctrl+Shift+I
- Wykrywanie debuggera

---

## 📁 Struktura plików

```
scripts/
├── template-obfuscator.php    # Skrypt obfuskacji (PHP)
├── template-obfuscator.js     # Skrypt obfuskacji (Node.js)

public/
├── templates/                  # Oryginalne szablony (niepubliczne)
├── templates-protected/        # Chronione szablony (serwowane)
└── js/
    └── template-loader.js     # Loader po stronie klienta

app/Http/Controllers/
└── TemplateController.php     # Backend API

resources/views/templates/
└── preview.blade.php          # Strona podglądu
```

---

## 🔧 Konfiguracja

### Ustawienia obfuskacji (w skrypcie PHP)

```php
private int $splitChunks = 4;      // Liczba fragmentów
private bool $addAntiDebug = true; // Zabezpieczenia anti-debug
private bool $minify = true;       // Minifikacja HTML
```

---

## 🌐 API Endpoints

### Generowanie tokenu
```
POST /api/templates/token
```
Zwraca jednorazowy token dostępu (ważny 5 minut).

### Pobieranie szablonu (HTML)
```
GET /api/templates/{template}
Header: X-Template-Token: {token}
```
Zwraca obfuskowany HTML.

### Pobieranie szablonu (JSON - zaszyfrowany)
```
GET /api/templates/{template}/encrypted
Header: X-Template-Token: {token}
```
Zwraca zaszyfrowane dane JSON do deszyfrowania przez JavaScript.

---

## 🚀 Deployment

### Krok 1: Wygeneruj chronione szablony
```bash
php scripts/template-obfuscator.php
```

### Krok 2: Upewnij się, że oryginalne szablony są zabezpieczone
W `.htaccess` lub konfiguracji serwera:
```apache
<Directory /path/to/public/templates>
    Deny from all
</Directory>
```

### Krok 3: Serwuj tylko chronione szablony
Użytkownicy powinni mieć dostęp tylko do:
- `/templates-protected/` (chronione wersje statyczne)
- `/api/templates/*` (dynamiczne API)
- `/preview/templates/*` (strona podglądu)

---

## ⚠️ Ważne uwagi

1. **Nie ma 100% ochrony** - zdeterminowany użytkownik zawsze może obejść zabezpieczenia
2. **Zabezpieczenia są warstwowe** - im więcej warstw, tym trudniej
3. **Regularnie regeneruj szablony** - klucze szyfrowania się zmieniają
4. **Monitoruj dostęp** - loguj podejrzane żądania

---

## 📊 Przykład działania

### Oryginalny kod:
```html
<div class="hero-business">
    <h1>Profesjonalne rozwiązania</h1>
</div>
```

### Po obfuskacji:
```html
<!DOCTYPE html>
<html>
<head>...</head>
<body>
    <script>
    (function(){
        var _0xab4ae0=[{"id":"fbd0280541c4e8a1","data":"Xkd1KnIxa2ByFQ1CVFoOBQoS...
        // Zaszyfrowane fragmenty
    })();
    </script>
</body>
</html>
```

---

## 🔄 Aktualizacja szablonów

Po każdej zmianie w oryginalnych szablonach:

```bash
php scripts/template-obfuscator.php
```

Lub dodaj do procesu deployment:
```bash
npm run build:all
# lub
composer run-script post-deploy
```
