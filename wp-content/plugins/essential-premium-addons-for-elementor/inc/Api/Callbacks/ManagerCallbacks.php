<?php
/**
 * @package  EpaElementor
 */

namespace Epa\Api\Callbacks;

use Epa\Base\BaseController;



class ManagerCallbacks extends BaseController {

	public function checkboxSanitize( $input ) {
		$output = array();
		foreach ( $this->shortcodes as $key => $value ) {
			//$output[ $key ] = isset( $input[ $key ] ) ? true : false;
			$output[ $key ] = isset( $input[ $key ] ) ? true : false;
		}

		return $output;
	}
	public function mapsapusanitize( $input )
	{
		return $input;
	}

	public function adminSectionManager() {
		echo "";
		//echo 'Manage the Addons of this Plugin by activating the checkboxes from the following list.';
	}
	public function apiSectionManager() {
		echo "";
		//echo 'Manage the Addons of this Plugin by activating the checkboxes from the following list.';
	}

	public function checkboxField( $args ) {
		$name        = $args['label_for'];
		$classes     = $args['class'];
		$option_name = $args['option_name'];
		$checkbox    = get_option( $option_name );

		$checked     = isset( $checkbox[ $name ] ) ? ( $checkbox[ $name ] ? true : false ) : false;

		echo '<div class="tg-list-item"><input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="1" class="checkbox tgl tgl-ios" ' . ( $checked ? 'checked' : '' ) . '>
		
		<label class="tgl-btn" for="' . $name . '"><div></div></label></div>';
	}
	public function epaApiManager() {
		$value = esc_attr(get_option('epa_api_oname')) != '' ? esc_attr(get_option('epa_api_oname')) : '';
		echo '<div class="epa_gmaps_api_input_field">
			 	 <input type="text" id="input1" class="regular-class"  name="epa_api_oname" placeholder="Enter your Google Map Api Key Here!" value="'.$value.'">
			  <label for="input1">Enter Maps API</label>
			  <p>Example Maps API: <span class="epa_gmaps_api_exam">AIzaSyCkdQ9GqA6Abot_l5W6LSHsvhlmqI7aleU</span><br/> Copy and paste this in avobe field. Or Get your API Key from <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key"><span class="epa_gmaps_noti_link">here</span></a> </p>
			</div>';
	}
}