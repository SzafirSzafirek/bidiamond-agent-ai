<?php
/**
 * FAQ template partial with schema output.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
        exit;
}

$defaults = array(
        'meta'     => array(),
        'hero'     => array(
                'title'       => get_the_title(),
                'description' => '',
        ),
        'groups'   => array(),
        'schema'   => array(),
        'cta_bar'  => array(),
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
<section class="bdwp-hero-faq" aria-labelledby="faq-hero-title">
        <div class="bdwp-hero-faq__container">
                <h1 id="faq-hero-title" class="bdwp-hero-faq__title"><?php echo esc_html( $hero['title'] ); ?></h1>
                <?php if ( ! empty( $hero['description'] ) ) : ?>
                        <p class="bdwp-hero-faq__description"><?php echo esc_html( $hero['description'] ); ?></p>
                <?php endif; ?>
        </div>
</section>

<?php bigdiamond_white_prestige_render_breadcrumbs(); ?>

<section class="bdwp-section bdwp-section--faq" itemscope itemtype="https://schema.org/FAQPage">
        <div class="bdwp-section__inner">
                <?php foreach ( $args['groups'] as $group ) : ?>
                        <div class="bdwp-faq-group">
                                <h2 class="bdwp-section__title"><?php echo esc_html( $group['title'] ); ?></h2>
                                <div class="bdwp-faq">
                                        <?php foreach ( $group['items'] as $item ) : ?>
                                                <article class="bdwp-faq__item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                                                        <button class="bdwp-faq__toggle" type="button" aria-expanded="false">
                                                                <span itemprop="name"><?php echo esc_html( $item['question'] ); ?></span>
                                                        </button>
                                                        <div class="bdwp-faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" hidden>
                                                                <p itemprop="text"><?php echo esc_html( $item['answer'] ); ?></p>
                                                        </div>
                                                </article>
                                        <?php endforeach; ?>
                                </div>
                        </div>
                <?php endforeach; ?>
        </div>
</section>

<?php if ( ! empty( $args['cta_bar'] ) ) :
        $cta = $args['cta_bar'];
        ?>
        <aside class="bdwp-sticky-cta" role="complementary" aria-label="<?php esc_attr_e( 'Rezerwacja terminu', 'bigdiamond-white-prestige' ); ?>">
                <div class="bdwp-sticky-cta__inner">
                        <p class="bdwp-sticky-cta__title"><?php echo esc_html( $cta['title'] ?? __( 'Umów konsultację jubilerską', 'bigdiamond-white-prestige' ) ); ?></p>
                        <div class="bdwp-sticky-cta__actions">
                                <?php if ( ! empty( $cta['primary'] ) ) : ?>
                                        <a class="btn btn--gold" href="<?php echo esc_url( $cta['primary']['url'] ); ?>"><?php echo esc_html( $cta['primary']['label'] ); ?></a>
                                <?php endif; ?>
                                <?php if ( ! empty( $cta['secondary'] ) ) : ?>
                                        <a class="btn" href="<?php echo esc_url( $cta['secondary']['url'] ); ?>"><?php echo esc_html( $cta['secondary']['label'] ); ?></a>
                                <?php endif; ?>
                        </div>
                </div>
        </aside>
<?php endif; ?>

<section class="bdwp-related" aria-labelledby="bdwp-related-title">
        <div class="bdwp-section__inner">
                <h2 id="bdwp-related-title" class="bdwp-section__title"><?php esc_html_e( 'Zobacz również', 'bigdiamond-white-prestige' ); ?></h2>
                <div class="bdwp-related__links">
                        <a class="bdwp-related__item" href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>"><?php esc_html_e( 'Kontakt z concierge', 'bigdiamond-white-prestige' ); ?></a>
                        <a class="bdwp-related__item" href="<?php echo esc_url( home_url( '/na-zamowienie/' ) ); ?>"><?php esc_html_e( 'Projekt biżuterii 3D', 'bigdiamond-white-prestige' ); ?></a>
                        <a class="bdwp-related__item" href="<?php echo esc_url( home_url( '/obraczki-slubne/' ) ); ?>"><?php esc_html_e( 'Obrączki premium', 'bigdiamond-white-prestige' ); ?></a>
                </div>
        </div>
</section>
