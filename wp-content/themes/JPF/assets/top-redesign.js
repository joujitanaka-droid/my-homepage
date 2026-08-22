(function () {
    'use strict';

    // Reveal-on-scroll for .reveal sections (progressive enhancement only).
    var revealEls = document.querySelectorAll('.reveal');
    if (revealEls.length) {
        if ('IntersectionObserver' in window) {
            revealEls.forEach(function (el) {
                el.classList.add('jpf-reveal-pending');
            });

            var io = new IntersectionObserver(
                function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.remove('jpf-reveal-pending');
                            entry.target.classList.add('jpf-reveal-in');
                            io.unobserve(entry.target);
                        }
                    });
                },
                { rootMargin: '0px 0px -8% 0px', threshold: 0.05 }
            );

            revealEls.forEach(function (el) {
                io.observe(el);
            });
        }
    }

    // dataLayer helper (safe no-op if GTM/GA is not installed yet).
    window.dataLayer = window.dataLayer || [];
    function pushEvent(eventName, extra) {
        var payload = Object.assign({ event: 'jpf_cta_click', jpf_event_name: eventName }, extra || {});
        window.dataLayer.push(payload);
    }

    // CTA click tracking (header_quote_click / hero_quote_click / case_study_click / equipment_click / slowth_click / company_click).
    document.querySelectorAll('[data-gtm-event]').forEach(function (el) {
        el.addEventListener('click', function () {
            pushEvent(el.getAttribute('data-gtm-event'));
        });
    });

    // Sticky quote CTA (site-wide) click tracking.
    var stickyCta = document.querySelector('.jpf-sticky-quote-cta');
    if (stickyCta) {
        stickyCta.addEventListener('click', function () {
            pushEvent('header_quote_click');
        });
    }

    // tel: / mailto: click tracking (site-wide).
    document.querySelectorAll('a[href^="tel:"]').forEach(function (el) {
        el.addEventListener('click', function () {
            pushEvent('phone_click');
        });
    });
    document.querySelectorAll('a[href^="mailto:"]').forEach(function (el) {
        el.addEventListener('click', function () {
            pushEvent('mail_click');
        });
    });

    // Snow Monkey Forms: quote_form_start / quote_form_submit tracking only.
    // NOTE: submit-button disabling is intentionally NOT implemented here — Snow Monkey
    // Forms drives its own input -> confirm -> complete steps through submit events, and a
    // generic disable-on-submit guard risks blocking the plugin's own step transitions.
    // Its built-in confirm-page step already requires a deliberate second action before send.
    var smfForms = document.querySelectorAll('.smf-form');
    smfForms.forEach(function (form) {
        var started = false;
        form.addEventListener('input', function () {
            if (!started) {
                started = true;
                pushEvent('quote_form_start');
            }
        });

        form.addEventListener('submit', function () {
            pushEvent('quote_form_submit');
        });
    });
})();
