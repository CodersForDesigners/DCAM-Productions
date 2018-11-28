<?php
if ( ! class_exists( 'CI_Widget_Home_Latest_Videos' ) ) :
	class CI_Widget_Home_Latest_Videos extends WP_Widget {

		protected $defaults = array(
			'title'        => '',
			'subtitle'     => '',
			'post_type'    => 'vidiho_pro_video',
			'taxonomy'     => 'vidiho_pro_video_category',
			'term_id'      => '',
			'random'       => false,
			'count'        => 3,
			'columns'      => 3,
			'title_center' => 1,
			'carousel'     => 0,
		);

		function __construct() {
			$widget_ops  = array( 'description' => __( 'Homepage widget. Displays a number of the latest (or random) videos, optionally from a specific category.', 'vidiho-pro' ) );
			$control_ops = array();
			parent::__construct( 'ci-home-latest-videos', esc_html__( 'Theme (home) - Latest Videos', 'vidiho-pro' ), $widget_ops, $control_ops );
		}


		function widget( $args, $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->defaults );

			$id            = isset( $args['id'] ) ? $args['id'] : '';
			$before_widget = $args['before_widget'];
			$after_widget  = $args['after_widget'];

			$title        = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			$subtitle     = $instance['subtitle'];
			$post_type    = $instance['post_type'];
			$taxonomy     = $instance['taxonomy'];
			$term_id      = $instance['term_id'];
			$random       = $instance['random'];
			$count        = $instance['count'];
			$columns      = $instance['columns'];
			$title_center = $instance['title_center'];
			$carousel     = $instance['carousel'];

			if ( 1 === intval( $columns ) ) {
				$carousel = false;
			}

			if ( 0 === $count ) {
				return;
			}

			echo $before_widget;

			if ( $title || $subtitle ) {
				$left_class = 'section-heading-left';
				if ( $title_center ) {
					$left_class = '';
				}
			 	?>
				<div class="section-heading <?php echo esc_attr( $left_class ); ?>">
					<div class="section-heading-content">
				<?php

				if ( $title ) {
					echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
				}

				if ( $subtitle ) {
					?><p class="section-subtitle"><?php echo esc_html( $subtitle ); ?></p><?php
				}

			 	?>
			 	    </div>

					<?php if ( $carousel ) : ?>
						<div class="row-slider-nav"></div>
					<?php endif; ?>

			 	</div>
			 	<?php
			}

			echo do_shortcode( sprintf( '[latest-post-type post_type="%1$s" count="%2$s" columns="%3$s" random="%4$s" carousel="%5$s" taxonomy="%6$s" term_ids="%7$s"]',
				$post_type,
				$count,
				$columns,
				$random,
				$carousel,
				$taxonomy,
				$term_id
			) );

			echo $after_widget;

		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['title']        = sanitize_text_field( $new_instance['title'] );
			$instance['subtitle']     = sanitize_text_field( $new_instance['subtitle'] );
			$instance['post_type']    = $this->defaults['post_type'];
			$instance['taxonomy']     = $this->defaults['taxonomy'];
			$instance['term_id']      = vidiho_pro_sanitize_intval_or_empty( $new_instance['term_id'] );
			$instance['random']       = isset( $new_instance['random'] );
			$instance['count']        = absint( $new_instance['count'] );
			$instance['columns']      = absint( $new_instance['columns'] );
			$instance['title_center'] = isset( $new_instance['title_center'] );
			$instance['carousel']     = isset( $new_instance['carousel'] );

			return $instance;
		} // save

		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->defaults );

			$title        = $instance['title'];
			$subtitle     = $instance['subtitle'];
			$taxonomy     = $instance['taxonomy'];
			$term_id      = $instance['term_id'];
			$random       = $instance['random'];
			$count        = $instance['count'];
			$columns      = $instance['columns'];
			$title_center = $instance['title_center'];
			$carousel     = $instance['carousel'];

			?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'vidiho-pro' ); ?></label><input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" class="widefat" /></p>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>"><?php esc_html_e( 'Subtitle:', 'vidiho-pro' ); ?></label><input id="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'subtitle' ) ); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" class="widefat" /></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'term_id' ) ); ?>"><?php esc_html_e( 'Category to display the latest videos from (optional):', 'vidiho-pro' ); ?></label>
			<?php wp_dropdown_categories( array(
				'taxonomy'          => $taxonomy,
				'show_option_all'   => '',
				'show_option_none'  => ' ',
				'option_none_value' => '',
				'show_count'        => 1,
				'echo'              => 1,
				'selected'          => $term_id,
				'hierarchical'      => 1,
				'name'              => $this->get_field_name( 'term_id' ),
				'id'                => $this->get_field_id( 'term_id' ),
				'class'             => 'postform widefat',
			) ); ?>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'random' ) ); ?>"><input type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'random' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'random' ) ); ?>" value="1" <?php checked( $random, 1 ); ?> /><?php esc_html_e( 'Show random posts.', 'vidiho-pro' ); ?></label></p>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'vidiho-pro' ); ?></label><input id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="number" min="1" step="1" value="<?php echo esc_attr( $count ); ?>" class="widefat"/></p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'columns' ) ); ?>"><?php esc_html_e( 'Output Columns:', 'vidiho-pro' ); ?></label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'columns' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'columns' ) ); ?>" class="widefat">
					<?php
						$col_options = vidiho_pro_post_type_listing_get_valid_columns_options();
						foreach ( $col_options['range'] as $col ) {
							echo sprintf( '<option value="%s" %s>%s</option>',
								esc_attr( $col ),
								selected( $columns, $col, false ),
								/* translators: %d is a number of columns. */
								esc_html( sprintf( _n( '%d Column', '%d Columns', $col, 'vidiho-pro' ), $col ) )
							);
						}
					?>
				</select>
			</p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title_center' ) ); ?>"><input type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'title_center' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'title_center' ) ); ?>" value="1" <?php checked( $title_center, 1 ); ?> /><?php esc_html_e( 'Show the title in the center.', 'vidiho-pro' ); ?></label></p>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'carousel' ) ); ?>"><input type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'carousel' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'carousel' ) ); ?>" value="1" <?php checked( $carousel, 1 ); ?> /><?php esc_html_e( 'Show items as a carousel.', 'vidiho-pro' ); ?></label></p>

			<fieldset class="ci-collapsible">
				<legend><?php esc_html_e( 'Customize', 'vidiho-pro' ); ?> <i class="dashicons dashicons-arrow-down"></i></legend>
				<div class="elements">
					<p><label for="<?php echo esc_attr( $this->get_field_id( 'overlay_color' ) ); ?>"><?php esc_html_e( 'Overlay Color:', 'vidiho-pro' ); ?></label><input id="<?php echo esc_attr( $this->get_field_id( 'overlay_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'overlay_color' ) ); ?>" type="text" value="<?php echo esc_attr( $overlay_color ); ?>" class="widefat vidiho-pro-alpha-color-picker" /></p>
					<p><label for="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>"><?php esc_html_e( 'Background Color:', 'vidiho-pro' ); ?></label><input id="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'background_color' ) ); ?>" type="text" value="<?php echo esc_attr( $background_color ); ?>" class="vidiho-pro-color-picker widefat"/></p>

					<p class="ci-collapsible-media"><label for="<?php echo esc_attr( $this->get_field_id( 'background_image' ) ); ?>"><?php esc_html_e( 'Background Image:', 'vidiho-pro' ); ?></label><input id="<?php echo esc_attr( $this->get_field_id( 'background_image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'background_image' ) ); ?>" type="text" value="<?php echo esc_attr( $background_image ); ?>" class="ci-uploaded-url widefat"/><a href="#" class="button ci-media-button"><?php esc_html_e( 'Select', 'vidiho-pro' ); ?></a></p>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( 'background_repeat' ) ); ?>"><?php esc_html_e( 'Background Repeat:', 'vidiho-pro' ); ?></label>
						<select id="<?php echo esc_attr( $this->get_field_id( 'background_repeat' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'background_repeat' ) ); ?>">
							<option value="repeat" <?php selected( 'repeat', $background_repeat ); ?>><?php esc_html_e( 'Repeat', 'vidiho-pro' ); ?></option>
							<option value="repeat-x" <?php selected( 'repeat-x', $background_repeat ); ?>><?php esc_html_e( 'Repeat Horizontally', 'vidiho-pro' ); ?></option>
							<option value="repeat-y" <?php selected( 'repeat-y', $background_repeat ); ?>><?php esc_html_e( 'Repeat Vertically', 'vidiho-pro' ); ?></option>
							<option value="no-repeat" <?php selected( 'no-repeat', $background_repeat ); ?>><?php esc_html_e( 'No Repeat', 'vidiho-pro' ); ?></option>
						</select>
					</p>
					<p><label for="<?php echo esc_attr( $this->get_field_id( 'background_size' ) ); ?>"><input type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'background_size' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'background_size' ) ); ?>" value="1" <?php checked( $background_size, 1 ); ?> /><?php esc_html_e( 'Stretch background image to cover the entire width (requires a background image).', 'vidiho-pro' ); ?></label></p>

					<p><label for="<?php echo esc_attr( $this->get_field_id( 'parallax' ) ); ?>"><input type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'parallax' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'parallax' ) ); ?>" value="1" <?php checked( $parallax, 1 ); ?> /><?php esc_html_e( 'Parallax effect (requires a background image).', 'vidiho-pro' ); ?></label></p>
				</div>
			</fieldset>
			<?php

		} // form

	}

endif;
