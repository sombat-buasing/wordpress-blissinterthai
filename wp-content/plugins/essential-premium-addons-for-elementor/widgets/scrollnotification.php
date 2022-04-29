<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Epa_scrollnotification extends Widget_Base {

	public function get_name() {
		return 'epa-scrollnotification';
	}

	public function get_title() {
		return esc_html__( 'Scroll Notification', 'epa_elementor' );
	}

	public function get_icon() {
		return 'eicon-alert wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {

		/*-----------------------------------------------------------------------------------*/
		/*	CONTENT TAB
		/*-----------------------------------------------------------------------------------*/
		$this->start_controls_section( 'eap_scrollnotification_content_section', [
			'label' => esc_html__( 'Notification Content', 'epa_elementor' ),
		] );
		$this->add_control( 'epa_notification_content', [
			'label'       => esc_html__( 'Notification Content', 'epa_elementor' ),
			'type'        => Controls_Manager::WYSIWYG,
			'label_block' => true,
			'default'     => esc_html__( 'This is Notification content, you can change this content with your content', 'epa_elementor' ),
			'dynamic'     => [ 'active' => true ],
		] );

		$this->end_controls_section();

		/**
		 * Content Tab: Notification Settings
		 */
		$this->start_controls_section( 'epa_scrollnotification_settings_section', [
			'label' => esc_html__( 'Notification Settings', 'epa_elementor' ),
		] );

		$this->add_control( 'epa_scrnotify_display_rul', [
			'label'       => esc_html__( 'Display Notification', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT,
			'options'     => [
				'scrolling'        => esc_html__( 'Hidden by default, Visible when scrolling', 'epa_elementor' ),
				'loaded'       => esc_html__( 'Always Visible', 'epa_elementor' ),
				'scrollhidden' => esc_html__( 'Visible by Default, Hidden when scrolling', 'epa_elementor' ),
			],
			'description' => 'Choose how to display the notification',
			'default'     => 'scrollhidden',
		] );

		$this->add_control( 'epa_scrnotify_in_animation_type', [
			'label'       => esc_html__( 'In Animation Type', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT,
			'options'     => scrnotify_animation(),
			'description' => 'Select easin in animation type. Default "Random". Note: Works only in modern browsers.',
			'default'     => 'random',
		] );

		$this->add_control( 'epa_scrnotify_out_animation_type', [
			'label'       => esc_html__( 'Out Animation Type', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT,
			'options'     => scrnotify_animation(),
			'description' => 'Select easin Out animation type. Default "Random". Note: Works only in modern browsers.',
			'default'     => 'random',
		] );

		$this->add_control( 'epa_scrnotify_store_cookie', [
			'label'       => esc_html__( 'After close, store it in cookie ', 'epa_elementor' ),
			'type'        => Controls_Manager::SWITCHER,
			'description' => 'After close, do not show the notification again',
		] );

		$this->add_control( 'epa_scrnotify_store_cookie_days', [
			'label'       => esc_html__( 'Days', 'epa_elementor' ),
			'type'        => Controls_Manager::NUMBER,
			'min' => 1,
			'max' => 30,
			'step' => 1,
			'default' => 10,
			'condition'   => [ 'epa_scrnotify_store_cookie' => 'yes' ],
			'description' => 'How many days do not show the notification again. You may set 1days, 5 or 10 days. Default is 10 days',
		] );

		$this->add_control( 'epa_scrnotify_autohide', [
			'label'       => esc_html__( 'Auto Hide Notification?', 'epa_elementor' ),
			'type'        => Controls_Manager::SWITCHER,
			'description' => 'Notification hide by automatically after second.',
		] );

		$this->add_control( 'epa_scrnotify_auto_hide', [
			'label'       => esc_html__( 'Auto Hide Notification', 'epa_elementor' ),
			'type'        => Controls_Manager::NUMBER,
			'min' => 1000,
			'max' => 20000,
			'step' => 1000,
			'condition'   => [ 'epa_scrnotify_autohide' => 'yes' ],
			'description' => 'Notification hide by automatically after second. For example, 5000 stand for 5 seconds, leave it to blank if you do not want it',
		] );

		$this->end_controls_section();
		$this->start_controls_section( 'epa_scrollnotification_box_section', [
			'label' => esc_html__( 'Notification Box', 'epa_elementor' ),
		] );
		$this->add_responsive_control( 'epa_scrnotify_closebutton_position', [
			'label'       => esc_html__( 'Close Button Position', 'epa_elementor' ),
			'type'        => Controls_Manager::CHOOSE,
			'label_block' => true,
			'options'     => [
				'left'  => [
					'title' => esc_html__( 'Left', 'epa_elementor' ),
					'icon'  => 'fa fa-align-left',
				],
				'right' => [
					'title' => esc_html__( 'Right', 'epa_elementor' ),
					'icon'  => 'fa fa-align-right',
				],
			],
			'default'     => 'left',
			//'prefix_class' => 'epa-opn-align-',
		] );

		$this->add_control( 'epa_scrnotify_box_position', [
			'label'       => esc_html__( 'Notification box Position', 'epa_elementor' ),
			'type'        => Controls_Manager::CHOOSE,
			'label_block' => true,
			'options'     => [
				'left'  => [
					'title' => esc_html__( 'Left', 'epa_elementor' ),
					'icon'  => 'fa fa-align-left',
				],
				'right' => [
					'title' => esc_html__( 'Right', 'epa_elementor' ),
					'icon'  => 'fa fa-align-right',
				],
			],
			'default'     => 'right',
			//'prefix_class' => 'epa-opn-align-',
		] );
		$this->add_control( 'scrnotify_left_position', [
			'label'     => esc_html__( 'From left to right', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'condition' => [
				'epa_scrnotify_box_position' => 'left',
			],
			'default'   => [
				'size' => 10,
			],
		] );
		$this->add_control( 'scrnotify_right_position', [
			'label'       => esc_html__( 'From Right to left', 'epa_elementor' ),
			'type'        => Controls_Manager::SLIDER,
			'default'     => [
				'size' => 10,
			],
			'range'       => [
				'px' => [
					'min'  => 1,
					'max'  => 2000,
					'step' => 1,
				],
			],
			'condition'   => [ 'epa_scrnotify_box_position' => 'right' ],
			'description' => 'Set Bottom to top Position as px',
		] );
		$this->add_control( 'scrnotify_bottom_position', [
			'label'       => esc_html__( 'Bottom to Top', 'epa_elementor' ),
			'type'        => Controls_Manager::SLIDER,
			'description' => 'Set Notification position Bottom to top as %',
			'default'     => [
				'size' => 2,
			],
		] );
		$this->add_control( 'epa_scrnotify_box_width', [
			'label'       => esc_html__( 'Notificaiton box Width', 'epa_elementor' ),
			'default'     => esc_html__( '250', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'description' => 'A fixed value like 250px, default is 250px',
		] );
		$this->add_control( 'epa_scrnotify_box_height', [
			'label'       => esc_html__( 'Notificaiton box Height', 'epa_elementor' ),
			'default'     => esc_html__( 'auto', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'description' => 'A fixed value like 640px, or set it auto for automatic height as content.',
		] );
		$this->end_controls_section();

		/*-----------------------------------------------------------------------------------*/
		/*	STYLE TAB
		/*-----------------------------------------------------------------------------------*/

		$this->start_controls_section( 'notification_style', [
			'label' => esc_html__( 'Notificaiton Style', 'epa_elementor' ),
			'tab'   => CONTROLS_MANAGER::TAB_STYLE,
		] );

		$this->start_controls_tabs( 'notification_style_tabs' );

		$this->start_controls_tab( 'close_button_style_tab', [
			'label' => esc_html__( 'Close Button', 'epa_elementor' ),
		] );

		$this->add_control( 'button_color', [
			'label'     => esc_html__( 'Button Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#FFFFFF',
			'selectors' => [
				'{{WRAPPER}} .epa-scrnotify-colse-button' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'button_background', [
			'label'     => esc_html__( 'Button Background', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#000',
			'selectors' => [
				'{{WRAPPER}} .epa-scrnotify-colse-button' => 'background-color: {{VALUE}};',
			],
		] );
		$this->add_control( 'scrnotify_close_button_font_size', [
			'label'       => esc_html__( 'Button font size', 'epa_elementor' ),
			'type'        => Controls_Manager::SLIDER,
			'default'     => [
				'size' => 23,
			],
			'selectors'   => [
				'{{WRAPPER}} .epa-scrnotify-colse-button' => 'font-size: {{SIZE}}px;',
			],
			'description' => 'Set Button Font Size as px, Default is 23px',
		] );

		$this->add_control( 'scrnotify_close_button_width', [
			'label'       => esc_html__( 'Button Height & Width', 'epa_elementor' ),
			'type'        => Controls_Manager::SLIDER,
			'default'     => [
				'size' => 20,
			],
			'selectors'   => [
				'{{WRAPPER}} .epa-scrnotify-colse-button' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
			],
			'description' => 'Set Button Height & Width as px, Default is 20',
		] );

		/*Button Border*/
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'scrnotify_close_button_border',
			'selector' => '{{WRAPPER}} .epa-scrnotify-colse-button',
		] );

		$this->add_control( 'scrnotify_close_button_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-scrnotify-colse-button' => 'border-radius: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'scrnotify_close_button_shadow',
			'selector' => '{{WRAPPER}} .epa-scrnotify-colse-button',
		] );


		$this->end_controls_tab();

		$this->start_controls_tab( 'dots_style_tab', [
			'label' => esc_html__( 'Content', 'epa_elementor' ),
		] );

		$this->add_control( 'scrnotify_content_color', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#6b6977',
			'selectors' => [
				'{{WRAPPER}} #epa-scroll-notification p, #epa-scroll-notification h1, #epa-scroll-notification h2, #epa-scroll-notification h3, #epa-scroll-notification h4, #epa-scroll-notification h5, #epa-scroll-notification h6' => 'color: {{VALUE}};',
			],
		] );
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'scrnotify_content_typhography',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} #epa-scroll-notification p, #epa-scroll-notification h1, #epa-scroll-notification h2, #epa-scroll-notification h3, #epa-scroll-notification h4, #epa-scroll-notification h5, #epa-scroll-notification h6',
		] );

		$this->add_responsive_control( 'scrnotify_content_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} #epa-scroll-notification p, #epa-scroll-notification h1, #epa-scroll-notification h2, #epa-scroll-notification h3, #epa-scroll-notification h4, #epa-scroll-notification h5, #epa-scroll-notification h6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'scrnotify_content_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} #epa-scroll-notification p, #epa-scroll-notification h1, #epa-scroll-notification h2, #epa-scroll-notification h3, #epa-scroll-notification h4, #epa-scroll-notification h5, #epa-scroll-notification h6' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'scrnotify_container_style_tab', [
			'label' => esc_html__( 'Container', 'epa_elementor' ),
		] );

		$this->add_control( 'scrnotify_container_background', [
			'label'     => esc_html__( 'Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#DAF0FF',
			'selectors' => [
				'{{WRAPPER}} #epa-scroll-notification' => 'background-color: {{VALUE}}!important',
			],
		] );
		/*Box Border*/
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'scrnotify_container_border',
			'selector' => '{{WRAPPER}} #epa-scroll-notification',
		] );

		$this->add_control( 'scrnotify_container_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} #epa-scroll-notification' => 'border-radius: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'label'    => esc_html__( 'Shadow', 'epa_elementor' ),
			'name'     => 'navigation_box_shadow',
			'selector' => '{{WRAPPER}} #epa-scroll-notification',
		] );

		$this->add_responsive_control( 'epa_opn_dot_container_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} #epa-scroll-notification' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$dystyle = '';

		if ( $settings['epa_scrnotify_store_cookie'] == 'yes' ) {
			$sncookie     = 'on';
			$sncookiedays = $settings['epa_scrnotify_store_cookie_days'];
		} else {
			$sncookie     = 'false';
			$sncookiedays = '';
		}

		$scrnotifyautohide = isset( $settings['epa_scrnotify_auto_hide'] ) ? $settings['epa_scrnotify_auto_hide'] : '';

		if ( $settings['epa_scrnotify_box_position'] == 'left' ) {
			$snposition_left   = '' . $settings['scrnotify_left_position']['size'] . '';
			$snposition_bottom = '' . $settings['scrnotify_bottom_position']['size'] . '%';
			$snposition_right  = '';
		}
		if ( $settings['epa_scrnotify_box_position'] == 'right' ) {
			$snposition_right  = '' . $settings['scrnotify_right_position']['size'] . '';
			$snposition_bottom = '' . $settings['scrnotify_bottom_position']['size'] . '%';
			$snposition_left   = '';
		}
		if($settings['epa_scrnotify_display_rul'] == 'scrollhidden'){
			$settings['epa_scrnotify_display_rul'] = 'loaded';
			$datadis = 'on';
		} else {
			$datadis = '';
			$dystyle = 'display:none';
		}
		$output = '';
		if ( is_single() || is_page() ) {
$output .= "<div id='epa-scroll-notification' data-width='{$settings['epa_scrnotify_box_width']}' data-height='{$settings['epa_scrnotify_box_height']}' data-easein='{$settings['epa_scrnotify_in_animation_type']}' data-easeout='{$settings['epa_scrnotify_out_animation_type']}' data-positiontop='' data-positionright='{$snposition_right}' data-positionbottom='{$snposition_bottom}' data-positionleft='{$snposition_left}' data-cookie='{$sncookie}' data-days='{$sncookiedays}' data-autohidedelay='{$scrnotifyautohide}' data-displaywhen='{$settings['epa_scrnotify_display_rul']}' data-opacity='' data-from='0' data-to='all' data-closebutton='true' data-displaybydefault='{$datadis}' data-closeposition='{$settings['epa_scrnotify_closebutton_position']}' class='epa-scroll-notification' style='{$dystyle}'><p>{$settings['epa_notification_content']}</p></div>";
		}
		echo $output;
	}

	protected function _content_template() {
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Epa_scrollnotification() );