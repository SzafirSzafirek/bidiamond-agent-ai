<?php
/**
 * 404 error page.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

get_header();
?>
<main id="primary" class="site-main bdwp-main" role="main" aria-label="<?php esc_attr_e( 'Główna zawartość', 'bigdiamond-white-prestige' ); ?>">
        <section class="bdwp-404 page-container" aria-labelledby="bdwp-404-heading">
                <h1 id="bdwp-404-heading" class="page-title"><?php esc_html_e( 'Strona nie została znaleziona', 'bigdiamond-white-prestige' ); ?></h1>
		<p><?php esc_html_e( 'Przepraszamy, ale wygląda na to, że ta strona nie istnieje. Wróć do strony głównej lub wyszukaj produkt.', 'bigdiamond-white-prestige' ); ?></p>
		<a class="bdwp-button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Powrót na stronę główną', 'bigdiamond-white-prestige' ); ?></a>
		<form role="search" method="get" class="bdwp-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label for="bdwp-404-search" class="screen-reader-text"><?php esc_html_e( 'Szukaj', 'bigdiamond-white-prestige' ); ?></label>
			<input id="bdwp-404-search" type="search" name="s" placeholder="<?php esc_attr_e( 'Znajdź pierścionek lub poradę', 'bigdiamond-white-prestige' ); ?>" />
			<button type="submit" class="bdwp-button bdwp-button--light"><?php esc_html_e( 'Szukaj', 'bigdiamond-white-prestige' ); ?></button>
		</form>
		<nav class="bdwp-404__links" aria-label="<?php esc_attr_e( 'Popularne sekcje', 'bigdiamond-white-prestige' ); ?>">
			<ul>
				<li><a href="<?php echo esc_url( home_url( '/sklep' ) ); ?>"><?php esc_html_e( 'Sklep', 'bigdiamond-white-prestige' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/o-nas' ) ); ?>"><?php esc_html_e( 'O nas', 'bigdiamond-white-prestige' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/kontakt' ) ); ?>"><?php esc_html_e( 'Kontakt', 'bigdiamond-white-prestige' ); ?></a></li>
			</ul>
		</nav>
	</section>
</main>
<?php
get_footer();
