<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
	<link rel="stylesheet" href="https://use.typekit.net/bxe7ljp.css"><!-- M: Bring In TypeKit Fonts -->
</head>
<body <?php body_class(); ?>>

<div id="page">

	<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) : ?>

		<?php vidiho_pro_header(); ?>

		<div id="mobilemenu"><ul></ul></div>

	<?php endif;
