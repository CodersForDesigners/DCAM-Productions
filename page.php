<?php get_header(); ?>

<?php get_template_part( 'template-parts/hero' ); ?>

<main class="main">

	<div class="container">

		<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) : ?>

			<div class="row <?php vidiho_pro_the_row_classes(); ?> ">

				<div class="<?php vidiho_pro_the_container_classes(); ?>">

					<?php while ( have_posts() ) : the_post(); ?>

						<article id="entry-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

							<?php vidiho_pro_the_post_header(); ?>

							<?php vidiho_pro_the_post_thumbnail(); ?>

							<div class="entry-content">
								<?php the_content(); ?>

								<?php wp_link_pages( vidiho_pro_wp_link_pages_default_args() ); ?>
							</div>

						</article>

						<?php comments_template(); ?>

					<?php endwhile; ?>

				</div>

				<?php get_sidebar(); ?>

			</div>

		<?php endif; ?>

	</div>

</main>

<?php get_footer();
