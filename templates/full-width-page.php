<?php
/**
 * Template Name: Full width page
 */

get_header(); ?>

<?php get_template_part( 'template-parts/hero' ); ?>

<main class="main">

	<div class="container">
		<div class="row">

			<div class="col-12">

				<?php while ( have_posts() ) : the_post(); ?>

					<article id="entry-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

						<?php vidiho_pro_the_post_header(); ?>

						<?php vidiho_pro_the_post_thumbnail( 'vidiho_pro_fullwidth' ); ?>

						<div class="entry-content">
							<?php the_content(); ?>

							<?php wp_link_pages( vidiho_pro_wp_link_pages_default_args() ); ?>
						</div>

					</article>

					<?php comments_template(); ?>

				<?php endwhile; ?>

			</div>

		</div>
	</div>

</main>

<?php get_footer();
