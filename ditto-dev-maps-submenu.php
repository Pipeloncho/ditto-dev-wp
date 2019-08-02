<?php

/*** +Map Shortcode ***/
function simple_map_shortcode( $atts ) {
   $map = '
   		<div id="'.$atts['map_id'].'" style="height: '.$atts['height'].';"></div>
   		<script type="text/javascript">
		    let GoogleMaps_'.$atts['map_id'].' = {
		        $html: jQuery("html, body"),
		        $map: jQuery('.$atts['map_id'].'),
		        init: function () {
		            if (this.$map.length) {
		                this.initMap();
		            }
		        },
		        initMap: function () {
		            this.map = new google.maps.Map(this.$map[0], {
		                zoom: 16,
		                center: new google.maps.LatLng('.$atts['map_lat'].', '.$atts['map_lng'].'),
		                styles: "",
		                disableDefaultUI: true,
		                scrollwheel: false,
		                zoomControl: false,
		                zoomControlOptions: {
				            position: google.maps.ControlPosition.LEFT_BOTTOM
				        }
		            });
		            this.setMarkers();
		        },
		        setMarkers: function () {
		            let self = this;
		            marker = new google.maps.Marker({
		                position: new google.maps.LatLng('.$atts['map_lat'].', '.$atts['map_lng'].'),
		                map: this.map,
		                id: 0,
		                /*icon: {
		                	url: "",
		                	scaledSize: new google.maps.Size(30, 40)
		                }*/
		            });
		        }
		    };
		    GoogleMaps'.$atts['map_id'].'.init();
   		</script>
   '; 
   return $map;
}

add_shortcode('simple_map', 'simple_map_shortcode');
/*** -Map Shortcode ***/

/*** +Map Form ***/
function ditto_maps_page() { ?>
	<div class="ditto-maps-wrap" style="padding: 0px 30px 0px 10px;">
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
			<div class="api-options row">
		    	<div class="gm-switch col s12 m2">
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
		    	<div class="gm-api-key col s12 m10">
			    	<div class="input-field">
			    		<label>Google Maps API Key</label>
			    		<input type="text" name="ditto_google_maps_api_key" value="<?php echo esc_attr( get_option('ditto_google_maps_api_key') ); ?>" />
			    		<span class="helper-text">Dev Key: AIzaSyBB9ZwnBWmSvxcLLeyz-EEmhG9DBZHP004</span>
			    	</div>
		    	</div>
		    </div>

		    <div class="maps-styles col s12" style="margin-top: 30px;">
		    	<div class="input-field">
			    	<textarea id="textarea_snazzy_maps" class="materialize-textarea" name="ditto_google_maps_snazzy_maps"><?php echo esc_attr( get_option('ditto_google_maps_snazzy_maps') ); ?></textarea>
			    	<label for="textarea_snazzy_maps">Snazzy Maps Json</label>
			    	<span class="helper-text" style="display: block;">
						<a href="https://snazzymaps.com/" target="_BLANK">Webpage</a>
					</span>
			    </div>
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
		<?php //echo do_shortcode('[simple_map map_id="map_test" height="200px" map_lat="300.0000" map_lng="75.70899"]'); ?>

	</div>  
<?php
}
/*** -Map Form ***/

?>