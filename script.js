document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('menuToggle');
    const siteNav = document.getElementById('siteNav');
    const revealTargets = document.querySelectorAll('.reveal');

    if (document.querySelector('main#top')) {
        document.body.classList.add('is-top-page');
    }

    if (menuToggle && siteNav) {
        menuToggle.addEventListener('click', function () {
            const isOpen = siteNav.classList.toggle('is-open');
            menuToggle.setAttribute('aria-expanded', String(isOpen));
        });
    }

    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach(function (link) {
        link.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (!targetId || targetId === '#') {
                return;
            }

            const targetElement = document.querySelector(targetId);
            if (!targetElement) {
                return;
            }

            e.preventDefault();

            const headerOffset = 88;
            const targetPosition = targetElement.getBoundingClientRect().top + window.scrollY - headerOffset;
            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });

            if (siteNav) {
                siteNav.classList.remove('is-open');
            }
            if (menuToggle) {
                menuToggle.setAttribute('aria-expanded', 'false');
            }
        });
    });

    if ('IntersectionObserver' in window && revealTargets.length > 0) {
        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.16 });

        revealTargets.forEach(function (target) {
            observer.observe(target);
        });
    } else {
        revealTargets.forEach(function (target) {
            target.classList.add('is-visible');
        });
    }
});