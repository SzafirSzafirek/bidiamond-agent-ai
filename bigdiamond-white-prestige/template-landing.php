<?php
/**
 * Local landing page template fragment.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
        exit;
}

$defaults = array(
        'meta'      => array(),
        'hero'      => array(
                'title'       => get_the_title(),
                'eyebrow'     => '',
                'description' => '',
                'cta'         => array(),
        ),
        'sections'  => array(),
        'map_embed' => '',
        'gallery'   => array(),
        'faq'       => array(),
        'schema'    => array(),
);

$args = wp_parse_args( $args ?? array(), $defaults );

if ( ! empty( $args['meta'] ) || ! empty( $args['schema'] ) ) {
        $seo = array_merge(
                $args['meta'],
                array(
                        'schema' => $args['schema'],
                )
        );
        bigdiamond_white_prestige_set_seo_context( $seo );
}

$hero = $args['hero'];
?>
<section class="bdwp-hero-landing" aria-labelledby="landing-hero-title">
        <div class="bdwp-hero-landing__container">
                <div>
                        <?php if ( ! empty( $hero['eyebrow'] ) ) : ?>
                                <p class="bdwp-eyebrow"><?php echo esc_html( $hero['eyebrow'] ); ?></p>
                        <?php endif; ?>
                        <h1 id="landing-hero-title" class="bdwp-hero-landing__title"><?php echo esc_html( $hero['title'] ); ?></h1>
                        <?php if ( ! empty( $hero['description'] ) ) : ?>
                                <p class="bdwp-hero-landing__description"><?php echo esc_html( $hero['description'] ); ?></p>
                        <?php endif; ?>
                        <div class="bdwp-hero-landing__actions">
                                <?php if ( ! empty( $hero['cta'] ) ) : ?>
                                        <a class="btn btn--gold" href="<?php echo esc_url( $hero['cta']['url'] ); ?>"><?php echo esc_html( $hero['cta']['label'] ); ?></a>
                                <?php endif; ?>
                                <a class="btn" href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>"><?php esc_html_e( 'Skontaktuj się z concierge', 'bigdiamond-white-prestige' ); ?></a>
                        </div>
                        <ul class="bdwp-hero-landing__bullets">
                                <li><?php esc_html_e( 'Certyfikowane diamenty GIA/IGI', 'bigdiamond-white-prestige' ); ?></li>
                                <li><?php esc_html_e( 'Autorska pracownia złotnicza w Krakowie', 'bigdiamond-white-prestige' ); ?></li>
                                <li><?php esc_html_e( 'Terminy spotkań również w weekendy', 'bigdiamond-white-prestige' ); ?></li>
                        </ul>
                </div>
                <div class="bdwp-hero-landing__media" aria-hidden="true">
                        <span class="bdwp-hero-landing__badge">Luxury Crafted Locally</span>
                </div>
        </div>
</section>

<?php bigdiamond_white_prestige_render_breadcrumbs(); ?>

<?php foreach ( $args['sections'] as $section ) :
        $layout = $section['layout'] ?? 'text';
        ?>
        <section class="bdwp-section bdwp-section--<?php echo esc_attr( $layout ); ?>">
                <div class="bdwp-section__inner">
                        <?php if ( ! empty( $section['title'] ) ) : ?>
                                <h2 class="bdwp-section__title"><?php echo esc_html( $section['title'] ); ?></h2>
                        <?php endif; ?>
                        <?php if ( ! empty( $section['intro'] ) ) : ?>
                                <p class="bdwp-section__intro"><?php echo esc_html( $section['intro'] ); ?></p>
                        <?php endif; ?>

                        <?php if ( 'grid' === $layout && ! empty( $section['items'] ) ) : ?>
                                <div class="bdwp-section__grid">
                                        <?php foreach ( $section['items'] as $item ) : ?>
                                                <article class="bdwp-card">
                                                        <h3 class="bdwp-card__title"><?php echo esc_html( $item['title'] ); ?></h3>
                                                        <p class="bdwp-card__text"><?php echo esc_html( $item['text'] ); ?></p>
                                                </article>
                                        <?php endforeach; ?>
                                </div>
                        <?php else : ?>
                                <?php foreach ( (array) ( $section['content'] ?? array() ) as $paragraph ) : ?>
                                        <p class="bdwp-section__paragraph"><?php echo esc_html( $paragraph ); ?></p>
                                <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if ( ! empty( $section['list'] ) ) : ?>
                                <ul class="bdwp-section__list">
                                        <?php foreach ( $section['list'] as $item ) : ?>
                                                <li><?php echo esc_html( $item ); ?></li>
                                        <?php endforeach; ?>
                                </ul>
                        <?php endif; ?>
                </div>
        </section>
<?php endforeach; ?>

<?php if ( ! empty( $args['gallery'] ) ) : ?>
        <section class="bdwp-section bdwp-section--gallery" aria-labelledby="bdwp-gallery-title">
                <div class="bdwp-section__inner">
                        <h2 id="bdwp-gallery-title" class="bdwp-section__title"><?php esc_html_e( 'Atmosfera miejsca', 'bigdiamond-white-prestige' ); ?></h2>
                        <div class="bdwp-gallery">
                                <?php foreach ( $args['gallery'] as $image ) : ?>
                                        <figure class="bdwp-gallery__item">
                                                <img src="<?php echo esc_url( $image['src'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" loading="lazy" decoding="async" />
                                                <?php if ( ! empty( $image['caption'] ) ) : ?>
                                                        <figcaption><?php echo esc_html( $image['caption'] ); ?></figcaption>
                                                <?php endif; ?>
                                        </figure>
                                <?php endforeach; ?>
                        </div>
                </div>
        </section>
<?php endif; ?>

<?php if ( ! empty( $args['map_embed'] ) ) : ?>
        <section class="bdwp-section bdwp-section--map" aria-labelledby="bdwp-map-title">
                <div class="bdwp-section__inner">
                        <h2 id="bdwp-map-title" class="bdwp-section__title"><?php esc_html_e( 'Mapa dojazdu', 'bigdiamond-white-prestige' ); ?></h2>
                        <div class="bdwp-map" aria-hidden="false">
                                <?php echo $args['map_embed']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </div>
                </div>
        </section>
<?php endif; ?>

<?php if ( ! empty( $args['faq'] ) ) : ?>
        <section class="bdwp-section bdwp-section--faq" aria-labelledby="bdwp-landing-faq">
                <div class="bdwp-section__inner">
                        <h2 id="bdwp-landing-faq" class="bdwp-section__title"><?php esc_html_e( 'FAQ dla odwiedzających salon', 'bigdiamond-white-prestige' ); ?></h2>
                        <div class="bdwp-faq" itemscope itemtype="https://schema.org/FAQPage">
                                <?php foreach ( $args['faq'] as $item ) : ?>
                                        <article class="bdwp-faq__item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                                                <h3 class="bdwp-faq__question" itemprop="name"><?php echo esc_html( $item['question'] ); ?></h3>
                                                <div class="bdwp-faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                                                        <p itemprop="text"><?php echo esc_html( $item['answer'] ); ?></p>
                                                </div>
                                        </article>
                                <?php endforeach; ?>
                        </div>
                </div>
        </section>
<?php endif; ?>

<section class="bdwp-related" aria-labelledby="bdwp-related-title">
        <div class="bdwp-section__inner">
                <h2 id="bdwp-related-title" class="bdwp-section__title"><?php esc_html_e( 'Zobacz również', 'bigdiamond-white-prestige' ); ?></h2>
                <div class="bdwp-related__links">
                        <a class="bdwp-related__item" href="<?php echo esc_url( home_url( '/na-zamowienie/' ) ); ?>"><?php esc_html_e( 'Biżuteria na zamówienie 3D', 'bigdiamond-white-prestige' ); ?></a>
                        <a class="bdwp-related__item" href="<?php echo esc_url( home_url( '/obraczki-slubne/' ) ); ?>"><?php esc_html_e( 'Obrączki ślubne BigDIAMOND', 'bigdiamond-white-prestige' ); ?></a>
                        <a class="bdwp-related__item" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Poradnik wyboru diamentów', 'bigdiamond-white-prestige' ); ?></a>
                </div>
        </div>
</section>
