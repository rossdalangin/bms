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
            // Hero Section
            if ( get_theme_mod( 'bbt_show_section_hero', true ) ) {
                get_template_part( 'template-parts/homepage/hero' );
            }

            // Features Section
            if ( get_theme_mod( 'bbt_show_section_features', true ) ) {
                get_template_part( 'template-parts/homepage/features' );
            }

            // Services Section
            if ( get_theme_mod( 'bbt_show_section_services', true ) ) {
                get_template_part( 'template-parts/homepage/services' );
            }

            // Projects Section
            if ( get_theme_mod( 'bbt_show_section_projects', true ) ) {
                get_template_part( 'template-parts/homepage/projects' );
            }

            // CTA Section
            if ( get_theme_mod( 'bbt_show_section_cta', true ) ) {
                get_template_part( 'template-parts/homepage/cta' );
            }

            // Client Logos Section
            if ( get_theme_mod( 'bbt_show_section_clients', true ) ) {
                get_template_part( 'template-parts/homepage/client-logos' );
            }

            // Testimonials Section
            if ( get_theme_mod( 'bbt_show_section_testimonials', true ) ) {
                get_template_part( 'template-parts/homepage/testimonials' );
            }

            // Latest News Section
            if ( get_theme_mod( 'bbt_show_section_news', true ) ) {
                get_template_part( 'template-parts/homepage/latest-news' );
            }
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
