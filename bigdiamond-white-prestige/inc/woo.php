<?php
/**
 * WooCommerce integration adjustments.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

add_filter( 'loop_shop_columns', 'bigdiamond_white_prestige_loop_columns' );
/**
 * Control WooCommerce shop columns.
 *
 * @return int
 */
function bigdiamond_white_prestige_loop_columns(): int {
	return wp_is_mobile() ? 2 : 4;
}

add_filter( 'loop_shop_per_page', 'bigdiamond_white_prestige_products_per_page' );
/**
 * Set number of products per page.
 *
 * @return int
 */
function bigdiamond_white_prestige_products_per_page(): int {
	return 12;
}

add_action( 'after_setup_theme', 'bigdiamond_white_prestige_remove_sidebar', 20 );
/**
 * Remove sidebar from WooCommerce templates for cleaner layout.
 *
 * @return void
 */
function bigdiamond_white_prestige_remove_sidebar(): void {
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
}

add_filter( 'woocommerce_single_product_image_gallery_classes', 'bigdiamond_white_prestige_gallery_classes' );
/**
 * Add custom class to product gallery for styling.
 *
 * @param array $classes Gallery classes.
 *
 * @return array
 */
function bigdiamond_white_prestige_gallery_classes( array $classes ): array {
	$classes[] = 'bdwp-gallery';

	return $classes;
}

add_filter( 'wp_get_attachment_image_attributes', 'bigdiamond_white_prestige_filter_thumbnail_attrs', 10, 3 );
/**
 * Ensure lazy loading on WooCommerce thumbnails.
 *
 * @param array  $attr       Attributes.
 * @param object $attachment Image data.
 * @param string $size       Image size.
 *
 * @return array
 */
function bigdiamond_white_prestige_filter_thumbnail_attrs( array $attr, $attachment, string $size ): array {
	if ( 'woocommerce_thumbnail' === $size ) {
		$attr['loading']       = 'lazy';
		$attr['fetchpriority'] = 'low';
		$attr['decoding']      = 'async';
	}

	return $attr;
}

add_filter( 'woocommerce_loop_add_to_cart_args', 'bigdiamond_white_prestige_loop_add_to_cart_args', 10, 2 );
/**
 * Enhance add to cart buttons with accessibility attributes.
 *
 * @param array      $args    Default arguments.
 * @param WC_Product $product Product object.
 *
 * @return array
 */
function bigdiamond_white_prestige_loop_add_to_cart_args( array $args, $product ): array {
	$args['attributes'] = isset( $args['attributes'] ) ? $args['attributes'] : array();
	$args['attributes']['aria-label'] = sprintf(
		/* translators: %s: product name */
		__( 'Dodaj %s do koszyka', 'bigdiamond-white-prestige' ),
		$product->get_name()
	);

	$existing_class = isset( $args['class'] ) ? $args['class'] : '';
	if ( false === strpos( $existing_class, 'btn' ) ) {
		$args['class'] = trim( $existing_class . ' btn' );
	}

	return $args;
}

add_filter( 'woocommerce_product_single_add_to_cart_class', 'bigdiamond_white_prestige_single_add_to_cart_class', 10, 2 );
/**
 * Append global CTA classes to single product add-to-cart buttons.
 *
 * @param string     $class   Current classes.
 * @param WC_Product $product Product instance.
 *
 * @return string
 */
function bigdiamond_white_prestige_single_add_to_cart_class( string $class, $product ): string {
	if ( false === strpos( $class, 'btn' ) ) {
		$class .= ' btn';
	}

	return trim( $class );
}

add_filter( 'woocommerce_product_tabs', 'bigdiamond_white_prestige_customize_product_tabs' );
/**
 * Add custom FAQ tab to the product page.
 *
 * @param array $tabs Default tabs.
 *
 * @return array
 */
function bigdiamond_white_prestige_customize_product_tabs( array $tabs ): array {
	if ( function_exists( 'bigdiamond_white_prestige_get_faq_items' ) ) {
		$tabs['bdwp_faq'] = array(
			'title'    => __( 'FAQ', 'bigdiamond-white-prestige' ),
			'priority' => 80,
			'callback' => 'bigdiamond_white_prestige_render_product_faq_tab',
		);
	}

	return $tabs;
}

