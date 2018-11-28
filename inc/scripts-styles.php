<?php
/**
 * Vidiho_Pro scripts and styles related functions.
 */

/**
 * Register Google Fonts
 */
function vidiho_pro_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext,cyrillic,cyrillic-ext,vietnamese';

	/* translators: If there are characters in your language that are not supported by IBM Plex Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'IBM Plex Sans font: on or off', 'vidiho-pro' ) ) {
		$fonts[] = 'IBM Plex Sans:400,400i,700';
	}

	/* translators: If there are characters in your language that are not supported by IBM Plex Serif, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'IBM Plex Serif font: on or off', 'vidiho-pro' ) ) {
		$fonts[] = 'IBM Plex Serif:400,600';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	if ( get_theme_mod( 'theme_local_google_fonts' ) ) {
		$fonts_url = get_template_directory_uri() . '/css/google-fonts.css';
	}

	return $fonts_url;
}

/**
 * Register scripts and styles unconditionally.
 */
function vidiho_pro_register_scripts() {
	$theme = wp_get_theme();

	if ( ! wp_script_is( 'alpha-color-picker', 'enqueued' ) && ! wp_script_is( 'alpha-color-picker', 'registered' ) ) {
		wp_register_style( 'alpha-color-picker', get_template_directory_uri() . '/assets/vendor/alpha-color-picker/alpha-color-picker.css', array(
			'wp-color-picker',
		), '1.0.0' );
		wp_register_script( 'alpha-color-picker', get_template_directory_uri() . '/assets/vendor/alpha-color-picker/alpha-color-picker.js', array(
			'jquery',
			'wp-color-picker',
		), '1.0.0', true );
	}

	if ( ! wp_script_is( 'slick', 'enqueued' ) && ! wp_script_is( 'slick', 'registered' ) ) {
		wp_register_style( 'slick', get_template_directory_uri() . '/assets/vendor/slick/slick.css', array(), '1.8.0' );
		wp_register_script( 'slick', get_template_directory_uri() . '/assets/vendor/slick/slick.js', array(
			'jquery',
		), '1.8.0', true );
	}

	if ( ! wp_script_is( 'vidiho-pro-plugin-post-meta', 'enqueued' ) && ! wp_script_is( 'vidiho-pro-plugin-post-meta', 'registered' ) ) {
		wp_register_style( 'vidiho-pro-plugin-post-meta', get_template_directory_uri() . '/css/admin/post-meta.css', array(
			'alpha-color-picker',
		), $theme->get( 'Version' ) );
		wp_register_script( 'vidiho-pro-plugin-post-meta', get_template_directory_uri() . '/js/admin/post-meta.js', array(
			'media-editor',
			'jquery',
			'jquery-ui-sortable',
			'alpha-color-picker',
		), $theme->get( 'Version' ), true );

		$settings = array(
			'ajaxurl'             => admin_url( 'admin-ajax.php' ),
			'tSelectFile'         => esc_html__( 'Select file', 'vidiho-pro' ),
			'tSelectFiles'        => esc_html__( 'Select files', 'vidiho-pro' ),
			'tUseThisFile'        => esc_html__( 'Use this file', 'vidiho-pro' ),
			'tUseTheseFiles'      => esc_html__( 'Use these files', 'vidiho-pro' ),
			'tUpdateGallery'      => esc_html__( 'Update gallery', 'vidiho-pro' ),
			'tLoading'            => esc_html__( 'Loading...', 'vidiho-pro' ),
			'tPreviewUnavailable' => esc_html__( 'Gallery preview not available.', 'vidiho-pro' ),
			'tRemoveImage'        => esc_html__( 'Remove image', 'vidiho-pro' ),
			'tRemoveFromGallery'  => esc_html__( 'Remove from gallery', 'vidiho-pro' ),
		);
		wp_localize_script( 'vidiho-pro-plugin-post-meta', 'vidiho_pro_plugin_PostMeta', $settings );
	}

	wp_register_style( 'vidiho-pro-repeating-fields', get_template_directory_uri() . '/css/admin/repeating-fields.css', array(), $theme->get( 'Version' ) );
	wp_register_script( 'vidiho-pro-repeating-fields', get_template_directory_uri() . '/js/admin/repeating-fields.js', array(
		'jquery',
		'jquery-ui-sortable',
	), $theme->get( 'Version' ), true );

	wp_register_style( 'font-awesome-5', get_template_directory_uri() . '/assets/vendor/fontawesome/css/font-awesome.css', array(), '5.1.0' );

	wp_register_script( 'imagesLoaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array( 'jquery' ), '4.1.3', true );
	wp_register_script( 'anim-on-scroll', get_template_directory_uri() . '/js/anim-on-scroll.js', array(
		'jquery',
		'imagesLoaded',
	), '1.0.1', true );

	wp_register_style( 'jquery-magnific-popup', get_template_directory_uri() . '/assets/vendor/magnific-popup/magnific.css', array(), '1.0.0' );
	wp_register_script( 'jquery-magnific-popup', get_template_directory_uri() . '/assets/vendor/magnific-popup/jquery.magnific-popup.js', array( 'jquery' ), '1.0.0', true );
	wp_register_script( 'vidiho-pro-magnific-init', get_template_directory_uri() . '/js/magnific-init.js', array( 'jquery' ), $theme->get( 'Version' ), true );

	wp_register_script( 'vidiho-pro-elementor-ajax', get_template_directory_uri() . '/js/admin/elementor-ajax.js', array(), $theme->get( 'Version' ), true );
	$params = array(
		'ajaxurl'         => admin_url( 'admin-ajax.php' ),
		'no_posts_found'  => esc_html__( 'No posts found.', 'vidiho-pro' ),
		'get_posts_nonce' => wp_create_nonce( 'vidiho_pro_get_posts_nonce' ),
	);
	wp_localize_script( 'vidiho-pro-elementor-ajax', 'vidiho_pro_elementor_ajax', $params );

	wp_register_style( 'vidiho-pro-google-font', vidiho_pro_fonts_url(), array(), $theme->get( 'Version' ) );
	wp_register_style( 'vidiho-pro-base', get_template_directory_uri() . '/css/base.css', array(), $theme->get( 'Version' ) );
	wp_register_style( 'mmenu', get_template_directory_uri() . '/css/mmenu.css', array(), '5.5.3' );


	wp_register_style( 'vidiho-pro-dependencies', false, array(
		'vidiho-pro-google-font',
		'vidiho-pro-base',
		'mmenu',
		'slick',
		'font-awesome-5',
	), $theme->get( 'Version' ) );

	if ( is_child_theme() ) {
		wp_register_style( 'vidiho-pro-style-parent', get_template_directory_uri() . '/style.css', array(
			'vidiho-pro-dependencies',
		), $theme->get( 'Version' ) );
	}

	wp_register_style( 'vidiho-pro-style', get_stylesheet_uri(), array(
		'vidiho-pro-dependencies',
	), $theme->get( 'Version' ) );


	wp_register_script( 'mmenu', get_template_directory_uri() . '/js/jquery.mmenu.min.all.js', array( 'jquery' ), '5.5.3', true );
	wp_register_script( 'fitVids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '1.1', true );
	wp_register_script( 'isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array( 'jquery' ), '3.0.2', true );

	wp_register_script( 'vidiho-pro-dependencies', false, array(
		'jquery',
		'mmenu',
		'slick',
		'fitVids',
		'isotope',
		'anim-on-scroll',
	), $theme->get( 'Version' ), true );

	wp_register_script( 'vidiho-pro-front-scripts', get_template_directory_uri() . '/js/scripts.js', array(
		'vidiho-pro-dependencies',
	), $theme->get( 'Version' ), true );

}
add_action( 'init', 'vidiho_pro_register_scripts' );

/**
 * Enqueue scripts and styles.
 */
function vidiho_pro_enqueue_scripts() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( get_theme_mod( 'theme_lightbox', 1 ) ) {
		wp_enqueue_style( 'jquery-magnific-popup' );
		wp_enqueue_script( 'jquery-magnific-popup' );
		wp_enqueue_script( 'vidiho-pro-magnific-init' );
	}

	if ( is_child_theme() ) {
		wp_enqueue_style( 'vidiho-pro-style-parent' );
	}

	wp_enqueue_style( 'vidiho-pro-style' );
	wp_add_inline_style( 'vidiho-pro-style', vidiho_pro_get_all_customizer_css() );

	wp_enqueue_script( 'vidiho-pro-front-scripts' );

}
add_action( 'wp_enqueue_scripts', 'vidiho_pro_enqueue_scripts' );


/**
 * Enqueue admin scripts and styles.
 */
function vidiho_pro_admin_scripts( $hook ) {
	$theme = wp_get_theme();

	wp_register_style( 'vidiho-pro-widgets', get_template_directory_uri() . '/css/admin/widgets.css', array(
		'vidiho-pro-repeating-fields',
		'vidiho-pro-plugin-post-meta',
		'alpha-color-picker',
	), $theme->get( 'Version' ) );

	wp_register_script( 'vidiho-pro-widgets', get_template_directory_uri() . '/js/admin/widgets.js', array(
		'jquery',
		'vidiho-pro-repeating-fields',
		'vidiho-pro-plugin-post-meta',
		'alpha-color-picker',
	), $theme->get( 'Version' ), true );
	$params = array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
	);
	wp_localize_script( 'vidiho-pro-widgets', 'ThemeWidget', $params );


	//
	// Enqueue
	//
	if ( in_array( $hook, array( 'widgets.php', 'customize.php' ), true ) ) {
		wp_enqueue_style( 'vidiho-pro-repeating-fields' );
		wp_enqueue_script( 'vidiho-pro-repeating-fields' );

		wp_enqueue_media();
		wp_enqueue_style( 'vidiho-pro-widgets' );
		wp_enqueue_script( 'vidiho-pro-widgets' );
	}

}
add_action( 'admin_enqueue_scripts', 'vidiho_pro_admin_scripts' );
