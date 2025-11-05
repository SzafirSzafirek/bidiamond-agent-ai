<?php
/**
 * BigDIAMOND White Prestige — bootstrap motywu potomnego (GeneratePress)
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Stałe motywu
 */
define( 'BIGDIAMOND_WHITE_PRESTIGE_VERSION', '1.2.0' );
define( 'BIGDIAMOND_WHITE_PRESTIGE_DIR', get_stylesheet_directory() );
define( 'BIGDIAMOND_WHITE_PRESTIGE_URI', get_stylesheet_directory_uri() );

/**
 * Helper: wersjonowanie assetów po mtime.
 * Używany m.in. w inc/assets.php → bdwp_asset_ver($relPath)
 */
if ( ! function_exists( 'bdwp_asset_ver' ) ) {
	function bdwp_asset_ver( string $rel ): string {
		$path = BIGDIAMOND_WHITE_PRESTIGE_DIR . $rel;
		return file_exists( $path ) ? (string) filemtime( $path ) : BIGDIAMOND_WHITE_PRESTIGE_VERSION;
	}
}

/**
 * Minimalny setup: wsparcie motywu + menu + WooCommerce.
 */
add_action( 'after_setup_theme', function (): void {
	// Podstawy
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
	// Woo
	add_theme_support( 'woocommerce' );

	// Menu
	register_nav_menus( [
		'primary'   => __( 'Menu główne', 'bigdiamond-white-prestige' ),
		'topbar'    => __( 'Górny pasek', 'bigdiamond-white-prestige' ),
		'footer'    => __( 'Stopka', 'bigdiamond-white-prestige' ),
	] );
}, 5 );

/**
 * Fallback dla strategii "defer" jeśli środowisko nie wspiera wp_script_add_data('strategy','defer').
 * (inc/assets.php ustawia 'strategy' → tu dorzucamy znacznik, jeśli potrzeba)
 */
add_filter( 'script_loader_tag', function( string $tag, string $handle ): string {
	$deferred = [ 'bdwp-main' ]; // rozszerz, jeśli dojdą kolejne skrypty
	if ( in_array( $handle, $deferred, true ) && strpos( $tag, 'defer' ) === false ) {
		$tag = str_replace( '<script ', '<script defer ', $tag );
	}
	return $tag;
}, 10, 2 );

/**
 * === WYMAGANE PRZEZ NOWY HEADER: Logo marki ===
 * Bez tego dostawałeś fatal na bdwp_get_brand_logo_html().
 */
if ( ! function_exists( 'bdwp_get_brand_logo_html' ) ) {
	function bdwp_get_brand_logo_html(): string {
		// Jeśli ustawione "Własne logo" w Wygląd → Dostosuj
		if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
			// get_custom_logo daje <a><img/></a> — dodamy alt jeśli brak
			$logo = get_custom_logo();
			if ( $logo && strpos( $logo, 'alt=' ) === false ) {
				$alt = esc_attr( get_bloginfo( 'name' ) );
				$logo = preg_replace( '/<img(.*?)\/>/', '<img$1 alt="'.$alt.'" />', (string) $logo );
			}
			return (string) $logo;
		}

		// Fallback: nazwa strony jako typograficzne logo
		$name = get_bloginfo( 'name' );
		$url  = esc_url( home_url( '/' ) );
		return '<a class="bdwp-brand__textlogo" href="'.$url.'" rel="home">'.esc_html( $name ).'</a>';
	}
}

/**
 * Skip links (WCAG) — pojawia się zaraz po <body>.
 */
add_action( 'wp_body_open', function (): void {
	?>
	<nav class="bdwp-skip-links" aria-label="<?php esc_attr_e( 'Skip links', 'bigdiamond-white-prestige' ); ?>">
		<a class="bdwp-skip-links__link" href="#primary"><?php esc_html_e( 'Przejdź do treści', 'bigdiamond-white-prestige' ); ?></a>
		<a class="bdwp-skip-links__link" href="#site-navigation"><?php esc_html_e( 'Przejdź do nawigacji', 'bigdiamond-white-prestige' ); ?></a>
	</nav>
	<?php
}, 5 );

/**
 * Ikony inline SVG używane w headerze/koszyku/trust-badges.
 */
