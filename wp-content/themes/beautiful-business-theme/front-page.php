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
            // Display Hero Section
            get_template_part( 'template-parts/homepage/hero' );

            // Display Features Section
            get_template_part( 'template-parts/homepage/features' );

            // Display Services Section
            get_template_part( 'template-parts/homepage/services' );

            // Display Projects Section
            get_template_part( 'template-parts/homepage/projects' );

            // Display CTA Section
            get_template_part( 'template-parts/homepage/cta' );

            // Display Client Logos Section
            get_template_part( 'template-parts/homepage/client-logos' );

            // Display Testimonials Section
            get_template_part( 'template-parts/homepage/testimonials' );

            // Display Latest News Section
            get_template_part( 'template-parts/homepage/latest-news' );
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
