<?php
/**
 * Generates dynamic CSS from Customizer settings.
 *
 * @package Beautiful_Business_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Get the Google Fonts URL for the selected fonts.
 */
function beautiful_business_get_google_fonts_url() {
    $heading_font = get_theme_mod( 'bbt_heading_font', 'Montserrat' );
    $body_font = get_theme_mod( 'bbt_body_font', 'Open Sans' );

    $fonts = array();
    if ( $heading_font && 'system-ui' !== $heading_font ) {
        $fonts[] = $heading_font . ':400,700';
    }
    if ( $body_font && 'system-ui' !== $body_font ) {
        $fonts[] = $body_font . ':400,700';
    }

    if ( empty( $fonts ) ) {
        return '';
    }

    $fonts_url = add_query_arg( array(
        'family' => implode( '|', array_unique( $fonts ) ),
        'display' => 'swap',
    ), 'https://fonts.googleapis.com/css' ); // Using /css endpoint for broader compatibility

    return esc_url_raw( $fonts_url );
}


/**
 * Enqueue dynamically selected Google Fonts.
 * This replaces the static enqueue in functions.php
 */
function beautiful_business_enqueue_dynamic_google_fonts() {
    $fonts_url = beautiful_business_get_google_fonts_url();
    if ( ! empty( $fonts_url ) ) {
        wp_enqueue_style( 'beautiful-business-google-fonts', $fonts_url, array(), null );
    }
}
add_action( 'wp_enqueue_scripts', 'beautiful_business_enqueue_dynamic_google_fonts' );

/**
 * Helper function to convert hex color to rgb.
 */
function beautiful_business_hex_to_rgb( $hex ) {
    $hex = str_replace( '#', '', $hex );
    if ( strlen( $hex ) == 3 ) {
        $r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
        $g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
        $b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
    } else {
        $r = hexdec( substr( $hex, 0, 2 ) );
        $g = hexdec( substr( $hex, 2, 2 ) );
        $b = hexdec( substr( $hex, 4, 2 ) );
    }
    return "$r, $g, $b";
}


/**
 * Generate and output the dynamic CSS.
 */
