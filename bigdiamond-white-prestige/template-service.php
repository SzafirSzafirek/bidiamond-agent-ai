<?php
/**
 * Generic service page layout.
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
                'eyebrow'     => '',
                'title'       => get_the_title(),
                'subtitle'    => '',
                'description' => '',
                'cta'         => array(),
                'secondary'   => array(),
        ),
        'sections' => array(),
        'faq'      => array(),
        'cta_bar'  => array(),
        'schema'   => array(),
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
<section class="bdwp-hero-service" aria-labelledby="service-hero-title">
        <div class="bdwp-hero-service__container">
                <div class="bdwp-hero-service__copy">
                        <?php if ( ! empty( $hero['eyebrow'] ) ) : ?>
                                <p class="bdwp-eyebrow"><?php echo esc_html( $hero['eyebrow'] ); ?></p>
                        <?php endif; ?>
                        <h1 id="service-hero-title" class="bdwp-hero-service__title"><?php echo esc_html( $hero['title'] ); ?></h1>
                        <?php if ( ! empty( $hero['subtitle'] ) ) : ?>
                                <p class="bdwp-hero-service__subtitle"><?php echo esc_html( $hero['subtitle'] ); ?></p>
                        <?php endif; ?>
                        <?php if ( ! empty( $hero['description'] ) ) : ?>
                                <p class="bdwp-hero-service__description"><?php echo esc_html( $hero['description'] ); ?></p>
                        <?php endif; ?>
                        <div class="bdwp-hero-service__actions">
                                <?php if ( ! empty( $hero['cta'] ) ) : ?>
                                        <a class="btn btn--gold" href="<?php echo esc_url( $hero['cta']['url'] ?? '#' ); ?>">
                                                <?php echo esc_html( $hero['cta']['label'] ?? __( 'Umów wizytę', 'bigdiamond-white-prestige' ) ); ?>
                                        </a>
                                <?php endif; ?>
                                <?php if ( ! empty( $hero['secondary'] ) ) : ?>
                                        <a class="btn" href="<?php echo esc_url( $hero['secondary']['url'] ?? '#' ); ?>">
                                                <?php echo esc_html( $hero['secondary']['label'] ?? __( 'Stwórz projekt', 'bigdiamond-white-prestige' ) ); ?>
                                        </a>
                                <?php endif; ?>
                        </div>
                </div>
                <div class="bdwp-hero-service__media" aria-hidden="true">
                        <span class="bdwp-hero-service__badge">BigDIAMOND</span>
                </div>
        </div>
</section>

<?php bigdiamond_white_prestige_render_breadcrumbs(); ?>

<?php foreach ( $args['sections'] as $section ) :
        $layout = $section['layout'] ?? 'text';
        $title  = $section['title'] ?? '';
        $intro  = $section['intro'] ?? '';
        $id     = $section['id'] ?? '';
        ?>
        <section class="bdwp-section bdwp-section--<?php echo esc_attr( $layout ); ?>"<?php echo $id ? ' id="' . esc_attr( $id ) . '"' : ''; ?>>
                <div class="bdwp-section__inner">
                        <?php if ( $title ) : ?>
                                <h2 class="bdwp-section__title"><?php echo esc_html( $title ); ?></h2>
                        <?php endif; ?>
                        <?php if ( $intro ) : ?>
                                <p class="bdwp-section__intro"><?php echo esc_html( $intro ); ?></p>
                        <?php endif; ?>

                        <?php if ( 'grid' === $layout && ! empty( $section['items'] ) ) : ?>
                                <div class="bdwp-section__grid">
                                        <?php foreach ( $section['items'] as $item ) : ?>
                                                <article class="bdwp-card">
                                                        <?php if ( ! empty( $item['eyebrow'] ) ) : ?>
                                                                <p class="bdwp-card__eyebrow"><?php echo esc_html( $item['eyebrow'] ); ?></p>
                                                        <?php endif; ?>
                                                        <h3 class="bdwp-card__title"><?php echo esc_html( $item['title'] ); ?></h3>
                                                        <p class="bdwp-card__text"><?php echo esc_html( $item['text'] ); ?></p>
                                                        <?php if ( ! empty( $item['cta'] ) ) : ?>
                                                                <a class="bdwp-card__cta" href="<?php echo esc_url( $item['cta']['url'] ); ?>">
                                                                        <?php echo esc_html( $item['cta']['label'] ); ?>
                                                                </a>
                                                        <?php endif; ?>
                                                </article>
                                        <?php endforeach; ?>
                                </div>
                        <?php elseif ( 'steps' === $layout && ! empty( $section['items'] ) ) : ?>
                                <ol class="bdwp-steps">
                                        <?php foreach ( $section['items'] as $item ) : ?>
                                                <li class="bdwp-steps__item">
                                                        <h3 class="bdwp-steps__title"><?php echo esc_html( $item['title'] ); ?></h3>
                                                        <p class="bdwp-steps__text"><?php echo esc_html( $item['text'] ); ?></p>
                                                </li>
                                        <?php endforeach; ?>
                                </ol>
                        <?php elseif ( 'stats' === $layout && ! empty( $section['items'] ) ) : ?>
                                <dl class="bdwp-stats">
                                        <?php foreach ( $section['items'] as $item ) : ?>
                                                <div class="bdwp-stats__item">
                                                        <dt class="bdwp-stats__value"><?php echo esc_html( $item['value'] ); ?></dt>
                                                        <dd class="bdwp-stats__label"><?php echo esc_html( $item['label'] ); ?></dd>
                                                </div>
                                        <?php endforeach; ?>
                                </dl>
                        <?php elseif ( 'faq' === $layout && ! empty( $section['items'] ) ) : ?>
                                <div class="bdwp-faq" itemscope itemtype="https://schema.org/FAQPage">
                                        <?php foreach ( $section['items'] as $item ) : ?>
                                                <article class="bdwp-faq__item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                                                        <h3 class="bdwp-faq__question" itemprop="name"><?php echo esc_html( $item['question'] ); ?></h3>
                                                        <div class="bdwp-faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                                                                <p itemprop="text"><?php echo esc_html( $item['answer'] ); ?></p>
                                                        </div>
                                                </article>
                                        <?php endforeach; ?>
                                </div>
                        <?php elseif ( ! empty( $section['content'] ) ) : ?>
                                <?php foreach ( (array) $section['content'] as $paragraph ) : ?>
                                        <p class="bdwp-section__paragraph"><?php echo esc_html( $paragraph ); ?></p>
                                <?php endforeach; ?>
                        <?php endif; ?>
                </div>
        </section>
<?php endforeach; ?>

<?php if ( ! empty( $args['faq'] ) ) : ?>
        <section class="bdwp-section bdwp-section--faq" id="faq">
                <div class="bdwp-section__inner">
                        <h2 class="bdwp-section__title"><?php esc_html_e( 'Najczęstsze pytania klientów BigDIAMOND', 'bigdiamond-white-prestige' ); ?></h2>
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

<?php if ( ! empty( $args['cta_bar'] ) ) :
        $bar = $args['cta_bar'];
        ?>
        <aside class="bdwp-sticky-cta" role="complementary" aria-label="<?php esc_attr_e( 'Szybki kontakt', 'bigdiamond-white-prestige' ); ?>">
                <div class="bdwp-sticky-cta__inner">
                        <p class="bdwp-sticky-cta__title"><?php echo esc_html( $bar['title'] ?? __( 'Umów wizytę w pracowni', 'bigdiamond-white-prestige' ) ); ?></p>
                        <div class="bdwp-sticky-cta__actions">
                                <?php if ( ! empty( $bar['primary'] ) ) : ?>
                                        <a class="btn btn--gold" href="<?php echo esc_url( $bar['primary']['url'] ); ?>"><?php echo esc_html( $bar['primary']['label'] ); ?></a>
                                <?php endif; ?>
                                <?php if ( ! empty( $bar['secondary'] ) ) : ?>
                                        <a class="btn" href="<?php echo esc_url( $bar['secondary']['url'] ); ?>"><?php echo esc_html( $bar['secondary']['label'] ); ?></a>
                                <?php endif; ?>
                        </div>
                </div>
        </aside>
<?php endif; ?>

<section class="bdwp-related" aria-labelledby="bdwp-related-title">
        <div class="bdwp-section__inner">
                <h2 id="bdwp-related-title" class="bdwp-section__title"><?php esc_html_e( 'Zobacz również', 'bigdiamond-white-prestige' ); ?></h2>
                <div class="bdwp-related__links">
                        <?php
                        $related_links = $args['meta']['related'] ?? array(
                                array(
                                        'label' => __( 'Pierścionki zaręczynowe', 'bigdiamond-white-prestige' ),
                                        'url'   => home_url( '/pierscionki-zareczynowe/' ),
                                ),
                                array(
                                        'label' => __( 'Obrączki ślubne', 'bigdiamond-white-prestige' ),
                                        'url'   => home_url( '/obraczki-slubne/' ),
                                ),
                                array(
                                        'label' => __( 'Blog BigDIAMOND', 'bigdiamond-white-prestige' ),
                                        'url'   => home_url( '/blog/' ),
                                ),
                        );

                        foreach ( $related_links as $link ) {
                                echo '<a class="bdwp-related__item" href="' . esc_url( $link['url'] ) . '">' . esc_html( $link['label'] ) . '</a>';
                        }
                        ?>
                </div>
        </div>
</section>
