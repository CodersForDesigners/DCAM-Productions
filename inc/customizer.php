<?php
/**
 * Standard Customizer Sections and Settings
 */
add_action( 'customize_register', 'vidiho_pro_customize_register' );
function vidiho_pro_customize_register( $wp_customize ) {

	// Partial for various settings that affect the customizer styles, but can't have a dedicated icon, e.g. 'limit_logo_size'
	$wp_customize->selective_refresh->add_partial( 'theme_style', array(
		'selector'            => '#vidiho-pro-style-inline-css',
		'render_callback'     => 'vidiho_pro_get_all_customizer_css',
		'settings'            => array(),
		'container_inclusive' => false,
	) );


	//
	// Header
	//
	if ( apply_filters( 'vidiho_pro_customizable_header', true ) ) {
		$wp_customize->add_panel( 'theme_header', array(
			'title'    => esc_html_x( 'Header', 'customizer section title', 'vidiho-pro' ),
			'priority' => 10, // Before site_identity, 20
		) );

		$wp_customize->add_section( 'theme_header_style', array(
			'title'    => esc_html_x( 'Header style', 'customizer section title', 'vidiho-pro' ),
			'panel'    => 'theme_header',
			'priority' => 10,
		) );
		require_once get_theme_file_path( 'inc/customizer/options/theme-header-style.php' );

		$wp_customize->add_section( 'theme_header_primary_menu', array(
			'title'    => esc_html_x( 'Primary menu bar', 'customizer section title', 'vidiho-pro' ),
			'panel'    => 'theme_header',
			'priority' => 30,
		) );
		require_once get_theme_file_path( 'inc/customizer/options/theme-header-primary-menu.php' );
	} // filter vidiho_pro_customizable_header


	//
	// Blog
	//
	$wp_customize->add_panel( 'theme_blog', array(
		'title'    => esc_html_x( 'Blog settings', 'customizer section title', 'vidiho-pro' ),
		'priority' => 30, // After site_identity, 20
	) );

	$wp_customize->add_section( 'theme_archive_options', array(
		'title'       => esc_html_x( 'Archive options', 'customizer section title', 'vidiho-pro' ),
		'panel'       => 'theme_blog',
		'description' => esc_html__( 'Customize the default archive pages, such as the blog, category, tag, date archives, etc.', 'vidiho-pro' ),
		'priority'    => 10,
	) );
	require_once get_theme_file_path( 'inc/customizer/options/theme-archive-options.php' );

	$wp_customize->add_section( 'theme_post_options', array(
		'title'    => esc_html_x( 'Post options', 'customizer section title', 'vidiho-pro' ),
		'panel'    => 'theme_blog',
		'priority' => 20,
	) );
	require_once get_theme_file_path( 'inc/customizer/options/theme-post-options.php' );


	//
	// Videos
	//
	$wp_customize->add_panel( 'theme_video', array(
		'title'                    => esc_html_x( 'Video settings', 'customizer section title', 'vidiho-pro' ),
		'auto_expand_sole_section' => true,
		'priority'                 => 40,
	) );

	$wp_customize->add_section( 'theme_video_options', array(
		'title'    => esc_html_x( 'Video options', 'customizer section title', 'vidiho-pro' ),
		'panel'    => 'theme_video',
		'priority' => 20,
	) );
	require_once get_theme_file_path( 'inc/customizer/options/theme-video-options.php' );


	//
	// Colors
	//
	$wp_customize->add_panel( 'theme_colors', array(
		'title'    => esc_html_x( 'Colors', 'customizer section title', 'vidiho-pro' ),
		'priority' => 50,
	) );

	if ( apply_filters( 'vidiho_pro_customizable_header', true ) ) {
		$wp_customize->add_section( 'theme_colors_primary_menu_bar', array(
			'title'    => esc_html_x( 'Primary menu bar', 'customizer section title', 'vidiho-pro' ),
			'panel'    => 'theme_colors',
			'priority' => 20,
		) );
		require_once get_theme_file_path( 'inc/customizer/options/theme-colors-primary-menu-bar.php' );
	} // filter vidiho_pro_customizable_header

	if ( get_theme_support( 'vidiho-pro-hero' ) ) {
		$wp_customize->add_section( 'theme_colors_hero', array(
			'title'    => esc_html_x( 'Hero', 'customizer section title', 'vidiho-pro' ),
			'panel'    => 'theme_colors',
			'priority' => 30,
		) );
		require_once get_theme_file_path( 'inc/customizer/options/theme-colors-hero.php' );
	}

	$wp_customize->add_section( 'theme_colors_global', array(
		'title'    => esc_html_x( 'Global', 'customizer section title', 'vidiho-pro' ),
		'panel'    => 'theme_colors',
		'priority' => 40,
	) );
	require_once get_theme_file_path( 'inc/customizer/options/theme-colors-global.php' );

	$wp_customize->add_section( 'theme_colors_sidebar', array(
		'title'    => esc_html_x( 'Sidebar', 'customizer section title', 'vidiho-pro' ),
		'panel'    => 'theme_colors',
		'priority' => 50,
	) );
	require_once get_theme_file_path( 'inc/customizer/options/theme-colors-sidebar.php' );

	if ( apply_filters( 'vidiho_pro_customizable_footer', true ) ) {
		$wp_customize->add_section( 'theme_colors_footer', array(
			'title'    => esc_html_x( 'Footer', 'customizer section title', 'vidiho-pro' ),
			'panel'    => 'theme_colors',
			'priority' => 60,
		) );
		require_once get_theme_file_path( 'inc/customizer/options/theme-colors-footer.php' );
	} // filter vidiho_pro_customizable_footer


	//
	// Typography
	//
	$wp_customize->add_panel( 'theme_typography', array(
		'title'    => esc_html_x( 'Typography', 'customizer section title', 'vidiho-pro' ),
		'priority' => 60,
	) );

	$wp_customize->add_section( 'theme_typography_content', array(
		'title'    => esc_html_x( 'Content', 'customizer section title', 'vidiho-pro' ),
		'panel'    => 'theme_typography',
		'priority' => 10,
	) );
	require_once get_theme_file_path( 'inc/customizer/options/theme-typography-content.php' );

	$wp_customize->add_section( 'theme_typography_widgets', array(
		'title'    => esc_html_x( 'Widgets', 'customizer section title', 'vidiho-pro' ),
		'panel'    => 'theme_typography',
		'priority' => 20,
	) );
	require_once get_theme_file_path( 'inc/customizer/options/theme-typography-widgets.php' );


	//
	// Social
	//
	$wp_customize->add_section( 'theme_social', array(
		'title'       => esc_html_x( 'Social Networks', 'customizer section title', 'vidiho-pro' ),
		'description' => esc_html__( 'Enter your social network URLs. Leaving a URL empty will hide its respective icon.', 'vidiho-pro' ),
		'priority'    => 70,
	) );
	require_once get_theme_file_path( 'inc/customizer/options/theme-social.php' );


	//
	// Footer
	//
	if ( apply_filters( 'vidiho_pro_customizable_footer', true ) ) {
		$wp_customize->add_panel( 'theme_footer', array(
			'title'    => esc_html_x( 'Footer', 'customizer section title', 'vidiho-pro' ),
			'priority' => 80,
		) );

		$wp_customize->add_section( 'theme_footer_style', array(
			'title'    => esc_html_x( 'Footer style', 'customizer section title', 'vidiho-pro' ),
			'panel'    => 'theme_footer',
			'priority' => 10,
		) );
		require_once get_theme_file_path( 'inc/customizer/options/theme-footer-style.php' );

		$wp_customize->add_section( 'theme_footer_bottom_bar', array(
			'title'    => esc_html_x( 'Bottom bar', 'customizer section title', 'vidiho-pro' ),
			'panel'    => 'theme_footer',
			'priority' => 20,
		) );
		require_once get_theme_file_path( 'inc/customizer/options/theme-footer-bottom-bar.php' );
	} // filter vidiho_pro_customizable_footer


	//
	// Titles
	//
	$wp_customize->add_panel( 'theme_titles', array(
		'title'    => esc_html_x( 'Titles', 'customizer section title', 'vidiho-pro' ),
		'priority' => 90,
	) );

	$wp_customize->add_section( 'theme_titles_general', array(
		'title'    => esc_html_x( 'General', 'customizer section title', 'vidiho-pro' ),
		'panel'    => 'theme_titles',
		'priority' => 10,
	) );
	require_once get_theme_file_path( 'inc/customizer/options/theme-titles-general.php' );

	$wp_customize->add_section( 'theme_titles_post', array(
		'title'    => esc_html_x( 'Posts', 'customizer section title', 'vidiho-pro' ),
		'panel'    => 'theme_titles',
		'priority' => 20,
	) );
	require_once get_theme_file_path( 'inc/customizer/options/theme-titles-post.php' );


	$wp_customize->add_section( 'theme_titles_video', array(
		'title' => esc_html_x( 'Video', 'customizer section title', 'vidiho-pro' ),
		'panel' => 'theme_titles',
	) );
	require_once get_theme_file_path( 'inc/customizer/options/theme-titles-video.php' );


	//
	// Other
	//
	$wp_customize->add_panel( 'theme_other', array(
		'title'                    => esc_html_x( 'Other', 'customizer section title', 'vidiho-pro' ),
		'description'              => esc_html__( 'Other options affecting the whole site.', 'vidiho-pro' ),
		'auto_expand_sole_section' => true,
		'priority'                 => 100,
	) );

	$wp_customize->add_section( 'theme_other_sample_content', array(
		'title'    => esc_html_x( 'Sample Content', 'customizer section title', 'vidiho-pro' ),
		'panel'    => 'theme_other',
		'priority' => 10,
	) );
	require_once get_theme_file_path( 'inc/customizer/options/theme-other-sample-content.php' );

	$wp_customize->add_section( 'theme_other_google_fonts', array(
		'title'    => esc_html_x( 'Google Fonts', 'customizer section title', 'vidiho-pro' ),
		'panel'    => 'theme_other',
		'priority' => 20,
	) );
	require_once get_theme_file_path( 'inc/customizer/options/theme-other-google-fonts.php' );


	//
	// Site identity
	//
	require_once get_theme_file_path( 'inc/customizer/options/site-identity.php' );

	//
	// Static Front Page
	//
	require_once get_theme_file_path( 'inc/customizer/options/static-front-page.php' );

}