function beautiful_business_output_dynamic_css() {
    // Get theme mods for typography
    $heading_font = get_theme_mod( 'bbt_heading_font', 'Montserrat' );
    $body_font = get_theme_mod( 'bbt_body_font', 'Open Sans' );
    $base_size_desktop = get_theme_mod( 'bbt_base_font_size_desktop', 16 );
    $base_size_tablet = get_theme_mod( 'bbt_base_font_size_tablet', 16 );
    $base_size_mobile = get_theme_mod( 'bbt_base_font_size_mobile', 15 );

    // Start CSS output
    $css = '<style type="text/css" id="bbt-dynamic-css">';

    // Font families as CSS variables
    $css .= ':root {';
    $css .= '--bbt-font-heading: ' . ( 'system-ui' === $heading_font ? '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"' : "'" . esc_attr($heading_font) . "', sans-serif" ) . ';';
    $css .= '--bbt-font-body: ' . ( 'system-ui' === $body_font ? '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"' : "'" . esc_attr($body_font) . "', sans-serif" ) . ';';
    $css .= '}';

    // Base font sizes for responsive typography
    $css .= "html { font-size: {$base_size_desktop}px; }";
    $css .= "@media (max-width: 768px) { html { font-size: {$base_size_tablet}px; } }";
    $css .= "@media (max-width: 500px) { html { font-size: {$base_size_mobile}px; } }";

    // Apply fonts to elements (this overrides the static CSS)
    $css .= "body { font-family: var(--bbt-font-body); }";
    $css .= "h1, h2, h3, h4, h5, h6 { font-family: var(--bbt-font-heading); }";


    // Get theme mods for colors
    $primary_color = get_theme_mod( 'bbt_primary_color', '#007bff' );
    $secondary_color = get_theme_mod( 'bbt_secondary_color', '#6c757d' );
    $body_text_color = get_theme_mod( 'bbt_body_text_color', '#333333' );
    $heading_color = get_theme_mod( 'bbt_heading_color', '#111111' );
    $link_hover_color = get_theme_mod( 'bbt_link_hover_color', '#0056b3' );
    $background_color = get_theme_mod( 'bbt_background_color', '#ffffff' );
    $content_max_width = get_theme_mod( 'bbt_content_max_width', '1200px' );

    // Add color variables to :root
    $css .= ":root {";
    $primary_color_rgb = beautiful_business_hex_to_rgb($primary_color);
    $css .= "--bbt-primary-color: " . esc_attr($primary_color) . ";";
    $css .= "--bbt-primary-color-rgb: " . esc_attr($primary_color_rgb) . ";";
    $css .= "--bbt-secondary-color: " . esc_attr($secondary_color) . ";";
    $css .= "--bbt-body-text-color: " . esc_attr($body_text_color) . ";";
    $css .= "--bbt-heading-color: " . esc_attr($heading_color) . ";";
    $css .= "--bbt-link-hover-color: " . esc_attr($link_hover_color) . ";";
    $css .= "--bbt-background-color: " . esc_attr($background_color) . ";";
    $css .= "--bbt-content-max-width: " . esc_attr($content_max_width) . ";";
    $css .= "}";

    // Apply colors to elements
    $css .= "body { background-color: var(--bbt-background-color); color: var(--bbt-body-text-color); }";
    $css .= "h1, h2, h3, h4, h5, h6 { color: var(--bbt-heading-color); }";
    $css .= "a { color: var(--bbt-primary-color); }";
    $css .= "a:hover, a:focus { color: var(--bbt-link-hover-color); }";

    // Get theme mods for colors
    $primary_color = get_theme_mod( 'bbt_primary_color', '#007bff' );
    $secondary_color = get_theme_mod( 'bbt_secondary_color', '#6c757d' );
    $body_text_color = get_theme_mod( 'bbt_body_text_color', '#333333' );
    $heading_color = get_theme_mod( 'bbt_heading_color', '#111111' );
    $link_hover_color = get_theme_mod( 'bbt_link_hover_color', '#0056b3' );
    $background_color = get_theme_mod( 'bbt_background_color', '#ffffff' );

    // Add color variables to :root
    $css .= ":root {";
    $css .= "--bbt-primary-color: " . esc_attr($primary_color) . ";";
    $css .= "--bbt-secondary-color: " . esc_attr($secondary_color) . ";";
    $css .= "--bbt-body-text-color: " . esc_attr($body_text_color) . ";";
    $css .= "--bbt-heading-color: " . esc_attr($heading_color) . ";";
    $css .= "--bbt-link-hover-color: " . esc_attr($link_hover_color) . ";";
    $css .= "--bbt-background-color: " . esc_attr($background_color) . ";";
    $css .= "}";

    // Apply colors to elements
    $css .= "body { background-color: var(--bbt-background-color); color: var(--bbt-body-text-color); }";
    $css .= "h1, h2, h3, h4, h5, h6 { color: var(--bbt-heading-color); }";
    $css .= "a { color: var(--bbt-primary-color); }";
    $css .= "a:hover, a:focus { color: var(--bbt-link-hover-color); }";

    // Get theme mods for colors
    $primary_color = get_theme_mod( 'bbt_primary_color', '#007bff' );
    $secondary_color = get_theme_mod( 'bbt_secondary_color', '#6c757d' );
    $body_text_color = get_theme_mod( 'bbt_body_text_color', '#333333' );
    $heading_color = get_theme_mod( 'bbt_heading_color', '#111111' );
    $link_hover_color = get_theme_mod( 'bbt_link_hover_color', '#0056b3' );
    $background_color = get_theme_mod( 'bbt_background_color', '#ffffff' );

    // Add color variables to :root
    $css .= ":root {";
    $css .= "--bbt-primary-color: " . esc_attr($primary_color) . ";";
    $css .= "--bbt-secondary-color: " . esc_attr($secondary_color) . ";";
    $css .= "--bbt-body-text-color: " . esc_attr($body_text_color) . ";";
    $css .= "--bbt-heading-color: " . esc_attr($heading_color) . ";";
    $css .= "--bbt-link-hover-color: " . esc_attr($link_hover_color) . ";";
    $css .= "--bbt-background-color: " . esc_attr($background_color) . ";";
    $css .= "}";

    // Apply colors to elements
    $css .= "body { background-color: var(--bbt-background-color); color: var(--bbt-body-text-color); }";
    $css .= "h1, h2, h3, h4, h5, h6 { color: var(--bbt-heading-color); }";
    $css .= "a { color: var(--bbt-primary-color); }";
    $css .= "a:hover, a:focus { color: var(--bbt-link-hover-color); }";

    // --- Section Specific Styles ---
    // Hero Section
    $hero_text_align = get_theme_mod('bbt_hero_text_align', 'center');
    $css .= ".homepage-hero-section { text-align: " . esc_attr($hero_text_align) . "; }";


    $css .= '</style>';

    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    echo $css;
}
add_action( 'wp_head', 'beautiful_business_output_dynamic_css' );
