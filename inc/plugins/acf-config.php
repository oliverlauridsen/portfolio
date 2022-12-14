<?php
global $acf_settings;

/**
 *  Define the acf theme settings
 */
$acf_settings = [
    'hide_acf_in_backend' => false,
    'options_page' => [
        'page_title' => __('Theme General Settings', 'html24'),
        'menu_title' => __('Theme Settings', 'html24'),
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ],
    'options_sub_pages' => [
        [
            'page_title' => __('Theme Header Settings', 'html24'),
            'menu_title' => __('Header', 'html24'),
            'parent_slug' => 'theme-general-settings',
        ],
        [
            'page_title' => __('Theme Footer Settings', 'html24'),
            'menu_title' => __('Footer', 'html24'),
            'parent_slug' => 'theme-general-settings',
        ]
    ],
    'theme_acf_path' => '/inc/plugins/advanced-custom-fields-pro/',
];

/**
 *  Define the acf theme path
 */
define('THEME_ACF_PATH', $acf_settings['theme_acf_path']);

/**
 * Customize ACF path
 */
// add_filter('acf/settings/path', 'my_acf_settings_path');
// function my_acf_settings_path( $path ) {
//     $path = get_stylesheet_directory() . THEME_ACF_PATH;
//     return $path;
// }

/**
 * Customize ACF dir
 */
// add_filter('acf/settings/url', 'my_acf_settings_dir');
// function my_acf_settings_dir( $dir ) {
//     $dir = get_stylesheet_directory_uri() . THEME_ACF_PATH;
//     return $dir;
// }

/**
 *  Create the options pages
 */
add_action('init', function() {
    if(function_exists('acf_add_options_page')) {
        global $acf_settings;

        // Check if an options page exists in the acf settings array
        if(array_key_exists('options_page', $acf_settings) && empty($acf_settings['options_page']) == false) {
            // Create the options page
            acf_add_options_page($acf_settings['options_page']);
        }

        if(function_exists('acf_add_options_sub_page')) {
            // Check if any options sub pages exists in the acf settings array
            if(array_key_exists('options_sub_pages', $acf_settings) && empty($acf_settings['options_sub_pages']) == false) {
                // Loop through each of them
                foreach($acf_settings['options_sub_pages'] as $options_page) {
                    // Create the options sub page
                    acf_add_options_sub_page($options_page);
                }
            }
        }
    }
}, 1);

/**
 *  Hide acf in the backend
 */
if(array_key_exists('hide_acf_in_backend', $acf_settings) && $acf_settings['hide_acf_in_backend'] == true) {
    add_filter('acf/settings/show_admin', '__return_false');
}
