<?php
/**
 * Generic sanitization functions.
 */

/**
 * Sanitizes integer input while differentiating zero from empty string.
 *
 * @param int|string $input Input value to sanitize.
 * @return int|string Integer value, 0, or an empty string otherwise.
 */
function vidiho_pro_sanitize_intval_or_empty( $input ) {
	if ( false === $input || '' === $input || is_null( $input ) ) {
		return '';
	}

	if ( 0 === intval( $input ) ) {
		return 0;
	}

	return intval( $input );
}



/**
 * Return a list of allowed tags and attributes for a given context.
 *
 * @param string $context The context for which to retrieve tags.
 *                        Currently available contexts: guide
 * @return array List of allowed tags and their allowed attributes.
 */
function vidiho_pro_get_allowed_tags( $context = '' ) {
	$allowed = array(
		'a'       => array(
			'href'   => true,
			'title'  => true,
			'class'  => true,
			'target' => true,
		),
		'abbr'    => array( 'title' => true, ),
		'acronym' => array( 'title' => true, ),
		'b'       => array( 'class' => true, ),
		'br'      => array(),
		'code'    => array( 'class' => true, ),
		'em'      => array( 'class' => true, ),
		'i'       => array( 'class' => true, ),
		'img'     => array(
			'alt'    => true,
			'class'  => true,
			'src'    => true,
			'width'  => true,
			'height' => true,
		),
		'li'      => array( 'class' => true, ),
		'ol'      => array( 'class' => true, ),
		'p'       => array( 'class' => true, ),
		'pre'     => array( 'class' => true, ),
		'span'    => array( 'class' => true, ),
		'strong'  => array( 'class' => true, ),
		'ul'      => array( 'class' => true, ),
	);

	switch ( $context ) {
		case 'guide':
			unset( $allowed['p'] );
			break;
		default:
			break;
	}

	return apply_filters( 'vidiho_pro_get_allowed_tags', $allowed, $context );
}

function vidiho_pro_get_text_align_choices() {
	return apply_filters( 'vidiho_pro_text_align_choices', array(
		'left'   => esc_html__( 'Left', 'vidiho-pro' ),
		'center' => esc_html__( 'Center', 'vidiho-pro' ),
		'right'  => esc_html__( 'Right', 'vidiho-pro' ),
	) );
}

function vidiho_pro_sanitize_text_align( $value ) {
	$choices = vidiho_pro_get_text_align_choices();
	if ( array_key_exists( $value, $choices ) ) {
		return $value;
	}

	return apply_filters( 'vidiho_pro_sanitize_text_align_default', 'left' );
}

function vidiho_pro_get_image_repeat_choices() {
	return apply_filters( 'vidiho_pro_image_repeat_choices', array(
		'no-repeat' => esc_html__( 'No repeat', 'vidiho-pro' ),
		'repeat'    => esc_html__( 'Tile', 'vidiho-pro' ),
		'repeat-x'  => esc_html__( 'Tile Horizontally', 'vidiho-pro' ),
		'repeat-y'  => esc_html__( 'Tile Vertically', 'vidiho-pro' ),
	) );
}

function vidiho_pro_sanitize_image_repeat( $value ) {
	$choices = vidiho_pro_get_image_repeat_choices();
	if ( array_key_exists( $value, $choices ) ) {
		return $value;
	}

	return apply_filters( 'vidiho_pro_sanitize_image_repeat_default', 'no-repeat' );
}

function vidiho_pro_get_image_position_x_choices() {
	return apply_filters( 'vidiho_pro_image_position_x_choices', array(
		'left'   => esc_html__( 'Left', 'vidiho-pro' ),
		'center' => esc_html__( 'Center', 'vidiho-pro' ),
		'right'  => esc_html__( 'Right', 'vidiho-pro' ),
	) );
}

