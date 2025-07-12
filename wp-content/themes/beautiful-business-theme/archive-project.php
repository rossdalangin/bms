<?php
/**
 * The template for displaying archive pages for the Project CPT.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Beautiful_Business_Theme
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php if ( have_posts() ) : ?>

            <header class="page-header">
                <?php
                    echo '<h1 class="page-title">' . esc_html( post_type_archive_title( '', false ) ) . '</h1>';
                    the_archive_description( '<div class="archive-description">', '</div>' );
                ?>
            </header><!-- .page-header -->

            <div class="projects-grid"> <?php // Optional wrapper for grid styling ?>
            <?php
            /* Start the Loop */
            while ( have_posts() ) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('project-item'); ?>>
                    <header class="entry-header">
                        <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                    </header><!-- .entry-header -->

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail project-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium_large'); // Example: using a different size for projects ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="entry-summary">
                        <?php the_excerpt(); ?>
                    </div><!-- .entry-summary -->

                    <footer class="entry-footer">
                         <a href="<?php the_permalink(); ?>" class="read-more-link"><?php esc_html_e( 'View Project', 'beautiful-business' ); ?></a>
                    </footer><!-- .entry-footer -->
                </article><!-- #post-<?php the_ID(); ?> -->
                <?php
            endwhile;
            ?>
            </div> <?php // end .projects-grid ?>
            <?php
            the_posts_navigation();

        else :
            ?>
            <section class="no-results not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e( 'No Projects Found', 'beautiful-business' ); ?></h1>
                </header><!-- .page-header -->
                <div class="page-content">
                    <p><?php esc_html_e( 'It seems we haven&rsquo;t added any projects yet. Please check back later!', 'beautiful-business' ); ?></p>
                </div><!-- .page-content -->
            </section><!-- .no-results -->
            <?php
        endif;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
