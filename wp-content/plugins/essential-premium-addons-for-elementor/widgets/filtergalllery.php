<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Eap_filtergalllery extends Widget_Base {

	public function get_name() {
		return 'epa-filtergalllery';
	}

	public function get_title() {
		return esc_html__( 'Filter Gallery', 'epa_elementor' );
	}

	public function get_icon() {
		return 'fa fa-th wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc

	protected function _register_controls() {

		$this->start_controls_section( 'filter_gallery_display_option', [
			'label' => esc_html__( 'Display Options', 'epa_elementor' ),
		] );
		$this->add_control( 'filter_gallery_first_cat_switcher', [
			'label'   => esc_html__( 'First Category', 'epa_elementor' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		$this->add_control( 'filter_gallery_lightbox_switcher', [
			'label'   => esc_html__( 'Lightbox Gallery?', 'epa_elementor' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		$this->add_control( 'filter_gallery_link_switcher', [
			'label'   => esc_html__( 'Gallery Link?', 'epa_elementor' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		$this->add_control( 'filter_gallery_title_switcher', [
			'label'   => esc_html__( 'Show Title?', 'epa_elementor' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		$this->add_control( 'filter_gallery_description_switcher', [
			'label'   => esc_html__( 'Show Description?', 'epa_elementor' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'filter_gallery_cats', [
			'label' => esc_html__( 'Categories', 'epa_elementor' ),
		] );


		$this->add_control( 'filter_gallery_first_cat_label', [
			'label'     => esc_html__( 'First Category Label', 'epa_elementor' ),
			'type'      => Controls_Manager::TEXT,
			'default'   => esc_html__( 'All', 'epa_elementor' ),
			'dynamic'   => [ 'active' => true ],
			'condition' => [
				'filter_gallery_first_cat_switcher' => 'yes',
			],
		] );

		$repeater = new REPEATER();

		$repeater->add_control( 'filter_gallery_img_cat', [
			'label'   => esc_html__( 'Category', 'epa_elementor' ),
			'type'    => Controls_Manager::TEXT,
			'dynamic' => [ 'active' => true ],
		] );

		$this->add_control( 'filter_gallery_cats_content', [
			'label'       => esc_html__( 'Categories', 'epa_elementor' ),
			'type'        => Controls_Manager::REPEATER,
			'default'     => [
				[
					'filter_gallery_img_cat' => 'Category 1',
				],
				[
					'filter_gallery_img_cat' => 'Category 2',
				],
			],
			'fields'      => array_values( $repeater->get_controls() ),
			'title_field' => '{{{ filter_gallery_img_cat }}}',
		] );

		$this->add_control( 'filter_gallery_active_cat', [
			'label'       => esc_html__( 'Active Category Index', 'epa_elementor' ),
			'type'        => Controls_Manager::NUMBER,
			'description' => esc_html__( 'Put the index of the default active category, default is 1', 'epa_elementor' ),
			'min'         => 0,
			'max'         => 20,
			'default'     => 0,
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'filter_gallery_content', [
			'label' => esc_html__( 'Images', 'epa_elementor' ),
		] );

		$img_repeater = new REPEATER();

		$img_repeater->add_control( 'filter_gallery_img_upload', [
			'label'   => esc_html__( 'Upload Image', 'epa_elementor' ),
			'type'    => Controls_Manager::MEDIA,
			'dynamic' => [ 'active' => true ],
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			],
		] );

		$img_repeater->add_control( 'filter_gallery_img_name', [
			'label'       => esc_html__( 'Name', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'dynamic'     => [ 'active' => true ],
			'label_block' => true,
		] );

		$img_repeater->add_control( 'filter_gallery_img_desc', [
			'label'       => esc_html__( 'Description', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXTAREA,
			'dynamic'     => [ 'active' => true ],
			'label_block' => true,
		] );

		$img_repeater->add_control( 'filter_gallery_img_category', [
			'label'   => esc_html__( 'Category', 'epa_elementor' ),
			'type'    => Controls_Manager::TEXT,
			'dynamic' => [ 'active' => true ],
			'description' => 'Category Name is case-sensitive. You Must Put Same categories Name which You Created Before'
		] );
		$img_repeater->add_control( 'filter_gallery_img_link', [
			'label'       => esc_html__( 'Link', 'epa_elementor' ),
			'type'        => Controls_Manager::URL,
			'placeholder' => 'https://codenat.com/',
			'label_block' => true,
		] );

		$this->add_control( 'filter_gallery_img_content', [
			'label'       => esc_html__( 'Images', 'epa_elementor' ),
			'type'        => Controls_Manager::REPEATER,
			'default'     => [
				[
					'filter_gallery_img_name'     => 'Image #1',
					'filter_gallery_img_category' => 'Category 1',
				],
				[
					'filter_gallery_img_name'     => 'Image #2',
					'filter_gallery_img_category' => 'Category 2',
				],
			],
			'fields'      => array_values( $img_repeater->get_controls() ),
			'title_field' => '{{{ filter_gallery_img_name }}}' . ' / {{{ filter_gallery_img_category }}}',
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'filter_gallery_grid_settings', [
			'label' => esc_html__( 'Grid Settings', 'epa_elementor' ),

		] );

		$this->add_responsive_control( 'filter_gallery_column_number', [
			'label'           => esc_html__( 'Columns', 'epa_elementor' ),
			'label_block'     => true,
			'type'            => Controls_Manager::SELECT,
			'desktop_default' => '50%',
			'tablet_default'  => '100%',
			'mobile_default'  => '100%',
			'options'         => [
				'100%'    => esc_html__( '1 Column', 'epa_elementor' ),
				'50%'     => esc_html__( '2 Columns', 'epa_elementor' ),
				'33.330%' => esc_html__( '3 Columns', 'epa_elementor' ),
				'25%'     => esc_html__( '4 Columns', 'epa_elementor' ),
				'20%'     => esc_html__( '5 Columns', 'epa_elementor' ),
				'16.66%'  => esc_html__( '6 Columns', 'epa_elementor' ),
				'8.33%'   => esc_html__( '12 Columns', 'epa_elementor' ),
			],
			'selectors'       => [
				'{{WRAPPER}} .epa-filtergallery-item ' => 'width: {{VALUE}};',
			],
			'render_type'     => 'template',
		] );

		$this->add_control( 'filter_gallery_img_size_select', [
			'label'   => esc_html__( 'Grid Layout', 'epa_elementor' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'fitRows' => esc_html__( 'Even', 'epa_elementor' ),
				'masonry' => esc_html__( 'Masonry', 'epa_elementor' ),
			],
			'default' => 'fitRows',
		] );
		$this->add_responsive_control( 'filter_gallery_gap', [
			'label'      => esc_html__( 'Image Gap', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%', "em" ],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 200,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .epa-filtergallery-item' => 'padding: {{SIZE}}{{UNIT}};',
			],
		] );
		$this->add_responsive_control( 'filter_gallery_content_align', [
			'label'     => esc_html__( 'Content Alignment', 'epa_elementor' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
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
			'default'   => 'center',
			'selectors' => [
				'{{WRAPPER}} .epa-fil-gallery-effects .caption' => 'text-align: {{VALUE}};',
			],
		] );

		$this->end_controls_section();


		$this->start_controls_section( 'filter_gallery_filter_style', [
			'label' => esc_html__( 'Filter Button', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'filter_gallery_filter_color', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .filters-button-group .button' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'filter_gallery_filter_active_color', [
			'label'     => esc_html__( 'Active Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .filters-button-group .is-checked' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'filter_gallery_filter_typo',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .filters-button-group .button',
		] );

		$this->add_control( 'filter_gallery_background_color', [
			'label'     => esc_html__( 'Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#f3f3f3',
			'selectors' => [
				'{{WRAPPER}} .filters-button-group .button' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'filter_gallery_background_active_color', [
			'label'     => esc_html__( 'Background Active Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#666',
			'selectors' => [
				'{{WRAPPER}} .filters-button-group .is-checked' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'filter_gallery_filter_border',
			'selector' => '{{WRAPPER}} .filters-button-group .button',
		] );

		/*Border Radius*/
		$this->add_control( 'filter_gallery_filter_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .filters-button-group .button' => 'border-radius: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'filter_gallery_filter_shadow',
			'selector' => '{{WRAPPER}} .filters-button-group .button',
		] );

		$this->add_responsive_control( 'filter_gallery_filter_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .filters-button-group .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		/*Front Icon Padding*/
		$this->add_responsive_control( 'filter_gallery_filter_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .filters-button-group .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();


		$this->start_controls_section( 'filter_gallery_img_style_section', [
			'label' => esc_html__( 'Images', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );
		$this->add_control( 'filter_gallery_image_overlay_color', [
			'label'     => esc_html__( 'Hover Overlay Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .epa-fil-gallery-effects:after' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'thumbnail',
			'default'   => 'thumbnail',
			'condition' => [
				'filter_gallery_img_size_select' => 'fitRows',
			],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'filter_gallery_img_border',
			'selector' => '{{WRAPPER}} .epa-fil-gallery-effects',
		] );

		/*First Border Radius*/
		$this->add_control( 'filter_gallery_img_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-fil-gallery-effects' => 'border-radius: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'label'    => esc_html__( 'Shadow', 'epa_elementor' ),
			'name'     => 'filter_gallery_img_box_shadow',
			'selector' => '{{WRAPPER}} .epa-fil-gallery-effects',
		] );

		/*Margin*/
		$this->add_responsive_control( 'filter_gallery_img_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-fil-gallery-effects' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
			],
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'filter_gallery_content_style', [
			'label' => esc_html__( 'Content', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'filter_gallery_title_heading', [
			'label' => esc_html__( 'Title', 'epa_elementor' ),
			'type'  => Controls_Manager::HEADING,
		] );

		$this->add_control( 'filter_gallery_title_color', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .epa-fil-gallery-effects .caption h3' => 'color: {{VALUE}};',
			],
		] );

		/*Title Typography*/
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'filter_gallery_title_typography',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .epa-fil-gallery-effects .caption h3',
		] );

		$this->add_control( 'filter_gallery_description_heading', [
			'label'     => esc_html__( 'Description', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'filter_gallery_description_color', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .epa-fil-gallery-effects .caption p' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'filter_gallery_description_typo',
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .epa-fil-gallery-effects .caption p',
		] );
		$this->end_controls_section();

		$this->start_controls_section( 'filter_gallery_icons_style', [
			'label' => esc_html__( 'Icons', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->start_controls_tabs( 'filter_gallery_icons_style_tabs' );

		$this->start_controls_tab( 'filter_gallery_icons_style_normal', [
			'label' => esc_html__( 'Normal', 'epa_elementor' ),
		] );

		$this->add_control( 'filter_gallery_icons_style_color', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .epa-fil-gallery-effects .link-wrap i' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'filter_gallery_icons_style_background', [
			'label'     => esc_html__( 'Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .epa-fil-gallery-effects .link-wrap a' => 'background-color: {{VALUE}};',
			],
		] );

		/* Border*/
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'filter_gallery_icons_style_border',
			'selector' => '{{WRAPPER}} .epa-fil-gallery-effects .link-wrap a',
		] );

		/*Button Border Radius*/
		$this->add_control( 'filter_gallery_icons_style_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-fil-gallery-effects .link-wrap a' => 'border-radius: {{SIZE}}{{UNIT}};',
			],
		] );

		/*Button Shadow*/
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'label'    => esc_html__( 'Shadow', 'epa_elementor' ),
			'name'     => 'filter_gallery_icons_style_shadow',
			'selector' => '{{WRAPPER}} .epa-fil-gallery-effects .link-wrap a',
		] );

		/* Margin*/
		$this->add_responsive_control( 'filter_gallery_icons_style_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-fil-gallery-effects .link-wrap a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'filter_gallery_icons_style_hover', [
			'label' => esc_html__( 'Hover', 'epa_elementor' ),
		] );

		$this->add_control( 'filter_gallery_icons_style_color_hover', [
			'label'     => esc_html__( 'Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .epa-fil-gallery-effects .link-wrap a:hover i' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'filter_gallery_icons_style_background_hover', [
			'label'     => esc_html__( 'Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .epa-fil-gallery-effects .link-wrap a:hover' => 'background-color: {{VALUE}};',
			],
		] );

		/*Button Border*/
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'filter_gallery_icons_style_border_hover',
			'selector' => '{{WRAPPER}} .epa-fil-gallery-effects .link-wrap a:hover',
		] );

		/*Button Border Radius*/
		$this->add_control( 'filter_gallery_icons_style_border_radius_hover', [
			'label'      => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-fil-gallery-effects .link-wrap a:hover' => 'border-radius: {{SIZE}}{{UNIT}};',
			],
		] );

		/*Button Shadow*/
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'label'    => esc_html__( 'Shadow', 'epa_elementor' ),
			'name'     => 'filter_gallery_icons_style_shadow_hover',
			'selector' => '{{WRAPPER}} .epa-fil-gallery-effects .link-wrap a:hover',
		] );

		/*Button Margin*/
		$this->add_responsive_control( 'filter_gallery_icons_style_margin_hover', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-fil-gallery-effects .link-wrap a:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

	}

	protected function render() {
		$settings      = $this->get_settings_for_display();
		$act_cat       = $settings['filter_gallery_active_cat'];
		$act_cat_index = $act_cat == 0 ? 'is-checked' : '';
		$this->add_render_attribute( 'epa-filtergallery-atts', [
			'class'                             => [ 'epa-filtergallery-wrapper' ],
			'data-id'                           => esc_attr( $this->get_id() ),
			'data-layout_mode'                     => esc_attr( $settings['filter_gallery_img_size_select'] ),
		] );

		?>
        <!-- Start Work Section -->
        <div <?php echo $this->get_render_attribute_string( 'epa-filtergallery-atts' ); ?>>
            <div class="button-group filters-button-group flbutgrp<?php echo esc_attr( $this->get_id() ) ?>">
				<?php if ( $settings['filter_gallery_first_cat_switcher'] == 'yes' ) : ?>
                    <button class="button <?php echo $act_cat_index; ?>" data-filter="*"><?php echo $settings['filter_gallery_first_cat_label']; ?></button>

				<?php endif; ?>
				<?php
				$i = 1;
				$epaid = esc_attr( $this->get_id() );
				foreach ( $settings['filter_gallery_cats_content'] as $item ) {
					$active_cat   = $act_cat == $i ++ ? 'is-checked' : '';
					$filter_class = $item['filter_gallery_img_cat'];
					$filter_class = str_replace( " ", "-", strtolower( $filter_class ) );
					?>

                    <button class="button <?php echo $active_cat; ?>" data-filter=".<?php echo $filter_class; ?>"><?php echo esc_html__($item['filter_gallery_img_cat']); ?></button>

				<?php } ?>

            </div>


            <div class="epa-filtergallery-grid epa-flgallery-wap<?php echo $epaid; ?>">

				<?php
				foreach ( $settings['filter_gallery_img_content'] as $items ) {
					$icon_link = $items['filter_gallery_img_link']['url'];
					$external  = $items['filter_gallery_img_link']['is_external'] ? 'target="_blank"' : '';
					$no_follow = $items['filter_gallery_img_link']['nofollow'] ? 'rel="nofollow"' : '';

					$filter_class = $items['filter_gallery_img_category'];
					$filter_class = str_replace( " ", "-", strtolower( $filter_class ) );

					$lightbox_switcher    = $settings['filter_gallery_lightbox_switcher'];
					$link_switcher        = $settings['filter_gallery_link_switcher'];
					$title_switcher       = $settings['filter_gallery_title_switcher'];
					$description_switcher = $settings['filter_gallery_description_switcher'];


					if($settings['filter_gallery_img_size_select'] == 'fitRows') {
						// Image Value Get
						$epa_team_image    = $items['filter_gallery_img_upload'];
						$epateam_image_url = Group_Control_Image_Size::get_attachment_image_src( $epa_team_image['id'], 'thumbnail', $settings );
						if ( empty( $epateam_image_url ) ) : $epateam_image_url = $epa_team_image['url'];
						else: $epateam_image_url = $epateam_image_url;
						endif;
					}
					else {
						$epateam_image_url = $items['filter_gallery_img_upload']['url'];
					}


					?>

                    <div class="epa-filtergallery-item <?php echo $filter_class; ?>">

                        <div class="epa-fil-gal-effect1 epa-fil-gallery-effects">
                            <img class="epa-flga-img" src="<?php echo esc_url($epateam_image_url); ?>" alt="filter-gallery">
                            <div class="caption">
								<?php if ( $title_switcher == 'yes' ) : ?>
                                    <h3><?php echo esc_html__($items['filter_gallery_img_name']); ?></h3>
								<?php endif; ?>
								<?php if ( $description_switcher == 'yes' ) : ?>
                                    <p><?php echo esc_html__($items['filter_gallery_img_desc']) ?></p>
								<?php endif; ?>
                            </div>

                            <div class="link-wrap">
								<?php if ( $lightbox_switcher == 'yes' ) : ?>
                                    <a href="<?php echo esc_url($items['filter_gallery_img_upload']['url']); ?>" data-fancybox="gallery<?php echo $epaid;?>"><i class="fa fa-search"></i></a>
								<?php endif; ?>

								<?php if ( $link_switcher == 'yes' ) : ?>
                                    <a href="<?php echo esc_attr( $icon_link ); ?>" <?php echo $external; ?><?php echo $no_follow; ?>><i class="fa fa-link"></i></a>
								<?php endif; ?>
                            </div>
                        </div>


                    </div>
				<?php } ?>

            </div>

        </div><!-- End Work Section -->
		<?php
	}

	protected function _content_template() {

	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Eap_filtergalllery() );