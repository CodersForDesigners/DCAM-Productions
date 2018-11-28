<?php
	$support = get_theme_support( 'vidiho-pro-hero' );
	$support = $support[0];

	if ( ! $support['required'] ) {
		$wp_customize->add_setting( 'hero_show', array(
			'transport'         => 'postMessage',
			'default'           => $support['show-default'],
			'sanitize_callback' => 'absint',
		) );
		$wp_customize->add_control( 'hero_show', array(
			'type'    => 'checkbox',
			'section' => 'theme_colors_hero',
			'label'   => esc_html__( 'Show hero', 'vidiho-pro' ),
		) );
	}

	// Needed by the hero image descriptions.
	global $_wp_additional_image_sizes;
	$size      = $_wp_additional_image_sizes['vidiho_pro_hero'];
	$hero_size = $size['width'] . 'x' . $size['height'];

	$wp_customize->add_setting( 'hero_image', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hero_image', array(
		'section'     => 'theme_colors_hero',
		'label'       => esc_html__( 'Hero image', 'vidiho-pro' ),
		/* translators: %s is an image dimension pair in the form "width x height" without spaces, e.g. 800x600 */
		'description' => esc_html( sprintf( __( 'Recommended size of at least %s pixels.', 'vidiho-pro' ), $hero_size ) ),
	) ) );


	$wp_customize->add_setting( 'hero_text_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hero_text_color', array(
		'section' => 'theme_colors_hero',
		'label'   => esc_html__( 'Text color', 'vidiho-pro' ),
	) ) );

	$wp_customize->add_setting( 'hero_bg_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hero_bg_color', array(
		'label'       => esc_html__( 'Background Color', 'vidiho-pro' ),
		'description' => esc_html__( 'Select a color for your hero section. This will not be visible if you set a hero image, unless the image itself has transparent areas.', 'vidiho-pro' ),
		'section'     => 'theme_colors_hero',
	) ) );

	$wp_customize->add_setting( 'hero_overlay_color', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'vidiho_pro_sanitize_rgba_color',
	) );
	$wp_customize->add_control( new Customize_Alpha_Color_Control( $wp_customize, 'hero_overlay_color', array(
		'label'        => esc_html__( 'Overlay color', 'vidiho-pro' ),
		'description'  => wp_kses( __( 'Select an overlay color for your hero section. This will be visible <strong>on top</strong> of the image, so adjust the opacity to achieve the required result and reveal the hero image.', 'vidiho-pro' ), vidiho_pro_get_allowed_tags() ),
		'section'      => 'theme_colors_hero',
		'show_opacity' => true,
	) ) );

	$wp_customize->add_setting( 'hero_image_repeat', array(
		'transport'         => 'postMessage',
		'default'           => 'no-repeat',
		'sanitize_callback' => 'vidiho_pro_sanitize_image_repeat',
	) );
	$wp_customize->add_control( 'hero_image_repeat', array(
		'type'    => 'select',
		'section' => 'theme_colors_hero',
		'label'   => esc_html__( 'Image repeat', 'vidiho-pro' ),
		'choices' => vidiho_pro_get_image_repeat_choices(),
	) );

	$wp_customize->add_setting( 'hero_image_position_x', array(
		'transport'         => 'postMessage',
		'default'           => 'center',
		'sanitize_callback' => 'vidiho_pro_sanitize_image_position_x',
	) );
	$wp_customize->add_control( 'hero_image_position_x', array(
		'type'    => 'select',
		'section' => 'theme_colors_hero',
		'label'   => esc_html__( 'Image horizontal position', 'vidiho-pro' ),
		'choices' => vidiho_pro_get_image_position_x_choices(),
	) );

	$wp_customize->add_setting( 'hero_image_position_y', array(
		'transport'         => 'postMessage',
		'default'           => 'center',
		'sanitize_callback' => 'vidiho_pro_sanitize_image_position_y',
	) );
	$wp_customize->add_control( 'hero_image_position_y', array(
		'type'    => 'select',
		'section' => 'theme_colors_hero',
		'label'   => esc_html__( 'Image vertical position', 'vidiho-pro' ),
		'choices' => vidiho_pro_get_image_position_y_choices(),
	) );

	$wp_customize->add_setting( 'hero_image_attachment', array(
		'transport'         => 'postMessage',
		'default'           => 'scroll',
		'sanitize_callback' => 'vidiho_pro_sanitize_image_attachment',
	) );
	$wp_customize->add_control( 'hero_image_attachment', array(
		'type'    => 'select',
		'section' => 'theme_colors_hero',
		'label'   => esc_html__( 'Image attachment', 'vidiho-pro' ),
		'choices' => vidiho_pro_get_image_attachment_choices(),
	) );

	$wp_customize->add_setting( 'hero_image_cover', array(
		'transport'         => 'postMessage',
		'default'           => 1,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'hero_image_cover', array(
		'type'    => 'checkbox',
		'section' => 'theme_colors_hero',
		'label'   => esc_html__( 'Scale the image to cover its containing area.', 'vidiho-pro' ),
	) );


	$wp_customize->selective_refresh->add_partial( 'theme_hero', array(
		'selector'            => '.page-hero',
		'render_callback'     => 'vidiho_pro_customize_preview_hero',
		'settings'            => array(
			'hero_video_url',
		),
		'container_inclusive' => true,
	) );

	if ( ! $support['required'] ) {
		$wp_customize->selective_refresh->get_partial( 'theme_hero' )->settings[] = 'hero_show';
	}

	$partial = $wp_customize->selective_refresh->get_partial( 'theme_style' );
	$partial->settings = array_merge( $partial->settings, array(
		'hero_image',
		'hero_text_color',
		'hero_bg_color',
		'hero_overlay_color',
		'hero_image_repeat',
		'hero_image_position_x',
		'hero_image_position_y',
		'hero_image_attachment',
		'hero_image_cover',
	) );
