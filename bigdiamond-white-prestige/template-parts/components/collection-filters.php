<?php
/**
 * Filter form for jewelry collections.
 *
 * @package BigDIAMOND_White_Prestige
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
        exit;
}

$filters = $args['filters'] ?? array();
$action  = $args['action'] ?? '#';
?>
<section class="bdwp-section bdwp-collection-filters" aria-labelledby="bdwp-filters-title">
        <div class="bdwp-section__inner">
                <h2 id="bdwp-filters-title" class="bdwp-section__title"><?php esc_html_e( 'Filtruj idealny model', 'bigdiamond-white-prestige' ); ?></h2>
                <form class="bdwp-filters" method="get" action="<?php echo esc_url( $action ); ?>">
                        <div class="bdwp-filters__grid">
                                <?php foreach ( $filters as $filter ) :
                                        $name    = $filter['name'];
                                        $label   = $filter['label'];
                                        $options = $filter['options'];
                                        ?>
                                        <label class="bdwp-filters__field" for="<?php echo esc_attr( $name ); ?>">
                                                <span class="bdwp-filters__label"><?php echo esc_html( $label ); ?></span>
                                                <select id="<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>" class="bdwp-filters__select">
                                                        <option value="">
                                                                <?php esc_html_e( 'Wybierz', 'bigdiamond-white-prestige' ); ?>
                                                        </option>
                                                        <?php foreach ( $options as $value => $text ) : ?>
                                                                <option value="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $text ); ?></option>
                                                        <?php endforeach; ?>
                                                </select>
                                        </label>
                                <?php endforeach; ?>
                        </div>
                        <div class="bdwp-filters__actions">
                                <button class="btn btn--gold" type="submit"><?php esc_html_e( 'Zastosuj filtry', 'bigdiamond-white-prestige' ); ?></button>
                                <a class="btn" href="<?php echo esc_url( $action ); ?>"><?php esc_html_e( 'Wyczyść', 'bigdiamond-white-prestige' ); ?></a>
                        </div>
                </form>
        </div>
</section>
