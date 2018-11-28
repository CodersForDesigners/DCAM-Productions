<div class="item-media">
	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="item-media-thumb">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'vidiho_pro_item' ); ?>
			</a>
		</figure>
	<?php endif; ?>

	<div class="item-media-content">
		<p class="item-media-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</p>

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
