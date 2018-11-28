<div class="page-hero-content">
	<p class="page-hero-categories">
		<?php the_category( ', ' ); ?>
	</p>

	<h2 class="page-hero-title"><?php the_title(); ?></h2>

	<p class="page-hero-meta">
		<time class="page-hero-time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date(); ?></time>
	</p>
</div>

<div class="page-hero-video-wrap" style="background-image: url(<?php echo esc_url( get_the_post_thumbnail_url() ); ?>);"></div>
