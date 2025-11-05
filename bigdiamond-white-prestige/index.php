<?php
/**
 * Fallback template.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

if ( is_home() ) {
	require get_stylesheet_directory() . '/home.php';
	return;
}

get_header();
?>
<main id="primary" class="site-main bdwp-main" role="main" aria-label="<?php esc_attr_e( 'Główna zawartość', 'bigdiamond-white-prestige' ); ?>">
        <section class="bdwp-generic page-container">
                <header>
                        <h1 class="page-title"><?php esc_html_e( 'BigDIAMOND White Prestige', 'bigdiamond-white-prestige' ); ?></h1>
                </header>
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/blog/post-card', null, array( 'post_id' => get_the_ID() ) );
			}
			?>
		<?php else : ?>
			<p><?php esc_html_e( 'Brak treści do wyświetlenia.', 'bigdiamond-white-prestige' ); ?></p>
		<?php endif; ?>
	</section>
</main>
<?php
get_footer();
