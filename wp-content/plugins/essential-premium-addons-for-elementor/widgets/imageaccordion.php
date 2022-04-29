<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Epa_imageaccordion extends Widget_Base {

	public function get_name() {
		return 'epa-imageaccordion';
	}

	public function get_title() {
		return __( 'Image Accordion', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'eicon-call-to-action wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {
		/**
		 * Advance Accordion Settings
		 */
		$this->start_controls_section( 'epa_section_accordion_settings', [
			'label' => esc_html__( 'General Settings', 'epa_elementor' ),
		] );
		$this->add_control( 'epa_accordion_type', [
			'label'       => esc_html__( 'Accordion Type', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT,
			'default'     => 'accordion',
			'label_block' => false,
			'options'     => [
				'accordion' => esc_html__( 'Accordion', 'epa_elementor' ),
				'toggle'    => esc_html__( 'Toggle', 'epa_elementor' ),
			],
		] );
		$this->add_control( 'epa_accordion_action', [
			'label'       => esc_html__( 'Accordion Action', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT,
			'default'     => 'click',
			'label_block' => false,
			'options'     => [
				'click' => esc_html__( 'Click', 'epa_elementor' ),
				'hover' => esc_html__( 'Hover', 'epa_elementor' ),
			],
		] );
		$this->add_control( 'epa_accordion_position', [
			'label'       => esc_html__( 'Accordion Position', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT,
			'default'     => 'margin: 0 auto',
			'label_block' => false,
			'options'     => [
				''               => esc_html__( 'Left', 'epa_elementor' ),
				'margin: 0 auto' => esc_html__( 'Center', 'epa_elementor' ),
			],
			'selectors'   => [
				'{{WRAPPER}} #epa_imgaccordion_wrapper .epa_imgaccordion' => '{{VALUE}};',
			],
		] );

		$this->end_controls_section();

		/**
		 * Advance Accordion Content Settings
		 */
		$this->start_controls_section( 'eael_section_adv_accordion_content_settings', [
			'label' => esc_html__( 'Accordion Content', 'epa_elementor' ),
		] );
		$this->add_control( 'epa_accordion_tab', [
			'type'        => Controls_Manager::REPEATER,
			'seperator'   => 'before',
			'default'     => [
				[ 'epa_accordion_title' => esc_html__( 'Title 1', 'epa_elementor' ) ],
				[ 'epa_accordion_title' => esc_html__( 'Title 2', 'epa_elementor' ) ],
				[ 'epa_accordion_title' => esc_html__( 'Title 3', 'epa_elementor' ) ],
			],
			'fields'      => [
				[
					'name'        => 'epa_accordion_bg',
					'label'       => esc_html__( 'Background Image', 'essential-addons-elementor' ),
					'type'        => Controls_Manager::MEDIA,
					'label_block' => true,
					'default'     => [
						'url' => Utils::get_placeholder_image_src(),
					],
					//'default' => [
					//'url' => ESSENTIAL_ADDONS_EL_URL . 'assets/img/accordion.png',
					//],
				],
				[
					'name'    => 'epa_accordion_title',
					'label'   => esc_html__( 'Tab Title', 'epa_elementor' ),
					'type'    => Controls_Manager::TEXT,
					'default' => esc_html__( 'Tab Title', 'epa_elementor' ),
					'dynamic' => [ 'active' => true ],
				],

				[
					'name'    => 'epa_accordion_content',
					'label'   => esc_html__( 'Tab Content', 'epa_elementor' ),
					'type'    => Controls_Manager::WYSIWYG,
					'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'epa_elementor' ),
					'dynamic' => [ 'active' => true ],
				],
				[
					'name'         => 'epa_accordion_button',
					'label'        => esc_html__( 'Active Button', 'epa_elementor' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'no',
					'return_value' => 'yes',
				],
				[
					'name'        => 'epa_accordion_button_text',
					'label'       => __( 'Button Text', 'epa_elementor' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => 'MORE',
					'condition'   => [ 'epa_accordion_button' => 'yes' ],
					'placeholder' => __( 'Enter button text', 'epa_elementor' ),
					'title'       => __( 'Enter button text here', 'epa_elementor' ),
				],
				[
					'name'        => 'epa_accordion_button_link_url',
					'label'       => __( 'Link URL', 'epa_elementor' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => '#',
					'condition'   => [ 'epa_accordion_button' => 'yes' ],
					'placeholder' => __( 'Enter link URL for the button', 'epa_elementor' ),
					'title'       => __( 'Enter heading for the button', 'epa_elementor' ),
				],
				[
					'name'      => 'epa_accordion_button_link_target',
					'label'     => esc_html__( 'Open in new window?', 'epa_elementor' ),
					'type'      => Controls_Manager::SWITCHER,
					'label_on'  => __( '_blank', 'epa_elementor' ),
					'label_off' => __( '_self', 'epa_elementor' ),
					'default'   => '_self',
					'condition' => [ 'epa_accordion_button' => 'yes' ],
				],

			],
			'title_field' => '{{epa_accordion_title}}',
		] );
		$this->add_control( 'filter_accordion_active_cat', [
			'label'       => __( 'Active Accordion Index', 'epa_elementor' ),
			'type'        => Controls_Manager::NUMBER,
			'description' => __( 'Put the index of the default active Accordion Item, default is 0', 'epa_elementor' ),
			'min'         => 0,
			'max'         => 20,
			'default'     => 0,
		] );
		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style Accordion Content Style
		 * -------------------------------------------
		 */

		$this->start_controls_section( 'epa_accordion_section_general_settings', [
			'label' => esc_html__( 'Accordion General Style', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'epa_accordion_expand_width', [
			'label'      => __( 'Expand Width', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'size' => 300,
			],
			'range'      => [
				'px' => [
					'min' => 100,
					'max' => 1000,
				],
			],
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} #epa_imgaccordion_wrapper .current' => 'width: {{SIZE}}{{UNIT}}',
			],
		] );

		$this->add_responsive_control( 'epa_accordion_expand_height', [
			'label'     => __( 'Expand Height', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 480,
			],
			'range'     => [
				'px' => [
					'min' => 300,
					'max' => 1000,
				],
			],
			'selectors' => [
				'{{WRAPPER}} #epa_imgaccordion_wrapper ul.epa_imgaccordion li' => 'height: {{SIZE}}px;',
			],
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'epa_accordion_section_style_settings', [
			'label' => esc_html__( 'Heading Style', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );
		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'epa_accordion_heading_bgcolor',
			'types'    => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}} #epa_imgaccordion_wrapper .heading',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => 'epa_accordion_title_typography',
			'selector'  => '{{WRAPPER}} #epa_imgaccordion_wrapper .heading',
			'separator' => 'after',
		] );

		$this->add_control( 'epa_accordion_content_heading_color', [
			'label'     => esc_html__( 'Heading Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#333',
			'selectors' => [
				'{{WRAPPER}} #epa_imgaccordion_wrapper .heading' => 'color: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'epa_accordion_heading_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} #epa_imgaccordion_wrapper .heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->add_responsive_control( 'epa_accordion_heading_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} #epa_imgaccordion_wrapper .heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();


		/**
		 * -------------------------------------------
		 * Accordion Content Style
		 * -------------------------------------------
		 */
		$this->start_controls_section( 'epa_accordion_content_style_settings', [
			'label' => esc_html__( 'Content Style', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'epa_accordion_content_desc_bgcolor',
			'types'    => [ 'gradient' ],
			'selector' => '{{WRAPPER}} #epa_imgaccordion_wrapper .bgDescription',
		] );

		$this->add_control( 'epa_accordion_item_heading', [
			'label'     => esc_html__( 'Item Box Style', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_accordion_item_border_color',
			'selector' => '{{WRAPPER}} #epa_imgaccordion_wrapper ul.epa_imgaccordion li',
		] );

		$this->add_control( 'epa_accordion_item_border_radius', [
			'label'     => esc_html__( 'Image Border Radius', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} #epa_imgaccordion_wrapper ul.epa_imgaccordion li' => 'border-radius: {{SIZE}}px;',
			],
		] );

		$this->add_responsive_control( 'epa_accordion_content_item_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} #epa_imgaccordion_wrapper ul.epa_imgaccordion li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		/*Button Shadow*/
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'label'    => esc_html__( 'Shadow', 'epa_elementor' ),
			'name'     => 'epa_accordion_item_box_shadow',
			'selector' => '{{WRAPPER}} #epa_imgaccordion_wrapper ul.epa_imgaccordion li',
		] );

		$this->add_control( 'epa_accordion_title_heading', [
			'label'     => esc_html__( 'Title Typhography', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'epa_accordion_content_title_color', [
			'label'     => esc_html__( 'Title Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#333',
			'selectors' => [
				'{{WRAPPER}} #epa_imgaccordion_wrapper .description h2' => 'color: {{VALUE}};',
			],
		] );
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_accordion_content_typography',
			'selector' => '{{WRAPPER}} #epa_imgaccordion_wrapper .description h2',
		] );
		$this->add_responsive_control( 'epa_accordion_content_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} #epa_imgaccordion_wrapper .description h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->add_responsive_control( 'epa_accordion_content_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} #epa_imgaccordion_wrapper .description h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->add_control( 'epa_accordion_descr_heading', [
			'label'     => esc_html__( 'Description Typhography', 'wfe_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );
		$this->add_control( 'epa_accordion_content_description_color', [
			'label'     => esc_html__( 'Description Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#333',
			'selectors' => [
				'{{WRAPPER}} #epa_imgaccordion_wrapper .description p' => 'color: {{VALUE}};',
			],
		] );
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_accordion_content_description_typography',
			'selector' => '{{WRAPPER}} #epa_imgaccordion_wrapper .description p',
		] );
		$this->add_responsive_control( 'epa_accordion_content_description_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} #epa_imgaccordion_wrapper .description p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->add_responsive_control( 'epa_accordion_content_description_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} #epa_imgaccordion_wrapper .description p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->add_control( 'epa_accordion_button_heading', [
			'label'     => esc_html__( 'Button Typhography', 'wfe_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'epa_accordion_button_color', [
			'label'     => esc_html__( 'Button Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#333',
			'selectors' => [
				'{{WRAPPER}} #epa_imgaccordion_wrapper .description a' => 'color: {{VALUE}};',
			],
		] );
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_accordion_button_typography',
			'selector' => '{{WRAPPER}} #epa_imgaccordion_wrapper .description a',
		] );
		$this->add_responsive_control( 'epa_accordion_button_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} #epa_imgaccordion_wrapper .description a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->add_responsive_control( 'epa_accordion_button_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} #epa_imgaccordion_wrapper .description a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->end_controls_section();


	}

	protected function render() {
		?>

        <div class="epa_pro_box">
            <h2 class="epa-pro-tit">Image Accordion Pro</h2>
            <p class="epa-pro-descr">Only pro version holder can use this Image Accordion Addon. To buy pro version with unlock all addons features. click the below link: </p>
            <ul class="epa-but-wrapper">
                <li>
                    <a class="epa-pro-but epa-view-demo"><i class="fa fa-eye"></i>View Demo</a>
                </li>
                <li>
                    <a class="epa-pro-but epa-view-features"><i class="fa fa-list-alt"></i>View Features</a>
                </li>
                <li>
                    <a class="epa-pro-but epa-buy-now"><i class="fa fa-shopping-cart"></i>Buy Now</a>
                </li>
            </ul>
        </div>

        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $(".epa-view-demo").click(function () {
                    window.open("https://demos.codenat.com/image-accordion-for-elementor");
                });
                $(".epa-view-features,.epa-buy-now").click(function () {
                    window.open("https://codenat.com/downloads/essential-premium-addons-for-elementor/");
                });
            });
        </script>
		<?php

	}

	protected function _content_template() {
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Epa_imageaccordion() );