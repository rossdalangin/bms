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

    // --- Create Main Panels ---
    $wp_customize->add_panel( 'bbt_general_settings_panel', array(
        'title'      => __( 'General Settings', 'beautiful-business' ),
        'priority'   => 10,
    ) );
    $wp_customize->add_panel( 'bbt_homepage_sections_panel', array(
        'title'      => __( 'Homepage Sections', 'beautiful-business' ),
        'priority'   => 20,
    ) );

    // --- Move Core Sections & Panels ---
    $wp_customize->get_section( 'title_tagline' )->panel = 'bbt_general_settings_panel';
    $wp_customize->get_section( 'title_tagline' )->priority = 5;

    $wp_customize->get_section( 'colors' )->panel = 'bbt_general_settings_panel';
    $wp_customize->get_section( 'colors' )->title = __( 'Background Color', 'beautiful-business' );
    $wp_customize->get_section( 'colors' )->priority = 15;

    // To move the Menus panel, you must re-register it with the new parent panel.
    $wp_customize->add_panel( 'nav_menus', array(
        'title'    => __( 'Menus' ),
        'panel'    => 'bbt_general_settings_panel',
        'priority' => 20,
    ) );

    $wp_customize->get_section( 'background_image' )->panel = 'bbt_general_settings_panel';
    $wp_customize->get_section( 'background_image' )->priority = 25;

    $wp_customize->get_section( 'static_front_page' )->panel = 'bbt_homepage_sections_panel';
    $wp_customize->get_section( 'static_front_page' )->priority = 5;

    // --- Site Title & Tagline Transport ---
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'blogname', array( 'selector' => '.site-title a', 'render_callback' => function() { bloginfo( 'name' ); } ) );
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array( 'selector' => '.site-description', 'render_callback' => function() { bloginfo( 'description' ); } ) );
    }

    // --- Custom Sections for General Settings ---

    // Theme Colors
    $wp_customize->add_section( 'bbt_theme_colors_section', array( 'title' => __( 'Theme Colors', 'beautiful-business' ), 'priority' => 10, 'panel' => 'bbt_general_settings_panel' ) );
    $wp_customize->add_setting( 'bbt_primary_color', array( 'default' => '#007bff', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bbt_primary_color_control', array( 'label' => __( 'Primary Color', 'beautiful-business' ), 'section' => 'bbt_theme_colors_section', 'settings' => 'bbt_primary_color' ) ) );
    // ... other color controls ...

    // Header Settings
    $wp_customize->add_section( 'bbt_header_settings_section', array( 'title' => __( 'Header Settings', 'beautiful-business' ), 'priority' => 30, 'panel' => 'bbt_general_settings_panel' ) );
    $wp_customize->add_setting( 'bbt_header_cta_text', array( 'default' => __( 'Get a Quote', 'beautiful-business' ), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'bbt_header_cta_text_control', array( 'label' => __( 'Header Button Text', 'beautiful-business' ), 'section' => 'bbt_header_settings_section', 'settings' => 'bbt_header_cta_text', 'type' => 'text' ) );
    $wp_customize->add_setting( 'bbt_header_cta_url', array( 'default' => '#contact', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'bbt_header_cta_url_control', array( 'label' => __( 'Header Button URL', 'beautiful-business' ), 'section' => 'bbt_header_settings_section', 'settings' => 'bbt_header_cta_url', 'type' => 'url' ) );

    // Typography
    $wp_customize->add_panel( 'bbt_typography_panel', array( 'title' => __( 'Typography', 'beautiful-business' ), 'priority' => 35, 'panel' => 'bbt_general_settings_panel' ) );
    $wp_customize->add_section( 'bbt_headings_typo_section', array( 'title' => __( 'Headings (H1-H6)', 'beautiful-business' ), 'panel' => 'bbt_typography_panel' ) );
    $wp_customize->add_setting( 'bbt_heading_font', array( 'default' => 'Montserrat', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'bbt_heading_font_control', array( 'label' => __( 'Heading Font Family', 'beautiful-business' ), 'section' => 'bbt_headings_typo_section', 'type' => 'select', 'choices' => beautiful_business_get_font_choices() ) );
    $wp_customize->add_section( 'bbt_body_typo_section', array( 'title' => __( 'Body Text', 'beautiful-business' ), 'panel' => 'bbt_typography_panel' ) );
    $wp_customize->add_setting( 'bbt_body_font', array( 'default' => 'Open Sans', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'bbt_body_font_control', array( 'label' => __( 'Body Font Family', 'beautiful-business' ), 'section' => 'bbt_body_typo_section', 'type' => 'select', 'choices' => beautiful_business_get_font_choices() ) );

    // Page Layout
    $wp_customize->add_section( 'bbt_page_settings_section', array( 'title' => __( 'Page Layout', 'beautiful-business' ), 'priority' => 40, 'panel' => 'bbt_general_settings_panel' ) );
    $wp_customize->add_setting( 'bbt_content_max_width', array( 'default' => '1200px', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'bbt_content_max_width_control', array( 'label' => __( 'Content Max Width', 'beautiful-business' ), 'section' => 'bbt_page_settings_section', 'type' => 'text' ) );
    $wp_customize->add_setting( 'bbt_screen_width', array( 'default' => 'default', 'sanitize_callback' => 'sanitize_key', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'bbt_screen_width_control', array( 'label' => __( 'Screen Width', 'beautiful-business' ), 'section' => 'bbt_page_settings_section', 'type' => 'select', 'choices' => array( 'default' => __( 'Default', 'beautiful-business' ), 'fullwidth' => __( 'Full Width', 'beautiful-business' ) ) ) );

    // Footer Settings
    $wp_customize->add_section( 'bbt_footer_settings_section', array( 'title' => __( 'Footer Settings', 'beautiful-business' ), 'priority' => 45, 'panel' => 'bbt_general_settings_panel' ) );
    $wp_customize->add_setting( 'bbt_copyright_text', array( 'default' => __( '&copy; [year] [site_name]. All rights reserved.', 'beautiful-business' ), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
    $wp_customize->add_control( 'bbt_copyright_text_control', array( 'label' => __( 'Copyright Text', 'beautiful-business' ), 'section' => 'bbt_footer_settings_section', 'type' => 'textarea' ) );

    // Demo Import
    $wp_customize->add_section( 'bbt_demo_import_section', array( 'title' => __( 'Demo Content Import', 'beautiful-business' ), 'priority' => 50, 'panel' => 'bbt_general_settings_panel' ) );
    require_once get_template_directory() . '/inc/customizer-controls/info-control.php';
    $wp_customize->add_setting( 'bbt_demo_import_info', array( 'default' => '', 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( new Beautiful_Business_Info_Control( $wp_customize, 'bbt_demo_import_info', array( 'label' => __( 'Import Demo Content', 'beautiful-business' ), 'description' => __( 'To get your site looking like the theme demo, please install the recommended "One Click Demo Import" plugin. Once activated, you can import the demo content from the page linked below.', 'beautiful-business' ), 'section' => 'bbt_demo_import_section', 'url' => esc_url( admin_url( 'themes.php?page=pt-one-click-demo-import' ) ), 'url_text' => __( 'Go to Demo Import Page', 'beautiful-business' ) ) ) );

    // --- Custom Sections for Homepage Sections ---

    // Homepage Hero
    $wp_customize->add_section( 'bbt_homepage_hero_section', array( 'title' => __( 'Hero Section', 'beautiful-business' ), 'priority' => 10, 'panel' => 'bbt_homepage_sections_panel' ) );
    // ... hero controls ...

    // Show/Hide & Reorder Sections
    $wp_customize->add_section( 'bbt_homepage_visibility_section', array( 'title' => __( 'Show / Hide Sections', 'beautiful-business' ), 'panel' => 'bbt_homepage_sections_panel', 'priority' => 15 ) );
    // ... visibility controls ...

    $wp_customize->add_section( 'bbt_homepage_order_section', array( 'title' => __( 'Section Order', 'beautiful-business' ), 'panel' => 'bbt_homepage_sections_panel', 'priority' => 20 ) );
    require_once get_template_directory() . '/inc/customizer-controls/reorder-control.php';
    // ... reorder control ...

    // Section Content
    $wp_customize->add_section( 'bbt_homepage_services_section', array( 'title' => __( 'Services Section Content', 'beautiful-business' ), 'panel' => 'bbt_homepage_sections_panel', 'priority' => 25 ) );
    // ... services controls ...

    // ... other homepage content sections ...

}
add_action( 'customize_register', 'beautiful_business_customize_register', 20 ); // Increase priority

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function beautiful_business_customize_preview_js() {
    wp_enqueue_script( 'beautiful-business-customizer-preview', get_template_directory_uri() . '/js/customizer-preview.js', array( 'customize-preview' ), BEAUTIFUL_BUSINESS_VERSION, true );
    wp_enqueue_script( 'beautiful-business-section-reorder', get_template_directory_uri() . '/js/section-reorder.js', array( 'jquery', 'jquery-ui-sortable', 'customize-controls' ), BEAUTIFUL_BUSINESS_VERSION, true );
}
add_action( 'customize_preview_init', 'beautiful_business_customize_preview_js' );

?>
