<?php

namespace ThisProject\Mailing;

require_once THEME_PATH . '/lib/polyfills.php';
require_once THEME_PATH . '/lib/templating.php';

use ThisProject\Templating;

/**
 |
 | Shoots out an e-mail
 |
 |
 */
function send ( $to, $subject, $templateOrContents = '', $context = [ ] ) {
	$body = null;
	if (
		str_ends_with( $templateOrContents, ".php" )
		and ( is_array( $context ) and !array_is_list( $context ) )
	) {
		$body = Templating\render( $templateOrContents, $context );
	}
	else {
		$body = $templateOrContents;
	}

	return wp_mail(
		$to,
		$subject,
		$body,
		[ 'Content-Type: text/html; charset=UTF-8' ]
			// ^ email headers
	);
}
