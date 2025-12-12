<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('site.tpl_portfolio.title') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --accent: #f97316;
            --accent-light: #fed7aa;
            --dark: #0f172a;
            --darker: #020617;
            --gray: #94a3b8;
            --light: #f1f5f9;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { 
            font-family: 'Space Grotesk', sans-serif; 
            background: var(--darker); 
            color: #e2e8f0;
            overflow-x: hidden;
        }
        
        /* Navbar */
        .navbar-portfolio {
            background: rgba(2, 6, 23, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 1.5rem 0;
            position: fixed;
            width: 100%;
            z-index: 1000;
            transition: all 0.3s ease;
        }
        .navbar-portfolio.scrolled { background: var(--darker); }
        .navbar-portfolio .navbar-brand { 
            font-weight: 700; 
            font-size: 1.75rem; 
            color: white;
            letter-spacing: -1px;
        }
        .navbar-portfolio .navbar-brand span { color: var(--accent); }
        .navbar-portfolio .nav-link { color: var(--gray); font-weight: 500; margin: 0 0.75rem; }
        .navbar-portfolio .nav-link:hover { color: white; }
        .btn-accent { 
            background: var(--accent); 
            color: white; 
            border: none; 
            padding: 0.6rem 1.5rem; 
            border-radius: 50px;
            font-weight: 500;
        }
        .btn-accent:hover { background: #ea580c; color: white; }
        
        /* Hero */
        .hero-portfolio {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: var(--darker);
            position: relative;
            overflow: hidden;
            padding-top: 100px;
        }
        .hero-portfolio::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(249,115,22,0.15) 0%, transparent 70%);
            border-radius: 50%;
        }
        .hero-portfolio h1 { 
            font-size: 4rem; 
            font-weight: 700; 
            line-height: 1.1;
            letter-spacing: -2px;
        }
        .hero-portfolio h1 span { color: var(--accent); }
        .hero-portfolio p { font-size: 1.25rem; color: var(--gray); margin: 1.5rem 0 2rem; }
        .hero-portfolio .social-links a {
            color: var(--gray);
            font-size: 1.5rem;
            margin-right: 1rem;
            transition: color 0.3s ease;
        }
        .hero-portfolio .social-links a:hover { color: var(--accent); }
        
        /* About */
        .about-section { padding: 100px 0; background: var(--dark); }
        .about-section .section-label {
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 3px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .about-section h2 { font-size: 2.5rem; font-weight: 700; margin: 1rem 0; }
        .about-section p { color: var(--gray); line-height: 1.8; }
        .skill-bar {
            background: var(--darker);
            border-radius: 50px;
            height: 8px;
            margin-bottom: 1rem;
            overflow: hidden;
        }
        .skill-bar .progress {
            height: 100%;
            background: linear-gradient(90deg, var(--accent), #fbbf24);
            border-radius: 50px;
        }
        .skill-label { display: flex; justify-content: space-between; margin-bottom: 0.5rem; font-size: 0.9rem; }
        
        /* Portfolio */
        .portfolio-section { padding: 100px 0; background: var(--darker); }
        .section-header { text-align: center; margin-bottom: 4rem; }
        .section-header h2 { font-size: 2.5rem; font-weight: 700; }
        .section-header p { color: var(--gray); }
        .portfolio-item {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 2rem;
        }
        .portfolio-item img { width: 100%; height: 300px; object-fit: cover; transition: transform 0.5s ease; }
        .portfolio-item:hover img { transform: scale(1.1); }
        .portfolio-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, transparent 60%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 2rem;
        }
        .portfolio-overlay h4 { font-weight: 600; margin-bottom: 0.5rem; }
        .portfolio-overlay span { color: var(--accent); font-size: 0.9rem; }
        
        /* Services */
        .services-portfolio { padding: 100px 0; background: var(--dark); }
        .service-box {
            background: var(--darker);
            border: 1px solid #1e293b;
            border-radius: 16px;
            padding: 2.5rem;
            height: 100%;
            transition: all 0.3s ease;
        }
        .service-box:hover { border-color: var(--accent); transform: translateY(-5px); }
        .service-box .icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--accent), #fbbf24);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1.5rem;
        }
        .service-box h4 { font-weight: 600; margin-bottom: 1rem; }
        .service-box p { color: var(--gray); font-size: 0.95rem; }
        .service-box .price { color: var(--accent); font-size: 1.5rem; font-weight: 700; margin-top: 1rem; }
        
        /* Contact */
        .contact-portfolio { padding: 100px 0; background: var(--darker); }
        .contact-box {
            background: linear-gradient(135deg, var(--accent) 0%, #ea580c 100%);
            border-radius: 24px;
            padding: 4rem;
            text-align: center;
        }
        .contact-box h2 { font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem; }
        .contact-box p { font-size: 1.1rem; opacity: 0.9; margin-bottom: 2rem; }
        .btn-white-contact { 
            background: white; 
            color: var(--accent); 
            padding: 1rem 2.5rem; 
            border-radius: 50px; 
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
        }
        .btn-white-contact:hover { background: var(--light); color: var(--accent); }
        
        /* Footer */
        .footer-portfolio {
            background: var(--dark);
            padding: 2rem 0;
            text-align: center;
            border-top: 1px solid #1e293b;
        }
        .footer-portfolio p { color: var(--gray); margin: 0; }
        .footer-portfolio a { color: var(--accent); text-decoration: none; }
        
        @media (max-width: 768px) {
            .hero-portfolio h1 { font-size: 2.5rem; }
            .hero-portfolio { text-align: center; padding-top: 100px; }
            .contact-box { padding: 2rem; }
        }
        
        /* Mobile navbar menu */
        @media (max-width: 991px) {
            .navbar-portfolio {
                background: var(--darker) !important;
            }
            .navbar-portfolio .navbar-collapse {
                background: var(--darker);
                padding: 1rem;
                margin-top: 1rem;
                border-radius: 8px;
            }
            .navbar-portfolio .nav-link {
                padding: 0.75rem 0;
                border-bottom: 1px solid rgba(255,255,255,0.1);
            }
            .navbar-portfolio .btn-accent {
                margin-top: 1rem;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-portfolio">
        <div class="container">
            <a class="navbar-brand" href="#">Jan<span>.</span>Dev</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPortfolio">
                <i class="bi bi-list text-white fs-4"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarPortfolio">
                <ul class="navbar-nav ms-auto me-3">
                    <li class="nav-item"><a class="nav-link" href="#">{{ __('site.tpl_portfolio.nav.home') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">{{ __('site.tpl_portfolio.nav.about') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">{{ __('site.tpl_portfolio.nav.portfolio') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">{{ __('site.tpl_portfolio.nav.services') }}</a></li>
                </ul>
                <a href="#" class="btn btn-accent">{{ __('site.tpl_portfolio.nav.contact') }}</a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero-portfolio">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1>{{ __('site.tpl_portfolio.hero.title_1') }} <span>{{ __('site.tpl_portfolio.hero.title_2') }}</span> {{ __('site.tpl_portfolio.hero.title_3') }}</h1>
                    <p>{{ __('site.tpl_portfolio.hero.desc') }}</p>
                    <a href="#" class="btn btn-accent btn-lg me-3">{{ __('site.tpl_portfolio.hero.btn') }}</a>
                    <div class="social-links d-inline-block ms-3">
                        <a href="#"><i class="bi bi-github"></i></a>
                        <a href="#"><i class="bi bi-dribbble"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About -->
    <section class="about-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="section-label">{{ __('site.tpl_portfolio.about.label') }}</span>
                    <h2>{{ __('site.tpl_portfolio.about.title') }}</h2>
                    <p>{{ __('site.tpl_portfolio.about.text_1') }}</p>
                    <p>{{ __('site.tpl_portfolio.about.text_2') }}</p>
                </div>
                <div class="col-lg-6">
                    <div class="skill-label"><span>React / Next.js</span><span>95%</span></div>
                    <div class="skill-bar"><div class="progress" style="width: 95%"></div></div>
                    
                    <div class="skill-label"><span>UI/UX Design</span><span>90%</span></div>
                    <div class="skill-bar"><div class="progress" style="width: 90%"></div></div>
                    
                    <div class="skill-label"><span>Node.js / PHP</span><span>85%</span></div>
                    <div class="skill-bar"><div class="progress" style="width: 85%"></div></div>
                    
                    <div class="skill-label"><span>WordPress</span><span>80%</span></div>
                    <div class="skill-bar"><div class="progress" style="width: 80%"></div></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio -->
    <section class="portfolio-section">
        <div class="container">
            <div class="section-header">
                <h2>{{ __('site.tpl_portfolio.portfolio.title') }}</h2>
                <p>{{ __('site.tpl_portfolio.portfolio.subtitle') }}</p>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="portfolio-item">
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=500&h=400&fit=crop" alt="Project 1">
                        <div class="portfolio-overlay">
                            <h4>{{ __('site.tpl_portfolio.portfolio.project_1.title') }}</h4>
                            <span>{{ __('site.tpl_portfolio.portfolio.project_1.category') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="portfolio-item">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=500&h=400&fit=crop" alt="Project 2">
                        <div class="portfolio-overlay">
                            <h4>{{ __('site.tpl_portfolio.portfolio.project_2.title') }}</h4>
                            <span>{{ __('site.tpl_portfolio.portfolio.project_2.category') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="portfolio-item">
                        <img src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=500&h=400&fit=crop" alt="Project 3">
                        <div class="portfolio-overlay">
                            <h4>{{ __('site.tpl_portfolio.portfolio.project_3.title') }}</h4>
                            <span>{{ __('site.tpl_portfolio.portfolio.project_3.category') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section class="services-portfolio">
        <div class="container">
            <div class="section-header">
                <h2>{{ __('site.tpl_portfolio.services.title') }}</h2>
                <p>{{ __('site.tpl_portfolio.services.subtitle') }}</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="service-box">
                        <div class="icon"><i class="bi bi-palette"></i></div>
                        <h4>{{ __('site.tpl_portfolio.services.design.title') }}</h4>
                        <p>{{ __('site.tpl_portfolio.services.design.desc') }}</p>
                        <div class="price">{{ __('site.tpl_portfolio.services.design.price') }}</div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="service-box">
                        <div class="icon"><i class="bi bi-code-slash"></i></div>
                        <h4>{{ __('site.tpl_portfolio.services.development.title') }}</h4>
                        <p>{{ __('site.tpl_portfolio.services.development.desc') }}</p>
                        <div class="price">{{ __('site.tpl_portfolio.services.development.price') }}</div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="service-box">
                        <div class="icon"><i class="bi bi-cart3"></i></div>
                        <h4>{{ __('site.tpl_portfolio.services.ecommerce.title') }}</h4>
                        <p>{{ __('site.tpl_portfolio.services.ecommerce.desc') }}</p>
                        <div class="price">{{ __('site.tpl_portfolio.services.ecommerce.price') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section class="contact-portfolio">
        <div class="container">
            <div class="contact-box">
                <h2>{{ __('site.tpl_portfolio.contact.title') }}</h2>
                <p>{{ __('site.tpl_portfolio.contact.desc') }}</p>
                <a href="#" class="btn-white-contact">{{ __('site.tpl_portfolio.contact.btn') }}</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-portfolio">
        <div class="container">
            <p>{{ __('site.tpl_portfolio.footer.copyright') }} <a href="#">{{ __('site.tpl_portfolio.footer.love') }}</a> {{ __('site.tpl_portfolio.footer.country') }}</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
