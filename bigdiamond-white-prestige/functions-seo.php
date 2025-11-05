<?php
/**
 * Dynamic SEO helpers for BigDIAMOND White Prestige.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
        exit;
}

global $bigdiamond_white_prestige_seo_context;
$bigdiamond_white_prestige_seo_context = array(
        'title'       => '',
        'description' => '',
        'keywords'    => '',
        'canonical'   => '',
        'robots'      => '',
        'schema'      => array(),
        'type'        => '',
);

/**
 * Merge SEO data for current request.
 *
 * @param array $data Context data such as title, description, canonical.
 *
 * @return void
 */
function bigdiamond_white_prestige_set_seo_context( array $data ): void {
        global $bigdiamond_white_prestige_seo_context;

        $allowed = array( 'title', 'description', 'keywords', 'canonical', 'robots', 'schema', 'type' );

        foreach ( $data as $key => $value ) {
                if ( in_array( $key, $allowed, true ) ) {
                        if ( 'schema' === $key && ! empty( $value ) ) {
                                $value = is_array( $value ) ? array_values( array_filter( $value ) ) : array( $value );
                        }

                        $bigdiamond_white_prestige_seo_context[ $key ] = $value;
                }
        }
}

/**
 * Return SEO data for given key.
 *
 * @param string $key Context key.
 *
 * @return mixed
 */
function bigdiamond_white_prestige_get_seo_context( string $key = '' ) {
        global $bigdiamond_white_prestige_seo_context;

        if ( '' === $key ) {
                return $bigdiamond_white_prestige_seo_context;
        }

        return $bigdiamond_white_prestige_seo_context[ $key ] ?? '';
}

add_filter( 'pre_get_document_title', 'bigdiamond_white_prestige_override_document_title', 20 );
/**
 * Override document title when provided in SEO context.
 *
 * @param string $title Default title.
 *
 * @return string
 */
function bigdiamond_white_prestige_override_document_title( string $title ): string {
        $custom = bigdiamond_white_prestige_get_seo_context( 'title' );

        if ( ! empty( $custom ) ) {
                return wp_strip_all_tags( $custom );
        }

        return $title;
}

add_filter( 'document_title_parts', 'bigdiamond_white_prestige_document_title_parts', 20 );
/**
 * Adjust document title parts to avoid duplicate brand names when custom title supplied.
 *
 * @param array $parts Title parts.
 *
 * @return array
 */
function bigdiamond_white_prestige_document_title_parts( array $parts ): array {
        $custom = bigdiamond_white_prestige_get_seo_context( 'title' );

        if ( ! empty( $custom ) ) {
                $parts['title'] = wp_strip_all_tags( $custom );
        }

        return $parts;
}

add_filter( 'bigdiamond_white_prestige_meta_description', 'bigdiamond_white_prestige_filter_description' );
/**
 * Provide custom meta description when available.
 *
 * @param string $description Default description.
 *
 * @return string
 */
function bigdiamond_white_prestige_filter_description( string $description ): string {
        $custom = bigdiamond_white_prestige_get_seo_context( 'description' );

        if ( ! empty( $custom ) ) {
                return wp_strip_all_tags( $custom );
        }

        return $description;
}

add_action( 'wp_head', 'bigdiamond_white_prestige_print_additional_meta', 6 );
/**
 * Output canonical, robots and keywords meta when provided.
 *
 * @return void
 */
function bigdiamond_white_prestige_print_additional_meta(): void {
        if ( is_admin() ) {
                return;
        }

        $canonical = bigdiamond_white_prestige_get_seo_context( 'canonical' );
        $robots    = bigdiamond_white_prestige_get_seo_context( 'robots' );
        $keywords  = bigdiamond_white_prestige_get_seo_context( 'keywords' );

        if ( ! empty( $canonical ) ) {
                printf( '<link rel="canonical" href="%s" />' . PHP_EOL, esc_url( $canonical ) );
        }

        if ( ! empty( $robots ) ) {
                printf( '<meta name="robots" content="%s" />' . PHP_EOL, esc_attr( $robots ) );
        }

        if ( ! empty( $keywords ) ) {
                printf( '<meta name="keywords" content="%s" />' . PHP_EOL, esc_attr( $keywords ) );
        }
}

add_action( 'wp_head', 'bigdiamond_white_prestige_output_custom_jsonld', 32 );
/**
 * Render custom JSON-LD payload registered for current view.
 *
 * @return void
 */
function bigdiamond_white_prestige_output_custom_jsonld(): void {
        $schemas = bigdiamond_white_prestige_get_seo_context( 'schema' );

        if ( empty( $schemas ) ) {
                return;
        }

        $schemas = is_array( $schemas ) ? $schemas : array( $schemas );

        foreach ( $schemas as $schema ) {
                if ( empty( $schema ) ) {
                        continue;
                }

                echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . PHP_EOL;
        }
}
