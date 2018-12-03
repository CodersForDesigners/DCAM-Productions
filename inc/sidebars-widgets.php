<?php
/**
 * Vidiho_Pro sidebars and widgets related functions.
 */

/**
 * Register widget areas.
 */
function vidiho_pro_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog', 'vidiho-pro' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Widgets added here will appear on the blog section.', 'vidiho-pro' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Page', 'vidiho-pro' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Widgets added here will appear on the static pages.', 'vidiho-pro' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Videos', 'vidiho-pro' ),
		'id'            => 'sidebar-video',
		'description'   => esc_html__( 'Widgets added here will appear on video pages.', 'vidiho-pro' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Front Page', 'vidiho-pro' ),
		'id'            => 'frontpage',
		'description'   => esc_html__( 'These widgets appear on pages that have the "Front page" template assigned.', 'vidiho-pro' ),
		'before_widget' => '<section id="%1$s" class="widget-section %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="section-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Elementor 1', 'vidiho-pro' ),
		'id'            => 'sidebar-elementor-1',
		'description'   => esc_html__( 'You can use this sidebar for Elementor-based layouts.', 'vidiho-pro' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Elementor 2', 'vidiho-pro' ),
		'id'            => 'sidebar-elementor-2',
		'description'   => esc_html__( 'You can use this sidebar for Elementor-based layouts.', 'vidiho-pro' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer - 1st column', 'vidiho-pro' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Widgets added here will appear on the first footer column.', 'vidiho-pro' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer - 2nd column', 'vidiho-pro' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Widgets added here will appear on the second footer column.', 'vidiho-pro' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer - 3rd column', 'vidiho-pro' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Widgets added here will appear on the third footer column.', 'vidiho-pro' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer - 4th column', 'vidiho-pro' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Widgets added here will appear on the fourth footer column.', 'vidiho-pro' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'vidiho_pro_widgets_init' );


function vidiho_pro_load_widgets() {
	require get_template_directory() . '/inc/widgets/socials.php';
	require get_template_directory() . '/inc/widgets/contact.php';
	require get_template_directory() . '/inc/widgets/schedule.php';
	require get_template_directory() . '/inc/widgets/latest-post-type.php';

	require get_template_directory() . '/inc/widgets/home-newsletter.php';
	require get_template_directory() . '/inc/widgets/lazaro-contact-form.php';
	require get_template_directory() . '/inc/widgets/home-latest-posts.php';
	require get_template_directory() . '/inc/widgets/home-latest-videos.php';
	require get_template_directory() . '/inc/widgets/home-post-type-items.php';
	require get_template_directory() . '/inc/widgets/home-instagram.php';

	register_widget( 'CI_Widget_Socials' );
	register_widget( 'CI_Widget_Contact' );
	register_widget( 'CI_Widget_Schedule' );
	register_widget( 'CI_Widget_Latest_Post_Type' );

	register_widget( 'CI_Widget_Home_Newsletter' );
	register_widget( 'LZR_Widget_Contact_Form' );
	register_widget( 'CI_Widget_Home_Latest_Posts' );
	register_widget( 'CI_Widget_Home_Latest_Videos' );
	register_widget( 'CI_Widget_Home_Post_Type_Items' );
	if ( class_exists( 'CI_Widget_Home_Instagram' ) ) {
		register_widget( 'CI_Widget_Home_Instagram' );
	}
}
add_action( 'widgets_init', 'vidiho_pro_load_widgets' );


function vidiho_pro_get_fullwidth_sidebars() {
	return apply_filters( 'vidiho_pro_fullwidth_sidebars', array(
		'frontpage',
	) );
}


function vidiho_pro_get_fullwidth_widgets() {
	return apply_filters( 'vidiho_pro_fullwidth_widgets', array(
		'ci-home-instagram',
		'ci-home-latest-posts',
		'ci-home-latest-videos',
		'ci-home-post-type-items',
		'ci-home-newsletter',
		'lzr-contact-form',
	) );
}


function vidiho_pro_footer_widget_area_classes( $layout ) {
	switch ( $layout ) {
		case '3-col':
			$classes = array(
				'footer-1' => array(
					'active' => true,
					'class'  => 'col-lg-4 col-12',
				),
				'footer-2' => array(
					'active' => true,
					'class'  => 'col-lg-4 col-12',
				),
				'footer-3' => array(
					'active' => true,
					'class'  => 'col-lg-4 col-12',
				),
				'footer-4' => array(
					'active' => false,
					'class'  => '',
				),
			);
			break;
		case '2-col':
			$classes = array(
				'footer-1' => array(
					'active' => true,
					'class'  => 'col-md-6 col-12',
				),
				'footer-2' => array(
					'active' => true,
					'class'  => 'col-md-6 col-12',
				),
				'footer-3' => array(
					'active' => false,
					'class'  => '',
				),
				'footer-4' => array(
					'active' => false,
					'class'  => '',
				),
			);
			break;
		case '1-col':
			$classes = array(
				'footer-1' => array(
					'active' => true,
					'class'  => 'col-12',
				),
				'footer-2' => array(
					'active' => false,
					'class'  => '',
				),
				'footer-3' => array(
					'active' => false,
					'class'  => '',
				),
				'footer-4' => array(
					'active' => false,
					'class'  => '',
				),
			);
			break;
		case '1-3':
			$classes = array(
				'footer-1' => array(
					'active' => true,
					'class'  => 'col-lg-3 col-md-6 col-12',
				),
				'footer-2' => array(
					'active' => true,
					'class'  => 'col-lg-9 col-md-6 col-12',
				),
				'footer-3' => array(
					'active' => false,
					'class'  => '',
				),
				'footer-4' => array(
					'active' => false,
					'class'  => '',
				),
			);
			break;
		case '3-1':
			$classes = array(
				'footer-1' => array(
					'active' => true,
					'class'  => 'col-lg-9 col-md-6 col-12',
				),
				'footer-2' => array(
					'active' => true,
					'class'  => 'col-lg-3 col-md-6 col-12',
				),
				'footer-3' => array(
					'active' => false,
					'class'  => '',
				),
				'footer-4' => array(
					'active' => false,
					'class'  => '',
				),
			);
			break;
		case '1-1-2':
			$classes = array(
				'footer-1' => array(
					'active' => true,
					'class'  => 'col-lg-3 col-md-6 col-12',
				),
				'footer-2' => array(
					'active' => true,
					'class'  => 'col-lg-3 col-md-6 col-12',
				),
				'footer-3' => array(
					'active' => true,
					'class'  => 'col-lg-6 col-12',
				),
				'footer-4' => array(
					'active' => false,
					'class'  => '',
				),
			);
			break;
		case '2-1-1':
			$classes = array(
				'footer-1' => array(
					'active' => true,
					'class'  => 'col-lg-6 col-12',
				),
				'footer-2' => array(
					'active' => true,
					'class'  => 'col-lg-3 col-md-6 col-12',
				),
				'footer-3' => array(
					'active' => true,
					'class'  => 'col-lg-3 col-md-6 col-12',
				),
				'footer-4' => array(
					'active' => false,
					'class'  => '',
				),
			);
			break;
		case '4-col':
		default:
			$classes = array(
				'footer-1' => array(
					'active' => true,
					'class'  => 'col-lg-3 col-md-6 col-12',
				),
				'footer-2' => array(
					'active' => true,
					'class'  => 'col-lg-3 col-md-6 col-12',
				),
				'footer-3' => array(
					'active' => true,
					'class'  => 'col-lg-3 col-md-6 col-12',
				),
				'footer-4' => array(
					'active' => true,
					'class'  => 'col-lg-3 col-md-6 col-12',
				),
			);
	} // End switch().

	return apply_filters( 'vidiho_pro_footer_widget_area_classes', $classes, $layout );
}
