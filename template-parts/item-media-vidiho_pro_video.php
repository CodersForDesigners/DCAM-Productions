<?php
	$thumb_id = false;
	if ( has_post_thumbnail() ) {
		$thumb_id = get_post_thumbnail_id();
	} else {
		$thumb_id = get_post_meta( get_the_ID(), 'vidiho_pro_video_thumbnail_id', true );
	}

	$thumb_url = wp_get_attachment_image_url( $thumb_id, 'vidiho_pro_item_video' );
?>
<div class="item-media">
	<?php if ( ! empty( $thumb_id ) ) : ?>
		<figure class="item-media-thumb">
			<a href="<?php the_permalink(); ?>">
				<?php echo wp_get_attachment_image( $thumb_id, 'vidiho_pro_item' ); ?>
			</a>
		</figure>
	<?php endif; ?>

	<div class="item-media-content">
		<?php if ( has_term( '', 'vidiho_pro_video_category' ) ) : ?>
			<div class="item-media-categories">
				<?php the_terms( get_the_ID(), 'vidiho_pro_video_category', '', ', ' ); ?>
			</div>
		<?php endif; ?>

		<p class="item-media-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</p>

		<div class="item-media-meta">
			<span class="item-media-meta-item">
				<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date(); ?></time>
			</span>

			<?php if ( get_theme_mod( 'post_show_comments', 1 ) ) : ?>
				<?php if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
					<span class="item-media-meta-item entry-comments-link">
						<?php
							/* translators: %s: post title */
							comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'vidiho-pro' ), array(
								'span' => array(
									'class' => array(),
								),
							) ), get_the_title() ) );
						?>
					</span>
				<?php endif; ?>
			<?php endif; ?>
		</div>

		<div class="item-media-excerpt">
			<?php the_excerpt(); ?>
		</div>

		<a href="<?php the_permalink(); ?>" class="btn btn-sm btn-entry-more">
			<?php
				/* translators: If your language is RTL, change fa-arrow-alt-circle-right to fa-arrow-alt-circle-left */
				echo wp_kses( __( 'Read More <i class="far fa-arrow-alt-circle-right"></i>', 'vidiho-pro' ), vidiho_pro_get_allowed_tags() );
			?>
		</a>
	</div>
</div>
