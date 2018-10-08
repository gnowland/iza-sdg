<?php
/**
 * IZA SDG Admin Page
 * 
 * @package    IzaSdg
 * @subpackage IzaSdgAdmin
 * @author     Gifford Nowland <hi@giffordnowland.com>
 * @since      2.0.0
 */
if (!class_exists('IzaSdgAdmin')) {
    class IzaSdgAdmin {
        public function __construct() {
            if (!is_admin()) return;
            // Register settings
            add_action('admin_init', [$this, 'add_settings']);
            // Add menu item
            add_action('admin_menu', [$this, 'add_admin_page']);
        }

        public function add_settings() {
            // register iza-sdg settings
            register_setting('iza-sdg', 'iza_sdg', [$this, 'sanitize_content']);

             // content section
            add_settings_section(
                'iza_sdg_settings_page',
                null, //__('Content', 'iza-sdg'),
                null,
                'iza-sdg'
            );


            // add content field
            add_settings_field(
                'content', // internal use only as of WP 4.6
                // use $args' label_for to populate the id inside the callback
                __('Content', 'iza-sdg'),
                [&$this, 'iza_sdg_content'],
                'iza-sdg',
                'iza_sdg_settings_page',
                ['label_for' => 'content']
            );
        }

        public function iza_sdg_content($args) {
             // get the value of the setting we've registered with register_setting()
            $options = get_option('iza_sdg');

            // output the field
            ?><textarea id="<?= esc_attr($args['label_for']) ?>" name="iza_sdg[<?= esc_attr( $args['label_for'] ) ?>]" placeholder="<?= __('Add content', 'iza-sdg') ?>&hellip;"><?= !empty($options[$args['label_for']]) ? esc_html_e($options[$args['label_for']], 'iza-sdg') : '' ?></textarea>
            <?php
        }


        public function sanitize_content($input) {
            $sanitized = [];
            if(isset($input['content'])) {
                $sanitized['content'] = wp_kses_post($input['content']);
            }
            return $sanitized;
        }

        public function admin_page() {
            // check user capabilities
            if (!current_user_can('edit_pages')) return;

            // check if the user has submitted the settings
            // on save WordPress will add the "settings-updated" $_GET parameter to the url
            if (isset($_GET['settings-updated'])) {
                // add settings saved message with the class of "updated"
                add_settings_error('iza_sdg_messages', 'iza_sdg_message', __('Settings Saved', 'iza-sdg'), 'updated');
            }

            // show error/update messages
            settings_errors('iza_sdg_messages');

            ?><div class="wrap">
                <h1><?= esc_html(get_admin_page_title()); ?></h1>
                <style>
                    table.form-table tr { display: flex; flex-direction: column; }
                    table.form-table tr > th { padding: 0 10px; }
                    table.form-table textarea { width: 100%; height: calc(100vh - 320px); min-height: 200px; }
                </style>
                <form action="options.php" method="post"><?php
                    // output security fields for the registered setting "iza-sdg"
                    settings_fields('iza-sdg');
                    // output setting sections and their fields
                    // (sections are registered for "iza-sdg", each field is registered to a specific section)
                    do_settings_sections('iza-sdg');
                    // output save settings button
                    submit_button('Save');
                ?></form>
            </div><?php
        }

        public function add_admin_page() {
            add_theme_page(
                'IZA SDG',
                'IZA SDG',
                'edit_pages',
                'iza-sdg',
                [&$this, 'admin_page']
           );
        }
    }
}
