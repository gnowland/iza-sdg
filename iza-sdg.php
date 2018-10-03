<?php
/**
 *
 * @wordpress-plugin
 * Plugin Name:         IZA SDG
 * Plugin URI:          https://github.com/gnowland/iza-sdg
 * Description:         Sustainable Development Goals interactive graphic for https://sustainability.zinc.org
 * Version:             1.0.0
 * 
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
 * Domain Path:         /lang
 *
 */
//namespace Gnowland\IzaSdg;

// Prevent direct execution
if (!defined('ABSPATH')) {
    die;
};

// Plugin singleton
if ( ! class_exists('IzaSdg') ) {
    class IzaSdg {
        public static $instance;
        public $scripts_loaded = false;

        // Run plugin
        public static function init() {
            if ( is_null( self::$instance ) ) {
            self::$instance = new IzaSdg();
            }
            return self::$instance;
        }

        // Initialize plugin
        private function __construct() {
            // Add textdomain (for translations)
            add_action( 'plugins_loaded',  array( $this, 'load_textdomain' ) );

            // Add shortcode
            add_shortcode( 'iza_sdg', array( $this, 'load_shortcode' ) );

            // Add scripts
            add_action( 'init', array( $this, 'load_scripts' ), 11 );
        }

        // Load textdomain
        public static function load_textdomain() {
            load_plugin_textdomain( 'iza-sdg', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );
        }

        // Load scripts
        public function load_scripts() {
            // Skip if scripts are already loaded
            if ($this->scripts_loded) return;

            // Load JS
            wp_enqueue_script('iza-sdg-js', plugin_dir_url(__FILE__) . 'dist/js/main.bundle.js', [], filemtime(plugin_dir_url(__FILE__) . 'dist/js/main.bundle.js'), false);
            wp_enqueue_style('iza-sdg-css', plugin_dir_url(__FILE__) . 'dist/css/main.min.css', [], filemtime(plugin_dir_url(__FILE__) . 'dist/css/main.min.css'), 'all' );

            // Prevent redundant loading of scripts
            $this->scripts_loaded = true;
        }
        /**
         * Returns the HTML markup for the shortcode.
         * 
         * @return string HTML markup.
         */
        public function shortcode() {
            // Output the script
            $this->load_scripts();
            // Return the simple markup
            return '<h1>Woah, Awesome.</h1>';
        }
    }
}
// init the plugin
$iza_sdg = IzaSdg::init();
