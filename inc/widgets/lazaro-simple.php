<?php
/**
 * Plugin Name:   Simple Widget
 * Description:   It is a so a simple!
 * Version:       0.1
 * Author:        Lazaro
 */

class LazaroSimpleWidget extends WP_Widget {

	function __construct () {
		$options = [
			'classname' => 'lazaro-simple-widget',
			'description' => esc_html__( 'This is simple template widget', 'text_domain' ),
		];
		parent::__construct( 'lazaro_simple_widget', esc_html__( 'Lazaro Simple Widget' ), $options );
	}

	public function widget ( $args, $instance ) {
		// Dump all the function arguments on the console
		?>
			<script type="text/javascript">
				console.log( "$args:" )
				console.log( <?php echo json_encode( $args ) ?> )
				console.log( "$instance:" )
				console.log( <?php echo json_encode( $instance ) ?> )
			</script>
		<?php
		// The "Before" widget markup, i.e. closing / opening tag(s)
		echo $args[ 'before_widget' ];

		if ( ! empty( $instance[ 'title' ] ) )
			echo $args[ 'before_title' ]
				. apply_filters( 'widget_title', $instance[ 'title' ] )
				. $args[ 'after_title' ];

		// The "After" widget markup, i.e. closing / opening tag(s)
		echo $args[ 'after_widget' ];
	}

	public function form ( $instance ) {
		$caption = $instance[ 'caption' ] ?? '';
		$title = $instance[ 'title' ] ?? '';
		?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'caption' ) ) ?>">
					<?php esc_attr_e( 'Title:', 'text_domain' ) ?>
				</label>
				<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ) ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ) ?>" value="<?php echo esc_attr( $title ) ?>">
			</p>
		<?php
	}

	public function update ( $new_instance, $old_instance ) {
		$instance = ! empty( $old_instance ) ? $old_instance : [ ];
		$instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
		$instance[ 'caption' ] = $new_instance[ 'caption' ] ?? '';
		return $instance;
	}

}

add_action( 'widgets_init', function () {
	register_widget( 'LazaroSimpleWidget' );
} );
