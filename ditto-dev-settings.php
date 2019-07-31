<?php

if ( is_admin() ){
	add_action('admin_enqueue_scripts', 'ditto_plugin_scripts');
}

function ditto_plugin_scripts($hook) {

	$current_screen = get_current_screen();

	if ( strpos($current_screen->base, 'ditto-dev') === false) {
	    return;
	} else {
	    wp_enqueue_style('materialize_css', plugins_url('inc/materialize-v1.0.0/css/materialize.min.css',__FILE__ ));
	    wp_enqueue_script('materialize_js', plugins_url('inc/materialize-v1.0.0/js/materialize.min.js',__FILE__ ));
    }
}


// create custom plugin settings menu
if ( is_admin() && !get_option('ditto_hide_me_switch') ){
	add_action('admin_menu', 'ditto_plugin_create_menu');
}

function ditto_plugin_create_menu() {
	global $ditto_settings;
	//create new top-level menu
	add_menu_page($ditto_settings['wp_title_page'], $ditto_settings['wp_menu_title'], 'administrator', __FILE__, 'ditto_settings_page' , $ditto_settings['wp_menu_icon'] );
	add_submenu_page( __FILE__, 'Google Analytics', 'Analytics', 'manage_options', __FILE__.'analytics', 'ditto_analytics_page');
	//call register settings function
	add_action( 'admin_init', 'register_ditto_plugin_settings' );
}

function register_ditto_plugin_settings() {
	//register our settings
	register_setting( 'ditto-settings-group', 'ditto_google_maps_switch' );
	register_setting( 'ditto-settings-group', 'ditto_google_maps_api_key' );
	register_setting( 'ditto-settings-group', 'ditto_owl_switch' );
	register_setting( 'ditto-settings-group', 'ditto_slick_switch' );
	register_setting( 'ditto-settings-group', 'ditto_gutenberg_switch' );
	register_setting( 'ditto-settings-group', 'ditto_custom_css_switch' );
	register_setting( 'ditto-settings-group', 'ditto_custom_js_switch' );
	register_setting( 'ditto-settings-group', 'ditto_materialize_switch' );
	register_setting( 'ditto-settings-group', 'ditto_vimeo_switch' );
	register_setting( 'ditto-settings-group', 'ditto_list_switch' );
	register_setting( 'ditto-settings-group', 'ditto_login_image_src' );
	register_setting( 'ditto-settings-group', 'ditto_hide_me_switch' );
}

function ditto_load_scripts_admin() {
    // WordPress library
    wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'ditto_load_scripts_admin' );
