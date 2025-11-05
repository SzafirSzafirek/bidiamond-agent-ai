<?php
/**
 * About page sections.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

$about_background = 'https://images.unsplash.com/photo-1522312346375-d1a52e2b99b3?auto=format&fit=crop&w=1600&q=80';
$team_images      = array(
array(
'name'  => 'Anna Lewandowska',
'role'  => __( 'Główna projektantka biżuterii', 'bigdiamond-white-prestige' ),
'image' => 'https://images.unsplash.com/photo-1544723795-3fb6469f5b39?auto=format&fit=crop&w=600&q=80',
),
array(
'name'  => 'Michał Maj',
'role'  => __( 'Mistrz złotnictwa', 'bigdiamond-white-prestige' ),
'image' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=600&q=80',
),
array(
'name'  => 'Zofia Wysocka',
'role'  => __( 'Ekspertka ds. gemmologii', 'bigdiamond-white-prestige' ),
'image' => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=600&q=80',
),
);
?>
<section class="bdwp-about page-container" aria-labelledby="bdwp-about-heading">
<header class="bdwp-about__hero" style="--bdwp-about-bg: url('<?php echo esc_url( $about_background ); ?>');">
<div class="bdwp-about__hero-inner">
<p class="bdwp-kicker section-eyebrow"><?php esc_html_e( 'Od 1998 roku tworzymy historie zapisane w diamentach', 'bigdiamond-white-prestige' ); ?></p>
<h1 id="bdwp-about-heading" class="bdwp-about__title page-title"><?php esc_html_e( 'O BigDIAMOND White Prestige', 'bigdiamond-white-prestige' ); ?></h1>
<p class="bdwp-about__lead page-subtitle"><?php esc_html_e( 'Jesteśmy rodzinną manufakturą, która łączy tradycyjne rzemiosło z nowoczesną technologią, aby kreować wyjątkową biżuterię dla najbardziej wymagających klientów.', 'bigdiamond-white-prestige' ); ?></p>
<a class="bdwp-button" href="<?php echo esc_url( home_url( '/kontakt' ) ); ?>" role="button">
<?php esc_html_e( 'Umów konsultację', 'bigdiamond-white-prestige' ); ?>
</a>
</div>
</header>
<div class="bdwp-about__content">
<section class="bdwp-about__story" aria-labelledby="bdwp-about-story">
<h2 id="bdwp-about-story" class="bdwp-section-title"><?php esc_html_e( 'Nasza historia', 'bigdiamond-white-prestige' ); ?></h2>
<p><?php esc_html_e( 'BigDIAMOND narodził się z pasji do piękna i precyzji. Każdy pierścionek tworzymy ręcznie w warszawskim atelier, dbając o zrównoważone pozyskiwanie kamieni i etyczne łańcuchy dostaw.', 'bigdiamond-white-prestige' ); ?></p>
<p><?php esc_html_e( 'Współpracujemy wyłącznie z certyfikowanymi dostawcami diamentów (GIA i HRD). Nasze projekty powstają w ścisłej współpracy z klientem – od szkicu, przez dobór kamieni, aż po finalne wykończenie.', 'bigdiamond-white-prestige' ); ?></p>
</section>
<section class="bdwp-about__values" aria-labelledby="bdwp-about-values">
<h2 id="bdwp-about-values" class="bdwp-section-title"><?php esc_html_e( 'Wartości, którymi się kierujemy', 'bigdiamond-white-prestige' ); ?></h2>
<ul class="bdwp-about__values-grid">
<li>
<h3><?php esc_html_e( 'Rzemiosło najwyższej próby', 'bigdiamond-white-prestige' ); ?></h3>
<p><?php esc_html_e( 'Zespół mistrzów złotnictwa i gemmologów nadzoruje każdy etap powstawania biżuterii.', 'bigdiamond-white-prestige' ); ?></p>
</li>
<li>
<h3><?php esc_html_e( 'Personalizacja bez kompromisów', 'bigdiamond-white-prestige' ); ?></h3>
<p><?php esc_html_e( 'Indywidualne konsultacje, personal shopper i wizualizacje 3D gwarantują perfekcyjne dopasowanie.', 'bigdiamond-white-prestige' ); ?></p>
</li>
<li>
<h3><?php esc_html_e( 'Odpowiedzialność i transparentność', 'bigdiamond-white-prestige' ); ?></h3>
<p><?php esc_html_e( 'Dbamy o zrównoważone pozyskiwanie kruszców oraz przejrzystą komunikację o pochodzeniu kamieni.', 'bigdiamond-white-prestige' ); ?></p>
</li>
</ul>
</section>
<section class="bdwp-about__team" aria-labelledby="bdwp-about-team">
<h2 id="bdwp-about-team" class="bdwp-section-title"><?php esc_html_e( 'Poznaj zespół', 'bigdiamond-white-prestige' ); ?></h2>
<div class="bdwp-about__team-grid">
<?php foreach ( $team_images as $member ) : ?>
<article class="bdwp-team-card" aria-label="<?php echo esc_attr( $member['name'] ); ?>">
<figure>
<img src="<?php echo esc_url( $member['image'] ); ?>" alt="<?php echo esc_attr( $member['name'] ); ?>" loading="lazy" width="320" height="400" decoding="async" />
<figcaption>
<strong><?php echo esc_html( $member['name'] ); ?></strong>
<span><?php echo esc_html( $member['role'] ); ?></span>
</figcaption>
</figure>
</article>
<?php endforeach; ?>
</div>
</section>
<section class="bdwp-about__cta" aria-labelledby="bdwp-about-cta">
<div class="bdwp-about__cta-inner">
<h2 id="bdwp-about-cta"><?php esc_html_e( 'Zaprojektuj pierścionek swoich marzeń', 'bigdiamond-white-prestige' ); ?></h2>
<p><?php esc_html_e( 'Umów prywatną konsultację z naszym stylistą, aby wspólnie stworzyć wyjątkowy symbol miłości.', 'bigdiamond-white-prestige' ); ?></p>
<a class="bdwp-button bdwp-button--light" href="<?php echo esc_url( home_url( '/kontakt' ) ); ?>" role="button">
<?php esc_html_e( 'Skontaktuj się z nami', 'bigdiamond-white-prestige' ); ?>
</a>
</div>
</section>
</div>
</section>
