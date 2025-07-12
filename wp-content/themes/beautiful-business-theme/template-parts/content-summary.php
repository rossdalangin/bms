<?php
/**
 * Template part for displaying post summaries (cards).
 *
 * @package Beautiful_Business_Theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('grid-item'); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php the_post_thumbnail('medium_large'); // Good default size for cards ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="entry-content-wrap">
        <header class="entry-header">
            <?php
            // Use H2 for blog lists, H3 for homepage sections
            $heading_tag = is_front_page() || is_home() ? 'h3' : 'h2';
            the_title( sprintf( '<%s class="entry-title"><a href="%s" rel="bookmark">', $heading_tag, esc_url( get_permalink() ) ), sprintf( '</a></%s>', $heading_tag ) );
            ?>

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
            <a href="<?php the_permalink(); ?>" class="read-more-link"><?php esc_html_e( 'Read More', 'beautiful-business' ); ?><span class="screen-reader-text"> <?php echo wp_kses_post( get_the_title() ); ?></span></a>
        </footer><!-- .entry-footer -->
    </div><!-- .entry-content-wrap -->
</article><!-- #post-<?php the_ID(); ?> -->
