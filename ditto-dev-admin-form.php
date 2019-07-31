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
	add_menu_page('Ditto Plugin Settings', $ditto_settings['wp_menu_title'], 'administrator', __FILE__, 'ditto_settings_page' , $ditto_settings['wp_menu_icon'] );

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

function ditto_image_uploader( $name, $width, $height ) {

    $default_image = plugins_url('images/login_default.svg', __FILE__);

    if ( get_option('ditto_login_image_src') ) {
        $src = get_option('ditto_login_image_src');
        $value = get_option('ditto_login_image_src');
    } else {
        $src = $default_image;
        $value = '';
    }

    $text = __( 'Upload', RSSFI_TEXT );

    // Print HTML field
    echo '
        <div class="upload" style="margin-top: 30px;">
            <img data-src="' . $default_image . '" src="' . $src . '" width="' . $width . 'px" height="' . $height . 'px" />
            <div>
                <input type="hidden" name="ditto_login_image_src" value="' . $value . '" />
                <button type="submit" class="upload_image_button btn waves-effect waves-light">' . $text . '</button>
                <button type="submit" class="remove_image_button btn waves-effect waves-light">&times;</button>
            </div>
            <label style="display: block; margin-top: 10px;">Login Image</label>
        </div>
    ';
}

function ditto_load_scripts_admin() {
    // WordPress library
    wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'ditto_load_scripts_admin' );

