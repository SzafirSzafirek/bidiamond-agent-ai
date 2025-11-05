# Import starter pages for BigDIAMOND White Prestige

Ten przewodnik pokazuje, jak w kilka minut dodać komplet zoptymalizowanych pod SEO stron przy użyciu pliku eksportu WordPress (WXR).

## 1. Przygotowanie środowiska
- Upewnij się, że masz aktywny WordPress 6.6+, PHP 8.2+, motyw GeneratePress + child theme **BigDIAMOND White Prestige** oraz WooCommerce.
- Włącz wtyczkę SEO (Rank Math lub Yoast), aby obsłużyć importowane meta opisy i breadcrumbs.

## 2. Lokalizacja pliku WXR
Plik znajduje się w repozytorium pod ścieżką:

```
wp-content/themes/bigdiamond-white-prestige/content/bigdiamond-white-prestige-pages.xml
```

Pobierz go na dysk lokalny lub wypakuj z paczki motywu.

## 3. Import treści w WordPressie
1. W panelu WP przejdź do **Narzędzia → Import**.
2. W sekcji „WordPress” kliknij **Zainstaluj teraz**, a następnie **Uruchom importer** (jeśli jeszcze nie zainstalowano).
3. Wskaż plik `bigdiamond-white-prestige-pages.xml` i kliknij **Prześlij plik i importuj**.
4. Przypisz autora (np. do istniejącego konta) i zaznacz opcję importu załączników, aby zachować przyszłe multimedia.
5. Po zakończeniu sprawdź, czy strony pojawiły się w **Strony → Wszystkie strony**.

## 4. Ustawienia po imporcie
- **Strona statyczna**: w **Ustawienia → Czytanie** ustaw `Strona główna` jako stronę główną oraz `Blog` jako stronę wpisów.
- **Szablony**: importer przypisuje gotowe szablony (`page-o-nas.php`, `page-kontakt.php`, itd.). Zweryfikuj w edycji każdej strony, że pole „Atrybuty → Szablon” wskazuje odpowiedni plik.
- **Menu**: dodaj nowe pozycje do głównego menu (O nas, Oferta, Realizacje, Blog, Kontakt, FAQ, Polityki) oraz przypisz CTA.
- **WooCommerce**: upewnij się, że strony polityk są wskazane w **WooCommerce → Ustawienia → Zaawansowane**.

## 5. Personalizacja treści i SEO
- Zastąp przykładowe akapity własnymi tekstami, dodaj obrazy w formatach WebP/AVIF z atrybutami `alt`, `width`, `height` i `loading="lazy"`.
- W wtyczce SEO uzupełnij meta title/description dla każdej strony, jeśli chcesz spersonalizować domyślne wartości.
- Przetestuj dane strukturalne (Organization, Product, FAQ, Article) w [Google Rich Results Test](https://search.google.com/test/rich-results).

## 6. Checklist po imporcie
- Sprawdź podstrony: Strona główna → O nas → Oferta → Realizacje → Blog → Wpis → Sklep → Produkt → Koszyk → Kasa → Kontakt → FAQ → Polityki → 404.
- Przejdź pełną ścieżkę WooCommerce (koszyk + kasa) na urządzeniu mobilnym.
- Uruchom Lighthouse/PageSpeed dla widoków mobilnych i upewnij się, że LCP/CLS/INP pozostają w zielonych zakresach.

Po wykonaniu powyższych kroków witryna BigDIAMOND będzie posiadała kompletny zestaw stron gotowych do wdrożenia i dalszej personalizacji.
