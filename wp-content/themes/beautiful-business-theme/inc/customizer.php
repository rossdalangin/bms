<?php
/**
 * Beautiful Business Theme Customizer functionality
 *
 * @package Beautiful_Business_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function beautiful_business_customize_register( $wp_customize ) {
    // Site Title & Tagline (already partially handled by core, but we can add selective refresh)
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'blogname', array(
            'selector'        => '.site-title a',
            'render_callback' => function() {
                bloginfo( 'name' );
            },
        ) );
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
            'selector'        => '.site-description',
            'render_callback' => function() {
                bloginfo( 'description' );
            },
        ) );
    }

    // More sections, settings, and controls will be added here in subsequent steps.
    // Alias for consistency with the plan
    // $bbt_customize_register = 'beautiful_business_customize_register'; // This alias isn't strictly necessary here. Removing as it's unused.

    // Header Settings Section
    $wp_customize->add_section( 'bbt_header_settings_section', array(
        'title'    => __( 'Header Settings', 'beautiful-business' ),
        'priority' => 20, // High up
    ) );

    // Header CTA Button Text
    $wp_customize->add_setting( 'bbt_header_cta_text', array(
        'default'           => __( 'Get a Quote', 'beautiful-business' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'bbt_header_cta_text_control', array(
        'label'    => __( 'Header Button Text', 'beautiful-business' ),
        'section'  => 'bbt_header_settings_section',
        'settings' => 'bbt_header_cta_text',
        'type'     => 'text',
    ) );

    // Header CTA Button URL
    $wp_customize->add_setting( 'bbt_header_cta_url', array(
        'default'           => '#contact',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'bbt_header_cta_url_control', array(
        'label'    => __( 'Header Button URL', 'beautiful-business' ),
        'section'  => 'bbt_header_settings_section',
        'settings' => 'bbt_header_cta_url',
        'type'     => 'url',
    ) );

    /**
     * Theme Colors Section, Settings, and Controls
     */
    $wp_customize->add_section( 'bbt_theme_colors_section', array(
        'title'    => __( 'Theme Colors', 'beautiful-business' ),
        'priority' => 30,
    ) );

    // Primary Color Setting
    $wp_customize->add_setting( 'bbt_primary_color', array(
        'default'           => '#007bff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bbt_primary_color_control', array(
        'label'    => __( 'Primary Color', 'beautiful-business' ),
        'section'  => 'bbt_theme_colors_section',
        'settings' => 'bbt_primary_color',
    ) ) );

    // Secondary Color Setting
    $wp_customize->add_setting( 'bbt_secondary_color', array(
        'default'           => '#6c757d',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bbt_secondary_color_control', array(
        'label'    => __( 'Secondary Color', 'beautiful-business' ),
        'section'  => 'bbt_theme_colors_section',
        'settings' => 'bbt_secondary_color',
    ) ) );

    // Footer Settings Section
    $wp_customize->add_section( 'bbt_footer_settings_section', array(
        'title'    => __( 'Footer Settings', 'beautiful-business' ),
        'priority' => 120, // Place it towards the end
    ) );

    // Footer Copyright Text Setting
    // Note: Default value in Customizer UI will show placeholders. Actual default on frontend is handled by get_theme_mod.
    $wp_customize->add_setting( 'bbt_copyright_text', array(
        'default'           => __( '&copy; [year] [site_name]. All rights reserved.', 'beautiful-business' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );

    // Footer Copyright Text Control
    $wp_customize->add_control( 'bbt_copyright_text_control', array(
        'label'       => __( 'Copyright Text', 'beautiful-business' ),
        'description' => __( 'Placeholders: [year] for current year, [site_name] for site name.', 'beautiful-business'),
        'section'     => 'bbt_footer_settings_section',
        'settings'    => 'bbt_copyright_text',
        'type'        => 'textarea',
    ) );

    // Homepage Hero Section
    $wp_customize->add_section( 'bbt_homepage_hero_section', array(
        'title'    => __( 'Homepage Hero', 'beautiful-business' ),
        'priority' => 25, // High priority for homepage settings
        'description' => __( 'Settings for the main hero section on the homepage.', 'beautiful-business'),
    ) );

    // Hero Title Setting & Control
    $wp_customize->add_setting( 'bbt_hero_title', array(
        'default'           => __( 'Welcome to Beautiful Business', 'beautiful-business' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'bbt_hero_title_control', array(
        'label'    => __( 'Hero Title', 'beautiful-business' ),
        'section'  => 'bbt_homepage_hero_section',
        'settings' => 'bbt_hero_title',
        'type'     => 'text',
    ) );

    // Hero Subtitle Setting & Control
    $wp_customize->add_setting( 'bbt_hero_subtitle', array(
        'default'           => __( 'Your success is our priority. Discover our services.', 'beautiful-business' ),
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'bbt_hero_subtitle_control', array(
        'label'    => __( 'Hero Subtitle', 'beautiful-business' ),
        'section'  => 'bbt_homepage_hero_section',
        'settings' => 'bbt_hero_subtitle',
        'type'     => 'textarea',
    ) );

    // Hero Button Text Setting & Control
    $wp_customize->add_setting( 'bbt_hero_button_text', array(
        'default'           => __( 'Learn More', 'beautiful-business' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'bbt_hero_button_text_control', array(
        'label'    => __( 'Hero Button Text', 'beautiful-business' ),
        'section'  => 'bbt_homepage_hero_section',
        'settings' => 'bbt_hero_button_text',
        'type'     => 'text',
    ) );

    // Hero Button URL Setting & Control
    $wp_customize->add_setting( 'bbt_hero_button_url', array(
        'default'           => '#services', // Example default link
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'bbt_hero_button_url_control', array(
        'label'    => __( 'Hero Button URL', 'beautiful-business' ),
        'section'  => 'bbt_homepage_hero_section',
        'settings' => 'bbt_hero_button_url',
        'type'     => 'url',
    ) );

    // Hero Background Image Setting & Control
    $wp_customize->add_setting( 'bbt_hero_background_image', array(
        'default'           => '', // No default image
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bbt_hero_background_image_control', array(
        'label'    => __( 'Hero Background Image', 'beautiful-business' ),
        'section'  => 'bbt_homepage_hero_section',
        'settings' => 'bbt_hero_background_image',
    ) ) );


    // Homepage Sections Panel
    $wp_customize->add_panel( 'bbt_homepage_sections_panel', array(
        'title'    => __( 'Homepage Sections', 'beautiful-business' ),
        'priority' => 35, // After Hero (25) and Theme Colors (30)
        'description' => __( 'Manage content sections on the homepage below the main hero area.', 'beautiful-business'),
    ) );

    // --- Services Section Settings ---
    $wp_customize->add_section( 'bbt_homepage_services_settings_section', array( // Renamed for clarity
        'title'    => __( 'Services Section', 'beautiful-business' ),
        'panel'    => 'bbt_homepage_sections_panel',
        'priority' => 10,
    ) );

    // Services Section Title
    $wp_customize->add_setting( 'bbt_services_section_title', array(
        'default'           => __( 'Our Services', 'beautiful-business' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'bbt_services_section_title_control', array(
        'label'    => __( 'Section Title', 'beautiful-business' ),
        'section'  => 'bbt_homepage_services_settings_section',
        'settings' => 'bbt_services_section_title',
        'type'     => 'text',
    ) );

    // Number of Services
    $wp_customize->add_setting( 'bbt_services_section_count', array(
        'default'           => 3,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bbt_services_section_count_control', array(
        'label'    => __( 'Number of Services to Display', 'beautiful-business' ),
        'section'  => 'bbt_homepage_services_settings_section',
        'settings' => 'bbt_services_section_count',
        'type'     => 'number',
        'input_attrs' => array(
            'min' => 1,
            'max' => 9,
            'step' => 1,
        ),
    ) );

    // --- Testimonials Section Settings ---
    $wp_customize->add_section( 'bbt_homepage_testimonials_settings_section', array( // Renamed for clarity
        'title'    => __( 'Testimonials Section', 'beautiful-business' ),
        'panel'    => 'bbt_homepage_sections_panel',
        'priority' => 20,
    ) );

    // Testimonials Section Title
    $wp_customize->add_setting( 'bbt_testimonials_section_title', array(
        'default'           => __( 'What Our Clients Say', 'beautiful-business' ),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'bbt_testimonials_section_title_control', array(
        'label'    => __( 'Section Title', 'beautiful-business' ),
        'section'  => 'bbt_homepage_testimonials_settings_section',
        'settings' => 'bbt_testimonials_section_title',
        'type'     => 'text',
    ) );

    // Number of Testimonials
    $wp_customize->add_setting( 'bbt_testimonials_section_count', array(
        'default'           => 2,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'bbt_testimonials_section_count_control', array(
        'label'    => __( 'Number of Testimonials to Display', 'beautiful-business' ),
        'section'  => 'bbt_homepage_testimonials_settings_section',
        'settings' => 'bbt_testimonials_section_count',
        'type'     => 'number',
        'input_attrs' => array(
            'min' => 1,
            'max' => 6,
            'step' => 1,
        ),
    ) );

    // --- Features Section Settings ---
    $wp_customize->add_section( 'bbt_homepage_features_section', array(
        'title'    => __( 'Features Section', 'beautiful-business' ),
        'panel'    => 'bbt_homepage_sections_panel',
        'priority' => 30,
    ) );
    for ($i = 1; $i <= 3; $i++) {
        // Icon (Dashicons slug)
        $wp_customize->add_setting( "bbt_feature_{$i}_icon", array( 'default' => 'dashicons-star-filled', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "bbt_feature_{$i}_icon_control", array( 'label' => sprintf(__( 'Feature %d Icon', 'beautiful-business' ), $i), 'section' => 'bbt_homepage_features_section', 'settings' => "bbt_feature_{$i}_icon", 'type' => 'text', 'description' => __('Enter a Dashicons slug (e.g., dashicons-star-filled).', 'beautiful-business') ) );
        // Title
        $wp_customize->add_setting( "bbt_feature_{$i}_title", array( 'default' => sprintf(__( 'Feature %d', 'beautiful-business' ), $i), 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "bbt_feature_{$i}_title_control", array( 'label' => sprintf(__( 'Feature %d Title', 'beautiful-business' ), $i), 'section' => 'bbt_homepage_features_section', 'settings' => "bbt_feature_{$i}_title", 'type' => 'text' ) );
        // Text
        $wp_customize->add_setting( "bbt_feature_{$i}_text", array( 'default' => __( 'Enter a short description for this feature.', 'beautiful-business' ), 'sanitize_callback' => 'wp_kses_post' ) );
        $wp_customize->add_control( "bbt_feature_{$i}_text_control", array( 'label' => sprintf(__( 'Feature %d Text', 'beautiful-business' ), $i), 'section' => 'bbt_homepage_features_section', 'settings' => "bbt_feature_{$i}_text", 'type' => 'textarea' ) );
    }

    // --- Client Logos Section Settings ---
    $wp_customize->add_section( 'bbt_homepage_logos_section', array(
        'title'    => __( 'Client Logos Section', 'beautiful-business' ),
        'panel'    => 'bbt_homepage_sections_panel',
        'priority' => 40,
    ) );
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting( "bbt_client_logo_{$i}", array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "bbt_client_logo_{$i}_control", array( 'label' => sprintf(__( 'Client Logo %d', 'beautiful-business' ), $i), 'section' => 'bbt_homepage_logos_section', 'settings' => "bbt_client_logo_{$i}" ) ) );
    }

    // --- CTA Block Section Settings ---
    $wp_customize->add_section( 'bbt_homepage_cta_section', array(
        'title'    => __( 'Call-to-Action Block', 'beautiful-business' ),
        'panel'    => 'bbt_homepage_sections_panel',
        'priority' => 50,
    ) );
    $wp_customize->add_setting( 'bbt_cta_headline', array( 'default' => __( 'Ready to Start Your Project?', 'beautiful-business' ), 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'bbt_cta_headline_control', array( 'label' => __( 'CTA Headline', 'beautiful-business' ), 'section' => 'bbt_homepage_cta_section', 'settings' => 'bbt_cta_headline', 'type' => 'text' ) );
    $wp_customize->add_setting( 'bbt_cta_text', array( 'default' => __( 'Let\'s work together to bring your vision to life.', 'beautiful-business' ), 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'bbt_cta_text_control', array( 'label' => __( 'CTA Text', 'beautiful-business' ), 'section' => 'bbt_homepage_cta_section', 'settings' => 'bbt_cta_text', 'type' => 'textarea' ) );
    $wp_customize->add_setting( 'bbt_cta_button_text', array( 'default' => __( 'Contact Us', 'beautiful-business' ), 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'bbt_cta_button_text_control', array( 'label' => __( 'CTA Button Text', 'beautiful-business' ), 'section' => 'bbt_homepage_cta_section', 'settings' => 'bbt_cta_button_text', 'type' => 'text' ) );
    $wp_customize->add_setting( 'bbt_cta_button_url', array( 'default' => '#contact', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'bbt_cta_button_url_control', array( 'label' => __( 'CTA Button URL', 'beautiful-business' ), 'section' => 'bbt_homepage_cta_section', 'settings' => 'bbt_cta_button_url', 'type' => 'url' ) );

    // --- Latest News Section Settings ---
    $wp_customize->add_section( 'bbt_homepage_news_section', array(
        'title'    => __( 'Latest News Section', 'beautiful-business' ),
        'panel'    => 'bbt_homepage_sections_panel',
        'priority' => 60,
    ) );
    $wp_customize->add_setting( 'bbt_news_section_title', array( 'default' => __( 'From Our Blog', 'beautiful-business' ), 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'bbt_news_section_title_control', array( 'label' => __( 'Section Title', 'beautiful-business' ), 'section' => 'bbt_homepage_news_section', 'settings' => 'bbt_news_section_title', 'type' => 'text' ) );
    $wp_customize->add_setting( 'bbt_news_section_count', array( 'default' => 3, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'bbt_news_section_count_control', array( 'label' => __( 'Number of Posts to Display', 'beautiful-business' ), 'section' => 'bbt_homepage_news_section', 'settings' => 'bbt_news_section_count', 'type' => 'number', 'input_attrs' => array('min' => 1, 'max' => 6, 'step' => 1) ) );

}
add_action( 'customize_register', 'beautiful_business_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * Used for 'postMessage' transport settings.
 */
function beautiful_business_customize_preview_js() {
    wp_enqueue_script( 'beautiful-business-customizer-preview', get_template_directory_uri() . '/js/customizer-preview.js', array( 'customize-preview' ), BEAUTIFUL_BUSINESS_VERSION, true );
}
add_action( 'customize_preview_init', 'beautiful_business_customize_preview_js' );

/**
 * JS for Customizer controls.
 *
 * Could be used if we need to add more complex interactions in the Customizer pane itself.
 * For now, it can be empty or not created if not immediately needed.
 */
// function beautiful_business_customize_controls_js() {
//  wp_enqueue_script( 'beautiful-business-customizer-controls', get_template_directory_uri() . '/js/customizer-controls.js', array( 'customize-controls', 'jquery' ), BEAUTIFUL_BUSINESS_VERSION, true );
// }
// add_action( 'customize_controls_enqueue_scripts', 'beautiful_business_customize_controls_js' );

/**
 * Outputs Customizer CSS to <head>
 * Applies theme mods as CSS variables.
 */
function beautiful_business_customizer_css() {
    ?>
    <style type="text/css" id="bbt-customizer-css-vars">
        :root {
            --bbt-primary-color: <?php echo esc_html( get_theme_mod( 'bbt_primary_color', '#007bff' ) ); ?>;
            --bbt-secondary-color: <?php echo esc_html( get_theme_mod( 'bbt_secondary_color', '#6c757d' ) ); ?>;
            /* Add more variables here as needed */
        }
    </style>
    <?php
}
add_action( 'wp_head', 'beautiful_business_customizer_css' );

?>
