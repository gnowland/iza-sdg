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

            // add svg field
            add_settings_field(
                'svg', // internal use only as of WP 4.6
                // use $args' label_for to populate the id inside the callback
                __('SVG', 'iza-sdg'),
                [&$this, 'iza_sdg_svg'],
                'iza-sdg',
                'iza_sdg_settings_page',
                ['label_for' => 'svg']
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

        public function iza_sdg_svg($args) {
             // get the value of the setting we've registered with register_setting()
            $options = get_option('iza_sdg');

            // output the field
            ?><textarea id="<?= esc_attr($args['label_for']) ?>" name="iza_sdg[<?= esc_attr( $args['label_for'] ) ?>]" placeholder="<?= __('Add content', 'iza-sdg') ?>&hellip;"><?= !empty($options[$args['label_for']]) ? esc_html_e($options[$args['label_for']], 'iza-sdg') : '' ?></textarea>
            <?php
        }

        public function sanitize_content($input) {
            $sanitized = [];
            $allowed_html = wp_kses_allowed_html( 'post' );
            $svg_tags = [
                'a' => [
                    'class' => [], 'clip-path' => [], 'clip-rule' => [], 'fill' => [], 'fill-opacity' => [], 'fill-rule' => [], 'filter' => [], 'id' => [], 'mask' => [], 'opacity' => [], 'stroke' => [], 'stroke-dasharray' => [], 'stroke-dashoffset' => [], 'stroke-linecap' => [], 'stroke-linejoin' => [], 'stroke-miterlimit' => [], 'stroke-opacity' => [], 'stroke-width' => [], 'style' => [], 'systemlanguage' => [], 'transform' => [], 'href' => [], 'xlink:href' => [], 'xlink:title' => []
                ],
                'circle' => [
                    'class' => [], 'clip-path' => [], 'clip-rule' => [], 'cx' => [], 'cy' => [], 'fill' => [], 'fill-opacity' => [], 'fill-rule' => [], 'filter' => [], 'id' => [], 'mask' => [], 'opacity' => [], 'r' => [], 'requiredfeatures' => [], 'stroke' => [], 'stroke-dasharray' => [], 'stroke-dashoffset' => [], 'stroke-linecap' => [], 'stroke-linejoin' => [], 'stroke-miterlimit' => [], 'stroke-opacity' => [], 'stroke-width' => [], 'style' => [], 'systemlanguage' => [], 'transform' => []
                ],
                'clippath' => [
                    'class' => [], 'clippathunits' => [], 'id' => []
                ],
                'defs' => [],
                'style' => [
                    'type' => []
                ],
                'desc' => [],
                'ellipse' => [
                    'class' => [], 'clip-path' => [], 'clip-rule' => [], 'cx' => [], 'cy' => [], 'fill' => [], 'fill-opacity' => [], 'fill-rule' => [], 'filter' => [], 'id' => [], 'mask' => [], 'opacity' => [], 'requiredfeatures' => [], 'rx' => [], 'ry' => [], 'stroke' => [], 'stroke-dasharray' => [], 'stroke-dashoffset' => [], 'stroke-linecap' => [], 'stroke-linejoin' => [], 'stroke-miterlimit' => [], 'stroke-opacity' => [], 'stroke-width' => [], 'style' => [], 'systemlanguage' => [], 'transform' => []
                ],
                'fegaussianblur' => [
                    'class' => [], 'color-interpolation-filters' => [], 'id' => [], 'requiredfeatures' => [], 'stddeviation' => []
                ],
                'filter' => [
                    'class' => [], 'color-interpolation-filters' => [], 'filterres' => [], 'filterunits' => [], 'height' => [], 'id' => [], 'primitiveunits' => [], 'requiredfeatures' => [], 'width' => [], 'x' => [], 'xlink:href' => [], 'y' => []
                ],
                'foreignobject' => [
                    'class' => [], 'font-size' => [], 'height' => [], 'id' => [], 'opacity' => [], 'requiredfeatures' => [], 'style' => [], 'transform' => [], 'width' => [], 'x' => [], 'y' => []
                ],
                'g' => [
                    'class' => [], 'clip-path' => [], 'clip-rule' => [], 'id' => [], 'display' => [], 'fill' => [], 'fill-opacity' => [], 'fill-rule' => [], 'filter' => [], 'mask' => [], 'opacity' => [], 'requiredfeatures' => [], 'stroke' => [], 'stroke-dasharray' => [], 'stroke-dashoffset' => [], 'stroke-linecap' => [], 'stroke-linejoin' => [], 'stroke-miterlimit' => [], 'stroke-opacity' => [], 'stroke-width' => [], 'style' => [], 'systemlanguage' => [], 'transform' => [], 'font-family' => [], 'font-size' => [], 'font-style' => [], 'font-weight' => [], 'text-anchor' => []
                ],
                'image' => [
                    'class' => [], 'clip-path' => [], 'clip-rule' => [], 'filter' => [], 'height' => [], 'id' => [], 'mask' => [], 'opacity' => [], 'requiredfeatures' => [], 'style' => [], 'systemlanguage' => [], 'transform' => [], 'width' => [], 'x' => [], 'xlink:href' => [], 'xlink:title' => [], 'y' => []
                ],
                'line' => [
                    'class' => [], 'clip-path' => [], 'clip-rule' => [], 'fill' => [], 'fill-opacity' => [], 'fill-rule' => [], 'filter' => [], 'id' => [], 'marker-end' => [], 'marker-mid' => [], 'marker-start' => [], 'mask' => [], 'opacity' => [], 'requiredfeatures' => [], 'stroke' => [], 'stroke-dasharray' => [], 'stroke-dashoffset' => [], 'stroke-linecap' => [], 'stroke-linejoin' => [], 'stroke-miterlimit' => [], 'stroke-opacity' => [], 'stroke-width' => [], 'style' => [], 'systemlanguage' => [], 'transform' => [], 'x1' => [], 'x2' => [], 'y1' => [], 'y2' => []
                ],
                'lineargradient' => [
                    'class' => [], 'id' => [], 'gradienttransform' => [], 'gradientunits' => [], 'requiredfeatures' => [], 'spreadmethod' => [], 'systemlanguage' => [], 'x1' => [], 'x2' => [], 'xlink:href' => [], 'y1' => [], 'y2' => []
                ],
                'marker' => [
                    'id' => [], 'class' => [], 'markerheight' => [], 'markerunits' => [], 'markerwidth' => [], 'orient' => [], 'preserveaspectratio' => [], 'refx' => [], 'refy' => [], 'systemlanguage' => [], 'viewbox' => []
                ],
                'mask' => [
                    'class' => [], 'height' => [], 'id' => [], 'maskcontentunits' => [], 'maskunits' => [], 'width' => [], 'x' => [], 'y' => []
                ],
                'metadata' => [
                    'class' => [], 'id' => []
                ],
                'path' => [
                    'class' => [], 'clip-path' => [], 'clip-rule' => [], 'd' => [], 'fill' => [], 'fill-opacity' => [], 'fill-rule' => [], 'filter' => [], 'id' => [], 'marker-end' => [], 'marker-mid' => [], 'marker-start' => [], 'mask' => [], 'opacity' => [], 'requiredfeatures' => [], 'stroke' => [], 'stroke-dasharray' => [], 'stroke-dashoffset' => [], 'stroke-linecap' => [], 'stroke-linejoin' => [], 'stroke-miterlimit' => [], 'stroke-opacity' => [], 'stroke-width' => [], 'style' => [], 'systemlanguage' => [], 'transform' => []
                ],
                'pattern' => [
                    'class' => [], 'height' => [], 'id' => [], 'patterncontentunits' => [], 'patterntransform' => [], 'patternunits' => [], 'requiredfeatures' => [], 'style' => [], 'systemlanguage' => [], 'viewbox' => [], 'width' => [], 'x' => [], 'xlink:href' => [], 'y' => []
                ],
                'polygon' => [
                    'class' => [], 'clip-path' => [], 'clip-rule' => [], 'id' => [], 'fill' => [], 'fill-opacity' => [], 'fill-rule' => [], 'filter' => [], 'id' => [], 'class' => [], 'marker-end' => [], 'marker-mid' => [], 'marker-start' => [], 'mask' => [], 'opacity' => [], 'points' => [], 'requiredfeatures' => [], 'stroke' => [], 'stroke-dasharray' => [], 'stroke-dashoffset' => [], 'stroke-linecap' => [], 'stroke-linejoin' => [], 'stroke-miterlimit' => [], 'stroke-opacity' => [], 'stroke-width' => [], 'style' => [], 'systemlanguage' => [], 'transform' => []
                ],
                'polyline' => [
                    'class' => [], 'clip-path' => [], 'clip-rule' => [], 'id' => [], 'fill' => [], 'fill-opacity' => [], 'fill-rule' => [], 'filter' => [], 'marker-end' => [], 'marker-mid' => [], 'marker-start' => [], 'mask' => [], 'opacity' => [], 'points' => [], 'requiredfeatures' => [], 'stroke' => [], 'stroke-dasharray' => [], 'stroke-dashoffset' => [], 'stroke-linecap' => [], 'stroke-linejoin' => [], 'stroke-miterlimit' => [], 'stroke-opacity' => [], 'stroke-width' => [], 'style' => [], 'systemlanguage' => [], 'transform' => []
                ],
                'radialgradient' => [
                    'class' => [], 'cx' => [], 'cy' => [], 'fx' => [], 'fy' => [], 'gradienttransform' => [], 'gradientunits' => [], 'id' => [], 'r' => [], 'requiredfeatures' => [], 'spreadmethod' => [], 'systemlanguage' => [], 'xlink:href' => []
                ],
                'rect' => [
                    'class' => [], 'clip-path' => [], 'clip-rule' => [], 'fill' => [], 'fill-opacity' => [], 'fill-rule' => [], 'filter' => [], 'height' => [], 'id' => [], 'mask' => [], 'opacity' => [], 'requiredfeatures' => [], 'rx' => [], 'ry' => [], 'stroke' => [], 'stroke-dasharray' => [], 'stroke-dashoffset' => [], 'stroke-linecap' => [], 'stroke-linejoin' => [], 'stroke-miterlimit' => [], 'stroke-opacity' => [], 'stroke-width' => [], 'style' => [], 'systemlanguage' => [], 'transform' => [], 'width' => [], 'x' => [], 'y' => []
                ],
                'stop' => [
                    'class' => [], 'id' => [], 'offset' => [], 'requiredfeatures' => [], 'stop-color' => [], 'stop-opacity' => [], 'style' => [], 'systemlanguage' => []
                ],
                'svg' => [
                    'class' => [], 'clip-path' => [], 'clip-rule' => [], 'filter' => [], 'id' => [], 'height' => [], 'mask' => [], 'preserveaspectratio' => [], 'requiredfeatures' => [], 'style' => [], 'systemlanguage' => [], 'viewbox' => [], 'width' => [], 'x' => [], 'xmlns' => [], 'xmlns:se' => [], 'xmlns:xlink' => [], 'y' => []
                ],
                'switch' => [
                    'class' => [], 'id' => [], 'requiredfeatures' => [], 'systemlanguage' => []
                ],
                'symbol' => [
                    'class' => [], 'fill' => [], 'fill-opacity' => [], 'fill-rule' => [], 'filter' => [], 'font-family' => [], 'font-size' => [], 'font-style' => [], 'font-weight' => [], 'id' => [], 'opacity' => [], 'preserveaspectratio' => [], 'requiredfeatures' => [], 'stroke' => [], 'stroke-dasharray' => [], 'stroke-dashoffset' => [], 'stroke-linecap' => [], 'stroke-linejoin' => [], 'stroke-miterlimit' => [], 'stroke-opacity' => [], 'stroke-width' => [], 'style' => [], 'systemlanguage' => [], 'transform' => [], 'viewbox' => []
                ],
                'text' => [
                    'class' => [], 'clip-path' => [], 'clip-rule' => [], 'fill' => [], 'fill-opacity' => [], 'fill-rule' => [], 'filter' => [], 'font-family' => [], 'font-size' => [], 'font-style' => [], 'font-weight' => [], 'id' => [], 'mask' => [], 'opacity' => [], 'requiredfeatures' => [], 'stroke' => [], 'stroke-dasharray' => [], 'stroke-dashoffset' => [], 'stroke-linecap' => [], 'stroke-linejoin' => [], 'stroke-miterlimit' => [], 'stroke-opacity' => [], 'stroke-width' => [], 'style' => [], 'systemlanguage' => [], 'text-anchor' => [], 'transform' => [], 'x' => [], 'xml:space' => [], 'y' => []
                ],
                'textpath' => [
                    'class' => [], 'id' => [], 'method' => [], 'requiredfeatures' => [], 'spacing' => [], 'startoffset' => [], 'style' => [], 'systemlanguage' => [], 'transform' => [], 'xlink:href' => []
                ],
                'title' => [],
                'tspan' => [
                    'class' => [], 'clip-path' => [], 'clip-rule' => [], 'dx' => [], 'dy' => [], 'fill' => [], 'fill-opacity' => [], 'fill-rule' => [], 'filter' => [], 'font-family' => [], 'font-size' => [], 'font-style' => [], 'font-weight' => [], 'id' => [], 'mask' => [], 'opacity' => [], 'requiredfeatures' => [], 'rotate' => [], 'stroke' => [], 'stroke-dasharray' => [], 'stroke-dashoffset' => [], 'stroke-linecap' => [], 'stroke-linejoin' => [], 'stroke-miterlimit' => [], 'stroke-opacity' => [], 'stroke-width' => [], 'style' => [], 'systemlanguage' => [], 'text-anchor' => [], 'textlength' => [], 'transform' => [], 'x' => [], 'xml:space' => [], 'y' => []
                ],
                'use' => [
                    'class' => [], 'clip-path' => [], 'clip-rule' => [], 'fill' => [], 'fill-opacity' => [], 'fill-rule' => [], 'filter' => [], 'height' => [], 'id' => [], 'mask' => [], 'stroke' => [], 'stroke-dasharray' => [], 'stroke-dashoffset' => [], 'stroke-linecap' => [], 'stroke-linejoin' => [], 'stroke-miterlimit' => [], 'stroke-opacity' => [], 'stroke-width' => [], 'style' => [], 'transform' => [], 'width' => [], 'x' => [], 'xlink:href' => [], 'y' => []
                ]
            ];
            $allowed_html = array_merge($allowed_html, $svg_tags);

            if(isset($input['svg'])) {
                $sanitized['svg'] = wp_kses($input['svg'], $allowed_html);
            }
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
