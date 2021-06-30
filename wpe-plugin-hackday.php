<?php
/**
 * Plugin Name: WPE Hack plugin
 * Plugin URI:  https://www.wpengine.com
 * Description: Hacking plugin
 * Version:     1.0.0
 * Author:      WP Engine
 *
 */

namespace wpengine\hack_plugin;

/**
 * Definitions
 */
define('HACKDAY_VERSION', '1.0.0');
define('HACKDAY_FILE', __FILE__);
define('WPA_PLUGIN_DIR', __DIR__ . '/inc/');
define('WPA_PLUGIN_URL', plugin_dir_url(__FILE__));

define(__NAMESPACE__ . '\SLUG', 'wpengine\hack_plugin');
define(__NAMESPACE__ . '\DB_VERSION', '1.0.0');
define(__NAMESPACE__ . '\PATH', plugin_dir_path(__FILE__));
define(__NAMESPACE__ . '\URL', plugin_dir_url(__FILE__));

spl_autoload_register(
    function ($class) {
        $len = strlen(__NAMESPACE__);
        if (strncmp(__NAMESPACE__, $class, $len) !== 0) {
            return;
        }
        // Remove the namespace prefix.
        // Replace namespace separators with directory separators in the class name.
        // Replace underscores with dashes in the class name.
        // Append with .php extension.
        $class_file_name = str_replace(['\\', '_'], ['/', '-'], strtolower(substr($class, $len + 1))) . '.php';
        // Add `class-` to file name so we meet WPCS standards.
        $class_file_name = preg_replace('/([\w-]+)\.php/', 'class-$1.php', $class_file_name);
        $file = WPA_PLUGIN_DIR . $class_file_name;
        // If the file exists, require it.
        if (realpath($file) === $file && file_exists($file)) {
            require $file;
        }
    }
);

function wpe_hack_plugin_sublevel_menu()
{
    add_submenu_page(
        'options-general.php',
        esc_html__('Hack Plugin Settings', 'wpe-plugin-hackday'),
        esc_html__('Hack Plugin', 'wpe-plugin-hackday'),
        'manage_options',
        'wpe-plugin-hackday',
        __NAMESPACE__ . '\wpa_basic_info_content'
    );
}

add_action('admin_menu', __NAMESPACE__ . '\wpe_hack_plugin_sublevel_menu', 2);

function wpa_basic_info_content()
{
    include_once WPA_PLUGIN_DIR . 'assets/views/admin-view.php';
}

/**
 * Set up our hooks for the plugin.
 */
function init()
{
    if (is_admin()) {
        // Load our default admin class.
        Admin::init();
    }
}

add_action(
    'plugins_loaded',
    __NAMESPACE__ . '\init'
);