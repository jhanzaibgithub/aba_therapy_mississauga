document.addEventListener('DOMContentLoaded', function () {
  'use strict';

  // 0. Premium Therapy Animated Page Preloader Controller
  const preloader = document.getElementById('site-preloader');
  if (preloader && !preloader.classList.contains('is-loaded')) {
    setTimeout(function () {
      preloader.classList.add('is-loaded');
      document.body.classList.add('page-is-loaded');
      setTimeout(function () {
        if (preloader.parentNode) {
          preloader.style.display = 'none';
        }
      }, 550);
    }, 350);
  }

  // 1. Top Scroll Progress Bar
  const progressBar = document.getElementById('scroll-progress');
  function updateScrollProgress() {
    if (!progressBar) return;
    const scrollTop = window.scrollY || document.documentElement.scrollTop;
    const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    const scrollPercent = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
    progressBar.style.width = scrollPercent.toFixed(2) + '%';
  }
  window.addEventListener('scroll', updateScrollProgress, { passive: true });
  updateScrollProgress();

  // 2. Sticky Header Shrink Controller
  const siteHeader = document.querySelector('.site-header');
  function updateHeaderState() {
    if (!siteHeader) return;
    if (window.scrollY > 40) {
      siteHeader.classList.add('is-scrolled');
    } else {
      siteHeader.classList.remove('is-scrolled');
    }
  }
  window.addEventListener('scroll', updateHeaderState, { passive: true });
  updateHeaderState();

  // 3. Advanced Directional Intersection Observer Reveal Engine
  const revealElements = document.querySelectorAll(
    '.reveal-fade-up, .reveal-slide-left, .reveal-slide-right, .reveal-scale, .reveal-fade-in, .process-line'
  );

  if ('IntersectionObserver' in window) {
    const observerOptions = {
      root: null,
      rootMargin: '0px 0px -40px 0px',
      threshold: 0.1
    };

    const revealObserver = new IntersectionObserver(function (entries, observer) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-revealed');
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);

    revealElements.forEach(function (el) {
      revealObserver.observe(el);
    });
  } else {
    revealElements.forEach(function (el) {
      el.classList.add('is-revealed');
    });
  }

  // 4. Initial Page Load Reveal Sequence for Hero Section
  setTimeout(function () {
    const heroReveals = document.querySelectorAll(
      '.hero .reveal-slide-left, .hero .reveal-slide-right, .hero .reveal-scale, .page-hero .reveal-fade-up, .page-hero .reveal-fade-in'
    );
    heroReveals.forEach(function (el) {
      el.classList.add('is-revealed');
    });
  }, 100);

  // 5. 3D Tilt Hover Motion & Spotlight Tracking for All Interactive Cards
  const interactiveCards = document.querySelectorAll(
    '.resource-card, .service-card, .value-card, .benefit-card, .funding-card, .consult-card, .who-card'
  );
  interactiveCards.forEach(function (card) {
    card.addEventListener('mousemove', function (e) {
      const rect = card.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;
      const centerX = rect.width / 2;
      const centerY = rect.height / 2;
      const rotateX = ((y - centerY) / centerY) * -5;
      const rotateY = ((x - centerX) / centerX) * 5;

      card.style.setProperty('--mouse-x', x.toFixed(1) + 'px');
      card.style.setProperty('--mouse-y', y.toFixed(1) + 'px');
      card.style.transform = 'perspective(1000px) rotateX(' + rotateX.toFixed(2) + 'deg) rotateY(' + rotateY.toFixed(2) + 'deg) translate3d(0, -6px, 0)';
    });

    card.addEventListener('mouseleave', function () {
      card.style.transform = '';
    });
  });

  // 6. Interactive FAQ Accordion Logic (Shared across all pages)
  const faqButtons = document.querySelectorAll('.faq-item button');
  faqButtons.forEach(function (button) {
    button.addEventListener('click', function () {
      const isExpanded = this.getAttribute('aria-expanded') === 'true';
      const panelId = this.getAttribute('aria-controls');
      const panel = document.getElementById(panelId);

      this.setAttribute('aria-expanded', !isExpanded);
      if (panel) {
        if (isExpanded) {
          panel.setAttribute('hidden', '');
        } else {
          panel.removeAttribute('hidden');
        }
      }
    });
  });

  // 7. Mobile Navigation Toggle Logic
  const menuToggle = document.querySelector('.menu-toggle');
  const siteNav = document.querySelector('.site-nav');
  if (menuToggle && siteNav) {
    menuToggle.addEventListener('click', function () {
      const isOpen = siteNav.classList.contains('is-open');
      siteNav.classList.toggle('is-open', !isOpen);
      menuToggle.setAttribute('aria-expanded', !isOpen);
    });

    const navLinks = siteNav.querySelectorAll('a');
    navLinks.forEach(function (link) {
      link.addEventListener('click', function () {
        siteNav.classList.remove('is-open');
        menuToggle.setAttribute('aria-expanded', 'false');
      });
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && siteNav.classList.contains('is-open')) {
        siteNav.classList.remove('is-open');
        menuToggle.setAttribute('aria-expanded', 'false');
        menuToggle.focus();
      }
    });
  }

  // 8. Active Navigation State on Scroll for Homepage In-Page Anchors
  const navItems = document.querySelectorAll('.site-nav a[href^="#"]');
  if (navItems.length > 0) {
    const sections = Array.from(navItems).map(function (link) {
      const id = link.getAttribute('href');
      return id && id !== '#' ? document.querySelector(id) : null;
    }).filter(Boolean);

    function updateActiveNav() {
      let current = '';
      const scrollPos = window.scrollY + 120;

      sections.forEach(function (section) {
        if (section && section.offsetTop <= scrollPos) {
          current = '#' + section.getAttribute('id');
        }
      });

      if (current) {
        navItems.forEach(function (link) {
          if (link.getAttribute('href') === current) {
            link.classList.add('is-active');
          } else {
            link.classList.remove('is-active');
          }
        });
      }
    }

    window.addEventListener('scroll', updateActiveNav, { passive: true });
    updateActiveNav();
  }

  // 9. Interactive Consultation Form Submission
  const consultForm = document.getElementById('consultation-form');
  const formFeedback = document.getElementById('form-feedback');
  if (consultForm && formFeedback) {
    consultForm.addEventListener('submit', function (e) {
      e.preventDefault();
      const btn = consultForm.querySelector('.form-submit-btn');
      if (btn) {
        btn.disabled = true;
        btn.style.opacity = '0.7';
        btn.querySelector('span').textContent = 'Submitting Request...';
      }

      setTimeout(function () {
        formFeedback.removeAttribute('hidden');
        formFeedback.className = 'form-feedback success';
        formFeedback.innerHTML = '✓ Thank you! Your consultation request has been received. A clinical coordinator will contact you within 24 business hours.';
        consultForm.reset();
        if (btn) {
          btn.disabled = false;
          btn.style.opacity = '';
          btn.querySelector('span').textContent = 'Request Submitted!';
        }
      }, 600);
    });
  }
});
