<?php
/**
 * Checkout form custom layout.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

defined( 'ABSPATH' ) || exit;

$checkout = WC()->checkout();

do_action( 'woocommerce_before_checkout_form', $checkout );

if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'Musisz się zalogować, aby sfinalizować zamówienie.', 'bigdiamond-white-prestige' ) ) );
	return;
}
?>
<section class="bdwp-checkout" aria-labelledby="bdwp-checkout-heading">
	<h1 id="bdwp-checkout-heading"><?php esc_html_e( 'Zamówienie BigDIAMOND', 'bigdiamond-white-prestige' ); ?></h1>
	<div class="bdwp-checkout__progress">
		<span><?php esc_html_e( '1. Dane kontaktowe', 'bigdiamond-white-prestige' ); ?></span>
		<span><?php esc_html_e( '2. Dostawa', 'bigdiamond-white-prestige' ); ?></span>
		<span><?php esc_html_e( '3. Płatność', 'bigdiamond-white-prestige' ); ?></span>
	</div>
	<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
		<div class="bdwp-checkout__grid">
			<div class="bdwp-checkout__details">
				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
				<div class="bdwp-checkout__step" data-step="1">
					<h2><?php esc_html_e( 'Dane kontaktowe', 'bigdiamond-white-prestige' ); ?></h2>
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
				</div>
				<div class="bdwp-checkout__step" data-step="2">
					<h2><?php esc_html_e( 'Adres dostawy', 'bigdiamond-white-prestige' ); ?></h2>
					<?php do_action( 'woocommerce_checkout_shipping' ); ?>
				</div>
				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
			</div>
			<div class="bdwp-checkout__summary">
				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
				<div id="order_review" class="woocommerce-checkout-review-order">
					<h2><?php esc_html_e( 'Podsumowanie zamówienia', 'bigdiamond-white-prestige' ); ?></h2>
					<?php do_action( 'woocommerce_checkout_order_review' ); ?>
				</div>
				<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
				<div class="bdwp-checkout__trust">
					<p><?php esc_html_e( 'Akceptujemy płatności PayPal, PayU, przelewy tradycyjne, Apple Pay i Google Pay.', 'bigdiamond-white-prestige' ); ?></p>
					<p><?php esc_html_e( 'Złóż zamówienie jako gość lub zalogowany klient – Twoje dane są zabezpieczone.', 'bigdiamond-white-prestige' ); ?></p>
				</div>
			</div>
		</div>
	</form>
</section>
<?php
do_action( 'woocommerce_after_checkout_form', $checkout );
