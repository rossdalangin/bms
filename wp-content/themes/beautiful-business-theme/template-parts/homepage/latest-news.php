<?php
/**
 * Template part for displaying the latest news section on the homepage.
 *
 * @package Beautiful_Business_Theme
 */

$section_title = get_theme_mod( 'bbt_news_section_title', __( 'From Our Blog', 'beautiful-business' ) );
$news_count = get_theme_mod( 'bbt_news_section_count', 3 );

$news_query = new WP_Query( array(
    'post_type'      => 'post',
    'posts_per_page' => absint( $news_count ),
    'no_found_rows'  => true,
    'ignore_sticky_posts' => true,
) );

if ( $news_query->have_posts() ) : ?>
    <section id="homepage-news" class="homepage-content-section homepage-latest-news-section alternate-background">
        <div class="section-inner container">
            <?php if ( ! empty( $section_title ) ) : ?>
                <h2 class="section-title"><?php echo esc_html( $section_title ); ?></h2>
            <?php endif; ?>

            <div class="latest-news-grid">
                <?php while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
                    <article class="news-summary-item">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'medium_large' ); ?>
                                a>
                            </div>
                        <?php endif; ?>
                        <div class="entry-header">
                            <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
                            <div class="entry-meta">
                                <?php beautiful_business_posted_on(); ?>
                            </div>
                        </div>
                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php
endif;
wp_reset_postdata();
?>
