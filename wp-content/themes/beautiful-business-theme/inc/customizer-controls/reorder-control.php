<?php
/**
 * Customizer Control for Reordering Sections
 *
 * @package Beautiful_Business_Theme
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
    return null;
}

class Beautiful_Business_Reorder_Control extends WP_Customize_Control {

    public $type = 'beautiful_business_reorder';

    public function enqueue() {
        wp_enqueue_script( 'jquery-ui-sortable' );
        wp_enqueue_script( 'beautiful-business-section-reorder', get_template_directory_uri() . '/js/section-reorder.js', array( 'jquery', 'jquery-ui-sortable', 'customize-controls' ), BEAUTIFUL_BUSINESS_VERSION, true );
        wp_enqueue_style( 'beautiful-business-section-reorder-css', get_template_directory_uri() . '/css/section-reorder.css' );
    }

    public function render_content() {
        if ( empty( $this->choices ) ) {
            return;
        }

        $saved_order = explode( ',', $this->value() );
        $default_order = array_keys( $this->choices );

        // Ensure saved order has all the default sections
        $order = array_unique( array_merge( $saved_order, $default_order ) );

        ?>
        <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <?php if ( ! empty( $this->description ) ) : ?>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <?php endif; ?>

            <ul class="beautiful-business-reorder-list">
                <?php foreach ( $order as $section_id ) :
                    if ( ! isset( $this->choices[ $section_id ] ) ) {
                        continue;
                    }
                ?>
                    <li class="reorder-item" data-section-id="<?php echo esc_attr( $section_id ); ?>">
                        <i class="dashicons dashicons-menu handle"></i>
                        <span class="section-label"><?php echo esc_html( $this->choices[ $section_id ] ); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>

            <input type="hidden" class="reorder-input" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $order ) ); ?>" />
        </label>
        <?php
    }
}
