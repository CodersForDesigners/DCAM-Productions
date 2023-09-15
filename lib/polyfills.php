<?php





if ( ! function_exists( 'str_ends_with' ) ) {
	function str_ends_with ( string $haystack, string $needle ) {
		return ( @substr_compare( $haystack, $needle, -strlen( $needle ) ) === 0 );
	}
}

if ( ! function_exists( 'array_is_list' ) ) {
	function array_is_list ( array $array ) {
		return (
			$array === [ ]
			or array_keys( $array ) === range( 0, count( $array ) - 1 )
		);
	}
}
