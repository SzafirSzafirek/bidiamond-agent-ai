<?php
/**
 * SEO enhancements like structured data and meta tags.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

add_action( 'wp_head', 'bigdiamond_white_prestige_output_meta_tags', 2 );
add_action( 'wp_head', 'bigdiamond_white_prestige_output_jsonld', 30 );
add_action( 'wp_head', 'bigdiamond_white_prestige_output_breadcrumb_schema', 31 );
add_action( 'wp_head', 'bigdiamond_white_prestige_output_webpage_schema', 34 );
/**
 * Print meta description and Open Graph/Twitter tags.
 *
 * @return void
 */
function bigdiamond_white_prestige_output_meta_tags(): void {
	if ( is_admin() ) {
		return;
	}

	$title       = wp_get_document_title();
	$description = '';

	if ( is_singular() && has_excerpt() ) {
		$description = wp_strip_all_tags( get_the_excerpt() );
	} else {
		$description = wp_strip_all_tags( get_bloginfo( 'description' ) );
	}

	$description = wp_trim_words( $description, 32, '…' );
	$description = apply_filters( 'bigdiamond_white_prestige_meta_description', $description );

	$image = '';
	if ( is_singular() && has_post_thumbnail() ) {
		$image = get_the_post_thumbnail_url( null, 'full' );
	}
	if ( ! $image ) {
		$image = 'https://images.unsplash.com/photo-1522312346375-d1a52e2b99b3?auto=format&fit=crop&w=1600&q=80';
	}

	$current_url = bigdiamond_white_prestige_current_url();

	printf( '<meta name="description" content="%s" />' . PHP_EOL, esc_attr( $description ) );
	printf( '<meta property="og:title" content="%s" />' . PHP_EOL, esc_attr( $title ) );
	printf( '<meta property="og:description" content="%s" />' . PHP_EOL, esc_attr( $description ) );
	printf( '<meta property="og:type" content="%s" />' . PHP_EOL, esc_attr( is_singular( 'product' ) ? 'product' : ( is_singular() ? 'article' : 'website' ) ) );
	printf( '<meta property="og:url" content="%s" />' . PHP_EOL, esc_url( $current_url ) );
	printf( '<meta property="og:image" content="%s" />' . PHP_EOL, esc_url( $image ) );
	printf( '<meta name="twitter:card" content="summary_large_image" />' . PHP_EOL );
	printf( '<meta name="twitter:title" content="%s" />' . PHP_EOL, esc_attr( $title ) );
	printf( '<meta name="twitter:description" content="%s" />' . PHP_EOL, esc_attr( $description ) );
	printf( '<meta name="twitter:image" content="%s" />' . PHP_EOL, esc_url( $image ) );
}

/**
 * Output JSON-LD schema for the jewelry store organization.
 *
 * @return void
 */
function bigdiamond_white_prestige_output_jsonld(): void {
	$logo = get_site_icon_url();
	if ( ! $logo ) {
		$logo = 'https://images.unsplash.com/photo-1545239351-1141bd82e8a6?auto=format&fit=crop&w=256&q=80';
	}

	$schema = array(
		'@context'        => 'https://schema.org',
		'@type'           => 'JewelryStore',
		'name'            => get_bloginfo( 'name' ),
		'url'             => home_url( '/' ),
		'logo'            => $logo,
		'image'           => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=1600&q=80',
		'description'     => get_bloginfo( 'description' ),
		'telephone'       => '+48 123 456 789',
		'email'           => 'kontakt@bigdiamond.prestige',
		'address'         => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => 'Aleje Diamentowe 1',
			'addressLocality' => 'Warszawa',
			'postalCode'      => '00-001',
			'addressCountry'  => 'PL',
		),
		'openingHoursSpecification' => array(
			array(
				'@type'     => 'OpeningHoursSpecification',
				'dayOfWeek' => array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday' ),
				'opens'     => '10:00',
				'closes'    => '19:00',
			),
			array(
				'@type'     => 'OpeningHoursSpecification',
				'dayOfWeek' => 'Saturday',
				'opens'     => '10:00',
				'closes'    => '16:00',
			),
		),
		'contactPoint' => array(
			array(
				'@type'             => 'ContactPoint',
				'contactType'       => 'customer service',
				'telephone'         => '+48 123 456 789',
				'areaServed'        => 'PL',
				'availableLanguage' => array( 'pl-PL', 'en-US' ),
			),
		),
		'sameAs'          => array(
			'https://www.facebook.com/bigdiamond',
			'https://www.instagram.com/bigdiamond',
			'https://www.linkedin.com/company/bigdiamond',
		),
	);

	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . PHP_EOL;
}

/**
 * Output breadcrumb JSON-LD for better SERP display.
 *
 * @return void
 */
