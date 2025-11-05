<?php
/**
 * Header – BigDIAMOND White Prestige (child of GeneratePress)
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Skip links (a11y) -->
<nav class="bdwp-skip-links" aria-label="<?php esc_attr_e( 'Pomiń do', 'bigdiamond' ); ?>">
	<a class="bdwp-skip-links__link" href="#content"><?php esc_html_e( 'Skocz do treści', 'bigdiamond' ); ?></a>
	<a class="bdwp-skip-links__link" href="#site-navigation"><?php esc_html_e( 'Skocz do nawigacji', 'bigdiamond' ); ?></a>
</nav>

<header class="bdwp-header" role="banner">
	<div class="bdwp-header__inner">

		<!-- Desktop row -->
		<div class="bdwp-header__row bdwp-header__row--desktop" aria-label="<?php esc_attr_e( 'Nagłówek (desktop)', 'bigdiamond' ); ?>">
			<!-- BRAND / LOGO -->
			<div class="bdwp-header__brand">
				<a class="bdwp-header__logo-link" href="<?= esc_url( home_url( '/' ) ); ?>" aria-label="<?php bloginfo('name'); ?>">
					<img
						src="<?= esc_url( get_stylesheet_directory_uri() . '/assets/img/logo2.png' ); ?>"
						alt="BigDIAMOND — jubiler Kraków"
						width="256" height="64"
						fetchpriority="high"
						decoding="async"
					/>
				</a>
			</div>

			<!-- NAV -->
			<nav id="site-navigation" class="bdwp-header__nav" aria-label="<?php esc_attr_e( 'Główne menu', 'bigdiamond' ); ?>">
				<?php
				wp_nav_menu( [
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'bdwp-menu',
					'fallback_cb'    => '__return_empty_string',
					'depth'          => 2,
				] );
				?>
			</nav>

			<!-- ACTIONS (right) -->
			<div class="bdwp-header__actions">
				<!-- Szukaj (desktop) -->
				<button id="bdwp-search-toggle" class="bdwp-header__icon-btn" type="button" aria-haspopup="dialog" aria-controls="bdwp-search-panel" aria-expanded="false" aria-label="<?php esc_attr_e( 'Otwórz wyszukiwanie', 'bigdiamond' ); ?>">
					<span class="bdwp-icon bdwp-icon--search" aria-hidden="true"></span>
				</button>

				<!-- Konto -->
				<a class="bdwp-header__icon-btn" href="<?php echo esc_url( function_exists('wc_get_page_permalink') ? ( wc_get_page_permalink( 'myaccount' ) ?: wp_login_url() ) : wp_login_url() ); ?>" aria-label="<?php esc_attr_e( 'Moje konto', 'bigdiamond' ); ?>">
					<span class="bdwp-icon bdwp-icon--user" aria-hidden="true"></span>
				</a>

				<!-- Koszyk -->
				<a class="bdwp-header__icon-btn bdwp-header__cart-btn" href="<?php echo esc_url( function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url( '/koszyk' ) ); ?>" aria-label="<?php esc_attr_e( 'Przejdź do koszyka', 'bigdiamond' ); ?>">
					<span class="bdwp-icon bdwp-icon--cart" aria-hidden="true"></span>
					<?php if ( function_exists( 'WC' ) && WC()->cart ) : ?>
						<span class="bdwp-header__cart-count"><?php echo (int) WC()->cart->get_cart_contents_count(); ?></span>
					<?php endif; ?>
				</a>

				<!-- Uwaga: NA DESKTOPOWYM WIERSZU NIE MA BURGERA -->
			</div>
		</div>

		<!-- Mobile rows -->
		<div class="bdwp-header__row bdwp-header__row--mobile" aria-label="<?php esc_attr_e( 'Nagłówek (mobile)', 'bigdiamond' ); ?>">
			<div class="bdwp-header__mobile-top">
				<a class="bdwp-header__logo-link" href="<?= esc_url( home_url( '/' ) ); ?>" aria-label="<?php bloginfo('name'); ?>">
					<img
						src="<?= esc_url( get_stylesheet_directory_uri() . '/assets/img/logo2.png' ); ?>"
						alt="BigDIAMOND — jubiler Kraków"
						width="256" height="64"
						decoding="async"
					/>
				</a>
			</div>

			<div class="bdwp-header__mobile-bottom">
				<!-- Burger TYLKO MOBILE -->
				<button id="bdwp-mobile-menu-toggle" class="bdwp-header__icon-btn bdwp-header__burger-btn" type="button" aria-controls="bdwp-mobile-drawer" aria-expanded="false" aria-label="<?php esc_attr_e( 'Otwórz menu', 'bigdiamond' ); ?>">
					<span class="bdwp-icon bdwp-icon--burger" aria-hidden="true"></span>
				</button>

				<div class="bdwp-header__mobile-spacer"></div>

				<div class="bdwp-header__actions">
					<!-- Skrót szukajki dla mobile -->
					<button id="bdwp-mobile-search-shortcut" class="bdwp-header__icon-btn" type="button" aria-haspopup="dialog" aria-controls="bdwp-search-panel" aria-label="<?php esc_attr_e( 'Otwórz wyszukiwanie', 'bigdiamond' ); ?>">
						<span class="bdwp-icon bdwp-icon--search" aria-hidden="true"></span>
					</button>

					<a class="bdwp-header__icon-btn" href="<?php echo esc_url( function_exists('wc_get_page_permalink') ? ( wc_get_page_permalink( 'myaccount' ) ?: wp_login_url() ) : wp_login_url() ); ?>" aria-label="<?php esc_attr_e( 'Moje konto', 'bigdiamond' ); ?>">
						<span class="bdwp-icon bdwp-icon--user" aria-hidden="true"></span>
					</a>

					<a class="bdwp-header__icon-btn bdwp-header__cart-btn" href="<?php echo esc_url( function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url( '/koszyk' ) ); ?>" aria-label="<?php esc_attr_e( 'Przejdź do koszyka', 'bigdiamond' ); ?>">
						<span class="bdwp-icon bdwp-icon--cart" aria-hidden="true"></span>
						<?php if ( function_exists( 'WC' ) && WC()->cart ) : ?>
							<span class="bdwp-header__cart-count"><?php echo (int) WC()->cart->get_cart_contents_count(); ?></span>
						<?php endif; ?>
					</a>
				</div>
			</div>
		</div>

	</div>
</header>

<!-- Drawer mobilny -->
<aside id="bdwp-mobile-drawer" class="bdwp-mobile-drawer" aria-hidden="true" tabindex="-1">
	<nav aria-label="<?php esc_attr_e( 'Menu mobilne', 'bigdiamond' ); ?>">
		<ul class="bdwp-mobile-menu">
			<?php
			$mobile_menu = has_nav_menu( 'mobile' ) ? 'mobile' : 'primary';
			wp_nav_menu( [
				'theme_location' => $mobile_menu,
				'container'      => false,
				'items_wrap'     => '%3$s',
				'fallback_cb'    => '__return_empty_string',
				'depth'          => 2,
			] );
			?>
		</ul>
	</nav>

	<div class="bdwp-mobile-drawer__extras">
		<a class="bdwp-mobile-drawer__link" href="<?php echo esc_url( function_exists('wc_get_page_permalink') ? ( wc_get_page_permalink( 'shop' ) ?: home_url( '/sklep' ) ) : home_url( '/sklep' ) ); ?>">
			<?php esc_html_e( 'Sklep', 'bigdiamond' ); ?>
		</a>
		<a class="bdwp-mobile-drawer__link" href="<?php echo esc_url( function_exists('wc_get_page_permalink') ? ( wc_get_page_permalink( 'myaccount' ) ?: wp_login_url() ) : wp_login_url() ); ?>">
			<?php esc_html_e( 'Moje konto', 'bigdiamond' ); ?>
		</a>
		<a class="bdwp-mobile-drawer__link" href="<?php echo esc_url( function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url( '/koszyk' ) ); ?>">
			<?php esc_html_e( 'Koszyk', 'bigdiamond' ); ?>
		</a>
	</div>
</aside>

<!-- Overlay szukajki -->
<div id="bdwp-search-panel" class="bdwp-search-panel" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Wyszukiwanie', 'bigdiamond' ); ?>" aria-hidden="true">
	<div class="bdwp-search-panel__inner">
		<button class="bdwp-search-panel__close" type="button" aria-label="<?php esc_attr_e( 'Zamknij wyszukiwanie', 'bigdiamond' ); ?>">
			<span class="bdwp-icon bdwp-icon--close" aria-hidden="true"></span>
		</button>
		<?php get_search_form(); ?>
	</div>
</div>

<!-- Uwaga: <main id="content"> otwierasz w szablonie strony -->
