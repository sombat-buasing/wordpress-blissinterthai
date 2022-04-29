<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Epa_googlemaps extends Widget_Base {

	public function get_name() {
		return 'epa-googlemaps';
	}

	public function get_title() {
		return __( 'Google Maps', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'eicon-google-maps wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc

	protected function _register_controls() {
		/**
		 * Google Map General Settings
		 */
		$this->start_controls_section( 'epa_gmap_maptype_section', [
			'label' => esc_html__( 'Map Type', 'epa_elementor' ),
		] );
		$this->add_control( 'epa_gmaps_type', [
			'label'       => esc_html__( 'Google Map Type', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT,
			'default'     => 'basic',
			'label_block' => false,
			'options'     => [
				'basic'    => esc_html__( 'Basic', 'epa_elementor' ),
				'marker'   => esc_html__( 'Multiple Marker', 'epa_elementor' ),
				'overlay'  => esc_html__( 'Overlay', 'epa_elementor' ),
				'routes'   => esc_html__( 'With Routes', 'epa_elementor' ),
				'panorama' => esc_html__( 'Panorama', 'epa_elementor' ),
			],
		] );



		$this->add_control( 'epa_gmaps_set_center', [
			'label'     => esc_html__( 'Set Location Center', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );
		$this->add_control( 'epa_gmaps_lat', [
			'label'       => esc_html__( 'Latitude', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => false,
			'default'     => esc_html__( '51.515174', 'epa_elementor' ),
		] );
		$this->add_control( 'epa_gmaps_lng', [
			'label'       => esc_html__( 'Longitude', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => false,
			'description' => '',
			'default'     => esc_html__( '-0.092590', 'epa_elementor' ),
		] );

		$this->add_control( 'epa_gmaps_note1', [
				'type' => Controls_Manager::RAW_HTML,
				'raw'  => __( 'Click <a href="https://www.latlong.net/" target="_blank">here</a> to get your location coordinates', 'epa_elementor' ),
			] );
		$this->add_control( 'epa_gmaps_overlay_content', [
			'label'       => esc_html__( 'Overlay Content', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXTAREA,
			'label_block' => true,
			'default'     => esc_html__( 'Add your content here', 'epa_elementor' ),
			'condition'   => [
				'epa_gmaps_type' => 'overlay',
			],
		] );
		$this->end_controls_section();
		/**
		 * Map Settings (With Marker only for Basic)
		 */
		$this->start_controls_section( 'epa_gmaps_marker_settings', [
			'label'     => esc_html__( 'Map Marker', 'epa_elementor' ),
			'condition' => [
				'epa_gmaps_type' => [ 'basic' ],
			],
		] );
		$this->add_control( 'epa_gmaps_basic_marker_title', [
			'label'       => esc_html__( 'Title', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'default'     => esc_html__( 'Google Map Title', 'epa_elementor' ),
		] );
		$this->add_control( 'epa_gmaps_basic_marker_content', [
			'label'       => esc_html__( 'Content', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXTAREA,
			'label_block' => true,
			'default'     => esc_html__( 'Google map content', 'epa_elementor' ),
		] );
		$this->add_control( 'epa_gmaps_basic_marker_icon_enable', [
			'label'        => __( 'Custom Marker Icon', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'no',
			'label_on'     => __( 'Yes', 'epa_elementor' ),
			'label_off'    => __( 'No', 'epa_elementor' ),
			'return_value' => 'yes',
		] );
	/*	$this->add_control(
			'epa_gmaps_icon_type',
			[
				'label' => __( 'Icon Type', 'epa_elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'img' => [
						'title' => __( 'Image', 'epa_elementor' ),
						'icon' => 'fa fa-image',
					],
					'ficon' => [
						'title' => __( 'FontAwesone Icon', 'epa_elementor' ),
						'icon' => 'eicon-info',
					],
				],
				'default' => 'img',
				'condition' => [
					'epa_gmaps_basic_marker_icon_enable' => 'yes',
				],
			]
		);*/
		$this->add_control( 'epa_gmaps_basic_marker_icon', [
			'label'     => esc_html__( 'Marker Icon', 'epa_elementor' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [// 'url' => Utils::get_placeholder_image_src(),
			],
			'condition' => [
				//'epa_gmaps_icon_type' => 'img',
				'epa_gmaps_basic_marker_icon_enable' => 'yes',
			],
		] );
		/*$this->add_control( 'epa_gmaps_ficon', [
			'label'     => esc_html__( 'Icon', 'epa_elementor' ),
			'type'      => Controls_Manager::ICON,
			'default'   => 'fa fa-briefcase',
			'condition' => [
				'epa_gmaps_icon_type' => 'ficon',
			],
		] );*/
		$this->add_control( 'epa_gmaps_basic_marker_icon_width', [
			'label'     => esc_html__( 'Marker Width', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 32,
			],
			'range'     => [
				'px' => [
					'max' => 150,
				],
			],
			'condition' => [
				'epa_gmaps_basic_marker_icon_enable' => 'yes',
			],
		] );
		$this->add_control( 'epa_gmaps_basic_marker_icon_height', [
			'label'     => esc_html__( 'Marker Height', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 32,
			],
			'range'     => [
				'px' => [
					'max' => 150,
				],
			],
			'condition' => [
				'epa_gmaps_basic_marker_icon_enable' => 'yes',
			],
		] );
		$this->end_controls_section();
		/**
		 * Map Settings (With Marker)
		 */
		$this->start_controls_section( 'epa_gmaps_marker_section', [
			'label'     => esc_html__( 'Map Marker', 'epa_elementor' ),
			'condition' => [
				'epa_gmaps_type' => [ 'marker', 'routes' ],
			],
		] );

		$this->add_control( 'epa_gmaps_marker', [
			'type'        => Controls_Manager::REPEATER,
			'seperator'   => 'before',
			'default'     => [
				[ 'epa_gmaps_marker_title' => esc_html__( '#Map Marker', 'epa_elementor' ) ],
			],
			'fields'      => [

				 [
				    'name' => 'epa_gmaps_set_center',
					'label'     => esc_html__( 'Set Location', 'epa_elementor' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'after',
				],

				[
					'name'        => 'epa_gmaps_marker_lat',
					'label'       => esc_html__( 'Latitude', 'epa_elementor' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => esc_html__( '51.515911', 'epa_elementor' ),
				],
				[
					'name'        => 'epa_gmaps_marker_lng',
					'label'       => esc_html__( 'Longitude', 'epa_elementor' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => esc_html__( '-0.122334', 'epa_elementor' ),
				],

				[
				    'name' => 'epa_gmaps_note2',
					'type' => Controls_Manager::RAW_HTML,
					'raw'  => __( 'Click <a href="https://www.latlong.net/" target="_blank">here</a> to get your location coordinates', 'epa_elementor' ),
				],
				[
					'name'        => 'epa_gmaps_marker_title',
					'label'       => esc_html__( 'Title', 'epa_elementor' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'separator' => 'before',
					'default'     => esc_html__( 'Marker Title', 'epa_elementor' ),
				],
				[
					'name'        => 'epa_gmaps_marker_content',
					'label'       => esc_html__( 'Content', 'epa_elementor' ),
					'type'        => Controls_Manager::TEXTAREA,
					'label_block' => true,
					'default'     => esc_html__( 'Marker Content. You can put html here.', 'epa_elementor' ),
				],
				[
					'name'         => 'epa_gmaps_marker_icon_enable',
					'label'        => __( 'Use Custom Icon', 'epa_elementor' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'no',
					'label_on'     => __( 'Yes', 'epa_elementor' ),
					'label_off'    => __( 'No', 'epa_elementor' ),
					'return_value' => 'yes',
				],
				[
					'name'      => 'epa_gmaps_marker_icon',
					'label'     => esc_html__( 'Custom Icon', 'epa_elementor' ),
					'type'      => Controls_Manager::MEDIA,
					'default'   => [// 'url' => Utils::get_placeholder_image_src(),
					],
					'condition' => [
						'epa_gmaps_marker_icon_enable' => 'yes',
					],
				],
				[
					'name'      => 'epa_gmaps_marker_icon_width',
					'label'     => esc_html__( 'Icon Width', 'epa_elementor' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => esc_html__( '32', 'epa_elementor' ),
					'condition' => [
						'epa_gmaps_marker_icon_enable' => 'yes',
					],
				],
				[
					'name'      => 'epa_gmaps_marker_icon_height',
					'label'     => esc_html__( 'Icon Height', 'epa_elementor' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => esc_html__( '32', 'epa_elementor' ),
					'condition' => [
						'epa_gmaps_marker_icon_enable' => 'yes',
					],
				],
			],
			'title_field' => '{{epa_gmaps_marker_title}}',
		] );
		$this->end_controls_section();

		/**
		 * Routes Coordinates Settings (Routes)
		 */
		$this->start_controls_section( 'epa_gmaps_routes_section', [
			'label'     => esc_html__( 'Routes Coordinate Settings', 'epa_elementor' ),
			'condition' => [
				'epa_gmaps_type' => [ 'routes' ],
			],
		] );
		$this->add_control( 'epa_gmaps_routes_origin', [
			'label'     => esc_html__( 'Origin', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'after',
		] );
		$this->add_control( 'epa_gmaps_routes_origin_lat', [
			'label'       => esc_html__( 'Latitude', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => false,
			'default'     => esc_html__( '28.948790', 'epa_elementor' ),
		] );
		$this->add_control( 'epa_gmaps_routes_origin_lng', [
			'label'       => esc_html__( 'Longitude', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => false,
			'default'     => esc_html__( '-81.298843', 'epa_elementor' ),
		] );
		$this->add_control( 'epa_gmaps_routes_dest', [
			'label'     => esc_html__( 'Destination', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'after',
		] );
		$this->add_control( 'epa_gmaps_routes_dest_lat', [
			'label'       => esc_html__( 'Latitude', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => false,
			'default'     => esc_html__( '1.2833808', 'epa_elementor' ),
		] );
		$this->add_control( 'epa_gmaps_routes_dest_lng', [
			'label'       => esc_html__( 'Longitude', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => false,
			'default'     => esc_html__( '103.8585377', 'epa_elementor' ),
		] );
		$this->add_control( 'epa_gmaps_routes_travel_mode', [
			'label'       => esc_html__( 'Travel Mode', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT,
			'default'     => 'walking',
			'label_block' => false,
			'options'     => [
				'walking'   => esc_html__( 'Walking', 'epa_elementor' ),
				'bicycling' => esc_html__( 'Bicycling', 'epa_elementor' ),
				'driving'   => esc_html__( 'Driving', 'epa_elementor' ),
			],
		] );
		$this->end_controls_section();

		$this->start_controls_section( 'epa_map_controls_section', [
			'label' => esc_html__( 'Map Options', 'epa_elementor' ),
		] );
		$this->add_control( 'epa_gmaps_streeview_control', [
			'label'        => esc_html__( 'Street View Option', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'true',
			'label_on'     => __( 'On', 'epa_elementor' ),
			'label_off'    => __( 'Off', 'epa_elementor' ),
			'return_value' => 'true',
		] );
		$this->add_control( 'epa_gmaps_fullscreen', [
			'label'        => esc_html__( 'Fullscreen Option', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'label_on'     => __( 'On', 'epa_elementor' ),
			'label_off'    => __( 'Off', 'epa_elementor' ),
			'return_value' => 'yes',
		] );
		$this->add_control( 'epa_gmaps_type_control', [
			'label'        => esc_html__( 'Map Type Option', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'label_on'     => __( 'On', 'epa_elementor' ),
			'label_off'    => __( 'Off', 'epa_elementor' ),
			'return_value' => 'yes',
		] );
		$this->add_control( 'epa_gmaps_zoom_control', [
			'label'        => esc_html__( 'Zoom Option', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'label_on'     => __( 'On', 'epa_elementor' ),
			'label_off'    => __( 'Off', 'epa_elementor' ),
			'return_value' => 'yes',
		] );
		$this->add_control( 'epa_gmaps_scroll_zoom', [
			'label'        => esc_html__( 'Scroll Wheel Zoom', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'label_on'     => __( 'On', 'epa_elementor' ),
			'label_off'    => __( 'Off', 'epa_elementor' ),
			'return_value' => 'yes',
		] );
		$this->add_control( 'epa_gmaps_zoom_lavel', [
			'label'       => esc_html__( 'Zoom Level', 'epa_elementor' ),
			'type'        => Controls_Manager::NUMBER,
			'label_block' => false,
			'default'     => esc_html__( '12', 'epa_elementor' ),
		] );
		$this->end_controls_section();

		/**
		 * Map Theme Settings
		 */
		$this->start_controls_section( 'epa_gmaps_theme_section', [
			'label'     => esc_html__( 'Map Themes', 'epa_elementor' ),
		] );
		$this->add_control( 'epa_gmap_themes_source', [
			'label'   => __( 'Theme Source', 'epa_elementor' ),
			'type'    => Controls_Manager::CHOOSE,
			'options' => [
				'gstandard'  => [
					'title' => __( 'Google Standard', 'epa_elementor' ),
					'icon'  => 'fa fa-map',
				],
				'snazzymaps' => [
					'title' => __( 'Snazzy Maps', 'epa_elementor' ),
					'icon'  => 'fa fa-map-marker',
				],
				'custom'     => [
					'title' => __( 'Custom', 'epa_elementor' ),
					'icon'  => 'fa fa-edit',
				],
			],
			'default' => 'gstandard',
		] );
		$this->add_control( 'epa_gmaps_gstandards', [
			'label'       => esc_html__( 'Google Themes', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT,
			'default'     => 'standard',
			'options'     => [
				'standard'  => __( 'Standard', 'epa_elementor' ),
				'silver'    => __( 'Silver', 'epa_elementor' ),
				'retro'     => __( 'Retro', 'epa_elementor' ),
				'dark'      => __( 'Dark', 'epa_elementor' ),
				'night'     => __( 'Night', 'epa_elementor' ),
				'aubergine' => __( 'Aubergine', 'epa_elementor' ),
			],
			'description' => sprintf( '<a href="https://mapstyle.withgoogle.com/" target="_blank">%1$s</a> %2$s', __( 'Click here', 'epa_elementor' ), __( 'to generate your own theme and use JSON within Custom style field.', 'epa_elementor' ) ),
			'condition'   => [
				'epa_gmap_themes_source' => 'gstandard',
			],
		] );
		$this->add_control( 'epa_gmaps_snazzymaps', [
			'label'       => esc_html__( 'SnazzyMaps Themes', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT,
			'label_block' => true,
			'default'     => 'colorful',
			'options'     => [
				'default'    => __( 'Default', 'epa_elementor' ),
				'simple'     => __( 'Simple', 'epa_elementor' ),
				'colorful'   => __( 'Colorful', 'epa_elementor' ),
				'complex'    => __( 'Complex', 'epa_elementor' ),
				'dark'       => __( 'Dark', 'epa_elementor' ),
				'greyscale'  => __( 'Greyscale', 'epa_elementor' ),
				'light'      => __( 'Light', 'epa_elementor' ),
				'monochrome' => __( 'Monochrome', 'epa_elementor' ),
				'nolabels'   => __( 'No Labels', 'epa_elementor' ),
				'twotone'    => __( 'Two Tone', 'epa_elementor' ),
			],
			'description' => sprintf( '<a href="https://snazzymaps.com/explore" target="_blank">%1$s</a> %2$s', __( 'Click here', 'epa_elementor' ), __( 'to explore more themes and use JSON within custom style field.', 'epa_elementor' ) ),
			'condition'   => [
				'epa_gmap_themes_source' => 'snazzymaps',
			],
		] );
		$this->add_control( 'epa_gmaps_custom_style', [
			'label'       => __( 'Custom Style', 'epa_elementor' ),
			'description' => sprintf( '<a href="https://mapstyle.withgoogle.com/" target="_blank">%1$s</a> %2$s', __( 'Click here', 'epa_elementor' ), __( 'to get JSON style code to style your map', 'epa_elementor' ) ),
			'type'        => Controls_Manager::TEXTAREA,
			'condition'   => [
				'epa_gmap_themes_source' => 'custom',
			],
		] );
		$this->end_controls_section();
		/**
		 * -------------------------------------------
		 * Tab Style Google Map Style
		 * -------------------------------------------
		 */
		$this->start_controls_section( 'epa_gmaps_style_sections', [
			'label' => esc_html__( 'General Style', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );
		$this->add_responsive_control( 'epa_gmaps_max_width', [
			'label'      => __( 'Max Width', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'size' => 1140,
				'unit' => 'px',
			],
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 1400,
					'step' => 10,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .epa-google-maps' => 'max-width: {{SIZE}}{{UNIT}};',
			],
		] );
		$this->add_responsive_control( 'epa_gmaps_max_height', [
			'label'      => __( 'Max Height', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'size' => 400,
				'unit' => 'px',
			],
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 1400,
					'step' => 10,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .epa-google-maps' => 'height: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'epa_gmaps_wrapper_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-google-maps' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'epa_gmaps_wrapper_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-google-maps' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		/*
		    Tab Style Google Map Style
		*/
		$this->start_controls_section( 'epa_gmaps_overlay_style_sections', [
			'label'     => esc_html__( 'Overlay Style', 'epa_elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'epa_gmaps_type' => [ 'overlay' ],
			],
		] );
		$this->add_responsive_control( 'epa_gmaps_overlay_width', [
			'label'      => __( 'Width', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'size' => 200,
				'unit' => 'px',
			],
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 1100,
					'step' => 10,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .epa-gmap-overlay' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );
		$this->add_control( 'epa_gmaps_overlay_color', [
			'label'     => esc_html__( 'Text Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#222',
			'selectors' => [
				'{{WRAPPER}} .epa-gmap-overlay' => 'color: {{VALUE}};',
			],
		] );
		$this->add_control( 'epa_gmaps_overlay_bg_color', [
			'label'     => esc_html__( 'Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#fff',
			'selectors' => [
				'{{WRAPPER}} .epa-gmap-overlay' => 'background-color: {{VALUE}};',
			],
		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_gmaps_overlay_border',
			'label'    => esc_html__( 'Border', 'epa_elementor' ),
			'selector' => '{{WRAPPER}} .epa-gmap-overlay',
		] );
		$this->add_responsive_control( 'epa_gmaps_overlay_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-gmap-overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'epa_gmaps_overlay_boxshadow',
			'selector' => '{{WRAPPER}} .epa-gmap-overlay',
		] );
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_gmaps_overlay_typography',
			'selector' => '{{WRAPPER}} .epa-gmap-overlay',
		] );
		$this->add_responsive_control( 'epa_gmaps_overlay_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-gmap-overlay' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->add_responsive_control( 'epa_gmaps_overlay_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-gmap-overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->end_controls_section();

		/*
		   Tab Style Google Map Stroke Style
		*/
		$this->start_controls_section( 'epa_gmaps_stroke_style_section', [
			'label'     => esc_html__( 'Stroke Style', 'epa_elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'epa_gmaps_type' => ['routes' ],
			],
		] );
		$this->add_control( 'epa_gmaps_stroke_color', [
			'label'   => esc_html__( 'Color', 'epa_elementor' ),
			'type'    => Controls_Manager::COLOR,
			'default' => '#e23a47',
		] );
		$this->add_responsive_control( 'epa_gmaps_stroke_opacity', [
			'label'      => __( 'Opacity', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'size' => 0.8,
			],
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min'  => 0.2,
					'max'  => 1,
					'step' => 0.1,
				],
			],
		] );
		$this->add_responsive_control( 'epa_gmaps_stroke_weight', [
			'label'      => __( 'Weight', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'size' => 4,
			],
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min'  => 1,
					'max'  => 10,
					'step' => 1,
				],
			],
		] );
		$this->end_controls_section();
	}

	protected function render() {
		//$settings = $this->get_settings();
?>
        <div class="epa_pro_box">
            <h2 class="epa-pro-tit">Google Maps for Elementor</h2>
            <p class="epa-pro-descr">Only pro version holder can use this Google Maps Addon. To buy pro version with unlock all addons features. click the below link: </p>
            <ul class="epa-but-wrapper">
                <li>
                    <a class="epa-pro-but epa-view-gmaps"><i class="fa fa-eye"></i>View Demo</a>
                </li>
                <li>
                    <a class="epa-pro-but epa-view-features"><i class="fa fa-list-alt"></i>View Features</a>
                </li>
                <li>
                    <a class="epa-pro-but epa-buy-now"><i class="fa fa-shopping-cart"></i>Buy Now</a>
                </li>
            </ul>
        </div>

<?php
	}

	protected function _content_template() {
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Epa_googlemaps() );