function vidiho_pro_sanitize_image_position_x( $value ) {
	$choices = vidiho_pro_get_image_position_x_choices();
	if ( array_key_exists( $value, $choices ) ) {
		return $value;
	}

	return apply_filters( 'vidiho_pro_sanitize_image_position_x_default', 'center' );
}

function vidiho_pro_get_image_position_y_choices() {
	return apply_filters( 'vidiho_pro_image_position_y_choices', array(
		'top'    => esc_html__( 'Top', 'vidiho-pro' ),
		'center' => esc_html__( 'Center', 'vidiho-pro' ),
		'bottom' => esc_html__( 'Bottom', 'vidiho-pro' ),
	) );
}

function vidiho_pro_sanitize_image_position_y( $value ) {
	$choices = vidiho_pro_get_image_position_y_choices();
	if ( array_key_exists( $value, $choices ) ) {
		return $value;
	}

	return apply_filters( 'vidiho_pro_sanitize_image_position_y_default', 'center' );
}

function vidiho_pro_get_image_attachment_choices() {
	return apply_filters( 'vidiho_pro_image_attachment_choices', array(
		'scroll' => esc_html__( 'Scroll', 'vidiho-pro' ),
		'fixed'  => esc_html__( 'Fixed', 'vidiho-pro' ),
	) );
}

function vidiho_pro_sanitize_image_attachment( $value ) {
	$choices = vidiho_pro_get_image_attachment_choices();
	if ( array_key_exists( $value, $choices ) ) {
		return $value;
	}

	return apply_filters( 'vidiho_pro_sanitize_image_attachment_default', 'scroll' );
}

function vidiho_pro_sanitize_rgba_color( $str, $return_hash = true, $return_fail = '' ) {
	if ( false === $str || empty( $str ) || 'false' === $str ) {
		return $return_fail;
	}

	// Allow keywords and predefined colors
	if ( in_array( $str, array( 'transparent', 'initial', 'inherit', 'black', 'silver', 'gray', 'grey', 'white', 'maroon', 'red', 'purple', 'fuchsia', 'green', 'lime', 'olive', 'yellow', 'navy', 'blue', 'teal', 'aqua', 'orange', 'aliceblue', 'antiquewhite', 'aquamarine', 'azure', 'beige', 'bisque', 'blanchedalmond', 'blueviolet', 'brown', 'burlywood', 'cadetblue', 'chartreuse', 'chocolate', 'coral', 'cornflowerblue', 'cornsilk', 'crimson', 'darkblue', 'darkcyan', 'darkgoldenrod', 'darkgray', 'darkgrey', 'darkgreen', 'darkkhaki', 'darkmagenta', 'darkolivegreen', 'darkorange', 'darkorchid', 'darkred', 'darksalmon', 'darkseagreen', 'darkslateblue', 'darkslategray', 'darkslategrey', 'darkturquoise', 'darkviolet', 'deeppink', 'deepskyblue', 'dimgray', 'dimgrey', 'dodgerblue', 'firebrick', 'floralwhite', 'forestgreen', 'gainsboro', 'ghostwhite', 'gold', 'goldenrod', 'greenyellow', 'grey', 'honeydew', 'hotpink', 'indianred', 'indigo', 'ivory', 'khaki', 'lavender', 'lavenderblush', 'lawngreen', 'lemonchiffon', 'lightblue', 'lightcoral', 'lightcyan', 'lightgoldenrodyellow', 'lightgray', 'lightgreen', 'lightgrey', 'lightpink', 'lightsalmon', 'lightseagreen', 'lightskyblue', 'lightslategray', 'lightslategrey', 'lightsteelblue', 'lightyellow', 'limegreen', 'linen', 'mediumaquamarine', 'mediumblue', 'mediumorchid', 'mediumpurple', 'mediumseagreen', 'mediumslateblue', 'mediumspringgreen', 'mediumturquoise', 'mediumvioletred', 'midnightblue', 'mintcream', 'mistyrose', 'moccasin', 'navajowhite', 'oldlace', 'olivedrab', 'orangered', 'orchid', 'palegoldenrod', 'palegreen', 'paleturquoise', 'palevioletred', 'papayawhip', 'peachpuff', 'peru', 'pink', 'plum', 'powderblue', 'rosybrown', 'royalblue', 'saddlebrown', 'salmon', 'sandybrown', 'seagreen', 'seashell', 'sienna', 'skyblue', 'slateblue', 'slategray', 'slategrey', 'snow', 'springgreen', 'steelblue', 'tan', 'thistle', 'tomato', 'turquoise', 'violet', 'wheat', 'whitesmoke', 'yellowgreen', 'rebeccapurple' ), true ) ) {
		return $str;
	}

	preg_match( '/rgba\(\s*(\d{1,3}\.?\d*\%?)\s*,\s*(\d{1,3}\.?\d*\%?)\s*,\s*(\d{1,3}\.?\d*\%?)\s*,\s*(\d{1}\.?\d*\%?)\s*\)/', $str, $rgba_matches );
	if ( ! empty( $rgba_matches ) && 5 === count( $rgba_matches ) ) {
		for ( $i = 1; $i < 4; $i++ ) {
			if ( strpos( $rgba_matches[ $i ], '%' ) !== false ) {
				$rgba_matches[ $i ] = vidiho_pro_sanitize_0_100_percent( $rgba_matches[ $i ] );
			} else {
				$rgba_matches[ $i ] = vidiho_pro_sanitize_0_255( $rgba_matches[ $i ] );
			}
		}
		$rgba_matches[4] = vidiho_pro_sanitize_0_1_opacity( $rgba_matches[ $i ] );
		return sprintf( 'rgba(%s, %s, %s, %s)', $rgba_matches[1], $rgba_matches[2], $rgba_matches[3], $rgba_matches[4] );
	}

	// Not a color function either. Let's see if it's a hex color.

	// Include the hash if not there.
	// The regex below depends on in.
	if ( substr( $str, 0, 1 ) !== '#' ) {
		$str = '#' . $str;
	}

	preg_match( '/(#)([0-9a-fA-F]{6})/', $str, $matches );

	if ( 3 === count( $matches ) ) {
		if ( $return_hash ) {
			return $matches[1] . $matches[2];
		} else {
			return $matches[2];
		}
	}

	return $return_fail;
}

