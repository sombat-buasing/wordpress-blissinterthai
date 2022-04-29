<?php
/**
 * @package  EpaElementor
 */
namespace Epa\Api\Callbacks;

use Epa\Base\BaseController;

class AdminCallbacks extends BaseController
{
	public function adminDashboard()
	{
		return require_once( "$this->plugin_path/templates/admin.php" );
	}
	public function epaApi()
	{
		return require_once( "$this->plugin_path/templates/api.php" );
	}
}