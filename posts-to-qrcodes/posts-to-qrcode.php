<?php

/**
 * Plugin Name: Posts to QRCode
 * Plugin URI:  #
 * Author:      Shah jalal
 * Author URI:  https://github.com/shahjalal132
 * Description: Convert Posts to QRCodes
 * Version:     0.1.0
 * License:     GPL-2.0+
 * License URL: http://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: posts-to-qrcodes
 */

defined( "ABSPATH" ) || exit( "Direct Access Not Allowed" );

function pqrc_load_textdomain() {
    load_plugin_textdomain( 'posts-to-qrcodes', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'pqrc_load_textdomain' );


// Define plugin path
if ( !defined( 'PQRC_PLUGIN_PATH' ) ) {
    define( 'PQRC_PLUGIN_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
}

// Define plugin url
if ( !defined( 'PQRC_PLUGIN_URL' ) ) {
    define( 'PQRC_PLUGIN_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
}


// includes files
require_once PQRC_PLUGIN_PATH . '/inc/pqrc-show-qr-code.php';
require_once PQRC_PLUGIN_PATH . '/inc/pqrc-settings-fields.php';
require_once PQRC_PLUGIN_PATH . '/inc/pqrc-enqueue-assets.php';