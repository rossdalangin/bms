<?php
/**
 * Template part for displaying the CTA section on the homepage.
 *
 * @package Beautiful_Business_Theme
 */

$headline = get_theme_mod( 'bbt_cta_headline', __( 'Ready to Start Your Project?', 'beautiful-business' ) );
$text = get_theme_mod( 'bbt_cta_text', __( 'Let\'s work together.', 'beautiful-business' ) );
$button_text = get_theme_mod( 'bbt_cta_button_text', __( 'Contact Us', 'beautiful-business' ) );
$button_url = get_theme_mod( 'bbt_cta_button_url', '#contact' );
?>

<section class="homepage-content-section homepage-cta-section">
    <div class="container">
        <?php if ( ! empty( $headline ) ) : ?>
            <h2 class="cta-headline"><?php echo esc_html( $headline ); ?></h2>
        <?php endif; ?>
        <?php if ( ! empty( $text ) ) : ?>
            <div class="cta-text">
                <?php echo wp_kses_post( $text ); ?>
            </div>
        <?php endif; ?>
        <?php if ( ! empty( $button_text ) && ! empty( $button_url ) ) : ?>
            <a href="<?php echo esc_url( $button_url ); ?>" class="button cta-button"><?php echo esc_html( $button_text ); ?></a>
        <?php endif; ?>
    </div>
</section>
