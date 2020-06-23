<?php
/**
 * Plugin Name:       Assets Ninja
 * Plugin URI:        https:noruzzamanrubel@gmail.com
 * Description:       This plugin is use Assets Management in Depth
 * Version:           1.0
 * Requires PHP:
 * Author:            Noruzzaman Rubel
 * Author URI:        https:noruzzamanrubel@gmail.com
 * License:           GPL v2 or later
 * Text Domain:       assetsninja
 * Domain Path:       /languages
 */

if ( !defined( "ABSPATH" ) ) {
    exit;
}
// Exit if accessed directly

define( 'ASN_ASSETS_PUBLIC_DIR', plugin_dir_url( __FILE__ ) . 'assets/public' );
define( 'ASN_ASSETS_ADMIN_DIR', plugin_dir_url( __FILE__ ) . 'assets/admin' );

class AssetsNinja {
    private $version;
    public function __construct() {
        $this->version = time();
        add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'load_public_assets' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'load_admin_assets' ) );
    }
    public function load_textdomain() {
        load_plugin_textdomain( 'assetsninja', false, plugin_dir_url( __FILE__ ) . '/languages' );
    }
    public function load_public_assets() {
        wp_enqueue_style( 'asn-main-css', ASN_ASSETS_PUBLIC_DIR . '/css/main.css', null, $this->version );
        wp_enqueue_script( 'asn-main.js', ASN_ASSETS_PUBLIC_DIR . '/js/main.js', array( 'jquery', 'asn-another.js' ), $this->version, true );
        wp_enqueue_script( 'asn-another.js', ASN_ASSETS_PUBLIC_DIR . '/js/another.js', array( 'jquery', 'asn-more.js' ), $this->version, true );
        wp_enqueue_script( 'asn-more.js', ASN_ASSETS_PUBLIC_DIR . '/js/more.js', array( 'jquery' ), $this->version, true );
    }
    function load_admin_assets( $screen ) {
        $_screen = get_current_screen();
        if ( 'edit.php' == $screen && 'page' == $_screen->post_type ) {
            wp_enqueue_script( 'asn-admin.js', ASN_ASSETS_ADMIN_DIR . '/js/admin.js', array( 'jquery' ), $this->version, true );
        }

    }

}

new AssetsNinja();