function ditto_settings_page() {
?>
<?php global $ditto_settings; ?>
<div class="ditto-admin-wrap">

	<div class="admin-header" style="display: flex;">
		<img src="<?php echo plugins_url('images/logo.svg',__FILE__ ) ?>" width="100px">
		<h1 style="margin-bottom: 50px; font-size: 36px; color: #46a699; margin-left: 20px;"><?php echo $ditto_settings['admin_title']; ?></h1>
	</div>

	<form method="post" action="options.php">

	    <?php settings_fields( 'ditto-settings-group' ); ?>
	    <?php do_settings_sections( 'ditto-settings-group' ); ?>
	    <?php $checked_gm = ''; ?>
	    <?php if (get_option('ditto_google_maps_switch')) { $checked_gm = 'checked'; } ?>
	    <?php $checked_owl = ''; ?>
	    <?php if (get_option('ditto_owl_switch')) { $checked_owl = 'checked'; } ?>
	    <?php $checked_slick = ''; ?>
	    <?php if (get_option('ditto_slick_switch')) { $checked_slick = 'checked'; } ?>
	    <?php $checked_css = ''; ?>
	    <?php if (get_option('ditto_custom_css_switch')) { $checked_css = 'checked'; } ?>
	    <?php $checked_js = ''; ?>
	    <?php if (get_option('ditto_custom_js_switch')) { $checked_js = 'checked'; } ?>
	    <?php $checked_gutenberg = ''; ?>
	    <?php if (get_option('ditto_gutenberg_switch')) { $checked_gutenberg = 'checked'; } ?>
	    <?php $checked_materialize = ''; ?>
	    <?php if (get_option('ditto_materialize_switch')) { $checked_materialize = 'checked'; } ?>
	    <?php $checked_vimeo = ''; ?>
	    <?php if (get_option('ditto_vimeo_switch')) { $checked_vimeo = 'checked'; } ?>
	    <?php $checked_list = ''; ?>
	    <?php if (get_option('ditto_list_switch')) { $checked_list = 'checked'; } ?>
	    <?php $checked_hide_me = ''; ?>
	    <?php if (get_option('ditto_hide_me_switch')) { $checked_hide_me = 'checked'; } ?>

	    <div class="api-options" style="display: flex;">
	    	<div class="vimeo-switch" style="width: 20%">
	    		<label>Enable Vimeo API</label>
	    		<div class="switch" style="margin-top: 10px;">
					<label>
						Off
						<input type="checkbox" name="ditto_vimeo_switch" <?php echo $checked_vimeo; ?>>
						<span class="lever"></span>
						On
					</label>
				</div>
	    	</div>
	    	<div class="gm-switch" style="width: 20%">
	    		<label>Enable Google Maps API</label>
	    		<div class="switch" style="margin-top: 10px;">
					<label>
						Off
						<input type="checkbox" name="ditto_google_maps_switch" <?php echo $checked_gm; ?>>
						<span class="lever"></span>
						On
					</label>
				</div>
	    	</div>
	    	<div class="gm-api-key input-field" style="width: 60%">
	    		<label>Google Maps API Key</label>
	    		<input type="text" name="ditto_google_maps_api_key" value="<?php echo esc_attr( get_option('ditto_google_maps_api_key') ); ?>" />
	    		<span class="helper-text">ditto Dev Key: AIzaSyBB9ZwnBWmSvxcLLeyz-EEmhG9DBZHP004</span>
	    	</div>
	    </div>

	    <div class="sliders-options" style="display: flex; margin-top: 10px;">
	    	<div class="owl-switch" style="width: 20%">
	    		<label>Owl Carousel</label>
	    		<div class="switch" style="margin-top: 10px;">
					<label>
						Off
						<input type="checkbox" name="ditto_owl_switch" <?php echo $checked_owl; ?>>
						<span class="lever"></span>
						On
					</label>
					<span class="helper-text" style="display: block; margin-top: 10px">
						<a href="https://owlcarousel2.github.io/OwlCarousel2/" target="_BLANK">Webpage</a>
					</span>
				</div>
	    	</div>
	    	<div class="owl-switch" style="width: 20%">
	    		<label>Slick Slider</label>
	    		<div class="switch" style="margin-top: 10px;">
					<label>
						Off
						<input type="checkbox" name="ditto_slick_switch" <?php echo $checked_slick; ?>>
						<span class="lever"></span>
						On
					</label>
					<span class="helper-text" style="display: block; margin-top: 10px">
						<a href="https://kenwheeler.github.io/slick/" target="_BLANK">Webpage</a>
					</span>
				</div>
	    	</div>
	    	<div class="materialize-switch" style="width: 20%">
	    		<label>Materialize</label>
	    		<div class="switch" style="margin-top: 10px;">
					<label>
						Off
						<input type="checkbox" name="ditto_materialize_switch" <?php echo $checked_materialize; ?>>
						<span class="lever"></span>
						On
					</label>
				</div>
				<span class="helper-text" style="display: block; margin-top: 10px">
					<a href="https://materializecss.com/" target="_BLANK">Webpage</a>
				</span>
	    	</div>
	    	<div class="materialize-switch" style="width: 20%">
	    		<label>List JS</label>
	    		<div class="switch" style="margin-top: 10px;">
					<label>
						Off
						<input type="checkbox" name="ditto_list_switch" <?php echo $checked_list; ?>>
						<span class="lever"></span>
						On
					</label>
				</div>
				<span class="helper-text" style="display: block; margin-top: 10px">
					<a href="https://listjs.com/" target="_BLANK">Webpage</a>
				</span>
	    	</div>
	    </div>

	    <div class="custom-css-js-options" style="display: flex; margin-top: 30px;">
	    	<div class="custom-css-switch" style="width: 20%">
	    		<label>Include Custom CSS</label>
	    		<div class="switch" style="margin-top: 10px;">
					<label>
						Off
						<input type="checkbox" name="ditto_custom_css_switch" <?php echo $checked_css; ?>>
						<span class="lever"></span>
						On
					</label>
				</div>
	    	</div>
	    	<div class="custom-js-switch" style="width: 20%">
	    		<label>Include Custom JS</label>
	    		<div class="switch" style="margin-top: 10px;">
					<label>
						Off
						<input type="checkbox" name="ditto_custom_js_switch" <?php echo $checked_js; ?>>
						<span class="lever"></span>
						On
					</label>
				</div>
	    	</div>
	    </div>

	    <div class="gutenberg-options" style="display: flex; margin-top: 40px;">
	    	<div class="gutenberg-switch" style="width: 20%">
	    		<label>Disable Gutenberg Editor</label>
	    		<div class="switch" style="margin-top: 10px;">
					<label>
						Off
						<input type="checkbox" name="ditto_gutenberg_switch" <?php echo $checked_gutenberg; ?>>
						<span class="lever"></span>
						On
					</label>
				</div>
	    	</div>
	    	<div class="gutenberg-switch" style="width: 20%">
	    		<label>Hide ditto Plugin</label>
	    		<div class="switch" style="margin-top: 10px;">
					<label>
						Off
						<input type="checkbox" name="ditto_hide_me_switch" <?php echo $checked_hide_me; ?>>
						<span class="lever"></span>
						On
					</label>
				</div>
	    	</div>
	    </div>

	    <?php ditto_image_uploader( 'custom_image', $width = 115, $height = 115 ); ?>

	    <button class="btn waves-effect waves-light" type="submit" name="submit" id="submit" style="margin-top: 40px;">
	    	Save Changes
		</button>

	</form>

	<div class="chip-bar" style="margin-top: 30px;">
		<div class="chip">
			<img src="<?php echo plugins_url('images/pipelon_avatar.jpeg',__FILE__ ) ?>" alt="Contact Person">
			From Pipelon's Github with <a href="https://github.com/Pipeloncho/ditto-dev" target="_BLANK">love</a>.
		</div>
		<div class="chip">
			Ditto Plugin V1.1
		</div>
	</div>

</div>

<script type="text/javascript">
	// The "Upload" button
	$('.upload_image_button').click(function() {
	    var send_attachment_bkp = wp.media.editor.send.attachment;
	    var button = $(this);
	    wp.media.editor.send.attachment = function(props, attachment) {
	        $(button).parent().prev().attr('src', attachment.url);
	        $(button).prev().val(attachment.url);
	        wp.media.editor.send.attachment = send_attachment_bkp;
	    }
	    wp.media.editor.open(button);
	    return false;
	});

	// The "Remove" button (remove the value from input type='hidden')
	$('.remove_image_button').click(function() {
	    var answer = confirm('Are you sure?');
	    if (answer == true) {
	        var src = $(this).parent().prev().attr('data-src');
	        $(this).parent().prev().attr('src', src);
	        $(this).prev().prev().val('');
	    }
	    return false;
	});
</script>
<?php } 