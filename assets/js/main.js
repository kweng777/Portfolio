/**
 * Dev Portfolio - Main JS
 */

document.addEventListener('DOMContentLoaded', () => {

    // ─── Mobile Nav Toggle ──────────────────────────────────────────
    const toggle = document.getElementById('nav-toggle');
    const nav    = document.getElementById('site-nav');

    if (toggle && nav) {
        toggle.addEventListener('click', () => {
            toggle.classList.toggle('active');
            nav.classList.toggle('open');
        });
    }

    // ─── Sticky Header ──────────────────────────────────────────────
    const header = document.getElementById('site-header');
    if (header) {
        window.addEventListener('scroll', () => {
            header.classList.toggle('scrolled', window.scrollY > 50);
        });
    }

    // ─── Scroll Reveal Animation ────────────────────────────────────
    const reveals = document.querySelectorAll(
        '.work-card, .skill-card, .cert-card, .about-grid, .contact-grid, .section__title'
    );

    if (reveals.length && 'IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        reveals.forEach(el => observer.observe(el));
    }

    // ─── Skill Bar Animation ────────────────────────────────────────
    const bars = document.querySelectorAll('.skill-card__fill');
    if (bars.length && 'IntersectionObserver' in window) {
        const barObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const pct = entry.target.getAttribute('data-percent');
                    entry.target.style.width = pct + '%';
                    barObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });

        bars.forEach(bar => {
            bar.style.width = '0%';
            barObserver.observe(bar);
        });
    }

    // ─── Works Filter (Archive page) ────────────────────────────────
    const filterBtns = document.querySelectorAll('.filter-btn');
    if (filterBtns.length) {
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const filter = btn.getAttribute('data-filter');
                const cards  = document.querySelectorAll('.work-card');

                cards.forEach(card => {
                    if (filter === '*') {
                        card.style.display = '';
                    } else {
                        const cat = card.querySelector('.work-card__category');
                        const catText = cat ? cat.textContent.toLowerCase().replace(/\s+/g, '-') : '';
                        card.style.display = catText.includes(filter) ? '' : 'none';
                    }
                });
            });
        });
    }

    // ─── Smooth scroll for anchor links ─────────────────────────────
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
            const target = document.querySelector(anchor.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                // Close mobile nav if open
                if (nav) nav.classList.remove('open');
                if (toggle) toggle.classList.remove('active');
            }
        });
    });

    // ─── Sync sidebar nav menu and right icon bar active states ─────
    function syncActiveStates(href, source) {
        // Remove active class from ALL sidebar nav menu items across all sections
        document.querySelectorAll('.sidebar-nav-menu a').forEach(link => {
            link.classList.remove('active');
        });

        // Remove active class from ALL right icon bar items across all sections
        document.querySelectorAll('.work-nav-icons a').forEach(icon => {
            icon.classList.remove('active');
        });

        // Remove active class from ALL circular nav icons
        document.querySelectorAll('.nav-icons a').forEach(icon => {
            icon.classList.remove('active');
        });

        // Special handling for #about based on source
        if (href === '#about') {
            if (source === 'circular-nav') {
                // Only highlight circular nav icon
                document.querySelectorAll(`.nav-icons a[href="${href}"]`).forEach(icon => {
                    icon.classList.add('active');
                });
            } else if (source === 'sidebar-nav') {
                // Only highlight circular nav icon
                document.querySelectorAll(`.nav-icons a[href="${href}"]`).forEach(icon => {
                    icon.classList.add('active');
                });
            }
            // If source is 'right-icon-bar' or 'work-section', don't highlight anything
        } else {
            // For all other sections, highlight all matching elements
            document.querySelectorAll(`.sidebar-nav-menu a[href="${href}"]`).forEach(link => {
                link.classList.add('active');
            });

            document.querySelectorAll(`.work-nav-icons a[href="${href}"]`).forEach(icon => {
                icon.classList.add('active');
            });

            document.querySelectorAll(`.nav-icons a[href="${href}"]`).forEach(icon => {
                icon.classList.add('active');
            });
        }
    }

    // Handle circular nav clicks
    document.querySelectorAll('.nav-icons a').forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            syncActiveStates(href, 'circular-nav');
        });
    });

    // Handle sidebar nav menu clicks
    document.querySelectorAll('.sidebar-nav-menu a').forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            syncActiveStates(href, 'sidebar-nav');
        });
    });

    // Handle right icon bar clicks
    document.querySelectorAll('.work-nav-icons a').forEach(icon => {
        icon.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            syncActiveStates(href, 'right-icon-bar');
        });
    });

    // Set initial active state based on current URL hash or default to first item
    function setInitialActiveState() {
        // Check if we're on the about page
        const isAboutPage = window.location.pathname.includes('/about');

        if (isAboutPage && !window.location.hash) {
            // On about page without hash, preserve the hardcoded active classes
            // Don't run syncActiveStates to avoid removing the active classes
            return;
        }

        const currentHash = window.location.hash || '#about';
        syncActiveStates(currentHash, 'sidebar-nav');
    }

    setInitialActiveState();

    // Update active state on hash change
    window.addEventListener('hashchange', () => {
        setInitialActiveState();
    });

    // ─── Scroll Spy - Auto-highlight nav based on scroll position ─────
    function initScrollSpy() {
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.sidebar-nav-menu a, .work-nav-icons a, .nav-icons a');

        if (sections.length === 0 || navLinks.length === 0) return;

        function updateActiveNav() {
            let currentSection = '';
            const scrollPosition = window.scrollY + 100; // Offset for better detection

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.offsetHeight;
                const sectionId = section.getAttribute('id');

                if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                    currentSection = '#' + sectionId;
                }
            });

            // If no section is in view (e.g., at very top), default to #about
            if (!currentSection && window.scrollY < 100) {
                currentSection = '#about';
            }

            // Update active states for all nav elements
            if (currentSection) {
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === currentSection) {
                        link.classList.add('active');
                    }
                });
            }
        }

        // Use scroll event with throttle for performance
        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    updateActiveNav();
                    ticking = false;
                });
                ticking = true;
            }
        });

        // Initial check
        updateActiveNav();
    }

    initScrollSpy();

    // ─── Projects Carousel (Front Page) ─────────────────────────────
    const carousel = document.querySelector('.projects-carousel');
    if (carousel) {
        const grid = carousel.querySelector('.projects-grid');
        const cards = Array.from(grid.querySelectorAll('.project-card'));
        const prevBtn = carousel.querySelector('.carousel-arrow.prev');
        const nextBtn = carousel.querySelector('.carousel-arrow.next');
        const dotsContainer = carousel.querySelector('.carousel-dots');

        if (cards.length) {
            let index = Math.floor(cards.length/2); // start with center card if possible

            // create dots
            cards.forEach((c, i) => {
                const d = document.createElement('button');
                d.addEventListener('click', () => { index = i; update(); });
                dotsContainer.appendChild(d);
            });

            function clamp(n) {
                if (n < 0) return cards.length - 1;
                if (n >= cards.length) return 0;
                return n;
            }

            function update() {
                cards.forEach((card, i) => {
                    card.className = 'project-card'; // reset
                    const dot = dotsContainer.children[i];
                    dot.classList.toggle('active', i === index);

                    const offset = i - index;
                    if (offset === 0) card.classList.add('center');
                    else if (offset === -1 || (index === 0 && i === cards.length-1)) card.classList.add('left');
                    else if (offset === 1 || (index === cards.length-1 && i === 0)) card.classList.add('right');
                    else if (offset < 0) card.classList.add('back-left');
                    else if (offset > 0) card.classList.add('back-right');
                });
            }

            prevBtn.addEventListener('click', () => { index = clamp(index - 1); update(); });
            nextBtn.addEventListener('click', () => { index = clamp(index + 1); update(); });

            // keyboard support
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') prevBtn.click();
                if (e.key === 'ArrowRight') nextBtn.click();
            });

            update();
        }
    }
});
