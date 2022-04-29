<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class LogoCarousel extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'logocarousel' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/logocarousel.php";
	}
}