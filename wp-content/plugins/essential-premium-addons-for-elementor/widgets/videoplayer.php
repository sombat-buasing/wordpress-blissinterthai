<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Epa_videoplayer extends Widget_Base {

	public function get_name() {
		return 'wfe-videoplayer';
	}

	public function get_title() {
		return esc_html__( 'video Player', 'epa_elementor' );
	}

	public function get_icon() {
		return 'fa fa-video-camera wfe-ccn-pe';
	}


	public function get_categories() {
		return [ 'wfe-ccn' ];
	}

	// Adding the controls fields for the premium title
	// This will controls the animation, colors and background, dimensions etc
	protected function _register_controls() {

		$this->start_controls_section( 'section_content', [
			'label' => esc_html__( 'Content', 'epa_elementor' ),
		] );

		$this->add_control( 'video_content_type', [
			'label'   => esc_html__( 'Video Type', 'epa_elementor' ),
			'type'    => Controls_Manager::CHOOSE,
			'options' => [
				'mp4'     => [
					'title' => esc_html__( 'MP4', 'epa_elementor' ),
					'icon'  => 'fa fa-video-camera',
				],
				'webm'    => [
					'title' => esc_html__( 'WEBM', 'epa_elementor' ),
					'icon'  => 'fa fa-file-video-o',
				],
				'youtube' => [
					'title' => esc_html__( 'Youtube', 'epa_elementor' ),
					'icon'  => 'fa fa-youtube',
				],
				'vimeo'   => [
					'title' => esc_html__( 'Vimeo', 'epa_elementor' ),
					'icon'  => 'fa fa-vimeo',
				],
			],
			'default' => 'mp4',
			'toggle'  => true,
		] );

		$this->add_control( 'video_source_mp4', [
			'label'     => esc_html__( 'Video Sorce', 'epa_elementor' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'url'  => [
					'title' => esc_html__( 'URL', 'epa_elementor' ),
					'icon'  => 'fa fa-link',
				],
				'file' => [
					'title' => esc_html__( 'FILE', 'epa_elementor' ),
					'icon'  => 'fa fa-file',
				],
			],
			'default'   => 'url',
			'condition' => [
				'video_content_type' => 'mp4',
			],
			'toggle'    => true,
		] );

		/* Video Source WEMB */
		$this->add_control( 'video_source_webm', [
			'label'     => esc_html__( 'Video Sorce', 'epa_elementor' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'url'  => [
					'title' => esc_html__( 'URL', 'epa_elementor' ),
					'icon'  => 'fa fa-link',
				],
				'file' => [
					'title' => esc_html__( 'FILE', 'epa_elementor' ),
					'icon'  => 'fa fa-file',
				],
			],
			'default'   => 'url',
			'toggle'    => true,
			'condition' => [
				'video_content_type' => 'webm',
			],
		] );

		$this->add_control( 'video_url_mp4', [
			'label'       => esc_html__( 'URL', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'description' => esc_html__( 'Insert URL to an .mp4 video file', 'epa_elementor' ),
			'default'     => '',
			'dynamic'     => [
				'active' => true,
			],
			'condition'   => [
				'video_content_type' => 'mp4',
				'video_source_mp4'   => 'url',
			],
		] );

		$this->add_control( 'video_file_mp4', [
			'label'      => esc_html__( 'File', 'epa_elementor' ),
			'type'       => Controls_Manager::MEDIA,
			'dynamic'    => [
				'active' => true,
			],
			'media_type' => 'video',
			'condition'  => [
				'video_content_type' => 'mp4',
				'video_source_mp4'   => 'file',
			],
		] );

		$this->add_control( 'video_url_webm', [
			'label'       => esc_html__( 'URL', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => '',
			'description' => __( 'Insert URL to an .webm video file', 'epa_elementor' ),
			'dynamic'     => [
				'active' => true,
			],
			'condition'   => [
				'video_content_type' => 'webm',
				'video_source_webm'  => 'url',
			],
		] );

		$this->add_control( 'video_file_webm', [
			'label'      => esc_html__( 'File', 'epa_elementor' ),
			'type'       => Controls_Manager::MEDIA,
			'dynamic'    => [
				'active' => true,
			],
			'media_type' => 'video',
			'condition'  => [
				'video_content_type' => 'webm',
				'video_source_webm'  => 'file',
			],
		] );

		$this->add_control( 'youtube_video_id', [
			'label'       => esc_html__( 'URL', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => 'ScMzIvxBSi4',
			'description' => __( 'Insert YouTube Video ID. Example: ScMzIvxBSi4, if you do not get youtube Video id. <a href="https://gist.github.com/jakebellacera/d81bbf12b99448188f183141e6696817" target="_blank">Click here</a> to Learn How to get youtube video id ', 'epa_elementor' ),
			'dynamic'     => [
				'active' => true,
			],
			'condition'   => [
				'video_content_type' => 'youtube',
			],
		] );

		$this->add_control( 'vimeo_video_id', [
			'label'       => esc_html__( 'URL', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => '6370469',
			'description' => __( 'Insert Vimeo Video ID. Example: 6370469, if you do not get vimeo video id. <a href="https://help.routeyou.com/en/topic/view/298/vimeo-video-id" target="_blank">Click here</a> to Learn How to get vimeo video id ', 'epa_elementor' ),
			'dynamic'     => [
				'active' => true,
			],
			'condition'   => [
				'video_content_type' => 'vimeo',
			],
		] );

		$this->add_control( 'show_hide_video_cover', [
			'label'        => esc_html__( 'Video Cover?', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Yes', 'epa_elementor' ),
			'label_off'    => esc_html__( 'No', 'epa_elementor' ),
			'return_value' => 'yes',
			'condition'    => [
				'video_content_type' => [ 'mp4', 'webm' ],
			],
		] );

		$this->add_control( 'video_cover', [
			'label'     => esc_html__( 'Choose Cover', 'epa_elementor' ),
			'type'      => Controls_Manager::MEDIA,
			'dynamic'   => [ 'active' => true ],
			'separator' => 'before',
			'condition' => [
				'show_hide_video_cover' => 'yes',
				'video_content_type'    => [ 'mp4', 'webm' ],
			],
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'video_cover',
			'label'     => esc_html__( 'Cover Size', 'epa_elementor' ),
			'default'   => 'large',
			'condition' => [
				'show_hide_video_cover' => 'yes',
				'video_cover[url]!'     => '',
			],
		] );

		$this->add_control( 'video_caption', [
			'label'        => esc_html__( 'Video Caption?', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Yes', 'epa_elementor' ),
			'label_off'    => esc_html__( 'No', 'epa_elementor' ),
			'return_value' => 'yes',
			'condition'    => [
				'video_content_type' => [ 'mp4', 'webm' ],
			],
		] );

		/* Video Caption Source */
		$this->add_control( 'video_caption_source', [
			'label'     => esc_html__( 'Caption Sorce', 'epa_elementor' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => [
				'url'  => [
					'title' => esc_html__( 'URL', 'epa_elementor' ),
					'icon'  => 'fa fa-link',
				],
				'file' => [
					'title' => esc_html__( 'FILE', 'epa_elementor' ),
					'icon'  => 'fa fa-file',
				],
			],
			'default'   => 'url',
			'toggle'    => true,
			'condition' => [
				'video_caption' => 'yes',
			],
		] );

		$this->add_control( 'video_caption_label', [
			'label'     => esc_html__( 'Caption Label', 'epa_elementor' ),
			'default'   => 'English',
			'type'      => Controls_Manager::TEXT,
			'condition' => [
				'video_caption' => 'yes',
			],
		] );

		$this->add_control( 'video_caption_url', [
			'label'       => esc_html__( 'URL', 'epa_elementor' ),
			'type'        => Controls_Manager::TEXT,
			'description' => esc_html__( 'Insert Caption to a .vtt format', 'epa_elementor' ),
			'dynamic'     => [
				'active' => true,
			],
			'condition'   => [
				'video_caption'        => 'yes',
				'video_caption_source' => 'url',
			],
		] );

		$this->add_control( 'video_caption_file', [
			'label'       => esc_html__( 'File', 'epa_elementor' ),
			'type'        => Controls_Manager::MEDIA,
			'description' => esc_html__( 'Insert URL to a .vtt caption file', 'epa_elementor' ),
			'dynamic'     => [
				'active' => true,
			],
			'media_type'  => 'video',
			'condition'   => [
				'video_caption'        => 'yes',
				'video_caption_source' => 'file',
			],
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'section_settings', [
			'label' => esc_html__( 'Settings', 'epa_elementor' ),
		] );

		$this->add_control( 'video_behaviour_heading', [
			'label' => esc_html__( 'Behaviour', 'epa_elementor' ),
			'type'  => Controls_Manager::HEADING,
		] );

		$this->add_control( 'video_autoplay', [
			'label'        => esc_html__( 'Auto Play', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => '',
			'label_on'     => esc_html__( 'Yes', 'epa_elementor' ),
			'label_off'    => esc_html__( 'No', 'epa_elementor' ),
			'return_value' => 'yes',
		] );

		$this->add_control( 'video_stop_others', [
			'label'              => esc_html__( 'Stop Others', 'epa_elementor' ),
			'description'        => esc_html__( 'Stop all other videos on page when this video is played.', 'epa_elementor' ),
			'type'               => Controls_Manager::SWITCHER,
			'default'            => '',
			'label_on'           => esc_html__( 'Yes', 'epa_elementor' ),
			'label_off'          => esc_html__( 'No', 'epa_elementor' ),
			'return_value'       => 'yes',
			'frontend_available' => true,
		] );

		$this->add_control( 'video_play_viewport', [
			'label'              => esc_html__( 'Play in Viewport', 'epa_elementor' ),
			'description'        => esc_html__( 'Autoplay video when the player is in viewport', 'epa_elementor' ),
			'type'               => Controls_Manager::SWITCHER,
			'default'            => '',
			'label_on'           => esc_html__( 'Yes', 'epa_elementor' ),
			'label_off'          => esc_html__( 'No', 'epa_elementor' ),
			'return_value'       => 'yes',
			'condition'          => [
				'video_autoplay' => 'autoplay',
			],
			'frontend_available' => true,
		] );


		$this->add_control( 'video_hide_control', [
			'label'        => esc_html__( 'Hide Control', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => '',
			'label_on'     => esc_html__( 'Yes', 'epa_elementor' ),
			'label_off'    => esc_html__( 'No', 'epa_elementor' ),
			'return_value' => 'yes',
		] );

		$this->add_control( 'video_muted', [
			'label'        => esc_html__( 'Video Muted', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => '',
			'label_on'     => esc_html__( 'Yes', 'epa_elementor' ),
			'label_off'    => esc_html__( 'No', 'epa_elementor' ),
			'return_value' => 'yes',
		] );

		$this->add_control( 'video_loop', [
			'label'        => esc_html__( 'Loop', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => '',
			'label_on'     => esc_html__( 'Yes', 'epa_elementor' ),
			'label_off'    => esc_html__( 'No', 'epa_elementor' ),
			'return_value' => 'true',
		] );

		$this->add_control( 'video_display_heading', [
			'label'     => esc_html__( 'Display', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'video_show_play_button', [
			'label'        => esc_html__( 'Large play', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'play-large',
			'description'  => 'The large play button in the center',
			'label_on'     => esc_html__( 'Yes', 'epa_elementor' ),
			'label_off'    => esc_html__( 'No', 'epa_elementor' ),
			'return_value' => 'play-large',
		] );

		$this->add_control( 'video_show_restart_button', [
			'label'        => esc_html__( 'Show Restart', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'restart',
			'description'  => 'The Restart playback button',
			'label_on'     => esc_html__( 'Yes', 'epa_elementor' ),
			'label_off'    => esc_html__( 'No', 'epa_elementor' ),
			'return_value' => 'restart',
		] );

		$this->add_control( 'video_back_rewind', [
			'label'        => esc_html__( 'Back Rewind', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => '',
			'description'  => 'Rewind by the Back seek time (default 10 seconds)',
			'label_on'     => esc_html__( 'Yes', 'epa_elementor' ),
			'label_off'    => esc_html__( 'No', 'epa_elementor' ),
			'return_value' => 'rewind',
		] );

		$this->add_control( 'video_forward_rewind', [
			'label'        => esc_html__( 'Forward Rewind', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => '',
			'description'  => 'Fast forward by the seek time (default 10 seconds)',
			'label_on'     => esc_html__( 'Yes', 'epa_elementor' ),
			'label_off'    => esc_html__( 'No', 'epa_elementor' ),
			'return_value' => 'fast-forward',
		] );

		$this->add_control( 'video_play_pause_button', [
			'label'        => esc_html__( 'Play/pause playback', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'play',
			'description'  => 'Play/pause playback',
			'label_on'     => esc_html__( 'Yes', 'epa_elementor' ),
			'label_off'    => esc_html__( 'No', 'epa_elementor' ),
			'return_value' => 'play',
		] );

		$this->add_control( 'video_progress_bar_button', [
			'label'        => esc_html__( 'Progress Bar and Scrubber', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'progress',
			'description'  => 'The progress bar and scrubber for playback and buffering',
			'label_on'     => esc_html__( 'Yes', 'epa_elementor' ),
			'label_off'    => esc_html__( 'No', 'epa_elementor' ),
			'return_value' => 'progress',
		] );

		$this->add_control( 'video_current_time_button', [
			'label'        => esc_html__( 'Current Time', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'current-time',
			'description'  => 'The current time of playback',
			'label_on'     => esc_html__( 'Yes', 'epa_elementor' ),
			'label_off'    => esc_html__( 'No', 'epa_elementor' ),
			'return_value' => 'current-time',
		] );

		$this->add_control( 'video_full_duration_button', [
			'label'        => esc_html__( 'Full Duration', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'duration',
			'description'  => 'The full duration of the media',
			'label_on'     => esc_html__( 'Yes', 'epa_elementor' ),
			'label_off'    => esc_html__( 'No', 'epa_elementor' ),
			'return_value' => 'duration',
		] );

		$this->add_control( 'video_mute_button', [
			'label'        => esc_html__( 'Mute Button', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'mute',
			'description'  => 'Show Hide Toggle mute Button',
			'label_on'     => esc_html__( 'Yes', 'epa_elementor' ),
			'label_off'    => esc_html__( 'No', 'epa_elementor' ),
			'return_value' => 'mute',
		] );

		$this->add_control( 'video_volume_button', [
			'label'        => esc_html__( 'Volume control', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'volume',
			'description'  => 'Show Hide Volume control Button',
			'label_on'     => esc_html__( 'Yes', 'epa_elementor' ),
			'label_off'    => esc_html__( 'No', 'epa_elementor' ),
			'return_value' => 'volume',
		] );

		$this->add_control( 'video_settings_button', [
			'label'        => esc_html__( 'Settings Menu', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'settings',
			'description'  => 'Show Hide Settings menu',
			'label_on'     => esc_html__( 'Yes', 'epa_elementor' ),
			'label_off'    => esc_html__( 'No', 'epa_elementor' ),
			'return_value' => 'settings',
		] );

		$this->add_control( 'video_fullscreen_button', [
			'label'        => esc_html__( 'Show Fullscreen', 'epa_elementor' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => 'fullscreen',
			'description'  => 'Show Hide Fullscreen Menu',
			'label_on'     => esc_html__( 'Yes', 'epa_elementor' ),
			'label_off'    => esc_html__( 'No', 'epa_elementor' ),
			'return_value' => 'fullscreen',
		] );


		$this->end_controls_section();

		$this->start_controls_section( 'section_video_style', [
			'label' => esc_html__( 'Player', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'video_width', [
			'label'      => esc_html__( 'Width', 'epa_elementor' ),
			'type'       => Controls_Manager::SLIDER,
			'default'    => [
				'size' => '600',
			],
			'range'      => [
				'%'  => [
					'min' => 0,
					'max' => 100,
				],
				'px' => [
					'min' => 200,
					'max' => 1500,
				],
			],
			'size_units' => [ '%', 'px' ],
			'selectors'  => [
				'{{WRAPPER}} .epa-videoplayer-wrapper' => 'max-width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'video_alignment', [
			'label'     => esc_html__( 'Alignment', 'epa_elementor' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => [
				''               => esc_html__( 'Left', 'epa_elementor' ),
				'margin: 0 auto' => esc_html__( 'Center', 'epa_elementor' ),
			],
			'default'   => 'margin: 0 auto',
			'selectors' => [
				'{{WRAPPER}} .epa-videoplayer-wrapper' => '{{VALUE}};',
			],
		] );


		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'video_border',
			'label'    => esc_html__( 'Border', 'epa_elementor' ),
			'selector' => '{{WRAPPER}} .plyr--video',
		] );

		$this->add_control( 'video_border_radius', [
			'label'      => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .plyr--video' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'video_box_shadow',
			'selector' => '{{WRAPPER}} .plyr--video',
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'section_style', [
			'label' => esc_html__( 'Interface', 'epa_elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );
		$this->start_controls_tabs( 'tabs_controls_style' );

		$this->start_controls_tab( 'video_controls', [
			'label' => esc_html__( 'Default', 'epa_elementor' ),
		] );

		$this->add_control( 'video_controls_foreground', [
			'label'     => esc_html__( 'Controls Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#ffffff',
			'selectors' => [
				'{{WRAPPER}} .plyr--video .plyr__controls'       => 'color: {{VALUE}}',
				'{{WRAPPER}} .plyr--full-ui input[type="range"]' => 'color: {{VALUE}}',
				'{{WRAPPER}} .plyr__control--overlaid svg'       => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'video_controls_background', [
			'label'     => esc_html__( 'Controls Background', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .plyr__controls'          => 'background-color: {{VALUE}}',
				'{{WRAPPER}} .plyr__control--overlaid' => 'background: {{VALUE}}',
			],
		] );

		$this->add_control( 'video_controls_opacity', [
			'label'     => esc_html__( 'Controls Opacity (%)', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 0.9,
			],
			'range'     => [
				'px' => [
					'max'  => 1,
					'min'  => 0,
					'step' => 0.01,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .plyr--video .plyr__controls' => 'opacity: {{SIZE}}',
			],
		] );

		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'video_controls_border',
			'label'    => esc_html__( 'Border', 'epa_elementor' ),
			'selector' => '{{WRAPPER}} .plyr--video .plyr__controls',
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'video_controls_shadow',
			'selector' => '{{WRAPPER}} .plyr--video .plyr__controls',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'video_controls_hover', [
			'label' => esc_html__( 'Hover', 'epa_elementor' ),
		] );

		$this->add_control( 'video_controls_foreground_hover', [
			'label'     => esc_html__( 'Controls Color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .plyr--video .plyr__controls:hover'       => 'color: {{VALUE}}',
				'{{WRAPPER}} .plyr--full-ui:hover input[type="range"]' => 'color: {{VALUE}}',
				'{{WRAPPER}} .plyr__control--overlaid:hover svg'       => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'video_controls_background_hover', [
			'label'     => esc_html__( 'Controls Background', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .plyr__controls:hover'          => 'background-color: {{VALUE}}',
				'{{WRAPPER}} .plyr__control--overlaid:hover' => 'background: {{VALUE}}',
			],
		] );

		$this->add_control( 'video_controls_item_hover_bg', [
			'label'     => esc_html__( 'Controls Item Background', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .plyr--video .plyr__control.plyr__tab-focus, .plyr--video .plyr__control:hover, .plyr--video .plyr__control[aria-expanded="true"]' => 'background: {{VALUE}}',
				'{{WRAPPER}} .plyr__control--overlaid:hover'                                                                                                    => 'background: {{VALUE}}',
			],
		] );

		$this->add_control( 'video_controls_item_hover_color', [
			'label'     => esc_html__( 'Controls Item color', 'epa_elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .plyr--video .plyr__control.plyr__tab-focus, .plyr--video .plyr__control:hover, .plyr--video .plyr__control[aria-expanded="true"]' => 'color: {{VALUE}}',
				'{{WRAPPER}} .plyr__control--overlaid:hover svg'                                                                                                => 'color: {{VALUE}}',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section( 'section_buttons_style', [
			'label'     => esc_html__( 'Buttons', 'epa_elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'video_show_buttons!' => '',
			],
		] );

		$this->add_responsive_control( 'video_buttons_size', [
			'label'     => esc_html__( 'Size (%)', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => 60,
			],
			'range'     => [
				'px' => [
					'min' => 10,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .ee-video-player__controls .ee-player__controls__overlay .ee-player__control' => 'font-size: {{SIZE}}px; width: {{SIZE}}px; height: {{SIZE}}px;',
			],
			'condition' => [
				'video_show_buttons!' => '',
			],
		] );

		$this->add_responsive_control( 'video_buttons_spacing', [
			'label'     => esc_html__( 'Controls Spacing', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => '',
			],
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 200,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .ee-video-player__controls .ee-player__controls__overlay .ee-player__controls__rewind' => 'margin-right: {{SIZE}}px;',
			],
			'condition' => [
				'video_show_buttons!' => '',
			],
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'section_bar_style', [
			'label'     => esc_html__( 'Bar', 'epa_elementor' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'video_show_bar!' => '',
			],
		] );

		$this->add_responsive_control( 'video_bar_padding', [
			'label'     => esc_html__( 'Padding', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => '',
			],
			'range'     => [
				'px' => [
					'max'  => 72,
					'min'  => 0,
					'step' => 1,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .ee-video-player__controls .ee-player__controls__bar' => 'padding: {{SIZE}}px',
			],
			'condition' => [
				'video_show_bar!' => '',
			],
		] );

		$this->add_responsive_control( 'video_bar_margin', [
			'label'     => esc_html__( 'Distance', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => '',
			],
			'range'     => [
				'px' => [
					'max'  => 72,
					'min'  => 0,
					'step' => 1,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .ee-video-player__controls .ee-player__controls__bar-wrapper' => 'padding: 0 {{SIZE}}px {{SIZE}}px {{SIZE}}px',
			],
			'condition' => [
				'video_show_bar!' => '',
			],
		] );

		$this->add_control( 'video_bar_radius', [
			'label'     => esc_html__( 'Border Radius', 'epa_elementor' ),
			'type'      => Controls_Manager::DIMENSIONS,
			'selectors' => [
				'{{WRAPPER}} .ee-video-player__controls .ee-player__controls__bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'condition' => [
				'video_show_bar!' => '',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'bar',
			'label'    => esc_html__( 'Typography', 'epa_elementor' ),
			'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
			'selector' => '{{WRAPPER}} .ee-player__control--indicator',
		] );

		$this->add_control( 'controls_heading', [
			'label'     => esc_html__( 'Controls', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
			'condition' => [
				'video_show_bar!' => '',
			],
		] );

		$this->add_responsive_control( 'video_bar_zoom', [
			'label'     => esc_html__( 'Zoom', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => '',
			],
			'range'     => [
				'px' => [
					'max'  => 36,
					'min'  => 6,
					'step' => 1,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .ee-video-player__controls .ee-player__controls__bar'                               => 'font-size: {{SIZE}}px',
				'{{WRAPPER}} .ee-video-player__controls .ee-player__controls__bar .ee-player__control--progress' => 'height: {{SIZE}}px',
			],
			'condition' => [
				'video_show_bar!' => '',
			],
		] );

		$this->add_responsive_control( 'video_bar_spacing', [
			'label'     => esc_html__( 'Spacing', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'default'   => [
				'size' => '',
			],
			'range'     => [
				'px' => [
					'max'  => 24,
					'min'  => 3,
					'step' => 1,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .ee-video-player__controls .ee-player__control--indicator,
						 {{WRAPPER}} .ee-video-player__controls .ee-player__control--icon' => 'padding: 0 {{SIZE}}px',
				'{{WRAPPER}} .ee-video-player__controls .ee-player__control--progress'     => 'margin: 0 {{SIZE}}px',
			],
			'condition' => [
				'video_show_bar!' => '',
			],
		] );

		$this->add_control( 'controls_progress_heading', [
			'label'     => esc_html__( 'Progress', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
			'condition' => [
				'video_show_bar!'      => '',
				'video_show_progress!' => '',
			],
		] );

		$this->add_responsive_control( 'progress_width', [
			'label'     => esc_html__( 'Width', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max'  => 90,
					'min'  => 10,
					'step' => 1,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .ee-player__controls__progress' => 'flex-basis: {{SIZE}}%',
			],
			'condition' => [
				'video_show_bar!'      => '',
				'video_show_progress!' => '',
			],
		] );

		$this->add_control( 'controls_volume_heading', [
			'label'     => esc_html__( 'Volume', 'epa_elementor' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
			'condition' => [
				'video_show_bar!'        => '',
				'video_show_volume_bar!' => '',
				'video_show_volume!'     => '',
			],
		] );

		$this->add_responsive_control( 'volume_width', [
			'label'     => esc_html__( 'Width', 'epa_elementor' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max'  => 90,
					'min'  => 10,
					'step' => 1,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .ee-player__controls__volume' => 'flex-basis: {{SIZE}}%',
			],
			'separator' => 'after',
			'condition' => [
				'video_show_bar!'        => '',
				'video_show_volume_bar!' => '',
				'video_show_volume!'     => '',
			],
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings       = $this->get_settings_for_display();
		?>
        <div class="epa_pro_box">
            <h2 class="epa-pro-tit">Video Player for Elementor</h2>
            <p class="epa-pro-descr">Only pro version holder can use this Video Player Addon. To buy pro version with unlock all addons features. click the below link: </p>
            <ul class="epa-but-wrapper">
                <li>
                    <a class="epa-pro-but epa-view-videoplayer"><i class="fa fa-eye"></i>View Demo</a>
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

Plugin::instance()->widgets_manager->register_widget_type( new Epa_videoplayer() );