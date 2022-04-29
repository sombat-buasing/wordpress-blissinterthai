<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class TimeLine extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'timeline' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/timeline.php";
	}
}