<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class OnePageNavigation extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'onepagenavigation' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/onepagenavigation.php";
	}
}