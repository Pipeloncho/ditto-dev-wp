<?php

/*** +Disable Gutenberg ***/
if (get_option('ditto_gutenberg_switch')) {
	add_filter('use_block_editor_for_post', '__return_false', 10);
	add_filter('use_block_editor_for_post_type', '__return_false', 10);	
}
/*** -Disable Gutenberg ***/

/*** +ACF Maps API Key ***/
if (get_option('ditto_google_maps_switch') && get_option('ditto_google_maps_api_key') != '') {
	function my_acf_init() {
	    acf_update_setting('google_api_key', get_option('ditto_google_maps_api_key'));
	}
	add_action('acf/init', 'my_acf_init');	
}
/*** -ACF Maps API Key ***/

/*** +ditto Scripts ***/
function ditto_scripts(){
	if (get_option('ditto_google_maps_switch') && get_option('ditto_google_maps_api_key') != '') {
		wp_enqueue_script('Google_Maps_API', 'https://maps.googleapis.com/maps/api/js?key='.get_option('ditto_google_maps_api_key'));
	}
	if (get_option('ditto_vimeo_switch')) {
		wp_enqueue_script('Vimeo_API', 'https://player.vimeo.com/api/player.js');
	}
	if (get_option('ditto_slick_switch')) {
		wp_enqueue_style('slick_css', plugins_url('inc/slick-v1.8.1/css/slick.css',__FILE__ ));
	    wp_enqueue_script('slick_js', plugins_url('inc/slick-v1.8.1/js/slick.min.js',__FILE__ ), array('jquery'), '1.8.1', true);
	}
	if (get_option('ditto_owl_switch')) {
		wp_enqueue_style('owl_css', plugins_url('inc/owl-v2.3.4/css/owl.carousel.scss',__FILE__ ));
	    wp_enqueue_script('owl_js', plugins_url('inc/owl-v2.3.4/js/owl.carousel.js',__FILE__ ), array('jquery'), '2.3.4', true);
	}
	if (get_option('ditto_list_switch')) {
	    wp_enqueue_script('list_js', plugins_url('inc/listjs-v1.5.0/list.min.js',__FILE__ ));
	}
	if (get_option('ditto_materialize_switch')) {
		wp_enqueue_style('public_materialize_css', plugins_url('inc/materialize-v1.0.0/css/materialize.min.css',__FILE__ ));
	    wp_enqueue_script('public_materialize_js', plugins_url('inc/materialize-v1.0.0/js/materialize.min.js',__FILE__ ));
	}
	if (get_option('ditto_custom_css_switch')) {
		wp_enqueue_style('custom_css', plugins_url('inc/custom/css/custom.css',__FILE__ ));
	}
	if (get_option('ditto_custom_js_switch')) {
		wp_enqueue_script('custom_js', plugins_url('inc/custom/js/custom.js',__FILE__ ), array('jquery'), '1.0', true);
	}
}
add_action('wp_enqueue_scripts', 'ditto_scripts');
/*** -ditto Scripts ***/

/*** +Admin Styles ***/
function ditto_admin_styles() { ?>
    <?php if ( get_option('ditto_hide_me_switch') ): ?>
    	<style type="text/css">
    		.plugins-php .wp-list-table tr[data-slug="ditto-dev"] {
    			display: none !important;
    		}
    	</style>	
    <?php endif ?>
<?php }
add_action( 'admin_enqueue_scripts', 'ditto_admin_styles' );
/*** -Admin Styles ***/

/*** +Login Styles ***/
function ditto_login_styles() { ?>
	<?php if (get_option('ditto_login_image_src') != ''): ?>
		<style type="text/css">
	        #login h1 a, .login h1 a {
	            display: none;
	        }
	        #login h1 img {
	        	width: 100%;
	        	max-width: 240px;
	        }
	    </style>
	    <script type="text/javascript">
	    	document.addEventListener("DOMContentLoaded", function(event) { 
				let loginImg = document.createElement("img");
		    	loginImg.src = "<?php echo get_option('ditto_login_image_src') ?>";
		    	loginImg.alt = "Custom login image";
		    	document.querySelector('#login h1').appendChild(loginImg);
			});
	    </script>
	<?php endif ?>
<?php }
add_action( 'login_enqueue_scripts', 'ditto_login_styles' );
/*** -Login Styles ***/

/*** +Hide ACF ***/
if (get_option('ditto_hide_acf')) {
	add_filter('acf/settings/show_admin', '__return_false');
}
/*** -Hide ACF ***/

?>