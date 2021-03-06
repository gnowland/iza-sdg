<?php
/**
 *
 * @wordpress-plugin
 * Plugin Name:         IZA SDG
 * Plugin URI:          https://github.com/gnowland/iza-sdg
 * Description:         Sustainable Development Goals interactive graphic for https://sustainability.zinc.org
 * Version:             2.1.0
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
if ( !class_exists('IzaSdg') ) {
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
            add_action('wp_enqueue_scripts', [$this, 'register_scripts']);

            // Add admin page
            if ( is_admin() ) $this->load_admin();
        }

        // Load textdomain
        public static function load_textdomain() {
            load_plugin_textdomain( 'iza-sdg', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );
        }

        // Load admin
        public static function load_admin() {
            require_once plugin_dir_path( __FILE__ ) . 'iza-sdg-admin.php';
            $plugin_admin = new IzaSdgAdmin();
        }

        // Register scripts & styles
        public function register_scripts() {
            wp_register_script('iza-sdg-js', plugins_url('dist/js/main.bundle.js', __FILE__), [], false, false);
            if (file_exists($css_prod = plugins_url('dist/css/main.min.css', __FILE__))) {
                wp_register_style('iza-sdg', $css_prod, [], false, 'all' ); 
            } else {
                wp_register_style('iza-sdg', plugins_url('dist/css/main.css', __FILE__), [], false, 'all' ); 
            }
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
         * Return shortcode HTML
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
