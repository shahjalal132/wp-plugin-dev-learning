<?php

class PQRC_Enqueue_Assets {
    public function __construct() {
        $this->setup_hooks();
    }

    public function setup_hooks() {
        add_action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue_assets' ] );
    }

    public function admin_enqueue_assets( $screen ) {

        if ( 'options-general.php' == $screen ) :

            // Enqueue css
            wp_enqueue_style( "pqrc-mini-css", PQRC_PLUGIN_URL . "/assets/admin/css/minitoggle.css", [], time(), "all" );

            // Enqueue js
            wp_enqueue_script( "pqrc-minitoggle-js", PQRC_PLUGIN_URL . "/assets/admin/js/minitoggle.js", [ 'jquery' ], time(), true );
            wp_enqueue_script( "pqrc-main-js", PQRC_PLUGIN_URL . "/assets/admin/js/pqrc-main.js", [ 'jquery' ], time(), true );

        endif;
    }
}

new PQRC_Enqueue_Assets();