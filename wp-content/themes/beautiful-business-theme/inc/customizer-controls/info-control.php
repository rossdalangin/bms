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
                <a href="<?php echo esc_url( $this->url ); ?>" class="button button-primary" target="_blank">
                    <?php echo esc_html( $this->url_text ); ?>
                </a>
            <?php endif; ?>
        </div>
        <?php
    }
}
