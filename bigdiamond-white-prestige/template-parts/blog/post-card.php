<?php
/**
 * Blog post card for listings.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

$post_id = $args['post_id'] ?? get_the_ID();
$post    = get_post( $post_id );

if ( ! $post instanceof WP_Post ) {
return;
}

$thumbnail  = get_the_post_thumbnail_url( $post, 'large' );
$thumbnail  = $thumbnail ? $thumbnail : 'https://images.unsplash.com/photo-1522312346375-d1a52e2b99b3?auto=format&fit=crop&w=1200&q=80';
$categories = get_the_category( $post_id );
?>
<article class="bdwp-post-card" aria-labelledby="post-<?php echo esc_attr( $post_id ); ?>-title">
<a class="bdwp-post-card__thumb" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
<img src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php echo esc_attr( get_the_title( $post_id ) ); ?>" loading="lazy" width="640" height="420" decoding="async" />
</a>
<div class="bdwp-post-card__content">
<p class="bdwp-post-card__meta">
<span class="bdwp-post-card__date"><?php echo esc_html( get_the_date( get_option( 'date_format' ), $post ) ); ?></span>
<?php if ( ! empty( $categories ) ) : ?>
<span class="bdwp-post-card__categories"><?php echo esc_html( implode( ', ', wp_list_pluck( $categories, 'name' ) ) ); ?></span>
<?php endif; ?>
</p>
<h2 id="post-<?php echo esc_attr( $post_id ); ?>-title" class="bdwp-post-card__title">
<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
<?php echo esc_html( get_the_title( $post_id ) ); ?>
</a>
</h2>
<p class="bdwp-post-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt( $post ), 26, '…' ) ); ?></p>
<a class="bdwp-post-card__link" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
<?php esc_html_e( 'Czytaj dalej', 'bigdiamond-white-prestige' ); ?>
<span aria-hidden="true" class="bdwp-post-card__icon"><?php echo bigdiamond_white_prestige_get_icon( 'arrow-right' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
</a>
</div>
</article>
