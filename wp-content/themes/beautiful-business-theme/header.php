<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Beautiful_Business_Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'beautiful-business' ); ?></a>

    <header id="masthead" class="site-header">
        <div class="container site-header-inner"> <?php // Container for flex layout ?>
            <div class="site-branding">
                <?php
                if ( has_custom_logo() ) {
                    the_custom_logo();
                } else {
                    if ( is_front_page() && is_home() ) : ?>
                        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php else : ?>
                        <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                    <?php endif;
                    $beautiful_business_description = get_bloginfo( 'description', 'display' );
                    if ( $beautiful_business_description || is_customize_preview() ) : ?>
                        <p class="site-description"><?php echo $beautiful_business_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                    <?php endif;
                }
                ?>
            </div><!-- .site-branding -->

            <nav id="site-navigation" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'beautiful-business' ); ?></button>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'menu-1',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                ) );
                ?>
            </nav><!-- #site-navigation -->

            <div class="header-cta">
                <?php
                $bbt_header_cta_text = get_theme_mod( 'bbt_header_cta_text', __( 'Get a Quote', 'beautiful-business' ) );
                $bbt_header_cta_url = get_theme_mod( 'bbt_header_cta_url', '#contact' );
                if ( ! empty( $bbt_header_cta_text ) && ! empty( $bbt_header_cta_url ) ) :
                ?>
                    <a href="<?php echo esc_url( $bbt_header_cta_url ); ?>" class="button header-cta-button">
                        <?php echo esc_html( $bbt_header_cta_text ); ?>
                    </a>
                <?php endif; ?>
            </div><!-- .header-cta -->
        </div><!-- .site-header-inner -->
    </header><!-- #masthead -->

    <div id="content" class="site-content container">
