<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('site.tpl_ecommerce.title') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #a5b4fc;
            --secondary: #10b981;
            --accent: #f59e0b;
            --dark: #0f172a;
            --darker: #020617;
            --gray: #64748b;
            --gray-light: #94a3b8;
            --light: #f8fafc;
            --border: #e2e8f0;
            --card-bg: #ffffff;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { 
            font-family: 'Inter', sans-serif; 
            background: var(--light); 
            color: var(--dark);
            overflow-x: hidden;
        }
        
        /* TOP BAR */
        .top-bar {
            background: var(--dark);
            color: var(--gray-light);
            font-size: 0.8rem;
            padding: 0.5rem 0;
        }
        .top-bar a { color: var(--gray-light); text-decoration: none; }
        .top-bar a:hover { color: white; }
        .top-bar-links { display: flex; gap: 1.5rem; }
        
        /* HEADER / NAVBAR */
        .header-main {
            background: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .header-container {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            gap: 2rem;
        }
        .logo {
            font-weight: 800;
            font-size: 1.75rem;
            color: var(--dark);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .logo i { color: var(--primary); }
        
        /* SEARCH BAR */
        .search-bar {
            flex: 1;
            max-width: 600px;
            position: relative;
        }
        .search-bar input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 3rem;
            border: 2px solid var(--border);
            border-radius: 50px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }
        .search-bar input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        .search-bar i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
        }
        
        /* HEADER ICONS */
        .header-icons {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        .header-icon {
            position: relative;
            color: var(--dark);
            font-size: 1.5rem;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .header-icon:hover { color: var(--primary); }
        .header-icon .badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--primary);
            color: white;
            font-size: 0.7rem;
            padding: 0.2rem 0.5rem;
            border-radius: 50px;
        }
        
        /* MAIN NAV */
        .main-nav {
            background: var(--dark);
            padding: 0;
        }
        .nav-menu {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .nav-menu > li > a {
            display: block;
            padding: 1rem 1.5rem;
            color: white;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        .nav-menu > li > a:hover,
        .nav-menu > li > a.active {
            background: var(--primary);
        }
        .nav-menu .dropdown-menu {
            border: none;
            border-radius: 8px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            padding: 1rem 0;
        }
        .nav-menu .dropdown-item {
            padding: 0.5rem 1.5rem;
            font-size: 0.9rem;
        }
        .nav-menu .dropdown-item:hover {
            background: var(--light);
            color: var(--primary);
        }
        
        /* HERO BANNER */
        .hero-banner {
            background: linear-gradient(135deg, var(--dark) 0%, #1e293b 100%);
            padding: 60px 0;
            position: relative;
            overflow: hidden;
        }
        .hero-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.3) 0%, transparent 70%);
            border-radius: 50%;
        }
        .hero-content { position: relative; z-index: 1; }
        .hero-badge {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .hero-banner h1 {
            font-size: 3rem;
            font-weight: 800;
            color: white;
            line-height: 1.2;
            margin-bottom: 1rem;
        }
        .hero-banner h1 span { color: var(--primary-light); }
        .hero-banner p {
            color: var(--gray-light);
            font-size: 1.1rem;
            margin-bottom: 2rem;
            max-width: 500px;
        }
        .btn-shop {
            background: var(--primary);
            color: white;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }
        .btn-shop:hover {
            background: var(--primary-dark);
            color: white;
            transform: translateY(-2px);
        }
        .hero-image img {
            max-width: 100%;
            filter: drop-shadow(0 20px 40px rgba(0,0,0,0.3));
        }
        
        /* FEATURES BAR */
        .features-bar {
            background: white;
            padding: 1.5rem 0;
            border-bottom: 1px solid var(--border);
        }
        .feature-item {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .feature-item i {
            font-size: 1.5rem;
            color: var(--primary);
        }
        .feature-item h6 {
            margin: 0;
            font-weight: 600;
            font-size: 0.9rem;
        }
        .feature-item p {
            margin: 0;
            font-size: 0.8rem;
            color: var(--gray);
        }
        
        /* SECTIONS */
        .section { padding: 60px 0; }
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        .section-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0;
        }
        .section-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .section-link:hover { text-decoration: underline; }
        
        /* CATEGORIES */
        .category-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem 1rem;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid var(--border);
            text-decoration: none;
            color: var(--dark);
            display: block;
            height: 100%;
        }
        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-color: var(--primary);
        }
        .category-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.75rem;
            font-size: 1.5rem;
            color: white;
        }
        .category-card h5 {
            font-weight: 600;
            margin-bottom: 0.25rem;
            font-size: 0.9rem;
            line-height: 1.3;
            word-wrap: break-word;
            overflow-wrap: break-word;
            hyphens: auto;
        }
        .category-card p {
            color: var(--gray);
            font-size: 0.75rem;
            margin: 0;
            white-space: nowrap;
        }
        
        /* PRODUCT CARD */
        .product-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid var(--border);
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        }
        .product-image {
            position: relative;
            padding: 1.5rem;
            background: var(--light);
            text-align: center;
        }
        .product-image img {
            max-width: 100%;
            height: 180px;
            object-fit: contain;
            transition: transform 0.3s ease;
        }
        .product-card:hover .product-image img {
            transform: scale(1.05);
        }
        .product-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            padding: 0.3rem 0.75rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .badge-sale { background: #ef4444; color: white; }
        .badge-new { background: var(--secondary); color: white; }
        .badge-hot { background: var(--accent); color: white; }
        .product-wishlist {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 36px;
            height: 36px;
            background: white;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .product-wishlist:hover {
            background: #ef4444;
            color: white;
        }
        .product-body {
            padding: 1.25rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .product-category {
            color: var(--gray);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .product-title {
            font-weight: 600;
            font-size: 1rem;
            margin: 0.5rem 0;
            color: var(--dark);
            text-decoration: none;
            display: block;
        }
        .product-title:hover { color: var(--primary); }
        .product-rating {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.75rem;
        }
        .product-rating .stars { color: var(--accent); font-size: 0.85rem; }
        .product-rating span { color: var(--gray); font-size: 0.8rem; }
        .product-price {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-top: auto;
        }
        .price-current {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary);
        }
        .price-old {
            font-size: 0.95rem;
            color: var(--gray);
            text-decoration: line-through;
        }
        .product-footer {
            padding: 0 1.25rem 1.25rem;
            margin-top: auto;
        }
        .btn-add-cart {
            width: 100%;
            background: var(--dark);
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-add-cart:hover {
            background: var(--primary);
        }
        
        /* PROMO BANNER */
        .promo-banner {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 24px;
            padding: 3rem;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .promo-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 400px;
            height: 400px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }
        .promo-banner h3 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        .promo-banner p {
            opacity: 0.9;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }
        .promo-code {
            display: inline-block;
            background: rgba(255,255,255,0.2);
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            font-family: monospace;
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: 2px;
        }
        
        /* NEWSLETTER */
        .newsletter-section {
            background: var(--dark);
            padding: 60px 0;
            color: white;
        }
        .newsletter-section h3 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        .newsletter-section p {
            color: var(--gray-light);
            margin-bottom: 1.5rem;
        }
        .newsletter-form {
            display: flex;
            gap: 1rem;
            max-width: 500px;
        }
        .newsletter-form input {
            flex: 1;
            padding: 1rem 1.5rem;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
        }
        .newsletter-form button {
            background: var(--primary);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .newsletter-form button:hover {
            background: var(--primary-dark);
        }
        
        /* FOOTER */
        .footer {
            background: var(--darker);
            color: var(--gray-light);
            padding: 60px 0 30px;
        }
        .footer-brand {
            font-size: 1.5rem;
            font-weight: 800;
            color: white;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
        .footer-brand i { color: var(--primary); }
        .footer-text {
            font-size: 0.9rem;
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }
        .footer-social a {
            color: var(--gray-light);
            font-size: 1.25rem;
            margin-right: 1rem;
            transition: color 0.3s ease;
        }
        .footer-social a:hover { color: var(--primary); }
        .footer-title {
            color: white;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .footer-links li { margin-bottom: 0.75rem; }
        .footer-links a {
            color: var(--gray-light);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }
        .footer-links a:hover { color: white; }
        .footer-contact li {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }
        .footer-contact i { color: var(--primary); margin-top: 3px; }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            margin-top: 3rem;
            padding-top: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .payment-icons img {
            height: 30px;
            margin-left: 0.5rem;
            opacity: 0.7;
        }
        
        /* MOBILE STYLES */
        @media (max-width: 991px) {
            .header-container { flex-wrap: wrap; }
            .search-bar { order: 3; max-width: 100%; width: 100%; margin-top: 1rem; }
            .nav-menu { display: none; }
            .mobile-toggle { display: block; }
        }
        
        @media (max-width: 768px) {
            .top-bar { display: none; }
            .hero-banner { padding: 40px 0; text-align: center; }
            .hero-banner h1 { font-size: 2rem; }
            .hero-banner p { margin: 1rem auto; }
            .hero-image { margin-top: 2rem; }
            .feature-item { flex-direction: column; text-align: center; }
            .section-header { flex-direction: column; gap: 1rem; text-align: center; }
            .promo-banner { padding: 2rem; text-align: center; }
            .promo-banner h3 { font-size: 1.5rem; }
            .newsletter-form { flex-direction: column; }
            .footer-bottom { justify-content: center; text-align: center; }
            
            /* Product cards - single column on mobile */
            .section .row .col-6.col-lg-3 {
                width: 100%;
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
        
        /* Mobile menu */
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
        }
        @media (max-width: 991px) {
            .mobile-toggle { display: block; }
            .nav-menu {
                display: none;
                flex-direction: column;
                width: 100%;
            }
            .nav-menu.active { display: flex; }
            .nav-menu > li > a {
                border-bottom: 1px solid rgba(255,255,255,0.1);
            }
        }
    </style>
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="top-bar-links">
                    <a href="#"><i class="bi bi-truck me-1"></i> {{ __('site.tpl_ecommerce.top_bar.free_shipping') }}</a>
                    <a href="#"><i class="bi bi-arrow-repeat me-1"></i> {{ __('site.tpl_ecommerce.top_bar.returns') }}</a>
                </div>
                <div class="top-bar-links">
                    <a href="#">{{ __('site.tpl_ecommerce.top_bar.help') }}</a>
                    <a href="#">{{ __('site.tpl_ecommerce.top_bar.tracking') }}</a>
                    <a href="#">{{ __('site.tpl_ecommerce.top_bar.lang') }}</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="header-main">
        <div class="container">
            <div class="header-container">
                <a href="#" class="logo"><i class="bi bi-cpu"></i> {{ __('site.tpl_ecommerce.brand') }}</a>
                
                <div class="search-bar">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="{{ __('site.tpl_ecommerce.search') }}">
                </div>
                
                <div class="header-icons">
                    <a href="#" class="header-icon" title="Account">
                        <i class="bi bi-person"></i>
                    </a>
                    <a href="#" class="header-icon" title="Wishlist">
                        <i class="bi bi-heart"></i>
                        <span class="badge">2</span>
                    </a>
                    <a href="#" class="header-icon" title="Cart">
                        <i class="bi bi-cart3"></i>
                        <span class="badge">3</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Navigation -->
    <nav class="main-nav">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <ul class="nav-menu" id="navMenu">
                    <li><a href="#" class="active">{{ __('site.tpl_ecommerce.nav.home') }}</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">{{ __('site.tpl_ecommerce.nav.smartphones') }}</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Apple iPhone</a></li>
                            <li><a class="dropdown-item" href="#">Samsung Galaxy</a></li>
                            <li><a class="dropdown-item" href="#">Xiaomi</a></li>
                            <li><a class="dropdown-item" href="#">Google Pixel</a></li>
                        </ul>
                    </li>
                    <li><a href="#">{{ __('site.tpl_ecommerce.nav.laptops') }}</a></li>
                    <li><a href="#">{{ __('site.tpl_ecommerce.nav.tablets') }}</a></li>
                    <li><a href="#">{{ __('site.tpl_ecommerce.nav.audio') }}</a></li>
                    <li><a href="#">{{ __('site.tpl_ecommerce.nav.gaming') }}</a></li>
                    <li><a href="#">{{ __('site.tpl_ecommerce.nav.accessories') }}</a></li>
                    <li><a href="#" style="color: #f59e0b;"><i class="bi bi-lightning-fill"></i> {{ __('site.tpl_ecommerce.nav.promotions') }}</a></li>
                </ul>
                <button class="mobile-toggle" id="mobileToggle">
                    <i class="bi bi-list"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Banner -->
    <section class="hero-banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <span class="hero-badge"><i class="bi bi-stars me-1"></i> {{ __('site.tpl_ecommerce.hero.badge') }}</span>
                    <h1>{{ __('site.tpl_ecommerce.hero.title_1') }} <span>{{ __('site.tpl_ecommerce.hero.title_2') }}</span> {{ __('site.tpl_ecommerce.hero.title_3') }}</h1>
                    <p>{{ __('site.tpl_ecommerce.hero.desc') }}</p>
                    <a href="#" class="btn-shop">
                        {{ __('site.tpl_ecommerce.hero.btn') }} <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="col-lg-6 hero-image text-center">
                    <img src="https://images.unsplash.com/photo-1695048133142-1a20484d2569?w=500&h=500&fit=crop" alt="iPhone 15 Pro">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Bar -->
    <section class="features-bar">
        <div class="container">
            <div class="row g-4">
                <div class="col-6 col-lg-3">
                    <div class="feature-item">
                        <i class="bi bi-truck"></i>
                        <div>
                            <h6>{{ __('site.tpl_ecommerce.features.shipping.title') }}</h6>
                            <p>{{ __('site.tpl_ecommerce.features.shipping.desc') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="feature-item">
                        <i class="bi bi-shield-check"></i>
                        <div>
                            <h6>{{ __('site.tpl_ecommerce.features.warranty.title') }}</h6>
                            <p>{{ __('site.tpl_ecommerce.features.warranty.desc') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="feature-item">
                        <i class="bi bi-arrow-repeat"></i>
                        <div>
                            <h6>{{ __('site.tpl_ecommerce.features.returns.title') }}</h6>
                            <p>{{ __('site.tpl_ecommerce.features.returns.desc') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="feature-item">
                        <i class="bi bi-headset"></i>
                        <div>
                            <h6>{{ __('site.tpl_ecommerce.features.support.title') }}</h6>
                            <p>{{ __('site.tpl_ecommerce.features.support.desc') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">{{ __('site.tpl_ecommerce.categories.title') }}</h2>
                <a href="#" class="section-link">{{ __('site.tpl_ecommerce.categories.view_all') }} <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="row g-4">
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="#" class="category-card">
                        <div class="category-icon"><i class="bi bi-phone"></i></div>
                        <h5>{{ __('site.tpl_ecommerce.categories.items.phones.name') }}</h5>
                        <p>{{ __('site.tpl_ecommerce.categories.items.phones.count') }}</p>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="#" class="category-card">
                        <div class="category-icon"><i class="bi bi-laptop"></i></div>
                        <h5>{{ __('site.tpl_ecommerce.categories.items.laptops.name') }}</h5>
                        <p>{{ __('site.tpl_ecommerce.categories.items.laptops.count') }}</p>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="#" class="category-card">
                        <div class="category-icon"><i class="bi bi-tablet"></i></div>
                        <h5>{{ __('site.tpl_ecommerce.categories.items.tablets.name') }}</h5>
                        <p>{{ __('site.tpl_ecommerce.categories.items.tablets.count') }}</p>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="#" class="category-card">
                        <div class="category-icon"><i class="bi bi-headphones"></i></div>
                        <h5>{{ __('site.tpl_ecommerce.categories.items.audio.name') }}</h5>
                        <p>{{ __('site.tpl_ecommerce.categories.items.audio.count') }}</p>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="#" class="category-card">
                        <div class="category-icon"><i class="bi bi-controller"></i></div>
                        <h5>{{ __('site.tpl_ecommerce.categories.items.gaming.name') }}</h5>
                        <p>{{ __('site.tpl_ecommerce.categories.items.gaming.count') }}</p>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="#" class="category-card">
                        <div class="category-icon"><i class="bi bi-smartwatch"></i></div>
                        <h5>{{ __('site.tpl_ecommerce.categories.items.smartwatch.name') }}</h5>
                        <p>{{ __('site.tpl_ecommerce.categories.items.smartwatch.count') }}</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="section" style="background: white;">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">{{ __('site.tpl_ecommerce.products.title') }}</h2>
                <a href="#" class="section-link">{{ __('site.tpl_ecommerce.products.view_all') }} <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="row g-4">
                <!-- Product 1 -->
                <div class="col-6 col-lg-3">
                    <div class="product-card">
                        <div class="product-image">
                            <span class="product-badge badge-new">{{ __('site.tpl_ecommerce.products.badge_new') }}</span>
                            <button class="product-wishlist"><i class="bi bi-heart"></i></button>
                            <img src="https://images.unsplash.com/photo-1606220588913-b3aacb4d2f46?w=400&h=400&fit=crop" alt="AirPods Pro">
                        </div>
                        <div class="product-body">
                            <span class="product-category">{{ __('site.tpl_ecommerce.nav.audio') }}</span>
                            <a href="#" class="product-title">Apple AirPods Pro (2. gen)</a>
                            <div class="product-rating">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <span>(128)</span>
                            </div>
                            <div class="product-price">
                                <span class="price-current">1 149 zł</span>
                            </div>
                        </div>
                        <div class="product-footer">
                            <button class="btn-add-cart"><i class="bi bi-cart-plus"></i> {{ __('site.tpl_ecommerce.products.add_to_cart') }}</button>
                        </div>
                    </div>
                </div>
                <!-- Product 2 -->
                <div class="col-6 col-lg-3">
                    <div class="product-card">
                        <div class="product-image">
                            <span class="product-badge badge-sale">{{ __('site.tpl_ecommerce.products.badge_sale') }}</span>
                            <button class="product-wishlist"><i class="bi bi-heart"></i></button>
                            <img src="https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?w=400&h=400&fit=crop" alt="Samsung S23">
                        </div>
                        <div class="product-body">
                            <span class="product-category">{{ __('site.tpl_ecommerce.nav.smartphones') }}</span>
                            <a href="#" class="product-title">Samsung Galaxy S23 Ultra</a>
                            <div class="product-rating">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <span>(256)</span>
                            </div>
                            <div class="product-price">
                                <span class="price-current">4 799 zł</span>
                                <span class="price-old">5 649 zł</span>
                            </div>
                        </div>
                        <div class="product-footer">
                            <button class="btn-add-cart"><i class="bi bi-cart-plus"></i> {{ __('site.tpl_ecommerce.products.add_to_cart') }}</button>
                        </div>
                    </div>
                </div>
                <!-- Product 3 -->
                <div class="col-6 col-lg-3">
                    <div class="product-card">
                        <div class="product-image">
                            <span class="product-badge badge-hot">{{ __('site.tpl_ecommerce.products.badge_hot') }}</span>
                            <button class="product-wishlist"><i class="bi bi-heart"></i></button>
                            <img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=400&h=400&fit=crop" alt="MacBook Air">
                        </div>
                        <div class="product-body">
                            <span class="product-category">{{ __('site.tpl_ecommerce.nav.laptops') }}</span>
                            <a href="#" class="product-title">Apple MacBook Air M2</a>
                            <div class="product-rating">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star"></i>
                                </div>
                                <span>(89)</span>
                            </div>
                            <div class="product-price">
                                <span class="price-current">5 999 zł</span>
                            </div>
                        </div>
                        <div class="product-footer">
                            <button class="btn-add-cart"><i class="bi bi-cart-plus"></i> {{ __('site.tpl_ecommerce.products.add_to_cart') }}</button>
                        </div>
                    </div>
                </div>
                <!-- Product 4 -->
                <div class="col-6 col-lg-3">
                    <div class="product-card">
                        <div class="product-image">
                            <span class="product-badge badge-sale">-20%</span>
                            <button class="product-wishlist"><i class="bi bi-heart"></i></button>
                            <img src="https://images.unsplash.com/photo-1606144042614-b2417e99c4e3?w=400&h=400&fit=crop" alt="PS5 Controller">
                        </div>
                        <div class="product-body">
                            <span class="product-category">{{ __('site.tpl_ecommerce.nav.gaming') }}</span>
                            <a href="#" class="product-title">Sony DualSense Controller</a>
                            <div class="product-rating">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <span>(312)</span>
                            </div>
                            <div class="product-price">
                                <span class="price-current">279 zł</span>
                                <span class="price-old">349 zł</span>
                            </div>
                        </div>
                        <div class="product-footer">
                            <button class="btn-add-cart"><i class="bi bi-cart-plus"></i> {{ __('site.tpl_ecommerce.products.add_to_cart') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Promo Banner -->
    <section class="section">
        <div class="container">
            <div class="promo-banner">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h3><i class="bi bi-gift me-2"></i> {{ __('site.tpl_ecommerce.promo.title') }}</h3>
                        <p>{{ __('site.tpl_ecommerce.promo.desc') }}</p>
                        <span class="promo-code">WELCOME10</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="newsletter-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h3>{{ __('site.tpl_ecommerce.newsletter.title') }}</h3>
                    <p>{{ __('site.tpl_ecommerce.newsletter.desc') }}</p>
                </div>
                <div class="col-lg-6">
                    <form class="newsletter-form">
                        <input type="email" placeholder="{{ __('site.tpl_ecommerce.newsletter.placeholder') }}">
                        <button type="submit">{{ __('site.tpl_ecommerce.newsletter.btn') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="footer-brand"><i class="bi bi-cpu"></i> {{ __('site.tpl_ecommerce.brand') }}</div>
                    <p class="footer-text">{{ __('site.tpl_ecommerce.footer.desc') }}</p>
                    <div class="footer-social">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <div class="col-6 col-lg-2">
                    <h6 class="footer-title">{{ __('site.tpl_ecommerce.footer.shop') }}</h6>
                    <ul class="footer-links">
                        <li><a href="#">{{ __('site.tpl_ecommerce.nav.smartphones') }}</a></li>
                        <li><a href="#">{{ __('site.tpl_ecommerce.nav.laptops') }}</a></li>
                        <li><a href="#">{{ __('site.tpl_ecommerce.nav.tablets') }}</a></li>
                        <li><a href="#">{{ __('site.tpl_ecommerce.nav.audio') }}</a></li>
                        <li><a href="#">{{ __('site.tpl_ecommerce.nav.gaming') }}</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h6 class="footer-title">{{ __('site.tpl_ecommerce.footer.info') }}</h6>
                    <ul class="footer-links">
                        <li><a href="#">{{ __('site.tpl_ecommerce.footer.about') }}</a></li>
                        <li><a href="#">{{ __('site.tpl_ecommerce.footer.terms') }}</a></li>
                        <li><a href="#">{{ __('site.tpl_ecommerce.footer.privacy') }}</a></li>
                        <li><a href="#">{{ __('site.tpl_ecommerce.footer.shipping') }}</a></li>
                        <li><a href="#">{{ __('site.tpl_ecommerce.footer.returns') }}</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h6 class="footer-title">{{ __('site.tpl_ecommerce.footer.contact') }}</h6>
                    <ul class="footer-links footer-contact">
                        <li>
                            <i class="bi bi-geo-alt"></i>
                            <span>ul. Technologiczna 15<br>00-001 Warszawa</span>
                        </li>
                        <li>
                            <i class="bi bi-telephone"></i>
                            <span>+48 22 123 45 67</span>
                        </li>
                        <li>
                            <i class="bi bi-envelope"></i>
                            <span>kontakt@techstore.pl</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="mb-0">{{ __('site.tpl_ecommerce.footer.copyright') }}</p>
                <div class="payment-icons">
                    <span style="color: var(--gray-light); font-size: 0.85rem;">{{ __('site.tpl_ecommerce.footer.accept') }}</span>
                    <i class="bi bi-credit-card-2-front" style="font-size: 1.5rem; margin-left: 0.5rem;"></i>
                    <i class="bi bi-paypal" style="font-size: 1.5rem; margin-left: 0.5rem;"></i>
                    <i class="bi bi-wallet2" style="font-size: 1.5rem; margin-left: 0.5rem;"></i>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile menu toggle
        document.getElementById('mobileToggle').addEventListener('click', function() {
            document.getElementById('navMenu').classList.toggle('active');
        });
    </script>
</body>
</html>