if ( ! function_exists( 'bigdiamond_white_prestige_get_icon' ) ) {
	function bigdiamond_white_prestige_get_icon( string $name ): string {
		$icons = [
			'phone'          => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5.4 3h2.2c.6 0 1.2.4 1.4 1l1 2.9a1.5 1.5 0 01-.3 1.4l-1.4 1.4a14.7 14.7 0 006.2 6.2l1.4-1.4a1.5 1.5 0 011.4-.3l2.9 1a1.5 1.5 0 011 1.4v2.2c0 1.3-1.1 2.4-2.4 2.4A17.4 17.4 0 013 5.4C3 4.1 4.1 3 5.4 3z" fill="currentColor"/></svg>',
			'mail'           => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5.5 5h13A2.5 2.5 0 0121 7.5v9A2.5 2.5 0 0118.5 19h-13A2.5 2.5 0 013 16.5v-9A2.5 2.5 0 015.5 5zm0 2v.2l6.5 4.3L18.5 7V7H5.5z" fill="currentColor"/></svg>',
			'chat'           => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3a9 9 0 019 9 8.9 8.9 0 01-4.3 7.5L12 21l-1.7.5A9 9 0 013 12a9 9 0 019-9z" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
			'message-circle' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21 11.5a8.5 8.5 0 10-4.2 7.3L21 21l-.9-3.8a8.5 8.5 0 00.1-5.7z" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
			'shield'         => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3l8 3v6c0 4.4-3.3 8.4-8 9-4.7-.6-8-4.6-8-9V6l8-3z" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
			'diamond'        => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3.5 8.5L7.7 3h8.6l4.2 5.5L12 21 3.5 8.5z" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><path d="M3.5 8.5h17M12 21l-4.3-12.5M12 21l4.3-12.5M9 3l3 5.5L15 3" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>',
			'heart'          => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 21s-6.6-4.4-9.1-8.2a5.5 5.5 0 018-7 5.5 5.5 0 018 7C18.6 16.6 12 21 12 21z" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
			'arrow-right'    => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14m-4-4l4 4-4 4" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
			'store'          => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 9l1.3-4.7A1.5 1.5 0 015.7 3h12.6a1.5 1.5 0 011.4 1.3L21 9v1.5a2.5 2.5 0 01-5 0 2.5 2.5 0 01-5 0 2.5 2.5 0 01-5 0 2.5 2.5 0 01-3 2.4z" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M5 12.5V21h14v-8.5" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 17h6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
			'cart'           => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 5h2l1.68 8.4A2 2 0 008.63 15h7.74a2 2 0 001.95-1.6L20 7H6" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><circle cx="9" cy="19" r="1.5" fill="currentColor"/><circle cx="17" cy="19" r="1.5" fill="currentColor"/></svg>',
			'user'           => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 12a4 4 0 100-8 4 4 0 000 8z" fill="none" stroke="currentColor" stroke-width="1.5"/><path d="M5 20a7 7 0 0114 0" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
			'search'         => '<svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="6" fill="none" stroke="currentColor" stroke-width="1.5"/><path d="M20 20l-3.2-3.2" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
			'close'          => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
			'instagram'      => '<svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5" ry="5" fill="none" stroke="currentColor" stroke-width="1.5"/><circle cx="12" cy="12" r="3.5" fill="none" stroke="currentColor" stroke-width="1.5"/><circle cx="17.25" cy="6.75" r="1" fill="currentColor"/></svg>',
			'facebook'       => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M15 3h-3.2A4.8 4.8 0 007 7.8V11H5v3h2v7h3v-7h3l.6-3H10V8a1.8 1.8 0 011.8-1.8H15z" fill="currentColor"/></svg>',
			'youtube'        => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M22 12.08s0-3.18-.4-4.6a2.5 2.5 0 00-1.76-1.76C17.42 5.33 12 5.33 12 5.33s-5.42 0-7.84.39A2.5 2.5 0 002.4 7.48C2 8.9 2 12.08 2 12.08s0 3.19.4 4.6a2.5 2.5 0 001.76 1.77c2.42.39 7.84.39 7.84.39s5.42 0 7.84-.39a2.5 2.5 0 001.76-1.77c.4-1.41.4-4.6.4-4.6z" fill="currentColor"/><path d="M10 15.46L15.2 12 10 8.54z" fill="#fff"/></svg>',
		];
		return $icons[ $name ] ?? '';
	}
}