function vidiho_pro_sanitize_0_100_percent( $val ) {
	$val = str_replace( '%', '', $val );
	if ( floatval( $val ) > 100 ) {
		$val = 100;
	} elseif ( floatval( $val ) < 0 ) {
		$val = 0;
	}

	return floatval( $val ) . '%';
}

function vidiho_pro_sanitize_0_255( $val ) {
	if ( intval( $val ) > 255 ) {
		$val = 255;
	} elseif ( intval( $val ) < 0 ) {
		$val = 0;
	}

	return intval( $val );
}

function vidiho_pro_sanitize_0_1_opacity( $val ) {
	if ( floatval( $val ) > 1 ) {
		$val = 1;
	} elseif ( floatval( $val ) < 0 ) {
		$val = 0;
	}

	return floatval( $val );
}

function vidiho_pro_archive_layout_choices() {
	return apply_filters( 'vidiho_pro_archive_layout_choices', array(
		/* translators: %d is a number. */
		1 => sprintf( _n( '%d column', '%d columns', 1, 'vidiho-pro' ), number_format_i18n( 1 ) ),
		/* translators: %d is a number. */
		2 => sprintf( _n( '%d column', '%d columns', 2, 'vidiho-pro' ), number_format_i18n( 2 ) ),
		/* translators: %d is a number. */
		3 => sprintf( _n( '%d column', '%d columns', 3, 'vidiho-pro' ), number_format_i18n( 3 ) ),
		/* translators: %d is a number. */
		4 => sprintf( _n( '%d column', '%d columns', 4, 'vidiho-pro' ), number_format_i18n( 4 ) ),
	) );
}

