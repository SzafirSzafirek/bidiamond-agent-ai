<?php
/**
 * Page: Obrączki ślubne.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

get_header();

$canonical = home_url( '/obraczki-biale-zloto-585/' );
$description = 'Kolekcja BigDIAMOND White Prestige przedstawia obrączki ślubne z białego złota 585 – chłodne, świetliste i odporne na codzienność. Projektujemy modele z komfortowym profilem, certyfikowanymi diamentami i nowoczesną personalizacją, aby podkreślić Waszą historię.';

$schema = array(
        '@context'        => 'https://schema.org',
        '@type'           => 'CollectionPage',
        'name'            => 'Obrączki ślubne z białego złota 585',
        'description'     => $description,
        'url'             => $canonical,
        'inLanguage'      => 'pl-PL',
        'isPartOf'        => home_url( '/sklep/' ),
        'publisher'       => array(
                '@type' => 'Organization',
                'name'  => 'BigDIAMOND White Prestige',
                'url'   => home_url( '/' ),
        ),
        'mainEntity'      => array(
                '@type'       => 'ProductCollection',
                'name'        => 'Obrączki z białego złota 585 ręcznie tworzone w Krakowie',
                'description' => 'Modele z komfortowym profilowaniem, możliwością graweru 3D i diamentami o szlifie Excellent.',
                'about'       => array( 'obrączki ślubne białe złoto', 'komfort fit', 'rodowanie premium', 'diamenty GIA' ),
        ),
);

bigdiamond_white_prestige_set_seo_context(
        array(
                'title'       => 'Obrączki ślubne białe złoto 585 – BigDIAMOND Kraków',
                'description' => $description,
                'canonical'   => $canonical,
                'schema'      => array( $schema ),
        )
);
?>
<main id="primary" class="site-main bdwp-main" role="main">
        <section class="bdwp-hero-category py-20" aria-labelledby="category-hero-title">
                <div class="bdwp-hero-category__container">
                        <div>
                                <p class="bdwp-eyebrow"><?php esc_html_e( 'Kolekcja premium', 'bigdiamond-white-prestige' ); ?></p>
                                <h1 id="category-hero-title" class="bdwp-hero-category__title"><?php esc_html_e( 'Obrączki ślubne z białego złota 585', 'bigdiamond-white-prestige' ); ?></h1>
                                <p class="bdwp-hero-category__description"><?php esc_html_e( 'Białe złoto 585 w naszej interpretacji jest chłodne jak górskie światło i miękkie jak dotyk satyny. Każdy model tworzymy na zamówienie, oferując profile comfort fit, satynę perłową oraz grawer laserowy z odcieniem rodowanego połysku.', 'bigdiamond-white-prestige' ); ?></p>
                                <div class="bdwp-hero-category__actions">
                                        <a class="btn btn--gold" href="<?php echo esc_url( home_url( '/konfigurator-obraczek/' ) ); ?>"><?php esc_html_e( 'Stwórz obrączki w konfiguratorze', 'bigdiamond-white-prestige' ); ?></a>
                                        <a class="btn" href="<?php echo esc_url( home_url( '/na-zamowienie/' ) ); ?>"><?php esc_html_e( 'Poznaj proces na zamówienie', 'bigdiamond-white-prestige' ); ?></a>
                                </div>
                                <ul class="bdwp-hero-category__bullets">
                                        <li><?php esc_html_e( 'Ręcznie polerowany profil comfort fit i anatomiczne wnętrze', 'bigdiamond-white-prestige' ); ?></li>
                                        <li><?php esc_html_e( 'Białe złoto 585 z warstwą rodowania premium odpornego na ścieranie', 'bigdiamond-white-prestige' ); ?></li>
                                        <li><?php esc_html_e( 'Grawer 3D z datą ślubu, współrzędnymi lub falą dźwięku przysięgi', 'bigdiamond-white-prestige' ); ?></li>
                                </ul>
                        </div>
                        <figure class="bdwp-hero-category__media">
                                <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=900&q=80" alt="<?php esc_attr_e( 'Obrączki ślubne z białego złota 585 na tle atelier w Krakowie', 'bigdiamond-white-prestige' ); ?>" loading="lazy" decoding="async" width="640" height="760" />
                        </figure>
                </div>
        </section>

        <?php bigdiamond_white_prestige_render_breadcrumbs(); ?>

        <?php
        get_template_part(
                'template-parts/components/collection-filters',
                null,
                array(
                        'action'  => $canonical,
                        'filters' => array(
                                array(
                                        'name'    => 'kolor',
                                        'label'   => __( 'Kolor złota', 'bigdiamond-white-prestige' ),
                                        'options' => array(
                                                'biale-zloto'  => __( 'Białe złoto 585', 'bigdiamond-white-prestige' ),
                                                'zolte-zloto'  => __( 'Żółte złoto 585', 'bigdiamond-white-prestige' ),
                                                'rozowe-zloto' => __( 'Różowe złoto 585', 'bigdiamond-white-prestige' ),
                                                'platyna'      => __( 'Platyna 950', 'bigdiamond-white-prestige' ),
                                        ),
                                ),
                                array(
                                        'name'    => 'profil',
                                        'label'   => __( 'Profil obrączki', 'bigdiamond-white-prestige' ),
                                        'options' => array(
                                                'komfort-fit'    => __( 'Komfort fit', 'bigdiamond-white-prestige' ),
                                                'klasyczny'      => __( 'Klasyczny półokrągły', 'bigdiamond-white-prestige' ),
                                                'plaski'         => __( 'Płaski modern', 'bigdiamond-white-prestige' ),
                                                'fazowany'       => __( 'Fazowany art déco', 'bigdiamond-white-prestige' ),
                                        ),
                                ),
                                array(
                                        'name'    => 'kamien',
                                        'label'   => __( 'Diamenty i kamienie', 'bigdiamond-white-prestige' ),
                                        'options' => array(
                                                'bez-kamieni' => __( 'Bez kamieni', 'bigdiamond-white-prestige' ),
                                                'diamenty'    => __( 'Diamenty GIA/IGI', 'bigdiamond-white-prestige' ),
                                                'kolorowe'    => __( 'Szafiry, rubiny, morganity', 'bigdiamond-white-prestige' ),
                                        ),
                                ),
                                array(
                                        'name'    => 'budzet',
                                        'label'   => __( 'Budżet', 'bigdiamond-white-prestige' ),
                                        'options' => array(
                                                'do-4000'   => __( 'Do 4 000 zł para', 'bigdiamond-white-prestige' ),
                                                '4000-7000' => __( '4 000 – 7 000 zł para', 'bigdiamond-white-prestige' ),
                                                'powyzej'   => __( 'Powyżej 7 000 zł para', 'bigdiamond-white-prestige' ),
                                        ),
                                ),
                        ),
                )
        );
        ?>

        <section class="bdwp-section bdwp-section--text py-16" aria-labelledby="bdwp-description-heading">
                <div class="bdwp-section__inner">
                        <h2 id="bdwp-description-heading" class="bdwp-section__title"><?php esc_html_e( 'Białe złoto 585 w odsłonie couture', 'bigdiamond-white-prestige' ); ?></h2>
                        <p class="bdwp-section__paragraph"><?php esc_html_e( 'Każda obrączka z białego złota 585 powstaje w naszym krakowskim atelier z wykorzystaniem stopu o idealnej proporcji niklu i palladu. Dzięki temu powierzchnia ma chłodny blask i nie żółknie nawet przy intensywnym użytkowaniu. Przed finalnym polerem pokazujemy wizualizacje 3D, abyście mogli zdecydować o grubości krawędzi i wysokości ścianki.', 'bigdiamond-white-prestige' ); ?></p>
                        <p class="bdwp-section__paragraph"><?php esc_html_e( 'Dla par, które kochają perfekcję, oferujemy podwójne rodowanie i ręczne satynowanie w jednym procesie. Mikrostruktura powierzchni odbija światło równomiernie, a wnętrze komfort fit zostało zaprojektowane tak, by zapewnić maksymalną cyrkulację powietrza. Uwiecznijcie ważne symbole – grawerujemy współrzędne, alfabet Morse’a i personalne ilustracje.', 'bigdiamond-white-prestige' ); ?></p>
                        <p class="bdwp-section__paragraph"><?php esc_html_e( 'Wybierając diamenty, korzystamy z certyfikowanych parcel GIA i IGI. Każdy kamień przechodzi kontrolę pod mikroskopem 40x, a oprawę pavé wykonujemy przy użyciu mikroskopu jubilerskiego. Do kompletu dokładamy kartę 4C, zdjęcia makro oraz instrukcję pielęgnacji białego złota, obejmującą harmonogram wizyt serwisowych.', 'bigdiamond-white-prestige' ); ?></p>
                        <p class="bdwp-section__paragraph"><?php esc_html_e( 'Znakiem rozpoznawczym kolekcji są kontrasty: możecie połączyć białe złoto z matową ramą ice matte, wstawić linię czarnych diamentów lub dodać strukturę brushed linen. Każdą obrączkę dopasujemy do pierścionka zaręczynowego – od wąskich modeli 2 mm po spektakularne 6 mm z frezowanymi rantami.', 'bigdiamond-white-prestige' ); ?></p>
                        <p class="bdwp-section__paragraph"><?php esc_html_e( 'Zapraszamy do showroomu w Krakowie lub na konsultację online, podczas której zaprezentujemy próbki wykończeń i przygotujemy spersonalizowaną wycenę. Skorzystajcie z programu BigDIAMOND Care: bezpłatne odświeżenie rodowania, polerowanie co 12 miesięcy oraz preferencyjna cena na przyszłe renowacje.', 'bigdiamond-white-prestige' ); ?></p>
                </div>
        </section>

        <section class="bdwp-section bdwp-section--grid py-16" aria-labelledby="bdwp-crosslinks-heading">
                <div class="bdwp-section__inner">
                        <h2 id="bdwp-crosslinks-heading" class="bdwp-section__title"><?php esc_html_e( 'Najczęściej wybierane konfiguracje', 'bigdiamond-white-prestige' ); ?></h2>
                        <div class="bdwp-section__grid">
                                <article class="bdwp-card">
                                        <h3 class="bdwp-card__title"><?php esc_html_e( 'Białe złoto z linią diamentów pavé', 'bigdiamond-white-prestige' ); ?></h3>
                                        <p class="bdwp-card__text"><?php esc_html_e( 'Chłodne białe złoto z linią diamentów pavé osadzonych gęsto w mikrokrapach – luksusowy efekt lustra, który pięknie odbija światło aparatu.', 'bigdiamond-white-prestige' ); ?></p>
                                        <a class="bdwp-card__cta" href="<?php echo esc_url( home_url( '/obraczki-diamentowe/' ) ); ?>"><?php esc_html_e( 'Poznaj diamentowe obrączki', 'bigdiamond-white-prestige' ); ?></a>
                                </article>
                                <article class="bdwp-card">
                                        <h3 class="bdwp-card__title"><?php esc_html_e( 'Klasyczne obrączki z białego złota 585', 'bigdiamond-white-prestige' ); ?></h3>
                                        <p class="bdwp-card__text"><?php esc_html_e( 'Profil comfort fit z lustrem w odcieniu chłodnego złota i opcja graweru 3D. W zestawie certyfikat próby i pakiet renowacyjny BigDIAMOND Care.', 'bigdiamond-white-prestige' ); ?></p>
                                        <a class="bdwp-card__cta" href="<?php echo esc_url( home_url( '/obraczki-biale-zloto-585/' ) ); ?>"><?php esc_html_e( 'Poznaj białe złoto 585', 'bigdiamond-white-prestige' ); ?></a>
                                </article>
                                <article class="bdwp-card">
                                        <h3 class="bdwp-card__title"><?php esc_html_e( 'Minimalistyczne obrączki ice white', 'bigdiamond-white-prestige' ); ?></h3>
                                        <p class="bdwp-card__text"><?php esc_html_e( 'Subtelnie matowa powierzchnia ice white ze szczotkowanymi rantami – idealna propozycja dla par ceniących minimalistyczną elegancję i wygodę.', 'bigdiamond-white-prestige' ); ?></p>
                                        <a class="bdwp-card__cta" href="<?php echo esc_url( home_url( '/pierscionki-zareczynowe/' ) ); ?>"><?php esc_html_e( 'Dobierz pierścionek zaręczynowy', 'bigdiamond-white-prestige' ); ?></a>
                                </article>
                        </div>
                </div>
        </section>

        <section class="bdwp-section bdwp-section--author py-16" aria-labelledby="bdwp-author-heading">
                <div class="bdwp-section__inner">
                        <h2 id="bdwp-author-heading" class="bdwp-section__title"><?php esc_html_e( 'Autor kolekcji', 'bigdiamond-white-prestige' ); ?></h2>
                        <div class="bdwp-author">
                                <figure class="bdwp-author__media">
                                        <img src="https://images.unsplash.com/photo-1522312346375-d1a52e2b99b3?auto=format&fit=crop&w=640&q=80" alt="<?php esc_attr_e( 'Mistrz złotnictwa BigDIAMOND prezentujący obrączki', 'bigdiamond-white-prestige' ); ?>" loading="lazy" decoding="async" width="420" height="480" />
                                </figure>
                                <div class="bdwp-author__content">
                                        <p class="bdwp-author__name"><?php esc_html_e( 'Autor: Michał Wysocki – mistrz złotnictwa i gemmolog GIA AJP', 'bigdiamond-white-prestige' ); ?></p>
                                        <p class="bdwp-section__paragraph"><?php esc_html_e( 'Michał projektuje obrączki od 18 lat. Jest absolwentem GIA Applied Jewelry Professional i certyfikowanym rzeczoznawcą diamentów. W BigDIAMOND odpowiada za konsultacje indywidualne, dobór kamieni oraz finalny montaż w pracowni przy ul. Szewskiej w Krakowie.', 'bigdiamond-white-prestige' ); ?></p>
                                        <p class="bdwp-section__paragraph"><?php esc_html_e( 'Dowiedz się więcej o procesie na naszym blogu lub zamów spotkanie online – przeprowadzimy Cię przez każdy etap, od inspiracji po finalne przekazanie obrączek w luksusowym etui.', 'bigdiamond-white-prestige' ); ?></p>
                                        <div class="bdwp-author__links">
                                                <a class="bdwp-card__cta" href="https://www.gia.edu/gem-education/applied-jewelry-professional-ajp" rel="noopener" target="_blank"><?php esc_html_e( 'Certyfikat GIA AJP', 'bigdiamond-white-prestige' ); ?></a>
                                                <a class="bdwp-card__cta" href="https://igi.org/" rel="noopener" target="_blank"><?php esc_html_e( 'Standardy IGI', 'bigdiamond-white-prestige' ); ?></a>
                                        </div>
                                </div>
                        </div>
                </div>
        </section>

        <aside class="bdwp-sticky-cta" role="complementary" aria-label="<?php esc_attr_e( 'Umów przymiarkę obrączek', 'bigdiamond-white-prestige' ); ?>">
                <div class="bdwp-sticky-cta__inner">
                        <p class="bdwp-sticky-cta__title"><?php esc_html_e( 'Umów przymiarkę w Krakowie lub konsultację online', 'bigdiamond-white-prestige' ); ?></p>
                        <div class="bdwp-sticky-cta__actions">
                                <a class="btn btn--gold" href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>"><?php esc_html_e( 'Umów wizytę', 'bigdiamond-white-prestige' ); ?></a>
                                <a class="btn" href="<?php echo esc_url( home_url( '/blog/poradnik-slubny/' ) ); ?>"><?php esc_html_e( 'Przeczytaj poradnik ślubny', 'bigdiamond-white-prestige' ); ?></a>
                        </div>
                </div>
        </aside>

        <section class="bdwp-section bdwp-section--related py-16" aria-labelledby="bdwp-related-heading">
                <div class="bdwp-section__inner">
                        <h2 id="bdwp-related-heading" class="bdwp-section__title"><?php esc_html_e( 'Zobacz również', 'bigdiamond-white-prestige' ); ?></h2>
                        <div class="bdwp-related__links">
                                <a class="bdwp-related__item" href="<?php echo esc_url( home_url( '/pierscionki-z-diamentem/' ) ); ?>"><?php esc_html_e( 'Pierścionki z diamentem', 'bigdiamond-white-prestige' ); ?></a>
                                <a class="bdwp-related__item" href="<?php echo esc_url( home_url( '/grawerowanie-bizuterii/' ) ); ?>"><?php esc_html_e( 'Grawerowanie biżuterii', 'bigdiamond-white-prestige' ); ?></a>
                                <a class="bdwp-related__item" href="<?php echo esc_url( home_url( '/blog/4c-i-diamenty/' ) ); ?>"><?php esc_html_e( 'Poznaj kryteria 4C', 'bigdiamond-white-prestige' ); ?></a>
                        </div>
                </div>
        </section>
</main>
<?php
get_footer();
