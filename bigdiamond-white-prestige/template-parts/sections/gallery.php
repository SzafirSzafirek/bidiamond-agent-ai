<?php
/**
 * Gallery section template.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

$gallery_items = array(
array(
'image'         => 'https://images.unsplash.com/photo-1522312346375-d1a52e2b99b3?auto=format&fit=crop&w=1200&q=80',
'srcset'        => 'https://images.unsplash.com/photo-1522312346375-d1a52e2b99b3?auto=format&fit=crop&w=600&q=80 600w, https://images.unsplash.com/photo-1522312346375-d1a52e2b99b3?auto=format&fit=crop&w=1200&q=80 1200w',
'title'         => __( 'Sygnet Aurora – diament 1.5 ct', 'bigdiamond-white-prestige' ),
'alt'           => __( 'Pierścionek soliter na aksamitnym tle', 'bigdiamond-white-prestige' ),
'description'   => __( 'Ręcznie szlifowany diament oprawiony w platynę z satynowym wykończeniem.', 'bigdiamond-white-prestige' ),
'loading'       => 'eager',
'fetchpriority' => 'high',
),
array(
'image'       => 'https://images.unsplash.com/photo-1522312346375-d1a52e2b99b3?auto=format&fit=crop&w=1200&q=80&sat=-25',
'srcset'      => 'https://images.unsplash.com/photo-1522312346375-d1a52e2b99b3?auto=format&fit=crop&w=600&q=80&sat=-25 600w, https://images.unsplash.com/photo-1522312346375-d1a52e2b99b3?auto=format&fit=crop&w=1200&q=80&sat=-25 1200w',
'title'       => __( 'Obrączki Stellar – złoto satynowe', 'bigdiamond-white-prestige' ),
'alt'         => __( 'Komplet obrączek ślubnych w świetle studyjnym', 'bigdiamond-white-prestige' ),
'description' => __( 'Zestaw dopasowanych obrączek z grawerem i mikropawé diamentowym.', 'bigdiamond-white-prestige' ),
),
array(
'image'       => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=1200&q=80',
'srcset'      => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=600&q=80 600w, https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=1200&q=80 1200w',
'title'       => __( 'Halo Celestial – diament w koronie halo', 'bigdiamond-white-prestige' ),
'alt'         => __( 'Pierścionek halo prezentowany na dłoni', 'bigdiamond-white-prestige' ),
'description' => __( 'Diament centralny otoczony pierścieniem z mikropawé i akcentami z różowego złota.', 'bigdiamond-white-prestige' ),
),
array(
'image'       => 'https://images.unsplash.com/photo-1522312346375-d1a52e2b99b3?auto=format&fit=crop&w=1200&q=80&sat=10',
'srcset'      => 'https://images.unsplash.com/photo-1522312346375-d1a52e2b99b3?auto=format&fit=crop&w=600&q=80&sat=10 600w, https://images.unsplash.com/photo-1522312346375-d1a52e2b99b3?auto=format&fit=crop&w=1200&q=80&sat=10 1200w',
'title'       => __( 'Naszyjnik Meridian – diamentowe kaskady', 'bigdiamond-white-prestige' ),
'alt'         => __( 'Naszyjnik diamentowy na lustrzanej tafli', 'bigdiamond-white-prestige' ),
'description' => __( 'Kompozycja brylantów o szlifie gruszkowym i baguette w trzech warstwach.', 'bigdiamond-white-prestige' ),
),
);
?>
<section class="showcase" id="bdwp-showcase" aria-labelledby="showcase-title">
	<div class="showcase__container">
		<p class="section-eyebrow"><?php esc_html_e( 'Signature Showcase', 'bigdiamond-white-prestige' ); ?></p>
		<h2 class="showcase__title" id="showcase-title"><?php esc_html_e( 'Realizacje, które rozświetlają wspomnienia', 'bigdiamond-white-prestige' ); ?></h2>
		<p class="showcase__intro"><?php esc_html_e( 'Współpracujemy z mistrzami złotnictwa, by każdy pierścionek zachował blask i perfekcję przez dekady.', 'bigdiamond-white-prestige' ); ?></p>
		<div class="showcase__grid">
		<?php foreach ( $gallery_items as $index => $item ) :
			$loading       = $item['loading'] ?? 'lazy';
			$fetchpriority = $item['fetchpriority'] ?? 'auto';
		?>
			<figure class="showcase__item">
				<img
					src="<?php echo esc_url( $item['image'] ); ?>"
					srcset="<?php echo esc_attr( $item['srcset'] ); ?>"
					sizes="(max-width: 980px) 100vw, 50vw"
					alt="<?php echo esc_attr( $item['alt'] ); ?>"
					loading="<?php echo esc_attr( $loading ); ?>"
					fetchpriority="<?php echo esc_attr( $fetchpriority ); ?>"
					decoding="async"
					width="1200"
					height="800"
				/>
				<figcaption class="showcase__caption">
					<strong><?php echo esc_html( $item['title'] ); ?></strong>
					<span><?php echo esc_html( $item['description'] ); ?></span>
				</figcaption>
			</figure>
		<?php endforeach; ?>
		</div>
		<a class="showcase__cta btn-cta" href="<?php echo esc_url( home_url( '/realizacje' ) ); ?>"><?php esc_html_e( 'Zobacz wszystkie realizacje', 'bigdiamond-white-prestige' ); ?></a>
	</div>
</section>
