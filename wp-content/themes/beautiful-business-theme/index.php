<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Beautiful_Business_Theme
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        if ( have_posts() ) :

            /* Start the Loop */
            while ( have_posts() ) :
                the_post();

                /*
                 * Include the Post-Format-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                 */
                // get_template_part( 'template-parts/content', get_post_format() ); // We'll create this later
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                        <?php if ( 'post' === get_post_type() ) : ?>
                        <div class="entry-meta">
                            <?php
                                beautiful_business_posted_on();
                                beautiful_business_posted_by();
                            ?>
                        </div><!-- .entry-meta -->
                        <?php endif; ?>
                    </header><!-- .entry-header -->

                    <div class="entry-summary"> <?php // Changed from entry-content to entry-summary for consistency with home.php ?>
                        <?php the_excerpt(); ?>
                    </div><!-- .entry-summary -->

                    <footer class="entry-footer">
                        <?php beautiful_business_entry_footer_meta(); ?>
                        <?php // For index.php, a general "Read More" might be more appropriate than "Continue Reading" if it's mixed content ?>
                        <a href="<?php the_permalink(); ?>" class="read-more-link continue-reading-link"><?php esc_html_e( 'Read More', 'beautiful-business' ); ?><span class="screen-reader-text"> <?php echo wp_kses_post( get_the_title() ); ?></span></a>
                    </footer><!-- .entry-footer -->
                </article><!-- #post-<?php the_ID(); ?> -->
                <?php

            endwhile;

            the_posts_navigation();

        else :

            // get_template_part( 'template-parts/content', 'none' ); // We'll create this later
            echo '<p>' . esc_html__( 'No posts found.', 'beautiful-business' ) . '</p>';

        endif;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
// get_sidebar(); // If you plan to have a sidebar
get_footer();