/**
 * Drobne a11y: data-focus na linkach w menu głównym
 */
add_filter( 'nav_menu_link_attributes', function( array $atts, $item, $args ): array {
	if ( isset( $args->theme_location ) && 'primary' === $args->theme_location ) {
		$atts['data-focus'] = 'primary-nav';
	}
	return $atts;
}, 10, 3 );

/**
 * Woo: licznik koszyka (helper dla headera)
 */
if ( ! function_exists( 'bigdiamond_white_prestige_get_cart_count' ) ) {
	function bigdiamond_white_prestige_get_cart_count(): int {
		if ( function_exists( 'WC' ) && WC()->cart ) {
			return (int) WC()->cart->get_cart_contents_count();
		}
		return 0;
	}
}

/**
 * Woo: fallback menu kiedy nieprzypisane (np. świeża instalacja)
 */
if ( ! function_exists( 'bigdiamond_white_prestige_menu_fallback' ) ) {
	function bigdiamond_white_prestige_menu_fallback( array $args ): string {
		$links = [
			__( 'Strona główna', 'bigdiamond-white-prestige' ) => home_url( '/' ),
			__( 'O nas', 'bigdiamond-white-prestige' )          => home_url( '/o-nas/' ),
			__( 'Oferta', 'bigdiamond-white-prestige' )        => home_url( '/oferta/' ),
			__( 'Realizacje', 'bigdiamond-white-prestige' )    => home_url( '/realizacje/' ),
			__( 'Sklep', 'bigdiamond-white-prestige' )         => function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/sklep/' ),
			__( 'Kontakt', 'bigdiamond-white-prestige' )       => home_url( '/kontakt/' ),
		];

		$output = '<ul class="nav-links">';
		foreach ( $links as $label => $url ) {
			$output .= sprintf( '<li><a href="%1$s">%2$s</a></li>', esc_url( $url ), esc_html( $label ) );
		}
		$output .= '</ul>';

		if ( isset( $args['echo'] ) && false === $args['echo'] ) {
			return $output;
		}
		echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		return $output;
	}
}

/**
 * === WooCommerce – drobne polonizacje i layout ===
 */

// Tekst przycisków koszyka
add_filter( 'woocommerce_product_add_to_cart_text', fn( $t ) => __( 'Dodaj do koszyka', 'bigdiamond-white-prestige' ) );
add_filter( 'woocommerce_product_single_add_to_cart_text', fn( $t ) => __( 'Dodaj do koszyka', 'bigdiamond-white-prestige' ) );

// Related / Upsell → 3 kolumny
add_filter( 'woocommerce_output_related_products_args', function( $args ) { $args['posts_per_page']=3; $args['columns']=3; return $args; } );
add_filter( 'woocommerce_upsell_display_args',          function( $args ) { $args['posts_per_page']=3; $args['columns']=3; return $args; } );

// Brak sidebara na widokach Woo w GeneratePress
add_filter( 'generate_sidebar_layout', function( $layout ) {
	if ( function_exists( 'is_woocommerce' ) && (
		is_woocommerce() || is_shop() || is_product() || is_product_category() || is_product_tag()
		|| is_cart() || is_checkout() || is_account_page()
	) ) {
		return 'no-sidebar';
	}
	return $layout;
} );

// Breadcrumby nad produktem (proste, natywne Woo)
add_action( 'woocommerce_before_single_product', function () {
	if ( function_exists( 'woocommerce_breadcrumb' ) ) {
		echo '<div class="bdwp-breadcrumbs">';
		woocommerce_breadcrumb( [ 'delimiter' => ' / ' ] );
		echo '</div>';
	}
}, 5 );

// Kolejność elementów w podsumowaniu produktu
add_action( 'init', function () {
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 8 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 12 );
}, 20 );

