<?php
/**
 * Template part for displaying the hero section on the homepage.
 *
 * @package Beautiful_Business_Theme
 */

$hero_title = get_theme_mod( 'bbt_hero_title', __( 'Welcome to Beautiful Business', 'beautiful-business' ) );
$hero_subtitle = get_theme_mod( 'bbt_hero_subtitle', __( 'Your success is our priority. Discover our services.', 'beautiful-business' ) );
$hero_button_text = get_theme_mod( 'bbt_hero_button_text', __( 'Learn More', 'beautiful-business' ) );
$hero_button_url = get_theme_mod( 'bbt_hero_button_url', '#services' );
$hero_bg_image = get_theme_mod( 'bbt_hero_background_image', '' );
$hero_text_align = get_theme_mod( 'bbt_hero_text_align', 'center' );

$hero_classes = 'homepage-hero-section';
if ( ! empty( $hero_bg_image ) ) {
    $hero_classes .= ' has-background-image';
}

$hero_style = '';
if ( ! empty( $hero_bg_image ) ) {
    $hero_style = 'style="background-image: url(' . esc_url( $hero_bg_image ) . ');"';
}
?>

<section id="homepage-hero" class="<?php echo esc_attr( $hero_classes ); ?>" <?php echo $hero_style; ?>>
    <div class="container hero-content-container" style="text-align: <?php echo esc_attr( $hero_text_align ); ?>;">
        <?php if ( ! empty( $hero_title ) ) : ?>
            <h1 class="hero-main-title"><?php echo esc_html( $hero_title ); ?></h1>
        <?php endif; ?>

        <?php if ( ! empty( $hero_subtitle ) ) : ?>
            <p class="hero-main-subtitle"><?php echo wp_kses_post( $hero_subtitle ); ?></p>
        <?php endif; ?>

        <?php if ( ! empty( $hero_button_text ) && ! empty( $hero_button_url ) ) : ?>
            <a href="<?php echo esc_url( $hero_button_url ); ?>" class="button hero-main-button"><?php echo esc_html( $hero_button_text ); ?></a>
        <?php endif; ?>
    </div>
</section>
