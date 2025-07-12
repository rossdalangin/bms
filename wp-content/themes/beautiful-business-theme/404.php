<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Beautiful_Business_Theme
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <section class="error-404 not-found section-padding">
            <div class="container text-align-center"> <?php // Added text-align-center utility class ?>
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'beautiful-business' ); ?></h1>
                </header><!-- .page-header -->

                <div class="page-content">
                    <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'beautiful-business' ); ?></p>

                    <?php
                    get_search_form();

                    // Optionally, display some common widgets or links:
                    /*
                    if ( beautiful_business_categorized_blog() ) { // Example condition
                        the_widget( 'WP_Widget_Recent_Posts' );
                    }

                    the_widget( 'WP_Widget_Tag_Cloud' );
                    */
                    ?>
                    <p style="margin-top: 2em;">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button"><?php esc_html_e( 'Return to Homepage', 'beautiful-business' ); ?></a>
                    </p>

                </div><!-- .page-content -->
            </div><!-- .container -->
        </section><!-- .error-404 -->

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
