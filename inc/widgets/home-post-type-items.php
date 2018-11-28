<?php
if ( ! class_exists( 'CI_Widget_Home_Post_Type_Items' ) ) :
	class CI_Widget_Home_Post_Type_Items extends WP_Widget {

		public $ajax_posts = 'vidiho_pro_home_post_type_items_widget_post_type_ajax_get_posts';

		protected $defaults = array(
			'title'        => '',
			'subtitle'     => '',
			'post_type'    => 'post',
			'rows'         => array(),
			'columns'      => 3,
			'title_center' => 1,
			'carousel'     => 0,
		);

		function __construct() {
			$widget_ops  = array( 'description' => esc_html__( 'Homepage widget. Displays a hand-picked selection of posts from a selected post type.', 'vidiho-pro' ) );
			$control_ops = array();
			parent::__construct( 'ci-home-post-type-items', esc_html__( 'Theme (home) - Post Type Items', 'vidiho-pro' ), $widget_ops, $control_ops );

			if ( is_admin() === true ) {
				add_action( 'wp_ajax_' . $this->ajax_posts, 'CI_Widget_Home_Post_Type_Items::_ajax_get_posts' );
			}
		}

		function widget( $args, $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->defaults );

			$id            = isset( $args['id'] ) ? $args['id'] : '';
			$before_widget = $args['before_widget'];
			$after_widget  = $args['after_widget'];

			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			$subtitle     = $instance['subtitle'];
			$post_type    = $instance['post_type'];
			$rows         = $instance['rows'];
			$columns      = $instance['columns'];
			$title_center = $instance['title_center'];
			$carousel     = $instance['carousel'];

			if ( 1 === intval( $columns ) ) {
				$carousel = false;
			}

			if ( empty( $post_type ) || empty( $rows ) ) {
				return;
			}

			$ids = wp_list_pluck( $rows, 'post_id' );
			$ids = array_filter( $ids );

			$q = new WP_Query( array(
				'post_type'      => $post_type,
				'posts_per_page' => - 1,
				'post__in'       => $ids,
				'orderby'        => 'post__in',
			) );

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

			$slider_class = '';
			if ( $carousel ) {
				$slider_class = 'row-slider';
			}

			if ( $q->have_posts() ) {
				?><div class="row row-items <?php echo esc_attr( $slider_class ); ?>"><?php

					while ( $q->have_posts() ) {
						$q->the_post();

						?><div class="<?php echo esc_attr( vidiho_pro_get_columns_classes( $columns ) ); ?>"><?php

						if ( 1 === $columns ) {
							get_template_part( 'template-parts/widgets/home-item-media', get_post_type() );
						} else {
							get_template_part( 'template-parts/widgets/home-item', get_post_type() );
						}

						?></div><?php
					}
					wp_reset_postdata();

				?></div><?php
			}

			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['title']        = sanitize_text_field( $new_instance['title'] );
			$instance['subtitle']     = sanitize_text_field( $new_instance['subtitle'] );
			$instance['post_type']    = in_array( $new_instance['post_type'], $this->get_available_post_types( 'names' ), true ) ? $new_instance['post_type'] : $this->defaults['post_type'];
			$instance['rows']         = $this->sanitize_instance_rows( $new_instance );
			$instance['columns']      = absint( $new_instance['columns'] );
			$instance['title_center'] = isset( $new_instance['title_center'] );
			$instance['carousel']     = isset( $new_instance['carousel'] );

			return $instance;
		}

		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->defaults );

			$title        = $instance['title'];
			$subtitle     = $instance['subtitle'];
			$post_type    = $instance['post_type'];
			$rows         = $instance['rows'];
			$columns      = $instance['columns'];
			$title_center = $instance['title_center'];
			$carousel     = $instance['carousel'];

			$post_types       = $this->get_available_post_types();
			$row_post_id_name = $this->get_field_name( 'row_post_id' ) . '[]';
			?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'vidiho-pro' ); ?></label><input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" class="widefat" /></p>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>"><?php esc_html_e( 'Subtitle:', 'vidiho-pro' ); ?></label><input id="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'subtitle' ) ); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" class="widefat" /></p>

			<p data-ajaxposts="<?php echo esc_attr( $this->ajax_posts ); ?>">
				<label for="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>"><?php esc_html_e( 'Post type:', 'vidiho-pro' ); ?></label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_type' ) ); ?>" class="widefat vidiho-pro-post-type-select">
					<?php foreach ( $post_types as $key => $pt ) {
						?><option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $post_type ); ?>><?php echo esc_html( $pt->labels->name ); ?></option><?php
					} ?>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'columns' ); ?>"><?php esc_html_e( 'Output Columns:', 'vidiho-pro' ); ?></label>
				<select id="<?php echo $this->get_field_id( 'columns' ); ?>" name="<?php echo $this->get_field_name( 'columns' ); ?>">
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

			<p><?php esc_html_e( 'Add as many items as you want by pressing the "Add Item" button. Remove any item by selecting "Remove me".', 'vidiho-pro' ); ?></p>
			<fieldset class="ci-repeating-fields">
				<div class="inner">
					<?php
						if ( ! empty( $rows ) ) {
							$count = count( $rows );
							for ( $i = 0; $i < $count; $i ++ ) {
								?>
								<div class="post-field">
									<label class="post-field-item" data-value="<?php echo esc_attr( $rows[ $i ]['post_id'] ); ?>"><?php esc_html_e( 'Item:', 'vidiho-pro' ); ?>
										<?php
											vidiho_pro_dropdown_posts( array(
												'post_type'            => $post_type,
												'selected'             => $rows[ $i ]['post_id'],
												'class'                => 'widefat posts_dropdown',
												'show_option_none'     => '&nbsp;',
												'select_even_if_empty' => true,
											), $row_post_id_name );
										?>
									</label>

									<p class="ci-repeating-remove-action"><a href="#" class="button ci-repeating-remove-field"><i class="dashicons dashicons-dismiss"></i><?php esc_html_e( 'Remove me', 'vidiho-pro' ); ?></a></p>
								</div>
								<?php
							}
						}
					?>
					<?php
					//
					// Add an empty and hidden set for jQuery
					//
					?>
					<div class="post-field field-prototype" style="display: none;">
						<label class="post-field-item"><?php esc_html_e( 'Item:', 'vidiho-pro' ); ?>
							<?php
								vidiho_pro_dropdown_posts( array(
									'post_type'            => $post_type,
									'class'                => 'widefat posts_dropdown',
									'show_option_none'     => '&nbsp;',
									'select_even_if_empty' => true,
								), $row_post_id_name );
							?>
						</label>

						<p class="ci-repeating-remove-action"><a href="#" class="button ci-repeating-remove-field"><i class="dashicons dashicons-dismiss"></i><?php esc_html_e( 'Remove me', 'vidiho-pro' ); ?></a></p>
					</div>
				</div>
				<a href="#" class="ci-repeating-add-field button"><i class="dashicons dashicons-plus-alt"></i><?php esc_html_e( 'Add Item', 'vidiho-pro' ); ?></a>
			</fieldset>
			<?php
		}

		protected function sanitize_instance_rows( $instance ) {
			if ( empty( $instance ) || ! is_array( $instance ) ) {
				return array();
			}

			$ids = $instance['row_post_id'];

			$count = count( $ids );

			$new_fields = array();

			$records_count = 0;

			for ( $i = 0; $i < $count; $i++ ) {
				if ( empty( $ids[ $i ] ) ) {
					continue;
				}

				$new_fields[ $records_count ]['post_id'] = ! empty( $ids[ $i ] ) ? intval( $ids[ $i ] ) : '';

				$records_count++;
			}
			return $new_fields;
		}


		protected function get_available_post_types( $return = 'objects' ) {
			$return = in_array( $return, array( 'objects', 'names' ), true ) ? $return : 'objects';

			$post_types = get_post_types( array(
				'public' => true,
			), $return );

			unset( $post_types['attachment'] );

			$post_types = apply_filters( 'vidiho_pro_widget_post_types_dropdown', $post_types, __CLASS__ );

			return $post_types;
		}

		static function _ajax_get_posts() {
			$post_type_name = isset( $_POST['post_type_name'] ) ? sanitize_key( $_POST['post_type_name'] ) : 'post'; // Input var okay.
			$name_field     = isset( $_POST['name_field'] ) ? esc_attr( $_POST['name_field'] ) : ''; // Input var okay.

			$str = vidiho_pro_dropdown_posts( array(
				'echo'                 => false,
				'post_type'            => $post_type_name,
				'class'                => 'widefat posts_dropdown',
				'show_option_none'     => '&nbsp;',
				'select_even_if_empty' => true,
			), $name_field );

			echo $str;
			die;
		}

	} // class

endif;
