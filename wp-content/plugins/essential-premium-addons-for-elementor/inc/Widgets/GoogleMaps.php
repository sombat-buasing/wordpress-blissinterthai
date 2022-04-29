<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class GoogleMaps extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'googlemaps' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/googlemaps.php";
	}
}