<?php
	$wp_customize->add_setting( 'header_layout', array(
		'transport'         => 'postMessage',
		'default'           => vidiho_pro_header_layout_default(),
		'sanitize_callback' => 'vidiho_pro_sanitize_header_layout',
	) );
	$wp_customize->add_control( 'header_layout', array(
		'type'    => 'select',
		'section' => 'theme_header_style',
		'label'   => esc_html__( 'Layout', 'vidiho-pro' ),
		'choices' => vidiho_pro_header_layout_choices(),
	) );

	$wp_customize->add_setting( 'header_logo_alignment', array(
		'transport'         => 'postMessage',
		'default'           => vidiho_pro_header_logo_alignment_default(),
		'sanitize_callback' => 'vidiho_pro_sanitize_header_logo_alignment',
	) );
	$wp_customize->add_control( 'header_logo_alignment', array(
		'type'    => 'select',
		'section' => 'theme_header_style',
		'label'   => esc_html__( 'Logo / tagline alignment', 'vidiho-pro' ),
		'choices' => vidiho_pro_header_logo_alignment_choices(),
	) );

	$wp_customize->add_setting( 'header_fullwidth', array(
		'transport'         => 'postMessage',
		'default'           => 0,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'header_fullwidth', array(
		'type'    => 'checkbox',
		'section' => 'theme_header_style',
		'label'   => esc_html__( 'Full width header', 'vidiho-pro' ),
	) );

	$wp_customize->selective_refresh->add_partial( 'theme_header_layout', array(
		'selector'            => '.header',
		'render_callback'     => 'vidiho_pro_header',
		'settings'            => array( 'header_layout', 'header_logo_alignment', 'header_fullwidth', 'theme_header_primary_menu_sticky' ),
		'container_inclusive' => true,
	) );
