<?php
/**
 * Template Name: Oferta
 * Description: Dedicated layout for the offer page.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

get_header();
?>
<main id="primary" class="site-main bdwp-main" role="main" aria-label="<?php esc_attr_e( 'Główna zawartość', 'bigdiamond-white-prestige' ); ?>">
	<header class="page-container">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>
	<?php get_template_part( 'template-parts/sections/offer' ); ?>
</main>
<?php
get_footer();
