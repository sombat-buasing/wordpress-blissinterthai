<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Epa_logocarousel extends Widget_Base {

	public function get_name() {
		return 'epa-logocarousel';
	}

	public function get_title() {
		return esc_html__( 'Logo Carousel', 'epa_elementor' );
	}

	public function get_icon() {
		return 'eicon-carousel wfe-ccn-pe';
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
		$this->start_controls_section( 'section_logo_carousel', [
			'label' => esc_html__( 'Logo Carousel', 'epa_elementor' ),
		] );

		$this->add_control( 'carousel_slides', [
			'label'       => '',
			'type'        => Controls_Manager::REPEATER,
			'default'     => [
				[
					'logo_carousel_slide' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				],
				[
					'logo_carousel_slide' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				],
				[
					'logo_carousel_slide' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				],
				[
					'logo_carousel_slide' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				],
				[
					'logo_carousel_slide' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				],
			],
			'fields'      => [
				[
					'name'    => 'logo_carousel_slide',
					'label'   => esc_html__( 'Upload Logo Image', 'epa_elementor' ),
					'type'    => Controls_Manager::MEDIA,
					'dynamic' => [
						'active' => true,
					],
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				],
			],
			'title_field' => esc_html__( 'Logo Carousel Image', 'epa_elementor' ),
		] );

		$this->end_controls_section();

		/**
		 * Carousel Settings
		 */
		$this->start_controls_section( 'section_additional_options', [
			'label' => esc_html__( 'Carousel Settings', 'epa_elementor' ),
		] );

		$this->add_control( 'items', [
			'label'      => esc_html__( 'Visible Items', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [ 'size' => 3 ],
			'range'      => [
				'px' => [
					'min'  => 1,
					'max'  => 10,
					'step' => 1,
				],
			],
			'size_units' => '',
			'separator'  => 'before',
		] );

		$this->add_responsive_control( 'item_margin', [
			'label'      => esc_html__( 'Items Gap', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [ 'size' => 10 ],
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				],
			],
			'size_units' => '',
		] );

		$this->add_control( 'slider_speed', [
			'label'       => esc_html__( 'Slider Speed', 'epa_elementor' ),
			'description' => esc_html__( 'Duration of transition between slides (in ms)', 'epa_elementor' ),
			'type'        => Controls_Manager::SLIDER,
			'default'     => [ 'size' => 3000 ],
			'range'       => [
				'px' => [
					'min'  => 500,
					'max'  => 20000,
					'step' => 1,
				],
			],
			'size_units'  => '',
			'separator'   => 'before',
		] );

		$this->add_control( 'autoplay', [
			'label'        => esc_html__( 'Autoplay', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'true',
			'label_on'     => esc_html__( 'Yes', 'epa_elementor' ),
			'label_off'    => esc_html__( 'No', 'epa_elementor' ),
			'return_value' => 'true',
			'separator'    => 'before',
		] );

		$this->add_control( 'autoplay_speed', [
			'label'      => esc_html__( 'Autoplay Speed', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [ 'size' => 500 ],
			'range'      => [
				'px' => [
					'min'  => 500,
					'max'  => 5000,
					'step' => 1,
				],
			],
			'size_units' => '',
			'condition'  => [
				'autoplay' => 'true',
			],
		] );

		$this->add_control( 'infinite_loop', [
			'label'        => esc_html__( 'Infinite Loop', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'true',
			'label_on'     => esc_html__( 'Yes', 'epa_elementor' ),
			'label_off'    => esc_html__( 'No', 'epa_elementor' ),
			'return_value' => 'true',
		] );

		$this->add_control( 'pause_on_hover', [
			'label'        => esc_html__( 'Pause On Hover', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => '',
			'label_on'     => esc_html__( 'Yes', 'epa_elementor' ),
			'label_off'    => esc_html__( 'No', 'epa_elementor' ),
			'return_value' => 'yes',
			'condition'    => [
				'autoplay' => 'true',
			],
		] );

		$this->add_control( 'navigation_heading', [
			'label'     => esc_html__( 'Navigation', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );


		$this->add_control( 'epa_posts_carousel_navigation', [
			'label'        => esc_html__( 'Show Navigation?', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => '',
			'label_on'     => esc_html__( 'Yes', 'epa_elementor' ),
			'label_off'    => esc_html__( 'No', 'epa_elementor' ),
			'return_value' => 'yes',
		] );


		$this->add_control( 'logo_carousel_navigation_style', [
				'label'     => esc_html__( 'Navigation Style', 'epa_elementor' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'dot',
				'options'   => [
					'dot'   => esc_html__( 'Dot', 'epa_elementor' ),
					'arrow' => esc_html__( 'Arrow', 'epa_elementor' ),
				],
				'condition' => [
					'epa_posts_carousel_navigation' => 'yes',
				],
			] );

		$this->end_controls_section();

		/*-----------------------------------------------------------------------------------*/
		/*	STYLE TAB
		/*-----------------------------------------------------------------------------------*/

		/**
		 * Style Tab: Logos
		 */
		$this->start_controls_section( 'section_logos_style', [
			'label' => esc_html__( 'Logos', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'        => 'logo_border',
			'label'       => esc_html__( 'Border', 'epa_elementor' ),
			'placeholder' => '1px',
			'default'     => '1px',
			'selector'    => '{{WRAPPER}} .epa-logocarousel-wrapper .owl-item',
		] );

		$this->add_control( 'logo_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-logocarousel-wrapper .owl-item, {{WRAPPER}} .epa-logocarousel-wrapper .owl-item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'logo_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-logocarousel-wrapper .owl-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->start_controls_tabs( 'tabs_logos_style' );

		$this->start_controls_tab( 'tab_logos_normal', [
			'label' => esc_html__( 'Normal', 'epa_elementor' ),
		] );

		$this->add_control( 'opacity_normal', [
			'label'     => esc_html__( 'Opacity', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min'  => 0,
					'max'  => 1,
					'step' => 0.1,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-logocarousel-wrapper .owl-item img' => 'opacity: {{SIZE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_logos_hover', [
			'label' => esc_html__( 'Hover', 'epa_elementor' ),
		] );

		$this->add_control( 'opacity_hover', [
			'label'     => esc_html__( 'Opacity', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min'  => 0,
					'max'  => 1,
					'step' => 0.1,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-logocarousel-wrapper .owl-item:hover img' => 'opacity: {{SIZE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		/**
		 * Style Tab: Arrows
		 */
		$this->start_controls_section( 'section_arrows_style', [
			'label'     => esc_html__( 'Arrows', 'epa_elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'logo_carousel_navigation_style' => 'arrow',
			],
		] );

		$this->add_control( 'arrow', [
			'label'   => esc_html__( 'Choose Arrow', 'epa_elementor' ),
			'type'    => Controls_Manager::CHOOSE,
			'default' => 'chevron',
			'options' => [
				'chevron'        => [
					'title' => esc_html__( 'Chevron', 'epa_elementor' ),
					'icon'  => [ 'fa fa-chevron-right' ],
				],
				'angledouble'    => [
					'title' => esc_html__( 'Angel Double', 'epa_elementor' ),
					'icon'  => 'fa fa-angle-double-right',
				],
				'arrowright'     => [
					'title' => esc_html__( 'Arrow', 'epa_elementor' ),
					'icon'  => 'fa fa-arrow-right',
				],
				'longarrowright' => [
					'title' => esc_html__( 'Long Arrow', 'epa_elementor' ),
					'icon'  => 'fa fa-long-arrow-right',
				],
			],
		] );

		$this->add_responsive_control( 'arrows_size', [
			'label'      => esc_html__( 'Arrows Size', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [ 'size' => '40' ],
			'range'      => [
				'px' => [
					'min'  => 15,
					'max'  => 100,
					'step' => 1,
				],
			],
			'size_units' => [ 'px' ],
			'selectors'  => [
				'{{WRAPPER}} .epalcnavs i' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		] );
		$this->add_control( 'arrow_separator', [
			'label'     => esc_html__( 'Arrow Separator', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'selectors' => [
				'{{WRAPPER}} .epalcnavs .owl-next' => 'right: -{{SIZE}}px;',
				'{{WRAPPER}} .epalcnavs .owl-prev' => 'left: -{{SIZE}}px;',
			],
		] );

		$this->start_controls_tabs( 'tabs_arrows_style' );

		$this->start_controls_tab( 'tab_arrows_normal', [
			'label' => esc_html__( 'Normal', 'epa_elementor' ),
		] );

		$this->add_control( 'arrows_bg_color_normal', [
			'label'     => esc_html__( 'Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .epalcnavs .owl-next, {{WRAPPER}} .epalcnavs .owl-prev' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'arrows_color_normal', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .epalcnavs .owl-next, {{WRAPPER}} .epalcnavs .owl-prev' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'        => 'arrows_border_normal',
			'label'       => esc_html__( 'Border', 'epa_elementor' ),
			'placeholder' => '1px',
			'default'     => '1px',
			'selector'    => '{{WRAPPER}} .epalcnavs .owl-next, {{WRAPPER}} .epalcnavs .owl-prev',
		] );

		$this->add_control( 'arrows_border_radius_normal', [
			'label'      => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epalcnavs .owl-next, {{WRAPPER}} .epalcnavs .owl-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_arrows_hover', [
			'label' => esc_html__( 'Hover', 'epa_elementor' ),
		] );

		$this->add_control( 'arrows_bg_color_hover', [
			'label'     => esc_html__( 'Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .epalcnavs .owl-next:hover, {{WRAPPER}} .epalcnavs .owl-prev:hover' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'arrows_color_hover', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .epalcnavs .owl-next:hover, {{WRAPPER}} .epalcnavs .owl-prev:hover' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'arrows_border_color_hover', [
			'label'     => esc_html__( 'Border Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .epalcnavs .owl-next:hover, {{WRAPPER}} .epalcnavs .owl-prev:hover' => 'border-color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control( 'arrows_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epalcnavs .owl-next, {{WRAPPER}} .epalcnavs .owl-prev' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'separator'  => 'before',
		] );

		$this->end_controls_section();

		/*Start Dots Style Section*/
		$this->start_controls_section( 'epa_testimonial_dots', [
			'label'     => esc_html__( 'Dots', 'epa_elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'logo_carousel_navigation_style' => 'dot',
			],
		] );

		$this->add_control( 'lc_dots_position', [
			'label'        => esc_html__( 'Position', 'epa_elementor' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => [
				'inside'  => esc_html__( 'Inside', 'epa_elementor' ),
				'outside' => esc_html__( 'Outside', 'epa_elementor' ),
			],
			'default'      => 'outside',
			'prefix_class' => 'lcdots-',
		] );

		$this->add_control( 'epa_testimonial_dot_color', [
			'label'     => esc_html__( 'Dot Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#ddd',
			'selectors' => [
				'{{WRAPPER}} .epalcdots .owl-dot' => 'background-color: {{VALUE}};',
			],
		] );
		$this->add_control( 'epa_testimonial_dot_hover_color', [
			'label'     => esc_html__( 'Dot Hover Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#ddd',
			'selectors' => [
				'{{WRAPPER}} .epalcdots .owl-dot:hover' => 'background-color: {{VALUE}};',
			],
		] );

		/*Dot Color*/
		$this->add_control( 'epa_testimonial_dot_active_color', [
			'label'     => esc_html__( 'Active Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#141414',
			'selectors' => [
				'{{WRAPPER}} .epalcdots .active' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'epa_dot_height', [
			'label'     => esc_html__( 'Dot Height', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 10,
			],
			'range'     => [
				'px' => [
					'min'  => 1,
					'max'  => 50,
					'step' => 1,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epalcdots .owl-dot'        => 'height: {{SIZE}}px;',
				'{{WRAPPER}} .epalcdots .owl-dot.active' => 'height: {{SIZE}}px;',
			],
		] );
		$this->add_responsive_control( 'epa_dot_width', [
			'label'     => esc_html__( 'Dot Width', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 20,
			],
			'range'     => [
				'px' => [
					'min'  => 1,
					'max'  => 150,
					'step' => 1,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epalcdots .owl-dot'        => 'width: {{SIZE}}px;',
				'{{WRAPPER}} .epalcdots .owl-dot.active' => 'width: {{SIZE}}px;',
			],
		] );
		$this->add_responsive_control( 'dots_spacing', [
			'label'      => esc_html__( 'Spacing', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'size' => 2,
			],
			'range'      => [
				'px' => [
					'min'  => 1,
					'max'  => 30,
					'step' => 1,
				],
			],
			'size_units' => '',
			'selectors'  => [
				'{{WRAPPER}} .epalcdots .owl-dot' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}}',
			],
		] );

		$this->add_control( 'dot_align', [
				'label'   => __( 'Alignment', 'epa_elementor' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left'   => [
						'left' => esc_html__( 'Left', 'epa_elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'center' => esc_html__( 'Center', 'epa_elementor' ),
						'icon'   => 'fa fa-align-center',
					],
					'right'  => [
						'right' => esc_html__( 'Right', 'epa_elementor' ),
						'icon'  => 'fa fa-align-right',
					],
				],

				'default'   => 'center',
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .epalcdots' => 'text-align: {{VALUE}};',
				],
			] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_dot_border',
			'label'    => esc_html__( 'Border', 'epa_elementor' ),
			'selector' => '{{WRAPPER}} .epalcdots .owl-dot, .epalcdots .owl-dot.active',
		] );
		$this->add_control( 'epa_testimonial_dots_border_radius', [
			'label'     => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epalcdots .owl-dot, .epalcdots .owl-dot.active' => 'border-radius: {{SIZE}}px;',
			],
		] );


		$this->add_responsive_control( 'epa_testimonialslider_dots_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epalcdots .owl-dot, .epalcdots .owl-dot.active' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		/*End Typography Section*/
		$this->end_controls_section();
	}

	protected function render() {
		?>
		<div class="epa_pro_box">
			<h2 class="epa-pro-tit">Logo Carousel for Elementor</h2>
			<p class="epa-pro-descr">Only pro version holder can use this Logo Carousel Addon. To buy pro version with unlock all addons features. click the below link: </p>
			<ul class="epa-but-wrapper">
				<li>
					<a class="epa-pro-but epa-view-logocarousel"><i class="fa fa-eye"></i>View Demo</a>
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

Plugin::instance()->widgets_manager->register_widget_type( new Epa_logocarousel() );