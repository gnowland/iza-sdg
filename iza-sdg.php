<?php
/**
 *
 * @wordpress-plugin
 * Plugin Name:         IZA SDG
 * Plugin URI:          https://github.com/gnowland/iza-sdg
 * Description:         Sustainable Development Goals interactive graphic for https://sustainability.zinc.org
 * Version:             1.0.0
 * Author:              Gifford Nowland
 * Author URI:          https://github.com/gnowland
 *
 * License:             
 * License URI:         
 *
 * GitHub Plugin URI:   gnowland/iza-sdg
 * GitHub Branch:       master
 *
 * Text Domain:         iza-sdg
 * Domain Path:         /languages
 *
 */

// Prevent direct execution
if (!defined('ABSPATH')) {
    die;
};

// Plugin setup
if ( ! class_exists('IzaSdg') ) {
    class IzaSdg {
        public static $instance;
        public static function init() {
            if ( is_null( self::$instance ) ) {
            self::$instance = new IzaSdg();
            }
            return self::$instance;
        }
        private function __construct() {
            // load textdomain for translations
            add_action( 'plugins_loaded',  array( $this, 'load_textdomain' ) );
        }
        /**
         * Load our textdomain
         */
        public static function load_textdomain() {
            load_plugin_textdomain( 'iza-sdg', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );
        }
    }
}
// init the plugin
$iza_sdg = IzaSdg::init();
