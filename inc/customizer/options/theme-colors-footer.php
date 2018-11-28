<?php
	$wp_customize->add_setting( 'footer_bg_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_bg_color', array(
		'section' => 'theme_colors_footer',
		'label'   => esc_html__( 'Main footer background color', 'vidiho-pro' ),
	) ) );

	$wp_customize->add_setting( 'footer_text_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_text_color', array(
		'section' => 'theme_colors_footer',
		'label'   => esc_html__( 'Main footer text color', 'vidiho-pro' ),
	) ) );

	$wp_customize->add_setting( 'footer_link_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_link_color', array(
		'section' => 'theme_colors_footer',
		'label'   => esc_html__( 'Main footer link color', 'vidiho-pro' ),
	) ) );

	$wp_customize->add_setting( 'footer_bottom_bg_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_bottom_bg_color', array(
		'section' => 'theme_colors_footer',
		'label'   => esc_html__( 'Bottom bar background color', 'vidiho-pro' ),
	) ) );

	$wp_customize->add_setting( 'footer_bottom_text_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_bottom_text_color', array(
		'section' => 'theme_colors_footer',
		'label'   => esc_html__( 'Bottom bar text color', 'vidiho-pro' ),
	) ) );

	$wp_customize->add_setting( 'footer_bottom_link_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_bottom_link_color', array(
		'section' => 'theme_colors_footer',
		'label'   => esc_html__( 'Bottom bar link color', 'vidiho-pro' ),
	) ) );

	$wp_customize->add_setting( 'footer_titles_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_titles_color', array(
		'section' => 'theme_colors_footer',
		'label'   => esc_html__( 'Widget titles text color', 'vidiho-pro' ),
	) ) );

	$partial = $wp_customize->selective_refresh->get_partial( 'theme_style' );
	$partial->settings = array_merge( $partial->settings, array(
		'footer_bg_color',
		'footer_text_color',
		'footer_link_color',
		'footer_bottom_bg_color',
		'footer_bottom_text_color',
		'footer_bottom_link_color',
		'footer_titles_color',
	) );
