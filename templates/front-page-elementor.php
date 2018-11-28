<?php
/**
 * Template Name: Front page - Elementor
 */
get_header(); ?>

<?php get_template_part( 'template-parts/slider-front-page' ); ?>

<main class="main main-extra-pad">
	<div class="container">
		<div class="row">
			<div class="col-12">

				<?php while ( have_posts() ) : the_post(); ?>

						<article id="entry-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

							<div class="entry-content">
								<?php the_content(); ?>
							</div>

						</article>

				<?php endwhile; ?>

			</div>
		</div>
	</div>
</main>

<?php get_footer();
