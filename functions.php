<?php
/**
 * Vidiho_Pro functions and definitions
 */

if ( ! defined( 'VIDIHO_PRO_NAME' ) ) {
	define( 'VIDIHO_PRO_NAME', 'vidiho-pro' );
}
if ( ! defined( 'VIDIHO_PRO_WHITELABEL' ) ) {
	// Set the following to true, if you want to remove any user-facing CSSIgniter traces.
	define( 'VIDIHO_PRO_WHITELABEL', false );
}

if ( ! function_exists( 'vidiho_pro_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function vidiho_pro_setup() {

	// Default content width.
	$GLOBALS['content_width'] = 750;

	// Make theme available for translation.
	load_theme_textdomain( 'vidiho-pro', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	$menus = array(
		'menu-1' => esc_html__( 'Main Menu', 'vidiho-pro' ),
		'menu-2' => esc_html__( 'Main Menu - Right', 'vidiho-pro' ),
	);
	if ( ! apply_filters( 'vidiho_pro_support_menu_2', true ) ) {
		unset( $menus['menu-2'] );
	}
	register_nav_menus( $menus );

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', apply_filters( 'vidiho_pro_add_theme_support_html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) ) );

	// Add theme support for custom logos.
	add_theme_support( 'custom-logo', apply_filters( 'vidiho_pro_add_theme_support_custom_logo', array() ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'vidiho_pro_custom_background_args', array() ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );


	// Image sizes
	set_post_thumbnail_size( 750, 500, true );
	add_image_size( 'vidiho_pro_item', 555, 400, true );
	add_image_size( 'vidiho_pro_item_tall', 555 );
	add_image_size( 'vidiho_pro_item_video', 555, 950, true );
	add_image_size( 'vidiho_pro_item_media_sm', 100, 100, true );
	add_image_size( 'vidiho_pro_fullwidth', 1140, 650, true );
	add_image_size( 'vidiho_pro_hero', 1920, 500, true );
	add_image_size( 'vidiho_pro_featgal_small_thumb', 100, 100, true );

	add_theme_support( 'vidiho-pro-hero', apply_filters( 'vidiho_pro_theme_support_hero_args', wp_parse_args( array(
		'required'   => true,
		'text-align' => 'center',
	), vidiho_pro_theme_support_hero_defaults() ) ) );


	add_theme_support( 'vidiho-pro-hide-single-featured', apply_filters( 'vidiho_pro_theme_support_hide_single_featured_post_types', array(
		'post',
		'page',
		'vidiho_pro_video',
	) ) );

}
endif;
add_action( 'after_setup_theme', 'vidiho_pro_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function vidiho_pro_content_width() {
	$content_width = $GLOBALS['content_width'];

	if ( is_page_template( 'templates/full-width-page.php' )
		|| is_page_template( 'templates/front-page.php' )
		|| is_page_template( 'templates/front-page-elementor.php' )
		|| is_page_template( 'templates/builder.php' )
		|| is_page_template( 'templates/listing-vidiho_pro_video.php' )
	) {
		$content_width = 1140;
	} elseif ( is_singular() || is_home() || is_archive() ) {
		$info          = vidiho_pro_get_layout_info();
		$content_width = $info['content_width'];
	}

	$GLOBALS['content_width'] = apply_filters( 'vidiho_pro_content_width', $content_width );
}
add_action( 'template_redirect', 'vidiho_pro_content_width', 0 );




add_filter( 'wp_page_menu', 'vidiho_pro_wp_page_menu', 10, 2 );
function vidiho_pro_wp_page_menu( $menu, $args ) {
	$menu = preg_replace( '#^<div .*?>#', '', $menu, 1 );
	$menu = preg_replace( '#</div>$#', '', $menu, 1 );
	$menu = preg_replace( '#^<ul>#', '<ul id="' . esc_attr( $args['menu_id'] ) . '" class="' . esc_attr( $args['menu_class'] ) . '">', $menu, 1 );
	return $menu;
}

if ( ! function_exists( 'vidiho_pro_get_columns_classes' ) ) :
	function vidiho_pro_get_columns_classes( $columns ) {
		switch ( intval( $columns ) ) {
			case 1:
				$classes = 'col-12';
				break;
			case 2:
				$classes = 'col-6';
				break;
			case 3:
				$classes = 'col-lg-4 col-6';
				break;
			case 4:
			default:
				$classes = 'col-xl-3 col-lg-4 col-6';
				break;
		}

		return apply_filters( 'vidiho_pro_get_columns_classes', $classes, $columns );
	}
endif;

