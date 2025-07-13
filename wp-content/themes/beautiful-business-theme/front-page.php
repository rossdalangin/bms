<?php
/**
 * The template for displaying the homepage.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Beautiful_Business_Theme
 */

get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <?php
            // Get the section order from the Customizer
            $default_order = 'hero,features,services,projects,cta,clients,testimonials,news';
            $section_order_str = get_theme_mod( 'bbt_homepage_section_order', $default_order );
            $section_order = explode( ',', $section_order_str );

            // Loop through the sections in the defined order
            foreach ( $section_order as $section_id ) {
                $section_id = trim( $section_id );

                // Check if the section is set to be visible
                if ( get_theme_mod( 'bbt_show_section_' . $section_id, true ) ) {
                    get_template_part( 'template-parts/homepage/' . $section_id );
                }
            }
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
