<?php
/**
 * Archive template for categories, tags and custom taxonomies.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

get_header();
?>
<main id="primary" class="site-main bdwp-main" role="main" aria-label="<?php esc_attr_e( 'Główna zawartość', 'bigdiamond-white-prestige' ); ?>">
        <section class="bdwp-blog-archive page-container" aria-labelledby="bdwp-archive-heading">
                <header class="bdwp-blog-archive__header">
                        <h1 id="bdwp-archive-heading" class="page-title"><?php the_archive_title(); ?></h1>
                        <div class="bdwp-blog-archive__description page-subtitle"><?php the_archive_description(); ?></div>
		</header>
		<?php if ( have_posts() ) : ?>
			<div class="bdwp-blog__grid">
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/blog/post-card', null, array( 'post_id' => get_the_ID() ) );
				}
				?>
			</div>
			<nav class="bdwp-pagination" aria-label="<?php esc_attr_e( 'Nawigacja wpisów', 'bigdiamond-white-prestige' ); ?>">
				<?php echo wp_kses_post( paginate_links( array( 'prev_text' => '←', 'next_text' => '→' ) ) ); ?>
			</nav>
		<?php else : ?>
			<p><?php esc_html_e( 'Brak wpisów w tej sekcji.', 'bigdiamond-white-prestige' ); ?></p>
		<?php endif; ?>
	</section>
</main>
<?php
get_footer();
