<?php
/**
 * Template part for displaying the projects section on the homepage.
 *
 * @package Beautiful_Business_Theme
 */

$section_title = get_theme_mod( 'bbt_projects_section_title', __( 'Our Latest Work', 'beautiful-business' ) );
$project_count = get_theme_mod( 'bbt_projects_section_count', 3 );

$projects_query = new WP_Query( array(
    'post_type'      => 'project',
    'posts_per_page' => absint( $project_count ),
    'no_found_rows'  => true,
) );

if ( $projects_query->have_posts() ) : ?>
    <section class="homepage-content-section homepage-projects-section alternate-background">
        <div class="container">
            <?php if ( ! empty( $section_title ) ) : ?>
                <h2 class="section-title"><?php echo esc_html( $section_title ); ?></h2>
            <?php endif; ?>

            <div class="projects-grid">
                <?php while ( $projects_query->have_posts() ) : $projects_query->the_post(); ?>
                    <div class="project-item grid-item">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'large' ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="entry-content-wrap">
                            <header class="entry-header">
                                <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
                            </header>
                            <div class="entry-summary">
                                <?php the_excerpt(); ?>
                            </div>
                            <footer class="entry-footer">
                                <a href="<?php the_permalink(); ?>" class="read-more-link"><?php esc_html_e( 'View Project', 'beautiful-business' ); ?></a>
                            </footer>
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