if ( ! function_exists( 'vidiho_pro_has_sidebar' ) ) :
/**
 * Determine if a sidebar is being displayed.
 */
function vidiho_pro_has_sidebar() {
	$has_sidebar = false;

	if ( is_home() || is_archive() ) {
		if ( get_theme_mod( 'archive_sidebar', 1 ) && is_active_sidebar( 'sidebar-1' ) ) {
			$has_sidebar = true;
		}
	} elseif ( is_singular( 'vidiho_pro_video' ) ) {
		if ( is_active_sidebar( 'sidebar-video' ) ) {
			$has_sidebar = true;
		}
	} elseif ( ! is_page() && is_active_sidebar( 'sidebar-1' ) ) {
		$has_sidebar = true;
	} elseif ( is_page() && is_active_sidebar( 'sidebar-2' ) ) {
		$has_sidebar = true;
	}

	return apply_filters( 'vidiho_pro_has_sidebar', $has_sidebar );
}
endif;

if ( ! function_exists( 'vidiho_pro_get_layout_info' ) ) :
/**
 * Return appropriate layout information.
 */
function vidiho_pro_get_layout_info() {
	$has_sidebar = vidiho_pro_has_sidebar();

	$classes = array(
		'container_classes' => $has_sidebar ? 'col-lg-8 col-12' : 'col-xl-8 col-lg-10 col-12',
		'sidebar_classes'   => $has_sidebar ? 'col-xl-3 col-lg-4 offset-xl-1 col-12' : '',
		'content_width'     => 750,
		'has_sidebar'       => $has_sidebar,
	);

	$sidebar_option = '';
	if ( is_singular() ) {
		$sidebar_option = get_post_meta( get_queried_object_id(), 'vidiho_pro_sidebar', true );
	}

	if ( is_singular() ) {
		if ( 'none' === get_post_meta( get_the_ID(), 'vidiho_pro_sidebar', true ) ) {
			$classes = array(
				'container_classes' => 'col-xl-8 col-lg-10 col-12',
				'sidebar_classes'   => '',
				'content_width'     => 750,
				'has_sidebar'       => false,
			);
		}
	} elseif ( is_home() || is_archive() ) {
		// 1 will get default narrow fullwidth classes. 2 and 3 will get fullwidth.
		if ( 1 !== (int) get_theme_mod( 'archive_layout', vidiho_pro_archive_layout_default() ) ) {
			if ( ! $has_sidebar ) {
				$classes = array(
					'container_classes' => 'col-12',
					'sidebar_classes'   => '',
					'content_width'     => 1140,
					'has_sidebar'       => false,
				);
			}
		}
	}

	$classes['row_classes'] = '';
	if ( is_singular() ) {
		if ( ! $has_sidebar || 'none' === $sidebar_option ) {
			$classes['row_classes'] = 'justify-content-center';
		} elseif ( 'left' === $sidebar_option ) {
			$classes['row_classes'] = 'flex-lg-row-reverse';
		}
	} elseif ( ! $has_sidebar ) {
		$classes['row_classes'] = 'justify-content-center';
	}

	return apply_filters( 'vidiho_pro_layout_info', $classes, $has_sidebar );
}
endif;

add_filter( 'tiny_mce_before_init', 'vidiho_pro_insert_wp_editor_formats' );
function vidiho_pro_insert_wp_editor_formats( $init_array ) {
	$style_formats = array(
		array(
			'title'   => esc_html__( 'Intro text (big text)', 'vidiho-pro' ),
			'block'   => 'div',
			'classes' => 'entry-content-intro',
			'wrapper' => true,
		),
		array(
			'title'   => esc_html__( '2 Column Text', 'vidiho-pro' ),
			'block'   => 'div',
			'classes' => 'entry-content-column-split',
			'wrapper' => true,
		),
	);

	$init_array['style_formats'] = wp_json_encode( $style_formats );

	return $init_array;
}

add_filter( 'mce_buttons_2', 'vidiho_pro_mce_buttons_2' );
function vidiho_pro_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );

	return $buttons;
}

add_action( 'init', 'vidiho_pro_setup_hide_single_featured' );
function vidiho_pro_setup_hide_single_featured() {
	if ( current_theme_supports( 'vidiho-pro-hide-single-featured' ) ) {
		add_filter( 'admin_post_thumbnail_html', 'vidiho_pro_hide_single_featured_admin_post_thumbnail_html', 10, 3 );
		add_filter( 'get_post_metadata', 'vidiho_pro_hide_single_featured_get_post_metadata', 10, 4 );
		add_action( 'save_post', 'vidiho_pro_hide_single_featured_save_post' );
	}
}

