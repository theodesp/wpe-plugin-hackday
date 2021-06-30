<?php
/**
 * The admin version of the class
 *
 * @package  wpengine-hack_plugin
 */

namespace wpengine\hack_plugin;

/**
 * Build the admin class
 */
class Admin {

    /**
     * Register our setting to WP
     *
     * @since  0.1.0
     */
    public static function init() {
        $self = new self();
    }
}