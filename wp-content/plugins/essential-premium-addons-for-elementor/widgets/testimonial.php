<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Epa_testimonial extends Widget_Base {

	public function get_name() {
		return 'epa_testimonial';
	}

	public function get_title() {
		return __( 'Testimonial', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'eicon-testimonial wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {
		$this->start_controls_section( 'epa_testimonial_general_section', [
			'label' => esc_html__( 'General Settings', 'epa_elementor' ),
		] );

		$this->add_control( 'epa_testimonial_style', [
			'label'     => __( 'Testimonial Style', 'your-plugin' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'style1',
			'options'   => [
				'style1' => __( 'Style 1', 'epa_elementor' ),
				'style2' => __( 'Style 2', 'epa_elementor' ),
				'style3' => __( 'Style 3', 'epa_elementor' ),
				'style4' => __( 'Style 4', 'epa_elementor' ),
				'style5' => __( 'Style 5', 'epa_elementor' ),
			],
		] );
		$this->add_control(
			'more_options',
			[
				'label' => __( 'This Option available only for Pro holder users.', 'epa_elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
				'condition' => [
					'epa_testimonial_style' => [
						'style3',
						'style4',
						'style5'
					]
				],
			]
		);

		$this->add_control( 'epa_testimonial_enable_rating', [
			'label'   => esc_html__( 'Display Rating?', 'epa_elementor' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
			'condition' => [
				//'epa_testimonial_style!' => 'style5'
			],
		] );

		$this->add_control( 'epa_testimonial_rating_number', [
			'label'     => __( 'Rating Number', 'your-plugin' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => '5',
			'options'   => [
				'1' => __( '1', 'epa_elementor' ),
				'2' => __( '2', 'epa_elementor' ),
				'3' => __( '3', 'epa_elementor' ),
				'4' => __( '4', 'epa_elementor' ),
				'5' => __( '5', 'epa_elementor' ),
			],
			'condition' => [
				'epa_testimonial_enable_rating' => 'yes',
				//'epa_testimonial_style!' => 'style5',
			],
		] );

		$this->end_controls_section();


		$this->start_controls_section( 'epa_section_testimonial_content', [
			'label' => esc_html__( 'Content', 'epa_elementor' ),
		] );

		$this->add_control( 'epa_testimonial_image', [
			'label'   => esc_html__( 'Author', 'epa_elementor' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			],
		] );

		$this->add_control( 'epa_testimonial_name', [
			'label'   => esc_html__( 'User Name', 'epa_elementor' ),
			'type'    => Controls_Manager::TEXT,
			'default' => esc_html__( 'Jonathon', 'epa_elementor' ),
			'dynamic' => [ 'active' => true ],
		] );

		$this->add_control( 'epa_testimonial_company_title', [
			'label'   => esc_html__( 'Company Name', 'epa_elementor' ),
			'type'    => Controls_Manager::TEXT,
			'default' => esc_html__( 'Web Developer', 'epa_elementor' ),
			'dynamic' => [ 'active' => true ],
		] );

		$this->add_control( 'epa_testimonial_description', [
			'label'   => esc_html__( 'Testimonial Description', 'epa_elementor' ),
			'type'    => Controls_Manager::WYSIWYG,
			'default' => esc_html__( 'Add testimonial description here. Edit and place your own text. Add testimonial description here. Edit and place your own text. Add testimonial description here. Edit and place your own text. Add testimonial description here. Edit and place your own text. ', 'epa_elementor' ),
		] );

		$this->end_controls_section();

		/*Image Styling*/
		$this->start_controls_section( 'epa_testimonial_image_style', [
			'label' => __( 'Image', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		/*Image Size*/
		$this->add_control( 'epa_testimonial_img_size', [
			'label'      => __( 'Size', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em' ],
			'default'    => [
				'unit' => 'px',
				'size' => 110,
			],
			'range'      => [
				'px' => [
					'min' => 10,
					'max' => 200,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .epa-testimonial .pic' => 'width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .epa-testimonial-2 .epa-upper-conent .thumb img' => 'width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .epa-testimonial-3 .thumb img' => 'width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .epa-testimonial-4 .testimonial-footer img' => 'width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .epa-testimonial-5 .card-avatar img' => 'width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_testimonial_style1_image_border',
			'condition' => [
				'epa_testimonial_style' => 'style1'
			],
			'selector' => 	'{{WRAPPER}} .epa-testimonial-2 .thumb img',
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_testimonial_style2_image_border',
			'condition' => [
				'epa_testimonial_style' => 'style2'
			],
			'selector' => 	'{{WRAPPER}} .epa-testimonial .pic',
		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_testimonial_style3_image_border',
			'condition' => [
				'epa_testimonial_style' => 'style3'
			],
			'selector' => 	'{{WRAPPER}} .epa-testimonial-3 .thumb img',
		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_testimonial_style4_image_border',
			'condition' => [
				'epa_testimonial_style' => 'style4'
			],
			'selector' => 	'{{WRAPPER}} .epa-testimonial-4 .testimonial-footer img',
		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_testimonial_style5_image_border',
			'condition' => [
				'epa_testimonial_style' => 'style5'
			],
			'selector' => 	'{{WRAPPER}} .epa-testimonial-5 .card-avatar img',
		] );

		$this->add_control( 'epa_testimonial_slider_border_radius', [
			'label'     => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-testimonial .pic' => 'border-radius: {{SIZE}}px;',
				'{{WRAPPER}} .epa-testimonial-2 .epa-upper-conent .thumb img' => 'border-radius: {{SIZE}}px;',
				'{{WRAPPER}} .epa-testimonial-3 .thumb img' => 'border-radius: {{SIZE}}px;',
				'{{WRAPPER}} .epa-testimonial-4 .testimonial-footer img' => 'border-radius: {{SIZE}}px;',
				'{{WRAPPER}} .epa-testimonial-5 .card-avatar img' => 'border-radius: {{SIZE}}px;',
			],
		] );

		$this->end_controls_section();

		/*Start Person Settings Section*/
		$this->start_controls_section( 'epa_testimonials_person_style', [
			'label' => __( 'Author', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		/*Person Name Color*/
		$this->add_control( 'epa_testimonial_person_name_color', [
			'label'     => __( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'scheme'    => [
				'type'  => Scheme_Color::get_type(),
				'value' => Scheme_Color::COLOR_1,
			],
			'selectors' => [
				'{{WRAPPER}} .epa-testimonial .testimonial-title' => 'color: {{VALUE}};',
				'{{WRAPPER}} .epa-testimonial-2 .epa-upper-conent .epa-clients-details .content .name' => 'color: {{VALUE}};',
				'{{WRAPPER}} .epa-testimonial-3 .bottom-content .epa-clients-details .content .name' => 'color: {{VALUE}};',
				'{{WRAPPER}} .epa-testimonial-4 .author-name' => 'color: {{VALUE}};',
				'{{WRAPPER}} .epa-testimonial-5 .cpa-author5 h4' => 'color: {{VALUE}};',
			],
		] );

		/*Authohr Name Typography*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'author_name_style_2_typography',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .epa-testimonial .testimonial-title',
			'condition' => [
				'epa_testimonial_style' => 'style2'
			],
		] );
		/*Authohr Name Typography*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'author_name_style_1_typography',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .epa-testimonial-2 .epa-upper-conent .epa-clients-details .content .name',
			'condition' => [
				'epa_testimonial_style' => 'style1'
			],
		] );
		/*Authohr Name Typography*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'author_name_style3_typography',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .epa-testimonial-3 .bottom-content .epa-clients-details .content .name',
			'condition' => [
				'epa_testimonial_style' => 'style3'
			],
		] );

		/*Authohr Name Typography*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'author_name_style4_typography',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .epa-testimonial-4 .author-name',
			'condition' => [
				'epa_testimonial_style' => 'style4'
			],
		] );

		/*Authohr Name Typography*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'author_name_style5_typography',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .epa-testimonial-5 .cpa-author5 h4',
			'condition' => [
				'epa_testimonial_style' => 'style5'
			],
		] );

		/*Separator Color*/
		$this->add_control( 'epa_testimonial_separator_color', [
			'label'     => __( 'Divider Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'scheme'    => [
				'type'  => Scheme_Color::get_type(),
				'value' => Scheme_Color::COLOR_1,
			],
			'selectors' => [
				'{{WRAPPER}} .epa-testimonial .post::before' => 'border-color: {{VALUE}};',
				'{{WRAPPER}} .epa-testimonial-5 .cpa-author5 span' => 'color: {{VALUE}};',
			],
			'condition' => [
				'epa_testimonial_style' => [
					'style2', 'style5'
				]
			],
		] );

		$this->end_controls_section();

		/*Start Company Settings Section*/
		$this->start_controls_section( 'epa_testimonial_company_style', [
			'label' => __( 'Company', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		/*Company Name Color*/
		$this->add_control( 'epa_testimonial_company_name_color', [
			'label'     => __( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'scheme'    => [
				'type'  => Scheme_Color::get_type(),
				'value' => Scheme_Color::COLOR_2,
			],
			'selectors' => [
				'{{WRAPPER}} .epa-testimonial .post' => 'color: {{VALUE}};',
				'{{WRAPPER}} .epa-testimonial-2 .epa-upper-conent .epa-clients-details .content .designation' => 'color: {{VALUE}};',
				'{{WRAPPER}} .epa-testimonial-3 .bottom-content .epa-clients-details .content .designation' => 'color: {{VALUE}};',
				'{{WRAPPER}} .epa-company-area span.author-designation' => 'color: {{VALUE}};',
				'{{WRAPPER}} .epa-testimonial-5 .cpa-author5 .category' => 'color: {{VALUE}};',
			],
		] );

		/*Company Typography*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'company_name_style2__typography',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .epa-testimonial .post',
			'condition' => [
				'epa_testimonial_style' => 'style2'
			],

		] );

		/*Company Typography*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'company_name_style1_typography',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'condition' => [
				'epa_testimonial_style' => 'style1'
			],
			'selector' => '{{WRAPPER}} .epa-testimonial-2 .epa-upper-conent .epa-clients-details .content .designation',
		] );
		/*Company Typography*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'company_name_style3_typography',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'condition' => [
				'epa_testimonial_style' => 'style3'
			],
			'selector' => '{{WRAPPER}} .epa-testimonial-3 .bottom-content .epa-clients-details .content .designation',
		] );
		/*Company Typography*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'company_name_style4_typography',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'condition' => [
				'epa_testimonial_style' => 'style4'
			],
			'selector' => '{{WRAPPER}} .epa-company-area span.author-designation',
		] );
		/*Company Typography*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'company_name_style5_typography',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'condition' => [
				'epa_testimonial_style' => 'style5'
			],
			'selector' => '{{WRAPPER}} .epa-testimonial-5 .cpa-author5 .category',
		] );

		/*End Color Section*/
		$this->end_controls_section();

		/*Start Content Settings Section*/
		$this->start_controls_section( 'epa_testimonial_content_style', [
			'label' => __( 'Content', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		/*Content Color*/
		$this->add_control( 'epa_testimonial_content_color', [
			'label'     => __( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .epa-testimonial p' => 'color: {{VALUE}};',
				'{{WRAPPER}} .epa-testimonial-2 .bottom-conetent p' => 'color: {{VALUE}};',
				'{{WRAPPER}} .epa-testimonial-3 .bottom-content p' => 'color: {{VALUE}};',
				'{{WRAPPER}} .epa-testimonial-4 .testimonial-text' => 'color: {{VALUE}};',
				'{{WRAPPER}} .epa-testimonial-5 .card-description' => 'color: {{VALUE}};',
			],
		] );

		/*Content Typography*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'content_typography_style2',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .epa-testimonial p',
			'condition' => [
				'epa_testimonial_style' => 'style2'
			],
		] );
		/*Content Typography*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'content_typography_style1',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .epa-testimonial-2 .bottom-conetent p',
			'condition' => [
				'epa_testimonial_style' => 'style1'
			],
		] );
		/*Content Typography*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'content_typography_style3',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .epa-testimonial-3 .bottom-content p',
			'condition' => [
				'epa_testimonial_style' => 'style3'
			],
		] );
		/*Content Typography*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'content_typography_style4',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .epa-testimonial-4 .testimonial-text',
			'condition' => [
				'epa_testimonial_style' => 'style4'
			],
		] );
		/*Content Typography*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'content_typography_style5',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .epa-testimonial-5 .card-description',
			'condition' => [
				'epa_testimonial_style' => 'style5'
			],
		] );


		/*Testimonial Text Margin*/
		$this->add_responsive_control( 'epa_testimonial_margin', [
			'label'      => __( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-testimonial .description' => 'margin: {{top}}{{UNIT}} {{right}}{{UNIT}} {{bottom}}{{UNIT}} {{left}}{{UNIT}};',
				'{{WRAPPER}} .bottom-conetent' => 'margin: {{top}}{{UNIT}} {{right}}{{UNIT}} {{bottom}}{{UNIT}} {{left}}{{UNIT}};',
				'{{WRAPPER}} .epa-testimonial-3 .bottom-content' => 'margin: {{top}}{{UNIT}} {{right}}{{UNIT}} {{bottom}}{{UNIT}} {{left}}{{UNIT}};',
				'{{WRAPPER}} .epa-testimonial-4 .testimonial-text' => 'margin: {{top}}{{UNIT}} {{right}}{{UNIT}} {{bottom}}{{UNIT}} {{left}}{{UNIT}};',
				'{{WRAPPER}} .epa-testimonial-5 .card-description' => 'margin: {{top}}{{UNIT}} {{right}}{{UNIT}} {{bottom}}{{UNIT}} {{left}}{{UNIT}};',
			],
		] );

		/*End Content Settings Section*/
		$this->end_controls_section();

		/*Start Quotes Style Section*/
		$this->start_controls_section( 'epa_testimonial_quotes', [
			'label' => __( 'Quotation Icon', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
			'condition' => [
				'epa_testimonial_style!' => 'style3'
			],
		] );

		/*Quotes Color*/
		$this->add_control( 'epa_testimonial_quote_icon_color', [
			'label'     => __( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .epa-testimonial::before'  => 'color: {{VALUE}};',
				'{{WRAPPER}} .testimonial-title:before' => 'color: {{VALUE}};',
				'{{WRAPPER}} .epa-testimonial-2 .bottom-conetent .icon' => 'color: {{VALUE}};',
				'{{WRAPPER}} .epa-testimonial-4 .testimonial-text i' => 'color: {{VALUE}};',
				'{{WRAPPER}} .epa-testimonial-5 .icon i' => 'color: {{VALUE}};',
			],
		] );

		/*Quotes Size*/
		$this->add_control( 'epa_testimonial_quotes_size', [
			'label'      => __( 'Size', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%', 'em' ],
			'default'    => [
				'unit' => 'px',
				'size' => 60,
			],
			'range'      => [
				'px' => [
					'min' => 5,
					'max' => 250,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .epa-testimonial::before'  => 'font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .testimonial-title:before' => 'font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .epa-testimonial-2 .bottom-conetent .icon' => 'font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .epa-testimonial-4 .testimonial-text i' => 'font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .epa-testimonial-5 .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		] );

		/*Quote Position*/
		$this->add_responsive_control( 'epa_testimonial_quote_position', [
			'label'      => __( 'Quote Position', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'default'    => [
				'top'  => 0,
				'left' => 0,
				'unit' => 'px',
			],
			'selectors'  => [
				'{{WRAPPER}} .epa-testimonial-2 .bottom-conetent .icon' => 'top: {{TOP}}{{UNIT}};  left:{{LEFT}}{{UNIT}};',
				'{{WRAPPER}} .epa-testimonial-4 .testimonial-text i' => 'top: {{TOP}}{{UNIT}};  left:{{LEFT}}{{UNIT}};',
				'{{WRAPPER}} .epa-testimonial-5 .icon i' => 'top: {{TOP}}{{UNIT}};  left:{{LEFT}}{{UNIT}};',
			],
			'condition' => [
				'epa_testimonial_style' => [
					'style1',
					'style4',
					'style5',
				],
			],
		] );

		/*Upper Quote Position*/
		$this->add_responsive_control( 'epa_testimonial_left_quote_position', [
			'label'      => __( 'Left Quote Position', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'default'    => [
				'top'  => 0,
				'left' => 0,
				'unit' => 'px',
			],
			'condition' => [
				'epa_testimonial_style' => 'style2'
			],
			'selectors'  => [
				'{{WRAPPER}} .epa-testimonial::before' => 'top: {{TOP}}{{UNIT}};  left:{{LEFT}}{{UNIT}};',
			],
		] );
		/*Upper Quote Position*/
		$this->add_responsive_control( 'epa_testimonial_right_quote_position', [
			'label'      => __( 'Right Quote Position', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'default'    => [
				'top'  => 0,
				'left' => 0,
				'unit' => 'px',
			],
			'condition' => [
				'epa_testimonial_style' => 'style2',
			],
			'selectors'  => [
				'{{WRAPPER}} .testimonial-title::before' => 'top: {{TOP}}{{UNIT}};  right:{{LEFT}}{{UNIT}};',

			],
		] );
		/*End Typography Section*/
		$this->end_controls_section();


	}


	protected function render() {
		$settings = $this->get_settings_for_display();
		$output   = '';
		$rating = '';
		$randid = uniqid();

		/* Rating Store */
		$rating .= '<ul class="epa-testi-rating">';
		$testi_nonerating = 5 - $settings['epa_testimonial_rating_number']; // None Rating
		for ( $x = 1; $x <= $settings['epa_testimonial_rating_number']; $x ++ ) {
			$rating .= '  <li class="fa fa-star" id="testi_star"></li>';
		}
		for ( $x = 1; $x <= $testi_nonerating; $x ++ ) {
			$rating .= ' <li class="fa fa-star" id="testi_nonestar"></li>';
		}
		$rating .= ' </ul>';
		/* Rating Store */

		/*
	 * Execute If Testimonial Style is 1
	 * */
		if($settings['epa_testimonial_style'] == 'style1') {
			$output .= '<div class="epa-testimonial-2">
                        <div class="epa-upper-conent">
                            <div class="thumb">
                                <img src="' . $settings['epa_testimonial_image']['url'] . '" alt="">
                            </div>
                            <div class="epa-clients-details">
                                <div class="content">
                                    <h4 class="name">' . $settings['epa_testimonial_name'] . '</h4>
                                    <span class="designation">' . $settings['epa_testimonial_company_title'] . '</span>';
			if ( $settings['epa_testimonial_enable_rating'] == "yes" ) {
				$output .= $rating;
			}
			$output .= '</div>
                            </div>
                        </div>
                        <div class="bottom-conetent">
                            <div class="icon">
                                <i class="fa fa-quote-left"></i>
                            </div>
                            <p>' . $settings['epa_testimonial_description'] . '</p>
                        </div>
                    </div>';
		}

		/*
		 * Execute If Testimonial Style is 2
		 * */

		if($settings['epa_testimonial_style'] == 'style2') {
			$output .= '<div class="epa-testimonial">
                        <div class="pic">
                            <img src="' . $settings['epa_testimonial_image']['url'] . '" alt="">
                        </div>
                        <p class="description">
                            ' . $settings['epa_testimonial_description'] . '
                        </p>
                        <h3 class="testimonial-title">' . $settings['epa_testimonial_name'] . ' <span class="post">' . $settings['epa_testimonial_company_title'] . '</span></h3>';


			if ( $settings['epa_testimonial_enable_rating'] == "yes" ) {
				$output .=  $rating;
			}
			$output .= '</div>';
		}


		if($settings['epa_testimonial_style'] == 'style3') {

			$output .= '<div class="testi-pro-wrapper">
			<p>Testimonial <span>Style 3</span> available only for Pro holder users. Buy pro version to unlock all Addons features - </p>
			 <a href="https://codenat.com/downloads/essential-premium-addons-for-elementor/" target="_blank">click here</a>
			 </div>';
		}

		if($settings['epa_testimonial_style'] == 'style4') {
			$output .= '<div class="testi-pro-wrapper">
			<p>Testimonial <span>Style 4</span> available only for Pro holder users. Buy pro version to unlock all Addons features - </p>
			 <a href="https://codenat.com/downloads/essential-premium-addons-for-elementor/" target="_blank">click here</a>
			 </div>';
		}
		if($settings['epa_testimonial_style'] == 'style5') {
			$output .= '<div class="testi-pro-wrapper">
			<p>Testimonial <span>Style 5</span> available only for Pro holder users. Buy pro version to unlock all Addons features - </p>
			 <a href="https://codenat.com/downloads/essential-premium-addons-for-elementor/" target="_blank">click here</a>
			 </div>';

		}


		echo $output;
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Epa_testimonial() );