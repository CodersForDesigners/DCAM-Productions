<?php
	$wp_customize->add_setting( 'header_primary_menu_bg_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_primary_menu_bg_color', array(
		'section' => 'theme_colors_primary_menu_bar',
		'label'   => esc_html__( 'Background color', 'vidiho-pro' ),
	) ) );

	$wp_customize->add_setting( 'header_primary_menu_text_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_primary_menu_text_color', array(
		'section' => 'theme_colors_primary_menu_bar',
		'label'   => esc_html__( 'Text color', 'vidiho-pro' ),
	) ) );

	$wp_customize->add_setting( 'header_primary_menu_active_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_primary_menu_active_color', array(
		'section' => 'theme_colors_primary_menu_bar',
		'label'   => esc_html__( 'Menu active & hover color', 'vidiho-pro' ),
	) ) );

	$wp_customize->add_setting( 'header_primary_submenu_bg_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_primary_submenu_bg_color', array(
		'section' => 'theme_colors_primary_menu_bar',
		'label'   => esc_html__( 'Sub-menu background color', 'vidiho-pro' ),
	) ) );

	$wp_customize->add_setting( 'header_primary_submenu_text_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_primary_submenu_text_color', array(
		'section' => 'theme_colors_primary_menu_bar',
		'label'   => esc_html__( 'Sub-menu text color', 'vidiho-pro' ),
	) ) );

	$wp_customize->add_setting( 'header_primary_submenu_active_text_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_primary_submenu_active_text_color', array(
		'section' => 'theme_colors_primary_menu_bar',
		'label'   => esc_html__( 'Sub-menu active text color', 'vidiho-pro' ),
	) ) );

	$partial = $wp_customize->selective_refresh->get_partial( 'theme_style' );
	$partial->settings = array_merge( $partial->settings, array(
		'header_primary_menu_bg_color',
		'header_primary_menu_text_color',
		'header_primary_menu_active_color',
		'header_primary_submenu_bg_color',
		'header_primary_submenu_text_color',
		'header_primary_submenu_active_text_color',
	) );
