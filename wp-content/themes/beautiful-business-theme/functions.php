<?php
/**
 * Beautiful Business Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Beautiful_Business_Theme
 */

if ( ! defined( 'BEAUTIFUL_BUSINESS_VERSION' ) ) {
    // Replace with the actual version number.
    define( 'BEAUTIFUL_BUSINESS_VERSION', '1.0.0' );
}

if ( ! function_exists( 'beautiful_business_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function beautiful_business_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Beautiful Business Theme, use a find and replace
         * to change 'beautiful-business' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'beautiful-business', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'menu-1' => esc_html__( 'Primary', 'beautiful-business' ),
            )
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        // Set up the WordPress core custom background feature.
        add_theme_support(
            'custom-background',
            apply_filters(
                'beautiful_business_custom_background_args',
                array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height'      => 250,
                'width'       => 250,
                'flex-width'  => true,
                'flex-height' => true,
            )
        );
    }
endif;
add_action( 'after_setup_theme', 'beautiful_business_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function beautiful_business_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'beautiful_business_content_width', 640 );
}
add_action( 'after_setup_theme', 'beautiful_business_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function beautiful_business_scripts() {
    wp_enqueue_style( 'beautiful-business-style', get_stylesheet_uri(), array(), BEAUTIFUL_BUSINESS_VERSION );
    // wp_style_add_data( 'beautiful-business-style', 'rtl', 'replace' ); // If supporting RTL

    // You can enqueue more styles or scripts here
    // Example: wp_enqueue_script( 'beautiful-business-navigation', get_template_directory_uri() . '/js/navigation.js', array(), BEAUTIFUL_BUSINESS_VERSION, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'beautiful_business_scripts' );

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php'; // We might add this later

/**
 * Custom template tags for this theme.
 */
// require get_template_directory() . '/inc/template-tags.php'; // We might add this later

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
// require get_template_directory() . '/inc/template-functions.php'; // We might add this later

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom Post Types.
 */
require get_template_directory() . '/inc/custom-post-types.php';

/**
 * Load Jetpack compatibility file.
 */
// if ( defined( 'JETPACK__VERSION' ) ) {
// require get_template_directory() . '/inc/jetpack.php';
// }

?>
