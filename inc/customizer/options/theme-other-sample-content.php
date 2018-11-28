<?php
	$sample_content_url = apply_filters( 'vidiho_pro_sample_content_url',
		sprintf( 'https://www.cssigniter.com/sample_content/%s.zip', VIDIHO_PRO_NAME ),
		'https://www.cssigniter.com/sample_content/',
		VIDIHO_PRO_NAME
	);

	if ( ! empty( $sample_content_url ) && ( ! defined( 'VIDIHO_PRO_WHITELABEL' ) || false === (bool) VIDIHO_PRO_WHITELABEL ) ) {
		$wp_customize->add_setting( 'sample_content_link', array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( new Vidiho_Pro_Customize_Static_Text_Control( $wp_customize, 'sample_content_link', array(
			'section'     => 'theme_other_sample_content',
			'label'       => esc_html__( 'Sample content bundle', 'vidiho-pro' ),
			'description' => array(
				wp_kses(
					/* translators: %s is a URL */
					sprintf( __( '<a href="%s" target="_blank">Download the theme\'s sample content files</a> to get things moving.', 'vidiho-pro' ),
						esc_url( $sample_content_url )
					),
					vidiho_pro_get_allowed_tags( 'guide' )
				),
			),
		) ) );
	}