function bigdiamond_white_prestige_output_breadcrumb_schema(): void {
	$breadcrumbs = bigdiamond_white_prestige_build_breadcrumbs();

	if ( count( $breadcrumbs ) < 2 ) {
		return;
	}

	$schema = array(
		'@context'        => 'https://schema.org',
		'@type'           => 'BreadcrumbList',
		'itemListElement' => array(),
	);

	foreach ( $breadcrumbs as $position => $crumb ) {
		$schema['itemListElement'][] = array(
			'@type'    => 'ListItem',
			'position' => $position + 1,
			'name'     => $crumb['name'],
			'item'     => $crumb['url'],
		);
	}

	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . PHP_EOL;
}

/**
 * Output WebPage schema for policy pages.
 *
 * @return void
 */
function bigdiamond_white_prestige_output_webpage_schema(): void {
	if ( ! is_page() ) {
		return;
	}

	$templates = array(
		'page-privacy.php',
		'page-shipping.php',
		'page-terms.php',
		'page-zwroty.php',
	);

	$template = get_page_template_slug( get_queried_object_id() );

	if ( ! in_array( $template, $templates, true ) ) {
		return;
	}

	$post = get_post();

	if ( ! $post instanceof \WP_Post ) {
		return;
	}

	$excerpt = $post->post_excerpt ? wp_strip_all_tags( $post->post_excerpt ) : wp_trim_words( wp_strip_all_tags( $post->post_content ), 40, '…' );

	$schema = array(
		'@context'   => 'https://schema.org',
		'@type'      => 'WebPage',
		'name'       => get_the_title( $post ),
		'description'=> $excerpt,
		'url'        => get_permalink( $post ),
	);

	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . PHP_EOL;
}

/**
 * Build breadcrumb trail for current request.
 *
 * @return array<int,array<string,string>>
 */
function bigdiamond_white_prestige_build_breadcrumbs(): array {
	$items   = array();
	$items[] = array(
		'name' => __( 'Strona główna', 'bigdiamond-white-prestige' ),
		'url'  => home_url( '/' ),
	);

	if ( is_front_page() ) {
		return $items;
	}

	if ( is_page() ) {
		$ancestors = array_reverse( get_post_ancestors( get_the_ID() ) );
		foreach ( $ancestors as $ancestor_id ) {
			$items[] = array(
				'name' => get_the_title( $ancestor_id ),
				'url'  => get_permalink( $ancestor_id ),
			);
		}
		$items[] = array(
			'name' => get_the_title(),
			'url'  => get_permalink(),
		);
	} elseif ( is_singular( 'post' ) ) {
		$blog_page = (int) get_option( 'page_for_posts' );
		$items[]   = array(
			'name' => __( 'Blog', 'bigdiamond-white-prestige' ),
			'url'  => $blog_page ? get_permalink( $blog_page ) : get_post_type_archive_link( 'post' ),
		);
		$categories = get_the_category();
		if ( $categories ) {
			$primary = $categories[0];
			$items[] = array(
				'name' => $primary->name,
				'url'  => get_category_link( $primary ),
			);
		}
		$items[] = array(
			'name' => get_the_title(),
			'url'  => get_permalink(),
		);
	} elseif ( function_exists( 'is_product' ) && is_product() ) {
		$items[] = array(
			'name' => __( 'Sklep', 'bigdiamond-white-prestige' ),
			'url'  => wc_get_page_permalink( 'shop' ),
		);
		$terms = wc_get_product_terms( get_the_ID(), 'product_cat' );
		if ( ! empty( $terms ) ) {
			$term = $terms[0];
			$items[] = array(
				'name' => $term->name,
				'url'  => get_term_link( $term ),
			);
		}
		$items[] = array(
			'name' => get_the_title(),
			'url'  => get_permalink(),
		);
	} elseif ( is_post_type_archive( 'product' ) ) {
		$items[] = array(
			'name' => __( 'Sklep', 'bigdiamond-white-prestige' ),
			'url'  => wc_get_page_permalink( 'shop' ),
		);
	} elseif ( is_archive() ) {
		$items[] = array(
			'name' => get_the_archive_title(),
			'url'  => bigdiamond_white_prestige_current_url(),
		);
	} elseif ( is_search() ) {
		$items[] = array(
			'name' => sprintf( __( 'Wyniki dla: %s', 'bigdiamond-white-prestige' ), get_search_query() ),
			'url'  => bigdiamond_white_prestige_current_url(),
		);
	} elseif ( is_404() ) {
		$items[] = array(
			'name' => __( 'Błąd 404', 'bigdiamond-white-prestige' ),
			'url'  => bigdiamond_white_prestige_current_url(),
		);
	}

	return $items;
}

/**
 * Helper to get the canonical URL for the current request.
 *
 * @return string
 */
function bigdiamond_white_prestige_current_url(): string {
	global $wp;

	if ( is_front_page() ) {
		return home_url( '/' );
	}

	$path = isset( $wp->request ) ? $wp->request : '';

	return home_url( add_query_arg( array(), $path ) );
}
