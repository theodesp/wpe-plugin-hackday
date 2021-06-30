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

if ( is_admin() ) {
    include_once plugin_dir_path( __FILE__ ) . 'admin/admin-menu.php';
}

function wpe_plugin_hackday_display_settings_page() {
}