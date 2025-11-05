<?php
/**
 * FAQ structured data and helpers.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

add_action( 'wp_head', 'bigdiamond_white_prestige_output_faq_schema', 39 );
/**
 * Provide reusable FAQ items.
 *
 * @return array<int,array<string,string>>
 */
function bigdiamond_white_prestige_get_faq_items(): array {
	return array(
		array(
			'question' => __( 'Jak długo trwa przygotowanie pierścionka personalizowanego?', 'bigdiamond-white-prestige' ),
			'answer'   => __( 'Standardowo 10–15 dni roboczych. Projekty ekspresowe realizujemy indywidualnie po konsultacji.', 'bigdiamond-white-prestige' ),
		),
		array(
			'question' => __( 'Czy oferujecie certyfikaty dla diamentów?', 'bigdiamond-white-prestige' ),
			'answer'   => __( 'Każdy diament posiada certyfikat GIA lub HRD oraz szczegółową dokumentację jakości.', 'bigdiamond-white-prestige' ),
		),
		array(
			'question' => __( 'Jak dobrać rozmiar pierścionka?', 'bigdiamond-white-prestige' ),
			'answer'   => __( 'Możesz zamówić zestaw mierników lub odwiedzić nasze atelier. Oferujemy także pierwszą korektę rozmiaru gratis.', 'bigdiamond-white-prestige' ),
		),
		array(
			'question' => __( 'Jakie są opcje dostawy i ubezpieczenia?', 'bigdiamond-white-prestige' ),
			'answer'   => __( 'Wysyłamy ubezpieczonym kurierem DHL Express, InPost oraz concierge w Warszawie. Każda przesyłka ma pełne ubezpieczenie.', 'bigdiamond-white-prestige' ),
		),
		array(
			'question' => __( 'Czy można obejrzeć diamenty przed zakupem?', 'bigdiamond-white-prestige' ),
			'answer'   => __( 'Tak, podczas konsultacji przygotowujemy selekcję diamentów i wizualizacje 3D, aby pomóc w wyborze.', 'bigdiamond-white-prestige' ),
		),
	);
}

/**
 * Output FAQPage schema when relevant.
 *
 * @return void
 */
function bigdiamond_white_prestige_output_faq_schema(): void {
	if ( ! is_page_template( 'page-faq.php' ) && ! is_page_template( 'page-kontakt.php' ) ) {
		return;
	}

	$items = bigdiamond_white_prestige_get_faq_items();

	if ( empty( $items ) ) {
		return;
	}

	$faq_schema = array(
		'@context' => 'https://schema.org',
		'@type'    => 'FAQPage',
		'mainEntity' => array(),
	);

	foreach ( $items as $item ) {
		$faq_schema['mainEntity'][] = array(
			'@type'          => 'Question',
			'name'           => $item['question'],
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => $item['answer'],
			),
		);
	}

	echo '<script type="application/ld+json">' . wp_json_encode( $faq_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . PHP_EOL;
}
