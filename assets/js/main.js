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
