<?php
/**
 * Template part for displaying the client logos section on the homepage.
 *
 * @package Beautiful_Business_Theme
 */

$logos = array();
for ( $i = 1; $i <= 4; $i++ ) {
    $logo = get_theme_mod( "bbt_client_logo_{$i}" );
    if ( ! empty( $logo ) ) {
        $logos[] = $logo;
    }
}

if ( ! empty( $logos ) ) : ?>
    <section id="homepage-clients" class="homepage-content-section homepage-client-logos-section alternate-background">
        <div class="container">
            <div class="client-logos-grid">
                <?php foreach ( $logos as $logo_url ) : ?>
                    <div class="client-logo-item">
                        <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php esc_attr_e( 'Client Logo', 'beautiful-business' ); ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
