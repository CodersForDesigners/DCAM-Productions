<?php
namespace Elementor;

/**
 * Vidiho_Pro Elementor related code.
 */

add_action( 'elementor/theme/register_locations', 'Elementor\vidiho_pro_register_elementor_locations' );
function vidiho_pro_register_elementor_locations( $elementor_theme_manager ) {
	$elementor_theme_manager->register_location( 'header' );
	$elementor_theme_manager->register_location( 'footer' );
	$elementor_theme_manager->register_location( 'single' );
	$elementor_theme_manager->register_location( 'archive' );
}

add_action( 'elementor/init', 'Elementor\vidiho_pro_elementor_init' );
function vidiho_pro_elementor_init() {
	Plugin::instance()->elements_manager->add_category(
		'vidiho-pro-elements',
		[
			'title' => __( 'Vidiho Pro Elements', 'vidiho-pro' ),
			'icon'  => 'font',
		],
		1
	);
}

add_action( 'elementor/widgets/widgets_registered', 'Elementor\vidiho_pro_elementor_add_elements' );
function vidiho_pro_elementor_add_elements() {

	require_once get_theme_file_path( '/inc/elementor/post-type.php' );
	Plugin::instance()->widgets_manager->register_widget_type( new Widget_Post_Type() );

	require_once get_theme_file_path( '/inc/elementor/latest-posts.php' );
	Plugin::instance()->widgets_manager->register_widget_type( new Widget_Latest_Posts() );

	require_once get_theme_file_path( '/inc/elementor/latest-videos.php' );
	Plugin::instance()->widgets_manager->register_widget_type( new Widget_Latest_Videos() );

	require_once get_theme_file_path( '/inc/elementor/post-type-items.php' );
	Plugin::instance()->widgets_manager->register_widget_type( new Widget_Post_Type_Items() );

}


add_action( 'elementor/editor/before_enqueue_scripts', 'Elementor\vidiho_pro_elementor_enqueue_scripts' );
function vidiho_pro_elementor_enqueue_scripts() {
	vidiho_pro_register_scripts();
	vidiho_pro_admin_scripts( '' );

	wp_enqueue_media();
	wp_enqueue_style( 'vidiho-pro-widgets' );
	wp_enqueue_script( 'vidiho-pro-widgets' );

	wp_enqueue_script( 'vidiho-pro-elementor-ajax' );
}

add_action( 'wp_ajax_vidiho_pro_elementor_get_posts', 'Elementor\vidiho_pro_ajax_elementor_get_posts' );
function vidiho_pro_ajax_elementor_get_posts() {

	// Verify nonce.
	if ( ! isset( $_POST['get_posts_nonce'] ) || ! wp_verify_nonce( $_POST['get_posts_nonce'], 'vidiho_pro_get_posts_nonce' ) ) {
		die( 'Permission denied' );
	}

	$post_type = isset( $_POST['post_type'] ) ? sanitize_key( $_POST['post_type'] ) : 'post';

	$q = new \WP_Query( array(
		'post_type'      => $post_type,
		'posts_per_page' => - 1,
		'post_status'    => 'publish',
	) );

	?><option><?php esc_html_e( 'Select an item', 'vidiho-pro' ); ?></option><?php
	while ( $q->have_posts() ) : $q->the_post();
		?><option value="<?php echo esc_attr( get_the_ID() ); ?>"><?php the_title(); ?></option><?php
	endwhile;
	wp_reset_postdata();
	wp_die();
}

function vidiho_pro_get_available_post_types() {

	$post_types = get_post_types( array(
		'public' => true,
	), 'objects' );

	$testimonials = get_post_types( array(
		'name' => 'vidiho_pro_testimon',
	), 'objects' );

	$post_types = array_merge( $post_types, $testimonials );

	unset( $post_types['attachment'] );
	unset( $post_types['elementor_library'] );

	$post_types = apply_filters( 'vidiho_pro_widget_post_types_dropdown', $post_types, __CLASS__ );

	$labels = [];

	foreach ( $post_types as $key => $type ) {
		$labels[ $type->name ] = $type->labels->name;
	}

	return $labels;
}
