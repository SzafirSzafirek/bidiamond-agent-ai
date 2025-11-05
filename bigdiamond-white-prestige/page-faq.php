<?php
/**
 * Template Name: FAQ
 * Description: Najczęściej zadawane pytania.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

get_header();

$faq_items = function_exists( 'bigdiamond_white_prestige_get_faq_items' ) ? bigdiamond_white_prestige_get_faq_items() : array();
?>
<main id="primary" class="site-main bdwp-main" role="main" aria-label="<?php esc_attr_e( 'Główna zawartość', 'bigdiamond-white-prestige' ); ?>">
<section class="bdwp-faq-page page-container" aria-labelledby="bdwp-faq-heading">
<header class="bdwp-faq-page__intro">
<p class="bdwp-kicker section-eyebrow"><?php esc_html_e( 'Wiedza ekspercka BigDIAMOND', 'bigdiamond-white-prestige' ); ?></p>
<h1 id="bdwp-faq-heading" class="page-title"><?php esc_html_e( 'Najczęściej zadawane pytania', 'bigdiamond-white-prestige' ); ?></h1>
<p class="page-subtitle"><?php esc_html_e( 'Zebraliśmy odpowiedzi na pytania, które słyszymy w atelier i online. Jeśli nie znajdziesz tutaj informacji, napisz do nas.', 'bigdiamond-white-prestige' ); ?></p>
</header>
<?php if ( ! empty( $faq_items ) ) : ?>
<dl class="bdwp-faq" role="list">
<?php foreach ( $faq_items as $index => $item ) : ?>
<dt id="faq-<?php echo esc_attr( $index ); ?>">
<button class="bdwp-faq__toggle" type="button" aria-expanded="false" aria-controls="faq-panel-<?php echo esc_attr( $index ); ?>">
<?php echo esc_html( $item['question'] ); ?>
</button>
</dt>
<dd class="bdwp-faq__panel" id="faq-panel-<?php echo esc_attr( $index ); ?>" hidden aria-labelledby="faq-<?php echo esc_attr( $index ); ?>">
<p><?php echo esc_html( $item['answer'] ); ?></p>
</dd>
<?php endforeach; ?>
</dl>
<?php endif; ?>
<footer class="bdwp-faq-page__cta">
<h2><?php esc_html_e( 'Masz dodatkowe pytania?', 'bigdiamond-white-prestige' ); ?></h2>
<p><?php esc_html_e( 'Skontaktuj się z naszym concierge, aby otrzymać indywidualną poradę dotyczącą wyboru kamieni i konfiguracji pierścionków.', 'bigdiamond-white-prestige' ); ?></p>
<a class="bdwp-button" href="<?php echo esc_url( home_url( '/kontakt' ) ); ?>">
<?php esc_html_e( 'Napisz do nas', 'bigdiamond-white-prestige' ); ?>
</a>
</footer>
</section>
</main>
<?php
get_footer();
