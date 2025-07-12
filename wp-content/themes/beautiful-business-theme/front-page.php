<?php
/**
 * The template for displaying the homepage.
 *
 * @package Beautiful_Business_Theme
 */

get_header(); ?>

<div id="primary" class="content-area homepage-content-area">
    <main id="main" class="site-main homepage-main">

        <?php
        // We will add the Hero section and other homepage content here in the next steps.
        // We will add the Hero section and other homepage content here in the next steps.
        ?>

        <?php
        // Get Hero Section Data from Customizer
        $bbt_hero_title = get_theme_mod( 'bbt_hero_title', __( 'Welcome to Beautiful Business', 'beautiful-business' ) );
        $bbt_hero_subtitle = get_theme_mod( 'bbt_hero_subtitle', __( 'Your success is our priority. Discover our services.', 'beautiful-business' ) );
        $bbt_hero_button_text = get_theme_mod( 'bbt_hero_button_text', __( 'Learn More', 'beautiful-business' ) );
        $bbt_hero_button_url = get_theme_mod( 'bbt_hero_button_url', '#services' );
        $bbt_hero_background_image = get_theme_mod( 'bbt_hero_background_image', '' );

        $bbt_hero_style_attr = '';
        if ( ! empty( $bbt_hero_background_image ) ) {
            $bbt_hero_style_attr = 'style="background-image: url(' . esc_url( $bbt_hero_background_image ) . ');"';
        }
        $bbt_hero_section_classes = 'homepage-hero-section';
        if ( ! empty( $bbt_hero_background_image ) ) {
            $bbt_hero_section_classes .= ' has-background-image';
        } else {
            $bbt_hero_section_classes .= ' no-background-image'; // Class for when no image is set
        }
        ?>

        <section id="homepage-hero" class="<?php echo esc_attr( $bbt_hero_section_classes ); ?>" <?php echo $bbt_hero_style_attr; ?>>
            <div class="container hero-content-container">
                <?php if ( ! empty( $bbt_hero_title ) ) : ?>
                    <h1 id="hero-title" class="hero-main-title"><?php echo esc_html( $bbt_hero_title ); ?></h1>
                <?php endif; ?>

                <?php if ( ! empty( $bbt_hero_subtitle ) ) : ?>
                    <p id="hero-subtitle" class="hero-main-subtitle"><?php echo wp_kses_post( $bbt_hero_subtitle ); ?></p>
                <?php endif; ?>

                <?php if ( ! empty( $bbt_hero_button_text ) && ! empty( $bbt_hero_button_url ) ) : ?>
                    <a href="<?php echo esc_url( $bbt_hero_button_url ); ?>" id="hero-button" class="button hero-main-button">
                        <?php echo esc_html( $bbt_hero_button_text ); ?>
                    </a>
                <?php endif; ?>
            </div>
        </section>

        <?php
        // Services Section
        $bbt_services_title = get_theme_mod( 'bbt_services_section_title', __( 'Our Services', 'beautiful-business' ) );
        $bbt_services_count = get_theme_mod( 'bbt_services_section_count', 3 );

        // Only display section if there's a title or if services are to be shown (count > 0 implied by default)
        // Or, more strictly, if $bbt_services_count > 0 and we have posts.
        $bbt_display_services_section = ! empty( $bbt_services_title ) || ( isset($bbt_services_count) && $bbt_services_count > 0 );


        if ( $bbt_display_services_section ) :
            $bbt_services_args = array(
                'post_type'      => 'service',
                'posts_per_page' => absint( $bbt_services_count ),
                'orderby'        => 'date',
                'order'          => 'DESC',
                'no_found_rows'  => true,
            );
            $bbt_services_query = new WP_Query( $bbt_services_args );

            if ( $bbt_services_query->have_posts() ) :
        ?>
        <section id="services-section" class="homepage-content-section homepage-services-section section-padding">
            <div class="container">
                <?php if ( ! empty( $bbt_services_title ) ) : ?>
                    <h2 class="section-title"><span class="section-title-text"><?php echo esc_html( $bbt_services_title ); ?></span></h2>
                <?php endif; ?>

                <div class="services-grid">
                    <?php
                    while ( $bbt_services_query->have_posts() ) : $bbt_services_query->the_post();
                    ?>
                        <article id="service-hp-<?php the_ID(); ?>" <?php post_class('service-summary-item grid-item'); ?>>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="service-item-thumbnail post-thumbnail">
                                    <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <header class="entry-header">
                                <?php the_title( sprintf( '<h3 class="entry-title service-item-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
                            </header>
                            <div class="entry-summary service-item-summary">
                                <?php the_excerpt(); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="read-more-link service-item-read-more"><?php esc_html_e( 'Details', 'beautiful-business' ); ?> <span class="screen-reader-text"><?php echo wp_kses_post( get_the_title() ); ?></span></a>
                        </article>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div><!-- .services-grid -->
            </div><!-- .container -->
        </section><!-- #services-section -->
            <?php
            endif; // End if $bbt_services_query->have_posts()
        endif; // End if $bbt_display_services_section
        ?>

        <?php
        // Testimonials Section
        $bbt_testimonials_title = get_theme_mod( 'bbt_testimonials_section_title', __( 'What Our Clients Say', 'beautiful-business' ) );
        $bbt_testimonials_count = get_theme_mod( 'bbt_testimonials_section_count', 2 );

        $bbt_display_testimonials_section = ! empty( $bbt_testimonials_title ) || ( isset($bbt_testimonials_count) && $bbt_testimonials_count > 0 );

        if ( $bbt_display_testimonials_section ) :
            $bbt_testimonials_args = array(
                'post_type'      => 'testimonial',
                'posts_per_page' => absint( $bbt_testimonials_count ),
                'orderby'        => 'date',
                'order'          => 'DESC',
                'no_found_rows'  => true,
            );
            $bbt_testimonials_query = new WP_Query( $bbt_testimonials_args );

            if ( $bbt_testimonials_query->have_posts() ) :
        ?>
        <section id="testimonials-section" class="homepage-content-section homepage-testimonials-section section-padding">
            <div class="container">
                <?php if ( ! empty( $bbt_testimonials_title ) ) : ?>
                    <h2 class="section-title"><span class="section-title-text"><?php echo esc_html( $bbt_testimonials_title ); ?></span></h2>
                <?php endif; ?>

                <div class="testimonials-list">
                    <?php
                    while ( $bbt_testimonials_query->have_posts() ) : $bbt_testimonials_query->the_post();
                        get_template_part( 'template-parts/content', 'testimonial' );
                    endwhile;
                    wp_reset_postdata(); // Restore original Post Data
                    ?>
                </div><!-- .testimonials-list -->
            </div><!-- .container -->
        </section><!-- #testimonials-section -->
            <?php
            endif; // End if $bbt_testimonials_query->have_posts()
        endif; // End if $bbt_display_testimonials_section
        ?>

        <div class="homepage-content-main container">
            <?php
            // Standard loop to display content IF a static page is set as the front page AND it has content.
            // This typically runs if Settings > Reading > "Your homepage displays" is set to "A static page".
            if ( 'page' == get_option( 'show_on_front' ) && get_option( 'page_on_front' ) && have_posts() ) :
                while ( have_posts() ) :
                    the_post();
                    // Display the content of the page assigned as Front Page.
                    // Useful if user wants a mix of Customizer sections and page content.
                    // Or, you might remove this loop if the homepage is purely Customizer-driven.
                    get_template_part( 'template-parts/content', 'page' ); // Assumes you have content-page.php
                endwhile;
            else :
                // This part can be used for default content or further Customizer-driven sections
                // if no static page is assigned or if the assigned page has no content.
                // For now, we can leave it, or add a placeholder message if needed.
                // Example: echo '<p class="text-center">' . esc_html__('More homepage sections can be added here.', 'beautiful-business') . '</p>';
            endif;
            ?>
            <!-- More homepage sections will be added here based on plan -->
        </div>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
