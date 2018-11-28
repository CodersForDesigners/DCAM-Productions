<?php
	$thumb_id = false;
	if ( has_post_thumbnail() ) {
		$thumb_id = get_post_thumbnail_id();
	} else {
		$thumb_id = get_post_meta( get_the_ID(), 'vidiho_pro_video_thumbnail_id', true );
	}

	$thumb_url = wp_get_attachment_image_url( $thumb_id, 'vidiho_pro_item_video' );
	$style     = '';

	if ( ! empty( $thumb_url ) ) {
		$style = sprintf( 'background-image: url(%s);', esc_url( $thumb_url ) );
	}
?>
<div
	class="item item-vertical"
	style="<?php echo esc_attr( $style ); ?>"
>
	<a href="<?php the_permalink(); ?>" class="item-vertical-link">
		<span class="video-trigger-icon"></span><span class="sr-only"><?php esc_html_e( 'Play video', 'vidiho-pro' ); ?></span>

		<div class="item-content">
			<?php if ( has_term( '', 'vidiho_pro_video_category' ) ) : ?>
				<span class="item-categories">
					<?php echo wp_kses( get_the_term_list( get_the_ID(), 'vidiho_pro_video_category', '', ', ' ), 'strip' ); ?>
				</span>
			<?php endif; ?>

			<p class="item-title">
				<?php the_title(); ?>
			</p>

			<time class="item-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date(); ?></time>
		</div>
	</a>
</div>
