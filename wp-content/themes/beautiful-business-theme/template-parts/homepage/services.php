<?php
/**
 * Template part for displaying the services section on the homepage.
 *
 * @package Beautiful_Business_Theme
 */

$section_title = get_theme_mod( 'bbt_services_section_title', __( 'Our Services', 'beautiful-business' ) );
$service_count = get_theme_mod( 'bbt_services_section_count', 3 );

$services_query = new WP_Query( array(
    'post_type'      => 'service',
    'posts_per_page' => absint( $service_count ),
    'no_found_rows'  => true,
) );

if ( $services_query->have_posts() ) : ?>
    <section class="homepage-content-section homepage-services-section">
        <div class="container">
            <?php if ( ! empty( $section_title ) ) : ?>
                <h2 class="section-title"><?php echo esc_html( $section_title ); ?></h2>
            <?php endif; ?>

            <div class="services-grid">
                <?php while ( $services_query->have_posts() ) : $services_query->the_post(); ?>
                    <div class="service-summary-item">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="service-item-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'medium_large' ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <header class="entry-header">
                            <?php the_title( sprintf( '<h3 class="service-item-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
                        </header>
                        <div class="service-item-summary">
                            <?php the_excerpt(); ?>
                        </div>
                        <div class="service-item-read-more">
                             <a href="<?php the_permalink(); ?>" class="button button-secondary"><?php esc_html_e( 'Learn More', 'beautiful-business' ); ?></a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php
endif;
wp_reset_postdata();
?>