function vidiho_pro_hide_single_featured_admin_post_thumbnail_html( $content, $post_id, $thumbnail_id ) {
	$hide_featured_support = get_theme_support( 'vidiho-pro-hide-single-featured' );
	$hide_featured_support = $hide_featured_support[0];

	if ( ! in_array( get_post_type( $post_id ), $hide_featured_support, true ) ) {
		return $content;
	}

	$fieldname = 'vidiho_pro_hide_single_featured';
	$checked   = get_post_meta( $post_id, $fieldname, true );

	ob_start();
	?>
		<input type="checkbox" id="<?php echo esc_attr( $fieldname ); ?>" class="check" name="<?php echo esc_attr( $fieldname ); ?>" value="1" <?php checked( $checked, 1 ); ?> />
		<label for="<?php echo esc_attr( $fieldname ); ?>"><?php esc_html_e( "Hide when viewing this post's page", 'vidiho-pro' ); ?></label>
	<?php
	wp_nonce_field( 'vidiho_pro_hide_single_featured_nonce', '_vidiho_pro_hide_single_featured_meta_box_nonce' );
	$content .= ob_get_clean();

	return $content;
}

function vidiho_pro_hide_single_featured_get_post_metadata( $value, $post_id, $meta_key, $single ) {
	$hide_featured_support = get_theme_support( 'vidiho-pro-hide-single-featured' );
	$hide_featured_support = $hide_featured_support[0];

	if ( ! in_array( get_post_type( $post_id ), $hide_featured_support, true ) ) {
		return $value;
	}

	if ( '_thumbnail_id' === $meta_key && ( is_single( $post_id ) || is_page( $post_id ) ) && get_post_meta( $post_id, 'vidiho_pro_hide_single_featured', true ) ) {
		return false;
	}

	return $value;
}

function vidiho_pro_hide_single_featured_save_post( $post_id ) {
	$hide_featured_support = get_theme_support( 'vidiho-pro-hide-single-featured' );
	$hide_featured_support = $hide_featured_support[0];

	if ( ! in_array( get_post_type( $post_id ), $hide_featured_support, true ) ) {
		return;
	}

	if ( isset( $_POST['_vidiho_pro_hide_single_featured_meta_box_nonce'] ) && wp_verify_nonce( sanitize_key( $_POST['_vidiho_pro_hide_single_featured_meta_box_nonce'] ), 'vidiho_pro_hide_single_featured_nonce' ) ) {
		update_post_meta( $post_id, 'vidiho_pro_hide_single_featured', isset( $_POST['vidiho_pro_hide_single_featured'] ) ); // Input var okay.
	}
}


function vidiho_pro_get_terms( $taxonomy = 'category' ) {
	$terms     = get_terms( array( 'taxonomy' => $taxonomy ) );
	$term_list = [];

	foreach ( $terms as $term ) {
		$term_list[ $term->term_id ] = $term->name;
	}

	return $term_list;
}


/**
 * Template tags.
 */
require_once get_theme_file_path( '/inc/template-tags.php' );

/**
 * Sanitization functions.
 */
require_once get_theme_file_path( '/inc/sanitization.php' );

/**
 * Hooks.
 */
require_once get_theme_file_path( '/inc/default-hooks.php' );

/*
 * Lazaro Hooks.
 */
require_once get_theme_file_path( '/inc/lazaro-hooks.php' );

/**
 * Scripts and styles.
 */
require_once get_theme_file_path( '/inc/scripts-styles.php' );

/**
 * Sidebars and widgets.
 */
require_once get_theme_file_path( '/inc/sidebars-widgets.php' );
// require_once get_theme_file_path( '/inc/widgets/lazaro-simple.php' );
require_once get_theme_file_path( '/inc/widgets/lazaro-pricing-calculator-widget.php' );

/**
 * Customizer controls.
 */
require_once get_theme_file_path( '/inc/customizer.php' );

/**
 * Hero support. Needed even if theme doesn't support hero.
 */
require_once get_theme_file_path( '/inc/hero.php' );

/**
 * Various helper functions, so that this functions.php is cleaner.
 */
require_once get_theme_file_path( '/inc/helpers.php' );

/**
 * Elementor related code.
 */
require_once get_theme_file_path( '/inc/elementor.php' );

/**
 * Post types listing related functions.
 */
require_once get_theme_file_path( '/inc/items-listing.php' );

/**
 * User onboarding.
 */
require_once get_theme_file_path( '/inc/onboarding.php' );
