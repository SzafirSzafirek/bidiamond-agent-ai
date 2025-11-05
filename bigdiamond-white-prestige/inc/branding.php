<?php
/**
 * Branding helpers: logo / brand mark.
 */

if ( ! function_exists( 'bdwp_get_brand_logo_html' ) ) {
	/**
	 * Zwraca HTML logotypu z linkiem do strony głównej.
	 * Używa Custom Logo (Wygląd → Dostosuj → Tożsamość witryny).
	 */
	function bdwp_get_brand_logo_html( array $args = [] ): string {
		$defaults = [
			'link_class' => 'bdwp-header__logo-link',
			'img_class'  => '',       // dodatkowe klasy na <img>
			'wrap'       => true,     // true = <a><img/></a>
		];
		$args = wp_parse_args( $args, $defaults );

		$home_url  = esc_url( home_url( '/' ) );
		$site_name = get_bloginfo( 'name' );
		$logo_id   = get_theme_mod( 'custom_logo' );

		// LCP: na homepage ładuj "eager" + fetchpriority=high.
		$is_lcp       = is_front_page() || is_home();
		$loading_attr = $is_lcp ? 'eager' : 'lazy';
		$fetch_attr   = $is_lcp ? 'high' : 'auto';

		if ( $logo_id ) {
			$img = wp_get_attachment_image(
				$logo_id,
				'full',
				false,
				[
					'class'          => trim( 'custom-logo ' . $args['img_class'] ),
					'alt'            => esc_attr( $site_name ),
					'loading'        => $loading_attr,
					'decoding'       => 'async',
					'fetchpriority'  => $fetch_attr,
				]
			);
		} else {
			// Fallback: nazwa witryny jako tekst (zgodne z dostępnością).
			$img = '<span class="brand__name brand__name--primary">' . esc_html( $site_name ) . '</span>';
		}

		$html = $args['wrap']
			? '<a href="' . $home_url . '" class="' . esc_attr( $args['link_class'] ) . '" aria-label="' . esc_attr__( 'Przejdź do strony głównej', 'bigdiamond' ) . '">' . $img . '</a>'
			: $img;

		return $html;
	}
}

if ( ! function_exists( 'bdwp_the_brand_logo' ) ) {
	/** Echo wersja helpera. */
	function bdwp_the_brand_logo( array $args = [] ): void {
		echo bdwp_get_brand_logo_html( $args ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
