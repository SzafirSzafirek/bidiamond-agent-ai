<?php
/**
 * BigDIAMOND White Prestige – Assets loader (refined)
 */

declare(strict_types=1);

if ( ! defined('ABSPATH') ) exit;

// Definicje awaryjne
if ( ! defined('BIGDIAMOND_WHITE_PRESTIGE_URI') ) define('BIGDIAMOND_WHITE_PRESTIGE_URI', get_stylesheet_directory_uri());
if ( ! defined('BIGDIAMOND_WHITE_PRESTIGE_DIR') ) define('BIGDIAMOND_WHITE_PRESTIGE_DIR', get_stylesheet_directory());

// Flaga: czy w headerze jest mini-koszyk / odświeżanie fragmentów koszyka?
if ( ! defined('BDWP_MINICART_IN_HEADER') ) define('BDWP_MINICART_IN_HEADER', false);

// Wersjonowanie przez mtime
if ( ! function_exists('bdwp_asset_ver') ) {
	function bdwp_asset_ver(string $rel): string {
		$path = BIGDIAMOND_WHITE_PRESTIGE_DIR . $rel;
		return file_exists($path) ? (string) filemtime($path) : '1.0.0';
	}
}

// Preload głównego CSS (lekki boost FCP/LCP)
add_filter('wp_resource_hints', function(array $hints, string $relation_type): array {
	if ( 'preload' !== $relation_type ) return $hints;
	$main_css_rel = '/assets/css/white-prestige.css';
	$file = BIGDIAMOND_WHITE_PRESTIGE_DIR . $main_css_rel;
	if ( file_exists($file) ) {
		$hints[] = [
			'href'        => BIGDIAMOND_WHITE_PRESTIGE_URI . $main_css_rel . '?ver=' . bdwp_asset_ver($main_css_rel),
			'as'          => 'style',
			'crossorigin' => 'anonymous',
		];
	}
	return $hints;
}, 10, 2);

// Enqueue po GeneratePress/Woo
add_action('wp_enqueue_scripts', 'bigdiamond_white_prestige_enqueue_assets', 60);

function bigdiamond_white_prestige_enqueue_assets(): void {
	// === CSS: motyw potomny ===
	$main_css_rel = '/assets/css/white-prestige.css';
	if ( file_exists(BIGDIAMOND_WHITE_PRESTIGE_DIR . $main_css_rel) ) {
		$deps = wp_style_is('generate-style', 'registered') ? ['generate-style'] : [];
		wp_enqueue_style(
			'bdwp-white-prestige',
			BIGDIAMOND_WHITE_PRESTIGE_URI . $main_css_rel,
			$deps,
			bdwp_asset_ver($main_css_rel)
		);
		// (opcjonalnie) RTL: wp_style_add_data('bdwp-white-prestige', 'rtl', 'replace');
	}

	// === Woo: wykrycie stron sklepu ===
	$is_woo = function_exists('is_woocommerce') && (
		is_woocommerce() || is_cart() || is_checkout() || is_account_page() ||
		is_shop() || is_product() || is_product_category() || is_product_tag()
	);

	// === Woo CSS tylko tam, gdzie trzeba ===
	if ( $is_woo ) {
		foreach ( ['/assets/css/woo.min.css', '/assets/css/woo.css'] as $woo_css_rel ) {
			if ( file_exists(BIGDIAMOND_WHITE_PRESTIGE_DIR . $woo_css_rel) ) {
				wp_enqueue_style(
					'bdwp-woo',
					BIGDIAMOND_WHITE_PRESTIGE_URI . $woo_css_rel,
					['bdwp-white-prestige'],
					bdwp_asset_ver($woo_css_rel)
				);
				break;
			}
		}
	} else {
		// Odciąż Woo TYLKO jeśli nie używamy mini-koszyka i jeśli style faktycznie są w kolejce
		if ( ! BDWP_MINICART_IN_HEADER ) {
			$woo_styles = ['woocommerce-layout','woocommerce-smallscreen','woocommerce-general','wc-blocks-style','wc-blocks-vendors-style'];
			foreach ( $woo_styles as $h ) {
				if ( wp_style_is($h, 'enqueued') || wp_style_is($h, 'registered') ) {
					wp_dequeue_style($h);
				}
			}
			$woo_scripts = ['wc-add-to-cart','woocommerce','wc-cart-fragments'];
			foreach ( $woo_scripts as $h ) {
				if ( wp_script_is($h, 'enqueued') || wp_script_is($h, 'registered') ) {
					wp_dequeue_script($h);
				}
			}
		}
	}

	// === JS: header.js ===
	$header_js_rel = '/assets/js/header.js';
	if ( file_exists(BIGDIAMOND_WHITE_PRESTIGE_DIR . $header_js_rel) ) {
		wp_enqueue_script(
			'bdwp-header',
			BIGDIAMOND_WHITE_PRESTIGE_URI . $header_js_rel,
			[],
			bdwp_asset_ver($header_js_rel),
			true
		);
		if ( function_exists('wp_script_add_data') ) {
			wp_script_add_data('bdwp-header', 'strategy', 'defer');
		}
	}

	// === JS: main.js (opcjonalny) ===
	$main_js_rel = '/assets/js/main.js';
	if ( file_exists(BIGDIAMOND_WHITE_PRESTIGE_DIR . $main_js_rel) ) {
		wp_enqueue_script(
			'bdwp-main',
			BIGDIAMOND_WHITE_PRESTIGE_URI . $main_js_rel,
			[],
			bdwp_asset_ver($main_js_rel),
			true
		);
		if ( function_exists('wp_script_add_data') ) {
			wp_script_add_data('bdwp-main', 'strategy', 'defer');
		}
	}

	// === Woo: single product JS (zoom/wariacje) ===
	if ( function_exists('is_product') && is_product() ) {
		if ( wp_script_is('wc-single-product', 'registered') ) {
			wp_enqueue_script('wc-single-product');
		}
	}
}
