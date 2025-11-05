<?php
/**
 * BigDIAMOND White Prestige — Szablon Pojedynczego Produktu
 *
 * Ten plik nadpisuje domyślny szablon WooCommerce, aby dopasować go
 * do struktury BEM i stylów z 'woo.min.css' (klasy .bdwp-).
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

while ( have_posts() ) :
	the_post();
	global $product;

	/**
	 * Hook: woocommerce_before_single_product.
	 * Domyślnie zawiera `woocommerce_breadcrumb` (okruszki).
	 * Nasz plik functions.php już je opakowuje w klasę .bdwp-breadcrumbs.
	 */
	do_action( 'woocommerce_before_single_product' );

	if ( post_password_required() ) {
		echo get_the_password_form(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		get_footer( 'shop' );
		return;
	}
?>
	<main id="primary" class="site-main bdwp-main" role="main">
		<div class="bdwp-single-product-wrap">

			<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'bdwp-single-product', $product ); ?>>

				<div class="bdwp-single-product__gallery">
					<?php
					/**
					 * Hook: woocommerce_before_single_product_summary.
					 * @hooked woocommerce_show_product_sale_flash - 10
					 * @hooked woocommerce_show_product_images - 20 (Renderuje galerię)
					 */
					do_action( 'woocommerce_before_single_product_summary' );
					?>
				</div>

				<div class="bdwp-single-product__summary">
					
					<div class="bdwp-single-product__summary-inner">
						<?php
						/**
						 * Hook: woocommerce_single_product_summary.
						 * Renderuje: Tytuł, Cenę, Opis, Opcje, Przycisk "Dodaj do koszyka" i Meta.
						 *
						 * @hooked woocommerce_template_single_title - 5
						 * @hooked woocommerce_template_single_rating - 8 (przesunęliśmy w functions.php)
						 * @hooked woocommerce_template_single_price - 12 (przesunęliśmy w functions.php)
						 * @hooked woocommerce_template_single_excerpt - 20
						 * @hooked woocommerce_template_single_add_to_cart - 30
						 * @hooked bdwp_render_product_trust_signals - 45 (Twoje USP/Trust badges)
						 * @hooked woocommerce_template_single_meta - 40
						 * @hooked woocommerce_template_single_sharing - 50
						 */
						do_action( 'woocommerce_single_product_summary' );
						?>
					</div>
				</div>

				<?php
				/**
				 * Hook: woocommerce_after_single_product_summary.
				 * Renderuje: Zakładki (Opis, Certyfikat, FAQ), Produkty powiązane (Related), Upsells.
				 * Te elementy renderują się na pełnej szerokości POD siatką.
				 *
				 * @hooked woocommerce_output_product_data_tabs - 10
				 * @hooked woocommerce_upsell_display - 15
				 * @hooked woocommerce_output_related_products - 20
				 * @hooked bigdiamond_white_prestige_recently_viewed_products - 25 (Twoja funkcja)
				 */
				do_action( 'woocommerce_after_single_product_summary' );
				?>

			</div></div><?php do_action( 'woocommerce_after_single_product' ); ?>

	</main>

<?php
endwhile; // koniec pętli.

get_footer( 'shop' );