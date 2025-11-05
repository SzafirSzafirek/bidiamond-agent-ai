<?php
/**
 * Template for single blog posts.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

if ( ! function_exists( 'bigdiamond_white_prestige_prepare_post_content' ) ) {
	/**
	 * Prepare content with anchors and table of contents items.
	 *
	 * @param string $content Post content.
	 *
	 * @return array{content:string,toc:array<int,array<string,string>>}
	 */
	function bigdiamond_white_prestige_prepare_post_content( string $content ): array {
		$toc_items = array();
		$counter   = array();

		$processed = preg_replace_callback(
			'/(<h([2-3])[^>]*>)(.*?)(<\/h\2>)/is',
			static function ( array $matches ) use ( &$toc_items, &$counter ) {
				$text   = wp_strip_all_tags( $matches[3] );
				$slug   = sanitize_title( $text );
				$count  = $counter[ $slug ] ?? 0;
				$anchor = $count ? sprintf( '%s-%d', $slug, $count ) : $slug;
				$counter[ $slug ] = $count + 1;

				$toc_items[] = array(
					'id'    => $anchor,
					'label' => $text,
				);

				return sprintf(
					'<h%1$s id="%2$s">%3$s</h%1$s>',
					esc_attr( $matches[2] ),
					esc_attr( $anchor ),
					$matches[3]
				);
			},
			$content
		);

		return array(
			'content' => $processed,
			'toc'     => $toc_items,
		);
	}
}

get_header();
?>
<main id="primary" class="site-main bdwp-main" role="main" aria-label="<?php esc_attr_e( 'Główna zawartość', 'bigdiamond-white-prestige' ); ?>">
	<?php
	while ( have_posts() ) {
		the_post();
		$prepared = bigdiamond_white_prestige_prepare_post_content( apply_filters( 'the_content', get_the_content() ) );
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'bdwp-article' ); ?>>
			<header class="bdwp-article__header">
				<nav class="bdwp-breadcrumbs" aria-label="<?php esc_attr_e( 'Okruszki nawigacyjne', 'bigdiamond-white-prestige' ); ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Strona główna', 'bigdiamond-white-prestige' ); ?></a>
					<span aria-hidden="true">/</span>
					<?php if ( get_option( 'page_for_posts' ) ) : ?>
						<a href="<?php echo esc_url( get_permalink( (int) get_option( 'page_for_posts' ) ) ); ?>"><?php esc_html_e( 'Blog', 'bigdiamond-white-prestige' ); ?></a>
						<span aria-hidden="true">/</span>
					<?php endif; ?>
					<span><?php the_title(); ?></span>
				</nav>
				<h1 class="bdwp-article__title"><?php the_title(); ?></h1>
				<p class="bdwp-article__meta">
					<span><?php echo esc_html( get_the_date() ); ?></span>
					<span><?php printf( esc_html__( 'Autor: %s', 'bigdiamond-white-prestige' ), esc_html( get_the_author() ) ); ?></span>
				</p>
				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="bdwp-article__featured">
						<?php the_post_thumbnail( 'full', array( 'loading' => 'eager', 'fetchpriority' => 'high' ) ); ?>
					</figure>
				<?php endif; ?>
			</header>
			<?php if ( ! empty( $prepared['toc'] ) ) : ?>
				<nav class="bdwp-article__toc" aria-label="<?php esc_attr_e( 'Spis treści', 'bigdiamond-white-prestige' ); ?>">
					<h2><?php esc_html_e( 'Spis treści', 'bigdiamond-white-prestige' ); ?></h2>
					<ol>
						<?php foreach ( $prepared['toc'] as $item ) : ?>
							<li><a href="#<?php echo esc_attr( $item['id'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a></li>
						<?php endforeach; ?>
					</ol>
				</nav>
			<?php endif; ?>
			<div class="bdwp-article__content">
				<?php echo wp_kses_post( $prepared['content'] ); ?>
			</div>
			<footer class="bdwp-article__footer">
				<section class="bdwp-article__share">
					<h2><?php esc_html_e( 'Udostępnij artykuł', 'bigdiamond-white-prestige' ); ?></h2>
					<ul>
						<li><a href="<?php echo esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . rawurlencode( get_permalink() ) ); ?>">Facebook</a></li>
						<li><a href="<?php echo esc_url( 'https://twitter.com/intent/tweet?url=' . rawurlencode( get_permalink() ) . '&text=' . rawurlencode( get_the_title() ) ); ?>">X (Twitter)</a></li>
						<li><a href="mailto:?subject=<?php echo rawurlencode( get_the_title() ); ?>&body=<?php echo rawurlencode( get_permalink() ); ?>"><?php esc_html_e( 'Wyślij e-mail', 'bigdiamond-white-prestige' ); ?></a></li>
					</ul>
				</section>
			</footer>
		</article>
		<section class="bdwp-related" aria-labelledby="bdwp-related-heading">
			<h2 id="bdwp-related-heading"><?php esc_html_e( 'Powiązane artykuły', 'bigdiamond-white-prestige' ); ?></h2>
			<div class="bdwp-blog__grid">
				<?php
				$related = get_posts(
					array(
						'post_type'      => 'post',
						'posts_per_page' => 3,
						'post__not_in'   => array( get_the_ID() ),
						'category__in'   => wp_get_post_categories( get_the_ID() ),
					)
				);
				if ( $related ) {
					foreach ( $related as $related_post ) {
						get_template_part( 'template-parts/blog/post-card', null, array( 'post_id' => $related_post->ID ) );
					}
				} else {
					echo '<p>' . esc_html__( 'Brak powiązanych artykułów.', 'bigdiamond-white-prestige' ) . '</p>';
				}
				?>
			</div>
		</section>
	<?php
	}
	?>
</main>
<?php
get_footer();

