<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Testimonial extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'testimonial' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/testimonial.php";
	}
}