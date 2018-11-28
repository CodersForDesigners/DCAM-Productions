<?php
	$related   = vidiho_pro_get_related_posts( get_the_ID(), apply_filters( 'vidiho_pro_related_count', 4, get_post_type() ) );
	$columns   = apply_filters( 'vidiho_pro_related_columns', 4, get_post_type() );
	$title     = get_theme_mod( 'title_post_related_title', __( 'Related articles', 'vidiho-pro' ) );
	$subtitle  = get_theme_mod( 'title_post_related_subtitle' );
	$post_type = get_post_type();

	do_action( "vidiho_pro_before_related_{$post_type}", $related, $post_type, $title, $subtitle );

	if ( $related->have_posts() ) : ?>
		<div class="col-12">
			<section class="section-related">
				<?php if ( $title || $subtitle ) : ?>
					<div class="section-heading section-heading-left">
						<div class="section-heading-content">
							<h2 class="section-title"><?php echo esc_html( $title ); ?></h2>

							<?php if ( $subtitle ) : ?>
								<p class="section-subtitle"><?php echo esc_html( $subtitle ); ?></p>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>

				<div class="row row-items">
					<?php while ( $related->have_posts() ) : $related->the_post(); ?>
						<div class="<?php echo esc_attr( vidiho_pro_get_columns_classes( $columns ) ); ?>">
							<?php get_template_part( 'template-parts/item', get_post_type() ); ?>
						</div>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</div>
			</section>
		</div>
	<?php endif;

	do_action( "vidiho_pro_after_related_{$post_type}", $related, $post_type, $title, $subtitle );
