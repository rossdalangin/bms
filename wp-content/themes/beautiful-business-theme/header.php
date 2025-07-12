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
        <div class="site-branding container">
            <?php
            // the_custom_logo(); // We'll add support for this later
            if ( is_front_page() && is_home() ) :
                ?>
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php
            else :
                ?>
                <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                <?php
            endif;
            $beautiful_business_description = get_bloginfo( 'description', 'display' );
            if ( $beautiful_business_description || is_customize_preview() ) :
                ?>
                <p class="site-description"><?php echo $beautiful_business_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
            <?php endif; ?>
        </div><!-- .site-branding -->

        <nav id="site-navigation" class="main-navigation container">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'beautiful-business' ); ?></button>
            <?php
            // wp_nav_menu( array(
            // 'theme_location' => 'menu-1',
            // 'menu_id'        => 'primary-menu',
            // ) ); // We'll register this later
            // echo '<p class="nav-placeholder">' . esc_html__('Navigation Menu Placeholder', 'beautiful-business') . '</p>';
            wp_nav_menu( array(
                'theme_location' => 'menu-1',
                'menu_id'        => 'primary-menu',
                'container'      => false,
                'fallback_cb'    => false,
                'depth'          => 2,
            ) );
            // Fallback for menu
            if ( ! has_nav_menu( 'menu-1' ) ) {
                echo '<ul id="primary-menu" class="menu nav-menu">';
                echo '<li class="menu-item"><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Assign a menu', 'beautiful-business' ) . '</a></li>';
                echo '</ul>';
            }
            ?>
        </nav><!-- #site-navigation -->
    </header><!-- #masthead -->

    <div id="content" class="site-content container">
