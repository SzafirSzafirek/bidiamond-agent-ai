<?php
/**
 * Custom dashboard content for My Account.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="bdwp-account-dashboard" aria-label="<?php esc_attr_e( 'Panel klienta', 'bigdiamond-white-prestige' ); ?>">
	<h1><?php echo esc_html( sprintf( __( 'Witaj, %s', 'bigdiamond-white-prestige' ), wp_get_current_user()->display_name ) ); ?></h1>
	<p><?php esc_html_e( 'Zarządzaj zamówieniami, adresami i ustawieniami konta BigDIAMOND.', 'bigdiamond-white-prestige' ); ?></p>
	<div class="bdwp-account-dashboard__grid">
		<a class="bdwp-account-dashboard__card" href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>">
			<strong><?php esc_html_e( 'Zamówienia', 'bigdiamond-white-prestige' ); ?></strong>
			<span><?php esc_html_e( 'Sprawdź status zamówień i pobierz faktury.', 'bigdiamond-white-prestige' ); ?></span>
		</a>
		<a class="bdwp-account-dashboard__card" href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-address' ) ); ?>">
			<strong><?php esc_html_e( 'Adresy dostawy', 'bigdiamond-white-prestige' ); ?></strong>
			<span><?php esc_html_e( 'Aktualizuj adresy rozliczeniowe i wysyłkowe.', 'bigdiamond-white-prestige' ); ?></span>
		</a>
		<a class="bdwp-account-dashboard__card" href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>">
			<strong><?php esc_html_e( 'Dane konta', 'bigdiamond-white-prestige' ); ?></strong>
			<span><?php esc_html_e( 'Zmień hasło i preferencje komunikacji.', 'bigdiamond-white-prestige' ); ?></span>
		</a>
		<a class="bdwp-account-dashboard__card" href="<?php echo esc_url( wc_get_account_endpoint_url( 'subscriptions' ) ); ?>">
			<strong><?php esc_html_e( 'Subskrypcje', 'bigdiamond-white-prestige' ); ?></strong>
			<span><?php esc_html_e( 'Zarządzaj usługami serwisowymi BigDIAMOND.', 'bigdiamond-white-prestige' ); ?></span>
		</a>
	</div>
	<?php do_action( 'woocommerce_account_dashboard' ); ?>
</section>
