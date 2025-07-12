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

    // --- Helper function for font choices ---
    function beautiful_business_get_font_choices() {
        return array(
            'Montserrat'        => 'Montserrat',
            'Open Sans'         => 'Open Sans',
            'Lato'              => 'Lato',
            'Roboto'            => 'Roboto',
            'Source Sans Pro'   => 'Source Sans Pro',
            'Merriweather'      => 'Merriweather',
            'Playfair Display'  => 'Playfair Display',
            'system-ui'         => 'System Default',
        );
    }

    // Site Title & Tagline
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'blogname', array( 'selector' => '.site-title a', 'render_callback' => function() { bloginfo( 'name' ); } ) );
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array( 'selector' => '.site-description', 'render_callback' => function() { bloginfo( 'description' ); } ) );
    }

    // Header Settings Section
    $wp_customize->add_section( 'bbt_header_settings_section', array( 'title' => __( 'Header Settings', 'beautiful-business' ), 'priority' => 20 ) );
    $wp_customize->add_setting( 'bbt_header_cta_text', array( 'default' => __( 'Get a Quote', 'beautiful-business' ), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'bbt_header_cta_text_control', array( 'label' => __( 'Header Button Text', 'beautiful-business' ), 'section' => 'bbt_header_settings_section', 'settings' => 'bbt_header_cta_text', 'type' => 'text' ) );
    $wp_customize->add_setting( 'bbt_header_cta_url', array( 'default' => '#contact', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'bbt_header_cta_url_control', array( 'label' => __( 'Header Button URL', 'beautiful-business' ), 'section' => 'bbt_header_settings_section', 'settings' => 'bbt_header_cta_url', 'type' => 'url' ) );

    // Theme Colors Section
    $wp_customize->add_section( 'bbt_theme_colors_section', array( 'title' => __( 'Theme Colors', 'beautiful-business' ), 'priority' => 30 ) );
    $wp_customize->add_setting( 'bbt_primary_color', array( 'default' => '#007bff', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bbt_primary_color_control', array( 'label' => __( 'Primary Color', 'beautiful-business' ), 'section' => 'bbt_theme_colors_section', 'settings' => 'bbt_primary_color' ) ) );
    $wp_customize->add_setting( 'bbt_secondary_color', array( 'default' => '#6c757d', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bbt_secondary_color_control', array( 'label' => __( 'Secondary Color', 'beautiful-business' ), 'section' => 'bbt_theme_colors_section', 'settings' => 'bbt_secondary_color' ) ) );
    $wp_customize->add_setting( 'bbt_body_text_color', array( 'default' => '#333333', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bbt_body_text_color_control', array( 'label' => __( 'Body Text Color', 'beautiful-business' ), 'section' => 'bbt_theme_colors_section', 'settings' => 'bbt_body_text_color' ) ) );
    $wp_customize->add_setting( 'bbt_heading_color', array( 'default' => '#111111', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bbt_heading_color_control', array( 'label' => __( 'Heading Color', 'beautiful-business' ), 'section' => 'bbt_theme_colors_section', 'settings' => 'bbt_heading_color' ) ) );
    $wp_customize->add_setting( 'bbt_link_hover_color', array( 'default' => '#0056b3', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bbt_link_hover_color_control', array( 'label' => __( 'Link Hover Color', 'beautiful-business' ), 'section' => 'bbt_theme_colors_section', 'settings' => 'bbt_link_hover_color' ) ) );
    $wp_customize->add_setting( 'bbt_background_color', array( 'default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bbt_background_color_control', array( 'label' => __( 'Main Background Color', 'beautiful-business' ), 'section' => 'bbt_theme_colors_section', 'settings' => 'bbt_background_color' ) ) );

    // --- Typography Panel ---
    $wp_customize->add_panel( 'bbt_typography_panel', array( 'title' => __( 'Typography', 'beautiful-business' ), 'priority' => 40 ) );
    $wp_customize->add_section( 'bbt_headings_typo_section', array( 'title' => __( 'Headings (H1-H6)', 'beautiful-business' ), 'panel' => 'bbt_typography_panel', 'priority' => 10 ) );
    $wp_customize->add_setting( 'bbt_heading_font', array( 'default' => 'Montserrat', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'bbt_heading_font_control', array( 'label' => __( 'Heading Font Family', 'beautiful-business' ), 'section' => 'bbt_headings_typo_section', 'settings' => 'bbt_heading_font', 'type' => 'select', 'choices' => beautiful_business_get_font_choices() ) );
    $wp_customize->add_section( 'bbt_body_typo_section', array( 'title' => __( 'Body Text', 'beautiful-business' ), 'panel' => 'bbt_typography_panel', 'priority' => 20 ) );
    $wp_customize->add_setting( 'bbt_body_font', array( 'default' => 'Open Sans', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'bbt_body_font_control', array( 'label' => __( 'Body Font Family', 'beautiful-business' ), 'section' => 'bbt_body_typo_section', 'settings' => 'bbt_body_font', 'type' => 'select', 'choices' => beautiful_business_get_font_choices() ) );
    $wp_customize->add_setting( 'bbt_base_font_size_desktop', array( 'default' => 16, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'bbt_base_font_size_desktop_control', array( 'label' => __( 'Base Font Size - Desktop (px)', 'beautiful-business' ), 'section' => 'bbt_body_typo_section', 'settings' => 'bbt_base_font_size_desktop', 'type' => 'number', 'input_attrs' => array('min'=>12, 'max'=>24) ) );
    $wp_customize->add_setting( 'bbt_base_font_size_tablet', array( 'default' => 16, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'bbt_base_font_size_tablet_control', array( 'label' => __( 'Base Font Size - Tablet (px)', 'beautiful-business' ), 'section' => 'bbt_body_typo_section', 'settings' => 'bbt_base_font_size_tablet', 'type' => 'number', 'input_attrs' => array('min'=>12, 'max'=>22) ) );
    $wp_customize->add_setting( 'bbt_base_font_size_mobile', array( 'default' => 15, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'bbt_base_font_size_mobile_control', array( 'label' => __( 'Base Font Size - Mobile (px)', 'beautiful-business' ), 'section' => 'bbt_body_typo_section', 'settings' => 'bbt_base_font_size_mobile', 'type' => 'number', 'input_attrs' => array('min'=>12, 'max'=>20) ) );

    // Footer Settings Section
    $wp_customize->add_section( 'bbt_footer_settings_section', array( 'title' => __( 'Footer Settings', 'beautiful-business' ), 'priority' => 120 ) );
    $wp_customize->add_setting( 'bbt_copyright_text', array( 'default' => __( '&copy; [year] [site_name]. All rights reserved.', 'beautiful-business' ), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'bbt_copyright_text_control', array( 'label' => __( 'Copyright Text', 'beautiful-business' ), 'description' => __( 'Placeholders: [year], [site_name]', 'beautiful-business'), 'section' => 'bbt_footer_settings_section', 'settings' => 'bbt_copyright_text', 'type' => 'textarea' ) );

    // Homepage Hero Section
    $wp_customize->add_section( 'bbt_homepage_hero_section', array( 'title' => __( 'Homepage Hero', 'beautiful-business' ), 'priority' => 25, 'description' => __( 'Settings for the main hero section on the homepage.', 'beautiful-business') ) );
    $wp_customize->add_setting( 'bbt_hero_title', array( 'default' => __( 'Welcome to Beautiful Business', 'beautiful-business' ), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'bbt_hero_title_control', array( 'label' => __( 'Hero Title', 'beautiful-business' ), 'section' => 'bbt_homepage_hero_section', 'settings' => 'bbt_hero_title', 'type' => 'text' ) );
    $wp_customize->add_setting( 'bbt_hero_subtitle', array( 'default' => __( 'Your success is our priority. Discover our services.', 'beautiful-business' ), 'sanitize_callback' => 'wp_kses_post', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'bbt_hero_subtitle_control', array( 'label' => __( 'Hero Subtitle', 'beautiful-business' ), 'section' => 'bbt_homepage_hero_section', 'settings' => 'bbt_hero_subtitle', 'type' => 'textarea' ) );
    $wp_customize->add_setting( 'bbt_hero_button_text', array( 'default' => __( 'Learn More', 'beautiful-business' ), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'bbt_hero_button_text_control', array( 'label' => __( 'Hero Button Text', 'beautiful-business' ), 'section' => 'bbt_homepage_hero_section', 'settings' => 'bbt_hero_button_text', 'type' => 'text' ) );
    $wp_customize->add_setting( 'bbt_hero_button_url', array( 'default' => '#services', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'bbt_hero_button_url_control', array( 'label' => __( 'Hero Button URL', 'beautiful-business' ), 'section' => 'bbt_homepage_hero_section', 'settings' => 'bbt_hero_button_url', 'type' => 'url' ) );
    $wp_customize->add_setting( 'bbt_hero_background_image', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bbt_hero_background_image_control', array( 'label' => __( 'Hero Background Image', 'beautiful-business' ), 'section' => 'bbt_homepage_hero_section', 'settings' => 'bbt_hero_background_image' ) ) );

    // Hero Text Alignment
    $wp_customize->add_setting( 'bbt_hero_text_align', array(
        'default'           => 'center',
        'sanitize_callback' => 'sanitize_text_field', // Simple validation
    ) );
    $wp_customize->add_control( 'bbt_hero_text_align_control', array(
        'label'    => __( 'Text Alignment', 'beautiful-business' ),
        'section'  => 'bbt_homepage_hero_section',
        'settings' => 'bbt_hero_text_align',
        'type'     => 'select',
        'choices'  => array(
            'left'   => __( 'Left', 'beautiful-business' ),
            'center' => __( 'Center', 'beautiful-business' ),
            'right'  => __( 'Right', 'beautiful-business' ),
        ),
    ) );

    // Homepage Sections Panel
    $wp_customize->add_panel( 'bbt_homepage_sections_panel', array( 'title' => __( 'Homepage Sections', 'beautiful-business' ), 'priority' => 35, 'description' => __( 'Manage content sections on the homepage.', 'beautiful-business') ) );

    // --- Services Section ---
    $wp_customize->add_section( 'bbt_homepage_services_section', array( 'title' => __( 'Services Section', 'beautiful-business' ), 'panel' => 'bbt_homepage_sections_panel', 'priority' => 10 ) );
    $wp_customize->add_setting( 'bbt_services_section_title', array( 'default' => __( 'Our Services', 'beautiful-business' ), 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'bbt_services_section_title_control', array( 'label' => __( 'Section Title', 'beautiful-business' ), 'section' => 'bbt_homepage_services_section', 'settings' => 'bbt_services_section_title' ) );
    $wp_customize->add_setting( 'bbt_services_section_count', array( 'default' => 3, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'bbt_services_section_count_control', array( 'label' => __( 'Number of Services', 'beautiful-business' ), 'section' => 'bbt_homepage_services_section', 'settings' => 'bbt_services_section_count', 'type' => 'number', 'input_attrs' => array('min'=>1, 'max'=>9) ) );

    // --- Projects Section ---
    $wp_customize->add_section( 'bbt_homepage_projects_section', array( 'title' => __( 'Projects Section', 'beautiful-business' ), 'panel' => 'bbt_homepage_sections_panel', 'priority' => 15 ) );
    $wp_customize->add_setting( 'bbt_projects_section_title', array( 'default' => __( 'Our Latest Work', 'beautiful-business' ), 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'bbt_projects_section_title_control', array( 'label' => __( 'Section Title', 'beautiful-business' ), 'section' => 'bbt_homepage_projects_section', 'settings' => 'bbt_projects_section_title' ) );
    $wp_customize->add_setting( 'bbt_projects_section_count', array( 'default' => 3, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'bbt_projects_section_count_control', array( 'label' => __( 'Number of Projects', 'beautiful-business' ), 'section' => 'bbt_homepage_projects_section', 'settings' => 'bbt_projects_section_count', 'type' => 'number', 'input_attrs' => array('min'=>1, 'max'=>9) ) );

    // --- Testimonials Section ---
    $wp_customize->add_section( 'bbt_homepage_testimonials_section', array( 'title' => __( 'Testimonials Section', 'beautiful-business' ), 'panel' => 'bbt_homepage_sections_panel', 'priority' => 20 ) );
    $wp_customize->add_setting( 'bbt_testimonials_section_title', array( 'default' => __( 'What Our Clients Say', 'beautiful-business' ), 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'bbt_testimonials_section_title_control', array( 'label' => __( 'Section Title', 'beautiful-business' ), 'section' => 'bbt_homepage_testimonials_section', 'settings' => 'bbt_testimonials_section_title' ) );
    $wp_customize->add_setting( 'bbt_testimonials_section_count', array( 'default' => 2, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'bbt_testimonials_section_count_control', array( 'label' => __( 'Number of Testimonials', 'beautiful-business' ), 'section' => 'bbt_homepage_testimonials_section', 'settings' => 'bbt_testimonials_section_count', 'type' => 'number', 'input_attrs' => array('min'=>1, 'max'=>6) ) );

    // --- Features Section ---
    $wp_customize->add_section( 'bbt_homepage_features_section', array( 'title' => __( 'Features Section', 'beautiful-business' ), 'panel' => 'bbt_homepage_sections_panel', 'priority' => 30 ) );
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting( "bbt_feature_{$i}_icon", array( 'default' => 'dashicons-star-filled', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "bbt_feature_{$i}_icon_control", array( 'label' => sprintf(__( 'Feature %d Icon', 'beautiful-business' ), $i), 'section' => 'bbt_homepage_features_section', 'settings' => "bbt_feature_{$i}_icon", 'type' => 'text' ) );
        $wp_customize->add_setting( "bbt_feature_{$i}_title", array( 'default' => sprintf(__( 'Feature %d', 'beautiful-business' ), $i), 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "bbt_feature_{$i}_title_control", array( 'label' => sprintf(__( 'Feature %d Title', 'beautiful-business' ), $i), 'section' => 'bbt_homepage_features_section', 'settings' => "bbt_feature_{$i}_title" ) );
        $wp_customize->add_setting( "bbt_feature_{$i}_text", array( 'default' => __( 'Enter a short description for this feature.', 'beautiful-business' ), 'sanitize_callback' => 'wp_kses_post' ) );
        $wp_customize->add_control( "bbt_feature_{$i}_text_control", array( 'label' => sprintf(__( 'Feature %d Text', 'beautiful-business' ), $i), 'section' => 'bbt_homepage_features_section', 'settings' => "bbt_feature_{$i}_text", 'type' => 'textarea' ) );
    }

    // --- Client Logos Section ---
    $wp_customize->add_section( 'bbt_homepage_logos_section', array( 'title' => __( 'Client Logos Section', 'beautiful-business' ), 'panel' => 'bbt_homepage_sections_panel', 'priority' => 40 ) );
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting( "bbt_client_logo_{$i}", array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "bbt_client_logo_{$i}_control", array( 'label' => sprintf(__( 'Client Logo %d', 'beautiful-business' ), $i), 'section' => 'bbt_homepage_logos_section', 'settings' => "bbt_client_logo_{$i}" ) ) );
    }

    // --- CTA Block Section ---
    $wp_customize->add_section( 'bbt_homepage_cta_section', array( 'title' => __( 'Call-to-Action Block', 'beautiful-business' ), 'panel' => 'bbt_homepage_sections_panel', 'priority' => 50 ) );
    $wp_customize->add_setting( 'bbt_cta_headline', array( 'default' => __( 'Ready to Start Your Project?', 'beautiful-business' ), 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'bbt_cta_headline_control', array( 'label' => __( 'CTA Headline', 'beautiful-business' ), 'section' => 'bbt_homepage_cta_section', 'settings' => 'bbt_cta_headline' ) );
    $wp_customize->add_setting( 'bbt_cta_text', array( 'default' => __( 'Let\'s work together.', 'beautiful-business' ), 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'bbt_cta_text_control', array( 'label' => __( 'CTA Text', 'beautiful-business' ), 'section' => 'bbt_homepage_cta_section', 'settings' => 'bbt_cta_text', 'type' => 'textarea' ) );
    $wp_customize->add_setting( 'bbt_cta_button_text', array( 'default' => __( 'Contact Us', 'beautiful-business' ), 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'bbt_cta_button_text_control', array( 'label' => __( 'CTA Button Text', 'beautiful-business' ), 'section' => 'bbt_homepage_cta_section', 'settings' => 'bbt_cta_button_text' ) );
    $wp_customize->add_setting( 'bbt_cta_button_url', array( 'default' => '#contact', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'bbt_cta_button_url_control', array( 'label' => __( 'CTA Button URL', 'beautiful-business' ), 'section' => 'bbt_homepage_cta_section', 'settings' => 'bbt_cta_button_url' ) );

    // --- Latest News Section ---
    $wp_customize->add_section( 'bbt_homepage_news_section', array( 'title' => __( 'Latest News Section', 'beautiful-business' ), 'panel' => 'bbt_homepage_sections_panel', 'priority' => 60 ) );
    $wp_customize->add_setting( 'bbt_news_section_title', array( 'default' => __( 'From Our Blog', 'beautiful-business' ), 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'bbt_news_section_title_control', array( 'label' => __( 'Section Title', 'beautiful-business' ), 'section' => 'bbt_homepage_news_section', 'settings' => 'bbt_news_section_title' ) );
    $wp_customize->add_setting( 'bbt_news_section_count', array( 'default' => 3, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'bbt_news_section_count_control', array( 'label' => __( 'Number of Posts', 'beautiful-business' ), 'section' => 'bbt_homepage_news_section', 'settings' => 'bbt_news_section_count', 'type' => 'number', 'input_attrs' => array('min' => 1, 'max' => 6) ) );

}
add_action( 'customize_register', 'beautiful_business_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function beautiful_business_customize_preview_js() {
    wp_enqueue_script( 'beautiful-business-customizer-preview', get_template_directory_uri() . '/js/customizer-preview.js', array( 'customize-preview' ), BEAUTIFUL_BUSINESS_VERSION, true );
}
add_action( 'customize_preview_init', 'beautiful_business_customize_preview_js' );

/**
 * Outputs Customizer CSS to <head>
 * This is now handled by inc/dynamic-css.php
 */
// function beautiful_business_customizer_css() { ... }
// add_action( 'wp_head', 'beautiful_business_customizer_css' );

?>
