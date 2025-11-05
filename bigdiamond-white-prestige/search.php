<?php
/**
 * Search results template.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

get_header();
?>
<main id="primary" class="site-main bdwp-main" role="main" aria-label="<?php esc_attr_e( 'Główna zawartość', 'bigdiamond-white-prestige' ); ?>">
        <section class="bdwp-search page-container" aria-labelledby="bdwp-search-heading">
                <header class="bdwp-search__header">
                        <h1 id="bdwp-search-heading" class="page-title"><?php printf( esc_html__( 'Wyniki wyszukiwania dla: %s', 'bigdiamond-white-prestige' ), esc_html( get_search_query() ) ); ?></h1>
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
			<nav class="bdwp-pagination" aria-label="<?php esc_attr_e( 'Nawigacja wyników wyszukiwania', 'bigdiamond-white-prestige' ); ?>">
				<?php echo wp_kses_post( paginate_links( array( 'prev_text' => '←', 'next_text' => '→' ) ) ); ?>
			</nav>
		<?php else : ?>
			<p><?php esc_html_e( 'Nie znaleźliśmy wyników. Spróbuj wyszukać inne słowa kluczowe.', 'bigdiamond-white-prestige' ); ?></p>
		<?php endif; ?>
	</section>
</main>
<?php
get_footer();
