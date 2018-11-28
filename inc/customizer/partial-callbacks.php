<?php
if ( ! function_exists( 'vidiho_pro_customize_preview_blogname' ) ) {
	function vidiho_pro_customize_preview_blogname() {
		bloginfo( 'name' );
	}
}

if ( ! function_exists( 'vidiho_pro_customize_preview_blogdescription' ) ) {
	function vidiho_pro_customize_preview_blogdescription() {
		bloginfo( 'description' );
	}
}

/**
 * Renders pagination preview for archive pages.
 *
 * Its results may not be accurate as the actual call may include arguments,
 * however it should be good enough for preview purposes.
 * vidiho_pro_posts_pagination() cannot be used directly as the render callback passes $this and $container_context
 * as the first two arguments.
 */
if ( ! function_exists( 'vidiho_pro_customize_preview_pagination' ) ) {
	function vidiho_pro_customize_preview_pagination( $_this, $container_context ) {
		vidiho_pro_posts_pagination();
	}
}

if ( ! function_exists( 'vidiho_pro_customize_preview_hero' ) ) {
	function vidiho_pro_customize_preview_hero() {
		get_template_part( 'template-parts/hero' );
	}
}


