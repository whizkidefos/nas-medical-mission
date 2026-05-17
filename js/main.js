/**
 * NAS Medical Mission — main.js
 * All theme interactivity — guaranteed to run after DOM is ready.
 */

(function () {
  'use strict';

  /* ============================================================
     BOOTSTRAP — wait for DOM then run everything
     ============================================================ */
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }

  function boot() {
    initStickyHeader();
    initMobileNav();
    initScrollAnimations();
    initCounters();
    initContactForm();
    initSmoothScroll();
    initSubMenuToggles();
  }


  /* ============================================================
     1. STICKY HEADER
     ============================================================ */
  function initStickyHeader() {
    var header = document.getElementById('site-header');
    if (!header) return;

    var ticking = false;

    function checkScroll() {
      if (!ticking) {
        requestAnimationFrame(function () {
          header.classList.toggle('scrolled', window.scrollY > 40);
          ticking = false;
        });
        ticking = true;
      }
    }

    window.addEventListener('scroll', checkScroll, { passive: true });
    checkScroll();
  }


  /* ============================================================
     2. MOBILE NAV DRAWER
     ============================================================ */
  function initMobileNav() {
    var hamburger = document.getElementById('hamburger-btn');
    var nav       = document.getElementById('mobile-nav');
    var overlay   = document.getElementById('mobile-nav-overlay');
    var closeBtn  = document.getElementById('mobile-nav-close');

    if (!hamburger || !nav || !overlay) {
      console.warn('[NMM] Mobile nav elements missing:', {
        hamburger: !!hamburger, nav: !!nav, overlay: !!overlay
      });
      return;
    }

    function openNav() {
      nav.classList.add('open');
      overlay.classList.add('open');
      hamburger.classList.add('open');
      hamburger.setAttribute('aria-expanded', 'true');
      nav.setAttribute('aria-hidden', 'false');
      document.body.classList.add('nav-open');
      var firstFocusable = nav.querySelector('button, a');
      if (firstFocusable) setTimeout(function () { firstFocusable.focus(); }, 60);
    }

    function closeNav() {
      nav.classList.remove('open');
      overlay.classList.remove('open');
      hamburger.classList.remove('open');
      hamburger.setAttribute('aria-expanded', 'false');
      nav.setAttribute('aria-hidden', 'true');
      document.body.classList.remove('nav-open');
      hamburger.focus();
    }

    hamburger.addEventListener('click', function (e) {
      e.stopPropagation();
      nav.classList.contains('open') ? closeNav() : openNav();
    });

    if (closeBtn) closeBtn.addEventListener('click', closeNav);

    overlay.addEventListener('click', closeNav);

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && nav.classList.contains('open')) closeNav();
    });

    // Close on nav link click
    nav.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', closeNav);
    });
  }


  /* ============================================================
     3. MOBILE SUB-MENU TOGGLES
     ============================================================ */
  function initSubMenuToggles() {
    var toggles = document.querySelectorAll('.mobile-nav__sub-toggle');

    toggles.forEach(function (btn) {
      btn.addEventListener('click', function () {
        var parent = btn.closest('.mobile-nav__has-sub');
        if (!parent) return;

        var isOpen = parent.classList.contains('open');

        // Close all siblings first
        var list = btn.closest('.mobile-nav__list');
        if (list) {
          list.querySelectorAll('.mobile-nav__has-sub.open').forEach(function (sib) {
            if (sib !== parent) {
              sib.classList.remove('open');
              var sibBtn = sib.querySelector('.mobile-nav__sub-toggle');
              if (sibBtn) sibBtn.setAttribute('aria-expanded', 'false');
            }
          });
        }

        if (!isOpen) {
          parent.classList.add('open');
          btn.setAttribute('aria-expanded', 'true');
        } else {
          parent.classList.remove('open');
          btn.setAttribute('aria-expanded', 'false');
        }
      });
    });
  }


  /* ============================================================
     4. SCROLL ANIMATIONS
     ============================================================ */
  function initScrollAnimations() {
    var elements = document.querySelectorAll('.fade-up');
    if (!elements.length) return;

    if (!('IntersectionObserver' in window)) {
      elements.forEach(function (el) { el.classList.add('visible'); });
      return;
    }

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

    elements.forEach(function (el) { observer.observe(el); });
  }


  /* ============================================================
     5. ANIMATED COUNTERS
     ============================================================ */
  function initCounters() {
    var counters = document.querySelectorAll('.impact__number[data-count]');
    if (!counters.length || !('IntersectionObserver' in window)) return;

    function easeOut(t) { return 1 - Math.pow(1 - t, 4); }

    function animateCounter(el) {
      var target   = parseInt(el.getAttribute('data-count'), 10);
      var suffix   = el.textContent.replace(/[\d,]/g, '').trim();
      var duration = 2000;
      var start    = performance.now();

      function step(now) {
        var progress = Math.min((now - start) / duration, 1);
        el.textContent = Math.round(easeOut(progress) * target).toLocaleString() + suffix;
        if (progress < 1) requestAnimationFrame(step);
      }

      requestAnimationFrame(step);
    }

    var obs = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          animateCounter(entry.target);
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });

    counters.forEach(function (el) { obs.observe(el); });
  }


  /* ============================================================
     6. CONTACT FORM — AJAX
     ============================================================ */
  function initContactForm() {
    var form   = document.getElementById('nmm-contact-form');
    var msgBox = document.getElementById('contact-form-msg');
    var submit = document.getElementById('cf-submit');
    if (!form) return;

    form.addEventListener('submit', function (e) {
      e.preventDefault();

      clearErrors(form);
      var valid = true;
      var name    = form.querySelector('[name="name"]');
      var email   = form.querySelector('[name="email"]');
      var message = form.querySelector('[name="message"]');

      if (!name || !name.value.trim())           { fieldError(name,    'Please enter your name.');               valid = false; }
      if (!email || !isValidEmail(email.value))  { fieldError(email,   'Please enter a valid email address.');   valid = false; }
      if (!message || !message.value.trim())     { fieldError(message, 'Please enter a message.');               valid = false; }

      if (!valid) { showMsg(msgBox, 'Please fix the highlighted fields.', 'error'); return; }

      var btnIcon = submit.querySelector('i');
      var btnText = submit.querySelector('span');
      submit.disabled = true;
      if (btnText) btnText.textContent = 'Sending…';
      if (btnIcon) btnIcon.className = 'fas fa-spinner fa-spin';

      var data = new FormData(form);
      data.append('action', 'nmm_contact');
      if (typeof NMM !== 'undefined' && NMM.nonce) data.append('nonce', NMM.nonce);

      var ajaxUrl = (typeof NMM !== 'undefined' && NMM.ajaxUrl) ? NMM.ajaxUrl : '/wp-admin/admin-ajax.php';

      fetch(ajaxUrl, { method: 'POST', body: data })
        .then(function (r) { if (!r.ok) throw new Error('HTTP ' + r.status); return r.json(); })
        .then(function (json) {
          if (json && json.success) {
            showMsg(msgBox, (json.data && json.data.message) || 'Message sent — we\'ll be in touch soon!', 'success');
            form.reset();
          } else {
            showMsg(msgBox, (json && json.data && json.data.message) || 'Something went wrong. Please try again.', 'error');
          }
        })
        .catch(function (err) {
          console.error('[NMM]', err);
          showMsg(msgBox, 'Connection error. Please check your internet and try again.', 'error');
        })
        .finally(function () {
          submit.disabled = false;
          if (btnText) btnText.textContent = 'Send Message';
          if (btnIcon) btnIcon.className = 'fas fa-paper-plane';
        });
    });
  }

  function fieldError(el, msg) {
    if (!el) return;
    el.style.borderColor = 'var(--color-danger, #c53030)';
    var err = document.createElement('span');
    err.className = 'field-error';
    err.style.cssText = 'display:block;font-size:.8rem;color:#c53030;margin-top:.3rem;';
    err.textContent = msg;
    if (el.parentNode) el.parentNode.appendChild(err);
  }

  function clearErrors(form) {
    form.querySelectorAll('.field-error').forEach(function (el) { el.remove(); });
    form.querySelectorAll('input,textarea,select').forEach(function (el) { el.style.borderColor = ''; });
  }

  function showMsg(box, text, type) {
    if (!box) return;
    var ok = type === 'success';
    box.style.cssText = 'display:block;padding:.85rem 1.25rem;border-radius:8px;margin-bottom:1rem;font-size:.9rem;font-weight:600;' +
      (ok ? 'background:rgba(56,161,105,.12);color:#276749;border:1px solid rgba(56,161,105,.3);'
          : 'background:rgba(197,48,48,.08);color:#c53030;border:1px solid rgba(197,48,48,.25);');
    box.textContent = text;
    box.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    if (ok) setTimeout(function () { box.style.display = 'none'; }, 7000);
  }

  function isValidEmail(v) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(String(v).trim());
  }


  /* ============================================================
     7. SMOOTH SCROLL
     ============================================================ */
  function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(function (a) {
      a.addEventListener('click', function (e) {
        var id = this.getAttribute('href').slice(1);
        if (!id) return;
        var target = document.getElementById(id);
        if (!target) return;
        e.preventDefault();
        var h = (document.getElementById('site-header') || {}).offsetHeight || 80;
        window.scrollTo({ top: target.getBoundingClientRect().top + window.scrollY - h - 20, behavior: 'smooth' });
      });
    });
  }

})();