function vidiho_pro_archive_layout_default() {
	return apply_filters( 'vidiho_pro_archive_layout_default', 1 );
}

function vidiho_pro_sanitize_archive_layout( $value ) {
	$choices = vidiho_pro_archive_layout_choices();
	if ( array_key_exists( $value, $choices ) ) {
		return $value;
	}

	return vidiho_pro_archive_layout_default();
}

function vidiho_pro_header_layout_choices() {
	$choices = array(
		'right' => esc_html__( 'Left logo - Right menu', 'vidiho-pro' ),
		'split' => esc_html__( 'Centered logo - Split menu', 'vidiho-pro' ),
		'full'  => esc_html__( 'Top logo - Bottom menu', 'vidiho-pro' ),
	);

	if ( ! apply_filters( 'vidiho_pro_support_menu_2', true ) ) {
		unset( $choices['split'] );
	}

	return apply_filters( 'vidiho_pro_header_layout_choices', $choices );
}

function vidiho_pro_header_layout_default() {
	return apply_filters( 'vidiho_pro_header_layout_default', 'right' );
}

function vidiho_pro_sanitize_header_layout( $value ) {
	$choices = vidiho_pro_header_layout_choices();
	if ( array_key_exists( $value, $choices ) ) {
		return $value;
	}

	return vidiho_pro_header_layout_default();
}

function vidiho_pro_header_logo_alignment_choices() {
	return apply_filters( 'vidiho_pro_header_logo_alignment_choices', array(
		'left'   => esc_html__( 'Left', 'vidiho-pro' ),
		'center' => esc_html__( 'Center', 'vidiho-pro' ),
	) );
}

function vidiho_pro_header_logo_alignment_default() {
	return apply_filters( 'vidiho_pro_header_logo_alignment_default', 'center' );
}

function vidiho_pro_sanitize_header_logo_alignment( $value ) {
	$choices = vidiho_pro_header_logo_alignment_choices();
	if ( array_key_exists( $value, $choices ) ) {
		return $value;
	}

	return vidiho_pro_header_logo_alignment_default();
}


function vidiho_pro_footer_layout_choices() {
	return apply_filters( 'vidiho_pro_footer_layout_choices', array(
		'4-col' => esc_html__( '4 Columns', 'vidiho-pro' ),
		'3-col' => esc_html__( '3 Columns', 'vidiho-pro' ),
		'2-col' => esc_html__( '2 Columns', 'vidiho-pro' ),
		'1-col' => esc_html__( '1 Column', 'vidiho-pro' ),
		'1-3'   => esc_html__( '1/4 - 3/4 Columns', 'vidiho-pro' ),
		'3-1'   => esc_html__( '3/4 - 1/4 Columns', 'vidiho-pro' ),
		'1-1-2' => esc_html__( '1/4 - 1/4 - 1/2 Columns', 'vidiho-pro' ),
		'2-1-1' => esc_html__( '1/2 - 1/4 - 1/4 Columns', 'vidiho-pro' ),
	) );
}

function vidiho_pro_footer_layout_default() {
	return apply_filters( 'vidiho_pro_footer_layout_default', '4-col' );
}

function vidiho_pro_sanitize_footer_layout( $value ) {
	$choices = vidiho_pro_footer_layout_choices();
	if ( array_key_exists( $value, $choices ) ) {
		return $value;
	}

	return vidiho_pro_footer_layout_default();
}

/**
 * Sanitizes the pagination method option.
 *
 * @param string $option Value to sanitize. Either 'numbers' or 'text'.
 * @return string
 */
function vidiho_pro_sanitize_pagination_method( $option ) {
	if ( in_array( $option, array( 'numbers', 'text' ), true ) ) {
		return $option;
	}

	return vidiho_pro_pagination_method_default();
}

function vidiho_pro_pagination_method_default() {
	return apply_filters( 'vidiho_pro_pagination_method_default', 'numbers' );
}
