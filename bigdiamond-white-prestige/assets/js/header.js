/* BigDIAMOND White Prestige – header interactions (burger/search/cart)
   - focus trap + aria + inert
   - scroll lock (iOS safe) without CLS
   - outside click to close
   - close on Esc and on >= 769px resize
   - throttled header "is-scrolled"
   - optional Woo "added_to_cart" toast if jQuery present
*/
(() => {
  'use strict';

  const $  = (s, c = document) => c.querySelector(s);
  const $$ = (s, c = document) => Array.from(c.querySelectorAll(s));

  // Core nodes
  const body        = document.body;
  const header      = $('.bdwp-header');
  const drawer      = $('#bdwp-mobile-drawer');     // <div class="bdwp-mobile-drawer" id="bdwp-mobile-drawer">
  const searchPanel = $('#bdwp-search-panel');      // <div class="bdwp-search-panel" id="bdwp-search-panel">
  const searchClose = $('.bdwp-search-panel__close');

  // Toggles (can exist in two places: desktop & mobile rows)
  const menuToggles   = $$('#bdwp-mobile-menu-toggle, #bdwp-mobile-menu-toggle-2');
  const searchToggles = $$('#bdwp-search-toggle, #bdwp-search-toggle-2');

  // Candidate roots to make inert when overlays open
  const inertRoots = $$('main, #content, .site-content, .site, #page')
    .filter(el => !el.closest('#bdwp-mobile-drawer') && !el.closest('#bdwp-search-panel'));

  // ===== Utilities =====

  // Focusable elements selector
  const FOCUSABLE = [
    'a[href]:not([tabindex="-1"])',
    'button:not([disabled]):not([tabindex="-1"])',
    'input:not([disabled]):not([type="hidden"]):not([tabindex="-1"])',
    'select:not([disabled]):not([tabindex="-1"])',
    'textarea:not([disabled]):not([tabindex="-1"])',
    '[tabindex]:not([tabindex="-1"])',
    '[contenteditable="true"]'
  ].join(',');

  const preferNoMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const mqDesktop = window.matchMedia('(min-width: 769px)');

  // Scroll lock without layout shift (keeps scrollbar gap)
  let scrollYBeforeLock = 0;
  const lockScroll = () => {
    if (body.classList.contains('bdwp-scroll-locked')) return;
    scrollYBeforeLock = window.scrollY || window.pageYOffset;
    body.style.top = `-${scrollYBeforeLock}px`;
    body.style.position = 'fixed';
    body.style.width = '100%';
    body.classList.add('bdwp-scroll-locked');
  };
  const unlockScroll = () => {
    if (!body.classList.contains('bdwp-scroll-locked')) return;
    body.classList.remove('bdwp-scroll-locked');
    body.style.position = '';
    body.style.top = '';
    body.style.width = '';
    window.scrollTo(0, scrollYBeforeLock);
  };

  // Trap focus inside a container when open
  let lastTrigger = null;
  const trapFocus = (container, enable) => {
    if (!container) return;
    if (enable) {
      // Take first & last focusable
      const fEls = $$(FOCUSABLE, container);
      if (!fEls.length) return;

      const first = fEls[0];
      const last  = fEls[fEls.length - 1];

      const handler = (e) => {
        if (e.key !== 'Tab') return;
        if (fEls.every(el => el.tabIndex === -1)) return; // nothing focusable

        // Shift+Tab on first -> go to last
        if (e.shiftKey && document.activeElement === first) {
          e.preventDefault();
          last.focus();
        }
        // Tab on last -> go to first
        else if (!e.shiftKey && document.activeElement === last) {
          e.preventDefault();
          first.focus();
        }
      };

      container.__bdwpTrapHandler = handler;
      container.addEventListener('keydown', handler);

      // Mark roots inert
      inertRoots.forEach(el => { try { el.inert = true; } catch(_) { el.setAttribute('aria-hidden', 'true'); } });

      // If open: focus first field/button to aid keyboard users
      setTimeout(() => {
        (container.querySelector('[autofocus]') || first).focus({ preventScroll: true });
      }, 0);
    } else {
      // Remove trap
      if (container.__bdwpTrapHandler) {
        container.removeEventListener('keydown', container.__bdwpTrapHandler);
        delete container.__bdwpTrapHandler;
      }
      // Unset inert
      inertRoots.forEach(el => { try { el.inert = false; } catch(_) { el.removeAttribute('aria-hidden'); } });
      // Return focus to last trigger if exists
      if (lastTrigger) {
        try { lastTrigger.focus({ preventScroll: true }); } catch(_) {}
        lastTrigger = null;
      }
    }
  };

  // Helper to set expanded state on a button
  const setExpanded = (btn, state) => {
    if (!btn) return;
    btn.setAttribute('aria-expanded', String(state));
  };

  // ===== Drawer (mobile menu) =====
  const isDrawerOpen = () => drawer && drawer.classList.contains('is-open');
  const openDrawer  = () => {
    if (!drawer) return;
    drawer.classList.add('is-open');
    drawer.setAttribute('aria-hidden', 'false');
    body.classList.add('menu-open');
    lockScroll();
    trapFocus(drawer, true);
    // Sync all toggles
    menuToggles.forEach(btn => setExpanded(btn, true));
  };
  const closeDrawer = () => {
    if (!drawer) return;
    drawer.classList.remove('is-open');
    drawer.setAttribute('aria-hidden', 'true');
    body.classList.remove('menu-open');
    trapFocus(drawer, false);
    unlockScroll();
    menuToggles.forEach(btn => setExpanded(btn, false));
  };
  const toggleDrawer = (force) => (typeof force === 'boolean' ? (force ? openDrawer() : closeDrawer()) : (isDrawerOpen() ? closeDrawer() : openDrawer()));

  // ===== Search panel =====
  const isSearchOpen = () => searchPanel && searchPanel.classList.contains('is-open');
  const openSearch  = () => {
    if (!searchPanel) return;
    searchPanel.classList.add('is-open');
    searchPanel.setAttribute('aria-hidden', 'false');
    body.classList.add('search-open');
    lockScroll();
    trapFocus(searchPanel, true);
  };
  const closeSearch = () => {
    if (!searchPanel) return;
    searchPanel.classList.remove('is-open');
    searchPanel.setAttribute('aria-hidden', 'true');
    body.classList.remove('search-open');
    trapFocus(searchPanel, false);
    unlockScroll();
  };
  const toggleSearch = (force) => (typeof force === 'boolean' ? (force ? openSearch() : closeSearch()) : (isSearchOpen() ? closeSearch() : openSearch()));

  // Wire toggles
  menuToggles.forEach(btn => btn && btn.addEventListener('click', (e) => {
    lastTrigger = e.currentTarget;
    toggleDrawer();
  }, { passive: true }));

  searchToggles.forEach(btn => btn && btn.addEventListener('click', (e) => {
    lastTrigger = e.currentTarget;
    toggleSearch();
  }, { passive: true }));

  if (searchClose) searchClose.addEventListener('click', () => toggleSearch(false));

  // Close with ESC
  window.addEventListener('keydown', (e) => {
    if (e.key !== 'Escape') return;
    if (isDrawerOpen()) toggleDrawer(false);
    if (isSearchOpen()) toggleSearch(false);
  });

  // Click outside to close (drawer & search)
  document.addEventListener('click', (e) => {
    const t = e.target;
    // Drawer
    if (drawer && isDrawerOpen()) {
      const clickInsideDrawer = t.closest('#bdwp-mobile-drawer') || t.closest('#bdwp-mobile-menu-toggle') || t.closest('#bdwp-mobile-menu-toggle-2');
      if (!clickInsideDrawer) closeDrawer();
    }
    // Search
    if (searchPanel && isSearchOpen()) {
      const insideSearch = t.closest('#bdwp-search-panel') || t.closest('#bdwp-search-toggle') || t.closest('#bdwp-search-toggle-2');
      if (!insideSearch) closeSearch();
    }
  });

  // Close overlays if switching to desktop
  mqDesktop.addEventListener('change', (e) => {
    if (e.matches) { // >= 769
      if (isDrawerOpen()) closeDrawer();
      if (isSearchOpen()) closeSearch();
    }
  });

  // Header "is-scrolled" state (throttled)
  const onScroll = (() => {
    let ticking = false;
    return () => {
      if (!header) return;
      if (ticking) return;
      ticking = true;
      requestAnimationFrame(() => {
        header.classList.toggle('is-scrolled', (window.scrollY || window.pageYOffset) > 10);
        ticking = false;
      });
    };
  })();
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  // Auto-focus first input in search on open
  if (searchPanel) {
    searchPanel.addEventListener('transitionend', () => {
      if (!isSearchOpen()) return;
      const input = searchPanel.querySelector('input[type="search"], input[name="s"]');
      if (input) setTimeout(() => input.focus({ preventScroll: true }), preferNoMotion ? 0 : 60);
    });
  }

  // Close drawer when a link inside it is clicked (typowa nawigacja)
  if (drawer) {
    drawer.addEventListener('click', (e) => {
      const a = e.target.closest('a[href]');
      if (!a) return;
      // Jeśli to anchor do sekcji na tej samej stronie, zamykamy od razu
      closeDrawer();
    });
  }

  // Optional: WooCommerce "added_to_cart" -> show toast & pulse cart icon
  if (window.jQuery) {
    const $jq = window.jQuery;
    $jq(document.body).on('added_to_cart', (event, fragments, cart_hash, $button) => {
      // Pulse icon
      const cartIcon = $('.header-actions__item.cart-icon .icon-cart, .bdwp-header__icon-btn .bdwp-icon--cart');
      if (cartIcon) {
        cartIcon.classList.add('is-pulsing');
        setTimeout(() => cartIcon.classList.remove('is-pulsing'), 900);
      }
      // Toast (if markup present)
      const toast = $('.cart-toast');
      if (toast) {
        toast.classList.add('is-visible');
        setTimeout(() => toast.classList.remove('is-visible'), 3200);
      }
    });
  }

  // Accessibility roles/ARIA (in case not present in HTML)
  if (drawer) {
    drawer.setAttribute('role', 'dialog');
    drawer.setAttribute('aria-modal', 'true');
    drawer.setAttribute('aria-hidden', 'true');
  }
  if (searchPanel) {
    searchPanel.setAttribute('role', 'dialog');
    searchPanel.setAttribute('aria-modal', 'true');
    searchPanel.setAttribute('aria-hidden', 'true');
  }
})();
