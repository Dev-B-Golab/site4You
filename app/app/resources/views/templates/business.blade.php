<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('site.tpl_business.title') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --dark: #1e293b;
            --gray: #64748b;
            --light: #f8fafc;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { font-family: 'Inter', sans-serif; color: var(--dark); overflow-x: hidden; }
        
        /* Navbar */
        .navbar-business {
            background: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 1rem 0;
        }
        .navbar-business .navbar-brand { font-weight: 700; font-size: 1.5rem; color: var(--primary); }
        .navbar-business .nav-link { color: var(--dark); font-weight: 500; margin: 0 0.5rem; }
        .navbar-business .nav-link:hover { color: var(--primary); }
        .btn-primary-custom { 
            background: var(--primary); 
            border: none; 
            padding: 0.6rem 1.5rem; 
            border-radius: 8px;
            font-weight: 500;
        }
        .btn-primary-custom:hover { background: var(--primary-dark); }
        
        /* Hero */
        .hero-business {
            background: linear-gradient(135deg, var(--light) 0%, #e0e7ff 100%);
            padding: 100px 0 80px;
        }
        .hero-business h1 { font-size: 3rem; font-weight: 700; line-height: 1.2; }
        .hero-business p { font-size: 1.25rem; color: var(--gray); margin: 1.5rem 0; }
        .hero-img { border-radius: 16px; box-shadow: 0 25px 50px rgba(0,0,0,0.15); }
        
        /* Features */
        .features-section { padding: 80px 0; }
        .feature-card {
            text-align: center;
            padding: 2rem;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        .feature-card:hover { background: var(--light); transform: translateY(-5px); }
        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary), #818cf8);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 1.75rem;
        }
        .feature-card h4 { font-weight: 600; margin-bottom: 0.75rem; }
        .feature-card p { color: var(--gray); font-size: 0.95rem; }
        
        /* Stats */
        .stats-section {
            background: var(--dark);
            padding: 60px 0;
            color: white;
        }
        .stat-item { text-align: center; }
        .stat-number { font-size: 3rem; font-weight: 700; color: var(--primary); }
        .stat-label { color: #94a3b8; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; }
        
        /* Services */
        .services-section { padding: 80px 0; background: var(--light); }
        .section-title { font-size: 2.25rem; font-weight: 700; margin-bottom: 0.5rem; }
        .section-subtitle { color: var(--gray); font-size: 1.1rem; }
        .service-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            height: 100%;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        .service-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .service-card h5 { font-weight: 600; margin: 1rem 0 0.5rem; }
        .service-card p { color: var(--gray); font-size: 0.9rem; }
        
        /* CTA */
        .cta-section {
            padding: 80px 0;
            background: linear-gradient(135deg, var(--primary) 0%, #7c3aed 100%);
            color: white;
            text-align: center;
        }
        .cta-section h2 { font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem; }
        .cta-section p { font-size: 1.1rem; opacity: 0.9; margin-bottom: 2rem; }
        .btn-white { 
            background: white; 
            color: var(--primary); 
            padding: 0.8rem 2rem; 
            border-radius: 8px; 
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
        }
        .btn-white:hover { background: var(--light); color: var(--primary-dark); }
        
        /* Footer */
        .footer-business {
            background: var(--dark);
            color: #94a3b8;
            padding: 60px 0 30px;
        }
        .footer-brand { font-size: 1.5rem; font-weight: 700; color: white; }
        .footer-text { font-size: 0.9rem; margin-top: 1rem; }
        .footer-title { color: white; font-weight: 600; margin-bottom: 1.5rem; }
        .footer-links { list-style: none; padding: 0; }
        .footer-links li { margin-bottom: 0.75rem; }
        .footer-links a { color: #94a3b8; text-decoration: none; }
        .footer-links a:hover { color: white; }
        .footer-bottom { border-top: 1px solid #334155; margin-top: 3rem; padding-top: 1.5rem; text-align: center; }
        
        @media (max-width: 768px) {
            .hero-business h1 { font-size: 2rem; }
            .hero-business { padding: 100px 0 40px; }
            .stat-number { font-size: 2rem; }
        }
        
        /* Mobile navbar menu */
        @media (max-width: 991px) {
            .navbar-business .navbar-collapse {
                background: white;
                padding: 1rem;
                margin-top: 0.5rem;
                border-radius: 8px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            }
            .navbar-business .nav-link {
                padding: 0.75rem 0;
                border-bottom: 1px solid rgba(0,0,0,0.1);
            }
            .navbar-business .btn-primary-custom {
                margin-top: 1rem;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-business fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">{{ __('site.tpl_business.brand') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarBusiness">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarBusiness">
                <ul class="navbar-nav ms-auto me-3">
                    <li class="nav-item"><a class="nav-link" href="#">{{ __('site.tpl_business.nav.home') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">{{ __('site.tpl_business.nav.about') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">{{ __('site.tpl_business.nav.services') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">{{ __('site.tpl_business.nav.contact') }}</a></li>
                </ul>
                <a href="#" class="btn btn-primary-custom text-white">{{ __('site.tpl_business.cta_btn') }}</a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero-business">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1>{{ __('site.tpl_business.hero.title') }}</h1>
                    <p>{{ __('site.tpl_business.hero.desc') }}</p>
                    <a href="#" class="btn btn-primary-custom btn-lg text-white me-3">{{ __('site.tpl_business.hero.btn_primary') }}</a>
                    <a href="#" class="btn btn-outline-dark btn-lg">{{ __('site.tpl_business.hero.btn_secondary') }}</a>
                </div>
                <div class="col-lg-6 mt-4 mt-lg-0">
                    <img src="https://images.unsplash.com/photo-1553028826-f4804a6dba3b?w=600&h=400&fit=crop" alt="Business" class="img-fluid hero-img">
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="features-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="bi bi-graph-up-arrow"></i></div>
                        <h4>{{ __('site.tpl_business.features.growth.title') }}</h4>
                        <p>{{ __('site.tpl_business.features.growth.desc') }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="bi bi-people"></i></div>
                        <h4>{{ __('site.tpl_business.features.team.title') }}</h4>
                        <p>{{ __('site.tpl_business.features.team.desc') }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon"><i class="bi bi-shield-check"></i></div>
                        <h4>{{ __('site.tpl_business.features.audit.title') }}</h4>
                        <p>{{ __('site.tpl_business.features.audit.desc') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="stats-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">250+</div>
                        <div class="stat-label">{{ __('site.tpl_business.stats.clients') }}</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">15</div>
                        <div class="stat-label">{{ __('site.tpl_business.stats.years') }}</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">98%</div>
                        <div class="stat-label">{{ __('site.tpl_business.stats.satisfaction') }}</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-item">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">{{ __('site.tpl_business.stats.projects') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section class="services-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">{{ __('site.tpl_business.services.title') }}</h2>
                <p class="section-subtitle">{{ __('site.tpl_business.services.subtitle') }}</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <i class="bi bi-briefcase fs-2 text-primary"></i>
                        <h5>{{ __('site.tpl_business.services.strategic.title') }}</h5>
                        <p>{{ __('site.tpl_business.services.strategic.desc') }}</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <i class="bi bi-cash-stack fs-2 text-primary"></i>
                        <h5>{{ __('site.tpl_business.services.financial.title') }}</h5>
                        <p>{{ __('site.tpl_business.services.financial.desc') }}</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <i class="bi bi-diagram-3 fs-2 text-primary"></i>
                        <h5>{{ __('site.tpl_business.services.digital.title') }}</h5>
                        <p>{{ __('site.tpl_business.services.digital.desc') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section">
        <div class="container">
            <h2>{{ __('site.tpl_business.cta.title') }}</h2>
            <p>{{ __('site.tpl_business.cta.desc') }}</p>
            <a href="#" class="btn-white">{{ __('site.tpl_business.cta.btn') }}</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-business">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="footer-brand">{{ __('site.tpl_business.brand') }}</div>
                    <p class="footer-text">{{ __('site.tpl_business.footer.desc') }}</p>
                </div>
                <div class="col-6 col-lg-2">
                    <h6 class="footer-title">{{ __('site.tpl_business.footer.company') }}</h6>
                    <ul class="footer-links">
                        <li><a href="#">{{ __('site.tpl_business.footer.about') }}</a></li>
                        <li><a href="#">{{ __('site.tpl_business.footer.team') }}</a></li>
                        <li><a href="#">{{ __('site.tpl_business.footer.career') }}</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h6 class="footer-title">{{ __('site.tpl_business.footer.services') }}</h6>
                    <ul class="footer-links">
                        <li><a href="#">{{ __('site.tpl_business.footer.consulting') }}</a></li>
                        <li><a href="#">{{ __('site.tpl_business.footer.training') }}</a></li>
                        <li><a href="#">{{ __('site.tpl_business.footer.audit') }}</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h6 class="footer-title">{{ __('site.tpl_business.footer.contact') }}</h6>
                    <ul class="footer-links">
                        <li><i class="bi bi-geo-alt me-2"></i>ul. Biznesowa 123, Warszawa</li>
                        <li><i class="bi bi-telephone me-2"></i>+48 123 456 789</li>
                        <li><i class="bi bi-envelope me-2"></i>kontakt@konsultacjeonline.pl</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="mb-0">{{ __('site.tpl_business.footer.copyright') }}</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
