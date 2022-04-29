<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Epa_timeline extends Widget_Base {

	public function get_name() {
		return 'epa-timeline';
	}

	public function get_title() {
		return __( 'Timeline', 'wfe_ccn' );
	}

	public function get_icon() {
		return 'eicon-time-line wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc

	protected function _register_controls() {
		$this->start_controls_section( 'epa_timeline_content_section', [
			'label' => __( 'Content', 'epa_elementor' ),
		] );

		$this->add_control( 'epa_choose_content_timeline', [
			'label'       => esc_html__( 'Content Source', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT,
			'default'     => 'custom',
			'label_block' => false,
			'options'     => [
				'custom'         => esc_html__( 'Custom', 'epa_elementor' ),
				'post'           => esc_html__( 'Post', 'epa_elementor' ),
				'page'           => esc_html__( 'Page', 'epa_elementor' ),
				'manual-section' => esc_html__( 'Manual Section', 'epa_elementor' ),
			],
		] );

		$this->end_controls_section();

		/**
		 * Custom Content Settings
		 */
		$this->start_controls_section( 'epa_timeline_custom_settings', [
			'label'     => __( 'Custom Content', 'epa_elementor' ),
			'condition' => [
				'epa_choose_content_timeline' => 'custom',
			],
		] );

		$this->add_control( 'epa_coustom_content_posts', [
			'type'        => Controls_Manager::REPEATER,
			'seperator'   => 'before',
			'default'     => [
				[
					'epa_custom_title'          => __( 'Essential Premium Addons For Elementor', 'epa_elementor' ),
					'epa_custom_excerpt'        => __( 'A new concept of showing content in your web page with more interactive way.', 'epa_elementor' ),
					'epa_custom_post_date'      => 'Nov 09, 2017',
					'epa_button_text_link'  => '#',
					'epa_custom_read_more'      => 'yes',
					'epa_custom_read_more_text' => 'Read More',
				],
			],
			'fields'      => [
				[
					'name'        => 'epa_custom_title',
					'label'       => esc_html__( 'Title', 'epa_elementor' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => esc_html__( 'Essential Premium Addons For Elementor', 'epa_elementor' ),
					'dynamic'     => [ 'active' => true ],
				],
				[
					'name'        => 'epa_custom_excerpt',
					'label'       => esc_html__( 'Content', 'epa_elementor' ),
					'type'        => Controls_Manager::WYSIWYG,
					'label_block' => true,
					'default'     => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, obcaecati, quisquam id molestias eaque asperiores voluptatibus cupiditate error assumenda delectus odit
                        similique earum voluptatem doloremque dolorem ipsam quae rerum quis.', 'epa_elementor' ),
				],
				[
					'name'    => 'epa_custom_post_date',
					'label'   => __( 'Post Date', 'epa_elementor' ),
					'type'    => Controls_Manager::TEXT,
					'default' => esc_html__( 'Nov 09, 2017', 'epa_elementor' ),
				],
				[
					'name'      => 'epa_custom_image_or_icon',
					'label'     => __( 'Show Circle Image / Icon', 'epa_elementor' ),
					'type'      => Controls_Manager::CHOOSE,
					'options'   => [
						'img'  => [
							'title' => __( 'Image', 'epa_elementor' ),
							'icon'  => 'fa fa-picture-o',
						],
						'icon' => [
							'title' => __( 'Icon', 'epa_elementor' ),
							'icon'  => 'fa fa-info',
						],
					],
					'default'   => 'icon',
					'separator' => 'before',
				],
				[
					'name'      => 'epa_custom_icon_image',
					'label'     => esc_html__( 'Icon Image', 'epa_elementor' ),
					'type'      => Controls_Manager::MEDIA,
					'default'   => [
						'url' => Utils::get_placeholder_image_src(),
					],
					'condition' => [
						'epa_custom_image_or_icon' => 'img',
					],
				],
				[
					'name'      => 'epa_custom_image_size',
					'label'     => esc_html__( 'Image Size', 'epa_elementor' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => 24,
					'condition' => [
						'epa_custom_image_or_icon' => 'img',
					],

				],
				[
					'name'      => 'epa_custom_content_timeline_circle_icon',
					'label'     => esc_html__( 'Icon', 'epa_elementor' ),
					'type'      => Controls_Manager::ICON,
					'default'   => 'fa fa-pencil',
					'condition' => [
						'epa_custom_image_or_icon' => 'icon',
					],
				],
				[
					'name'      => 'epa_show_custom_title',
					'label'     => __( 'Show Title', 'epa_elementor' ),
					'type'      => Controls_Manager::CHOOSE,
					'options'   => [
						'yes' => [
							'title' => __( 'Yes', 'epa_elementor' ),
							'icon'  => 'fa fa-check',
						],
						'no'  => [
							'title' => __( 'No', 'epa_elementor' ),
							'icon'  => 'fa fa-ban',
						],
					],
					'default'   => 'yes',
					'separator' => 'before',
				],
				[
					'name'      => 'epa_custom_read_more',
					'label'     => __( 'Show Read More', 'epa_elementor' ),
					'type'      => Controls_Manager::CHOOSE,
					'options'   => [
						'yes' => [
							'title' => __( 'Yes', 'epa_elementor' ),
							'icon'  => 'fa fa-check',
						],
						'no'  => [
							'title' => __( 'No', 'epa_elementor' ),
							'icon'  => 'fa fa-ban',
						],
					],
					'default'   => 'yes',
					'separator' => 'before',
				],
				[
					'name'        => 'epa_custom_read_more_text',
					'label'       => esc_html__( 'Label Text', 'epa_elementor' ),
					'type'        => Controls_Manager::TEXT,
					'label_block' => true,
					'default'     => esc_html__( 'Read More', 'epa_elementor' ),
					'condition'   => [
						'epa_custom_read_more' => 'yes',
					],
				],
				[
					'name'          => 'epa_readmore_text_link',
					'label'         => esc_html__( 'Button Link', 'epa_elementor' ),
					'type'          => Controls_Manager::URL,
					'label_block'   => true,
					'default'       => [
						'url'         => '#',
						'is_external' => '',
					],
					'show_external' => true,
					'condition'     => [
						'epa_custom_read_more' => 'yes',
					],
				],
			],
			'title_field' => '{{epa_custom_title}}',
		] );


		$this->end_controls_section();


		/*
		 * Posts Query
		 * */
		$this->start_controls_section( 'epa_timeline_posts_query', [
			'label'     => esc_html__( 'Dynamic Content', 'epa_elementor' ),
			'condition' => [
				'epa_choose_content_timeline' => [
					'post',
					'page',
					'manual-section',
				],
			],
		] );

		$this->add_control( 'epa_timeline_post_type_author', [
			'label'       => esc_html__( 'Author', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT2,
			'label_block' => true,
			'multiple'    => true,
			'condition'   => [
				'epa_choose_content_timeline!' => 'manual-section',
			],
			'options'     => epa_postsgrid_post_type_author(),
		] );

		$this->add_control( 'epa_timeline_post_type_categories', [
			'label'       => esc_html__( 'Categories', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT2,
			'label_block' => true,
			'multiple'    => true,
			'options'     => epa_postsgrid_post_type_categories(),
			'condition'   => [
				'epa_choose_content_timeline' => 'post',
			],
		] );

		$this->add_control( 'epa_timeline_post_type_tags', [
			'label'       => esc_html__( 'Tags', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT2,
			'label_block' => true,
			'multiple'    => true,
			'options'     => epa_postsgrid_post_type_tags(),
			'condition'   => [
				'epa_choose_content_timeline' => 'post',
			],
		] );

		$post_formats_terms = get_terms( array( 'taxonomy' => 'post_format' ) );
		if ( ! empty( $post_formats_terms ) && ! is_wp_error( $post_formats_terms ) ) {
			$this->add_control( 'epa_timeline_post_type_formats', [
				'label'       => esc_html__( 'Post Format', 'epa_elementor' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'options'     => epa_postsgrid_post_type_format(),
				'condition'   => [
					'epa_choose_content_timeline' => 'post',
				],
			] );
		}

		$this->add_control( 'epa_timeline_post_list_exclude', [
			'label'       => esc_html__( 'Choose Posts to Exclude', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT2,
			'label_block' => true,
			'multiple'    => true,
			'options'     => epa_postsgrid_post_list_selection(),
			'condition'   => [
				'epa_choose_content_timeline!' => 'manual-section',
			],
		] );
		$this->add_control( 'epa_timeline_post_manual_exclude', [
			'label'       => esc_html__( 'Search & Select', 'epa_elementor' ),
			'type'        => Controls_Manager::SELECT2,
			'label_block' => true,
			'multiple'    => true,
			'options'     => epa_postsgrid_post_list_selection(),
			'condition'   => [
				'epa_choose_content_timeline' => 'manual-section',
			],
		] );

		$this->add_control( 'epa_timeline_post_post_count', [
			'label'   => esc_html__( 'Show Post Count', 'epa_elementor' ),
			'type'    => Controls_Manager::NUMBER,
			'default' => '6',
		] );
		$this->add_control( 'epa_timeline_post_order_by', [
			'label'   => esc_html__( 'Order By', 'epa_elementor' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'date',
			'options' => [
				'date'          => esc_html__( 'Default - Date', 'epa_elementor' ),
				'title'         => esc_html__( 'Post Title', 'epa_elementor' ),
				'menu_order'    => esc_html__( 'Menu Order', 'epa_elementor' ),
				'modified'      => esc_html__( 'Last Modified', 'epa_elementor' ),
				'comment_count' => esc_html__( 'Comment Count', 'epa_elementor' ),
				'rand'          => esc_html__( 'Random', 'epa_elementor' ),
			],
		] );


		$this->add_control( 'epa_timeline_post_order_asc_desc', [
			'label'   => esc_html__( 'Order', 'epa_elementor' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'DESC',
			'options' => [
				'ASC'  => esc_html__( 'Ascending', 'epa_elementor' ),
				'DESC' => esc_html__( 'Descending', 'epa_elementor' ),
			],
		] );
		$this->add_control( 'epa_timeline_post_excerpt_count', [
			'label'   => esc_html__( 'Excerpt Words', 'epa_elementor' ),
			'type'    => Controls_Manager::NUMBER,
			'default' => '20',
		] );
		$this->add_control( 'epa_timeline_post_offset_count', [
			'label'       => esc_html__( 'Offset Count', 'epa_elementor' ),
			'type'        => Controls_Manager::NUMBER,
			'min'         => '0',
			'default'     => '0',
			'description' => esc_html__( 'Use this to skip over posts (Example: 3 would skip the first 3 posts.)', 'epa_elementor' ),
		] );


		$this->end_controls_section();


		/*
		 * Posts Query
		 * */
		$this->start_controls_section( 'epa_timeline_settings', [
			'label'     => esc_html__( 'Settings', 'epa_elementor' ),
			'condition' => [
				'epa_choose_content_timeline' => [
					'post',
					'page',
					'manual-section',
				],
			],
		] );

		$this->add_control( 'epa_custom_image_or_icon', [
			'label'     => __( 'Show Circle Image / Icon', 'epa_elementor' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'img'  => [
					'title' => __( 'Image', 'epa_elementor' ),
					'icon'  => 'fa fa-picture-o',
				],
				'icon' => [
					'title' => __( 'Icon', 'epa_elementor' ),
					'icon'  => 'fa fa-info',
				],
			],
			'default'   => 'icon',
			'separator' => 'before',
		] );
		$this->add_control( 'epa_custom_icon_image', [
			'label'     => esc_html__( 'Icon Image', 'epa_elementor' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => Utils::get_placeholder_image_src(),
			],
			'condition' => [
				'epa_custom_image_or_icon' => 'img',
			],
		] );
		$this->add_control( 'epa_custom_image_size', [
			'label'     => esc_html__( 'Image Size', 'epa_elementor' ),
			'type'      => Controls_Manager::NUMBER,
			'default'   => 24,
			'condition' => [
				'epa_custom_image_or_icon' => 'img',
			],
		] );
		$this->add_control( 'epa_custom_content_timeline_circle_icon', [
			'label'     => esc_html__( 'Icon', 'epa_elementor' ),
			'type'      => Controls_Manager::ICON,
			'default'   => 'fa fa-pencil',
			'condition' => [
				'epa_custom_image_or_icon' => 'icon',
			],
		] );
		$this->add_control( 'epa_custom_title', [
			'label'     => __( 'Show Title', 'epa_elementor' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'yes' => [
					'title' => __( 'Yes', 'epa_elementor' ),
					'icon'  => 'fa fa-check',
				],
				'no'  => [
					'title' => __( 'No', 'epa_elementor' ),
					'icon'  => 'fa fa-ban',
				],
			],
			'default'   => 'yes',
			'separator' => 'before',
		] );

		$this->add_control( 'epa_custom_read_more', [
			'label'     => __( 'Show Read More', 'epa_elementor' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'yes' => [
					'title' => __( 'Yes', 'epa_elementor' ),
					'icon'  => 'fa fa-check',
				],
				'no'  => [
					'title' => __( 'No', 'epa_elementor' ),
					'icon'  => 'fa fa-ban',
				],
			],
			'default'   => 'yes',
			'separator' => 'before',
		] );
		$this->add_control( 'epa_custom_read_more_text', [
			'label'       => esc_html__( 'Label Text', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'default'     => esc_html__( 'Read More', 'epa_elementor' ),
			'condition'   => [
				'epa_custom_read_more' => 'yes',
			],
		] );


		$this->end_controls_section();


		/**
		 * TimeLine Style Sections!
		 */

		$this->start_controls_section( 'epa_section_post_timeline_style', [
			'label' => __( 'Timeline Style', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'epa_timeline_line_size', [
			'label'     => esc_html__( 'Line Size', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 4,
			],
			'range'     => [
				'px' => [
					'max' => 50,
				],
			],
			'selectors' => [
				'{{WRAPPER}} #epa-timeline::before'  => 'width: {{SIZE}}px;',
			],
		] );

		$this->add_control( 'epa_timeline_line_from_left', [
			'label'       => esc_html__( 'Position From Left', 'epa_elementor' ),
			'type'        => Controls_Manager::SLIDER,
			'default'     => [
				'size' => 2,
			],
			'range'       => [
				'px' => [
					'max' => 50,
				],
			],
			'selectors'   => [
				'{{WRAPPER}} #epa-timeline::before' => 'margin-left: -{{SIZE}}px;',
			],
			'description' => __( 'Use half of the Line size for perfect centering', 'epa_elementor' ),
		] );

		$this->add_control( 'epa_timeline_line_color', [
			'label'     => __( 'Line Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#d7e4ed',
			'selectors' => [
				'{{WRAPPER}} #epa-timeline::before' => 'background: {{VALUE}}',
			],

		] );

		$this->end_controls_section();

		/**
		 * Card Style
		 */
		$this->start_controls_section( 'epa_section_post_timelinebox_style', [
			'label' => __( 'TimeLine Box Style', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'epa_timelinebox_bg_color', [
			'label'     => __( 'Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#f1f2f3',
			'selectors' => [
				'{{WRAPPER}} .epa-timeline-content'  => 'background: {{VALUE}};',
				'{{WRAPPER}} .epa-timeline-content::before' => '  border-color: transparent; border-left-color: {{VALUE}};',
				'{{WRAPPER}} .epa-timeline-block:nth-child(even) .epa-timeline-content::before' => '  border-color: transparent; border-right-color: {{VALUE}};',

			],

		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_timelinebox_border',
			'label'    => esc_html__( 'Border', 'epa_elementor' ),
			'selector' => '{{WRAPPER}} .epa-timeline-content',
		] );

		$this->add_responsive_control( 'epa_timelinebox_radius', [
			'label'      => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-timeline-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'epa_card_shadow',
			'selector' => '{{WRAPPER}} .epa-timeline-content',
		] );


		$this->add_responsive_control( 'epa_timelinebox_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-timeline-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'epa_timelinebox_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-timeline-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		/**
		 * Icon Circle Style
		 */
		$this->start_controls_section( 'epa_section_bullet_style', [
			'label' => __( 'Bullet Style', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'epa_bullet_size', [
			'label'     => esc_html__( 'Bullet Size', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 55,
			],
			'range'     => [
				'px' => [
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-timeline-img' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
			],
		] );

		$this->add_responsive_control( 'epa_icon_font_size', [
			'label'     => esc_html__( 'Icon Size', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 14,
			],
			'range'     => [
				'px' => [
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-timeline-img i' => 'font-size: {{SIZE}}px;',
			],
		] );

		$this->add_control( 'epa_icon_font_color', [
			'label'     => __( 'Icon Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#fff',
			'selectors' => [
				'{{WRAPPER}} .epa-timeline-img i' => 'color: {{VALUE}}',
			],

		] );

		$this->add_responsive_control( 'epa_icon_circle_from_top', [
			'label'     => esc_html__( 'Position From Top', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 8,
			],
			'range'     => [
				'px' => [
					'min' => -150,
					'max' => 300,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-timeline-img'                                => 'margin-top: {{SIZE}}px;',
			],
		] );

		$this->add_responsive_control( 'epa_icon_circle_from_left', [
			'label'       => esc_html__( 'Position From Left', 'epa_elementor' ),
			'type'        => Controls_Manager::SLIDER,
			'description' => __( 'Use half of the Icon Cicle Size for perfect centering', 'epa_elementor' ),
			'range'       => [
				'px' => [
					'max' => 100,
				],
			],
			'selectors'   => [
				'{{WRAPPER}} .epa-timeline-img' => 'margin-left: -{{SIZE}}px;',
			],
		] );

		$this->add_responsive_control( 'epa_icon_circle_border_width', [
			'label'     => esc_html__( 'Bullet Border Width', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 6,
			],
			'range'     => [
				'px' => [
					'max' => 30,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-timeline-img' => 'border-width: {{SIZE}}px;',
			],
		] );

		$this->add_control( 'epa_icon_circle_color', [
			'label'     => __( 'Bullet Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#00bfd5',
			'selectors' => [
				'{{WRAPPER}} .epa-timeline-img.epa-picture' => 'background: {{VALUE}}',
			],

		] );


		$this->add_control( 'epa_icon_circle_border_color', [
			'label'     => __( 'Bullet Border Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#f2f2f2',
			'selectors' => [
				'{{WRAPPER}} .epa-timeline-img' => 'border-color: {{VALUE}}',
			],

		] );
		$this->end_controls_section();

		$this->start_controls_section( 'epa_section_typography', [
			'label' => __( 'Color & Typography', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'epa_timeline_title_style', [
			'label'     => __( 'Title Style', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'epa_timeline_title_color', [
			'label'     => __( 'Title Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#303e49',
			'selectors' => [
				'{{WRAPPER}} .epa-timeline-content h2'   => 'color: {{VALUE}};',
			],

		] );

		$this->add_responsive_control( 'epa_timeline_title_alignment', [
			'label'     => __( 'Title Alignment', 'epa_elementor' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'left'   => [
					'title' => __( 'Left', 'epa_elementor' ),
					'icon'  => 'fa fa-align-left',
				],
				'center' => [
					'title' => __( 'Center', 'epa_elementor' ),
					'icon'  => 'fa fa-align-center',
				],
				'right'  => [
					'title' => __( 'Right', 'epa_elementor' ),
					'icon'  => 'fa fa-align-right',
				],
			],
			'default'   => 'left',
			'selectors' => [
				'{{WRAPPER}} .epa-timeline-content h2'   => 'text-align: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_timeline_title_typography',
			'label'    => __( 'Typography', 'epa_elementor' ),
			'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .epa-content-timeline-content h2',
		] );

		$this->add_control( 'epa_timeline_excerpt_style', [
			'label'     => __( 'Excerpt Style', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'epa_timeline_excerpt_color', [
			'label'     => __( 'Excerpt Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#333',
			'selectors' => [
				'{{WRAPPER}} .epa-timeline-content p' => 'color: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'epa_timeline_excerpt_alignment', [
			'label'     => __( 'Excerpt Alignment', 'epa_elementor' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'left'    => [
					'title' => __( 'Left', 'epa_elementor' ),
					'icon'  => 'fa fa-align-left',
				],
				'center'  => [
					'title' => __( 'Center', 'epa_elementor' ),
					'icon'  => 'fa fa-align-center',
				],
				'right'   => [
					'title' => __( 'Right', 'epa_elementor' ),
					'icon'  => 'fa fa-align-right',
				],
				'justify' => [
					'title' => __( 'Justified', 'epa_elementor' ),
					'icon'  => 'fa fa-align-justify',
				],
			],
			'default'   => 'left',
			'selectors' => [
				'{{WRAPPER}} .epa-timeline-content p' => 'text-align: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_timeline_excerpt_typography',
			'label'    => __( 'Excerpt Typography', 'epa_elementor' ),
			'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
			'selector' => '{{WRAPPER}} .epa-timeline-content p',
		] );

		$this->add_control( 'epa_timeline_date_style', [
			'label'     => __( 'Date Style', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'epa_timeline_date_color', [
			'label'     => __( 'Date Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#4d4d4d',
			'selectors' => [
				'{{WRAPPER}} .epa-timeline-content .cd-date' => 'color: {{VALUE}};',
			],
		] );
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_timeline_date_typography',
			'label'    => __( 'Date Typography', 'epa_elementor' ),
			'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
			'selector' => '{{WRAPPER}} .epa-timeline-content .cd-date',
		] );

		$this->add_responsive_control( 'epa_timeline_date_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-timeline-content .cd-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Button Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section( 'epa_button_button_style', [
			'label' => esc_html__( 'Button Style', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
			'condition' => [
				'epa_custom_read_more' => 'yes'
			],
		] );

		$this->add_responsive_control( 'epa_button_padding', [
			'label'      => esc_html__( 'Padding', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-timeline-content .cd-read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'epa_button_margin', [
			'label'      => esc_html__( 'Margin', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-timeline-content .cd-read-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'epa_button_typography',
			'selector' => '{{WRAPPER}} .epa-timeline-content .cd-read-more',
		] );

		$this->start_controls_tabs( 'epa_button_tabs' );

		// Normal State Tab
		$this->start_controls_tab( 'epa_button_normal', [ 'label' => esc_html__( 'Normal', 'epa_elementor' ) ] );

		$this->add_control( 'epa_button_normal_text_color', [
			'label'     => esc_html__( 'Text Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#fff',
			'selectors' => [
				'{{WRAPPER}} .epa-timeline-content .cd-read-more' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_button_normal_bg_color', [
			'label'     => esc_html__( 'Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#00BFD5',
			'selectors' => [
				'{{WRAPPER}} .epa-timeline-content .cd-read-more' => 'background: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'epa_button_normal_border',
			'label'    => esc_html__( 'Border', 'epa_elementor' ),
			'selector' => '{{WRAPPER}} .epa-timeline-content .cd-read-more',
		] );

		$this->add_control( 'epa_button_border_radius', [
			'label'     => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .epa-timeline-content .cd-read-more' => 'border-radius: {{SIZE}}px;',
			],
		] );

		$this->end_controls_tab();

		// Hover State Tab
		$this->start_controls_tab( 'epa_button_hover', [ 'label' => esc_html__( 'Hover', 'epa_elementor' ) ] );

		$this->add_control( 'epa_button_hover_text_color', [
			'label'     => esc_html__( 'Text Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#f9f9f9',
			'selectors' => [
				'{{WRAPPER}} .epa-timeline-content .cd-read-more:hover' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_button_hover_bg_color', [
			'label'     => esc_html__( 'Background Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#bac4cb',
			'selectors' => [
				'{{WRAPPER}} .epa-timeline-content .cd-read-more:hover' => 'background: {{VALUE}};',
			],
		] );

		$this->add_control( 'epa_button_hover_border_color', [
				'label'     => esc_html__( 'Border Color', 'epa_elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .epa-timeline-content .cd-read-more:hover' => 'border-color: {{VALUE}};',
				],
			]

		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'      => 'epa_button_shadow',
			'selector'  => '{{WRAPPER}} .epa-timeline-content .cd-read-more',
			'separator' => 'before',
		] );

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$output   = '';
		$output   .= '<section id="epa-timeline" class="cd-container epa-timeline-' . $this->get_id() . '" >';

		if ( $settings['epa_choose_content_timeline'] == 'post' || $settings['epa_choose_content_timeline'] == 'page' || $settings['epa_choose_content_timeline'] == 'manual-section' ) {

			global $post;
			if ( get_query_var( 'paged' ) ) {
				$paged = get_query_var( 'paged' );
			} else if ( get_query_var( 'page' ) ) {
				$paged = get_query_var( 'page' );
			} else {
				$paged = 1;
			}
			$post_per_page = $settings['epa_timeline_post_post_count'];
			$offset        = $settings['epa_timeline_post_offset_count'];
			$offset_new    = $offset + ( ( $paged - 1 ) * $post_per_page );

			// Author List
			$authorarr = $settings['epa_timeline_post_type_author']; // get custom field value
			if ( $authorarr >= 1 ) {
				$authorid = implode( ', ', $authorarr );
			} else {
				$authorid = '';
			}


			// Category List Exclude
			if ( ! empty( $settings['epa_timeline_post_type_categories'] ) ) {
				$catarray = $settings['epa_timeline_post_type_categories']; // get custom field value
				if ( $catarray >= 1 && $settings['epa_choose_content_timeline'] == 'post' ) {
					$catids            = implode( ', ', $catarray );
					$catformatoperator = 'IN';

				} else {
					$catids            = '';
					$catformatoperator = 'NOT IN';
				}
			} else {
				$catids            = '';
				$catformatoperator = 'NOT IN';
			}

			// TAGS Exclude

			if ( ! empty( $settings['epa_timeline_post_type_tags'] ) ) {

				$tagarray = $settings['epa_timeline_post_type_tags']; // get custom field value
				if ( $tagarray >= 1 && $settings['epa_choose_content_timeline'] == 'post' ) {
					$tagids            = implode( ', ', $tagarray );
					$tagidsexpand      = explode( ', ', $tagids );
					$tagformatoperator = 'IN';

				} else {
					$tagidsexpand      = '';
					$tagformatoperator = 'NOT IN';
				}
			} else {
				$tagidsexpand      = '';
				$tagformatoperator = 'NOT IN';
			}

			// Fotmats
			if ( ! empty( $settings['epa_timeline_post_type_formats'] ) ) {

				$formatarray = $settings['epa_timeline_post_type_formats']; // get custom field value
				if ( $formatarray >= 1 ) {
					$formatids       = implode( ', ', $formatarray );
					$formatidsexpand = explode( ', ', $formatids );
					$formatoperator  = 'IN';
				} else {
					$formatidsexpand = '';
					$formatoperator  = 'NOT IN';
				}

			} else {
				$formatidsexpand = '';
				$formatoperator  = 'NOT IN';
			}

			// Post & Page Exclude
			$post_exclude_array = $settings['epa_timeline_post_list_exclude']; // get custom field value

			if ( $post_exclude_array >= 1 && $settings['epa_choose_content_timeline'] == 'post' || $settings['epa_choose_content_timeline'] == 'page' ) {
				$post_exlude_id = $post_exclude_array;
			} else {
				$post_exlude_id = array();
			}

			// Manual Post Exclude
			$manual_post_exclude_array = $settings['epa_timeline_post_manual_exclude']; // get custom field value

			if ( $manual_post_exclude_array >= 1 && $settings['epa_choose_content_timeline'] == 'manual-section' ) {
				$manual_post_exlude_id = $manual_post_exclude_array;
			} else {
				$manual_post_exlude_id = array();
			}
			// Post Type
			$timeline_posttype = '';
			if($settings['epa_choose_content_timeline'] == 'post') {
				$timeline_posttype = 'post';
			}
			if($settings['epa_choose_content_timeline'] == 'page') {
				$timeline_posttype = 'page';
			}
			if($settings['epa_choose_content_timeline'] == 'manual-section') {
				$timeline_posttype = ['post', 'page'];
			}

			$args = array(
				'post_type'      => $timeline_posttype,
				'posts_per_page' => $post_per_page,
				'paged'          => $paged,
				'post__not_in'   => $post_exlude_id,
				'post__in'       => $manual_post_exlude_id,
				'offset'         => $offset_new,
				//'category' => 0,
				'orderby'        => '' . $settings['epa_timeline_post_order_by'] . '',
				'order'          => '' . $settings['epa_timeline_post_order_asc_desc'] . '',
				'post_status'    => 'publish',
				'author'         => $authorid,
				'tax_query'      => array(
					'relation' => 'AND',
					array(
						'relation' => 'OR',
						array(
							'taxonomy' => 'post_format',
							'field'    => 'id',
							'operator' => $formatoperator,
							'terms'    => $formatidsexpand,
						),
					),
					array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'category',
							'field'    => 'id',
							'terms'    => $catids,
							'operator' => $catformatoperator,
						),
						array(
							'taxonomy' => 'post_tag',
							'field'    => 'id',
							'terms'    => $tagidsexpand,
							'operator' => $tagformatoperator,
						),
					),
				)
				//'suppress_filters' => true
			);

			$post_query = new \WP_Query( $args );
			while ( $post_query->have_posts() ) :
				$post_query->the_post();
				$output .= '<div class="epa-timeline-block epa-timeline">
                <div class="epa-timeline-img epa-picture">';

				if ( $settings['epa_custom_image_or_icon'] == 'img' ) {
					$output .= '<img src="'.$settings['epa_custom_icon_image']['url'].'" alt="Picture" height="'.$settings['epa_custom_image_size'].'" width="'.$settings['epa_custom_image_size'].'">';
				}
				if ( $settings['epa_custom_image_or_icon'] == 'icon' ) {
					$output .= '<i class="'.$settings['epa_custom_content_timeline_circle_icon'].'"></i>';
				}

				$output .= '</div> <!-- epa-timeline-img -->

                <div class="epa-timeline-content" id="epa-timeline-item-' . get_the_ID() . '">
                    <h2>' . get_the_title() . '</h2>
                    <p>' . epa_postsQuery_excerpt( $settings['epa_timeline_post_excerpt_count'] ) . '</p>';

				if ( $settings['epa_custom_read_more'] == 'yes' ) {
					$output .= ' <a href="' . get_the_permalink() . '" class="cd-read-more">' . $settings['epa_custom_read_more_text'] . '</a>';
				}

				$output .= '<span class="cd-date">' . get_the_date() . '</span>
                </div> <!-- epa-timeline-content -->
            </div> <!-- epa-timeline-block -->';
			endwhile;

			/*
			 * Custom CSS
			 * */
		while ( $post_query->have_posts() ) :
				$post_query->the_post();
			$output .= '<style type="text/css">
		@media only screen and (max-width: 1025px) {
				.epa-timeline-' . $this->get_id() . ' #epa-timeline-item-' . get_the_ID() . '::before {
   				border-right: 7px solid ' . $settings['epa_timelinebox_bg_color'] . ';
   				border-left-color: transparent;
   				border-right-color: ' . $settings['epa_timelinebox_bg_color'] . ';
		}
	}
		</style>';
		endwhile;

		}


		if ( $settings['epa_choose_content_timeline'] == 'custom' ) {

			foreach ( $settings['epa_coustom_content_posts'] as $item ) {
				$timeline_url      = $item['epa_readmore_text_link']['url']; // Infobox URL Value
				$timeline_target   = $item['epa_readmore_text_link']['is_external'] ? ' target="_blank"' : '';
				$timeline_nofollow = $item['epa_readmore_text_link']['nofollow'] ? ' rel="nofollow"' : '';


				$output .= '<div class="epa-timeline-block epa-timeline-' . $item['_id'] . '">
                <div class="epa-timeline-img epa-picture">';

				if ( $item['epa_custom_image_or_icon'] == 'img' ) {
					$output .= '<img src="'.$item['epa_custom_icon_image']['url'].'" alt="Picture" height="'.$item['epa_custom_image_size'].'" width="'.$item['epa_custom_image_size'].'">';
				}
				if ( $item['epa_custom_image_or_icon'] == 'icon' ) {
					$output .= '<i class="'.$item['epa_custom_content_timeline_circle_icon'].'"></i>';
				}

				$output .= '</div> <!-- epa-timeline-img -->

                <div class="epa-timeline-content" id="epa-timeline-item-' . $item['_id'] . '">';

				if ($item['epa_show_custom_title'] == 'yes') {
					$output .= ' <h2>' . $item['epa_custom_title'] . '</h2>';
				}
					$output .= ' <p>' . $item['epa_custom_excerpt'] . '</p>';

				if ( $item['epa_custom_read_more'] == 'yes' ) {
					$output .= ' <a href="' . $timeline_url . '" ' . $timeline_target . $timeline_nofollow . ' class="cd-read-more">' . $item['epa_custom_read_more_text'] . '</a>';
				}

				$output .= '<span class="cd-date">' . $item['epa_custom_post_date'] . '</span>
                </div> <!-- epa-timeline-content -->
            </div> <!-- epa-timeline-block -->';
			}
		}

		$output .= '</section>';
		if(is_array($settings['epa_coustom_content_posts'])){
			foreach ( $settings['epa_coustom_content_posts'] as $item ) {
				$output .= '<style type="text/css">
		@media only screen and (max-width: 1025px) {
				.epa-timeline-' . $this->get_id() . ' #epa-timeline-item-' . $item['_id'] . '::before {
   				border-right: 7px solid ' . $settings['epa_timelinebox_bg_color'] . ';
   				border-left-color: transparent;
   				border-right-color: ' . $settings['epa_timelinebox_bg_color'] . ';
		}
	}

		</style>';
			}
		}


		echo $output;

	}

	protected function _content_template() {
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Epa_timeline() );