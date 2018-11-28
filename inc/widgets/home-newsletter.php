<?php
if ( ! class_exists( 'CI_Widget_Home_Newsletter' ) ) :
	class CI_Widget_Home_Newsletter extends WP_Widget {
		protected $defaults = array(
			'title'             => '',
			'subtitle'          => '',
			'image_id'          => '',
			'text'              => '',
			'form_email'        => '',
			'form_action'       => '',
			'title_center'      => 1,
			'background_color'  => '',
			'background_image'  => '',
			'background_repeat' => 'repeat',
			'background_size'   => 1,
		);

		function __construct() {
			$widget_ops  = array( 'description' => esc_html__( 'Homepage widget. Displays a newsletter subscription form.', 'vidiho-pro' ) );
			$control_ops = array();
			WP_Widget::__construct( 'ci-home-newsletter', esc_html__( 'Theme (home) - Newsletter', 'vidiho-pro' ), $widget_ops, $control_ops );

			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_custom_css' ) );
		}

		function widget( $args, $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->defaults );

			$id            = isset( $args['id'] ) ? $args['id'] : '';
			$before_widget = $args['before_widget'];
			$after_widget  = $args['after_widget'];

			$title    = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			$subtitle = $instance['subtitle'];

			$image_id     = $instance['image_id'];
			$text         = $instance['text'];
			$form_email   = $instance['form_email'];
			$form_action  = $instance['form_action'];
			$title_center = $instance['title_center'];


			if ( ! $form_action ) {
				return;
			}

			echo $before_widget;
			?>
			<div class="widget-section-newsletter">
				<div class="row justify-content-center">
					<div class="col-10">
						<?php
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
							    </div>
							    <?php
							}
						?>

						<div class="row">
							<?php
								$image_url = wp_get_attachment_image_url( $image_id, 'full' );
								$col_class = 'col-12';
								if ( $image_url ) {
									$col_class = 'col-lg-6 col-12';
								}
							?>
							<?php if ( $image_url ) : ?>
								<div class="col-lg-6 col-12">
									<div class="widget-section-newsletter-thumb">
										<img src="<?php echo esc_url( $image_url ); ?>" alt="">
									</div>
								</div>
							<?php endif; ?>

							<div class="<?php echo esc_attr( $col_class ); ?>">
								<div class="widget-section-newsletter-content">
									<?php echo wp_kses( wpautop( $text ), vidiho_pro_get_allowed_tags() ); ?>

									<form action="<?php echo esc_url( $form_action ); ?>" class="form-newsletter">
										<label for="newsletter-email" class="sr-only"><?php esc_html_e( 'Your email', 'vidiho-pro' ); ?></label>
										<input name="<?php echo esc_attr( $form_email ); ?>" type="email" id="newsletter-email" placeholder="<?php esc_attr_e( 'Your email', 'vidiho-pro' ); ?>">

										<button class="btn btn-sm" type="submit">
											<?php
												/* translators: If your language is RTL, change fa-arrow-alt-circle-right to fa-arrow-alt-circle-left */
												echo wp_kses( __( 'Sign Up <i class="far fa-arrow-alt-circle-right"></i>', 'vidiho-pro' ), vidiho_pro_get_allowed_tags() );
											?>
										</button>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
			<?php

			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['title']        = sanitize_text_field( $new_instance['title'] );
			$instance['subtitle']     = sanitize_text_field( $new_instance['subtitle'] );
			$instance['image_id']     = vidiho_pro_sanitize_intval_or_empty( $new_instance['image_id'] );
			$instance['text']         = wp_kses( $new_instance['text'], vidiho_pro_get_allowed_tags() );
			$instance['form_email']   = sanitize_text_field( $new_instance['form_email'] );
			$instance['form_action']  = esc_url_raw( $new_instance['form_action'] );
			$instance['title_center'] = isset( $new_instance['title_center'] );

			$instance['background_color']  = sanitize_hex_color( $new_instance['background_color'] );
			$instance['background_image']  = esc_url_raw( $new_instance['background_image'] );
			$instance['background_repeat'] = vidiho_pro_sanitize_image_repeat( $new_instance['background_repeat'] );
			$instance['background_size']   = isset( $new_instance['background_size'] );

			return $instance;
		}

		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->defaults );

			$title        = $instance['title'];
			$subtitle     = $instance['subtitle'];
			$image_id     = $instance['image_id'];
			$text         = $instance['text'];
			$form_email   = $instance['form_email'];
			$form_action  = $instance['form_action'];
			$title_center = $instance['title_center'];

			$background_color  = $instance['background_color'];
			$background_image  = $instance['background_image'];
			$background_repeat = $instance['background_repeat'];
			$background_size   = $instance['background_size'];
			?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'vidiho-pro' ); ?></label><input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" class="widefat" /></p>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>"><?php esc_html_e( 'Subtitle:', 'vidiho-pro' ); ?></label><input id="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'subtitle' ) ); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" class="widefat" /></p>

			<p>
				<label class="post-field-item"><?php esc_html_e( 'Image:', 'vidiho-pro' ); ?>
					<div class="ci-upload-preview">
						<div class="upload-preview">
							<?php if ( ! empty( $image_id ) ): ?>
								<?php
									$image_url = wp_get_attachment_image_url( $image_id, 'vidiho_pro_featgal_small_thumb' );
									echo sprintf( '<img src="%s" /><a href="#" class="close media-modal-icon" title="%s"></a>',
										esc_url( $image_url ),
										esc_attr__( 'Remove image', 'vidiho-pro' )
									);
								?>
							<?php endif; ?>
						</div>
						<input type="hidden" class="ci-uploaded-id" name="<?php echo esc_attr( $this->get_field_name( 'image_id' ) ); ?>" value="<?php echo esc_attr( $image_id ); ?>" />
						<input type="button" class="button ci-media-button" value="<?php esc_attr_e( 'Select Image', 'vidiho-pro' ); ?>" />
					</div>
				</label>
			</p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php esc_html_e( 'Text:', 'vidiho-pro' ); ?></label><textarea id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" class="widefat"><?php echo esc_textarea( $text ); ?></textarea></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title_center' ) ); ?>"><input type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'title_center' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'title_center' ) ); ?>" value="1" <?php checked( $title_center, 1 ); ?> /><?php esc_html_e( 'Show the title in the center.', 'vidiho-pro' ); ?></label></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'form_email' ) ); ?>"><?php esc_html_e( 'Form email field name attribute:', 'vidiho-pro' ); ?></label><input id="<?php echo esc_attr( $this->get_field_id( 'form_email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'form_email' ) ); ?>" type="text" value="<?php echo esc_attr( $form_email ); ?>" class="widefat" /></p>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'form_action' ) ); ?>"><?php esc_html_e( 'Form Action URL:', 'vidiho-pro' ); ?></label><input id="<?php echo esc_attr( $this->get_field_id( 'form_action' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'form_action' ) ); ?>" type="text" value="<?php echo esc_url( $form_action ); ?>" class="widefat" /></p>

			<fieldset class="ci-collapsible">
				<legend><?php esc_html_e( 'Customize', 'vidiho-pro' ); ?> <i class="dashicons dashicons-arrow-down"></i></legend>
				<div class="elements">
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
				</div>
			</fieldset>
			<?php
		}


		function enqueue_custom_css() {
			$settings = $this->get_settings();

			if ( empty( $settings ) ) {
				return;
			}

			foreach ( $settings as $instance_id => $instance ) {
				$id = $this->id_base . '-' . $instance_id;

				if ( ! is_active_widget( false, $id, $this->id_base ) ) {
					continue;
				}

				$instance = wp_parse_args( (array) $instance, $this->defaults );

				$sidebar_id      = false; // Holds the sidebar id that the widget is assigned to.
				$sidebar_widgets = wp_get_sidebars_widgets();
				if ( ! empty( $sidebar_widgets ) ) {
					foreach ( $sidebar_widgets as $sidebar => $widgets ) {
						// We need to check $widgets for emptiness due to https://core.trac.wordpress.org/ticket/14876
						if ( ! empty( $widgets ) && array_search( $id, $widgets ) !== false ) {
							$sidebar_id = $sidebar;
						}
					}
				}

				$background_color  = $instance['background_color'];
				$background_image  = $instance['background_image'];
				$background_repeat = $instance['background_repeat'];
				$background_size   = $instance['background_size'] ? 'cover' : 'auto'; // Assumes that background-size: cover; is applied by default.

				$css = '';

				if ( ! empty( $background_color ) ) {
					$css .= 'background-color: ' . $background_color . '; ';
				}
				if ( ! empty( $background_image ) ) {
					$css .= 'background-image: url(' . esc_url( $background_image ) . '); ';
					$css .= 'background-repeat: ' . $background_repeat . '; ';
				}

				if ( ! empty( $background_size ) ) {
					$css .= 'background-size: ' . $background_size . '; ';
				}

				if ( ! empty( $css ) ) {
					$css = '#' . $id . ' .widget-section-newsletter { ' . $css . ' } ' . PHP_EOL;
					wp_add_inline_style( 'vidiho-pro-style', $css );
				}

			}

		}

	}
endif;
