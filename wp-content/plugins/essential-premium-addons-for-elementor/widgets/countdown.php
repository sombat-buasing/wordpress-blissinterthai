<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Epa_countdown extends Widget_Base {

	public function get_name() {
		return 'wfe-countdown';
	}

	public function get_title() {
		return __( 'Countdown', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'eicon-countdown wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc

	protected function _register_controls() {

		$this->start_controls_section( 'epa_countdown_settings_general', [
			'label' => esc_html__( 'Countdown Settings', 'epa_elementor' ),
		] );

		$this->add_control( 'epa_countdown_style', [
			'label'       => esc_html__( 'Countdown Style', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT,
			'default'     => 'style1',
			'label_block' => false,
			'options'     => [
				'style1' => esc_html__( 'Style 1', 'epa_elementor' ),
				'style2' => esc_html__( 'Style 2', 'epa_elementor' ),
			],
		] );


		$this->add_control( 'epa_countdown_separator_heading', [
			'label' => __( 'Countdown Separator', 'epa_elementor' ),
			'type'  => Controls_Manager::HEADING,
		] );

		$this->add_control( 'epa_countdown_separator', [
			'label'        => esc_html__( 'Display Separator', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'epa-countdown-show-separator',
			'default'      => '',
		] );

		$this->add_control( 'epa_countdown_due_time', [
				'label'       => __( 'Countdown Due Date', 'epa_elementor' ),
				'type'        => Controls_Manager::DATE_TIME,
				'default'     => date( "Y-m-d H:m:s", strtotime( "+ 1 Day" ) ),
				'description' => __( 'Date format is (yyyy-mm-dd). Time format is (hh:mm:ss). Example: 2020-01-01 09:30.', 'epa_elementor' ),
			] );

		$this->add_control( 'epa_countdown_label_position', [
			'label'   => esc_html__( 'Label Position', 'epa_elementor' ),
			'type'    => Controls_Manager::SELECT,
			'default' => '',
			'options' => [
				''  => esc_html__( 'Block', 'epa_elementor' ),
				'epa-label-inline' => esc_html__( 'Inline', 'epa_elementor' ),
			],
		] );

		$this->end_controls_section();


		$this->start_controls_section( 'epa_countdown_settings_content', [
			'label' => esc_html__( 'Display Settings', 'epa_elementor' ),
		] );

		$this->add_control( 'epa_countdown_year', [
			'label'        => esc_html__( 'Display Year', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			//'default'      => 'yes',
		] );

		$this->add_control( 'epa_countdown_year_label', [
			'label'       => esc_html__( 'Custom Label for Year', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Year', 'epa_elementor' ),
			'description' => esc_html__( 'Leave blank to hide', 'epa_elementor' ),
			'condition'   => [
				'epa_countdown_year' => 'yes',
			],
		] );
		$this->add_control( 'epa_countdown_month', [
			'label'        => esc_html__( 'Display Month', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			//'default'      => 'yes',
		] );

		$this->add_control( 'epa_countdown_month_label', [
			'label'       => esc_html__( 'Custom Label for Month', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Month', 'epa_elementor' ),
			'description' => esc_html__( 'Leave blank to hide', 'epa_elementor' ),
			'condition'   => [
				'epa_countdown_month' => 'yes',
			],
		] );

		$this->add_control( 'epa_countdown_weeks', [
			'label'        => esc_html__( 'Display Weeks', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			//'default'      => 'yes',
		] );

		$this->add_control( 'epa_countdown_weeks_label', [
			'label'       => esc_html__( 'Custom Label for Weeks', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Weeks', 'epa_elementor' ),
			'description' => esc_html__( 'Leave blank to hide', 'epa_elementor' ),
			'condition'   => [
				'epa_countdown_weeks' => 'yes',
			],
		] );

		$this->add_control( 'epa_countdown_days', [
			'label'        => esc_html__( 'Display Days', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$this->add_control( 'epa_countdown_days_label', [
			'label'       => esc_html__( 'Custom Label for Days', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Days', 'epa_elementor' ),
			'description' => esc_html__( 'Leave blank to hide', 'epa_elementor' ),
			'condition'   => [
				'epa_countdown_days' => 'yes',
			],
		] );


		$this->add_control( 'epa_countdown_hours', [
			'label'        => esc_html__( 'Display Hours', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$this->add_control( 'epa_countdown_hours_label', [
			'label'       => esc_html__( 'Custom Label for Hours', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Hours', 'epa_elementor' ),
			'description' => esc_html__( 'Leave blank to hide', 'epa_elementor' ),
			'condition'   => [
				'epa_countdown_hours' => 'yes',
			],
		] );

		$this->add_control( 'epa_countdown_minutes', [
			'label'        => esc_html__( 'Display Minutes', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$this->add_control( 'epa_countdown_minutes_label', [
			'label'       => esc_html__( 'Custom Label for Minutes', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Minutes', 'epa_elementor' ),
			'description' => esc_html__( 'Leave blank to hide', 'epa_elementor' ),
			'condition'   => [
				'epa_countdown_minutes' => 'yes',
			],
		] );

		$this->add_control( 'epa_countdown_seconds', [
			'label'        => esc_html__( 'Display Seconds', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$this->add_control( 'epa_countdown_seconds_label', [
			'label'       => esc_html__( 'Custom Label for Seconds', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Seconds', 'epa_elementor' ),
			'description' => esc_html__( 'Leave blank to hide', 'epa_elementor' ),
			'condition'   => [
				'epa_countdown_seconds' => 'yes',
			],
		] );

		$this->end_controls_section();


		$this->start_controls_section( 'countdown_on_expire_settings', [
			'label' => esc_html__( 'Expire Action', 'epa_elementor' ),
		] );

		$this->add_control( 'countdown_expire_type', [
			'label'       => esc_html__( 'Expire Type', 'epa_elementor' ),
			'label_block' => false,
			'type'        => Controls_Manager::SELECT,
			'description' => esc_html__( 'Choose whether if you want to set a message or a redirect link', 'epa_elementor' ),
			'options'     => [
				'minus'     => esc_html__( 'Minus Value', 'epa_elementor' ),
				'text'     => esc_html__( 'Message', 'epa_elementor' ),
				'url'      => esc_html__( 'Redirection Link', 'epa_elementor' ),
				'template' => esc_html__( 'Saved Templates', 'epa_elementor' ),
			],
			'default'     => 'minus',
		] );

		$this->add_control( 'countdown_expiry_text_title', [
			'label'     => esc_html__( 'On Expiry Title', 'epa_elementor' ),
			'type'      => Controls_Manager::TEXTAREA,
			'default'   => esc_html__( 'Countdown is finished!', 'epa_elementor' ),
			'condition' => [
				'countdown_expire_type' => 'text',
			],
		] );

		$this->add_control( 'countdown_expiry_redirection', [
			'label'     => esc_html__( 'Redirect To (URL)', 'epa_elementor' ),
			'type'      => Controls_Manager::TEXT,
			'condition' => [
				'countdown_expire_type' => 'url',
			],
			'default'   => '#',
		] );

		$this->add_control( 'countdown_expiry_templates', [
			'label'     => __( 'Choose Template', 'epa_elementor' ),
			'type'      => Controls_Manager::SELECT,
			'options'               => epa_get_templates(),
			'condition' => [
				'countdown_expire_type' => 'template',
			],
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'epa_countdown_box_styles_general', [
			'label' => esc_html__( 'Countdown Box Styles', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'epa_countdown_box_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-countdown-wrapper > ul > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'epa_countdown_box_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-countdown-wrapper > ul > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_countdown_box_border',
			'label'    => esc_html__( 'Border', 'epa_elementor' ),
			'selector' => '{{WRAPPER}} .epa-countdown-wrapper > ul > li',
		] );

		$this->add_control( 'epa_countdown_box_border_radius', [
			'label'     => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'      => Controls_Manager::DIMENSIONS,
			'selectors' => [
				'{{WRAPPER}} .epa-countdown-wrapper > ul > li' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
			],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'epa_countdown_box_shadow',
			'selector' => '{{WRAPPER}} .epa-countdown-wrapper > ul > li',
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'epa_countdown_digit_styles_sections', [
			'label' => esc_html__( 'Digit Styles', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'epa_countdown_digit_background', [
			'label'     => esc_html__( 'Digits Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .epa-countdown-wrapper > ul > li' => 'background: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_countdown_digits_color', [
			'label'     => esc_html__( 'Digits Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#fec503',
			'selectors' => [
				'{{WRAPPER}} .epa-countdown-wrapper > ul > li span' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_countdown_digit_typography',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_2,
			'selector' => '{{WRAPPER}} .epa-countdown-wrapper > ul > li span',
		] );

		$this->add_responsive_control( 'epa_countdown_digit_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-countdown-wrapper > ul > li span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'epa_countdown_digit_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-countdown-wrapper > ul > li span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'epa_countdown_label_styles_sections', [
			'label' => esc_html__( 'Label Styles', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'epa_countdown_label_background', [
			'label'     => esc_html__( 'Label Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .epa-countdown-wrapper > ul > li label' => 'background: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_countdown_label_color', [
			'label'     => esc_html__( 'Label Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#fec503',
			'selectors' => [
				'{{WRAPPER}} .epa-countdown-wrapper > ul > li label' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_countdown_label_typography',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_2,
			'selector' => '{{WRAPPER}} .epa-countdown-wrapper > ul > li label',
		] );

		$this->add_responsive_control( 'epa_countdown_label_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-countdown-wrapper > ul > li label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'epa_countdown_label_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-countdown-wrapper > ul > li label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'epa_countdown_separator_styles_sections', [
			'label' => esc_html__( 'Separator Styles', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
            'condition' => [
                    'epa_countdown_separator' => 'epa-countdown-show-separator'
            ]
		] );

		$this->add_control( 'epa_countdown_separator_style1_color', [
			'label'     => esc_html__( 'Separator Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .epa-countdown-wrapper > ul li span::after' => 'color: {{VALUE}};',
			],
			'condition' => [
				'epa_countdown_style' => 'style1'
			]
		] );

		$this->add_control( 'epa_countdown_separator_style2_color', [
			'label'     => esc_html__( 'Separator Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .epa-countdown-wrapper > ul li span::after' => 'background: {{VALUE}};',
			],
			'condition' => [
				'epa_countdown_style' => 'style2'
			]
		] );
		$this->add_responsive_control(
			'epa_countdown_separator_style2_height',
			[
				'label' => esc_html__( 'Separator Height', 'epa_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .epa-countdown-style2 ul li span:after' => 'height:{{SIZE}}px;',
				],
				'condition' => [
					'epa_countdown_style' => 'style2'
				]
			]
		);
		$this->add_responsive_control(
			'epa_countdown_separator_style2_width',
			[
				'label' => esc_html__( 'Separator Width', 'epa_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .epa-countdown-style2 ul li span:after' => 'width:{{SIZE}}px;',
				],
				'condition' => [
					'epa_countdown_style' => 'style2'
				]
			]
		);

		$this->add_responsive_control(
			'epa_countdown_separator_left_space',
			[
				'label' => esc_html__( 'Left spacing for Separator', 'epa_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .epa-countdown-wrapper > ul li span::after' => 'left:{{SIZE}}px;',
				],
				'condition' => [
					'epa_countdown_style' => 'style1'
				]
			]
		);

		$this->add_responsive_control(
			'epa_countdown_separator_top_space',
			[
				'label' => esc_html__( 'Top spacing for Separator', 'epa_elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .epa-countdown-wrapper > ul li span::after' => 'top:{{SIZE}}px;',
				],
				'condition' => [
					'epa_countdown_style' => 'style1'
				]
			]
		);

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_countdown_separator_typography',
			'selector' => '{{WRAPPER}} .epa-countdown-wrapper > ul li span::after',
			'condition' => [
				'epa_countdown_style' => 'style1'
			]
		] );
		$this->end_controls_section();


		$this->start_controls_section( 'epa_countdown_expire_style', [
			'label'     => esc_html__( 'Expire Message', 'epa_elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'countdown_expire_type' => 'text',
			],
		] );

		$this->add_responsive_control( 'epa_countdown_expire_message_alignment', [
			'label'       => esc_html__( 'Text Alignment', 'epa_elementor' ),
			'type'        => Controls_Manager::CHOOSE,
			'label_block' => true,
			'options'     => [
				'left'   => [
					'title' => esc_html__( 'Left', 'epa_elementor' ),
					'icon'  => 'fa fa-align-left',
				],
				'center' => [
					'title' => esc_html__( 'Center', 'epa_elementor' ),
					'icon'  => 'fa fa-align-center',
				],
				'right'  => [
					'title' => esc_html__( 'Right', 'epa_elementor' ),
					'icon'  => 'fa fa-align-right',
				],
			],
			'default'     => 'left',
			'selectors'   => [
				'{{WRAPPER}} #epa-countdown-content-wrapper' => 'text-align: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_countdown_expire_title_color', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} #epa-countdown-content-wrapper h1' => 'color: {{VALUE}};',
			],
			'condition' => [
				'countdown_expire_type' => 'text',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => 'epa_countdown_expire_title_typography',
			'scheme'    => Scheme_Typography::TYPOGRAPHY_2,
			'selector'  => '{{WRAPPER}} #epa-countdown-content-wrapper h1',
			'condition' => [
				'countdown_expire_type' => 'text',
			],
		] );

		$this->add_responsive_control( 'epa_expire_title_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} #epa-countdown-content-wrapper h1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

	}

	protected function render() {
		$enid         = uniqid();
		$settings     = $this->get_settings_for_display();
		$get_due_date = esc_attr( strtolower( $settings['epa_countdown_due_time'] ) );
		$unid         = str_replace( array( ' ', ':', ',' ), '', $get_due_date );

		if ( ! empty( $settings['countdown_expiry_templates'] ) ) {
			$epa_template_id = $settings['countdown_expiry_templates'];
			$epa_frontend    = new Frontend;
			$temp_content =  $epa_frontend->get_builder_content( $epa_template_id, true );
			$temp_cont = !empty($temp_content) ? $temp_content : '';
		}

		?>

        <div id="epa-countdown-wrapper-<?php echo $unid; ?>" class="epa-countdown-wrapper <?php echo $settings['epa_countdown_separator']; ?> <?php echo $settings['epa_countdown_label_position']; ?> epa-countdown-<?php echo $settings['epa_countdown_style']; ?>" data-id="<?php echo $get_due_date; ?>">

            <ul>
				<?php if ( $settings['epa_countdown_year'] == 'yes' ) : ?>
                    <li><span id="year<?php echo $enid; ?>"></span><label><?php echo $settings['epa_countdown_year_label']; ?></label></li>
				<?php endif; ?>
	            <?php if ( $settings['epa_countdown_month'] == 'yes' ) : ?>
                <li><span id="month<?php echo $enid; ?>"></span><label><?php echo $settings['epa_countdown_month_label']; ?></label></li>
	            <?php endif; ?>

	            <?php if ( $settings['epa_countdown_weeks'] == 'yes' ) : ?>
                <li><span id="weeks<?php echo $enid; ?>"></span>
                    <label><?php echo $settings['epa_countdown_weeks_label']; ?></label>
                </li>
	            <?php endif; ?>

	            <?php if ( $settings['epa_countdown_days'] == 'yes' ) : ?>
                <li><span id="days-<?php echo $enid; ?>"></span>
                    <label><?php echo $settings['epa_countdown_days_label']; ?></label>
                </li>
	            <?php endif; ?>
                <li><span id="hours-<?php echo $enid; ?>"></span>
                    <label>Hours</label>
                </li>
                <li><span id="minutes-<?php echo $enid; ?>"></span>
                    <label>Minutes</label>
                </li>
                <li><span id="seconds-<?php echo $enid; ?>"></span>
                    <label>Seconds</label>
                </li>
            </ul>
        </div>

        <div id="epa-countdown-content-wrapper" data-template='<?php echo $temp_cont; ?>'>

        </div>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                var second = 1000,
                    minute = second * 60,
                    hour = minute * 60,
                    day = hour * 24,
                    week = day * 7,
                    month = week * 4.34524,
                    year = week * 52.1429;

                var coundDown = $("#epa-countdown-wrapper-<?php echo $unid; ?>").data("id");
                var countDown = new Date(coundDown).getTime(),
                    x = setInterval(function () {

                        var now = new Date().getTime(),
                            distance = countDown - now;
						<?php if($settings['epa_countdown_year'] == 'yes') : ?>
                        document.getElementById('year<?php echo $enid; ?>').innerText = Math.floor(distance / (year)),
						<?php endif; ?>
                        <?php if ( $settings['epa_countdown_month'] == 'yes' ) : ?>
                            document.getElementById('month<?php echo $enid; ?>').innerText = Math.floor(distance / (month)),
                        <?php endif; ?>
                        <?php if ( $settings['epa_countdown_weeks'] == 'yes' ) : ?>
                            document.getElementById('weeks<?php echo $enid; ?>').innerText = Math.floor(distance / (week)),
                        <?php endif; ?>
                        <?php if ( $settings['epa_countdown_days'] == 'yes' ) : ?>
                            document.getElementById('days-<?php echo $enid; ?>').innerText = Math.floor(distance / (day)),
                        <?php endif; ?>

                            document.getElementById('hours-<?php echo $enid; ?>').innerText = Math.floor((distance % (day)) / (hour)),
                            document.getElementById('minutes-<?php echo $enid; ?>').innerText = Math.floor((distance % (hour)) / (minute)),
                            document.getElementById('seconds-<?php echo $enid; ?>').innerText = Math.floor((distance % (minute)) / second);

                        <?php if($settings['countdown_expire_type'] == 'text') : ?>
                        if (distance < 0) {
                            clearInterval(x);
                            document.getElementById('epa-countdown-wrapper-<?php echo $unid; ?>').style.display = "none";
                            document.getElementById("epa-countdown-content-wrapper").innerHTML = "<h1><?php echo $settings['countdown_expiry_text_title']; ?></h1>";
                        }
                        <?php endif; ?>

                         <?php if($settings['countdown_expire_type'] == 'url') : ?>
                        if (distance < 0) {
                            window.location.replace("<?php echo $settings['countdown_expiry_redirection']; ?>");
                        }
                        <?php endif; ?>

                        <?php if( $settings['countdown_expire_type'] == 'template') : ?>
                        if (distance < 0) {
                            clearInterval(x);
                            document.getElementById('epa-countdown-wrapper-<?php echo $unid; ?>').style.display = "none";

                            var templatecont = $("#epa-countdown-content-wrapper").data("template");
                            document.getElementById("epa-countdown-content-wrapper").innerHTML = templatecont;
                        }
                        <?php endif; ?>

                    }, second)
            });
        </script>

		<?php
	}

	protected function _content_template() {
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Epa_countdown() );