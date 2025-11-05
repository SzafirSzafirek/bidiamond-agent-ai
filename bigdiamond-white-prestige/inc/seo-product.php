<?php
/**
 * Product structured data.
 *
 * ZMODERNIZOWANA WERSJA:
 * - Dodaje pętlę dla indywidualnych opinii (Schema 'review').
 * - Dodaje obsługę GTIN/MPN dla lepszego dopasowania w Google Shopping.
 * - Używa pełnego opisu jako fallback, jeśli krótki jest pusty.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

add_action( 'wp_head', 'bigdiamond_white_prestige_output_product_schema', 35 );
/**
 * Output JSON-LD schema for WooCommerce products.
 *
 * @return void
 */
function bigdiamond_white_prestige_output_product_schema(): void {
	if ( ! function_exists( 'is_product' ) || ! is_product() ) {
		return;
	}

	$product = function_exists( 'wc_get_product' ) ? wc_get_product( get_the_ID() ) : null;

	if ( ! $product instanceof \WC_Product ) {
		return;
	}

	$image_id = $product->get_image_id();
	$image    = $image_id ? wp_get_attachment_image_url( $image_id, 'full' ) : 'https://images.unsplash.com/photo-1516632664305-eda5d6f75246?auto=format&fit=crop&w=1400&q=80';

	// Użyj krótkiego opisu, a jeśli go brak, użyj głównego opisu
	$description = wp_strip_all_tags( $product->get_short_description() );
	if ( empty( $description ) ) {
		$description = wp_strip_all_tags( wp_trim_words( $product->get_description(), 50, '...' ) );
	}

	// === NOWOŚĆ: Pobierz GTIN lub MPN ===
	$gtin = get_post_meta( $product->get_id(), '_gtin', true );
	$mpn  = get_post_meta( $product->get_id(), '_mpn', true );

	$schema = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'Product',
		'name'        => $product->get_name(),
		'description' => $description,
		'image'       => $image,
		'sku'         => $product->get_sku() ? $product->get_sku() : (string) $product->get_id(),
		'url'         => get_permalink(),
		'brand'       => array(
			'@type' => 'Brand',
			'name'  => 'BigDIAMOND White Prestige', // Zgodne z motywem
		),
		'offers'      => array(
			'@type'           => 'Offer',
			'priceCurrency'   => get_woocommerce_currency(),
			'price'           => wc_format_decimal( $product->get_price(), wc_get_price_decimals() ),
			'availability'    => $product->is_in_stock() ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
			'url'             => get_permalink(),
			'itemCondition'   => 'https://schema.org/NewCondition',
			'priceValidUntil' => gmdate( 'Y-m-d', strtotime( '+1 year' ) ),
		),
	);

	// === NOWOŚĆ: Dodaj identyfikatory globalne ===
	if ( ! empty( $gtin ) ) {
		// Preferuj GTIN (np. EAN, UPC, ISBN)
		$schema['gtin13'] = $gtin;
	} elseif ( ! empty( $mpn ) ) {
		// Jeśli brak GTIN, użyj MPN (Manufacturer Part Number)
		$schema['mpn'] = $mpn;
	}

	// === AKTUALIZACJA: Dodaj AggregateRating (jeśli są opinie) ===
	if ( $product->get_review_count() > 0 ) {
		$schema['aggregateRating'] = array(
			'@type'       => 'AggregateRating',
			'ratingValue' => $product->get_average_rating(),
			'reviewCount' => $product->get_review_count(),
		);

		// === NOWOŚĆ: Dodaj indywidualne opinie (review) ===
		$comments = get_comments(
			array(
				'post_id' => $product->get_id(),
				'status'  => 'approve',
				'type'    => 'review',
				'number'  => 5, // Pobierz 5 najnowszych opinii
			)
		);

		if ( ! empty( $comments ) ) {
			$schema['review'] = array();
			foreach ( $comments as $comment ) {
				$rating = get_comment_meta( $comment->comment_ID, 'rating', true );
				if ( ! $rating ) {
					continue;
				}
				$schema['review'][] = array(
					'@type'         => 'Review',
					'author'        => array(
						'@type' => 'Person',
						'name'  => $comment->comment_author,
					),
					'datePublished' => get_comment_date( DATE_W3C, $comment->comment_ID ),
					'reviewBody'    => wp_strip_all_tags( $comment->comment_content ),
					'reviewRating'  => array(
						'@type'       => 'Rating',
						'ratingValue' => $rating,
						'bestRating'  => '5',
					),
				);
			}
		}
	}

	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . PHP_EOL;
}