// Nagłówki sekcji powiązanych
add_filter( 'woocommerce_product_upsells_products_heading', fn() => __( 'Proponowane dla Ciebie', 'bigdiamond-white-prestige' ) );
add_filter( 'woocommerce_product_related_products_heading', fn() => __( 'Powiązane produkty', 'bigdiamond-white-prestige' ) );

// Drawer koszyka w stopce + fragmenty AJAX (licznik i mini-cart)
add_action( 'wp_footer', function () {
	if ( ! function_exists( 'wc_get_cart_url' ) || ! function_exists( 'woocommerce_mini_cart' ) ) {
		return;
	}
	$cart_url     = wc_get_cart_url();
	$checkout_url = function_exists( 'wc_get_checkout_url' ) ? wc_get_checkout_url() : $cart_url;
	?>
	<div class="cart-drawer" data-cart-drawer hidden>
		<div class="cart-drawer__overlay" data-cart-drawer-close></div>
		<aside class="cart-drawer__panel" role="dialog" aria-modal="true" aria-labelledby="cart-drawer-heading">
			<header class="cart-drawer__header">
				<h2 id="cart-drawer-heading"><?php esc_html_e( 'Twój koszyk', 'bigdiamond-white-prestige' ); ?></h2>
				<button class="cart-drawer__close" type="button" data-cart-drawer-close aria-label="<?php esc_attr_e( 'Zamknij koszyk', 'bigdiamond-white-prestige' ); ?>">
					<?php echo bigdiamond_white_prestige_get_icon( 'close' ); // phpcs:ignore ?>
				</button>
			</header>
			<div class="cart-drawer__content" data-cart-drawer-content>
				<?php woocommerce_mini_cart(); ?>
			</div>
			<footer class="cart-drawer__footer">
				<a class="btn" href="<?php echo esc_url( $cart_url ); ?>">
					<?php esc_html_e( 'Zobacz koszyk', 'bigdiamond-white-prestige' ); ?>
				</a>
				<a class="btn btn--gold" href="<?php echo esc_url( $checkout_url ); ?>">
					<?php esc_html_e( 'Przejdź do płatności', 'bigdiamond-white-prestige' ); ?>
				</a>
			</footer>
		</aside>
	</div>
	<?php
} );

add_filter( 'woocommerce_add_to_cart_fragments', function( array $fragments ): array {
	if ( ! function_exists( 'WC' ) || ! WC()->cart || ! function_exists( 'woocommerce_mini_cart' ) ) {
		return $fragments;
	}
	ob_start(); ?>
	<span class="cart-count" aria-live="polite" aria-atomic="true"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
	<?php $fragments['span.cart-count'] = ob_get_clean();

	ob_start(); ?>
	<div class="cart-drawer__content" data-cart-drawer-content>
		<?php woocommerce_mini_cart(); ?>
	</div>
	<?php $fragments['div.cart-drawer__content'] = ob_get_clean();

	return $fragments;
} );

/**
 * SEO Product JSON-LD (tylko na stronie produktu; nie duplikujemy Yoast/RankMath)
 */
