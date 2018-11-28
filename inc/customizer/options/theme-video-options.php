<?php
	$wp_customize->add_setting( 'video_show_featured', array(
		'default'           => 1,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'video_show_featured', array(
		'type'    => 'checkbox',
		'section' => 'theme_video_options',
		'label'   => esc_html__( 'Show featured image', 'vidiho-pro' ),
	) );

	$wp_customize->add_setting( 'video_floating', array(
		'default'           => 1,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'video_floating', array(
		'type'        => 'checkbox',
		'section'     => 'theme_video_options',
		'label'       => esc_html__( 'Floating video', 'vidiho-pro' ),
		'description' => esc_html__( "The video will appear resized on the side of the page so it's always visible when scrolling.", 'vidiho-pro' ),
	) );
