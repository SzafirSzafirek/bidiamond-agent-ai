<?php
/**
 * Hero (full black) + bridge z 3 kategoriami nachodzącymi między sekcjami
 * @package BigDIAMOND_White_Prestige
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

$hero_img = get_stylesheet_directory_uri() . '/assets/img/kobieta.webp';

// Top 3 nadrzędne kategorie Woo (fallback do placeholdera)
$top_cats = get_terms([
  'taxonomy'   => 'product_cat',
  'hide_empty' => true,
  'parent'     => 0,
  'number'     => 3,
  'orderby'    => 'count',
  'order'      => 'DESC',
]);

?>
<section class="bdwp-hero" role="region" aria-label="<?php esc_attr_e('Hero — BigDIAMOND', 'bigdiamond'); ?>">
  <div class="bdwp-hero__inner container">
    <div class="bdwp-hero__content">
      <h1 class="bdwp-hero__title"><?php echo esc_html__( 'Biżuteria, która mówi Twoją historię', 'bigdiamond' ); ?></h1>
      <p class="bdwp-hero__lead"><?php echo esc_html__( 'Ręcznie w Krakowie. Złoto i kamienie szlachetne klasy premium.', 'bigdiamond' ); ?></p>
      <div class="bdwp-hero__ctas">
        <a class="bdwp-btn bdwp-btn--outline-gold" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
          <?php esc_html_e( 'Zobacz kolekcję', 'bigdiamond' ); ?>
        </a>
        <a class="bdwp-link--muted" href="<?php echo esc_url( home_url( '/kontakt' ) ); ?>">
          <?php esc_html_e( 'Umów wizytę w pracowni', 'bigdiamond' ); ?>
        </a>
      </div>
    </div>

    <figure class="bdwp-hero__figure" aria-hidden="true">
      <img class="bdwp-hero__img"
           src="<?php echo esc_url( $hero_img ); ?>"
           alt=""
           width="1536" height="2304"
           fetchpriority="high" decoding="async" loading="eager" />
    </figure>
  </div>
</section>

<!-- BRIDGE: karty kategorii nachodzące między hero (czarnym) a kolejną sekcją (jasną) -->
<section class="bdwp-hero-bridge bdwp-hero-cats" aria-label="<?php esc_attr_e('Kategorie — skróty', 'bigdiamond'); ?>">
  <div class="container">
    <ul class="bdwp-bridge-cats__grid">
      <?php foreach ( $top_cats as $term ) :
        $thumb_id = (int) get_term_meta( $term->term_id, 'thumbnail_id', true );
        $img_src  = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'large' ) : get_stylesheet_directory_uri() . '/assets/img/placeholder-4x3.jpg';
      ?>
        <li class="bdwp-bridge-cats__item">
          <a class="bdwp-bridge-cats__card" href="<?php echo esc_url( get_term_link( $term ) ); ?>">
            <span class="bdwp-bridge-cats__media">
              <img src="<?php echo esc_url( $img_src ); ?>" alt="<?php echo esc_attr( $term->name ); ?>" width="800" height="600" loading="lazy" decoding="async" />
            </span>
            <span class="bdwp-bridge-cats__label"><?php echo esc_html( $term->name ); ?></span>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
