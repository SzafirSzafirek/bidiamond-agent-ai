<?php
/**
 * Template Name: Kontakt
 * Description: Strona kontaktowa BigDIAMOND White Prestige.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

get_header();
?>
<main id="primary" class="site-main bdwp-main" role="main" aria-label="<?php esc_attr_e( 'Główna zawartość', 'bigdiamond-white-prestige' ); ?>">
<?php get_template_part( 'template-parts/contact-form' ); ?>
</main>
<?php
get_footer();
