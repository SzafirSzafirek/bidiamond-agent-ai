<?php
/**
 * Custom footer for BigDIAMOND White Prestige.
 *
 * @package BigDIAMOND_White_Prestige
 */

if ( ! defined( 'ABSPATH' ) ) {
        exit;
}

?>
        </div><!-- #content -->

        <footer class="site-footer" role="contentinfo" aria-label="<?php esc_attr_e( 'Stopka strony BigDIAMOND White Prestige', 'bigdiamond-white-prestige' ); ?>">
                <div class="container footer-grid">
                        <div class="footer-column footer-column--brand">
                                <?php
                                if ( function_exists( 'bigdiamond_white_prestige_header_brand' ) ) {
                                        bigdiamond_white_prestige_header_brand(
                                                array(
                                                        'class'      => 'brand footer-brand__link',
                                                        'aria-label' => __( 'Powrót na stronę główną BigDIAMOND', 'bigdiamond-white-prestige' ),
                                                )
                                        );
                                }
                                ?>
                                <p class="footer-tagline"><?php esc_html_e( 'Prototyp interfejsu White Prestige – luksusowa biżuteria szyta na miarę.', 'bigdiamond-white-prestige' ); ?></p>
                                <p class="footer-meta">© <?php echo esc_html( date_i18n( 'Y' ) ); ?> BigDIAMOND • White Prestige</p>
                        </div>
                        <div class="footer-column">
                                <h4 class="footer-heading"><?php esc_html_e( 'Pomoc', 'bigdiamond-white-prestige' ); ?></h4>
                                <ul class="footer-list" role="list">
                                        <li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>"><?php esc_html_e( 'FAQ', 'bigdiamond-white-prestige' ); ?></a></li>
                                        <li><a href="<?php echo esc_url( home_url( '/zwroty/' ) ); ?>"><?php esc_html_e( 'Zwroty i gwarancje', 'bigdiamond-white-prestige' ); ?></a></li>
                                        <li><a href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>"><?php esc_html_e( 'Kontakt', 'bigdiamond-white-prestige' ); ?></a></li>
                                        <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Aktualności', 'bigdiamond-white-prestige' ); ?></a></li>
                                </ul>
                        </div>
                        <div class="footer-column">
                                <h4 class="footer-heading"><?php esc_html_e( 'Konto', 'bigdiamond-white-prestige' ); ?></h4>
                                <ul class="footer-list" role="list">
                                        <li><a href="<?php echo esc_url( home_url( '/moje-konto/' ) ); ?>"><?php esc_html_e( 'Moje konto', 'bigdiamond-white-prestige' ); ?></a></li>
                                        <li><a href="<?php echo esc_url( home_url( '/koszyk/' ) ); ?>"><?php esc_html_e( 'Koszyk', 'bigdiamond-white-prestige' ); ?></a></li>
                                        <li><a href="<?php echo esc_url( home_url( '/zamowienia/' ) ); ?>"><?php esc_html_e( 'Zamówienia', 'bigdiamond-white-prestige' ); ?></a></li>
                                        <li><a href="<?php echo esc_url( home_url( '/sklep/' ) ); ?>"><?php esc_html_e( 'Sklep', 'bigdiamond-white-prestige' ); ?></a></li>
                                </ul>
                        </div>
                        <div class="footer-column footer-column--contact">
                                <h4 class="footer-heading"><?php esc_html_e( 'Kontakt', 'bigdiamond-white-prestige' ); ?></h4>
                                <ul class="footer-list" role="list">
                                        <li><a href="tel:+48221234567" aria-label="<?php esc_attr_e( 'Zadzwoń do BigDIAMOND', 'bigdiamond-white-prestige' ); ?>">+48 22 123 45 67</a></li>
                                        <li><a href="mailto:kontakt@bigdiamond.prestige" aria-label="<?php esc_attr_e( 'Napisz do BigDIAMOND', 'bigdiamond-white-prestige' ); ?>">kontakt@bigdiamond.prestige</a></li>
                                        <li><span><?php esc_html_e( 'Aleje Diamentowe 1, Warszawa', 'bigdiamond-white-prestige' ); ?></span></li>
                                        <li><span><?php esc_html_e( 'Pon – Sob: 10:00 – 19:00', 'bigdiamond-white-prestige' ); ?></span></li>
                                </ul>
                        </div>
                </div>
                <nav class="footer-policy" aria-label="<?php esc_attr_e( 'Polityki i regulaminy BigDIAMOND', 'bigdiamond-white-prestige' ); ?>">
                        <ul class="footer-policy__list" role="list">
                                <li><a href="<?php echo esc_url( home_url( '/polityka-prywatnosci/' ) ); ?>"><?php esc_html_e( 'Polityka prywatności', 'bigdiamond-white-prestige' ); ?></a></li>
                                <li><a href="<?php echo esc_url( home_url( '/regulamin/' ) ); ?>"><?php esc_html_e( 'Regulamin', 'bigdiamond-white-prestige' ); ?></a></li>
                                <li><a href="<?php echo esc_url( home_url( '/zwroty/' ) ); ?>"><?php esc_html_e( 'Zwroty', 'bigdiamond-white-prestige' ); ?></a></li>
                                <li><a href="<?php echo esc_url( home_url( '/wysylka/' ) ); ?>"><?php esc_html_e( 'Wysyłka', 'bigdiamond-white-prestige' ); ?></a></li>
                                <li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>"><?php esc_html_e( 'Najczęstsze pytania', 'bigdiamond-white-prestige' ); ?></a></li>
                        </ul>
                </nav>
        </footer>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
