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
 * Sanitize checkbox.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool
 */
function beautiful_business_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

/**
 * Sanitize section order.
 *
 * @param string $order The section order.
 * @return string
 */
function beautiful_business_sanitize_section_order( $order ) {
    $order_array = explode( ',', $order );
    $sanitized_order = array();
    foreach ( $order_array as $section_id ) {
        $sanitized_order[] = sanitize_key( $section_id );
    }
    return implode( ',', $sanitized_order );
}

if ( ! function_exists( 'beautiful_business_posted_on' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function beautiful_business_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_html( get_the_date() ),
            esc_attr( get_the_modified_date( DATE_W3C ) ),
            esc_html( get_the_modified_date() )
        );

        $posted_on = sprintf(
            /* translators: %s: post date. */
            esc_html_x( 'Posted on %s', 'post date', 'beautiful-business' ),
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

    }
endif;

if ( ! function_exists( 'beautiful_business_posted_by' ) ) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function beautiful_business_posted_by() {
        $byline = sprintf(
            /* translators: %s: post author. */
            esc_html_x( 'by %s', 'post author', 'beautiful-business' ),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

    }
endif;

if ( ! function_exists( 'beautiful_business_entry_footer' ) ) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function beautiful_business_entry_footer() {
        // Hide category and tag text for pages.
        if ( 'post' === get_post_type() ) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list( esc_html__( ', ', 'beautiful-business' ) );
            if ( $categories_list ) {
                printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'beautiful-business' ) . '</span>', $categories_list ); // WPCS: XSS OK.
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'beautiful-business' ) );
            if ( $tags_list ) {
                printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'beautiful-business' ) . '</span>', $tags_list ); // WPCS: XSS OK.
            }
        }

        if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<span class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'beautiful-business' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                )
            );
            echo '</span>';
        }

        edit_post_link(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __( 'Edit <span class="screen-reader-text">%s</span>', 'beautiful-business' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }
endif;

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

/**
 * Enqueue Google Fonts for the theme.
 */
// This is now handled dynamically in inc/dynamic-css.php
// function beautiful_business_enqueue_google_fonts() { ... }
// add_action( 'wp_enqueue_scripts', 'beautiful_business_enqueue_google_fonts' );

function beautiful_business_scripts() {
    // The 'beautiful-business-google-fonts' handle is now enqueued from dynamic-css.php,
    // but we still list it as a dependency for the main stylesheet to ensure load order.
    wp_enqueue_style( 'beautiful-business-style', get_stylesheet_uri(), array('beautiful-business-google-fonts'), BEAUTIFUL_BUSINESS_VERSION );
    // wp_style_add_data( 'beautiful-business-style', 'rtl', 'replace' ); // If supporting RTL

    wp_enqueue_script( 'beautiful-business-navigation', get_template_directory_uri() . '/js/navigation.js', array(), BEAUTIFUL_BUSINESS_VERSION, true );

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
 * Dynamic CSS.
 */
require get_template_directory() . '/inc/dynamic-css.php';

/**
 * Load Jetpack compatibility file.
 */
// if ( defined( 'JETPACK__VERSION' ) ) {
// require get_template_directory() . '/inc/jetpack.php';
// }

/**
 * TGM Plugin Activation
 */
require get_template_directory() . '/inc/theme-plugins.php';

/**
 * One Click Demo Import configuration.
 */
function beautiful_business_ocdi_import_files() {
    return array(
        array(
            'import_file_name'           => 'Beautiful Business Demo',
            'local_import_file'            => get_template_directory() . '/demo-import/content.xml',
            'local_import_widget_file'     => get_template_directory() . '/demo-import/widgets.wie',
            'local_import_customizer_file' => get_template_directory() . '/demo-import/customizer.dat',
            'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'beautiful-business' ),
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'beautiful_business_ocdi_import_files' );

function beautiful_business_ocdi_after_import_setup() {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Primary', 'nav_menu' );
    set_theme_mod( 'nav_menu_locations', array(
            'menu-1' => $main_menu->term_id,
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );
}
add_action( 'pt-ocdi/after_import', 'beautiful_business_ocdi_after_import_setup' );

?>
