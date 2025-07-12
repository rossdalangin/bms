<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Beautiful_Business_Theme
 */

?>

    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="site-info container">
            <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'beautiful-business' ) ); ?>">
                <?php
                /* translators: %s: CMS name, i.e. WordPress. */
                printf( esc_html__( 'Proudly powered by %s', 'beautiful-business' ), 'WordPress' );
                ?>
            </a>
            <span class="sep"> | </span>
            <?php
            $bbt_theme = wp_get_theme();
            $bbt_theme_name = $bbt_theme->get( 'Name' );
            $bbt_author_uri = $bbt_theme->get( 'AuthorURI' );
            $bbt_author_name = $bbt_theme->get( 'Author' );

            if ( ! empty( $bbt_author_uri ) && ! empty( $bbt_author_name ) ) {
                $bbt_author_link = sprintf( '<a href="%s">%s</a>', esc_url( $bbt_author_uri ), esc_html( $bbt_author_name ) );
            } elseif ( ! empty( $bbt_author_name ) ) {
                $bbt_author_link = esc_html( $bbt_author_name );
            } else {
                $bbt_author_link = esc_html__( 'The Theme Author', 'beautiful-business' ); // Fallback
            }

            /* translators: 1: Theme name, 2: Theme author link. */
            printf( wp_kses_post( __( 'Theme: %1$s by %2$s.', 'beautiful-business' ) ), esc_html( $bbt_theme_name ), $bbt_author_link );
            ?>
            <?php
            $copyright_text_template = get_theme_mod( 'bbt_copyright_text', __( '&copy; [year] [site_name]. All rights reserved.', 'beautiful-business' ) );
            $current_year = date_i18n( 'Y' );
            $site_name = get_bloginfo( 'name' );

            $copyright_text = str_replace( '[year]', $current_year, $copyright_text_template );
            $copyright_text = str_replace( '[site_name]', $site_name, $copyright_text );
            ?>
            <p class="copyright-text"><?php echo esc_html( $copyright_text ); ?></p>
        </div><!-- .site-info -->
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
