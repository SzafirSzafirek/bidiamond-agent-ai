<?php
/**
 * Front page template assembling core sections.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

get_header();
?>
<main id="primary" class="site-main bdwp-main" role="main" aria-label="<?php esc_attr_e( 'Główna zawartość', 'bigdiamond-white-prestige' ); ?>">
	<?php get_template_part( 'template-parts/hero' ); ?>
	<div id="bigdiamond-agent" class="bdwp-ai-placeholder" role="region" aria-label="BigDIAMOND Agent"></div>
	<?php get_template_part( 'template-parts/sections/offer' ); ?>
	<?php get_template_part( 'template-parts/sections/gallery' ); ?>
</main>
<?php
get_footer();
