<?php
	$info = vidiho_pro_get_layout_info();

	if ( ! $info['has_sidebar'] ) {
		return;
	}
?>
<div class="<?php vidiho_pro_the_sidebar_classes(); ?>">
	<div class="sidebar">
		<?php
			if ( is_singular( 'vidiho_pro_video' ) ) {
				dynamic_sidebar( 'sidebar-video' );
			} elseif ( ! is_page() ) {
				dynamic_sidebar( 'sidebar-1' );
			} else {
				dynamic_sidebar( 'sidebar-2' );
			}
		?>
	</div>
</div>
