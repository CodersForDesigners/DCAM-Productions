<?php
	$wp_customize->add_setting( 'footer_show_bottom_bar', array(
		'transport'         => 'postMessage',
		'default'           => 1,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'footer_show_bottom_bar', array(
		'type'    => 'checkbox',
		'section' => 'theme_footer_bottom_bar',
		'label'   => esc_html__( 'Show bottom bar', 'vidiho-pro' ),
	) );

	$wp_customize->selective_refresh->get_partial( 'theme_footer_layout' )->settings[] = 'footer_show_bottom_bar';

	$wp_customize->add_setting( 'footer_text', array(
		'transport'         => 'postMessage',
		'default'           => vidiho_pro_get_default_footer_text(),
		'sanitize_callback' => 'vidiho_pro_sanitize_footer_text',
	) );
	$wp_customize->add_control( 'footer_text', array(
		'type'    => 'textarea',
		'section' => 'theme_footer_bottom_bar',
		'label'   => esc_html__( 'Credits text', 'vidiho-pro' ),
	) );

	if ( get_theme_support( 'vidiho-pro-footer-text-right' ) ) {
		$wp_customize->add_setting( 'footer_text_right', array(
			'transport'         => 'postMessage',
			'default'           => vidiho_pro_get_default_footer_text( 'right' ),
			'sanitize_callback' => 'vidiho_pro_sanitize_footer_text',
		) );
		$wp_customize->add_control( 'footer_text_right', array(
			'type'    => 'textarea',
			'section' => 'theme_footer_bottom_bar',
			'label'   => esc_html__( 'Credits text (right)', 'vidiho-pro' ),
		) );
	}

	$wp_customize->add_setting( 'footer_show_social_icons', array(
		'transport'         => 'postMessage',
		'default'           => 1,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'footer_show_social_icons', array(
		'type'    => 'checkbox',
		'section' => 'theme_footer_bottom_bar',
		'label'   => esc_html__( 'Show social icons', 'vidiho-pro' ),
	) );

	$wp_customize->selective_refresh->add_partial( 'footer_bottom_bar', array(
		'selector'            => '.footer-info',
		'render_callback'     => 'vidiho_pro_footer_bottom_bar',
		'settings'            => array( 'footer_text', 'footer_show_social_icons' ),
		'container_inclusive' => true,
		'fallback_refresh'    => true,
	) );

	if ( get_theme_support( 'vidiho-pro-footer-text-right' ) ) {
		$wp_customize->selective_refresh->get_partial( 'footer_bottom_bar' )->settings[] = 'footer_text_right';
	}
