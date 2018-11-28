<?php
/**
 * Template Name: Front page - Widgets
 */
get_header(); ?>

<?php get_template_part( 'template-parts/slider-front-page' ); ?>

<main class="main main-extra-pad">
	<div class="container">
		<div class="row">
			<div class="col-12">

				<?php dynamic_sidebar( 'frontpage' ); ?>

			</div>
		</div>
	</div>
</main>

<?php get_footer();
