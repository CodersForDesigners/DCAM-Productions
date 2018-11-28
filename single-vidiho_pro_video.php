<?php get_header(); ?>

<?php get_template_part( 'template-parts/hero', get_post_type() ); ?>

<main class="main main-extra-pad">

	<div class="container">

		<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) : ?>

			<div class="row <?php vidiho_pro_the_row_classes(); ?> ">

				<div class="<?php vidiho_pro_the_container_classes(); ?>">

					<?php while ( have_posts() ) : the_post(); ?>
						<article id="entry-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

							<?php $layout = get_post_meta( get_queried_object_id(), 'vidiho_pro_video_layout', true ); ?>
							<?php if ( 'hero' !== $layout ) : ?>
								<header class="entry-header">
									<div class="entry-meta">
										<span class="entry-meta-item">
											<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date(); ?></time>
										</span>

										<?php if ( has_term( '', 'vidiho_pro_video_category' ) ) : ?>
											<span class="entry-meta-item entry-categories">
												<?php the_terms( get_the_ID(), 'vidiho_pro_video_category', '', ', ' ); ?>
											</span>
										<?php endif; ?>
									</div>

									<h1 class="entry-title"><?php the_title(); ?></h1>
								</header>
							<?php endif; ?>

							<?php vidiho_pro_the_post_thumbnail(); ?>

							<div class="entry-content">
								<?php the_content(); ?>
							</div>
						</article>

						<?php vidiho_pro_the_post_author_box(); ?>

						<?php comments_template(); ?>

					<?php endwhile; ?>
				</div>

				<?php get_sidebar(); ?>

				<?php get_template_part( 'template-parts/related', get_post_type() ); ?>

			</div>

		<?php endif; ?>

	</div>

</main>

<?php get_footer();
