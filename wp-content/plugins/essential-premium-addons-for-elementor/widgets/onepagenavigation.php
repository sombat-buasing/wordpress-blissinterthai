<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Epa_onepagenavigation extends Widget_Base {

	public function get_name() {
		return 'epa-onepagenavigation';
	}

	public function get_title() {
		return esc_html__( 'One Page Navigation', 'epa_elementor' );
	}

	public function get_icon() {
		return 'eicon-navigation-vertical wfe-ccn-pe';
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
		$this->start_controls_section( 'section_nav_dots', [
			'label' => esc_html__( 'Content', 'epa_elementor' ),
		] );

		$repeater = new Repeater();
		$repeater->add_control( 'epa_opn_content_type', [
			'label'   => esc_html__( 'Content Type', 'epa_elementor' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'ids'       => esc_html__( 'Section ID', 'epa_elementor' ),
				'templates' => esc_html__( 'Elementor Templates', 'epa_elementor' ),
			],
			'default' => 'ids',
		] );

		$repeater->add_control( 'section_id', [
			'label'     => esc_html__( 'Section ID', 'epa_elementor' ),
			'type'      => Controls_Manager::TEXT,
			'default'   => '',
			'condition' => [
				'epa_opn_content_type' => 'ids',
			],
		] );


		$repeater->add_control( 'opn_template', [
			'label'     => esc_html__( 'Choose Template', 'epa_elementor' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => epa_get_templates(),
			'condition' => [
				'epa_opn_content_type' => 'templates',
			],
		] );
		$repeater->add_control( 'epa_opn_navigation_type', [
			'label'   => esc_html__( 'Navigation Type', 'epa_elementor' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'icon' => esc_html__( 'Icon', 'epa_elementor' ),
				'text' => esc_html__( 'Text', 'epa_elementor' ),
			],
			'default' => 'icon',
		] );
		$repeater->add_control( 'navigation_icon', [
			'label'     => esc_html__( 'Navigation Dot', 'epa_elementor' ),
			'type'      => Controls_Manager::ICON,
			'default'   => 'fa fa-circle',
			'condition' => [
				'epa_opn_navigation_type' => 'icon',
			],
		] );
		$repeater->add_control( 'navigation_text', [
			'label'     => esc_html__( 'Navigation Text', 'epa_elementor' ),
			'type'      => Controls_Manager::TEXT,
			'default'   => 'Section 1',
			'condition' => [
				'epa_opn_navigation_type' => 'text',
			],
		] );
		$repeater->add_control( 'epa_opn_tooltip_show', [
			'label'        => esc_html__( 'Enable Tooltip', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'return_value' => 'yes',
		] );
		$repeater->add_control( 'tooltip_section_title', [
			'label'     => esc_html__( 'Tooltip Title', 'epa_elementor' ),
			'type'      => Controls_Manager::TEXT,
			'default'   => esc_html__( 'Tooltip Title', 'epa_elementor' ),
			'condition' => [
				'epa_opn_tooltip_show' => 'yes',
			],
		] );

		$this->add_control( 'epa_opn_content', [
			'label'       => '',
			'type'        => Controls_Manager::REPEATER,
			'default'     => [
				[
					'tooltip_section_title' => esc_html__( 'Section #1', 'epa_elementor' ),
					'section_id'            => 'section-1',
					'dot_icon'              => 'fa fa-circle',
				],
				[
					'tooltip_section_title' => esc_html__( 'Section #2', 'epa_elementor' ),
					'section_id'            => 'section-2',
					'dot_icon'              => 'fa fa-circle',
				],
				[
					'tooltip_section_title' => esc_html__( 'Section #3', 'epa_elementor' ),
					'section_id'            => 'section-3',
					'dot_icon'              => 'fa fa-circle',
				],
			],
			'fields'      => array_values( $repeater->get_controls() ),
			'title_field' => '{{{ tooltip_section_title }}}',
		] );

		$this->end_controls_section();
		$this->start_controls_section( 'onepage_navigation_settings', [
			'label' => __( 'Navigation', 'epa_elementor' ),
		] );

		$this->add_responsive_control( 'epa_opn_navigation_alignment', [
			'label'        => esc_html__( 'Navigation Alignment', 'epa_elementor' ),
			'type'         => Controls_Manager::CHOOSE,
			'label_block'  => true,
			'options'      => [
				'left'  => [
					'title' => esc_html__( 'Left', 'epa_elementor' ),
					'icon'  => 'fa fa-align-left',
				],
				'right' => [
					'title' => esc_html__( 'Right', 'epa_elementor' ),
					'icon'  => 'fa fa-align-right',
				],
			],
			'default'      => 'right',
			'prefix_class' => 'epa-opn-align-',
		] );
		$this->add_responsive_control( 'epa_opn_navigation_position', [
			'label'        => esc_html__( 'Navigation Position', 'epa_elementor' ),
			'type'         => Controls_Manager::SELECT,
			'label_block'  => true,
			'options'      => [
				'top'    => esc_html__( 'Top', 'epa_elementor' ),
				'middle' => esc_html__( 'Middle', 'epa_elementor' ),
				'bottom' => esc_html__( 'Bottom', 'epa_elementor' ),
			],
			'default'      => 'middle',
			'prefix_class' => 'epa-opn-position-',
		] );

		$this->end_controls_section();

		/**
		 * Content Tab: Settings
		 */
		$this->start_controls_section( 'section_onepage_nav_settings', [
			'label' => esc_html__( 'Settings', 'epa_elementor' ),
		] );

		$this->add_control( 'scrolling_speed', [
			'label'       => esc_html__( 'Scrolling Speed', 'epa_elementor' ),
			'type'        => Controls_Manager::NUMBER,
			'description' => 'scroll animation speed in milliseconds, Default 1000',
			'default'     => '1000',
		] );

		$this->end_controls_section();

		/*-----------------------------------------------------------------------------------*/
		/*	STYLE TAB
		/*-----------------------------------------------------------------------------------*/

		$this->start_controls_section( 'navigation_style', [
				'label' => esc_html__( 'Navigation Dots', 'epa_elementor' ),
				'tab'   => CONTROLS_MANAGER::TAB_STYLE,
			] );

		$this->start_controls_tabs( 'navigation_style_tabs' );

		$this->start_controls_tab( 'tooltips_style_tab', [
				'label'     => esc_html__( 'Tooltips', 'epa_elementor' ),
			] );

		$this->add_control( 'tooltips_color', [
				'label'     => esc_html__( 'Tooltips Text Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} #opntooltip::after' => 'color: {{VALUE}};',
				],
			] );

		$this->add_control( 'tooltips_background', [
				'label'     => esc_html__( 'Tooltips Background', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => [
					'{{WRAPPER}} #opntooltip::after'  => 'background-color: {{VALUE}};',
					'{{WRAPPER}} #opntooltip::before' => 'border-left-color: {{VALUE}}; border-right-color: {{VALUE}};',
				],
			] );

		$this->add_control( 'tooltips_border_radius', [
				'label'      => esc_html__( 'Border Radius', 'epa_elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} #opntooltip::after' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
				'name'      => 'tooltips_shadow',
				'selector'  => '{{WRAPPER}} #opntooltip::after',
			] );


		$this->end_controls_tab();

		$this->start_controls_tab( 'dots_style_tab', [
				'label' => esc_html__( 'Dots', 'epa_elementor' ),
			] );

		$this->add_control( 'dots_color', [
				'label'     => esc_html__( 'Dots Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default' => '#6b6977',
				'selectors' => [
					'{{WRAPPER}} #epa-opn-menu a._mPS2id-h' => 'color: {{VALUE}};',
				],
			] );

		$this->add_control( 'active_dot_color', [
				'label'     => esc_html__( 'Active Dot Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default' => '#d3008d',
				'selectors' => [
					'{{WRAPPER}} #epa-opn-menu a.mPS2id-highlight' => 'color: {{VALUE}};',
				],
			] );
		$this->add_control( 'dots_bg_color', [
			'label'     => esc_html__( 'Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} #epa-opn-menu li' => 'background-color: {{VALUE}};',
			],
		] );
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'opn_dot_typography',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} #epa-opn-menu a._mPS2id-h'
		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_opn_dot_border',
			'label'    => esc_html__( 'Border', 'epa_elementor' ),
			'selector' => '{{WRAPPER}} #epa-opn-menu li',
		] );
		$this->add_control( 'epa_opn_border_dot_radius', [
			'label'     => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} #epa-opn-menu li' => 'border-radius: {{SIZE}}px;',
			],
		] );

		$this->add_responsive_control( 'epa_opn_dot_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} #epa-opn-menu li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'container_style_tab', [
				'label' => esc_html__( 'Container', 'epa_elementor' ),
			] );

		$this->add_control( 'navigation_background', [
				'label'     => esc_html__( 'Background Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default' => '#dddddd',
				'selectors' => [
					'{{WRAPPER}} #epa-opn-menu ul' => 'background-color: {{VALUE}}',
				],
			] );

		$this->add_control( 'navigation_border_radius', [
				'label'      => esc_html__( 'Border Radius', 'epa_elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} #epa-opn-menu ul' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
				'label'    => esc_html__( 'Shadow', 'epa_elementor' ),
				'name'     => 'navigation_box_shadow',
				'selector' => '{{WRAPPER}} #epa-opn-menu ul',
			] );

		$this->add_responsive_control( 'epa_opn_dot_container_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} #epa-opn-menu ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$output   = '';
		$this->add_render_attribute( 'one-page-navigation', 'class', 'epa-opn-wrapper' );
		$this->add_render_attribute( 'one-page-navigation', 'data-opnid', esc_attr( $this->get_id() ) );
		$this->add_render_attribute( 'one-page-navigation', 'data-scroll-speed', wp_kses_post( $settings['scrolling_speed'] ) );
		?>
    <div <?php echo $this->get_render_attribute_string( 'one-page-navigation' ); ?> id="opn-<?php echo $this->get_id(); ?>">
            <div id="epa-opn-menu">
                <ul>
		<?php
		$navid = 1;
		foreach ( $settings['epa_opn_content'] as $navitem ) {

			$datapos_align = $settings['epa_opn_navigation_alignment'] == "left" ? 'right' : 'left';
			$datatooltip   = $navitem['epa_opn_tooltip_show'] == 'yes' ? 'id="opntooltip" data-balloon="' . esc_html__($navitem['tooltip_section_title']) . '" data-balloon-pos="' . $datapos_align . '"' : '';

			if ( $navitem['epa_opn_navigation_type'] == 'text' && $navitem['epa_opn_content_type'] == 'templates' ) {
				$output .= '<li ' . $datatooltip . '><a href="#section-' . $navid . '">' . esc_html__($navitem['navigation_text']) . '</a></li>';

			}
			if ( $navitem['epa_opn_navigation_type'] == 'icon' && $navitem['epa_opn_content_type'] == 'templates' ) {
				$output .= '<li ' . $datatooltip . '><a href="#section-' . $navid . '"><span id="opntipso" class="' . $navitem['navigation_icon'] . '" data-tipso="top-right"></span></a></li>';
			}

			if ( $navitem['epa_opn_navigation_type'] == 'text' && $navitem['epa_opn_content_type'] == 'ids' ) {
				$output .= '<li ' . $datatooltip . '><a href="#' . esc_html__($navitem['section_id']) . '">
' . $navitem['navigation_text'] . '</a></li>';
			}
			if ( $navitem['epa_opn_navigation_type'] == 'icon' && $navitem['epa_opn_content_type'] == 'ids' ) {
				$output .= '<li ' . $datatooltip . '><a href="#' . esc_html__($navitem['section_id']) . '"><span class="' . $navitem['navigation_icon'] . '"></span></a></li>';
			}
			$navid ++;
		}
		$output .= '</ul>
		</div>
		<div id="content">';
		$opnid  = 1;
		foreach ( $settings['epa_opn_content'] as $opnitem ) {
			if ( $opnitem['epa_opn_content_type'] == 'templates' ) {
				$output .= '<section id="section-' . $opnid . '">';
				if ( ! empty( $opnitem['opn_template'] ) ) {
					$epa_template_id = $opnitem['opn_template'];
					$epa_frontend    = new Frontend;
					$output          .= $epa_frontend->get_builder_content( $epa_template_id, true );
				}
				$output .= '</section>';
			}
			$opnid ++;
		}

		$output .= '</div></div>';
		echo $output;
	}

	protected function _content_template() {
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Epa_onepagenavigation() );