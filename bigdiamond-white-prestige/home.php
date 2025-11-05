<?php
/**
 * Blog index template (Aktualności).
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

get_header();
?>
<main id="primary" class="site-main bdwp-main" role="main" aria-label="<?php esc_attr_e( 'Główna zawartość', 'bigdiamond-white-prestige' ); ?>">
        <section class="bdwp-blog page-container" aria-labelledby="bdwp-blog-heading">
                <header class="bdwp-blog__header">
                        <p class="bdwp-kicker section-eyebrow"><?php esc_html_e( 'Aktualności i porady', 'bigdiamond-white-prestige' ); ?></p>
                        <h1 id="bdwp-blog-heading" class="page-title"><?php esc_html_e( 'Magazyn BigDIAMOND', 'bigdiamond-white-prestige' ); ?></h1>
                        <p class="page-subtitle"><?php esc_html_e( 'Poznaj historie naszych klientów, przewodniki po diamentach i wskazówki dotyczące pielęgnacji biżuterii.', 'bigdiamond-white-prestige' ); ?></p>
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
			<p><?php esc_html_e( 'Brak wpisów do wyświetlenia. Wróć wkrótce po nowe inspiracje.', 'bigdiamond-white-prestige' ); ?></p>
		<?php endif; ?>
	</section>
</main>
<?php
get_footer();
