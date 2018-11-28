<?php
/**
 * Customize Slick Slider Control class.
 *
 * @see WP_Customize_Control
 */
class Vidiho_Pro_Customize_Slick_Slider_Control extends WP_Customize_Control {
	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'slick-slider';

	/**
	 * Taxonomy for category dropdown.
	 *
	 * @access public
	 * @var string
	 */
	protected $options = false;

	public function __construct( $manager, $id, $args = array(), $options = array() ) {
		$this->options = $options;

		if ( ! isset( $args['settings'] ) ) {
			$manager->add_setting( $id . '_show', array(
				'default'           => 1,
				'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
			) );
			$manager->add_setting( $id . '_limit', array(
				'default'           => 5,
				'sanitize_callback' => array( $this, 'sanitize_positive_or_minus_one' ),
			) );
			$manager->add_setting( $id . '_autoplay', array(
				'default'           => '',
				'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
			) );
			$manager->add_setting( $id . '_autoplaySpeed', array(
				'default'           => 3000,
				'sanitize_callback' => 'absint',
			) );
			$manager->add_setting( $id . '_fade', array(
				'default'           => '',
				'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
			) );
			$this->settings = array(
				'show'          => $id . '_show',
				'limit'         => $id . '_limit',
				'autoplay'      => $id . '_autoplay',
				'autoplaySpeed' => $id . '_autoplaySpeed',
				'fade'          => $id . '_fade',
			);
		}
		parent::__construct( $manager, $id, $args );
	}

	protected function render_content() {
		if ( ! empty( $this->label ) ) :
			?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
		endif;

		if ( ! empty( $this->description ) ) :
			?><span class="description customize-control-description"><?php echo $this->description; ?></span><?php
		endif;

		?>
		<ul>
			<li>
				<label>
					<input type="checkbox" value="1" <?php $this->link( 'show' ); ?> <?php checked( $this->value( 'show' ), 1 ); ?> />
					<?php _e( 'Show slider.', 'vidiho-pro' ); ?>
				</label>
			</li>

			<li>
				<label>
					<input type="checkbox" value="1" <?php $this->link( 'autoplay' ); ?> <?php checked( $this->value( 'autoplay' ), 1 ); ?> />
					<?php _e( 'Auto slide.', 'vidiho-pro' ); ?>
				</label>
			</li>

			<li>
				<label>
					<span class="customize-control-title"><?php _e( 'Limit posts:', 'vidiho-pro' ); ?></span>
					<input type="number" min="-1" step="1" value="<?php echo esc_attr( $this->value( 'limit' ) ); ?>" <?php $this->link( 'limit' ); ?> />
				</label>
			</li>

			<li>
				<label>
					<span class="customize-control-title"><?php _e( 'Slide change effect:', 'vidiho-pro' ); ?></span>
					<select <?php $this->link( 'fade' ); ?>>
						<option value="" <?php selected( $this->value( 'fade' ), '' ); ?>><?php _ex( 'Slide', 'slick slider slide effect', 'vidiho-pro' ); ?></option>
						<option value="1" <?php selected( $this->value( 'fade' ), 1 ); ?>><?php _ex( 'Fade', 'slick slider slide effect', 'vidiho-pro' ); ?></option>
					</select>
				</label>
			</li>

			<li>
				<label>
					<span class="customize-control-title"><?php _e( 'Pause between slides (in milliseconds):', 'vidiho-pro' ); ?></span>
					<input type="number" min="100" step="100" value="<?php echo esc_attr( $this->value( 'autoplaySpeed' ) ); ?>" <?php $this->link( 'autoplaySpeed' ); ?> />
				</label>
			</li>
		</ul>
		<?php

	}

	public static function sanitize_post_ids( $input ) {
		$input = explode( ',', $input );
		if ( false === $input ) {
			return '';
		}
		$input = array_map( 'trim', $input );
		$input = array_map( 'absint', $input );
		$input = implode( ',', $input );

		return $input;
	}

	public static function sanitize_checkbox( $input ) {
		if ( 1 === intval( $input ) ) {
			return 1;
		}

		return '';
	}

	public static function sanitize_positive_or_minus_one( $input ) {
		if ( intval( $input ) > 0 ) {
			return intval( $input );
		}

		return -1;
	}

}
