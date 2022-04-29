<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Epa_tabs extends Widget_Base {

	public function get_name() {
		return 'epa-tabs';
	}

	public function get_title() {
		return __( 'Tabs', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'eicon-tabs wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Register Control Section
	protected function _register_controls() {
		/**
		 * Advance Tabs Settings
		 */
		$this->start_controls_section( 'epa_section_adv_tabs_settings', [
			'label' => esc_html__( 'General Settings', 'epa_elementor' ),
		] );
		$this->add_control( 'epa_tabs_menu_position', [
			'label'       => esc_html__( 'Menu Position', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT,
			'default'     => 'epa-tabs-pos-top-center',
			'label_block' => false,
			'options'     => [
				'epa-tabs-pos-top-center' => esc_html__( 'Top', 'epa_elementor' ),
				'epa-tabs-pos-left'     => esc_html__( 'Left', 'epa_elementor' ),
				'epa-tabs-pos-right'    => esc_html__( 'Right', 'epa_elementor' ),
			],
		] );

		$this->add_control( 'epa_tabs_menu_alignment', [
			'label'       => esc_html__( 'Menu Alignment', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT,
			'label_block' => false,
			'default'     => 'epa-tabs-pos-top-justify',
			'options'     => [
				'epa-tabs-pos-top-justify' => esc_html__( 'Justify', 'epa_elementor' ),
				'epa-tabs-pos-top-left'                      => esc_html__( 'Left', 'epa_elementor' ),
				'epa-tabs-pos-top-center'                    => esc_html__( 'Center', 'epa_elementor' ),
				'epa-tabs-pos-top-right'                     => esc_html__( 'Right', 'epa_elementor' ),
			],
			'condition'   => [
				'epa_tabs_menu_position' => 'epa-tabs-pos-top-center',
			],
		] );
		$this->add_control( 'epa_tabs_menu_text_alignment', [
			'label'       => esc_html__( 'Menu Content Alignment', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT,
			'label_block' => false,
			'default'     => 'center',
			'options'     => [
				'left'                      => esc_html__( 'Left', 'epa_elementor' ),
				'center'                    => esc_html__( 'Center', 'epa_elementor' ),
				'right'                     => esc_html__( 'Right', 'epa_elementor' ),
			],
			'selectors'  => [
				'{{WRAPPER}} .epa-tabs > label span' => 'text-align: {{VALUE}};',
			],
		] );
		$this->add_control( 'epa_tabs_icon_show', [
			'label'        => esc_html__( 'Enable Icon', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'return_value' => 'yes',
            'description'  => 'This icon option available only for Pro holder users. Buy pro version to unlock all features: <a href="https://codenat.com/downloads/essential-premium-addons-for-elementor/" target="_blank">click here</a>'
		] );
		$this->add_control( 'epa_tabs_icon_show_arrow', [
			'label'        => esc_html__( 'Enable Arrow', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'yes',
			'return_value' => 'yes',
		] );

		/*
		$this->add_control( 'epa_tabs_icon_position', [
			'label'       => esc_html__( 'Icon Position', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT,
			'default'     => ' ',
			'label_block' => false,
			'options'     => [
				'epa-tabs-icon-position' => esc_html__( 'Stacked', 'epa_elementor' ),
				' '                      => esc_html__( 'Inline', 'epa_elementor' ),
			],
			'condition'   => [
				'epa_tabs_icon_show' => 'yes',
			],
		] );*/

		$this->add_control( 'epa_tabs_responsive_menu_mobile', [
			'label'       => esc_html__( 'Responsive Menu', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT,
			'default'     => 'epa-tabs-response-to-stack',
			'label_block' => false,
			'options'     => [
				'epa-tabs-response-to-stack' => esc_html__( 'Stacked', 'epa_elementor' ),
				'epa-tabs-response-to-icons' => esc_html__( 'Icon Only', 'epa_elementor' ),
				'' => esc_html__( 'Normal', 'epa_elementor' ),
			],
		] );
		$this->add_control( 'epa_tabs_changing_animation', [
			'label'       => esc_html__( 'Animation', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT,
			'default'     => 'epa-tabs-anim-slide-down',
			'label_block' => false,
			'options'     => [
				'epa-tabs-anim-flip' => esc_html__( 'Flip', 'epa_elementor' ),
				' ' => esc_html__( 'Fade', 'epa_elementor' ),
				'epa-tabs-anim-rotate' => esc_html__( 'Rotate', 'epa_elementor' ),
				'epa-tabs-anim-slide-up' => esc_html__( 'Slide Up', 'epa_elementor' ),
				'epa-tabs-anim-slide-down' => esc_html__( 'Slide Down', 'epa_elementor' ),
				'epa-tabs-anim-slide-left' => esc_html__( 'Slide Left', 'epa_elementor' ),
				'epa-tabs-anim-slide-right' => esc_html__( 'Slide Right', 'epa_elementor' ),
			],
		] );
		$this->end_controls_section();

		/**
		 * Advance Tabs Content Settings
		 */
		$this->start_controls_section( 'epa_tabs_content_settings_section', [
			'label' => esc_html__( 'Content', 'epa_elementor' ),
		] );
		$this->add_control( 'epa_tabs_content_items', [
			'type'        => Controls_Manager::REPEATER,
			'seperator'   => 'before',
			'default'     => [
				[ 'epa_tabs_tab_title' => esc_html__( 'Title 1', 'epa_elementor' ) ],
				[ 'epa_tabs_tab_title' => esc_html__( 'Title 2', 'epa_elementor' ) ],
				[ 'epa_tabs_tab_title' => esc_html__( 'Title 3', 'epa_elementor' ) ],
			],
			'fields'      => [
				[
					'name'         => 'epa_tabs_show_as_default',
					'label'        => __( 'Set as Default', 'epa_elementor' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'inactive',
					'return_value' => 'checked',
				],
				[
					'name'    => 'epa_tabs_icon',
					'label'   => esc_html__( 'Icon', 'epa_elementor' ),
					'type'    => Controls_Manager::ICON,
					'description'  => 'This icon option available only for Pro holder users.',
					'default' => 'fa fa-info-circle',

				],
				[
					'name'    => 'epa_tabs_tab_title',
					'label'   => esc_html__( 'Tab Title', 'epa_elementor' ),
					'type'    => Controls_Manager::TEXT,
					'default' => esc_html__( 'Tab Title', 'epa_elementor' ),
					'dynamic' => [ 'active' => true ],
				],
				[
					'name'    => 'epa_tabs_text_content_type',
					'label'   => __( 'Content Type', 'epa_elementor' ),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'content'  => __( 'Content', 'epa_elementor' ),
						'template' => __( 'Saved Templates', 'epa_elementor' ),
					],
					'default' => 'content',
				],
				[
					'name'      => 'epa_tabs_templates',
					'label'     => __( 'Choose Template', 'epa_elementor' ),
					'type'      => Controls_Manager::SELECT,
					'options'   => epa_get_templates(),
					'condition' => [
						'epa_tabs_text_content_type' => 'template',
					],
				],
				[
					'name'      => 'epa_tabs_tab_content',
					'label'     => esc_html__( 'Tab Content', 'epa_elementor' ),
					'type'      => Controls_Manager::WYSIWYG,
					'default'   => esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.', 'epa_elementor' ),
					'dynamic'   => [ 'active' => true ],
					'condition' => [
						'epa_tabs_text_content_type' => 'content',
					],
				],
			],
			'title_field' => '{{epa_tabs_tab_title}}',
		] );
		$this->end_controls_section();

		/* Tab Style Advance Tabs Content Style	 */
		$this->start_controls_section( 'epa_adv_tabs_tab_style_settings_section', [
			'label' => esc_html__( 'Tab Menu Style', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );
		$this->add_control( 'epa_accordion_icon_heading', [
			'label'     => esc_html__( 'Icon Style Section:', 'wfe_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'after',
		] );
		$this->add_responsive_control( 'epa_tabs_tab_icon_size', [
			'label'      => __( 'Icon Size', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'size' => 16,
				'unit' => 'px',
			],
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 200,
					'step' => 1,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .epa-tabs > label span span i' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		] );
		$this->add_responsive_control( 'epa_tabs_tab_icon_gap', [
			'label'      => __( 'Icon Gap', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'size' => 5,
				'unit' => 'px',
			],
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .epa-tabs > label span span i' => 'margin-right: {{SIZE}}{{UNIT}}; margin-left: {{SIZE}}{{UNIT}};',
			],
		] );
		$this->add_responsive_control( 'epa_tabs_tab_icon_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-tabs > label span span i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'epa_accordion_title_heading', [
			'label'     => esc_html__( 'Title Style Section:', 'wfe_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'after',
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_tabs_title_typography',
			'selector' => '{{WRAPPER}} .epa-tabs > label span',
		] );

		$this->add_responsive_control( 'epa_tabs_title_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-tabs > label span span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->add_responsive_control( 'epa_tabs_title margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-tabs > label span span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->start_controls_tabs( 'epa_tabs_header_tabs' );
		// Normal State Tab
		$this->start_controls_tab( 'epa_tabs_header_normal', [ 'label' => esc_html__( 'Normal', 'epa_elementor' ) ] );
		$this->add_control( 'epa_tab_background_color', [
			'label'     => esc_html__( 'Tab Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#f1f1f1',
			'selectors' => [
				'{{WRAPPER}} .epa-tabs > label span span' => 'background: {{VALUE}};',
			],
		] );
		$this->add_control( 'epa_tab_text_color', [
			'label'     => esc_html__( 'Text Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#333',
			'selectors' => [
				'{{WRAPPER}} .epa-tabs > label span span' => 'color: {{VALUE}};',
			],
		] );
		$this->add_control( 'epa_tabs_tab_icon_color', [
			'label'     => esc_html__( 'Icon Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#333',
			'selectors' => [
				'{{WRAPPER}} .epa-tabs > label span span i' => 'color: {{VALUE}};',
			],
			'condition' => [
				'epa_tabs_icon_show' => 'yes',
			],
		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_tabs_tab_border',
			'label'    => esc_html__( 'Border', 'epa_elementor' ),
			'selector' => '{{WRAPPER}} .epa-tabs > label span',
		] );
		$this->add_responsive_control( 'epa_tabs_tab_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-tabs > label span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->end_controls_tab();
		// Hover State Tab
		$this->start_controls_tab( 'epa_tabs_header_hover', [ 'label' => esc_html__( 'Hover', 'epa_elementor' ) ] );
		$this->add_control( 'epa_tabs_tab_color_hover', [
			'label'     => esc_html__( 'Tab Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#264348',
			'selectors' => [
				'{{WRAPPER}} .epa-tabs > label:hover span span' => 'background: {{VALUE}};',
				//'{{WRAPPER}} .epa-tabs > input:checked + label:hover span::before' => 'border-color: {{VALUE}};',
			],
		] );
		$this->add_control( 'epa_tabs_tab_text_color_hover', [
			'label'     => esc_html__( 'Text Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#FFF',
			'selectors' => [
				'{{WRAPPER}} .epa-tabs > label:hover span span' => 'color: {{VALUE}};',
			],
		] );
		$this->add_control( 'epa_tabs_tab_icon_color_hover', [
			'label'     => esc_html__( 'Icon Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#FFF',
			'selectors' => [
				'{{WRAPPER}} .epa-tabs > label:hover span span i' => 'color: {{VALUE}};',
			],
			'condition' => [
				'epa_tabs_icon_show' => 'yes',
			],
		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_tabs_tab_border_hover',
			'label'    => esc_html__( 'Border', 'epa_elementor' ),
			'selector' => '{{WRAPPER}} .epa-tabs > label span:hover',
		] );
		$this->add_responsive_control( 'epa_tabs_tab_border_radius_hover', [
			'label'      => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-tabs > label span:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->end_controls_tab();
		// Active State Tab
		$this->start_controls_tab( 'epa_tabs_header_active', [ 'label' => esc_html__( 'Active', 'epa_elementor' ) ] );
		$this->add_control( 'epa_tabs_tab_color_active', [
			'label'     => esc_html__( 'Tab Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#264348',
			'selectors' => [
				'{{WRAPPER}} .epa-tabs > input:checked + label span span' => 'background-color: {{VALUE}};',
				'{{WRAPPER}} .epa-tabs > input:checked + label span::before' => 'border-color: {{VALUE}};',
			],
		] );
		$this->add_control( 'epa_tabs_tab_text_color_active', [
			'label'     => esc_html__( 'Text Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#fff',
			'selectors' => [
				'{{WRAPPER}} .epa-tabs > input:checked + label span span' => 'color: {{VALUE}};',
			],
		] );
		$this->add_control( 'epa_tabs_tab_icon_color_active', [
			'label'     => esc_html__( 'Icon Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#fff',
			'selectors' => [
				'{{WRAPPER}} .epa-tabs > input:checked + label span span i' => 'color: {{VALUE}};',
			],
			'condition' => [
				'epa_tabs_icon_show' => 'yes',
			],
		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_tabs_tab_border_active',
			'label'    => esc_html__( 'Border', 'epa_elementor' ),
			'selector' => '{{WRAPPER}} .epa-tabs > input:checked + label span span',
		] );
		$this->add_responsive_control( 'epa_tabs_tab_border_radius_active', [
			'label'      => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-tabs > input:checked + label span span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();


		/*
		    Epa Tabs Content Style
		*/

		$this->start_controls_section( 'epa_tabs_content_style_settings', [
			'label' => esc_html__( 'Content', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );
		$this->add_control( 'epa_tabs_content_bg_color', [
			'label'     => esc_html__( 'Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .epa-tabs > ul li' => 'background-color: {{VALUE}};',
			],
		] );
		$this->add_control( 'adv_tabs_content_text_color', [
			'label'     => esc_html__( 'Text Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#333',
			'selectors' => [
				'{{WRAPPER}} .epa-tabs > ul .typography' => 'color: {{VALUE}};',
			],
		] );
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_tabs_content_typography',
			'selector' => '{{WRAPPER}} .epa-tabs > ul .typography',
		] );
		$this->add_responsive_control( 'epa_tabs_content_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-tabs > ul .typography' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->add_responsive_control( 'epa_tabs_content_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-tabs > ul' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_tabs_content_border',
			'label'    => esc_html__( 'Border', 'epa_elementor' ),
			'selector' => '{{WRAPPER}} .epa-tabs > ul',
		] );
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'      => 'epa_tabs_content_shadow',
			'selector'  => '{{WRAPPER}} .epa-tabs > ul',
			'separator' => 'before',
		] );
		$this->end_controls_section();
	}

	protected function render() {
		$settings    = $this->get_settings_for_display();
		$tabscontent = $settings['epa_tabs_content_items'];

		//$unqid = substr(uniqid(),-5);
		$unqid = uniqid();

		$jusamountwrap = 0;
		foreach ($tabscontent as $tab) {
			$jusamountwrap++;
			$jusamoun[] = $jusamountwrap;
        }
		if ( $settings['epa_tabs_menu_position'] != 'epa-tabs-pos-top-center' ) {
			$menu_position = $settings['epa_tabs_menu_position'];
		}

		if ($settings['epa_tabs_menu_alignment'] == 'epa-tabs-pos-top-justify') {
				$menu_position = $settings['epa_tabs_menu_alignment'] .' epa-tabs-amount-'.end($jusamoun).'';
		}
		if (!empty($settings['epa_tabs_menu_alignment']) && $settings['epa_tabs_menu_alignment'] != 'epa-tabs-pos-top-justify') {
			$menu_position = $settings['epa_tabs_menu_alignment'];
        }

		?>
        <!-- tabs -->
        <div class="epa-tabs epa-tab-wrap-<?php echo $unqid;?> <?php echo $menu_position; ?> <?php echo $settings['epa_tabs_changing_animation'] ?> <?php echo $settings['epa_tabs_responsive_menu_mobile']?>">
			<?php

			$count = 0;
			foreach ( $tabscontent as $tab ) :
				$count ++;
				$jusamount[] = $count;
				$defact      = $count == 1 ? 'checked' : '';
				$active      = $tab['epa_tabs_show_as_default'] == 'checked' ? 'checked' : '';
				$tabid = $tab['_id'].$unqid;

				//echo $unqid;

				$tabid = str_replace( ' ', '-', strtolower( $tabid ) );
				?>
                <input type="radio" name="epa-tabs-<?php echo $unqid; ?>" <?php echo $active;	echo $defact; ?> id="epa-tab<?php echo $tabid; ?>" class="epa-tab-content-<?php echo $tabid; ?> epa-tabs-menu-item">

                <label for="epa-tab<?php echo $tabid; ?>"><span>
                    <span class="<?php //echo $settings['epa_tabs_icon_position'] ?>">
<!--                        <?php /*if ( $settings['epa_tabs_icon_show'] == 'yes' ) : */?>
                            <i class="<?php /*echo $tab['epa_tabs_icon']; */?>"></i>
                        --><?php /*endif; */?>
                        <?php echo $tab['epa_tabs_tab_title']; ?>
                    </span>
                    </span></label>
			<?php endforeach; ?>


            <ul>
				<?php

				foreach ( $tabscontent as $tab ) :

					$tabid = $tab['_id'].$unqid;

					//echo $unqid;

					$tabid = str_replace( ' ', '-', strtolower( $tabid ) );
					?>
                    <li class="epa-tabs-item epa-tab-content-<?php echo $tabid; ?>">
                        <div class="typography">

							<?php if ( $tab['epa_tabs_text_content_type'] == 'content' ) : ?>
                                <p><?php echo $tab['epa_tabs_tab_content'] ?></p>
							<?php endif; ?>

							<?php if ( $tab['epa_tabs_text_content_type'] == 'template' ) {
								if ( ! empty( $tab['epa_tabs_templates'] ) ) {
									$epa_template_id = $tab['epa_tabs_templates'];
									$epa_frontend    = new Frontend;
									echo $epa_frontend->get_builder_content( $epa_template_id, true );
								}
							}
							?>


                        </div>
                    </li>
				<?php endforeach; ?>
            </ul>
        </div>
        <!--/ tabs -->

		<?php
		?>

        <style type="text/css">
            <?php
            $jusamount = 0;

            foreach ( $tabscontent as $tab) :

            $jusamount++;
            $tabid =  $tab['_id'].$unqid;
            //echo $unqid;

			$tabid = str_replace(' ', '-', strtolower($tabid));
            ?>
            .epa-tab-wrap-<?php echo $unqid; ?> .epa-tab-content-<?php echo $tabid; ?>:checked ~ ul > .epa-tab-content-<?php echo $tabid; ?> {
                position: relative;
                z-index: 1;
                opacity: 1;
            }

            .epa-tabs-anim-scale > .epa-tab-content-<?php echo $tabid; ?>:checked ~ ul > .epa-tab-content-<?php echo $tabid; ?> {
                -o-transform: scale(1, 1);
                -ms-transform: scale(1, 1);
                -moz-transform: scale(1, 1);
                -webkit-transform: scale(1, 1);
            }

            .epa-tabs-anim-flip > .epa-tab-content-<?php echo $tabid; ?>:checked ~ ul > .epa-tab-content-<?php echo $tabid; ?> {
                -o-transform: rotateX(0deg);
                -ms-transform: rotateX(0deg);
                -moz-transform: rotateX(0deg);
                -webkit-transform: rotateX(0deg);
                -o-transition-delay: 0.2s;
                -moz-transition-delay: 0.2s;
                -webkit-transition-delay: 0.2s;
            }

            .epa-tabs-anim-rotate > .epa-tab-content-<?php echo $tabid; ?>:checked ~ ul > .epa-tab-content-<?php echo $tabid; ?> {
                -o-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -webkit-transform: rotate(0deg);
            }


            <?php endforeach; ?>

            .epa-tabs-pos-top-justify.epa-tabs-amount-<?php echo $jusamount; ?> > label {
            <?php
			switch ($jusamount) {
					case 1: echo "width: 100%;"; break;
					case 2:	echo "width: 50%;";	break;
					case 3:	echo "width:33.33%;";	break;
					case 4:	echo "width:25%;"; break;
					case 5:	echo "width: 20%;"; break;
					case 6:	echo "width: 16.66%;"; break;
			}
			?>
            }
            <?php if($settings['epa_tabs_icon_show_arrow'] == 'yes') :  ?>
            .epa-tabs > input:checked + label span::before {
                content: "";
                display: block;
                width: 0;
                border: 10px solid red;
                position: absolute;
                top: 95%;
                left: 50%;
                margin-left: -10px;
                transform: rotate(45deg);
                -webkit-transform: rotate(45deg);
                margin-top: -10px;
                z-index: 10;
                transition: background 0.4s, color 0.4s;
                transition-duration: 2s;
            }
            .epa-tabs-pos-left > input:checked + label span::before {
                top: 50%;
                left: 100%;
                margin-left: -15px;
                -webkit-transform: rotate(45deg);
                transform: rotate(45deg);
                margin-top: -10px;
                z-index: 10;
            }
            .epa-tabs-pos-right > input:checked + label span::before {
                top: 50%;
                left: 3%;
                margin-left: -10px;
                -webkit-transform: rotate(45deg);
                transform: rotate(45deg);
                margin-top: -10px;
                z-index: 10;
            }
            <?php endif; ?>

        </style>

		<?php
	}

	protected function _content_template() {
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Epa_tabs() );