<?php
/**
 * Page: Obrączki ślubne.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

get_header();

$canonical = home_url( '/obraczki-slubne/' );
$description = 'Ekskluzywne obrączki ślubne BigDIAMOND z Krakowa – personalizowane profile komfort fit, certyfikowane diamenty i białe, żółte lub różowe złoto 585/750. Poznaj kolekcję szytą na miarę Waszej historii.';

$schema = array(
        '@context'        => 'https://schema.org',
        '@type'           => 'CollectionPage',
        'name'            => 'Obrączki ślubne BigDIAMOND',
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
                'name'        => 'Obrączki ślubne ręcznie tworzone w Krakowie',
                'description' => 'Modele z komfortowym profilowaniem, możliwością graweru 3D i diamentami o szlifie Excellent.',
                'about'       => array( 'obrączki ślubne Kraków', 'komfort fit', 'personalizacja graweru', 'diamenty GIA' ),
        ),
);

bigdiamond_white_prestige_set_seo_context(
        array(
                'title'       => 'Obrączki ślubne Kraków – BigDIAMOND White Prestige',
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
                                <h1 id="category-hero-title" class="bdwp-hero-category__title"><?php esc_html_e( 'Obrączki ślubne BigDIAMOND', 'bigdiamond-white-prestige' ); ?></h1>
                                <p class="bdwp-hero-category__description"><?php esc_html_e( 'Łączymy złotnicze rzemiosło Krakowa, nowoczesne projektowanie 3D i certyfikowane diamenty. Wybierz obrączki, które będą wygodnie towarzyszyć Wam każdego dnia.', 'bigdiamond-white-prestige' ); ?></p>
                                <div class="bdwp-hero-category__actions">
                                        <a class="btn btn--gold" href="<?php echo esc_url( home_url( '/konfigurator-obraczek/' ) ); ?>"><?php esc_html_e( 'Stwórz obrączki w konfiguratorze', 'bigdiamond-white-prestige' ); ?></a>
                                        <a class="btn" href="<?php echo esc_url( home_url( '/na-zamowienie/' ) ); ?>"><?php esc_html_e( 'Poznaj proces na zamówienie', 'bigdiamond-white-prestige' ); ?></a>
                                </div>
                                <ul class="bdwp-hero-category__bullets">
                                        <li><?php esc_html_e( 'Profil komfort fit i anatomiczne wykończenie wnętrza obrączek', 'bigdiamond-white-prestige' ); ?></li>
                                        <li><?php esc_html_e( 'Stop złota 585 lub 750, do wyboru trzy kolory oraz opcja bicolor', 'bigdiamond-white-prestige' ); ?></li>
                                        <li><?php esc_html_e( 'Autorski grawer 3D: od linii papilarnych po zapis tętna', 'bigdiamond-white-prestige' ); ?></li>
                                </ul>
                        </div>
                        <figure class="bdwp-hero-category__media">
                                <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=900&q=80" alt="<?php esc_attr_e( 'Obrączki ślubne BigDIAMOND na tle atelier w Krakowie', 'bigdiamond-white-prestige' ); ?>" loading="lazy" decoding="async" width="640" height="760" />
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
                        <h2 id="bdwp-description-heading" class="bdwp-section__title"><?php esc_html_e( 'Luksusowy minimalizm, który pozostaje na dłoniach na lata', 'bigdiamond-white-prestige' ); ?></h2>
                        <p class="bdwp-section__paragraph"><?php esc_html_e( 'W BigDIAMOND projektujemy obrączki ślubne jak biżuterię couture. Każdy profil dopasowujemy do kształtu dłoni, a wnętrze wygładzamy tak, aby obrączka nie obracała się podczas codziennych czynności. W procesie 3D przygotowujemy wizualizację, dzięki której zobaczycie różnice między wykończeniem polerowanym, satynowym a matowym szczotkowaniem.', 'bigdiamond-white-prestige' ); ?></p>
                        <p class="bdwp-section__paragraph"><?php esc_html_e( 'Stosujemy złoto 585 i 750 z certyfikowanych europejskich rafinerii oraz platynę 950 dla par, które szukają najwyższej odporności na zarysowania. Wnętrze obrączek możemy wypełnić mikrogravurą, np. odciskiem palca, zapisem tętna z dnia ślubu lub cytatem wygrawerowanym laserowo. Dzięki temu obrączki stają się osobistą kapsułą emocji.', 'bigdiamond-white-prestige' ); ?></p>
                        <p class="bdwp-section__paragraph"><?php esc_html_e( 'Nasze atelier w Krakowie kontroluje każdy etap produkcji – od topienia stopu złota, przez ręczne walcowanie, po oprawę kamieni w mikroskopie. Diamenty dobieramy według 4C, dbając o proporcje i symetrię szlifu, co gwarantuje maksymalne rozbłyski światła. W pakiecie otrzymujesz certyfikat GIA lub IGI oraz kartę gwarancyjną z instrukcją pielęgnacji.', 'bigdiamond-white-prestige' ); ?></p>
                        <p class="bdwp-section__paragraph"><?php esc_html_e( 'Jeżeli zależy Wam na niezwykłym efekcie, rekomendujemy obrączki bicolor łączące białe złoto z pasem z różowego stopu. Dla miłośników klasyki przygotowaliśmy modele w pełni żółte, a dla minimalistów – matowe obrączki z subtelną linią diamentową. Każda para może mieć różne szerokości, aby perfekcyjnie współgrać z pierścionkiem zaręczynowym.', 'bigdiamond-white-prestige' ); ?></p>
                        <p class="bdwp-section__paragraph"><?php esc_html_e( 'Umów wizytę w showroomie przy ul. Szewskiej w Krakowie lub zamów próbnik rozmiarów online. Twój concierge przygotuje wstępne wyceny, porówna warianty cenowe i podpowie, jak połączyć obrączki z biżuterią ślubną. Dodatkowo proponujemy pakiet opieki posprzedażowej: bezpłatne czyszczenie ultradźwiękami i korektę rozmiaru w ciągu 12 miesięcy.', 'bigdiamond-white-prestige' ); ?></p>
                </div>
        </section>

        <section class="bdwp-section bdwp-section--grid py-16" aria-labelledby="bdwp-crosslinks-heading">
                <div class="bdwp-section__inner">
                        <h2 id="bdwp-crosslinks-heading" class="bdwp-section__title"><?php esc_html_e( 'Najczęściej wybierane konfiguracje', 'bigdiamond-white-prestige' ); ?></h2>
                        <div class="bdwp-section__grid">
                                <article class="bdwp-card">
                                        <h3 class="bdwp-card__title"><?php esc_html_e( 'Obrączki satynowe z diamentem princess', 'bigdiamond-white-prestige' ); ?></h3>
                                        <p class="bdwp-card__text"><?php esc_html_e( 'Matowe wykończenie z połyskującą linią diamentów princess osadzonych w kanale. Idealny wybór dla par, które kochają minimalistyczne kontrasty.', 'bigdiamond-white-prestige' ); ?></p>
                                        <a class="bdwp-card__cta" href="<?php echo esc_url( home_url( '/obraczki-diamentowe/' ) ); ?>"><?php esc_html_e( 'Zobacz kolekcję diamentową', 'bigdiamond-white-prestige' ); ?></a>
                                </article>
                                <article class="bdwp-card">
                                        <h3 class="bdwp-card__title"><?php esc_html_e( 'Klasyczne obrączki z białego złota 585', 'bigdiamond-white-prestige' ); ?></h3>
                                        <p class="bdwp-card__text"><?php esc_html_e( 'Profil komfort fit, połysk typu lustro i opcja graweru 3D. W zestawie certyfikat próby i pakiet renowacyjny BigDIAMOND Care.', 'bigdiamond-white-prestige' ); ?></p>
                                        <a class="bdwp-card__cta" href="<?php echo esc_url( home_url( '/obraczki-biale-zloto-585/' ) ); ?>"><?php esc_html_e( 'Poznaj białe złoto 585', 'bigdiamond-white-prestige' ); ?></a>
                                </article>
                                <article class="bdwp-card">
                                        <h3 class="bdwp-card__title"><?php esc_html_e( 'Obrączki z różowego złota i diamentowym halo', 'bigdiamond-white-prestige' ); ?></h3>
                                        <p class="bdwp-card__text"><?php esc_html_e( 'Delikatny, romantyczny odcień połączony z linią pavé. Doskonałe uzupełnienie pierścionka z morganitem lub diamentem o szlifie cushion.', 'bigdiamond-white-prestige' ); ?></p>
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