/**
 * Render FAQ tab content.
 *
 * ULEPSZONA WERSJA: Renderuje interaktywny akordeon,
 * spójny z resztą motywu (np. page-faq.php).
 *
 * @return void
 */
function bigdiamond_white_prestige_render_product_faq_tab(): void {
	if ( ! function_exists( 'bigdiamond_white_prestige_get_faq_items' ) ) {
		return;
	}

	$items = bigdiamond_white_prestige_get_faq_items();

	if ( empty( $items ) ) {
		echo '<p>' . esc_html__( 'Brak dodatkowych pytań dla tego produktu.', 'bigdiamond-white-prestige' ) . '</p>';
		return;
	}

	// Użyj tej samej struktury co page-faq.php dla spójnego wyglądu i działania JS
	echo '<dl class="bdwp-faq bdwp-faq--product" role="list">';
	foreach ( $items as $index => $item ) {
		$faq_id    = 'product-faq-' . esc_attr( (string) $index );
		$panel_id  = 'product-faq-panel-' . esc_attr( (string) $index );
		$question  = esc_html( $item['question'] );
		$answer    = esc_html( $item['answer'] );
		?>
		<dt id="<?php echo $faq_id; ?>">
			<button class="bdwp-faq__toggle" type="button" aria-expanded="false" aria-controls="<?php echo $panel_id; ?>">
				<?php echo $question; ?>
			</button>
		</dt>
		<dd class="bdwp-faq__panel" id="<?php echo $panel_id; ?>" hidden aria-labelledby="<?php echo $faq_id; ?>">
			<p><?php echo $answer; ?></p>
		</dd>
		<?php
	}
	echo '</dl>';
}
add_filter( 'woocommerce_checkout_fields', 'bigdiamond_white_prestige_optimize_checkout_fields' );
/**
 * Streamline checkout fields for better UX.
 *
 * @param array $fields Checkout fields.
 *
 * @return array
 */
function bigdiamond_white_prestige_optimize_checkout_fields( array $fields ): array {
	if ( isset( $fields['billing']['billing_company'] ) ) {
		$fields['billing']['billing_company']['required'] = false;
	}
	if ( isset( $fields['billing']['billing_phone'] ) ) {
		$fields['billing']['billing_phone']['placeholder'] = __( 'Numer telefonu (dla kuriera)', 'bigdiamond-white-prestige' );
	}
	if ( isset( $fields['billing']['billing_address_2'] ) ) {
		$fields['billing']['billing_address_2']['placeholder'] = __( 'Dodatkowe informacje o adresie', 'bigdiamond-white-prestige' );
		$fields['billing']['billing_address_2']['required']    = false;
	}
	if ( isset( $fields['order']['order_comments'] ) ) {
		$fields['order']['order_comments']['placeholder'] = __( 'Instrukcje dla złotnika lub kuriera (opcjonalnie)', 'bigdiamond-white-prestige' );
	}

	return $fields;
}

/**
 * Display recently viewed products below the product summary.
 *
 * @return void
 */
function bigdiamond_white_prestige_recently_viewed_products(): void {
	if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) ) {
		return;
	}

	$cookie = sanitize_text_field( wp_unslash( (string) $_COOKIE['woocommerce_recently_viewed'] ) );
	$viewed = array_filter( array_map( 'absint', explode( '|', $cookie ) ) );
	$viewed = array_reverse( array_unique( $viewed ) );
	$viewed = array_diff( $viewed, array( get_the_ID() ) );
	$viewed = array_slice( $viewed, 0, 4 );

	if ( empty( $viewed ) ) {
		return;
	}

	$query = new WP_Query(
		array(
			'post_type'      => 'product',
			'post__in'       => $viewed,
			'orderby'        => 'post__in',
			'posts_per_page' => count( $viewed ),
		)
	);

	if ( ! $query->have_posts() ) {
		wp_reset_postdata();
		return;
	}

	echo '<section class="bdwp-recently-viewed" aria-labelledby="bdwp-recently-viewed-heading">';
	echo '<h2 id="bdwp-recently-viewed-heading">' . esc_html__( 'Ostatnio oglądane', 'bigdiamond-white-prestige' ) . '</h2>';
	echo '<div class="bdwp-recently-viewed__grid">';
	while ( $query->have_posts() ) {
		$query->the_post();
		wc_get_template_part( 'content', 'product' );
	}
	echo '</div>';
	echo '</section>';

	wp_reset_postdata();
}
