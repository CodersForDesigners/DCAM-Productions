<div class="item-media">
	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="item-media-thumb">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'vidiho_pro_item' ); ?>
			</a>
		</figure>
	<?php endif; ?>

	<div class="item-media-content">
		<?php if ( get_theme_mod( 'post_show_categories', 1 ) ) : ?>
			<div class="item-media-categories">
				<?php the_category( ', ' ); ?>
			</div>
		<?php endif; ?>

		<p class="item-media-title">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</p>

		<div class="item-media-meta">
			<?php if ( get_theme_mod( 'post_show_date', 1 ) ) : ?>
				<span class="item-media-meta-item">
					<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date(); ?></time>
				</span>
			<?php endif; ?>

			<?php if ( get_theme_mod( 'post_show_author', 1 ) ) : ?>
				<span class="item-media-meta-item entry-author">
					<?php
						printf(
							/* translators: %s is the author's name. */
							esc_html_x( 'by %s', 'post author', 'vidiho-pro' ),
							'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
						);
					?>
				</span>
			<?php endif; ?>

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
