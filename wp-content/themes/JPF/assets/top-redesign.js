(function () {
    'use strict';

    // Sticky header compact-on-scroll (site-wide).
    var siteHeader = document.querySelector('.header');
    if (siteHeader) {
        // Publish the header's real rendered height as a CSS var so other
        // sticky elements (e.g. the top-page quick-nav) can offset below it
        // instead of being hidden underneath the now-permanent sticky header.
        var updateHeaderHeightVar = function () {
            document.documentElement.style.setProperty('--jpf-header-height', siteHeader.offsetHeight + 'px');
        };

        var applyScrollState = function () {
            if (window.scrollY > 40) {
                siteHeader.classList.add('jpf-scrolled');
            } else {
                siteHeader.classList.remove('jpf-scrolled');
            }
            updateHeaderHeightVar();
        };
        applyScrollState();
        window.addEventListener('scroll', applyScrollState, { passive: true });
        window.addEventListener('resize', updateHeaderHeightVar, { passive: true });
    }

    // Reveal-on-scroll for .reveal sections (progressive enhancement only).
    // .jpf-en-reveal is the English global site's own reveal class (kept
    // separate from .reveal so its CSS stays fully scoped under
    // .jpf-en-home instead of reusing body.page-id-3435 .reveal rules).
    var revealEls = document.querySelectorAll('.reveal, .jpf-en-reveal');
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

    // English RFQ form (post 3566) only: client-side file-size guard.
    // Snow Monkey Forms has no built-in max-file-size option and attaches
    // the uploaded drawing directly to the admin notification email — an
    // oversized attachment can cause that email to silently bounce, so the
    // JPF team would never see the RFQ. Scoped narrowly to
    // #snow-monkey-form-3566's own file input (not site-wide .smf-form)
    // specifically so this cannot change the JP quote form's behavior.
    var rfqFileInput = document.querySelector('#snow-monkey-form-3566 input[type="file"]');
    if (rfqFileInput) {
        var RFQ_MAX_FILE_BYTES = 20 * 1024 * 1024; // 20MB, matches the form's own field description.
        rfqFileInput.addEventListener('change', function () {
            var file = rfqFileInput.files && rfqFileInput.files[0];
            if (file && file.size > RFQ_MAX_FILE_BYTES) {
                window.alert('This file is larger than 20MB. Please compress it or split it into a ZIP under 20MB, or contact us directly with a file-sharing link.');
                rfqFileInput.value = '';
            }
        });
    }

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
