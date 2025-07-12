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
        // --- Features Section ---
        $bbt_display_features = false;
        for ( $i = 1; $i <= 3; $i++ ) {
            if ( get_theme_mod( "bbt_feature_{$i}_title", '' ) ) {
                $bbt_display_features = true;
                break;
            }
        }
        if ( $bbt_display_features ) : ?>
        <section id="features-section" class="homepage-content-section">
            <div class="container">
                <div class="features-grid">
                    <?php for ( $i = 1; $i <= 3; $i++ ) :
                        $bbt_icon = get_theme_mod( "bbt_feature_{$i}_icon", 'dashicons-star-filled' );
                        $bbt_title = get_theme_mod( "bbt_feature_{$i}_title" );
                        $bbt_text = get_theme_mod( "bbt_feature_{$i}_text" );

                        if ( ! empty( $bbt_title ) ) :
                    ?>
                    <div class="feature-item">
                        <?php if ( ! empty( $bbt_icon ) ) : ?>
                            <span class="dashicons <?php echo esc_attr( $bbt_icon ); ?>"></span>
                        <?php endif; ?>
                        <h3 class="feature-title"><?php echo esc_html( $bbt_title ); ?></h3>
                        <div class="feature-text"><?php echo wp_kses_post( $bbt_text ); ?></div>
                    </div>
                    <?php
                        endif; // End check for empty title
                    endfor;
                    ?>
                </div>
            </div>
        </section>
        <?php endif; ?>


        <?php
        // --- Client Logos Section ---
        $bbt_display_logos = false;
        for ( $i = 1; $i <= 4; $i++ ) {
            if ( get_theme_mod( "bbt_client_logo_{$i}" ) ) {
                $bbt_display_logos = true;
                break;
            }
        }
        if ( $bbt_display_logos ) : ?>
        <section id="client-logos-section" class="homepage-content-section alternate-background">
            <div class="container">
                <div class="client-logos-grid">
                    <?php for ( $i = 1; $i <= 4; $i++ ) :
                        $bbt_logo_url = get_theme_mod( "bbt_client_logo_{$i}" );
                        if ( $bbt_logo_url ) : ?>
                        <div class="client-logo-item">
                            <img src="<?php echo esc_url( $bbt_logo_url ); ?>" alt="<?php printf( esc_attr__( 'Client Logo %d', 'beautiful-business' ), $i ); ?>">
                        </div>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>


        <?php
        // --- CTA Block Section ---
        $bbt_cta_headline = get_theme_mod( 'bbt_cta_headline' );
        if ( $bbt_cta_headline ) : ?>
        <section id="cta-section" class="homepage-content-section homepage-cta-section">
            <div class="container">
                <h2 class="cta-headline"><?php echo esc_html( $bbt_cta_headline ); ?></h2>
                <div class="cta-text"><?php echo wp_kses_post( get_theme_mod( 'bbt_cta_text' ) ); ?></div>
                <?php
                $bbt_cta_btn_text = get_theme_mod( 'bbt_cta_button_text' );
                if ( $bbt_cta_btn_text ) : ?>
                <a href="<?php echo esc_url( get_theme_mod( 'bbt_cta_button_url', '#' ) ); ?>" class="button cta-button">
                    <?php echo esc_html( $bbt_cta_btn_text ); ?>
                </a>
                <?php endif; ?>
            </div>
        </section>
        <?php endif; ?>


        <?php
        // --- Latest News Section ---
        $bbt_news_title = get_theme_mod( 'bbt_news_section_title', __( 'From Our Blog', 'beautiful-business' ) );
        $bbt_news_count = get_theme_mod( 'bbt_news_section_count', 3 );
        $bbt_news_query = new WP_Query( array(
            'post_type'             => 'post',
            'posts_per_page'        => absint( $bbt_news_count ),
            'ignore_sticky_posts'   => 1,
            'no_found_rows'         => true,
        ) );
        if ( $bbt_news_query->have_posts() ) : ?>
        <section id="latest-news-section" class="homepage-content-section">
            <div class="container">
                <h2 class="section-title"><span class="section-title-text"><?php echo esc_html( $bbt_news_title ); ?></span></h2>
                <div class="latest-news-grid">
                    <?php while ( $bbt_news_query->have_posts() ) : $bbt_news_query->the_post();
                        get_template_part('template-parts/content', 'summary');
                    endwhile; wp_reset_postdata(); ?>
                </div>
            </div>
        </section>
        <?php endif; ?>


        <?php
        // --- Services Section (Restored) ---
        $bbt_services_title = get_theme_mod( 'bbt_services_section_title', __( 'Our Services', 'beautiful-business' ) );
        $bbt_services_count = get_theme_mod( 'bbt_services_section_count', 3 );
        $bbt_services_query = new WP_Query( array(
            'post_type'      => 'service',
            'posts_per_page' => absint( $bbt_services_count ),
            'orderby'        => 'date',
            'order'          => 'DESC',
            'no_found_rows'  => true,
        ) );
        if ( $bbt_services_query->have_posts() ) :
        ?>
        <section id="services-section" class="homepage-content-section homepage-services-section section-padding alternate-background">
            <div class="container">
                <?php if ( ! empty( $bbt_services_title ) ) : ?>
                    <h2 class="section-title"><span class="section-title-text"><?php echo esc_html( $bbt_services_title ); ?></span></h2>
                <?php endif; ?>

                <div class="services-grid">
                    <?php while ( $bbt_services_query->have_posts() ) : $bbt_services_query->the_post(); ?>
                        <article id="service-hp-<?php the_ID(); ?>" <?php post_class('service-summary-item grid-item'); ?>>
                            <div class="entry-content-wrap">
                                <header class="entry-header">
                                    <?php the_title( sprintf( '<h3 class="entry-title service-item-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
                                </header>
                                <div class="entry-summary service-item-summary">
                                    <?php the_excerpt(); ?>
                                </div>
                                <footer class="entry-footer">
                                    <a href="<?php the_permalink(); ?>" class="read-more-link service-item-read-more"><?php esc_html_e( 'Details', 'beautiful-business' ); ?> <span class="screen-reader-text"><?php echo wp_kses_post( get_the_title() ); ?></span></a>
                                </footer>
                            </div>
                        </article>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div><!-- .services-grid -->
            </div><!-- .container -->
        </section><!-- #services-section -->
        <?php endif; ?>


        <?php
        // --- Projects Section ---
        $bbt_projects_title = get_theme_mod( 'bbt_projects_section_title', __( 'Our Latest Work', 'beautiful-business' ) );
        $bbt_projects_count = get_theme_mod( 'bbt_projects_section_count', 3 );
        $bbt_projects_query = new WP_Query( array(
            'post_type'      => 'project',
            'posts_per_page' => absint( $bbt_projects_count ),
            'orderby'        => 'date',
            'order'          => 'DESC',
            'no_found_rows'  => true,
        ) );
        if ( $bbt_projects_query->have_posts() ) :
        ?>
        <section id="projects-section" class="homepage-content-section homepage-projects-section section-padding">
            <div class="container">
                <?php if ( ! empty( $bbt_projects_title ) ) : ?>
                    <h2 class="section-title"><span class="section-title-text"><?php echo esc_html( $bbt_projects_title ); ?></span></h2>
                <?php endif; ?>

                <div class="projects-grid">
                    <?php while ( $bbt_projects_query->have_posts() ) : $bbt_projects_query->the_post();
                        get_template_part( 'template-parts/content', 'summary' );
                    endwhile; wp_reset_postdata(); ?>
                </div><!-- .projects-grid -->
            </div><!-- .container -->
        </section><!-- #projects-section -->
        <?php endif; ?>


        <?php
        // --- Testimonials Section (Restored) ---
        $bbt_testimonials_title = get_theme_mod( 'bbt_testimonials_section_title', __( 'What Our Clients Say', 'beautiful-business' ) );
        $bbt_testimonials_count = get_theme_mod( 'bbt_testimonials_section_count', 2 );
        $bbt_testimonials_query = new WP_Query( array(
            'post_type'      => 'testimonial',
            'posts_per_page' => absint( $bbt_testimonials_count ),
            'orderby'        => 'date',
            'order'          => 'DESC',
            'no_found_rows'  => true,
        ) );
        if ( $bbt_testimonials_query->have_posts() ) :
        ?>
        <section id="testimonials-section" class="homepage-content-section homepage-testimonials-section section-padding">
            <div class="container">
                <?php if ( ! empty( $bbt_testimonials_title ) ) : ?>
                    <h2 class="section-title"><span class="section-title-text"><?php echo esc_html( $bbt_testimonials_title ); ?></span></h2>
                <?php endif; ?>

                <div class="testimonials-list">
                    <?php while ( $bbt_testimonials_query->have_posts() ) : $bbt_testimonials_query->the_post();
                        get_template_part( 'template-parts/content', 'testimonial' );
                    endwhile; wp_reset_postdata(); ?>
                </div><!-- .testimonials-list -->
            </div><!-- .container -->
        </section><!-- #testimonials-section -->
        <?php endif; ?>

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
