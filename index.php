<?php get_header(); ?>

<?php get_template_part( 'template-parts/hero' ); ?>

<main class="main">
	<div class="container">
		<div class="row <?php vidiho_pro_the_row_classes(); ?>">
			<div class="<?php vidiho_pro_the_container_classes(); ?>">
				<?php
					if ( have_posts() ) :

						$layout  = get_theme_mod( 'archive_layout', vidiho_pro_archive_layout_default() );
						$masonry = get_theme_mod( 'archive_masonry', 1 );
						$classes = array();
						if ( $masonry ) {
							$classes[] = 'row-isotope';
						}

						?>
						<div class="row row-items <?php echo esc_attr( implode( ' ', $classes ) ); ?>">

							<?php while ( have_posts() ) : the_post(); ?>

								<div class="<?php echo esc_attr( vidiho_pro_get_columns_classes( $layout ) ); ?>">

									<?php
										if ( 1 === intval( $layout ) ) {
											get_template_part( 'template-parts/item-media', get_post_type() );
										} else {
											if ( $masonry ) {
												get_template_part( 'template-parts/item-tall', get_post_type() );
											} else {
												get_template_part( 'template-parts/item', get_post_type() );
											}
										}
									?>

								</div>

							<?php endwhile; ?>

						</div>
						<?php

						vidiho_pro_posts_pagination();

					else :

						get_template_part( 'template-parts/article', 'none' );

					endif;
				?>
			</div>

			<?php get_sidebar(); ?>
		</div>
	</div>
</main>

<?php get_footer();
