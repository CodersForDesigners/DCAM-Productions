<div class="page-hero-content">
	<?php if ( has_term( '', 'vidiho_pro_video_category' ) ) : ?>
		<p class="page-hero-categories">
			<?php echo the_terms( get_the_ID(), 'vidiho_pro_video_category', '', ', ' ); ?>
		</p>
	<?php endif; ?>

	<h2 class="page-hero-title">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h2>

	<p class="page-hero-meta">
		<time class="page-hero-time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
			<?php echo get_the_date(); ?>
		</time>
	</p>
</div>

<?php
	$video_url      = get_post_meta( get_the_ID(), 'vidiho_pro_video_url', true );
	$video_thumb_id = get_post_meta( get_the_ID(), 'vidiho_pro_video_thumbnail_id', true );
	$thumb_url      = '';

	if ( $video_thumb_id ) {
		$thumb_url = wp_get_attachment_image_url( intval( $video_thumb_id ), 'vidiho_pro_fullwidth' );
	} elseif ( has_post_thumbnail( get_the_ID() ) ) {
		$thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'vidiho_pro_fullwidth' );
	}

	$video_iframe = '';
	if ( $video_url ) {
		$video_iframe = wp_oembed_get( $video_url );
	}
?>
<div class="page-hero-video-container">
	<div
		class="page-hero-video-wrap"
		style="background-image: url(<?php echo esc_url( $thumb_url ); ?>);"
		data-video-src="<?php echo esc_url( $video_url ); ?>"
		data-video-iframe="<?php echo esc_attr( $video_iframe ); ?>"
	>
		<a href="#" class="page-hero-video-trigger">
			<span class="video-trigger-icon"></span><span class="sr-only"><?php esc_html_e( 'Play video', 'vidiho-pro' ); ?></span>
		</a>
	</div>
</div>
