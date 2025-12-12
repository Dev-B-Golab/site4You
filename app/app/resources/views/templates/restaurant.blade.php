<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('site.tpl_restaurant.title') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Lato:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --gold: #d4a853;
            --gold-light: #f5e6c8;
            --dark: #1a1a1a;
            --darker: #0d0d0d;
            --cream: #f9f6f0;
            --gray: #888;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { 
            font-family: 'Lato', sans-serif; 
            background: var(--darker); 
            color: #e8e8e8;
            overflow-x: hidden;
        }
        h1, h2, h3, h4, h5, h6 { font-family: 'Playfair Display', serif; }
        
        /* Navbar */
        .navbar-restaurant {
            background: rgba(13, 13, 13, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 1.5rem 0;
            position: fixed;
            width: 100%;
            z-index: 1000;
            transition: all 0.3s ease;
        }
        .navbar-restaurant.scrolled { background: var(--darker); }
        .navbar-restaurant .navbar-brand { 
            font-family: 'Playfair Display', serif;
            font-weight: 700; 
            font-size: 2rem; 
            color: var(--gold);
        }
        .navbar-restaurant .nav-link { 
            color: white; 
            font-weight: 400; 
            margin: 0 1rem; 
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 2px;
        }
        .navbar-restaurant .nav-link:hover { color: var(--gold); }
        .btn-gold { 
            background: transparent; 
            color: var(--gold); 
            border: 1px solid var(--gold); 
            padding: 0.6rem 1.5rem; 
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 2px;
        }
        .btn-gold:hover { background: var(--gold); color: var(--dark); }
        
        /* Hero */
        .hero-restaurant {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.75)), 
                        url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1920&h=1080&fit=crop') center/cover;
            text-align: center;
        }
        .hero-restaurant h1 { 
            font-size: 5rem; 
            font-weight: 400; 
            letter-spacing: 10px;
            text-transform: uppercase;
            text-shadow: 0 4px 30px rgba(0,0,0,0.5);
        }
        .hero-restaurant .subtitle {
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: 5px;
            font-size: 1rem;
            margin-bottom: 1rem;
            text-shadow: 0 2px 10px rgba(0,0,0,0.5);
        }
        .hero-restaurant p { 
            font-size: 1.1rem; 
            color: #ccc; 
            max-width: 600px;
            margin: 1.5rem auto 2rem;
            text-shadow: 0 2px 10px rgba(0,0,0,0.5);
        }
        .hero-restaurant .btn-gold {
            box-shadow: 0 4px 20px rgba(212, 168, 83, 0.3);
        }
        .scroll-indicator {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            color: var(--gold);
            font-size: 1.5rem;
            animation: bounce 2s infinite;
        }
        @keyframes bounce {
            0%, 100% { transform: translateX(-50%) translateY(0); }
            50% { transform: translateX(-50%) translateY(10px); }
        }
        
        /* About */
        .about-restaurant { padding: 120px 0; background: var(--dark); }
        .section-label {
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: 5px;
            font-size: 0.8rem;
            display: block;
            margin-bottom: 1rem;
        }
        .section-title { font-size: 3rem; font-weight: 400; margin-bottom: 2rem; }
        .about-restaurant p { color: var(--gray); line-height: 1.9; font-size: 1.05rem; }
        .about-img { border-radius: 0; box-shadow: 20px 20px 0 var(--gold); }
        .signature { font-family: 'Playfair Display', serif; font-style: italic; color: var(--gold); font-size: 1.5rem; margin-top: 2rem; }
        
        /* Menu */
        .menu-section { padding: 120px 0; background: var(--darker); }
        .menu-section .section-title { text-align: center; }
        .menu-tabs { 
            display: flex; 
            justify-content: center; 
            gap: 2rem; 
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }
        .menu-tab {
            background: none;
            border: none;
            color: var(--gray);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 0.5rem 0;
            cursor: pointer;
            position: relative;
        }
        .menu-tab.active { color: var(--gold); }
        .menu-tab.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 1px;
            background: var(--gold);
        }
        .menu-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 1.5rem 0;
            border-bottom: 1px solid #333;
        }
        .menu-item-name { font-family: 'Playfair Display', serif; font-size: 1.25rem; }
        .menu-item-desc { color: var(--gray); font-size: 0.9rem; margin-top: 0.5rem; }
        .menu-item-price { color: var(--gold); font-size: 1.25rem; white-space: nowrap; margin-left: 2rem; }
        
        /* Gallery */
        .gallery-section { padding: 0; }
        .gallery-grid { display: grid; grid-template-columns: repeat(4, 1fr); }
        .gallery-item { 
            position: relative; 
            aspect-ratio: 1; 
            overflow: hidden;
        }
        .gallery-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .gallery-item:hover img { transform: scale(1.1); }
        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .gallery-item:hover .gallery-overlay { opacity: 1; }
        .gallery-overlay i { color: var(--gold); font-size: 2rem; }
        
        /* Reservation */
        .reservation-section { padding: 120px 0; background: var(--dark); }
        .reservation-box {
            background: var(--darker);
            padding: 4rem;
            max-width: 600px;
            margin: 0 auto;
        }
        .form-control-custom {
            background: transparent;
            border: none;
            border-bottom: 1px solid #444;
            border-radius: 0;
            color: white;
            padding: 1rem 0;
        }
        .form-control-custom:focus {
            background: transparent;
            border-color: var(--gold);
            box-shadow: none;
            color: white;
        }
        .form-control-custom::placeholder { color: var(--gray); }
        .btn-gold-solid {
            background: var(--gold);
            color: var(--dark);
            border: none;
            padding: 1rem 3rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.85rem;
            width: 100%;
            margin-top: 1rem;
        }
        .btn-gold-solid:hover { background: #c49a47; color: var(--dark); }
        
        /* Info */
        .info-section { padding: 80px 0; background: var(--darker); }
        .info-item { text-align: center; padding: 2rem; }
        .info-item i { color: var(--gold); font-size: 2rem; margin-bottom: 1rem; }
        .info-item h5 { font-weight: 400; margin-bottom: 0.5rem; }
        .info-item p { color: var(--gray); font-size: 0.95rem; }
        
        /* Footer */
        .footer-restaurant {
            background: var(--dark);
            padding: 40px 0;
            text-align: center;
            border-top: 1px solid #333;
        }
        .footer-restaurant .brand { color: var(--gold); font-size: 2rem; font-family: 'Playfair Display', serif; }
        .footer-restaurant p { color: var(--gray); margin-top: 1rem; font-size: 0.9rem; }
        .footer-social a { color: var(--gray); margin: 0 0.75rem; font-size: 1.25rem; }
        .footer-social a:hover { color: var(--gold); }
        
        @media (max-width: 992px) {
            .gallery-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            .hero-restaurant h1 { font-size: 2.5rem; letter-spacing: 5px; }
            .hero-restaurant p { font-size: 1rem; padding: 0 1rem; }
            .hero-restaurant .btn-gold {
                display: block;
                width: 80%;
                max-width: 250px;
                margin: 0.5rem auto;
            }
            .hero-restaurant .btn-gold.me-3 { margin-right: auto !important; }
            .section-title { font-size: 2rem; }
            .reservation-box { padding: 2rem; }
            .about-img { box-shadow: 10px 10px 0 var(--gold); }
            .menu-item { flex-direction: column; }
            .menu-item-price { margin-left: 0; margin-top: 0.5rem; }
        }
        @media (max-width: 576px) {
            .gallery-grid { grid-template-columns: 1fr; }
        }
        
        /* Mobile navbar menu */
        @media (max-width: 991px) {
            .navbar-restaurant {
                background: var(--darker) !important;
            }
            .navbar-restaurant .navbar-collapse {
                background: var(--darker);
                padding: 1rem;
                margin-top: 1rem;
                border-radius: 8px;
                border: 1px solid rgba(212, 168, 83, 0.2);
            }
            .navbar-restaurant .nav-link {
                padding: 0.75rem 0;
                margin: 0;
                border-bottom: 1px solid rgba(255,255,255,0.1);
            }
            .navbar-restaurant .btn-gold {
                margin-top: 1rem;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-restaurant">
        <div class="container">
            <a class="navbar-brand" href="#">{{ __('site.tpl_restaurant.brand') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarRestaurant">
                <i class="bi bi-list text-white fs-4"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarRestaurant">
                <ul class="navbar-nav ms-auto me-4">
                    <li class="nav-item"><a class="nav-link" href="#">{{ __('site.tpl_restaurant.nav.home') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">{{ __('site.tpl_restaurant.nav.about') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">{{ __('site.tpl_restaurant.nav.menu') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">{{ __('site.tpl_restaurant.nav.gallery') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">{{ __('site.tpl_restaurant.nav.contact') }}</a></li>
                </ul>
                <a href="#" class="btn btn-gold">{{ __('site.tpl_restaurant.reservation_btn') }}</a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero-restaurant">
        <div class="container">
            <span class="subtitle">{{ __('site.tpl_restaurant.hero.welcome') }}</span>
            <h1>{{ __('site.tpl_restaurant.brand') }}</h1>
            <p>{{ __('site.tpl_restaurant.hero.desc') }}</p>
            <a href="#" class="btn btn-gold btn-lg me-3">{{ __('site.tpl_restaurant.hero.btn_menu') }}</a>
            <a href="#" class="btn btn-gold btn-lg">{{ __('site.tpl_restaurant.hero.btn_reserve') }}</a>
        </div>
        <div class="scroll-indicator">
            <i class="bi bi-chevron-down"></i>
        </div>
    </section>

    <!-- About -->
    <section class="about-restaurant">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1600565193348-f74bd3c7ccdf?w=600&h=700&fit=crop" alt="Chef" class="img-fluid about-img">
                </div>
                <div class="col-lg-6">
                    <span class="section-label">{{ __('site.tpl_restaurant.about.label') }}</span>
                    <h2 class="section-title">{{ __('site.tpl_restaurant.about.title') }}</h2>
                    <p>{{ __('site.tpl_restaurant.about.text_1') }}</p>
                    <p>{{ __('site.tpl_restaurant.about.text_2') }}</p>
                    <p class="signature">{{ __('site.tpl_restaurant.about.signature') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Menu -->
    <section class="menu-section">
        <div class="container">
            <span class="section-label text-center d-block">{{ __('site.tpl_restaurant.menu.label') }}</span>
            <h2 class="section-title">{{ __('site.tpl_restaurant.menu.title') }}</h2>
            <div class="menu-tabs">
                <button class="menu-tab active">{{ __('site.tpl_restaurant.menu.tabs.starters') }}</button>
                <button class="menu-tab">{{ __('site.tpl_restaurant.menu.tabs.mains') }}</button>
                <button class="menu-tab">{{ __('site.tpl_restaurant.menu.tabs.desserts') }}</button>
                <button class="menu-tab">{{ __('site.tpl_restaurant.menu.tabs.drinks') }}</button>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="menu-item">
                        <div>
                            <div class="menu-item-name">{{ __('site.tpl_restaurant.menu.items.tartare.name') }}</div>
                            <div class="menu-item-desc">{{ __('site.tpl_restaurant.menu.items.tartare.desc') }}</div>
                        </div>
                        <div class="menu-item-price">45 zł</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <div class="menu-item-name">{{ __('site.tpl_restaurant.menu.items.carpaccio.name') }}</div>
                            <div class="menu-item-desc">{{ __('site.tpl_restaurant.menu.items.carpaccio.desc') }}</div>
                        </div>
                        <div class="menu-item-price">32 zł</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <div class="menu-item-name">{{ __('site.tpl_restaurant.menu.items.shrimp.name') }}</div>
                            <div class="menu-item-desc">{{ __('site.tpl_restaurant.menu.items.shrimp.desc') }}</div>
                        </div>
                        <div class="menu-item-price">58 zł</div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="menu-item">
                        <div>
                            <div class="menu-item-name">{{ __('site.tpl_restaurant.menu.items.soup.name') }}</div>
                            <div class="menu-item-desc">{{ __('site.tpl_restaurant.menu.items.soup.desc') }}</div>
                        </div>
                        <div class="menu-item-price">28 zł</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <div class="menu-item-name">{{ __('site.tpl_restaurant.menu.items.bruschetta.name') }}</div>
                            <div class="menu-item-desc">{{ __('site.tpl_restaurant.menu.items.bruschetta.desc') }}</div>
                        </div>
                        <div class="menu-item-price">34 zł</div>
                    </div>
                    <div class="menu-item">
                        <div>
                            <div class="menu-item-name">{{ __('site.tpl_restaurant.menu.items.salad.name') }}</div>
                            <div class="menu-item-desc">{{ __('site.tpl_restaurant.menu.items.salad.desc') }}</div>
                        </div>
                        <div class="menu-item-price">38 zł</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery -->
    <section class="gallery-section">
        <div class="gallery-grid">
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=400&h=400&fit=crop" alt="Food 1">
                <div class="gallery-overlay"><i class="bi bi-zoom-in"></i></div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=400&h=400&fit=crop" alt="Food 2">
                <div class="gallery-overlay"><i class="bi bi-zoom-in"></i></div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1476224203421-9ac39bcb3327?w=400&h=400&fit=crop" alt="Food 3">
                <div class="gallery-overlay"><i class="bi bi-zoom-in"></i></div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=400&h=400&fit=crop" alt="Restaurant">
                <div class="gallery-overlay"><i class="bi bi-zoom-in"></i></div>
            </div>
        </div>
    </section>

    <!-- Reservation -->
    <section class="reservation-section">
        <div class="container">
            <div class="text-center mb-5">
                <span class="section-label">{{ __('site.tpl_restaurant.reservation.label') }}</span>
                <h2 class="section-title">{{ __('site.tpl_restaurant.reservation.title') }}</h2>
            </div>
            <div class="reservation-box">
                <form>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <input type="text" class="form-control form-control-custom" placeholder="{{ __('site.tpl_restaurant.reservation.form.name') }}">
                        </div>
                        <div class="col-md-6">
                            <input type="tel" class="form-control form-control-custom" placeholder="{{ __('site.tpl_restaurant.reservation.form.phone') }}">
                        </div>
                        <div class="col-md-6">
                            <input type="date" class="form-control form-control-custom">
                        </div>
                        <div class="col-md-6">
                            <input type="time" class="form-control form-control-custom">
                        </div>
                        <div class="col-12">
                            <select class="form-control form-control-custom">
                                <option value="">{{ __('site.tpl_restaurant.reservation.form.guests') }}</option>
                                @foreach(__('site.tpl_restaurant.reservation.form.guests_options') as $option)
                                    <option>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-gold-solid">{{ __('site.tpl_restaurant.reservation.form.submit') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Info -->
    <section class="info-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="info-item">
                        <i class="bi bi-geo-alt"></i>
                        <h5>{{ __('site.tpl_restaurant.info.address.title') }}</h5>
                        <p>{{ __('site.tpl_restaurant.info.address.line_1') }}<br>{{ __('site.tpl_restaurant.info.address.line_2') }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-item">
                        <i class="bi bi-clock"></i>
                        <h5>{{ __('site.tpl_restaurant.info.hours.title') }}</h5>
                        <p>{{ __('site.tpl_restaurant.info.hours.line_1') }}<br>{{ __('site.tpl_restaurant.info.hours.line_2') }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-item">
                        <i class="bi bi-telephone"></i>
                        <h5>{{ __('site.tpl_restaurant.info.contact.title') }}</h5>
                        <p>{{ __('site.tpl_restaurant.info.contact.line_1') }}<br>{{ __('site.tpl_restaurant.info.contact.line_2') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-restaurant">
        <div class="container">
            <div class="brand">{{ __('site.tpl_restaurant.brand') }}</div>
            <div class="footer-social my-3">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-tiktok"></i></a>
            </div>
            <p>{{ __('site.tpl_restaurant.footer.copyright') }}</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
