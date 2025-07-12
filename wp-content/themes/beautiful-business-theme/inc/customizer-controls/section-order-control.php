<?php
/**
 * Customizer Control for Section Ordering
 *
 * @package Beautiful_Business_Theme
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
    return null;
}

class Beautiful_Business_Section_Order_Control extends WP_Customize_Control {

    public $type = 'beautiful_business_section_order';

    public function enqueue() {
        wp_enqueue_script( 'jquery-ui-sortable' );
        wp_enqueue_script( 'beautiful-business-section-order', get_template_directory_uri() . '/js/section-orderer.js', array( 'jquery', 'jquery-ui-sortable', 'customize-controls' ), BEAUTIFUL_BUSINESS_VERSION, true );
        wp_enqueue_style( 'beautiful-business-section-order-css', get_template_directory_uri() . '/css/section-orderer.css' );
    }

    public function render_content() {
        if ( empty( $this->choices ) ) {
            return;
        }

        $saved_order = explode( ',', $this->value() );
        $default_order = explode( ',', $this->setting->default );

        // Ensure saved order has all the default sections, in case new ones were added.
        $order = array_unique( array_merge( $saved_order, $default_order ) );

        ?>
        <label>
            <?php if ( ! empty( $this->label ) ) : ?>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <?php endif; ?>
            <?php if ( ! empty( $this->description ) ) : ?>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <?php endif; ?>

            <ul class="beautiful-business-section-order-list">
                <?php foreach ( $order as $section_id ) : ?>
                    <?php
                    // Don't display if the section ID is not in the original choices (e.g. it was removed)
                    if ( ! isset( $this->choices[ $section_id ] ) ) {
                        continue;
                    }

                    $visibility_setting = $this->manager->get_setting( 'bbt_show_section_' . $section_id );
                    ?>
                    <li class="section-order-item" data-section-id="<?php echo esc_attr( $section_id ); ?>">
                        <i class="dashicons dashicons-menu handle"></i>
                        <span class="section-label"><?php echo esc_html( $this->choices[ $section_id ] ); ?></span>
                        <input type="checkbox" class="section-visibility-toggle" <?php checked( $visibility_setting->value() ); ?> />
                        <span class="dashicons dashicons-visibility visibility-icon"></span>
                    </li>
                <?php endforeach; ?>
            </ul>

            <input type="hidden" class="section-order-input" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $order ) ); ?>" />
        </label>
        <?php
    }
}
