<?php
/**
 * Customizer Control for Information and Links
 *
 * @package Beautiful_Business_Theme
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
    return null;
}

class Beautiful_Business_Info_Control extends WP_Customize_Control {

    public $type = 'beautiful_business_info';
    public $label = '';
    public $description = '';
    public $url = '';
    public $url_text = '';

    public function render_content() {
        ?>
        <div class="beautiful-business-info-control">
            <?php if ( ! empty( $this->label ) ) : ?>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <?php endif; ?>

            <?php if ( ! empty( $this->description ) ) : ?>
                <p class="description"><?php echo wp_kses_post( $this->description ); ?></p>
            <?php endif; ?>

            <?php if ( ! empty( $this->url ) && ! empty( $this->url_text ) ) : ?>
                <?php if ( class_exists( 'OCDI_Plugin' ) ) : ?>
                    <a href="<?php echo esc_url( $this->url ); ?>" class="button button-primary">
                        <?php echo esc_html( $this->url_text ); ?>
                    </a>
                <?php else : ?>
                    <p class="description" style="color: #c92c2c;">
                        <?php esc_html_e( 'Please install and activate the "One Click Demo Import" plugin to use this feature.', 'beautiful-business' ); ?>
                    </p>
                    <a href="<?php echo esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ); ?>" class="button button-secondary">
                        <?php esc_html_e( 'Install Plugin', 'beautiful-business' ); ?>
                    </a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php
    }
}
