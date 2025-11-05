<?php
/**
 * Theme setup definitions.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

if ( ! function_exists( 'bigdiamond_white_prestige_theme_setup' ) ) {
	add_action( 'after_setup_theme', 'bigdiamond_white_prestige_theme_setup', 11 );
	/**
	 * Register theme supports and menus.
	 *
	 * @return void
	 */
	function bigdiamond_white_prestige_theme_setup(): void {
		load_child_theme_textdomain( 'bigdiamond-white-prestige', get_stylesheet_directory() . '/languages' );

		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-logo', array(
			'height'      => 120,
			'width'       => 120,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

		register_nav_menus(
			array(
				'primary'   => __( 'Primary Menu', 'bigdiamond-white-prestige' ),
				'footer'    => __( 'Footer Menu', 'bigdiamond-white-prestige' ),
				'secondary' => __( 'Secondary Menu', 'bigdiamond-white-prestige' ),
			)
		);

		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
}
