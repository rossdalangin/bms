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
        'priority' => 25,
        'description' => __( 'Settings for the main hero section on the homepage.', 'beautiful-business'),
    ) );

    // ... (Hero controls) ...

    // Homepage Sections Panel
    $wp_customize->add_panel( 'bbt_homepage_sections_panel', array(
        'title'    => __( 'Homepage Sections', 'beautiful-business' ),
        'priority' => 35,
        'description' => __( 'Manage content sections on the homepage below the main hero area.', 'beautiful-business'),
    ) );

    // --- Services Section Settings ---
    $wp_customize->add_section( 'bbt_homepage_services_settings_section', array(
        'title'    => __( 'Services Section', 'beautiful-business' ),
        'panel'    => 'bbt_homepage_sections_panel',
        'priority' => 10,
    ) );
    $wp_customize->add_setting( 'bbt_services_section_title', array( 'default' => __( 'Our Services', 'beautiful-business' ), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage', ) );
    $wp_customize->add_control( 'bbt_services_section_title_control', array( 'label' => __( 'Section Title', 'beautiful-business' ), 'section' => 'bbt_homepage_services_settings_section', 'settings' => 'bbt_services_section_title', 'type' => 'text', ) );
    $wp_customize->add_setting( 'bbt_services_section_count', array( 'default' => 3, 'sanitize_callback' => 'absint', ) );
    $wp_customize->add_control( 'bbt_services_section_count_control', array( 'label' => __( 'Number of Services to Display', 'beautiful-business' ), 'section' => 'bbt_homepage_services_settings_section', 'settings' => 'bbt_services_section_count', 'type' => 'number', 'input_attrs' => array('min' => 1, 'max' => 9, 'step' => 1), ) );

    // --- Projects Section Settings ---
    $wp_customize->add_section( 'bbt_homepage_projects_section', array(
        'title'    => __( 'Projects Section', 'beautiful-business' ),
        'panel'    => 'bbt_homepage_sections_panel',
        'priority' => 15,
    ) );
    $wp_customize->add_setting( 'bbt_projects_section_title', array( 'default' => __( 'Our Latest Work', 'beautiful-business' ), 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'bbt_projects_section_title_control', array( 'label' => __( 'Section Title', 'beautiful-business' ), 'section' => 'bbt_homepage_projects_section', 'settings' => 'bbt_projects_section_title', 'type' => 'text' ) );
    $wp_customize->add_setting( 'bbt_projects_section_count', array( 'default' => 3, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'bbt_projects_section_count_control', array( 'label' => __( 'Number of Projects to Display', 'beautiful-business' ), 'section' => 'bbt_homepage_projects_section', 'settings' => 'bbt_projects_section_count', 'type' => 'number', 'input_attrs' => array('min' => 1, 'max' => 9, 'step' => 1) ) );

    // --- Testimonials Section Settings ---
    $wp_customize->add_section( 'bbt_homepage_testimonials_settings_section', array(
        'title'    => __( 'Testimonials Section', 'beautiful-business' ),
        'panel'    => 'bbt_homepage_sections_panel',
        'priority' => 20,
    ) );
    $wp_customize->add_setting( 'bbt_testimonials_section_title', array( 'default' => __( 'What Our Clients Say', 'beautiful-business' ), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage', ) );
    $wp_customize->add_control( 'bbt_testimonials_section_title_control', array( 'label' => __( 'Section Title', 'beautiful-business' ), 'section' => 'bbt_homepage_testimonials_settings_section', 'settings' => 'bbt_testimonials_section_title', 'type' => 'text', ) );
    $wp_customize->add_setting( 'bbt_testimonials_section_count', array( 'default' => 2, 'sanitize_callback' => 'absint', ) );
    $wp_customize->add_control( 'bbt_testimonials_section_count_control', array( 'label' => __( 'Number of Testimonials to Display', 'beautiful-business' ), 'section' => 'bbt_homepage_testimonials_settings_section', 'settings' => 'bbt_testimonials_section_count', 'type' => 'number', 'input_attrs' => array('min' => 1, 'max' => 6, 'step' => 1), ) );

    // --- Features Section Settings ---
    // ... (and the rest of the file) ...
}
add_action( 'customize_register', 'beautiful_business_customize_register' );

// ... (rest of the file)
?>
