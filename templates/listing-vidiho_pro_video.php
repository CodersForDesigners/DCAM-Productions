<?php
/**
 * Template Name: Video listing
 */

get_header(); ?>

<?php get_template_part( 'template-parts/hero' ); ?>

<main class="main">

	<div class="container">
		<div class="row">

			<div class="col-12">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php vidiho_pro_the_post_header(); ?>

					<?php vidiho_pro_the_post_thumbnail( 'vidiho_pro_fullwidth' ); ?>

					<div class="entry-content">
						<?php the_content(); ?>
					</div>

					<?php
						$data = vidiho_pro_post_type_listing_get_template_data( get_the_ID(), 'vidiho_pro_video' );
						$q    = new WP_Query( $data['query_args'] );
					?>

					<?php if ( $data['taxonomy'] && $data['isotope'] ) : ?>
						<div class="item-filters">
							<button class="item-filter filter-active" data-filter="*"><?php echo esc_html( _x( 'All', 'all categories', 'vidiho-pro' ) ); ?></button>
							<?php $cats = get_terms( $data['taxonomy'], $data['get_terms_args'] ); ?>
							<?php foreach ( $cats as $cat ) : ?>
								<button class="item-filter" data-filter=".term-<?php echo esc_attr( $cat->term_id ); ?>"><?php echo esc_html( $cat->name ); ?></button>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<div class="row row-items <?php echo esc_attr( implode( ' ', $data['container_classes'] ) ); ?>">
						<?php while ( $q->have_posts() ) : $q->the_post(); ?>
							<?php $terms_classes = implode( ' ', vidiho_pro_post_type_listing_get_post_terms_classes( get_the_ID(), $data['taxonomy'] ) ); ?>
							<div class="<?php echo esc_attr( vidiho_pro_get_columns_classes( $data['columns'] ) ); ?> <?php echo esc_attr( $terms_classes ); ?>">
								<?php
									if ( 1 === intval( $data['columns'] ) ) {
										get_template_part( 'template-parts/item-media', get_post_type() );
									} else {
										get_template_part( 'template-parts/item', get_post_type() );
									}
								?>
							</div>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					</div>

					<?php vidiho_pro_posts_pagination( array(), $q ); ?>

				<?php endwhile; ?>

			</div>

		</div>
	</div>

</main>

<?php get_footer();
