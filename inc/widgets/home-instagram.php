<?php
/*
 * This file contains parts of code taken from the "WP Instagram Widget" WordPress plugin, Copyright 2013 Scott Evans,
 * licensed under the GPLv2 or later. https://github.com/scottsweb/wp-instagram-widget
 */
if ( class_exists( 'null_instagram_widget' ) && ! class_exists( 'CI_Widget_Home_Instagram' ) ) :
	class CI_Widget_Home_Instagram extends null_instagram_widget {
		protected $defaults = array(
			'title'        => '',
			'username'     => '',
			'number'       => 9,
			'target'       => '_self',
			'link'         => 'Follow me!',
			'title_center' => 1,
		);

		function __construct() {
			$widget_ops  = array( 'description' => esc_html__( 'Homepage widget. Displays your latest Instagram photos. Requires the plugin "WP Instagram Widget" to be active.', 'vidiho-pro' ) );
			$control_ops = array();
			WP_Widget::__construct( 'ci-home-instagram', esc_html__( 'Theme (home) - Instagram', 'vidiho-pro' ), $widget_ops, $control_ops );
		}

		function widget( $args, $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->defaults );

			$id            = isset( $args['id'] ) ? $args['id'] : '';
			$before_widget = $args['before_widget'];
			$after_widget  = $args['after_widget'];

			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			$username = $instance['username'];
			$number   = $instance['number'];
			$target   = $instance['target'];
			$link     = $instance['link'];

			$title_center = $instance['title_center'];

			echo $before_widget;


			if ( $title || $link ) {
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

				if ( $link ) {
					?><p class="section-subtitle"><?php

					echo sprintf( '<a href="%s" rel="me" target="%s">%s</a>',
						esc_url( sprintf( 'https://instagram.com/%s', $username ) ),
						esc_attr( $target ),
						esc_html( $link )
					);

					?></p><?php
				}

			 	?>
			 	    </div>
			 	</div>
			 	<?php
			}


			if ( ! empty( $username ) ) {
				$media_array = $this->scrape_instagram( $username );

				if ( is_wp_error( $media_array ) ) {
					echo wp_kses_post( $media_array->get_error_message() );
				} else {

					// filter for images only?
					if ( $images_only = apply_filters( 'wpiw_images_only', false ) ) {
						$media_array = array_filter( $media_array, array( $this, 'images_only' ) );
					}

					// slice list down to required limit
					$media_array = array_slice( $media_array, 0, $number );

					?>
					<ul class="instagram-pics instagram-size-large"><?php
					foreach ( $media_array as $item ) {
						echo sprintf( '<li><a href="%s" target="%s"><img src="%s" alt="%s"></a></li>',
							esc_url( $item['link'] ),
							esc_attr( $target ),
							esc_url( $item['large'] ),
							esc_attr( $item['description'] )
						);
					}
					?></ul><?php
				}
			}

			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['title']    = sanitize_text_field( $new_instance['title'] );
			$instance['username'] = trim( sanitize_text_field( $new_instance['username'] ) );
			$instance['number']   = absint( $new_instance['number'] );
			$instance['target']   = in_array( $new_instance['target'], array( '_self', '_blank' ), true ) ? $new_instance['target'] : $this->defaults['target'];
			$instance['link']     = sanitize_text_field( $new_instance['link'] );

			$instance['title_center'] = isset( $new_instance['title_center'] );

			return $instance;
		}

		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->defaults );

			$title    = $instance['title'];
			$username = $instance['username'];
			$number   = $instance['number'];
			$target   = $instance['target'];
			$link     = $instance['link'];

			$title_center = $instance['title_center'];
			?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'vidiho-pro' ); ?></label><input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" class="widefat" /></p>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e( 'Username:', 'vidiho-pro' ); ?></label><input id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>" class="widefat" /></p>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of photos:', 'vidiho-pro' ); ?></label><input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" min="1" step="1" value="<?php echo esc_attr( $number ); ?>" class="widefat" /></p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php esc_html_e( 'Open links in:', 'vidiho-pro' ); ?></label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>">
					<?php $choices = array(
						'_self'  => esc_html__( 'Current window', 'vidiho-pro' ),
						'_blank' => esc_html__( 'New window', 'vidiho-pro' ),
					); ?>
					<?php foreach ( $choices as $value => $description ) : ?>
						<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $value, $target ); ?>><?php echo wp_kses( $description, array() ); ?></option>
					<?php endforeach; ?>
				</select>
			</p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php esc_html_e( 'Link text:', 'vidiho-pro' ); ?></label><input id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" class="widefat" /></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title_center' ) ); ?>"><input type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'title_center' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'title_center' ) ); ?>" value="1" <?php checked( $title_center, 1 ); ?> /><?php esc_html_e( 'Show the title in the center.', 'vidiho-pro' ); ?></label></p>
			<?php
		}

	}
endif;
