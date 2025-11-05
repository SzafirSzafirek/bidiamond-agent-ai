<?php
/**
 * Cart page template override for enhanced UX.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' );
?>
<section class="bdwp-cart" aria-labelledby="bdwp-cart-heading">
	<h1 id="bdwp-cart-heading"><?php esc_html_e( 'Twój koszyk', 'bigdiamond-white-prestige' ); ?></h1>
	<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
		<?php do_action( 'woocommerce_before_cart_table' ); ?>
		<div class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" role="table">
			<div class="bdwp-cart__head" role="row">
				<span class="bdwp-cart__col bdwp-cart__col--product" role="columnheader"><?php esc_html_e( 'Produkt', 'woocommerce' ); ?></span>
				<span class="bdwp-cart__col bdwp-cart__col--price" role="columnheader"><?php esc_html_e( 'Cena', 'woocommerce' ); ?></span>
				<span class="bdwp-cart__col bdwp-cart__col--quantity" role="columnheader"><?php esc_html_e( 'Ilość', 'woocommerce' ); ?></span>
				<span class="bdwp-cart__col bdwp-cart__col--subtotal" role="columnheader"><?php esc_html_e( 'Razem', 'woocommerce' ); ?></span>
			</div>
			<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) : ?>
				<?php
                                $product          = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                $product_id       = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                                $is_visible       = $product && $product->is_visible();
                                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $is_visible ? $product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<div class="bdwp-cart__row" role="row">
					<div class="bdwp-cart__cell bdwp-cart__cell--product" role="cell" data-title="<?php esc_attr_e( 'Produkt', 'woocommerce' ); ?>">
						<?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $product ? $product->get_image( 'woocommerce_thumbnail', array( 'loading' => 'lazy', 'decoding' => 'async' ) ) : '', $cart_item, $cart_item_key );
						if ( ! $product_permalink ) {
							echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						} else {
							printf( '<a href="%s" class="bdwp-cart__thumb">%s</a>', esc_url( $product_permalink ), $thumbnail );
						}
						$name = apply_filters( 'woocommerce_cart_item_name', $product ? $product->get_name() : '', $cart_item, $cart_item_key );
						if ( ! $product_permalink ) {
							echo wp_kses_post( sprintf( '<span class="bdwp-cart__product-name">%s</span>', $name ) );
						} else {
							printf( '<a href="%s" class="bdwp-cart__product-name">%s</a>', esc_url( $product_permalink ), wp_kses_post( $name ) );
						}
                                                echo wc_get_formatted_cart_item_data( $cart_item );
                                                echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="bdwp-cart__remove" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_attr__( 'Usuń produkt', 'bigdiamond-white-prestige' ), esc_attr( $product_id ), esc_attr( $cart_item_key ), esc_attr( $product ? $product->get_sku() : '' ) ), $cart_item_key );
                                                ?>
                                        </div>
                                        <div class="bdwp-cart__cell bdwp-cart__cell--price" role="cell" data-title="<?php esc_attr_e( 'Cena', 'woocommerce' ); ?>"><?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $product ), $cart_item, $cart_item_key ); ?></div>
					<div class="bdwp-cart__cell bdwp-cart__cell--quantity" role="cell" data-title="<?php esc_attr_e( 'Ilość', 'woocommerce' ); ?>"><?php
					if ( $product && $product->is_sold_individually() ) {
						$min_quantity = 1;
						$max_quantity = 1;
					} else {
						$min_quantity = 0;
						$max_quantity = $product ? $product->get_max_purchase_quantity() : 0;
					}
					$quantity = woocommerce_quantity_input( array(
						'input_name'  => "cart[{$cart_item_key}][qty]",
						'input_value' => $cart_item['quantity'],
						'max_value'   => $max_quantity,
						'min_value'   => $min_quantity,
						'product_name' => $product ? $product->get_name() : '',
					), '', false );
					echo $quantity; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					?></div>
					<div class="bdwp-cart__cell bdwp-cart__cell--subtotal" role="cell" data-title="<?php esc_attr_e( 'Razem', 'woocommerce' ); ?>"><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?></div>
				</div>
			<?php endforeach; ?>
		</div>
		<?php do_action( 'woocommerce_cart_contents' ); ?>
		<div class="bdwp-cart__actions">
			<?php if ( wc_coupons_enabled() ) : ?>
				<div class="bdwp-cart__coupon">
					<label for="coupon_code"><?php esc_html_e( 'Kod rabatowy', 'bigdiamond-white-prestige' ); ?></label>
					<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Wpisz kod', 'bigdiamond-white-prestige' ); ?>" />
					<button type="submit" class="bdwp-button bdwp-button--light" name="apply_coupon" value="<?php esc_attr_e( 'Zastosuj kupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Zastosuj', 'woocommerce' ); ?></button>
				</div>
			<?php endif; ?>
			<div class="bdwp-cart__update">
				<button type="submit" class="bdwp-button" name="update_cart" value="<?php esc_attr_e( 'Zaktualizuj koszyk', 'woocommerce' ); ?>"><?php esc_html_e( 'Zaktualizuj koszyk', 'woocommerce' ); ?></button>
				<?php do_action( 'woocommerce_cart_actions' ); ?>
			</div>
			<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
		</div>
		<?php do_action( 'woocommerce_after_cart_table' ); ?>
	</form>
	<div class="bdwp-cart__summary">
		<?php do_action( 'woocommerce_cart_collaterals' ); ?>
		<div class="bdwp-cart__trust">
			<div class="bdwp-cart__trust-item">
				<span class="bdwp-cart__icon"><?php echo bigdiamond_white_prestige_get_icon( 'shield' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<p><?php esc_html_e( 'Transakcje szyfrowane certyfikatem SSL', 'bigdiamond-white-prestige' ); ?></p>
			</div>
			<div class="bdwp-cart__trust-item">
				<p><?php esc_html_e( '14 dni na zwrot produktów kolekcyjnych oraz darmowa korekta rozmiaru.', 'bigdiamond-white-prestige' ); ?></p>
			</div>
		</div>
	</div>
</section>
<?php
do_action( 'woocommerce_after_cart' );
