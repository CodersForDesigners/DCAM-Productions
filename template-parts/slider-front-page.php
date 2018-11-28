<?php
	if ( get_theme_mod( 'home_slider_show', 1 ) ) {

		$q = new WP_Query( array(
			'post_type'           => 'any',
			'posts_per_page'      => get_theme_mod( 'home_slider_limit', 5 ),
			'meta_key'            => 'home_slider',
			'meta_value'          => '1',
			'ignore_sticky_posts' => true,
		) );

		if ( $q->have_posts() ) {
			$autoplay = get_theme_mod( 'home_slider_autoplay' ) ? 'true' : 'false';
			$effect   = get_theme_mod( 'home_slider_fade' ) ? 'fade' : 'slide';
			$speed    = get_theme_mod( 'home_slider_autoplaySpeed', 3000 );
			?>
			<div
				class="page-hero-slideshow vidiho-pro-slick-slider"
				data-navigation="arrows"
				data-effect="<?php echo esc_attr( $effect ); ?>"
				data-slide-speed="<?php echo esc_attr( $speed ); ?>"
				data-autoslide="<?php echo esc_attr( $autoplay ); ?>"
			>
				<?php while ( $q->have_posts() ) : $q->the_post(); ?>
					<div class="page-hero page-hero-lg">
						<div class="container">
							<div class="row">
								<div class="col-12">
									<?php get_template_part( 'template-parts/slider-front-page-slide', get_post_type() ); ?>
								</div>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</div>
			<?php
		}
	} else {
		get_template_part( 'template-parts/hero' );
	}
