<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class CountDown extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'countdown' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/countdown.php";
	}
}