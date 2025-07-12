<?php
/**
 * The template for displaying the homepage.
 *
 * @package Beautiful_Business_Theme
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        // Get the section order from the Customizer
        $default_order = 'hero,features,services,projects,cta,clients,testimonials,news';
        $section_order_str = get_theme_mod( 'bbt_homepage_section_order', $default_order );
        $section_order = explode( ',', $section_order_str );

        // Loop through the sections in the defined order
        foreach ( $section_order as $section ) {
            $section = trim( $section );

            // Check if the section is set to be visible
            $is_visible = get_theme_mod( 'bbt_show_section_' . $section, true );

            if ( $is_visible ) {
                // Based on the section ID, get the corresponding template part
                switch ( $section ) {
                    case 'hero':
                        get_template_part( 'template-parts/homepage/hero' );
                        break;
                    case 'features':
                        get_template_part( 'template-parts/homepage/features' );
                        break;
                    case 'services':
                        get_template_part( 'template-parts/homepage/services' );
                        break;
                    case 'projects':
                        get_template_part( 'template-parts/homepage/projects' );
                        break;
                    case 'cta':
                        get_template_part( 'template-parts/homepage/cta' );
                        break;
                    case 'clients':
                        get_template_part( 'template-parts/homepage/client-logos' );
                        break;
                    case 'testimonials':
                        get_template_part( 'template-parts/homepage/testimonials' );
                        break;
                    case 'news':
                        get_template_part( 'template-parts/homepage/latest-news' );
                        break;
                }
            }
        }
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
