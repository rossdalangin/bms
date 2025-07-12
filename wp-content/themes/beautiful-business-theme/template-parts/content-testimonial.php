<?php
/**
 * Template part for displaying a single testimonial.
 * To be used within a testimonial query loop.
 *
 * @package Beautiful_Business_Theme
 */

// Ensure the global $post is available if not in a standard loop context, though get_post_meta usually handles it.
// global $post;

$client_name = get_the_title(); // Using post title for client's name
$testimonial_content = get_the_content(); // Using main editor for testimonial content
$client_photo_id = get_post_thumbnail_id(); // Get ID of the featured image (client photo)

// Get the custom meta data: Client Position/Company
$client_position_company = get_post_meta( get_the_ID(), '_client_position_company', true );

?>
<article id="testimonial-<?php the_ID(); ?>" <?php post_class('testimonial-item'); ?>>

    <?php if ( $client_photo_id ) : ?>
        <div class="testimonial-photo">
            <?php echo wp_get_attachment_image( $client_photo_id, 'thumbnail', false, array('class' => 'client-photo') ); // 'thumbnail' or another appropriate size ?>
        </div>
    <?php endif; ?>

    <div class="testimonial-content">
        <?php
        // Display the testimonial content (from the main editor)
        // Using apply_filters to ensure content is processed (e.g., for shortcodes, paragraphs)
        echo apply_filters( 'the_content', $testimonial_content );
        ?>
    </div>

    <footer class="testimonial-meta">
        <p class="client-name"><?php echo esc_html( $client_name ); ?></p>
        <?php if ( ! empty( $client_position_company ) ) : ?>
            <p class="client-position"><?php echo esc_html( $client_position_company ); ?></p>
        <?php endif; ?>
    </footer>

</article><!-- #testimonial-<?php the_ID(); ?> -->
