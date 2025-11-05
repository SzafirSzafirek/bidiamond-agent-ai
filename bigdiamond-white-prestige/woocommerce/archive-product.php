<?php
/**
 * WooCommerce: Shop / Product Archive
 */
defined('ABSPATH') || exit;

get_header(); ?>

<main id="primary" class="bdwp-product-archive">
	<header class="bdwp-product-archive__header">
		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
		<?php endif; ?>

		<?php
		// Opisy sklepu/kategorii (z Woo)
		do_action( 'woocommerce_archive_description' );
		?>
	</header>

	<?php if ( woocommerce_product_loop() ) : ?>

		<?php
		// Licznik wyników, sortowanie itd.
		do_action( 'woocommerce_before_shop_loop' );
		?>

		<?php woocommerce_product_loop_start(); ?>

			<?php if ( wc_get_loop_prop( 'total' ) ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php
					do_action( 'woocommerce_shop_loop' );
					wc_get_template_part( 'content', 'product' );
					?>
				<?php endwhile; ?>
			<?php endif; ?>

		<?php woocommerce_product_loop_end(); ?>

		<?php
		// Paginacja
		do_action( 'woocommerce_after_shop_loop' );
		?>

	<?php else : ?>

		<?php do_action( 'woocommerce_no_products_found' ); ?>

	<?php endif; ?>
</main>

<?php get_footer();
