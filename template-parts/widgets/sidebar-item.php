<div class="item-media item-media-sm">
	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="item-media-thumb">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'vidiho_pro_item_media_sm' ); ?>
			</a>
		</figure>
	<?php endif; ?>

	<div class="item-media-content">
		<p class="item-media-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</p>
	</div>
</div>
