<?php
/**
 * Header brand (logo image)
 * @package BigDIAMOND_White_Prestige
 */
declare( strict_types=1 );

$logo_uri = get_stylesheet_directory_uri() . '/assets/img/logo2.png';
?>
<a class="bdwp-header__logo-link brand" href="<?= esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php esc_attr_e( 'Przejdź do strony głównej BigDIAMOND', 'bigdiamond-white-prestige' ); ?>">
  <img
    class="brand__img"
    src="<?= esc_url( $logo_uri ); ?>"
    alt="<?php esc_attr_e( 'BigDIAMOND — jubiler Kraków', 'bigdiamond-white-prestige' ); ?>"
    width="256" height="64"
    loading="eager" fetchpriority="high" decoding="async"
  />
  <span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span>
</a>
