<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Beautiful_Business_Theme
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php if ( have_posts() ) : ?>

            <header class="page-header archive-header">
                <?php
                    the_archive_title( '<h1 class="page-title archive-title">', '</h1>' );
                    the_archive_description( '<div class="archive-description">', '</div>' );
                ?>
            </header><!-- .page-header -->

            <?php
            /* Start the Loop */
            while ( have_posts() ) :
                the_post();

                /*
                 * Include the Post-Type-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                 * For now, we'll use a structure similar to index.php/home.php for posts.
                 * CPTs like 'service' and 'project' have their own archive templates.
                 */
                 // For default 'post' type, use a similar structure to index/home.
                 // If other CPTs without specific archive templates use this, they'll get this basic layout.
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('archive-post-summary'); ?>>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium_large'); // Consistent size for archives ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <header class="entry-header">
                        <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

                        <?php if ( 'post' === get_post_type() ) : // Only show meta for actual blog posts ?>
                        <div class="entry-meta">
                            <?php
                                beautiful_business_posted_on();
                                beautiful_business_posted_by();
                            ?>
                        </div><!-- .entry-meta -->
                        <?php endif; ?>
                    </header><!-- .entry-header -->

                    <div class="entry-summary">
                        <?php the_excerpt(); ?>
                    </div><!-- .entry-summary -->

                    <footer class="entry-footer">
                        <?php if ( 'post' === get_post_type() ) : ?>
                            <?php beautiful_business_entry_footer_meta(); ?>
                        <?php endif; ?>
                        <a href="<?php the_permalink(); ?>" class="read-more-link continue-reading-link"><?php esc_html_e( 'Read More', 'beautiful-business' ); ?><span class="screen-reader-text"> <?php echo wp_kses_post( get_the_title() ); ?></span></a>
                    </footer><!-- .entry-footer -->
                </article><!-- #post-<?php the_ID(); ?> -->
                <?php
            endwhile;

            the_posts_navigation(); // For pagination

        else :
            // If no content, include a "No posts found" message.
            // Consider creating template-parts/content-none.php
            ?>
            <section class="no-results not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'beautiful-business' ); ?></h1>
                </header>
                <div class="page-content">
                    <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for in this archive. Perhaps searching can help.', 'beautiful-business' ); ?></p>
                    <?php get_search_form(); ?>
                </div><!-- .page-content -->
            </section>
            <?php
        endif;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