add_action( 'customize_register', 'vidiho_pro_customize_register_custom_controls', 9 );
/**
 * Registers custom Customizer controls.
 *
 * @param WP_Customize_Manager $wp_customize Reference to the customizer's manager object.
 */
function vidiho_pro_customize_register_custom_controls( $wp_customize ) {
	require get_template_directory() . '/inc/customizer/controls/static-text/static-text.php';
	require get_template_directory() . '/inc/customizer/controls/alpha-color-picker/alpha-color-picker.php';
	require get_template_directory() . '/inc/customizer/controls/slick-slider/slick-slider.php';
}

add_action( 'customize_preview_init', 'vidiho_pro_customize_preview_js' );
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function vidiho_pro_customize_preview_js() {
	$theme = wp_get_theme();

	wp_enqueue_script( 'vidiho-pro-customizer-preview', get_template_directory_uri() . '/js/admin/customizer-preview.js', array( 'customize-preview' ), $theme->get( 'Version' ), true );
	wp_enqueue_style( 'vidiho-pro-customizer-preview', get_template_directory_uri() . '/css/admin/customizer-preview.css', array( 'customize-preview' ), $theme->get( 'Version' ) );
}

add_action( 'customize_controls_enqueue_scripts', 'vidiho_pro_customize_controls_js' );
function vidiho_pro_customize_controls_js() {
	$theme = wp_get_theme();

	wp_enqueue_style( 'alpha-color-picker-customizer', get_template_directory_uri() . '/inc/customizer/controls/alpha-color-picker/alpha-color-picker.css', array(
		'wp-color-picker',
	), '1.0.0' );
	wp_enqueue_script( 'alpha-color-picker-customizer', get_template_directory_uri() . '/inc/customizer/controls/alpha-color-picker/alpha-color-picker.js', array(
		'jquery',
		'wp-color-picker',
	), '1.0.0', true );

	wp_enqueue_script( 'vidiho-pro-customizer-controls', get_template_directory_uri() . '/js/admin/customizer-controls.js', array(), $theme->get( 'Version' ), true );
}

/**
 * Customizer partial callbacks.
 */
require_once get_theme_file_path( '/inc/customizer/partial-callbacks.php' );

/**
 * Customizer generated styles.
 */
require_once get_theme_file_path( '/inc/customizer/generated-styles.php' );
