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

		<div class="item-media-meta">
			<span class="item-media-meta-item">
				<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date(); ?></time>
			</span>
		</div>
	</div>
</div>