add_action( 'wp_head', function (): void {
	if ( ! function_exists( 'is_product' ) || ! is_product() ) return;
	if ( defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) ) return;

	global $product;
	if ( ! ( $product instanceof WC_Product ) ) return;

	$currency = get_woocommerce_currency();
	$img_id   = $product->get_image_id();
	$img_url  = $img_id ? wp_get_attachment_image_url( $img_id, 'full' ) : '';
	$desc     = $product->get_short_description() ?: get_the_excerpt();
	$desc     = $desc ? wp_strip_all_tags( (string) $desc ) : '';

	$avail_map = [
		'instock'     => 'https://schema.org/InStock',
		'outofstock'  => 'https://schema.org/OutOfStock',
		'onbackorder' => 'https://schema.org/PreOrder',
	];
	$availability = $avail_map[ $product->get_stock_status() ] ?? 'https://schema.org/InStock';

	$schema = [
		'@context' => 'https://schema.org',
		'@type'    => 'Product',
		'name'     => get_the_title(),
		'url'      => get_permalink(),
		'brand'    => [ '@type' => 'Brand', 'name' => 'BigDIAMOND White Prestige' ],
	];
	if ( $img_url )          $schema['image'] = $img_url;
	if ( $desc )             $schema['description'] = $desc;
	if ( $product->get_sku() ) $schema['sku'] = $product->get_sku();

	$rc = (int) $product->get_review_count();
	$rv = (float) $product->get_average_rating();
	if ( $rc > 0 && $rv > 0 ) {
		$schema['aggregateRating'] = [
			'@type'       => 'AggregateRating',
			'ratingValue' => (string) round( $rv, 2 ),
			'reviewCount' => (string) $rc,
		];
	}

	if ( $product->is_type( 'variable' ) ) {
		$prices = $product->get_variation_prices( true );
		if ( ! empty( $prices['price'] ) ) {
			$schema['offers'] = [
				'@type'         => 'AggregateOffer',
				'priceCurrency' => $currency,
				'lowPrice'      => (string) min( $prices['price'] ),
				'highPrice'     => (string) max( $prices['price'] ),
				'offerCount'    => (string) count( $prices['price'] ),
				'availability'  => $availability,
			];
		}
	} else {
		$price = $product->get_price();
		if ( $price !== '' ) {
			$schema['offers'] = [
				'@type'         => 'Offer',
				'priceCurrency' => $currency,
				'price'         => (string) $price,
				'availability'  => $availability,
			];
		}
	}

	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";

	// Prosty OG Product (gdy brak wtyczki SEO)
	if ( $desc ) echo '<meta property="og:description" content="' . esc_attr( wp_trim_words( $desc, 40 ) ) . '" />' . "\n";
	if ( $img_url ) echo '<meta property="og:image" content="' . esc_url( $img_url ) . '" />' . "\n";
	echo '<meta property="og:type" content="product" />' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( get_the_title() ) . '" />' . "\n";
}, 99 );

/**
 * Trust badges pod meta produktu (UX/zaufanie)
 */
