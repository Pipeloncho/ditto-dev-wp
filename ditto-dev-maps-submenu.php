<?php
function ditto_maps_page() { ?>
	<div class="ditto-maps-wrap">
		<div class="admin-header" style="display: flex; margin-top: 40px; margin-bottom: 50px;">
			<h1 style="margin-top: 0px; margin-bottom: 0px; font-size: 36px; color: #46a699; align-self: center;">
				Google Maps Settings
			</h1>
		</div>

		<form method="post" action="options.php">

		    <?php settings_fields( 'ditto-settings-maps-group' ); ?>
		    <?php do_settings_sections( 'ditto-settings-maps-group' ); ?>
		    <?php $checked_gm = ''; ?>
	    	<?php if (get_option('ditto_google_maps_switch')) { $checked_gm = 'checked'; } ?>
			<div class="api-options" style="display: flex;">
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
		    	<div class="gm-api-key input-field" style="width: 80%">
		    		<label>Google Maps API Key</label>
		    		<input type="text" name="ditto_google_maps_api_key" value="<?php echo esc_attr( get_option('ditto_google_maps_api_key') ); ?>" />
		    		<span class="helper-text">Dev Key: AIzaSyBB9ZwnBWmSvxcLLeyz-EEmhG9DBZHP004</span>
		    	</div>
		    </div>

		    <div class="maps-styles input-field" style="margin-top: 30px; display: flex;">
		    	<textarea id="textarea_snazzy_maps" class="materialize-textarea" name="ditto_google_maps_snazzy_maps" style="width: 50%;"><?php echo esc_attr( get_option('ditto_google_maps_snazzy_maps') ); ?></textarea>
		    	<label for="textarea_snazzy_maps">Snazzy Maps Json</label>
		    </div>

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
		<!-- <pre> -->
			<?php //print_r(get_plugin_data(plugins_url('ditto-dev.php', __FILE__), true, true)) ?>
		<!-- </pre> -->
		<?php //echo plugins_url('ditto-dev.php', __FILE__) ?>
	</div>  
<?php
}
?>