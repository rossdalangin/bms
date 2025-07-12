<?php
/**
 * Template part for displaying page content in page.php, front-page.php (if static page), etc.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Beautiful_Business_Theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
        // On static front page, we might not want to display the title if hero section already has one.
        // Or, if it's a regular page, the title is usually desired.
        if ( is_front_page() && is_home() ) { // Default homepage showing blog posts
            // Usually no title here as it's a blog listing
        } elseif ( is_front_page() ) { // Static front page
            // Potentially hide title: the_title( '<h1 class="entry-title screen-reader-text">', '</h1>' );
            // Or let it display if desired:
            // the_title( '<h1 class="entry-title">', '</h1>' );
        } else { // All other pages
            the_title( '<h1 class="entry-title">', '</h1>' );
        }
        ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'beautiful-business' ),
            'after'  => '</div>',
        ) );
        ?>
    </div><!-- .entry-content -->

    <?php if ( get_edit_post_link() && !is_front_page() ) : // Don't show edit link on front page content usually ?>
        <footer class="entry-footer">
            <?php
            edit_post_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers. */
                        __( 'Edit <span class="screen-reader-text">%s</span>', 'beautiful-business' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ),
                '<span class="edit-link">',
                '</span>'
            );
            ?>
        </footer><!-- .entry-footer -->
    <?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
