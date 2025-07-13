<?php
/**
 * Template part for displaying the testimonials section on the homepage.
 *
 * @package Beautiful_Business_Theme
 */

$section_title = get_theme_mod( 'bbt_testimonials_section_title', __( 'What Our Clients Say', 'beautiful-business' ) );
$testimonial_count = get_theme_mod( 'bbt_testimonials_section_count', 2 );

$testimonials_query = new WP_Query( array(
    'post_type'      => 'testimonial',
    'posts_per_page' => absint( $testimonial_count ),
    'no_found_rows'  => true,
) );

if ( $testimonials_query->have_posts() ) : ?>
    <section id="homepage-testimonials" class="homepage-content-section homepage-testimonials-section">
        <div class="section-inner container">
            <?php if ( ! empty( $section_title ) ) : ?>
                <h2 class="section-title"><?php echo esc_html( $section_title ); ?></h2>
            <?php endif; ?>

            <div class="testimonials-list">
                <?php while ( $testimonials_query->have_posts() ) : $testimonials_query->the_post();
                    get_template_part( 'template-parts/content', 'testimonial' );
                endwhile; ?>
            </div>
        </div>
    </section>
<?php
endif;
wp_reset_postdata();
?>
