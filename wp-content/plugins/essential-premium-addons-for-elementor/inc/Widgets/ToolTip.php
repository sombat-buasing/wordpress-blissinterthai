<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ToolTip extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'tooltip' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/tooltip.php";
	}
}