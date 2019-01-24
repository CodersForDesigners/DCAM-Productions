<?php

/*
 * Analytics and Tracking Code
 */
add_action( 'wp_head', function () {
	?>

		<!-- Google Site Verification -->
		<meta name="google-site-verification" content="ahJnQ8d_fmOtmfxLC1VbW-GfHfVC4GqFd5W252bj55M" />

		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-53BHH8G');</script>
		<!-- End Google Tag Manager -->

	<?php

	/*
	 *
	 * Favicons
	 *
	 */
	$iconsDirectory = str_replace( ABSPATH, '', get_template_directory() ) . '/favicons';
	?>
		<link rel="apple-touch-icon" sizes="57x57" href="<?php echo $iconsDirectory ?>/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="<?php echo $iconsDirectory ?>/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $iconsDirectory ?>/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $iconsDirectory ?>/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $iconsDirectory ?>/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo $iconsDirectory ?>/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $iconsDirectory ?>/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo $iconsDirectory ?>/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $iconsDirectory ?>/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo $iconsDirectory ?>/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $iconsDirectory ?>/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="<?php echo $iconsDirectory ?>/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $iconsDirectory ?>/favicon-16x16.png">
		<link rel="manifest" href="<?php echo $iconsDirectory ?>/manifest.json">
	<?php

} );
add_action( 'wp_footer', function () {
	?>

		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-53BHH8G" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->

	<?php
} );

function queue_lazaro_files () {

}

function register_lazaro_files () {

	$theme = wp_get_theme();

	// Utility functions
	wp_register_script(
		'lazaro-util-scripts',	// slug identifier
		get_template_directory_uri() . '/js/utils.js',
		[ 'jquery' ],	// queue it after jQuery
		$theme->get( 'Version' ),
		true	// queue it in the footer
	);

	// The Spreadsheet Formula Calculator library, i.e. XLSX Calc
	wp_register_script(
		'lazaro-xlsx-calc',	// slug identifier
		get_template_directory_uri() . '/js/xlsx-calc-v0.4.1.js',
		[ ],	// does not depend on any other library
		$theme->get( 'Version' ),
		true	// queue it in the footer
	);

	// Our custom spreadsheet formulae implementations
	wp_register_script(
		'lazaro-spreadsheet-formulae',	// slug identifier
		get_template_directory_uri() . '/js/spreadsheet-formulae.js',
		[ ],	// does not depend on any other library
		$theme->get( 'Version' ),
		true	// queue it in the footer
	);

}

add_action( 'init', 'register_lazaro_files' );
add_action( 'wp_enqueue_scripts', 'queue_lazaro_files' );
