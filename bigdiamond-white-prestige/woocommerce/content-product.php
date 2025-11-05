<?php
/**
 * Loop content – single product card on archives.
 */
defined('ABSPATH') || exit;

global $product;
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( 'bdwp-product-card' ); ?>>
	<div class="bdwp-product-card__inner">

		<a href="<?php the_permalink(); ?>" class="bdwp-product-card__image" aria-label="<?php the_title_attribute(); ?>">
			<?php
			// „Promocja” / Sale badge (jeśli jest)
			woocommerce_show_product_loop_sale_flash();

			// Miniatura
			woocommerce_template_loop_product_thumbnail();
			?>
		</a>

		<div class="bdwp-product-card__body">
			<h2 class="woocommerce-loop-product__title bdwp-product-card__title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>

			<div class="bdwp-product-card__price">
				<?php woocommerce_template_loop_price(); ?>
			</div>
		</div>

		<div class="bdwp-product-card__footer">
			<?php woocommerce_template_loop_add_to_cart(); ?>
		</div>

	</div>
</li>
