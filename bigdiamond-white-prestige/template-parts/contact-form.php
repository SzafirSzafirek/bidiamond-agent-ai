<?php
/**
 * Contact page layout with form, map and FAQ.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

$contact_channels = array(
array(
'label' => __( 'Telefon', 'bigdiamond-white-prestige' ),
'value' => '+48 22 123 45 67',
'url'   => 'tel:+48221234567',
'icon'  => 'phone',
),
array(
'label' => 'E-mail',
'value' => 'kontakt@bigdiamond.prestige',
'url'   => 'mailto:kontakt@bigdiamond.prestige',
'icon'  => 'mail',
),
array(
'label' => 'WhatsApp',
'value' => '+48 600 100 200',
'url'   => 'https://wa.me/48600100200',
'icon'  => 'chat',
),
array(
'label' => 'Messenger',
'value' => 'facebook.com/bigdiamond',
'url'   => 'https://m.me/bigdiamond',
'icon'  => 'message-circle',
),
);

$faq_items = function_exists( 'bigdiamond_white_prestige_get_faq_items' ) ? bigdiamond_white_prestige_get_faq_items() : array();

$team_support = array(
array(
'name'  => 'Karolina',
'role'  => __( 'Concierge klienta', 'bigdiamond-white-prestige' ),
'image' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=400&q=80',
),
array(
'name'  => 'Aleksander',
'role'  => __( 'Specjalista ds. logistyki', 'bigdiamond-white-prestige' ),
'image' => 'https://images.unsplash.com/photo-1521119989659-a83eee488004?auto=format&fit=crop&w=400&q=80',
),
);
?>
<section class="bdwp-contact page-container" aria-labelledby="bdwp-contact-heading">
<header class="bdwp-contact__intro">
<p class="bdwp-kicker section-eyebrow"><?php esc_html_e( 'Pozostańmy w kontakcie', 'bigdiamond-white-prestige' ); ?></p>
<h1 id="bdwp-contact-heading" class="page-title"><?php esc_html_e( 'Skontaktuj się z BigDIAMOND', 'bigdiamond-white-prestige' ); ?></h1>
<p class="page-subtitle"><?php esc_html_e( 'Nasze atelier wita klientów od poniedziałku do soboty. Zarezerwuj wizytę, aby obejrzeć kolekcję i stworzyć swój wymarzony pierścionek.', 'bigdiamond-white-prestige' ); ?></p>
</header>
<div class="bdwp-contact__grid">
<section class="bdwp-contact__form" aria-labelledby="bdwp-contact-form">
<h2 id="bdwp-contact-form" class="bdwp-section-title"><?php esc_html_e( 'Formularz kontaktowy', 'bigdiamond-white-prestige' ); ?></h2>
<form class="bdwp-form" action="<?php echo esc_url( home_url( '/kontakt' ) ); ?>" method="post" novalidate>
<div class="bdwp-form__group">
<label for="bdwp-name"><?php esc_html_e( 'Imię', 'bigdiamond-white-prestige' ); ?></label>
<input type="text" id="bdwp-name" name="bdwp-name" autocomplete="name" required aria-required="true" />
</div>
<div class="bdwp-form__group">
<label for="bdwp-email"><?php esc_html_e( 'E-mail', 'bigdiamond-white-prestige' ); ?></label>
<input type="email" id="bdwp-email" name="bdwp-email" autocomplete="email" required aria-required="true" />
</div>
<div class="bdwp-form__group">
<label for="bdwp-message"><?php esc_html_e( 'Twoja wiadomość', 'bigdiamond-white-prestige' ); ?></label>
<textarea id="bdwp-message" name="bdwp-message" rows="5" required aria-required="true"></textarea>
</div>
<div class="bdwp-form__group bdwp-form__group--inline">
<input type="checkbox" id="bdwp-newsletter" name="bdwp-newsletter" value="1" />
<label for="bdwp-newsletter"><?php esc_html_e( 'Chcę otrzymywać newsletter z inspiracjami BigDIAMOND (opcjonalnie)', 'bigdiamond-white-prestige' ); ?></label>
</div>
<button class="bdwp-button" type="submit">
<?php esc_html_e( 'Wyślij wiadomość', 'bigdiamond-white-prestige' ); ?>
</button>
<p class="bdwp-form__privacy"><?php esc_html_e( 'Przesyłając formularz akceptujesz politykę prywatności BigDIAMOND.', 'bigdiamond-white-prestige' ); ?></p>
</form>
</section>
<aside class="bdwp-contact__details" aria-labelledby="bdwp-contact-details">
<h2 id="bdwp-contact-details" class="bdwp-section-title"><?php esc_html_e( 'Jak jeszcze możemy pomóc?', 'bigdiamond-white-prestige' ); ?></h2>
<ul class="bdwp-contact__channels">
<?php foreach ( $contact_channels as $channel ) : ?>
<li>
<a href="<?php echo esc_url( $channel['url'] ); ?>" class="bdwp-contact__channel" aria-label="<?php echo esc_attr( $channel['label'] . ': ' . $channel['value'] ); ?>">
<span class="bdwp-contact__icon" aria-hidden="true">
<?php echo bigdiamond_white_prestige_get_icon( $channel['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</span>
<span>
<strong><?php echo esc_html( $channel['label'] ); ?></strong>
<?php echo esc_html( $channel['value'] ); ?>
</span>
</a>
</li>
<?php endforeach; ?>
</ul>
<div class="bdwp-contact__map" role="region" aria-label="<?php esc_attr_e( 'Mapa dojazdu BigDIAMOND', 'bigdiamond-white-prestige' ); ?>">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2443.549750547225!2d21.01222881580133!3d52.22967597975717!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471ecc669238c4ff%3A0x2b1b1b0!2sWarszawa!5e0!3m2!1spl!2spl!4v1700000000000" width="100%" height="280" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
<address>
<strong><?php esc_html_e( 'Atelier BigDIAMOND', 'bigdiamond-white-prestige' ); ?></strong><br />
Aleje Diamentowe 1, 00-001 Warszawa<br />
<?php esc_html_e( 'Poniedziałek–Piątek', 'bigdiamond-white-prestige' ); ?>: 10:00–19:00<br />
<?php esc_html_e( 'Sobota', 'bigdiamond-white-prestige' ); ?>: 10:00–16:00
</address>
</div>
</aside>
</div>
<section class="bdwp-contact__faq" aria-labelledby="bdwp-contact-faq">
<h2 id="bdwp-contact-faq" class="bdwp-section-title"><?php esc_html_e( 'Najczęściej zadawane pytania', 'bigdiamond-white-prestige' ); ?></h2>
<?php if ( ! empty( $faq_items ) ) : ?>
<dl class="bdwp-faq" role="list">
<?php foreach ( $faq_items as $item ) : ?>
<dt>
<button class="bdwp-faq__toggle" type="button" aria-expanded="false">
<?php echo esc_html( $item['question'] ); ?>
</button>
</dt>
<dd class="bdwp-faq__panel" hidden>
<p><?php echo esc_html( $item['answer'] ); ?></p>
</dd>
<?php endforeach; ?>
</dl>
<?php endif; ?>
</section>
<section class="bdwp-contact__team" aria-labelledby="bdwp-contact-team">
<h2 id="bdwp-contact-team" class="bdwp-section-title"><?php esc_html_e( 'Zespół concierge BigDIAMOND', 'bigdiamond-white-prestige' ); ?></h2>
<div class="bdwp-contact__team-grid">
<?php foreach ( $team_support as $person ) : ?>
<figure class="bdwp-contact__team-card">
<img src="<?php echo esc_url( $person['image'] ); ?>" alt="<?php echo esc_attr( $person['name'] ); ?>" loading="lazy" width="220" height="260" decoding="async" />
<figcaption>
<strong><?php echo esc_html( $person['name'] ); ?></strong>
<span><?php echo esc_html( $person['role'] ); ?></span>
</figcaption>
</figure>
<?php endforeach; ?>
</div>
<p class="bdwp-contact__closing"><?php esc_html_e( 'Napisz lub zadzwoń – odpowiadamy średnio w ciągu 2 godzin roboczych.', 'bigdiamond-white-prestige' ); ?></p>
</section>
</section>
