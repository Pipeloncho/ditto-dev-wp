<?php
/**
 * Plugin Name: Ditto Dev
 * Plugin URI: https://github.com/Pipeloncho/ditto-dev-wp
 * Description: Developer tools.
 * Version: 1.1
 * Author: SMK
 * Author URI: http://smk.com.co
 */
global $ditto_settings;

/**** +Ditto Dev Settings ****/

// WP menu title
$ditto_settings['wp_menu_title'] = "Ditto Settings";
// WP menu icon (20x20 px)
$ditto_settings['wp_menu_icon'] = plugins_url('/images/ditto_icon.png', __FILE__);
// Admin title
$ditto_settings['admin_title'] = "Ditto Dev Options";
// Admin logo
$ditto_settings['admin_logo'] = plugins_url('/images/ditto_default_logo.png', __FILE__);

/**** -Ditto Dev Settings ****/

include_once "ditto-dev-admin-form.php";
include_once "ditto-dev-options.php";

