<?php
	$wp_customize->add_control( new Vidiho_Pro_Customize_Slick_Slider_Control( $wp_customize, 'home_slider', array(
		'section'     => 'static_front_page',
		'label'       => __( 'Home Slider', 'vidiho-pro' ),
		'description' => __( 'Fine-tune the homepage slider. Applies to pages that have one of the "Front page" templates assigned.', 'vidiho-pro' ),
	) ) );
