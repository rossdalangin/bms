<?php
/**
 * TGM Plugin Activation configuration for the theme.
 *
 * @package Beautiful_Business_Theme
 */

// Include the TGM Plugin Activation class.
require_once get_template_directory() . '/inc/lib/class-tgm-plugin-activation.php';

/**
 * Register the required and recommended plugins for this theme.
 */
function beautiful_business_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is from a private repository, slug should be defined,
     * and source should point to the plugin zip file.
     */
    $plugins = array(

        // The One Click Demo Import plugin.
        array(
            'name'      => 'One Click Demo Import',
            'slug'      => 'one-click-demo-import',
            'required'  => false, // Recommend, don't require
        ),

    );

    /*
     * Array of configuration settings. Amend each line as needed.
     */
    $config = array(
        'id'           => 'beautiful-business',      // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the notice until installed.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );

    tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'beautiful_business_register_required_plugins' );
