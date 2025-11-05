<?php
/**
 * Offer section template.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

?>
<section class="expertise" id="bdwp-expertise" aria-labelledby="expertise-title">
	<div class="expertise__container">
		<p class="section-eyebrow"><?php esc_html_e( 'BigDIAMOND Expertise', 'bigdiamond-white-prestige' ); ?></p>
		<h2 class="expertise__title" id="expertise-title"><?php esc_html_e( 'Oferta szyta na miarę Twoich emocji', 'bigdiamond-white-prestige' ); ?></h2>
		<p class="expertise__intro"><?php esc_html_e( 'Łączymy technologię z tradycją jubilerską, aby powstały projekty celebrujące przełomowe momenty.', 'bigdiamond-white-prestige' ); ?></p>
		<div class="expertise__grid" role="list">
			<article class="expertise__card" role="button" tabindex="0" aria-pressed="false">
				<div class="expertise__icon" aria-hidden="true">
					<svg width="64" height="64" viewBox="0 0 64 64" fill="none" role="img" aria-hidden="true">
						<path d="M32 4l16 12-6 32-10 10-10-10-6-32z" stroke="currentColor" stroke-width="2" fill="rgba(212,175,55,0.12)" />
						<circle cx="32" cy="28" r="8" fill="currentColor" opacity="0.4" />
					</svg>
				</div>
				<h3 class="expertise__heading"><?php esc_html_e( 'Pierścionki zaręczynowe', 'bigdiamond-white-prestige' ); ?></h3>
				<p class="expertise__text"><?php esc_html_e( 'Indywidualne projekty z certyfikowanymi diamentami i wykończeniem haute joaillerie.', 'bigdiamond-white-prestige' ); ?></p>
			</article>
			<article class="expertise__card" role="button" tabindex="0" aria-pressed="false">
				<div class="expertise__icon" aria-hidden="true">
					<svg width="64" height="64" viewBox="0 0 64 64" fill="none" role="img" aria-hidden="true">
						<rect x="12" y="12" width="40" height="40" rx="12" stroke="currentColor" stroke-width="2" fill="rgba(212,175,55,0.12)" />
						<path d="M22 42l20-20" stroke="currentColor" stroke-width="2.5" />
						<path d="M30 42l12-12" stroke="currentColor" stroke-width="2.5" opacity="0.65" />
					</svg>
				</div>
				<h3 class="expertise__heading"><?php esc_html_e( 'Biżuteria ślubna', 'bigdiamond-white-prestige' ); ?></h3>
				<p class="expertise__text"><?php esc_html_e( 'Kompletne zestawy obrączek i dodatków tworzących harmonijną opowieść o miłości.', 'bigdiamond-white-prestige' ); ?></p>
			</article>
			<article class="expertise__card" role="button" tabindex="0" aria-pressed="false">
				<div class="expertise__icon" aria-hidden="true">
					<svg width="64" height="64" viewBox="0 0 64 64" fill="none" role="img" aria-hidden="true">
						<circle cx="32" cy="32" r="20" stroke="currentColor" stroke-width="2" fill="rgba(212,175,55,0.12)" />
						<path d="M24 32c4 8 12 8 16 0" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" />
						<circle cx="26" cy="26" r="3" fill="currentColor" />
						<circle cx="38" cy="26" r="3" fill="currentColor" />
					</svg>
				</div>
				<h3 class="expertise__heading"><?php esc_html_e( 'Personal shopper', 'bigdiamond-white-prestige' ); ?></h3>
				<p class="expertise__text"><?php esc_html_e( 'Dedykowany concierge, który przygotuje prezent dopasowany do Twojego stylu i okazji.', 'bigdiamond-white-prestige' ); ?></p>
			</article>
		</div>
	</div>
</section>
