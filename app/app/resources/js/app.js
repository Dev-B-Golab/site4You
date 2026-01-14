/**
 * SKRYPTY GŁÓWNE STRONY
 * 
 * Plik: resources/js/app.js
 * Kompilacja: npm run build (Vite)
 */

import './bootstrap';

/**
 * Navbar scroll effect
 * Dodaje klasę 'scrolled' do navbara po przewinięciu strony
 */
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('.navbar-custom');
    
    if (navbar) {
        const handleScroll = () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        };

        window.addEventListener('scroll', handleScroll);
        
        // Sprawdź stan przy załadowaniu strony
        handleScroll();
    }
});

/**
 * Active section highlighting
 * Podświetla aktywny link w nawigacji podczas scrollowania
 */
document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link[href^="#"]');
    
    if (sections.length && navLinks.length) {
        const highlightNav = () => {
            const scrollPos = window.scrollY + 100;
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.offsetHeight;
                const sectionId = section.getAttribute('id');
                
                if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
                    navLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href') === '#' + sectionId) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        };

        window.addEventListener('scroll', highlightNav);
        
        // Sprawdź stan przy załadowaniu strony
        highlightNav();
    }
});

/**
 * Smooth scroll for anchor links
 * Płynne przewijanie do sekcji po kliknięciu w link
 */
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            
            if (targetId === '#') return;
            
            const target = document.querySelector(targetId);
            if (target) {
                e.preventDefault();
                
                const navbarHeight = document.querySelector('.navbar-custom')?.offsetHeight || 0;
                const targetPosition = target.offsetTop - navbarHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
                
                // Zamknij mobile menu jeśli otwarty
                const navbarCollapse = document.querySelector('.navbar-collapse');
                if (navbarCollapse?.classList.contains('show')) {
                    const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                    if (bsCollapse) {
                        bsCollapse.hide();
                    }
                }
            }
        });
    });
});

/**
 * Form submission handler
 * Obsługa formularza kontaktowego (placeholder)
 */
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.querySelector('#contact form');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            // Tutaj można dodać własną logikę wysyłania formularza
            // np. AJAX request do backend API
            console.log('Form submitted');
        });
    }
});

/**
 * Protected Contact Links
 * Zamienia tekst kontaktów na klikalne linki
 * Email i telefony są wyświetlane jako tekst, ale po kliknięciu działają
 */
document.addEventListener('DOMContentLoaded', function() {
    // Klikalne emaile
    document.querySelectorAll('.protected-email').forEach(function(el) {
        el.style.cursor = 'pointer';
        el.addEventListener('click', function() {
            const user = this.dataset.user.split('').reverse().join('');
            const domain = this.dataset.domain.split('').reverse().join('');
            window.location.href = 'mailto:' + user + '@' + domain;
        });
    });
    
    // Klikalne telefony
    document.querySelectorAll('.protected-phone').forEach(function(el) {
        el.style.cursor = 'pointer';
        el.addEventListener('click', function() {
            const phone = this.dataset.phone.split('').reverse().join('').replace(/\s/g, '');
            window.location.href = 'tel:' + phone;
        });
    });
});
