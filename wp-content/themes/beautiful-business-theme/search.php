<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Beautiful_Business_Theme
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php if ( have_posts() ) : ?>

            <header class="page-header search-header">
                <h1 class="page-title">
                    <?php
                    /* translators: %s: search query. */
                    printf( esc_html__( 'Search Results for: %s', 'beautiful-business' ), '<span>' . get_search_query() . '</span>' );
                    ?>
                </h1>
            </header><!-- .page-header -->

            <?php
            /* Start the Loop */
            while ( have_posts() ) :
                the_post();

                /**
                 * Run the loop for the search to output the results.
                 * We'll use a simplified summary format, similar to archives.
                 * A 'content-search.php' template part could be created for more customization.
                 */
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item'); ?>>
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

                    <div class="entry-summary">
                        <?php the_excerpt(); ?>
                    </div><!-- .entry-summary -->

                    <footer class="entry-footer">
                         <a href="<?php the_permalink(); ?>" class="read-more-link"><?php esc_html_e( 'View Post', 'beautiful-business' ); ?><span class="screen-reader-text"> <?php echo wp_kses_post( get_the_title() ); ?></span></a>
                    </footer><!-- .entry-footer -->
                </article><!-- #post-<?php the_ID(); ?> -->
                <?php
            endwhile;

            the_posts_navigation(); // For pagination of search results

        else :
            ?>
            <section class="no-results not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'beautiful-business' ); ?></h1>
                </header>
                <div class="page-content">
                    <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'beautiful-business' ); ?></p>
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
