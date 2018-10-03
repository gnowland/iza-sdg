<?php
/**
 *
 * @wordpress-plugin
 * Plugin Name:         IZA SDG
 * Plugin URI:          https://github.com/gnowland/iza-sdg
 * Description:         Sustainable Development Goals interactive graphic for https://sustainability.zinc.org
 * Version:             1.1.0
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
        private $scripts_loaded;

        // Run plugin
        public static function init() {
            if ( is_null( self::$instance ) ) {
            self::$instance = new IzaSdg();
            }
            return self::$instance;
        }

        // Initialize plugin
        private function __construct() {
            // Set scripts loaded to false
            $this->scripts_loaded = false;

            // Load textdomain (for translations)
            add_action('plugins_loaded', [$this, 'load_textdomain']);

            // Add shortcode
            add_shortcode('iza_sdg', [$this, 'add_shortcode']);

            // Register scripts & styles
            add_action('init', [$this, 'register_scripts'], 11);
        }

        // Load textdomain
        public static function load_textdomain() {
            load_plugin_textdomain( 'iza-sdg', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );
        }

        // Register scripts & styles
        public function register_scripts() {
            wp_register_script('iza-sdg-js', plugin_dir_url(__FILE__) . 'dist/js/main.bundle.js', [], false, false);
            wp_register_style('iza-sdg', plugin_dir_url(__FILE__) . 'dist/css/main.min.css', [], false, 'all' );
        }

        // Enqueue scripts & styles
        public function add_scripts() {
            // Skip if already loaded
            if ($this->scripts_loaded) return;

            wp_enqueue_script('iza-sdg-js');
            wp_enqueue_style('iza-sdg');

            // Set scripts to loaded
            $this->scripts_loaded = true;
        }

        /**
         * Returns the HTML markup for the shortcode
         * 
         * @return string HTML markup.
         */
        public function add_shortcode() {
            // Add the scripts & styles
            $this->add_scripts();

            // Output the content
            ob_start();
            include( dirname ( __FILE__ ) . '/shortcode-content.php' );
            return ob_get_clean();
        }
    }
}
// init the plugin
$iza_sdg = IzaSdg::init();
