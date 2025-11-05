<?php
/**
 * Template Name: O nas
 * Description: Strona prezentująca historię i wartości BigDIAMOND.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

get_header();
?>
<main id="primary" class="site-main bdwp-main" role="main" aria-label="<?php esc_attr_e( 'Główna zawartość', 'bigdiamond-white-prestige' ); ?>">
<?php get_template_part( 'template-parts/about' ); ?>
</main>
<?php
get_footer();
