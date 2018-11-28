<?php
	if ( current_theme_supports( 'vidiho-pro-hero' ) ) {
		$wp_customize->add_setting( 'title_blog', array(
			'default'           => esc_html__( 'From the blog', 'vidiho-pro' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'title_blog', array(
			'type'    => 'text',
			'section' => 'theme_titles_general',
			'label'   => esc_html__( 'Blog title', 'vidiho-pro' ),
		) );
	} // theme supports 'vidiho-pro-hero'

	$wp_customize->add_setting( 'title_search', array(
		'default'           => esc_html__( 'Search results', 'vidiho-pro' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'title_search', array(
		'type'    => 'text',
		'section' => 'theme_titles_general',
		'label'   => esc_html__( 'Search title', 'vidiho-pro' ),
	) );

	$wp_customize->add_setting( 'title_404', array(
		'default'           => esc_html__( 'Page not found', 'vidiho-pro' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'title_404', array(
		'type'    => 'text',
		'section' => 'theme_titles_general',
		'label'   => esc_html__( '404 (not found) title', 'vidiho-pro' ),
	) );
