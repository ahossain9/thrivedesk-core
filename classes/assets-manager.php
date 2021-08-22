<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Assets {
    /**
    * Instance
    *
    * @since 1.0.0
    * @access private
    * @static
    *
    * @var Plugin The single instance of the class.
    */
    private static $_instance = null;
 
    /**
    * Instance
    *
    * Ensures only one instance of the class is loaded or can be loaded.
    *
    * @since 1.2.0
    * @access public
    *
    * @return Plugin An instance of the class.
    */
    public static function instance() {
    if ( is_null( self::$_instance ) ) {
      self::$_instance = new self();
    }

    return self::$_instance;
    }

    public function __construct() {
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'register_frontend_styles' ] );
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_frontend_styles' ] );
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'register_frontend_scripts' ] );
        add_action( 'elementor/frontend/after_enqueue_scripts', array ( $this, 'enqueue_frontend_scripts' ), 10 );
        add_action( 'elementor/editor/after_enqueue_styles', array ( $this, 'thrivedesk_editor_styles' ) );
    }
    
    public function thrivedesk_editor_styles() {
        wp_enqueue_style('thrivedesk-elementor-editor', THRIVEDESK_ASSETS . 'css/elementor-editor.css', '', THRIVEDESK_VERSION );
    }
    
    // Register Styles
    public function register_frontend_styles() {          
        wp_register_style(
            'thrivedesk',
            THRIVEDESK_ASSETS . 'css/thrivedesk.css',
            null,
            THRIVEDESK_VERSION
        );

	}
    
    public function enqueue_frontend_styles() {
		wp_enqueue_style( 'thrivedesk' );

	}
    
    // Register Scripts
    public function register_frontend_scripts() {
        wp_register_script(
            'thrivedesk',
            THRIVEDESK_ASSETS . 'js/thrivedesk.js',
            array('jquery'),
            THRIVEDESK_VERSION,
            true
        ); 

	}
    
    public function enqueue_frontend_scripts() {
        wp_enqueue_script( 'thrivedesk' );
	}
}

// Assets Plugin Class
Assets::instance();
