<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Tabs extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'tabs' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/tabs.php";
	}
}