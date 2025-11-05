<?php
/**
 * Custom navigation for My Account area.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>
<nav class="bdwp-account-nav" aria-label="<?php esc_attr_e( 'Nawigacja konta klienta', 'bigdiamond-white-prestige' ); ?>">
	<ul>
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
		<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
		<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
		</li>
		<?php endforeach; ?>
	</ul>
</nav>
<?php do_action( 'woocommerce_after_account_navigation' ); ?>
