<?php
namespace Epa\Widgets;

use Epa\Base\BaseController;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ImageAccordion extends BaseController {
	public function widgets_register(){
		if ( ! $this->activated( 'imageaccordion' ) ) {
			return;
		}
		require_once $this->plugin_path . "widgets/imageaccordion.php";
	}
}