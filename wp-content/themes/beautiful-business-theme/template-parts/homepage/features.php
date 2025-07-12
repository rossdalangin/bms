<?php
/**
 * Template part for displaying the features section on the homepage.
 *
 * @package Beautiful_Business_Theme
 */

?>

<section class="homepage-content-section homepage-features-section">
    <div class="container">
        <div class="features-grid">
            <?php for ( $i = 1; $i <= 3; $i++ ) :
                $icon = get_theme_mod( "bbt_feature_{$i}_icon", 'dashicons-star-filled' );
                $title = get_theme_mod( "bbt_feature_{$i}_title", sprintf( __( 'Feature %d', 'beautiful-business' ), $i ) );
                $text = get_theme_mod( "bbt_feature_{$i}_text", __( 'Enter a short description for this feature.', 'beautiful-business' ) );
            ?>
                <div class="feature-item">
                    <?php if ( ! empty( $icon ) ) : ?>
                        <span class="dashicons <?php echo esc_attr( $icon ); ?>"></span>
                    <?php endif; ?>
                    <?php if ( ! empty( $title ) ) : ?>
                        <h3 class="feature-title"><?php echo esc_html( $title ); ?></h3>
                    <?php endif; ?>
                    <?php if ( ! empty( $text ) ) : ?>
                        <div class="feature-text">
                            <?php echo wp_kses_post( $text ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section>
