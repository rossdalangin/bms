<?php
/**
 * Custom Post Type definitions
 *
 * @package Beautiful_Business_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Register Service Custom Post Type
 */
function beautiful_business_register_service_cpt() {

    $labels = array(
        'name'                  => _x( 'Services', 'Post Type General Name', 'beautiful-business' ),
        'singular_name'         => _x( 'Service', 'Post Type Singular Name', 'beautiful-business' ),
        'menu_name'             => __( 'Services', 'beautiful-business' ),
        'name_admin_bar'        => __( 'Service', 'beautiful-business' ),
        'archives'              => __( 'Service Archives', 'beautiful-business' ),
        'attributes'            => __( 'Service Attributes', 'beautiful-business' ),
        'parent_item_colon'     => __( 'Parent Service:', 'beautiful-business' ),
        'all_items'             => __( 'All Services', 'beautiful-business' ),
        'add_new_item'          => __( 'Add New Service', 'beautiful-business' ),
        'add_new'               => __( 'Add New', 'beautiful-business' ),
        'new_item'              => __( 'New Service', 'beautiful-business' ),
        'edit_item'             => __( 'Edit Service', 'beautiful-business' ),
        'update_item'           => __( 'Update Service', 'beautiful-business' ),
        'view_item'             => __( 'View Service', 'beautiful-business' ),
        'view_items'            => __( 'View Services', 'beautiful-business' ),
        'search_items'          => __( 'Search Service', 'beautiful-business' ),
        'not_found'             => __( 'Not found', 'beautiful-business' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'beautiful-business' ),
        'featured_image'        => __( 'Featured Image', 'beautiful-business' ),
        'set_featured_image'    => __( 'Set featured image', 'beautiful-business' ),
        'remove_featured_image' => __( 'Remove featured image', 'beautiful-business' ),
        'use_featured_image'    => __( 'Use as featured image', 'beautiful-business' ),
        'insert_into_item'      => __( 'Insert into service', 'beautiful-business' ),
        'uploaded_to_this_item' => __( 'Uploaded to this service', 'beautiful-business' ),
        'items_list'            => __( 'Services list', 'beautiful-business' ),
        'items_list_navigation' => __( 'Services list navigation', 'beautiful-business' ),
        'filter_items_list'     => __( 'Filter services list', 'beautiful-business' ),
    );
    $args = array(
        'label'                 => __( 'Service', 'beautiful-business' ),
        'description'           => __( 'Post Type for Business Services', 'beautiful-business' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies'            => array(), // Add 'category', 'post_tag' if needed
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-admin-generic',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'services', // Use 'services' as archive slug
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true, // For Gutenberg editor support
        'rewrite'               => array( 'slug' => 'services', 'with_front' => false ),
    );
    register_post_type( 'service', $args );

}
add_action( 'init', 'beautiful_business_register_service_cpt', 0 );


/**
 * Register Project Custom Post Type
 */
function beautiful_business_register_project_cpt() {

    $labels = array(
        'name'                  => _x( 'Projects', 'Post Type General Name', 'beautiful-business' ),
        'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'beautiful-business' ),
        'menu_name'             => __( 'Projects', 'beautiful-business' ),
        'name_admin_bar'        => __( 'Project', 'beautiful-business' ),
        'archives'              => __( 'Project Archives', 'beautiful-business' ),
        'attributes'            => __( 'Project Attributes', 'beautiful-business' ),
        'parent_item_colon'     => __( 'Parent Project:', 'beautiful-business' ),
        'all_items'             => __( 'All Projects', 'beautiful-business' ),
        'add_new_item'          => __( 'Add New Project', 'beautiful-business' ),
        'add_new'               => __( 'Add New', 'beautiful-business' ),
        'new_item'              => __( 'New Project', 'beautiful-business' ),
        'edit_item'             => __( 'Edit Project', 'beautiful-business' ),
        'update_item'           => __( 'Update Project', 'beautiful-business' ),
        'view_item'             => __( 'View Project', 'beautiful-business' ),
        'view_items'            => __( 'View Projects', 'beautiful-business' ),
        'search_items'          => __( 'Search Project', 'beautiful-business' ),
        'not_found'             => __( 'Not found', 'beautiful-business' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'beautiful-business' ),
        'featured_image'        => __( 'Featured Image', 'beautiful-business' ),
        'set_featured_image'    => __( 'Set featured image', 'beautiful-business' ),
        'remove_featured_image' => __( 'Remove featured image', 'beautiful-business' ),
        'use_featured_image'    => __( 'Use as featured image', 'beautiful-business' ),
        'insert_into_item'      => __( 'Insert into project', 'beautiful-business' ),
        'uploaded_to_this_item' => __( 'Uploaded to this project', 'beautiful-business' ),
        'items_list'            => __( 'Projects list', 'beautiful-business' ),
        'items_list_navigation' => __( 'Projects list navigation', 'beautiful-business' ),
        'filter_items_list'     => __( 'Filter projects list', 'beautiful-business' ),
    );
    $args = array(
        'label'                 => __( 'Project', 'beautiful-business' ),
        'description'           => __( 'Post Type for Business Projects or Portfolio', 'beautiful-business' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies'            => array(), // Add 'project_category', 'project_tag' if needed
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 6, // After Services
        'menu_icon'             => 'dashicons-portfolio',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'projects', // Use 'projects' as archive slug
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true, // For Gutenberg editor support
        'rewrite'               => array( 'slug' => 'projects', 'with_front' => false ),
    );
    register_post_type( 'project', $args );

}
add_action( 'init', 'beautiful_business_register_project_cpt', 0 );


/**
 * Register Testimonial Custom Post Type
 */
function beautiful_business_register_testimonial_cpt() {

    $labels = array(
        'name'                  => _x( 'Testimonials', 'Post Type General Name', 'beautiful-business' ),
        'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'beautiful-business' ),
        'menu_name'             => __( 'Testimonials', 'beautiful-business' ),
        'name_admin_bar'        => __( 'Testimonial', 'beautiful-business' ),
        'archives'              => __( 'Testimonial Archives', 'beautiful-business' ),
        'attributes'            => __( 'Testimonial Attributes', 'beautiful-business' ),
        'parent_item_colon'     => __( 'Parent Testimonial:', 'beautiful-business' ),
        'all_items'             => __( 'All Testimonials', 'beautiful-business' ),
        'add_new_item'          => __( 'Add New Testimonial', 'beautiful-business' ),
        'add_new'               => __( 'Add New', 'beautiful-business' ),
        'new_item'              => __( 'New Testimonial', 'beautiful-business' ),
        'edit_item'             => __( 'Edit Testimonial', 'beautiful-business' ),
        'update_item'           => __( 'Update Testimonial', 'beautiful-business' ),
        'view_item'             => __( 'View Testimonial', 'beautiful-business' ),
        'view_items'            => __( 'View Testimonials', 'beautiful-business' ),
        'search_items'          => __( 'Search Testimonial', 'beautiful-business' ),
        'not_found'             => __( 'Not found', 'beautiful-business' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'beautiful-business' ),
        'featured_image'        => __( 'Client Photo', 'beautiful-business' ), // Changed label
        'set_featured_image'    => __( 'Set client photo', 'beautiful-business' ), // Changed label
        'remove_featured_image' => __( 'Remove client photo', 'beautiful-business' ), // Changed label
        'use_featured_image'    => __( 'Use as client photo', 'beautiful-business' ), // Changed label
        'insert_into_item'      => __( 'Insert into testimonial', 'beautiful-business' ),
        'uploaded_to_this_item' => __( 'Uploaded to this testimonial', 'beautiful-business' ),
        'items_list'            => __( 'Testimonials list', 'beautiful-business' ),
        'items_list_navigation' => __( 'Testimonials list navigation', 'beautiful-business' ),
        'filter_items_list'     => __( 'Filter testimonials list', 'beautiful-business' ),
    );
    $args = array(
        'label'                 => __( 'Testimonial', 'beautiful-business' ),
        'description'           => __( 'Post Type for Client Testimonials', 'beautiful-business' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ), // Title for Client Name, Editor for Testimonial Text
        'hierarchical'          => false,
        'public'                => false, // Not publicly queryable usually
        'show_ui'               => true,  // Show in admin
        'show_in_menu'          => true,
        'menu_position'         => 7, // After Projects
        'menu_icon'             => 'dashicons-testimonial',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false, // Usually not added to nav menus directly
        'can_export'            => true,
        'has_archive'           => false, // No public archive page
        'exclude_from_search'   => true,  // Exclude from front-end search results
        'publicly_queryable'    => false, // Not accessible via URL directly
        'capability_type'       => 'post',
        'show_in_rest'          => true,  // Support for Gutenberg and REST API
        // 'rewrite'            => false, // No rewrite rules needed if not public
    );
    register_post_type( 'testimonial', $args );

}
add_action( 'init', 'beautiful_business_register_testimonial_cpt', 0 );


// In a real theme, you might add more CPTs here or flush rewrite rules on theme activation.
// For now, we'll manually remind to flush permalinks after adding CPTs.


/**
 * --------------------------------------------------------------------------
 * Testimonial CPT Meta Boxes
 * --------------------------------------------------------------------------
 */

/**
 * Adds a meta box to the Testimonial CPT edit screen.
 */
function beautiful_business_add_testimonial_details_meta_box() {
    add_meta_box(
        'testimonial_details_meta_box',                 // Unique ID
        __( 'Testimonial Details', 'beautiful-business' ), // Box title
        'beautiful_business_testimonial_details_meta_box_html', // Callback function
        'testimonial',                                  // Post type
        'normal',                                       // Context (normal, side, advanced)
        'high'                                          // Priority
    );
}
// Hook into 'add_meta_boxes_{post_type}'
add_action( 'add_meta_boxes_testimonial', 'beautiful_business_add_testimonial_details_meta_box' );

/**
 * Renders the HTML for the Testimonial Details meta box.
 *
 * @param WP_Post $post The current post object.
 */
function beautiful_business_testimonial_details_meta_box_html( $post ) {
    // Add a nonce field for security
    // The 'action' and 'name' should be unique to this meta box.
    wp_nonce_field( 'beautiful_business_save_testimonial_details_action', 'testimonial_details_nonce' );

    // Get the current value of the 'client_position' meta field, if it exists.
    // Prefix meta keys with an underscore to hide them from custom fields UI unless specified.
    $client_position = get_post_meta( $post->ID, '_client_position_company', true );
    ?>
    <p>
        <label for="client_position_company_field"><?php esc_html_e( 'Client Position/Company:', 'beautiful-business' ); ?></label>
        <br />
        <input type="text" id="client_position_company_field" name="client_position_company_field" class="widefat" value="<?php echo esc_attr( $client_position ); ?>" />
        <span class="description"><?php esc_html_e( 'E.g., CEO at Company Inc.', 'beautiful-business' ); ?></span>
    </p>
    <?php
}

/**
 * Saves the meta box data for Testimonial posts.
 *
 * @param int $post_id The ID of the post being saved.
 */
function beautiful_business_save_testimonial_details_meta_data( $post_id ) {
    // Check if our nonce is set and valid.
    if ( ! isset( $_POST['testimonial_details_nonce'] ) || ! wp_verify_nonce( $_POST['testimonial_details_nonce'], 'beautiful_business_save_testimonial_details_action' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
    // 'testimonial' is the post type from beautiful_business_add_testimonial_details_meta_box
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Ensure this is the 'testimonial' post type, might be redundant if save_post_testimonial is used, but good for generic save_post.
    if ( ! isset($_POST['post_type']) || 'testimonial' !== $_POST['post_type'] ) {
        // return; // If hooked to generic save_post, this is important. Less so for save_post_testimonial.
    }


    // Make sure that the 'client_position_company_field' is set.
    if ( ! isset( $_POST['client_position_company_field'] ) ) {
        // If it's not set, perhaps we want to delete the meta if it exists, or do nothing.
        // For now, we'll just return if it's not part of the submission.
        // Or, if you expect it to always be there (even if empty), handle accordingly.
        // Example: delete_post_meta( $post_id, '_client_position_company' );
        return;
    }

    // Sanitize user input.
    $client_position_data = sanitize_text_field( $_POST['client_position_company_field'] );

    // Update the meta field in the database.
    update_post_meta( $post_id, '_client_position_company', $client_position_data );
}
// Hook into 'save_post_{post_type}'
add_action( 'save_post_testimonial', 'beautiful_business_save_testimonial_details_meta_data' );

?>
