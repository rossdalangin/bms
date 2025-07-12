<?php
/**
 * The template for displaying the Blog posts index (when a static front page is set).
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Beautiful_Business_Theme
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <header class="page-header blog-header">
            <h1 class="page-title">
                <?php
                // If a static page is assigned as the Posts Page, its title is used.
                // Otherwise, provide a fallback.
                $posts_page_id = get_option('page_for_posts');
                if ( $posts_page_id && get_post_field( 'post_title', $posts_page_id ) ) {
                    echo esc_html( get_the_title( $posts_page_id ) );
                } else {
                    esc_html_e( 'Blog', 'beautiful-business' );
                }
                ?>
            </h1>
            <?php
            // Optional: Add a description for the blog if needed via Customizer or a specific field.
            // $blog_description = get_theme_mod('bbt_blog_description', '');
            // if ( $blog_description ) {
            //     echo '<div class="archive-description">' . wp_kses_post( $blog_description ) . '</div>';
            // }
            ?>
        </header><!-- .page-header -->

        <?php
        if ( have_posts() ) :

            /* Start the Loop */
            while ( have_posts() ) :
                the_post();

                /*
                 * We'll create a 'content.php' or 'content-post.php' template part in the next step
                 * to handle the display of each post in the loop for better organization.
                 * For now, we can keep the simplified display from index.php or expand slightly.
                 */
                // get_template_part( 'template-parts/content', get_post_type() ); // More generic
                // For now, using a simplified structure similar to index.php:
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('blog-post-summary'); ?>>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('large'); // Or 'medium_large' ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <header class="entry-header">
                        <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

                        <div class="entry-meta">
                            <?php
                                beautiful_business_posted_on();
                                beautiful_business_posted_by();
                            ?>
                        </div><!-- .entry-meta -->
                    </header><!-- .entry-header -->

                    <div class="entry-summary">
                        <?php the_excerpt(); ?>
                    </div><!-- .entry-summary -->

                    <footer class="entry-footer">
                        <?php beautiful_business_entry_footer_meta(); ?>
                        <a href="<?php the_permalink(); ?>" class="read-more-link continue-reading-link"><?php esc_html_e( 'Continue Reading', 'beautiful-business' ); ?><span class="screen-reader-text"> <?php echo wp_kses_post( get_the_title() ); ?></span></a>
                    </footer><!-- .entry-footer -->
                </article><!-- #post-<?php the_ID(); ?> -->
                <?php
            endwhile;

            the_posts_navigation();

        else :
            // If no content, include the "No posts found" template.
            // We can create template-parts/content-none.php later.
            echo '<p>' . esc_html__( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'beautiful-business' ) . '</p>';
            // get_search_form(); // Optionally
        endif;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
// get_sidebar(); // If a sidebar is planned
get_footer();
