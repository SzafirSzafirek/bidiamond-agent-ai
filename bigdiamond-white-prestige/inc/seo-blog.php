<?php
/**
 * Blog structured data helpers.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

add_action( 'wp_head', 'bigdiamond_white_prestige_output_blog_schema', 38 );
/**
 * Output Article/BlogPosting schema on single posts.
 *
 * @return void
 */
function bigdiamond_white_prestige_output_blog_schema(): void {
	if ( ! is_singular( 'post' ) ) {
		return;
	}

	$thumbnail = get_the_post_thumbnail_url( get_the_ID(), 'full' );
	if ( ! $thumbnail ) {
		$thumbnail = 'https://images.unsplash.com/photo-1522312346375-d1a52e2b99b3?auto=format&fit=crop&w=1600&q=80';
	}

	$schema = array(
		'@context'      => 'https://schema.org',
		'@type'         => 'BlogPosting',
		'headline'      => get_the_title(),
		'description'   => wp_strip_all_tags( get_the_excerpt() ),
		'url'           => get_permalink(),
		'image'         => $thumbnail,
		'datePublished' => get_the_date( DATE_W3C ),
		'dateModified'  => get_the_modified_date( DATE_W3C ),
		'author'        => array(
			'@type' => 'Person',
			'name'  => get_the_author(),
		),
		'publisher'     => array(
			'@type' => 'Organization',
			'name'  => 'BigDIAMOND White Prestige',
			'logo'  => array(
				'@type' => 'ImageObject',
				'url'   => get_site_icon_url() ? get_site_icon_url() : 'https://images.unsplash.com/photo-1545239351-1141bd82e8a6?auto=format&fit=crop&w=256&q=80',
			),
		),
		'keywords'      => wp_get_post_tags( get_the_ID(), array( 'fields' => 'names' ) ),
	);

	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . PHP_EOL;
}
