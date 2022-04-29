<?php
/**
 * @package  EpaElementor
 */
namespace Epa\Pages;

use Epa\Api\Callbacks\ManagerCallbacks;
use Epa\Api\SettingsApi;
use Epa\Base\BaseController;
use Epa\Api\Callbacks\AdminCallbacks;

class AdminPages extends BaseController {

	public $callbacks;
	public $callbacks_mngr;

	public $pages = array();

	public $subpages = array();

	public $settings = array();
	public $sections = array();

	public $fields = array();

	public function register() {
		$this->settings       = new SettingsApi();
		$this->callbacks      = new AdminCallbacks();
		$this->callbacks_mngr = new ManagerCallbacks();
		$this->setPages();
		$this->setSubpages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();
		$this->settings->addPages( $this->pages )->withSubPage( 'ADDON SETTINGS' )->addSubPages( $this->subpages )->register();
	}

	public function setPages() {
		$this->pages = array(
			array(
				'page_title' => 'Essential Premium Addons for Elementor',
				'menu_title' => 'EPE ADDONS ',
				'capability' => 'manage_options',
				'menu_slug'  => 'wfe_elementor',
				'callback'   => array( $this->callbacks, 'adminDashboard' ),
				'icon_url'           => 'dashicons-sos',
				'position'   => 110,
			),
		);
	}

	public function setSubpages() {
		$this->subpages = array(
			array(
				'parent_slug' => 'wfe_elementor',
				'page_title'  => 'Essential Premium Addons',
				'menu_title'  => 'API SETTINGS',
				'capability'  => 'manage_options',
				'menu_slug'   => 'epa_api',
				'callback'    => array( $this->callbacks, 'epaApi' ),
			),
		);
	}

	// Admin Custom Fields

	public function setSettings() {
		$args = array(
			array(
				'option_group' => 'wfe_options_group',
				'option_name'  => 'wfe_elementor',
				'callback'     => array( $this->callbacks_mngr, 'checkboxSanitize' ),
			),
			array(
				'option_group' => 'epa_api_ogroup',
				'option_name'  => 'epa_api_oname',
				'callback'     => array( $this->callbacks_mngr, 'mapsapusanitize' ),
			),
		);

		$this->settings->setSettings( $args );
	}

	public function setSections() {
		$args = array(
			array(
				'id'       => 'wfe_admin_index',
				'title'    => '',
				'callback' => array( $this->callbacks_mngr, 'adminSectionManager' ),
				'page'     => 'wfe_elementor',
			),
			array(
				'id'       => 'epa_api_index',
				'title'    => '',
				'callback' => array( $this->callbacks_mngr, 'apiSectionManager' ),
				'page'     => 'epa_api_oname',
			),
		);

		$this->settings->setSections( $args );
	}

	public function setFields() {

		$args = array(
			array(
				'id' => 'epa_api_oname',
				'title' => 'Google Maps API',
				'callback' => array( $this->callbacks_mngr, 'epaApiManager' ),
				'page' => 'epa_api_oname',
				'section' => 'epa_api_index',
				'args' => array(
					'label_for' => 'epa_api_oname',
					'class' => 'exampleclass'
				)
			)
		);
		foreach ( $this->shortcodes as $key => $value ) {
			//echo $key; exit();
			$args[] = array(
				'id'       => $key,
				'title'    => $value . '<br> <p style="font-size: 9px; color: #999; margin: 0; padding: 0;">' . $value . ' widgets for elementor</p>',
				'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
				'page'     => 'wfe_elementor',
				'section'  => 'wfe_admin_index',
				'args'     => array(
					'option_name' => 'wfe_elementor',
					'label_for'   => $key,
					'class'       => 'ui-toggle',
				),
			);
		}
		$this->settings->setFields( $args );
	}
}