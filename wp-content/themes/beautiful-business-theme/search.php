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
                 get_template_part( 'template-parts/content', 'summary' );
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
