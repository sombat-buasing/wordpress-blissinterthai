<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Epa_tooltip extends Widget_Base {

	public function get_name() {
		return 'epa_tooltip';
	}

	public function get_title() {
		return __( 'Tooltip', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'eicon-button wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {
		/**
		 * Tooltip Settings
		 */
		$this->start_controls_section( 'epa_tooltip_settings_section', [
			'label' => esc_html__( 'Content Settings', 'epa_elementor' ),
		] );
		$this->add_responsive_control( 'epa_tooltip_type', [
			'label'       => esc_html__( 'Content Type', 'epa_elementor' ),
			'type'        => Controls_Manager::CHOOSE,
			'label_block' => true,
			'options'     => [
				'icon'      => [
					'title' => esc_html__( 'Icon', 'epa_elementor' ),
					'icon'  => 'fa fa-info',
				],
				'text'      => [
					'title' => esc_html__( 'Text', 'epa_elementor' ),
					'icon'  => 'fa fa-text-width',
				],
				'image'     => [
					'title' => esc_html__( 'Image', 'epa_elementor' ),
					'icon'  => 'fa fa-image',
				],
				'shortcode' => [
					'title' => esc_html__( 'Shortcode', 'epa_elementor' ),
					'icon'  => 'fa fa-code',
				],
			],
			'default'     => 'icon',
		] );
		$this->add_control( 'epa_tooltip_content', [
			'label'       => esc_html__( 'Content', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXTAREA,
			'label_block' => true,
			'default'     => esc_html__( 'Hover Me!', 'epa_elementor' ),
			'condition'   => [
				'epa_tooltip_type' => [ 'text' ],
			],
			'dynamic'     => [ 'active' => true ],
		] );
		$this->add_control( 'epa_tooltip_content_tag', [
			'label'       => esc_html__( 'Content Tag', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT,
			'default'     => 'span',
			'label_block' => false,
			'options'     => [
				'h1'   => esc_html__( 'H1', 'epa_elementor' ),
				'h2'   => esc_html__( 'H2', 'epa_elementor' ),
				'h3'   => esc_html__( 'H3', 'epa_elementor' ),
				'h4'   => esc_html__( 'H4', 'epa_elementor' ),
				'h5'   => esc_html__( 'H5', 'epa_elementor' ),
				'h6'   => esc_html__( 'H6', 'epa_elementor' ),
				'div'  => esc_html__( 'DIV', 'epa_elementor' ),
				'span' => esc_html__( 'SPAN', 'epa_elementor' ),
				'p'    => esc_html__( 'P', 'epa_elementor' ),
			],
			'condition'   => [
				'epa_tooltip_type' => 'text',
			],
		] );
		$this->add_control( 'epa_tooltip_shortcode_content', [
			'label'       => esc_html__( 'Shortcode', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXTAREA,
			'label_block' => true,
			'default'     => esc_html__( '[shortcode-here]', 'epa_elementor' ),
			'condition'   => [
				'epa_tooltip_type' => [ 'shortcode' ],
			],
		] );
		$this->add_control( 'epa_tooltip_icon_content', [
			'label'     => esc_html__( 'Icon', 'epa_elementor' ),
			'type'      => Controls_Manager::ICON,
			'default'   => 'fa fa-home',
			'condition' => [
				'epa_tooltip_type' => [ 'icon' ],
			],
		] );
		$this->add_control( 'epa_tooltip_img_content', [
			'label'     => esc_html__( 'Image', 'epa_elementor' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => Utils::get_placeholder_image_src(),
			],
			'condition' => [
				'epa_tooltip_type' => [ 'image' ],
			],
		] );
		$this->add_responsive_control( 'epa_tooltip_content_alignment', [
			'label'        => esc_html__( 'Content Alignment', 'epa_elementor' ),
			'type'         => Controls_Manager::CHOOSE,
			'label_block'  => true,
			'options'      => [
				'left'    => [
					'title' => esc_html__( 'Left', 'epa_elementor' ),
					'icon'  => 'fa fa-align-left',
				],
				'center'  => [
					'title' => esc_html__( 'Center', 'epa_elementor' ),
					'icon'  => 'fa fa-align-center',
				],
				'right'   => [
					'title' => esc_html__( 'Right', 'epa_elementor' ),
					'icon'  => 'fa fa-align-right',
				],
				'justify' => [
					'title' => __( 'Justified', 'epa_elementor' ),
					'icon'  => 'fa fa-align-justify',
				],
			],
			'default'      => 'left',
			'prefix_class' => 'epa-tooltip-align-',
		] );
		/*		$this->add_control( 'epa_tooltip_enable_link', [
						'label'        => esc_html__( 'Enable Link', 'epa_elementor' ),
						'type'         => Controls_Manager::SWITCHER,
						'default'      => 'false',
						'return_value' => 'yes',
						'condition'    => [
							'epa_tooltip_type!' => [ 'shortcode' ],
						],
					] );
				$this->add_control( 'epa_tooltip_link', [
						'label'         => esc_html__( 'Button Link', 'epa_elementor' ),
						'type'          => Controls_Manager::URL,
						'label_block'   => true,
						'default'       => [
							'url'         => '#',
							'is_external' => '',
						],
						'show_external' => true,
						'condition'     => [
							'epa_tooltip_enable_link' => 'yes',
						],
					] );*/
		$this->end_controls_section();

		/**
		 * Tooltip Hover Content Settings
		 */
		$this->start_controls_section( 'epa_tooltip_section_settings', [
			'label' => esc_html__( 'Tooltip Settings', 'epa_elementor' ),
		] );
		$this->add_control( 'epa_tooltip_title_show_hide', [
			'label'        => esc_html__( 'Show Title?', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'description'  => 'Show tooltip title, it will appear avobe tooltip hover content',
			'label_on'     => esc_html__( 'Yes', 'epa_elementor' ),
			'label_off'    => esc_html__( 'No', 'epa_elementor' ),
			'return_value' => 'yes',
		] );
		$this->add_control( 'epa_tooltip_title', [
			'label'       => esc_html__( 'Tooltip Title', 'epa_elementor' ),
			'default'     => 'Title Here',
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'condition'   => [
				'epa_tooltip_title_show_hide' => 'yes',
			],
		] );
		$this->add_control( 'epa_tooltip_hover_content', [
			'label'       => esc_html__( 'Tooltip Content', 'epa_elementor' ),
			'type'        => Controls_Manager::WYSIWYG,
			'label_block' => true,
			'default'     => esc_html__( 'Tooltip content', 'epa_elementor' ),
			'dynamic'     => [ 'active' => true ],
		] );
		$this->add_control( 'epa_tooltip_position', [
			'label'       => esc_html__( 'Tooltip Position', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT,
			'default'     => 'right',
			'label_block' => false,
			'options'     => [
				'left'   => esc_html__( 'Left', 'epa_elementor' ),
				'right'  => esc_html__( 'Right', 'epa_elementor' ),
				'top'    => esc_html__( 'Top', 'epa_elementor' ),
				'bottom' => esc_html__( 'Bottom', 'epa_elementor' ),
			],
		] );
		$this->add_control( 'epa_tooltip_speed', [
			'label'       => esc_html__( 'Tooltip Speed', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => false,
			'default'     => esc_html__( '300', 'epa_elementor' ),
		] );
		$this->add_control( 'epa_tooltip_show_arrow', [
			'label'        => esc_html__( 'Show Arrow?', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'true',
			'return_value' => 'true',
		] );
		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style Tooltip Content
		 * -------------------------------------------
		 */
		$this->start_controls_section( 'epa_tooltip_style_settings_section', [
			'label' => esc_html__( 'Content Style', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );
		$this->add_responsive_control( 'epa_tooltip_contaier_width', [
			'label'      => __( 'Content Max Width', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 1000,
					'step' => 5,
				],
				'%'  => [
					'min' => 0,
					'max' => 100,
				],
			],
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa_tooltip_content' => 'width: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .epa_tooltip_content i' => 'width: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .epa_tooltip_content span' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );
		$this->add_responsive_control( 'epa_tooltip_content_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa_tooltip_content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				'{{WRAPPER}} .epa_tooltip_content i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				'{{WRAPPER}} .epa_tooltip_content span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				'{{WRAPPER}} .epa_tooltip_content span img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->add_responsive_control( 'epa_tooltip_content_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa_tooltip_content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->start_controls_tabs( 'epa_tooltip_content_style_tabs' );
		// Normal State Tab
		$this->start_controls_tab( 'epa_tooltip_content_normal', [ 'label' => esc_html__( 'Normal', 'epa_elementor' ) ] );
		$this->add_control( 'epa_tooltip_content_bg_color', [
			'label'     => esc_html__( 'Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .epa_tooltip_content' => 'background-color: {{VALUE}};',
			],
		] );
		$this->add_control( 'epa_tooltip_content_color', [
			'label'     => esc_html__( 'Text Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .epa_tooltip_content'   => 'color: {{VALUE}};',
			],
		] );
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'      => 'epa_tooltip_shadow',
			'selector'  => '{{WRAPPER}} .epa_tooltip_content',
			'separator' => 'before',
		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_tooltip_border',
			'label'    => esc_html__( 'Border', 'epa_elementor' ),
			'selector' => '{{WRAPPER}} .epa_tooltip_content',
		] );
		$this->end_controls_tab();

		// Hover State Tab
		$this->start_controls_tab( 'epa_tooltip_content_hover', [ 'label' => esc_html__( 'Hover', 'epa_elementor' ) ] );
		$this->add_control( 'epa_tooltip_content_hover_bg_color', [
			'label'     => esc_html__( 'Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .epa_tooltip_content:hover' => 'background-color: {{VALUE}};',
			],
		] );
		$this->add_control( 'epa_tooltip_content_hover_color', [
			'label'     => esc_html__( 'Text Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#212121',
			'selectors' => [
				'{{WRAPPER}} .epa_tooltip_content:hover i'   => 'color: {{VALUE}};',
			],
		] );
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'      => 'epa_tooltip_hover_shadow',
			'selector'  => '{{WRAPPER}} .epa_tooltip_content:hover',
			'separator' => 'before',
		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_tooltip_hover_border',
			'label'    => esc_html__( 'Border', 'epa_elementor' ),
			'selector' => '{{WRAPPER}} .epa_tooltip_content:hover',
		] );
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_tooltip_content_typography',
			'selector' => '{{WRAPPER}} .epa_tooltip_content',
		] );
		$this->add_responsive_control( 'epa_tooltip_content_radius', [
			'label'      => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa_tooltip_content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style Tooltip Hover Content
		 * -------------------------------------------
		 */
		$this->start_controls_section( 'epa_tooltip_hover_style_settings_section', [
			'label' => esc_html__( 'Tooltip Style', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );
		$this->add_responsive_control( 'epa_tooltip_hover_width', [
			'label'      => __( 'Tooltip Width', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'size' => '150',
			],
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 1000,
					'step' => 5,
				],
			],
		] );
		$this->add_control( 'epa_tooltip_size', [
			'label'   => esc_html__( 'Tooltip Bubble size', 'epa_elementor' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'tiny' => esc_html__( 'Tiny', 'epa_elementor' ),
				'small'  => esc_html__( 'Small', 'epa_elementor' ),
				'default'  => esc_html__( 'Default', 'epa_elementor' ),
				'large'  => esc_html__( 'Large', 'epa_elementor' ),
			],
			'default' => 'default',
		] );
		$this->add_control( 'epa_tooltip_title_heading', [
			'label' => esc_html__( 'Tooltip Title Style', 'epa_elementor' ),
			'type'  => Controls_Manager::HEADING,
		] );
		$this->add_control( 'epa_tooltip_hover_title_color', [
			'label'     => esc_html__( 'Title Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#fff',
		] );
		$this->add_control( 'epa_tooltip_hover_title_bg_color', [
			'label'     => esc_html__( 'Title Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#474747',
		] );
		$this->add_control( 'epa_tooltip_bg_heading', [
			'label' => esc_html__( 'Tooltip Background Style', 'epa_elementor' ),
			'type'  => Controls_Manager::HEADING,
		] );
		$this->add_control( 'epa_tooltip_hover_content_color', [
			'label'     => esc_html__( 'Text Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#fff',
		] );
		$this->add_control( 'epa_tooltip_hover_content_bg_color', [
			'label'     => esc_html__( 'Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#00ad0e',
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute( 'epa-tooltip', 'class', 'epa-tooltips-wrapper' );
		$this->add_render_attribute( 'epa-tooltip', 'data-tooltip-id', esc_attr( $this->get_id() ) );

		if ( ! empty( $settings['epa_tooltip_title_show_hide'] ) ) {
			$this->add_render_attribute( 'epa-tooltip', 'data-tooltip-title', wp_kses_post( $settings['epa_tooltip_title'] ) );
		}
		if ( ! empty( $settings['epa_tooltip_hover_content'] ) ) {
			$this->add_render_attribute( 'epa-tooltip', 'data-tooltip-content', wp_kses_post('<div class="epa_tp_content">'.$settings['epa_tooltip_hover_content'].'</div>') );
		}
		if ( ! empty( $settings['epa_tooltip_speed'] ) ) {
			$this->add_render_attribute( 'epa-tooltip', 'data-tooltip-speed', wp_kses_post( $settings['epa_tooltip_speed'] ) );
		}
		if ( ! empty( $settings['epa_tooltip_position'] ) ) {
			$this->add_render_attribute( 'epa-tooltip', 'data-tooltip-position', wp_kses_post( $settings['epa_tooltip_position'] ) );
		}
		if ( ! empty( $settings['epa_tooltip_show_arrow'] ) ) {
			$showarrow = $settings['epa_tooltip_show_arrow'] == 'true' ? 'true' : 'false';
			$this->add_render_attribute( 'epa-tooltip', 'data-tooltip-arrow', wp_kses_post( $showarrow ) );
		}


		/*
		 * Tooltip Style jquery
		 * */
		$this->add_render_attribute( 'epa-tooltip', 'data-tooltip-width', wp_kses_post( $settings['epa_tooltip_hover_width']['size'] ) );
		$this->add_render_attribute( 'epa-tooltip', 'data-tooltip-color', wp_kses_post( $settings['epa_tooltip_hover_content_color'] ) );
		$this->add_render_attribute( 'epa-tooltip', 'data-tooltip-bgcolor', wp_kses_post( $settings['epa_tooltip_hover_content_bg_color'] ) );
		$this->add_render_attribute( 'epa-tooltip', 'data-tooltip-title-color', wp_kses_post( $settings['epa_tooltip_hover_title_color'] ) );
		$this->add_render_attribute( 'epa-tooltip', 'data-tooltip-title-bgcolor', wp_kses_post( $settings['epa_tooltip_hover_title_bg_color'] ) );
		$this->add_render_attribute( 'epa-tooltip', 'data-tooltip-size', wp_kses_post( $settings['epa_tooltip_size'] ) );

		?>
    <div <?php echo $this->get_render_attribute_string( 'epa-tooltip' ); ?>>
        <!-- Tooltip Content Item Icon -->
		<?php if ( $settings['epa_tooltip_type'] == 'icon' ) : ?>
            <div class="epa_tooltip_content">
                <i class="<?php echo $settings['epa_tooltip_icon_content']; ?>" id="tipso-<?php echo esc_attr( $this->get_id() ); ?>"></i>
            </div>
		<?php endif; ?>
        <!-- Tooltip Content Item Text -->
		<?php if ( $settings['epa_tooltip_type'] == 'text' ) : ?>
            <div class="epa_tooltip_content">
            <<?php echo esc_attr( $settings['epa_tooltip_content_tag'] ) ?> id="tipso-<?php echo esc_attr( $this->get_id() ) ?>"><?php echo esc_html__( $settings['epa_tooltip_content'] ) ?></<?php echo esc_attr( $settings['epa_tooltip_content_tag'] ) ?>>
            </div>
		<?php endif; ?>
        <!-- Tooltip Content Item Image -->
		<?php if ( $settings['epa_tooltip_type'] == 'image' ) : ?>
            <div class="epa_tooltip_content">
            <span><img src="<?php echo esc_url( $settings['epa_tooltip_img_content']['url'] ); ?>" id="tipso-<?php echo esc_attr( $this->get_id() ) ?>" alt="<?php echo esc_attr( $settings['epa_tooltip_content'] ); ?>"></span>
            </div>
		<?php endif; ?>
        <!-- Tooltip Content Item Shortcode -->
		<?php if ( $settings['epa_tooltip_type'] == 'shortcode' ) : ?>
            <div class="epa_tooltip_content">
            <span class="epa_shortcode_con" id="tipso-<?php echo esc_attr( $this->get_id() ) ?>"><?php echo do_shortcode($settings['epa_tooltip_shortcode_content']); ?></span>
            </div>
		<?php endif; ?>

        </div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Epa_tooltip() );