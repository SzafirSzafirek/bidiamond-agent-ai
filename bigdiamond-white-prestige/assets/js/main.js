/* BigDIAMOND White Prestige interactions */
(function () {
'use strict';

const doc = document;
const header = doc.querySelector('.site-header');
const links = doc.querySelectorAll('a[href^="#"]');
const faqToggles = doc.querySelectorAll('.bdwp-faq__toggle');
const checkoutSteps = Array.from(doc.querySelectorAll('.bdwp-checkout__step'));
const menuToggle = doc.querySelector('.menu-toggle');
const siteNavigation = doc.getElementById('site-navigation');
const searchToggle = doc.querySelector('.search-toggle');
const searchPanel = doc.querySelector('.header-search');
const searchClose = doc.querySelector('.header-search__close');
const parallaxItems = Array.from(doc.querySelectorAll('[data-parallax]'));
const heroSection = doc.querySelector('.hero');
const cartIcon = doc.querySelector('.header-actions__item.cart-icon');
const cartDrawer = doc.querySelector('[data-cart-drawer]');
const cartDrawerPanel = cartDrawer ? cartDrawer.querySelector('.cart-drawer__panel') : null;
const cartDrawerCloseButtons = cartDrawer ? Array.from(cartDrawer.querySelectorAll('[data-cart-drawer-close]')) : [];
const cartDrawerHeading = cartDrawer ? cartDrawer.querySelector('#cart-drawer-heading') : null;
const CART_TOAST_DURATION = 5200;
let currentCartToast = null;
let cartToastTimeout = null;
let lastFocusedCartTrigger = null;
let cartFeedbackRegistered = false;

const setMenuToggleLabel = (expanded) => {
  if (!menuToggle) {
    return;
  }

  menuToggle.setAttribute('aria-label', expanded ? 'Zamknij nawigację BigDIAMOND' : 'Otwórz nawigację BigDIAMOND');
};

if (header) {
  const toggleCompact = () => {
    header.classList.toggle('is-scrolled', window.scrollY > 12);
  };
  toggleCompact();
  window.addEventListener('scroll', toggleCompact, { passive: true });
}

if (parallaxItems.length && heroSection) {
  const applyParallax = () => {
    const rect = heroSection.getBoundingClientRect();
    const viewportHeight = window.innerHeight || 1;
    const progress = 1 - Math.min(Math.max((rect.bottom) / (rect.height + viewportHeight), 0), 1);

    parallaxItems.forEach((item) => {
      const speed = Number(item.dataset.parallaxSpeed || '24');
      const offset = progress * speed * -1;
      item.style.setProperty('--hero-parallax', `${offset}px`);
    });
  };

  applyParallax();
  window.addEventListener(
    'scroll',
    () => {
      window.requestAnimationFrame(applyParallax);
    },
    { passive: true },
  );
}

const toggleNavigation = (forceOpen = null) => {
  if (!menuToggle) {
    return;
  }

  const currentState = menuToggle.getAttribute('aria-expanded') === 'true';
  const shouldOpen = forceOpen !== null ? forceOpen : !currentState;
  menuToggle.setAttribute('aria-expanded', shouldOpen ? 'true' : 'false');
  doc.body.classList.toggle('menu-open', shouldOpen);
  setMenuToggleLabel(shouldOpen);
};

if (menuToggle) {
  menuToggle.addEventListener('click', () => {
    toggleNavigation();
  });

  const initialExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
  toggleNavigation(initialExpanded);
}

if (siteNavigation) {
  const navLinks = siteNavigation.querySelectorAll('a');
  navLinks.forEach((navLink) => {
    navLink.addEventListener('click', () => {
      if (window.matchMedia('(max-width: 980px)').matches) {
        toggleNavigation(false);
      }
    });
  });
}

const entityMap = {
  '&': '&amp;',
  '<': '&lt;',
  '>': '&gt;',
  '"': '&quot;',
  "'": '&#39;',
  '`': '&#96;',
};

const escapeHtml = (value) => {
  if (typeof value !== 'string') {
    return '';
  }
  return value.replace(/[&<>"'`]/g, (char) => entityMap[char]);
};

const removeCartToast = () => {
  if (!currentCartToast) {
    return;
  }

  currentCartToast.classList.remove('is-visible');
  const toastToRemove = currentCartToast;
  currentCartToast = null;
  if (cartToastTimeout) {
    window.clearTimeout(cartToastTimeout);
    cartToastTimeout = null;
  }

  window.setTimeout(() => {
    toastToRemove.remove();
  }, 220);
};

const createCartToast = (details) => {
  const cartUrl =
    (window.wc_add_to_cart_params && window.wc_add_to_cart_params.cart_url) ||
    (cartIcon ? cartIcon.getAttribute('href') : '#');
  const viewCartText =
    (window.wc_add_to_cart_params && window.wc_add_to_cart_params.i18n_view_cart) ||
    'Zobacz koszyk';
  const continueShoppingText =
    (window.wc_add_to_cart_params && window.wc_add_to_cart_params.i18n_continue_shopping) ||
    'Kontynuuj zakupy';

  removeCartToast();

  const toast = doc.createElement('div');
  toast.className = 'cart-toast';
  toast.setAttribute('role', 'status');
  toast.setAttribute('aria-live', 'polite');

  const name = escapeHtml(details.name || '');
  const price = escapeHtml(details.price || '');
  const image = details.image ? `<img src="${escapeHtml(details.image)}" alt="" class="cart-toast__thumb" loading="lazy" />` : '';

  toast.innerHTML = `
    <div class="cart-toast__icon" aria-hidden="true">💎</div>
    ${image}
    <div class="cart-toast__copy">
      <p class="cart-toast__title">${name || 'Produkt dodano do koszyka'}</p>
      ${price ? `<p class="cart-toast__price">${price}</p>` : ''}
    </div>
    <div class="cart-toast__actions">
      <a class="btn btn--gold cart-toast__primary" href="${cartUrl}">
        ${escapeHtml(viewCartText)}
      </a>
      <button type="button" class="btn cart-toast__secondary" data-cart-toast-close>
        ${escapeHtml(continueShoppingText)}
      </button>
    </div>
  `;

  doc.body.appendChild(toast);
  window.requestAnimationFrame(() => {
    toast.classList.add('is-visible');
  });

  toast.querySelectorAll('[data-cart-toast-close]').forEach((button) => {
    button.addEventListener('click', () => {
      removeCartToast();
    });
  });

  currentCartToast = toast;
  cartToastTimeout = window.setTimeout(removeCartToast, CART_TOAST_DURATION);
};

const pulseCartIcon = () => {
  if (!cartIcon) {
    return;
  }

  cartIcon.classList.remove('is-pulsing');
  // eslint-disable-next-line no-unused-expressions
  cartIcon.offsetWidth;
  cartIcon.classList.add('is-pulsing');
};

const spawnSparkle = () => {
  if (!cartIcon) {
    return;
  }

  const sparkle = doc.createElement('span');
  sparkle.className = 'cart-sparkle';
  const rect = cartIcon.getBoundingClientRect();
  sparkle.style.left = `${rect.left + rect.width / 2 + window.scrollX}px`;
  sparkle.style.top = `${rect.top + rect.height / 2 + window.scrollY}px`;
  doc.body.appendChild(sparkle);
  window.setTimeout(() => {
    sparkle.remove();
  }, 900);
};

const getProductDetails = ($button) => {
  const details = {
    name: doc.title,
    price: '',
    image: '',
  };

  if (!$button || !$button.length) {
    return details;
  }

  const productContext =
    $button.closest('.bdwp-product-card').length
      ? $button.closest('.bdwp-product-card')
      : $button.closest('.product').length
      ? $button.closest('.product')
      : $button.closest('.bdwp-single-product').length
      ? $button.closest('.bdwp-single-product')
      : $button.closest('form.cart');

  if (productContext && productContext.length) {
    const nameNode = productContext.find('.bdwp-product-card__title a, .bdwp-product-card__title, .woocommerce-loop-product__title, .product_title').first();
    const priceNode = productContext.find('.price').first();
    const imageNode = productContext.find('img').first();

    if (nameNode && nameNode.length) {
      details.name = nameNode.text().trim();
    }

    if (priceNode && priceNode.length) {
      details.price = priceNode.text().trim();
    }

    if (imageNode && imageNode.length) {
      details.image = imageNode.attr('data-src') || imageNode.attr('src') || '';
    }
  }

  return details;
};

const openCartDrawer = () => {
  if (!cartDrawer || cartDrawer.classList.contains('is-open')) {
    return;
  }

  lastFocusedCartTrigger = doc.activeElement instanceof HTMLElement ? doc.activeElement : null;
  removeCartToast();
  cartDrawer.hidden = false;

  window.requestAnimationFrame(() => {
    cartDrawer.classList.add('is-open');
    doc.body.classList.add('cart-drawer-open');

    if (cartDrawerHeading) {
      cartDrawerHeading.setAttribute('tabindex', '-1');
      cartDrawerHeading.focus({ preventScroll: true });
    } else if (cartDrawerPanel) {
      cartDrawerPanel.setAttribute('tabindex', '-1');
      cartDrawerPanel.focus({ preventScroll: true });
    }
  });
};

const closeCartDrawer = () => {
  if (!cartDrawer || !cartDrawer.classList.contains('is-open')) {
    return;
  }

  cartDrawer.classList.remove('is-open');
  doc.body.classList.remove('cart-drawer-open');

  window.setTimeout(() => {
    cartDrawer.hidden = true;
  }, 220);

  if (cartDrawerHeading) {
    cartDrawerHeading.removeAttribute('tabindex');
  }
  if (cartDrawerPanel) {
    cartDrawerPanel.removeAttribute('tabindex');
  }

  const focusTarget = lastFocusedCartTrigger || cartIcon;
  if (focusTarget && typeof focusTarget.focus === 'function') {
    focusTarget.focus({ preventScroll: true });
  }
  lastFocusedCartTrigger = null;
};

const registerCartDrawer = () => {
  if (!cartDrawer) {
    return;
  }

  if (cartIcon) {
    cartIcon.addEventListener('click', (event) => {
      if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
        return;
      }

      event.preventDefault();
      openCartDrawer();
    });
  }

  cartDrawerCloseButtons.forEach((element) => {
    element.addEventListener('click', (event) => {
      event.preventDefault();
      closeCartDrawer();
    });
  });

  cartDrawer.addEventListener('transitionend', (event) => {
    if (event.target === cartDrawer && !cartDrawer.classList.contains('is-open')) {
      cartDrawer.hidden = true;
    }
  });

  cartDrawer.addEventListener('keydown', (event) => {
    if (event.key !== 'Tab' || !cartDrawer.classList.contains('is-open')) {
      return;
    }

    const panel = cartDrawerPanel || cartDrawer;
    const focusableSelectors = 'a[href], button:not([disabled]), input:not([disabled]), textarea:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex="-1"])';
    const focusableItems = Array.from(panel.querySelectorAll(focusableSelectors)).filter(
      (element) => element.offsetParent !== null,
    );

    if (!focusableItems.length) {
      return;
    }

    const firstItem = focusableItems[0];
    const lastItem = focusableItems[focusableItems.length - 1];

    if (event.shiftKey && doc.activeElement === firstItem) {
      event.preventDefault();
      lastItem.focus();
    } else if (!event.shiftKey && doc.activeElement === lastItem) {
      event.preventDefault();
      firstItem.focus();
    }
  });
};

const registerCartFeedback = () => {
  const attemptRegister = () => {
    if (cartFeedbackRegistered) {
      return;
    }

    const $ = window.jQuery;
    if (!$ || !$.fn || !$.fn.on) {
      window.setTimeout(attemptRegister, 160);
      return;
    }

    cartFeedbackRegistered = true;
    $(document.body).on('added_to_cart', (event, fragments, cartHash, $button) => {
      const details = getProductDetails($button);
      createCartToast(details);
      pulseCartIcon();
      spawnSparkle();
    });
  };

  attemptRegister();
};

registerCartDrawer();
registerCartFeedback();

const registerProductGallery = () => {
  const attemptInit = () => {
    const $ = window.jQuery;
    if (!$ || !$.fn) {
      window.setTimeout(attemptInit, 120);
      return;
    }

    const setupGallery = (gallery) => {
      if (!gallery || !gallery.$target) {
        return;
      }

      const $gallery = gallery.$target;
      const container = $gallery.closest('.product-gallery');
      if (!container.length) {
        return;
      }

      const $thumbs = container.find('[data-gallery-trigger]');
      if (!$thumbs.length) {
        return;
      }

      const setActiveThumb = (index) => {
        $thumbs.removeClass('is-active');
        const targetThumb = $thumbs.filter(`[data-gallery-trigger="${index}"]`);
        if (targetThumb.length) {
          targetThumb.addClass('is-active');
        }
      };

      $thumbs.on('click', function handleThumbClick(event) {
        event.preventDefault();
        const index = Number(this.getAttribute('data-gallery-trigger'));
        if (Number.isNaN(index)) {
          return;
        }

        const flexInstance = $gallery.data('flexslider');
        if (flexInstance && typeof flexInstance.flexslider === 'function') {
          flexInstance.flexslider(index);
        } else if (typeof $gallery.flexslider === 'function') {
          $gallery.flexslider(index);
        }

        setActiveThumb(index);
      });

      const slides = $gallery.find('.woocommerce-product-gallery__image');
      if (slides.length) {
        const observer = new MutationObserver(() => {
          const activeIndex = slides.toArray().findIndex((slide) => slide.classList.contains('flex-active-slide'));
          if (activeIndex >= 0) {
            setActiveThumb(activeIndex);
          }
        });

        slides.each((_, slide) => {
          observer.observe(slide, { attributes: true, attributeFilter: ['class'] });
        });

        setActiveThumb(0);
      }
    };

    $(document.body).on('wc-product-gallery-after-init', (event, gallery) => {
      setupGallery(gallery);
    });

    $('.woocommerce-product-gallery').each((_, element) => {
      const galleryData = $(element).data('product_gallery');
      if (galleryData) {
        setupGallery(galleryData);
      }
    });
  };

  attemptInit();
};

registerProductGallery();

const toggleSearch = (forceOpen = null) => {
  if (!searchPanel || !searchToggle) {
    return;
  }

  const currentState = searchToggle.getAttribute('aria-expanded') === 'true';
  const shouldOpen = forceOpen !== null ? forceOpen : !currentState;
  searchToggle.setAttribute('aria-expanded', shouldOpen ? 'true' : 'false');
  searchPanel.setAttribute('aria-hidden', shouldOpen ? 'false' : 'true');
  doc.body.classList.toggle('search-open', shouldOpen);

  if (shouldOpen && doc.body.classList.contains('menu-open')) {
    toggleNavigation(false);
  }

  if (shouldOpen) {
    const field = searchPanel.querySelector('.search-field');
    window.setTimeout(() => {
      if (field) {
        field.focus();
      }
    }, 220);
  } else if (searchToggle) {
    searchToggle.focus({ preventScroll: true });
  }
};

if (searchToggle) {
  searchToggle.addEventListener('click', () => {
    toggleSearch();
  });
}

if (searchClose) {
  searchClose.addEventListener('click', () => {
    toggleSearch(false);
  });
}

doc.addEventListener('keydown', (event) => {
  if (event.key === 'Escape') {
    if (doc.body.classList.contains('search-open')) {
      toggleSearch(false);
    }

    if (doc.body.classList.contains('menu-open')) {
      toggleNavigation(false);
    }

    if (doc.body.classList.contains('cart-drawer-open')) {
      closeCartDrawer();
    }
  }
});

links.forEach((link) => {
link.addEventListener('click', (event) => {
const target = doc.querySelector(link.getAttribute('href'));
if (target) {
event.preventDefault();
target.scrollIntoView({ behavior: 'smooth', block: 'start' });
target.setAttribute('tabindex', '-1');
target.focus({ preventScroll: true });
window.setTimeout(() => {
target.removeAttribute('tabindex');
}, 400);
}
});
});

if (faqToggles.length) {
const closeOthers = (currentToggle) => {
faqToggles.forEach((toggle) => {
if (toggle === currentToggle) {
return;
}

const dt = toggle.closest('dt');
const sibling = dt ? dt.nextElementSibling : (toggle.parentElement ? toggle.parentElement.nextElementSibling : null);
if (sibling && sibling.classList.contains('bdwp-faq__panel')) {
toggle.setAttribute('aria-expanded', 'false');
sibling.hidden = true;
}
});
};

faqToggles.forEach((toggle) => {
toggle.addEventListener('click', () => {
const dt = toggle.closest('dt');
const panel = dt ? dt.nextElementSibling : (toggle.parentElement ? toggle.parentElement.nextElementSibling : null);
if (!panel || !panel.classList.contains('bdwp-faq__panel')) {
return;
}

const expanded = toggle.getAttribute('aria-expanded') === 'true';
closeOthers(expanded ? null : toggle);
if (expanded) {
toggle.setAttribute('aria-expanded', 'false');
panel.hidden = true;
} else {
toggle.setAttribute('aria-expanded', 'true');
panel.hidden = false;
panel.setAttribute('tabindex', '-1');
panel.focus({ preventScroll: true });
window.setTimeout(() => {
panel.removeAttribute('tabindex');
}, 300);
}
});
});
}

if (checkoutSteps.length) {
const progressItems = Array.from(doc.querySelectorAll('.bdwp-checkout__progress span'));
const setActiveStep = (activeStep) => {
const activeIndex = checkoutSteps.indexOf(activeStep);
checkoutSteps.forEach((step, index) => {
const isActive = index === activeIndex;
step.classList.toggle('is-active', isActive);
if (progressItems[index]) {
progressItems[index].classList.toggle('is-active', index <= activeIndex);
if (isActive) {
progressItems[index].setAttribute('aria-current', 'step');
} else {
progressItems[index].removeAttribute('aria-current');
}
}
});
};

checkoutSteps.forEach((step) => {
step.addEventListener('focusin', () => {
setActiveStep(step);
});
});

setActiveStep(checkoutSteps[0]);
}

if ('loading' in HTMLImageElement.prototype === false) {
const lazyImages = [].slice.call(doc.querySelectorAll('img[loading="lazy"]'));
if ('IntersectionObserver' in window) {
const observer = new IntersectionObserver((entries, obs) => {
entries.forEach((entry) => {
if (!entry.isIntersecting) {
return;
}
const img = entry.target;
img.src = img.dataset.src || img.src;
img.removeAttribute('data-src');
obs.unobserve(img);
});
});
lazyImages.forEach((img) => observer.observe(img));
} else {
lazyImages.forEach((img) => {
img.src = img.dataset.src || img.src;
img.removeAttribute('data-src');
});
}
}
})();
/**
 * Header interactions:
 * - mobile burger open/close
 * - search panel open/close
 */

(function () {
    const body = document.body;

    // mobile menu
    const burgerBtn = document.getElementById('bdwp-mobile-menu-toggle');
    const mobileDrawer = document.getElementById('bdwp-mobile-drawer');

    if (burgerBtn && mobileDrawer) {
        burgerBtn.addEventListener('click', () => {
            const isOpen = mobileDrawer.classList.toggle('is-open');
            burgerBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            mobileDrawer.setAttribute('aria-hidden', isOpen ? 'false' : 'true');

            body.style.overflow = isOpen ? 'hidden' : '';
        });
    }

    // search panel
    const searchBtn = document.getElementById('bdwp-search-toggle');
    const searchPanel = document.getElementById('bdwp-search-panel');
    const searchClose = searchPanel ? searchPanel.querySelector('.bdwp-search-panel__close') : null;
    const mobileSearchShortcut = document.getElementById('bdwp-mobile-search-shortcut');

    function openSearch() {
        if (!searchPanel) return;
        searchPanel.classList.add('is-open');
        searchPanel.setAttribute('aria-hidden', 'false');
        searchBtn && searchBtn.setAttribute('aria-expanded', 'true');
        body.style.overflow = 'hidden';
        const input = searchPanel.querySelector('input[type="search"], input[name="s"]');
        if (input) { setTimeout(() => input.focus(), 50); }
    }

    function closeSearch() {
        if (!searchPanel) return;
        searchPanel.classList.remove('is-open');
        searchPanel.setAttribute('aria-hidden', 'true');
        searchBtn && searchBtn.setAttribute('aria-expanded', 'false');
        body.style.overflow = '';
    }

    if (searchBtn) {
        searchBtn.addEventListener('click', openSearch);
    }
    if (mobileSearchShortcut) {
        mobileSearchShortcut.addEventListener('click', () => {
            if (mobileDrawer && mobileDrawer.classList.contains('is-open')) {
                mobileDrawer.classList.remove('is-open');
                mobileDrawer.setAttribute('aria-hidden', 'true');
                burgerBtn && burgerBtn.setAttribute('aria-expanded', 'false');
            }
            openSearch();
        });
    }
    if (searchClose) {
        searchClose.addEventListener('click', closeSearch);
    }
    if (searchPanel) {
        searchPanel.addEventListener('click', (e) => {
            if (e.target === searchPanel) {
                closeSearch();
            }
        });
    }
})();
