<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Videoplayer extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'videoplayer' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/videoplayer.php";
	}
}