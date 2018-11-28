<?php
	$hero = vidiho_pro_get_hero_data();

	if ( ! $hero['show'] ) {
		return;
	}

	$text_align = $hero['text_align'] ? sprintf( 'page-hero-align-%s', $hero['text_align'] ) : '';

	$layout         = get_post_meta( get_queried_object_id(), 'vidiho_pro_video_layout', true );
	$video_url      = get_post_meta( get_queried_object_id(), 'vidiho_pro_video_url', true );
	$video_thumb_id = get_post_meta( get_queried_object_id(), 'vidiho_pro_video_thumbnail_id', true );
	$thumb_url      = '';

	if ( $video_thumb_id ) {
		$thumb_url = wp_get_attachment_image_url( intval( $video_thumb_id ), 'vidiho_pro_fullwidth' );
	} elseif ( has_post_thumbnail( get_queried_object_id() ) ) {
		$thumb_url = get_the_post_thumbnail_url( get_queried_object_id(), 'vidiho_pro_fullwidth' );
	}

	do_action( 'vidiho_pro_before_video_hero', $hero );

	?>
	<div class="<?php vidiho_pro_the_hero_classes(); ?>">

		<div class="container">
			<div class="row">
				<div class="col-12">

					<?php if ( 'hero' === $layout ) : ?>
						<div class="page-hero-content">
							<?php if ( has_term( '', 'vidiho_pro_video_category' ) ) : ?>
								<p class="page-hero-categories">
									<?php the_terms( get_the_ID(), 'vidiho_pro_video_category', '', ', ' ); ?>
								</p>
							<?php endif; ?>

							<?php if ( $hero['title'] ) : ?>
								<h2 class="page-hero-title"><?php echo wp_kses( $hero['title'], vidiho_pro_get_allowed_tags() ); ?></h2>
							<?php endif; ?>

							<p class="page-hero-meta">
								<time class="page-hero-time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date(); ?></time>
							</p>
						</div>

					<?php endif; ?>

					<?php if ( $video_url ) : ?>
						<?php
							$video_iframe = wp_oembed_get( $video_url );

							$sticky = '';
							if ( get_theme_mod( 'video_floating', 1 ) ) {
								$sticky = 'page-hero-video-sticky';
							}
						?>

						<div class="page-hero-video-container <?php echo esc_attr( $sticky ); ?>">
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
					<?php endif; ?>
				</div>
			</div>
		</div>

	</div>

	<?php

	do_action( 'vidiho_pro_before_video_hero', $hero );
