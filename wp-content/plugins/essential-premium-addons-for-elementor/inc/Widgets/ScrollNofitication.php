<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ScrollNofitication extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'scrollnotification' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/scrollnotification.php";
	}
}