if ( ! function_exists( 'bdwp_render_product_trust_signals' ) ) {
	function bdwp_render_product_trust_signals(): void {
		$items = [
			[ 'icon' => 'shield', 'text' => __( 'Bezpieczna płatność SSL', 'bigdiamond-white-prestige' ), 'url' => home_url( '/polityka-prywatnosci/' ) ],
			[ 'icon' => 'store',  'text' => __( '30 dni na zwrot kolekcji', 'bigdiamond-white-prestige' ),  'url' => home_url( '/zwroty/' ) ],
			[ 'icon' => 'chat',   'text' => __( 'Wsparcie concierge', 'bigdiamond-white-prestige' ),        'url' => home_url( '/kontakt/' ) ],
		];
		echo '<div class="bdwp-product-trust-signals" style="margin-top:1.5rem;display:grid;gap:.75rem;font-size:.9rem;color:var(--bdwp-color-text-muted)">';
		foreach ( $items as $it ) {
			printf(
				'<a href="%s" style="display:flex;align-items:center;gap:.6rem;text-decoration:none;color:inherit;">
					<span style="width:20px;height:20px;color:var(--bdwp-color-gold);">%s</span>
					<span>%s</span>
				</a>',
				esc_url( $it['url'] ),
				bigdiamond_white_prestige_get_icon( $it['icon'] ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				esc_html( $it['text'] )
			);
		}
		echo '</div>';
	}
}
add_action( 'woocommerce_single_product_summary', 'bdwp_render_product_trust_signals', 45 );

/**
 * Recently viewed — jeżeli masz funkcję w inc/woo.php
 */
if ( function_exists( 'bigdiamond_white_prestige_recently_viewed_products' ) ) {
	add_action( 'woocommerce_after_single_product_summary', 'bigdiamond_white_prestige_recently_viewed_products', 25 );
}

/**
 * Wczytaj moduły (łagodne require z guardem)
 * Uwaga: nie ładujemy tu żadnych template-parts; header korzysta z funkcji zdefiniowanych wyżej.
 */
foreach ( [
	'/inc/setup.php',
	'/inc/assets.php',
	'/inc/woo.php',
	'/inc/seo.php',
	'/inc/seo-product.php',
	'/inc/seo-blog.php',
	'/inc/seo-faq.php',
] as $rel ) {
	$abs = BIGDIAMOND_WHITE_PRESTIGE_DIR . $rel;
	if ( file_exists( $abs ) ) {
		require_once $abs;
	}
}

/**
 * Porządek po wtyczkach Woo Blocks (jeśli nie korzystasz z widgetów blokowych)
 * Uwaga: dokładne dequeuing CSS ogarniamy także warunkowo w inc/assets.php, więc tu zostawiamy lekki cleanup.
 */
add_action( 'wp_enqueue_scripts', function() {
	wp_dequeue_style( 'wc-blocks-style' );
}, 20 );

// --- 1. P0.4: Pole grawerunku (Personalizacja) ---

/**
 * Wyświetla pole tekstowe dla grawerunku przed przyciskiem "Dodaj do koszyka".
 */
add_action( 'woocommerce_before_add_to_cart_button', 'bdwp_add_engraving_field', 9 );
function bdwp_add_engraving_field(): void {
	// Możesz dodać logikę, aby wyświetlać to pole tylko dla określonych kategorii
	// np. if ( ! has_term( 'pierscionki', 'product_cat' ) ) return;

	echo '<fieldset class="bdwp-engraving-field">';
	echo '<label for="bdwp_engraving_text">' . esc_html__( 'Twój grawerunek (opcjonalnie)', 'bigdiamond-white-prestige' ) . '</label>';
	echo '<input type="text" id="bdwp_engraving_text" name="bdwp_engraving_text" maxlength="30" placeholder="' . esc_attr__( 'np. Wasza data lub inicjały', 'bigdiamond-white-prestige' ) . '">';
	echo '<small class="bdwp-engraving-field__note">' . esc_html__( 'Maksymalnie 30 znaków. Produkty grawerowane nie podlegają zwrotowi.', 'bigdiamond-white-prestige' ) . '</small>';
	echo '</fieldset>';
}

/**
 * Zapisuje dane z pola grawerunku do danych koszyka.
 */
add_filter( 'woocommerce_add_cart_item_data', 'bdwp_save_engraving_to_cart_item', 10, 3 );
function bdwp_save_engraving_to_cart_item( array $cart_item_data, int $product_id, int $variation_id ): array {
	if ( isset( $_POST['bdwp_engraving_text'] ) && ! empty( $_POST['bdwp_engraving_text'] ) ) {
		$engraving_text = sanitize_text_field( $_POST['bdwp_engraving_text'] );
		// Zapisujemy oczyszczony tekst grawerunku
		$cart_item_data['bdwp_engraving'] = substr( $engraving_text, 0, 30 );
	}
	return $cart_item_data;
}

/**
 * Wyświetla zapisany grawerunek w koszyku i przy kasie.
 */
add_filter( 'woocommerce_get_item_data', 'bdwp_display_engraving_in_cart', 10, 2 );
function bdwp_display_engraving_in_cart( array $item_data, array $cart_item ): array {
	if ( isset( $cart_item['bdwp_engraving'] ) ) {
		$item_data[] = array(
			'key'     => __( 'Grawerunek', 'bigdiamond-white-prestige' ),
			'value'   => esc_html( $cart_item['bdwp_engraving'] ),
			'display' => '',
		);
	}
	return $item_data;
}

/**
 * Zapisuje grawerunek do meta danych pozycji zamówienia (widoczne dla admina).
 */
add_action( 'woocommerce_checkout_create_order_line_item', 'bdwp_save_engraving_to_order_item', 10, 4 );
function bdwp_save_engraving_to_order_item( $item, string $cart_item_key, array $values, $order ): void {
	if ( isset( $values['bdwp_engraving'] ) ) {
		$item->add_meta_data( __( 'Grawerunek', 'bigdiamond-white-prestige' ), $values['bdwp_engraving'] );
	}
}

// --- 2. P0.1: Slot na wideo produktowe ---

/**
 * Wyświetla wideo produktowe (z pola niestandardowego) nad galerią.
 */
add_action( 'woocommerce_before_single_product_summary', 'bdwp_display_product_video', 15 );
function bdwp_display_product_video(): void {
	global $product;
	// Użyj pola niestandardowego o nazwie '_bdwp_video_url'
	$video_url = get_post_meta( $product->get_id(), '_bdwp_video_url', true );

	if ( empty( $video_url ) || ! is_string( $video_url ) ) {
		return;
	}

	// Używamy funkcji WordPress oEmbed do bezpiecznego osadzenia (działa z YouTube, Vimeo)
	$embed_html = wp_oembed_get( $video_url );

	if ( $embed_html ) {
		echo '<div class="bdwp-product-video-wrapper">' . $embed_html . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

// --- 3. P0.3: Zakładka "Certyfikat i 4C" ---

/**
 * Dodaje nową zakładkę do listy zakładek na stronie produktu.
 */
add_filter( 'woocommerce_product_tabs', 'bdwp_add_specs_tab', 15 );
function bdwp_add_specs_tab( array $tabs ): array {
	// Dodaj nową zakładkę
	$tabs['bdwp_specs'] = array(
		'title'    => __( 'Certyfikat i 4C', 'bigdiamond-white-prestige' ),
		'priority' => 15, // Ustaw priorytet (np. 15, aby była przed Opisem (20))
		'callback' => 'bdwp_render_product_specs_tab',
	);

	// Przesuń zakładkę FAQ (z inc/woo.php) na później, jeśli istnieje
	if ( isset( $tabs['bdwp_faq'] ) ) {
		$tabs['bdwp_faq']['priority'] = 80;
	}

	return $tabs;
}

/**
 * Renderuje zawartość zakładki "Certyfikat i 4C".
 */
function bdwp_render_product_specs_tab(): void {
	global $product;

	// Pobierz dane z pól niestandardowych produktu
	$cert_link = get_post_meta( $product->get_id(), '_bdwp_cert_url', true );
	$cut       = get_post_meta( $product->get_id(), '_bdwp_cut', true );
	$color     = get_post_meta( $product->get_id(), '_bdwp_color', true );
	$clarity   = get_post_meta( $product->get_id(), '_bdwp_clarity', true );
	$carat     = get_post_meta( $product->get_id(), '_bdwp_carat', true );

	// Sprawdź, czy mamy jakiekolwiek dane do wyświetlenia
	if ( empty( $cert_link ) && empty( $cut ) && empty( $color ) && empty( $clarity ) && empty( $carat ) ) {
		echo '<p>' . esc_html__( 'Szczegółowa specyfikacja (4C) oraz certyfikat są dostępne na życzenie. Skontaktuj się z naszym concierge.', 'bigdiamond-white-prestige' ) . '</p>';
		return;
	}

	echo '<h2>' . esc_html__( 'Jakość BigDIAMOND', 'bigdiamond-white-prestige' ) . '</h2>';
	echo '<p>' . esc_html__( 'Każdy diament jest przez nas weryfikowany pod kątem 4C (Cut, Color, Clarity, Carat), aby zapewnić najwyższy standard i blask.', 'bigdiamond-white-prestige' ) . '</p>';

	// Lista specyfikacji 4C
	echo '<ul class="bdwp-specs-list">';
	if ( ! empty( $cut ) ) {
		echo '<li><strong>' . esc_html__( 'Szlif (Cut)', 'bigdiamond-white-prestige' ) . ':</strong> ' . esc_html( $cut ) . '</li>';
	}
	if ( ! empty( $color ) ) {
		echo '<li><strong>' . esc_html__( 'Kolor (Color)', 'bigdiamond-white-prestige' ) . ':</strong> ' . esc_html( $color ) . '</li>';
	}
	if ( ! empty( $clarity ) ) {
		echo '<li><strong>' . esc_html__( 'Czystość (Clarity)', 'bigdiamond-white-prestige' ) . ':</strong> ' . esc_html( $clarity ) . '</li>';
	}
	if ( ! empty( $carat ) ) {
		echo '<li><strong>' . esc_html__( 'Masa (Carat)', 'bigdiamond-white-prestige' ) . ':</strong> ' . esc_html( $carat ) . ' ct</li>';
	}
	echo '</ul>';

	// Przycisk do certyfikatu
	if ( ! empty( $cert_link ) ) {
		echo '<p><a href="' . esc_url( $cert_link ) . '" class="bdwp-button" target="_blank" rel="noopener">' . esc_html__( 'Zobacz certyfikat GIA/IGI', 'bigdiamond-white-prestige' ) . '</a></p>';
	}
}
