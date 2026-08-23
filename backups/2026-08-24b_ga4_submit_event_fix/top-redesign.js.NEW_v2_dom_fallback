(function () {
    'use strict';

    // Sticky header compact-on-scroll (site-wide).
    var siteHeader = document.querySelector('.header');
    if (siteHeader) {
        var applyScrollState = function () {
            if (window.scrollY > 40) {
                siteHeader.classList.add('jpf-scrolled');
            } else {
                siteHeader.classList.remove('jpf-scrolled');
            }
        };
        applyScrollState();
        window.addEventListener('scroll', applyScrollState, { passive: true });
    }

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

    // Snow Monkey Forms: quote_form_start tracking (unchanged — still wrapped
    // via pushEvent()/jpf_cta_click, matching the site's other CTA events).
    var smfForms = document.querySelectorAll('.smf-form');
    smfForms.forEach(function (form) {
        var started = false;
        form.addEventListener('input', function () {
            if (!started) {
                started = true;
                pushEvent('quote_form_start');
            }
        });
    });

    // GA4/GTM completion events: quote_form_submit (/quote/) and
    // slowth_form_submit (/slowth-contact/).
    //
    // Verified against the actual production DOM: the real <form> element is
    // NOT .smf-form (that's an inner content wrapper Snow Monkey Forms
    // replaces on every step) — it's the outer element rendered by the
    // plugin as:
    //   <form class="snow-monkey-form" id="snow-monkey-form-3473" ... data-screen="input">
    // (3473 = quote, 3514 = SlowTH). The plugin's submit.js sets
    // data-screen to the response "method" on every step (input/back/
    // confirm/invalid/complete/systemerror) and, only for 'complete',
    // dispatches a CustomEvent('smf.complete') on that same <form> element.
    // The previous attempt listened on .smf-form (a descendant of this
    // <form>), so it could never receive an event dispatched on its own
    // ancestor — events only bubble upward from the dispatch target, never
    // down to children. That mismatch, not GTM, was why nothing fired.
    //
    // Two independent detections are wired to the same guarded handler:
    //   1) smf.complete on the correct <form> element (primary).
    //   2) A MutationObserver watching only that same <form>'s own
    //      data-screen attribute for the literal value "complete" (fallback,
    //      in case smf.complete itself doesn't fire for any other reason).
    // Both are scoped to a single specific form element and a single
    // attribute — not a broad "complete" text search anywhere on the page —
    // so neither can misfire on unrelated content. Whichever detects first
    // wins; a data-jpf-complete-tracked flag on the form guarantees exactly
    // one dataLayer.push per real submission, and neither path can trigger
    // on page load, on the input->confirm step, or on a validation error
    // (data-screen is "confirm"/"invalid" there, not "complete").
    //
    // Pushes are intentionally top-level custom events
    // ({ event: 'quote_form_submit' }), not wrapped in pushEvent()'s
    // jpf_cta_click envelope, because the GA4 Event tags in GTM are wired to
    // GTM's Custom Event trigger, which matches the literal `event` value.
    // No form field values (email/name/company/phone/etc.) are included.
    //
    // Temporary debug console.log calls are included below at the user's
    // request, to confirm in a real browser which detection path fired.
    var smfCompleteEventByFormId = {
        3473: 'quote_form_submit',
        3514: 'slowth_form_submit'
    };
    var smfCompleteLogLabel = {
        3473: 'JPF GA4: quote complete detected',
        3514: 'JPF GA4: slowth complete detected'
    };

    var snowMonkeyForms = document.querySelectorAll('form.snow-monkey-form');
    snowMonkeyForms.forEach(function (form) {
        var match = /snow-monkey-form-(\d+)/.exec(form.id || '');
        var formId = match ? parseInt(match[1], 10) : null;
        var eventName = formId ? smfCompleteEventByFormId[formId] : null;

        if (!eventName) {
            return;
        }

        var handleComplete = function () {
            if (form.dataset.jpfCompleteTracked === '1') {
                return;
            }
            form.dataset.jpfCompleteTracked = '1';

            if (window.console && console.log) {
                console.log(smfCompleteLogLabel[formId]);
            }

            window.dataLayer.push({ event: eventName });

            if (window.console && console.log) {
                console.log('JPF GA4: dataLayer pushed', eventName);
            }

            if (observer) {
                observer.disconnect();
            }
        };

        // Primary: the plugin's own completion event, on the correct element.
        form.addEventListener('smf.complete', handleComplete);

        // Fallback: watch this one form's data-screen attribute directly.
        var observer = null;
        if ('MutationObserver' in window) {
            observer = new MutationObserver(function () {
                if (form.getAttribute('data-screen') === 'complete') {
                    handleComplete();
                }
            });
            observer.observe(form, { attributes: true, attributeFilter: ['data-screen'] });
        }
    });
})();
