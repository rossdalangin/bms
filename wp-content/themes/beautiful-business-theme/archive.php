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
                 get_template_part( 'template-parts/content', 'summary' );
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
