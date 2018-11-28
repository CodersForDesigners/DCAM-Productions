<?php
	$wp_customize->add_setting( 'title_video_related_title', array(
		'default'           => esc_html__( 'Related videos', 'vidiho-pro' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'title_video_related_title', array(
		'type'    => 'text',
		'section' => 'theme_titles_video',
		'label'   => esc_html__( 'Related videos title', 'vidiho-pro' ),
	) );

	$wp_customize->add_setting( 'title_video_related_subtitle', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'title_video_related_subtitle', array(
		'type'    => 'text',
		'section' => 'theme_titles_video',
		'label'   => esc_html__( 'Related videos subtitle', 'vidiho-pro' ),
	) );
