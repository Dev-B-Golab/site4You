/**
 * SKRYPTY GŁÓWNE STRONY
 * Plik: public/js/app.js
 */

// AOS initialization
document.addEventListener('DOMContentLoaded', function() {
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });
    }
});

// Navbar scroll effect
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('.navbar-custom');
    
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }
});

// Active section highlighting
document.addEventListener('DOMContentLoaded', function() {
    // Nie uruchamiaj na podstronach usług
    if (window.location.pathname.indexOf('/uslugi/') !== -1) {
        return;
    }
    
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.navbar-nav > .nav-item > .nav-link');
    
    if (sections.length && navLinks.length) {
        const highlightNav = function() {
            const scrollPos = window.scrollY + 150;
            let currentSection = null;
            
            // Znajdź aktualną sekcję
            sections.forEach(function(section) {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.offsetHeight;
                
                if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
                    currentSection = section.getAttribute('id');
                }
            });
            
            // Usuń active ze wszystkich
            navLinks.forEach(function(link) {
                link.classList.remove('active');
            });
            
            // Podświetl odpowiedni link
            if (currentSection) {
                navLinks.forEach(function(link) {
                    const dataScroll = link.getAttribute('data-scroll') || '';
                    const linkText = link.textContent.trim();
                    
                    // Mapowanie sekcji na data-scroll
                    if (dataScroll === currentSection) {
                        link.classList.add('active');
                    }
                    // Dla sekcji services i process - podświetl dropdown Usługi
                    else if ((currentSection === 'services' || currentSection === 'process') && (linkText.indexOf('Usługi') !== -1 || linkText.indexOf('Services') !== -1)) {
                        link.classList.add('active');
                    }
                    // Dla sekcji intro - podświetl Home/Start
                    else if (currentSection === 'intro' && dataScroll === 'intro') {
                        link.classList.add('active');
                    }
                });
            }
        };
        
        window.addEventListener('scroll', highlightNav);
        // Uruchom przy załadowaniu strony
        setTimeout(highlightNav, 100);
    }
});

// PureCounter initialization
document.addEventListener('DOMContentLoaded', function() {
    if (typeof PureCounter !== 'undefined') {
        new PureCounter();
    }
});

// Smooth scroll for anchor links
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const target = document.querySelector(targetId);
            if (target) {
                e.preventDefault();
                const navbarHeight = document.querySelector('.navbar-custom').offsetHeight || 0;
                const targetPosition = target.offsetTop - navbarHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
                
                // Zamknij mobile menu
                const navbarCollapse = document.querySelector('.navbar-collapse');
                if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                    const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                    if (bsCollapse) bsCollapse.hide();
                }
            }
        });
    });
});

// Scroll bez kotwicy w URL (data-scroll)
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('a[data-scroll]').forEach(function(link) {
        link.addEventListener('click', function(e) {
            const sectionId = this.getAttribute('data-scroll');
            const target = document.getElementById(sectionId);
            
            // Jeśli jesteśmy na tej samej stronie
            if (target) {
                e.preventDefault();
                const navbarHeight = document.querySelector('.navbar-custom').offsetHeight || 0;
                const targetPosition = target.offsetTop - navbarHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
                
                // Aktualizuj URL bez hash (opcjonalnie)
                history.replaceState(null, null, window.location.pathname);
            } else {
                // Jeśli jesteśmy na innej stronie, zapisz sekcję i przekieruj
                sessionStorage.setItem('scrollToSection', sectionId);
            }
        });
    });
    
    // Sprawdź czy trzeba scrollować po załadowaniu strony
    const scrollTo = sessionStorage.getItem('scrollToSection');
    if (scrollTo) {
        sessionStorage.removeItem('scrollToSection');
        const target = document.getElementById(scrollTo);
        if (target) {
            setTimeout(function() {
                const navbarHeight = document.querySelector('.navbar-custom').offsetHeight || 0;
                const targetPosition = target.offsetTop - navbarHeight;
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }, 100);
        }
    }
});
