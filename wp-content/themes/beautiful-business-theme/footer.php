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
        <div class="footer-main container">
            <?php // Widget areas would go here in a future update ?>
        </div><!-- .footer-main -->

        <div class="site-info-wrapper">
            <div class="container site-info">
                <?php
                // Copyright text from Customizer
                $copyright_text_template = get_theme_mod( 'bbt_copyright_text', __( '&copy; [year] [site_name]. All rights reserved.', 'beautiful-business' ) );
                $current_year = date_i18n( 'Y' );
                $site_name = get_bloginfo( 'name' );
                $copyright_text = str_replace( '[year]', $current_year, $copyright_text_template );
                $copyright_text = str_replace( '[site_name]', $site_name, $copyright_text );
                echo '<p class="copyright-text">' . wp_kses_post( $copyright_text ) . '</p>';
                ?>
                <span class="sep"> | </span>
                <?php
                // Theme author credit
                $bbt_theme = wp_get_theme();
                printf(
                    /* translators: 1: Theme name, 2: Theme author link. */
                    esc_html__( 'Theme: %1$s by %2$s.', 'beautiful-business' ),
                    esc_html( $bbt_theme->get( 'Name' ) ),
                    sprintf( '<a href="%s" rel="designer">%s</a>', esc_url( $bbt_theme->get( 'AuthorURI' ) ), esc_html( $bbt_theme->get( 'Author' ) ) )
                );
                ?>
                <span class="sep"> | </span>
                <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'beautiful-business' ) ); ?>">
                    <?php
                    /* translators: %s: CMS name, i.e. WordPress. */
                    printf( esc_html__( 'Proudly powered by %s', 'beautiful-business' ), 'WordPress' );
                    ?>
                </a>
            </div><!-- .site-info -->
        </div><!-- .site-info-wrapper -->
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
