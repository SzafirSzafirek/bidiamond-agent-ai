# BigDIAMOND White Prestige – GeneratePress Child Theme

Ekskluzywny motyw potomny dla marki BigDIAMOND, przygotowany na bazie GeneratePress. Pakiet obejmuje kompletny serwis: stronę główną, sekcje O nas/Oferta/Realizacje, rozbudowany blog, strony informacyjne (FAQ, Kontakt, Polityki) oraz zoptymalizowane widoki WooCommerce (sklep, produkt, koszyk, kasa, konto). Projekt zachowuje najwyższe standardy UX, Core Web Vitals, dostępności i SEO.

**Aktualna wersja:** 1.0.1

## Wymagania systemowe
- WordPress 6.6 lub nowszy
- PHP 8.2+
- Motyw GeneratePress + wtyczka GP Premium 2.x
- WooCommerce 8.x
- Wtyczka SEO (np. Rank Math lub Yoast) – zalecana dla breadcrumbs i mapy witryny

## Instalacja i konfiguracja
1. Skopiuj folder `bigdiamond-white-prestige` do katalogu `wp-content/themes/`.
2. W panelu WordPress aktywuj najpierw motyw GeneratePress, a następnie motyw potomny BigDIAMOND White Prestige.
3. Zainstaluj wtyczki: WooCommerce, Rank Math/Yoast SEO (dla breadcrumbs + sitemap), opcjonalnie formularz kontaktowy.
4. Utwórz strony:
   - `Strona główna` – ustaw jako statyczną stronę główną i przypisz szablon domyślny.
   - `Oferta` (`page-oferta.php`) oraz `Realizacje` (`page-realizacje.php`).
   - `O nas` (`page-o-nas.php`), `Kontakt` (`page-kontakt.php`), `FAQ` (`page-faq.php`).
   - Polityki: `Polityka prywatności`, `Polityka wysyłki`, `Polityka zwrotów`, `Regulamin` – przypisz odpowiednie szablony (`page-privacy.php`, `page-shipping.php`, `page-zwroty.php`, `page-terms.php`).
5. W konfiguracji WooCommerce ustaw stronę sklepu i stronę konta; przypisz menu główne z linkami do wszystkich podstron oraz rozwijane kategorie produktu.
6. (Opcjonalnie) zaimportuj gotowe strony z pliku `content/bigdiamond-white-prestige-pages.xml`, aby wypełnić witrynę zoptymalizowanymi treściami startowymi (patrz sekcja „Import gotowych stron”).
7. W pliku `front-page.php` znajduje się kontener `<div id="bigdiamond-agent"></div>` – umieść w nim skrypt integrujący widżet AI, gdy będzie gotowy.

## Struktura i funkcjonalności
- `template-parts/hero.php`, `sections/offer.php`, `sections/gallery.php` – sekcje strony głównej.
- `template-parts/about.php` – narracja o marce z siatką zespołu i CTA.
- `template-parts/contact-form.php` – formularz kontaktowy, dane kontaktowe, FAQ, mapa Google i zespół concierge.
- `template-parts/blog/post-card.php`, `home.php`, `index.php`, `archive.php`, `single.php` – system blogowy z kartami wpisów, spisem treści i artykułami powiązanymi.
- `woocommerce/` – szablony sklepu: listing kategorii, produkt (zoom/lightbox + produkty podobne i ostatnio oglądane), koszyk, kasa (układ krokowy), panel „Moje konto”.
- `inc/seo*.php` – moduły JSON-LD: organizacja, breadcrumbs, produkty, blog, FAQ, polityki.
- `assets/css/white-prestige.css` – kompletne style (sticky header, sekcje informacyjne, blog, polityki, WooCommerce, my-account) z responsywnością dla progów ~980px i ~560px.
- `assets/js/main.js` – interakcje: sticky header, płynne przewijanie, fallback lazy load, akordeon FAQ, wyróżnianie kroków kasy.

## Import gotowych stron
- Plik WXR z treściami startowymi znajduje się w katalogu `content/bigdiamond-white-prestige-pages.xml`.
- Szczegółowe instrukcje importu krok po kroku znajdziesz w `docs/IMPORT_GUIDE.md`.
- Po imporcie pamiętaj o ustawieniu statycznej strony głównej (`Strona główna`) i strony wpisów (`Blog`) oraz o przypisaniu szablonów dla stron polityk i sekcji informacyjnych.

## Optymalizacja Core Web Vitals
- Grafiki zastąp zewnętrznymi linkami (np. Unsplash/Pexels) lub własnymi plikami WebP/AVIF z atrybutami `srcset`/`sizes`.
- Używaj `loading="lazy"`, `fetchpriority` i preconnect do Google Fonts (dodane w enqueue).
- Minifikuj CSS/JS w buildzie produkcyjnym oraz korzystaj z cache (HTTP/2 + GZIP/Brotli).
- Tree-shake nieużywane skrypty/wtyczki; trzymaj budżet statyczny poniżej ~60 KB CSS i ~150 KB JS.
- W WooCommerce rozważ preload krytycznych obrazów produktu oraz optymalizację miniatur.

## Wskazówki SEO
- Zachowuj semantyczną hierarchię nagłówków (jedno H1 na widok).
- Wprowadzaj unikalne meta title/description i obrazy z opisowymi `alt`.
- Korzystaj z danych strukturalnych (JSON-LD) – moduły w `inc/seo*.php` generują Organization, BreadcrumbList, Product, BlogPosting, FAQPage i WebPage dla polityk.
- Po wdrożeniu zweryfikuj wyniki w Google Rich Results Test i zaktualizuj mapę witryny (Rank Math/Yoast).

## Integracja AI widgetu
Wstaw skrypt widżetu AI do elementu `<div id="bigdiamond-agent"></div>` (np. przed sekcją galerii na stronie głównej). Upewnij się, że ładowanie skryptu jest asynchroniczne i nie blokuje renderowania.

## Checklist przed wdrożeniem
1. Przejdź ścieżkę: Strona główna → O nas → Oferta → Realizacje → Blog → Wpis → Sklep → Produkt → Koszyk → Kasa → Kontakt → FAQ → 404.
2. Zweryfikuj poprawność działania WooCommerce (płatności, kupony, zamówienie jako gość).
3. Sprawdź dostępność (nawigacja klawiaturą, aria-label, kontrasty) i poprawność formularzy.
4. Uruchom Lighthouse/PageSpeed Insights (mobile & desktop) i upewnij się, że LCP/CLS/INP mieszczą się w zielonych zakresach.
5. Przetestuj na najpopularniejszych przeglądarkach (Chrome, Safari, Firefox, Edge) oraz na urządzeniach mobilnych ≥360px.
6. Uruchom `php -l` dla plików PHP i PHPCS (WordPress + PSR-12) przed deploymentem.

## Sugestia komunikatu commit
```
Add full site pages and SEO enhancements for BigDIAMOND (contact, about, blog, checkout optimizations)
```
