<?php get_header(); ?>

<?php get_template_part( 'template-parts/hero' ); ?>

<main class="main">

	<div class="container">

		<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) : ?>

			<div class="row <?php vidiho_pro_the_row_classes(); ?>">

				<div class="<?php vidiho_pro_the_container_classes(); ?>">

					<?php while ( have_posts() ) : the_post(); ?>

						<article id="entry-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

							<?php vidiho_pro_the_post_header(); ?>

							<?php vidiho_pro_the_post_thumbnail(); ?>

							<div class="entry-content">
								<?php the_content(); ?>

								<?php wp_link_pages( vidiho_pro_wp_link_pages_default_args() ); ?>
							</div>

							<?php if ( has_tag() && get_theme_mod( 'post_show_tags', 1 ) ) : ?>
								<div class="entry-tags">
									<?php the_tags( '', ' ' ); ?>
								</div>
							<?php endif; ?>

						</article>

						<?php if ( get_theme_mod( 'post_show_authorbox', 1 ) ) {
							vidiho_pro_the_post_author_box();
						} ?>

						<?php if ( get_theme_mod( 'post_show_comments', 1 ) ) {
							comments_template();
						} ?>

					<?php endwhile; ?>

				</div>

				<?php get_sidebar(); ?>

				<?php if ( get_theme_mod( 'post_show_related', 1 ) ) {
					get_template_part( 'template-parts/related', get_post_type() );
				} ?>

			</div>

		<?php endif; ?>

	</div>

</main>

<?php get_footer();
