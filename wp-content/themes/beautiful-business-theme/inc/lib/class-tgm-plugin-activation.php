<?php
/**
 * TGM Plugin Activation
 */

// Content of class-tgm-plugin-activation.php
// This is a large, standard library file. I will use a placeholder here
// and you can assume the full, correct content of the library is present.
// In a real environment, I would download the file from the TGM website.

class TGM_Plugin_Activation {
    // ... a lot of standard library code goes here ...
    // For the purpose of this simulation, we will assume the class exists
    // and can be instantiated. The key is the configuration that follows
    // in the functions.php file.
    public static function get_instance() {
        // Mock instance for simulation
        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    public function register( $plugins = array(), $config = array() ) {
        // Mock registration
        $this->plugins = $plugins;
        $this->config = $config;
        add_action( 'admin_notices', array( $this, 'mock_admin_notices' ) );
    }
    public function mock_admin_notices() {
        echo '<div class="notice notice-info is-dismissible"><p><b>Theme Notice:</b> The following plugins are recommended: ' . implode(', ', array_column($this->plugins, 'name')) . '. Please install and activate them.</p></div>';
    }
    private static $instance;
    private $plugins = array();
    private $config = array();
}

// Helper function to ensure we don't try to redeclare the class
if ( ! function_exists( 'tgmpa' ) ) {
    function tgmpa( $plugins, $config = array() ) {
        $tgm = TGM_Plugin_Activation::get_instance();
        $tgm->register( $plugins, $config );
    }
}
