<?php
	/**
	 * Generates CSS based on standard customizer settings.
	 *
	 * @return string
	 */
	function vidiho_pro_get_customizer_css() {
		ob_start();

		//
		// Logo
		//
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		if ( get_theme_mod( 'limit_logo_size' ) && ! empty( $custom_logo_id ) ) {
			$image_metadata = wp_get_attachment_metadata( $custom_logo_id );
			$max_width      = floor( $image_metadata['width'] / 2 );
			?>
			.header img.custom-logo {
				width: <?php echo intval( $max_width ); ?>px;
				max-width: 100%;
			}
			<?php
		}


		if ( apply_filters( 'vidiho_pro_customizable_header', true ) ) {
			//
			// Header Main Menu Bar
			//
			$header_primary_menu_padding = get_theme_mod( 'header_primary_menu_padding' );

			if ( ! empty( $header_primary_menu_padding ) ) {
				?>
				.head-mast {
					padding-top: <?php echo intval( $header_primary_menu_padding ); ?>px;
					padding-bottom: <?php echo intval( $header_primary_menu_padding ); ?>px;
				}
				<?php
			}

			$header_primary_menu_text_size = get_theme_mod( 'header_primary_menu_text_size' );

			if ( ! empty( $header_primary_menu_text_size ) ) {
				?>
				.navigation-main > li > a {
					font-size: <?php echo intval( $header_primary_menu_text_size ); ?>px;
				}
				<?php
			}

			$header_primary_menu_bg_color = get_theme_mod( 'header_primary_menu_bg_color' );

			if ( ! empty( $header_primary_menu_bg_color ) ) {
				?>
				.head-mast,
				.head-sticky.is_stuck {
					background-color: <?php echo sanitize_hex_color( $header_primary_menu_bg_color ); ?>;
				}
				<?php
			}

			$header_primary_menu_text_color = get_theme_mod( 'header_primary_menu_text_color' );

			if ( ! empty( $header_primary_menu_text_color ) ) {
				?>
				.site-logo a,
				.site-tagline,
				.navigation-main > li > a {
					color: <?php echo sanitize_hex_color( $header_primary_menu_text_color ); ?>;
				}

				.navigation-main .nav-button > a {
					border-color: <?php echo sanitize_hex_color( $header_primary_menu_text_color ); ?>;
				}
				<?php
			}

			$header_primary_menu_active_color = get_theme_mod( 'header_primary_menu_active_color' );

			if ( ! empty( $header_primary_menu_active_color ) ) {
				?>
				.navigation-main > li:hover > a,
				.navigation-main > li > a:focus,
				.navigation-main > .current-menu-item > a,
				.navigation-main > .current-menu-parent > a,
				.navigation-main > .current-menu-ancestor > a,
				.navigation-main li li:hover > a,
				.navigation-main li li > a:focus,
				.navigation-main li .current-menu-item > a,
				.navigation-main li .current-menu-parent > a,
				.navigation-main li .current-menu-ancestor > a,
				.navigation-main .nav-button > a:hover {
					color: <?php echo sanitize_hex_color( $header_primary_menu_active_color ); ?>;
				}

				.navigation-main .nav-button > a:hover {
					border-color: <?php echo sanitize_hex_color( $header_primary_menu_active_color ); ?>;
				}
				<?php
			}

			$header_primary_submenu_bg_color = get_theme_mod( 'header_primary_submenu_bg_color' );

			if ( ! empty( $header_primary_submenu_bg_color ) ) {
				?>
				.navigation-main ul {
					background-color: <?php echo sanitize_hex_color( $header_primary_submenu_bg_color ); ?>;
				}
				<?php
			}

			$header_primary_submenu_text_color = get_theme_mod( 'header_primary_submenu_text_color' );

			if ( ! empty( $header_primary_submenu_text_color ) ) {
				?>
				.navigation-main li li a {
					color: <?php echo sanitize_hex_color( $header_primary_submenu_text_color ); ?>;
				}
				<?php
			}

			$header_primary_submenu_active_text_color = get_theme_mod( 'header_primary_submenu_active_text_color' );

			if ( ! empty( $header_primary_submenu_active_text_color ) ) {
				?>
				.navigation-main li li:hover > a,
				.navigation-main li li > a:focus,
				.navigation-main li .current-menu-item > a,
				.navigation-main li .current-menu-parent > a,
				.navigation-main li .current-menu-ancestor > a {
					color: <?php echo sanitize_hex_color( $header_primary_submenu_active_text_color ); ?>;
				}
				<?php
			}
		} // filter vidiho_pro_customizable_header


		if ( apply_filters( 'vidiho_pro_customizable_footer', true ) ) {
			//
			// Footer Colors
			//
			$footer_bg_color = get_theme_mod( 'footer_bg_color' );

			if ( ! empty( $footer_bg_color ) ) {
				?>
				.footer-widgets {
					padding-top: 50px;
					background-color: <?php echo sanitize_hex_color( $footer_bg_color ); ?>;
				}
				<?php
			}

			$footer_text_color = get_theme_mod( 'footer_text_color' );

			if ( ! empty( $footer_text_color ) ) {
				?>
				.footer-widgets,
				.footer-widgets .widget,
				.footer-widgets .widget-title,
				.footer h1,
				.footer h2,
				.footer h3,
				.footer h4,
				.footer h5,
				.footer h6,
				.footer-widgets .ci-contact-widget-item i {
					color: <?php echo sanitize_hex_color( $footer_text_color ); ?>;
				}
				<?php
			}

			$footer_link_color = get_theme_mod( 'footer_link_color' );

			if ( ! empty( $footer_link_color ) ) {
				?>
				.footer-widgets a,
				.footer-widgets .widget a,
				.footer-widgets .widget a:hover {
					color: <?php echo sanitize_hex_color( $footer_link_color ); ?>;
				}
				<?php
			}

			$footer_bottom_bg_color = get_theme_mod( 'footer_bottom_bg_color' );

			if ( ! empty( $footer_bottom_bg_color ) ) {
				?>
				.footer-info {
					background-color: <?php echo sanitize_hex_color( $footer_bottom_bg_color ); ?>;
				}
				<?php
			}

			$footer_bottom_text_color = get_theme_mod( 'footer_bottom_text_color' );

			if ( ! empty( $footer_bottom_text_color ) ) {
				?>
				.footer-info {
					color: <?php echo sanitize_hex_color( $footer_bottom_text_color ); ?>;
				}
				<?php
			}

			$footer_bottom_link_color = get_theme_mod( 'footer_bottom_link_color' );

			if ( ! empty( $footer_bottom_link_color ) ) {
				?>
				.footer-info a,
				.footer-info a:hover {
					color: <?php echo sanitize_hex_color( $footer_bottom_link_color ); ?>;
				}
				<?php
			}

			$footer_titles_color = get_theme_mod( 'footer_titles_color' );

			if ( ! empty( $footer_titles_color ) ) {
				?>
				.footer .widget-title,
				.footer h1,
				.footer h2,
				.footer h3,
				.footer h4,
				.footer h5,
				.footer h6 {
					color: <?php echo sanitize_hex_color( $footer_titles_color ); ?>;
				}
				<?php
			}
		} // filter vidiho_pro_customizable_footer


		//
		// Sidebar Colors
		//
		$sidebar_bg_color = get_theme_mod( 'sidebar_bg_color' );

		if ( ! empty( $sidebar_bg_color ) ) {
			?>
			.sidebar {
				background-color: <?php echo sanitize_hex_color( $sidebar_bg_color ); ?>;
				padding: 20px;
			}
			<?php
		}

		$sidebar_text_color = get_theme_mod( 'sidebar_text_color' );

		if ( ! empty( $sidebar_text_color ) ) {
			?>
			.sidebar,
			.sidebar .widget,
			.sidebar .ci-contact-widget-item i {
				color: <?php echo sanitize_hex_color( $sidebar_text_color ); ?>;
			}
			<?php
		}

		$sidebar_link_color = get_theme_mod( 'sidebar_link_color' );

		if ( ! empty( $sidebar_link_color ) ) {
			?>
			.sidebar a,
			.sidebar .widget a {
				color: <?php echo sanitize_hex_color( $sidebar_link_color ); ?>;
			}
			<?php
		}

		$sidebar_link_hover_color = get_theme_mod( 'sidebar_link_hover_color' );

		if ( ! empty( $sidebar_link_hover_color ) ) {
			?>
			.sidebar a:hover,
			.sidebar .widget a:hover {
				color: <?php echo sanitize_hex_color( $sidebar_link_hover_color ); ?>;
			}
			<?php
		}

		$sidebar_border_color = get_theme_mod( 'sidebar_border_color' );

		if ( ! empty( $sidebar_border_color ) ) {
			?>
			.sidebar select,
			.sidebar input,
			.sidebar textarea {
				border-color: <?php echo sanitize_hex_color( $sidebar_border_color ); ?>;
			}

			.sidebar .widget_recent_comments li,
			.sidebar .widget_recent_entries li,
			.sidebar .widget_rss li,
			.sidebar .widget_meta li a,
			.sidebar .widget_pages li a,
			.sidebar .widget_categories li a,
			.sidebar .widget_archive li a,
			.sidebar .widget_nav_menu li a {
				border-bottom-color: <?php echo sanitize_hex_color( $sidebar_border_color ); ?>;
			}
			<?php
		}

		$sidebar_titles_color = get_theme_mod( 'sidebar_titles_color' );

		if ( ! empty( $sidebar_titles_color ) ) {
			?>
			.sidebar .widget-title {
				color: <?php echo sanitize_hex_color( $sidebar_titles_color ); ?>;
			}
			<?php
		}

		//
		// Button colors
		//
		$site_button_bg_color = get_theme_mod( 'site_button_bg_color' );

		if ( ! empty( $site_button_bg_color ) ) {
			?>
			.btn,
			.button,
			.comment-reply-link,
			input[type="submit"],
			input[type="reset"],
			button[type="submit"] {
				background-color: <?php echo sanitize_hex_color( $site_button_bg_color ); ?>;
			}
			<?php
		}

		$site_button_text_color = get_theme_mod( 'site_button_text_color' );

		if ( ! empty( $site_button_text_color ) ) {
			?>
			.btn,
			.button,
			.comment-reply-link,
			input[type="submit"],
			input[type="reset"],
			button[type="submit"] {
				color: <?php echo sanitize_hex_color( $site_button_text_color ); ?>;
			}
			<?php
		}

		$site_button_hover_bg_color = get_theme_mod( 'site_button_hover_bg_color' );

		if ( ! empty( $site_button_hover_bg_color ) ) {
			?>
			.btn:hover,
			.button:hover,
			.comment-reply-link:hover,
			input[type="submit"]:hover,
			input[type="reset"]:hover,
			button[type="submit"]:hover {
				background-color: <?php echo sanitize_hex_color( $site_button_hover_bg_color ); ?>;
			}
			<?php
		}

		$site_button_hover_text_color = get_theme_mod( 'site_button_hover_text_color' );

		if ( ! empty( $site_button_hover_text_color ) ) {
			?>
			.btn:hover,
			.button:hover,
			.comment-reply-link:hover,
			input[type="submit"]:hover,
			input[type="reset"]:hover,
			button[type="submit"]:hover {
				color: <?php echo sanitize_hex_color( $site_button_hover_text_color ); ?>;
			}
			<?php
		}

		$site_button_border_color = get_theme_mod( 'site_button_border_color' );

		if ( ! empty( $site_button_border_color ) ) {
			?>
			.btn,
			.button,
			.comment-reply-link,
			input[type="submit"],
			input[type="reset"],
			button[type="submit"] {
				border-color: <?php echo sanitize_hex_color( $site_button_border_color ); ?>;
			}
			<?php
		}

		//
		// Typography / Content
		//
		if ( get_theme_mod( 'content_h1_size' ) ) {
			?>
			.entry-content h1,
			.entry-title {
				font-size: <?php echo intval( get_theme_mod( 'content_h1_size' ) ); ?>px;
			}
			<?php
		}

		if ( get_theme_mod( 'content_h2_size' ) ) {
			?>
			.entry-content h2 {
				font-size: <?php echo intval( get_theme_mod( 'content_h2_size' ) ); ?>px;
			}
			<?php
		}

		if ( get_theme_mod( 'content_h3_size' ) ) {
			?>
			.entry-content h3 {
				font-size: <?php echo intval( get_theme_mod( 'content_h3_size' ) ); ?>px;
			}
			<?php
		}

		if ( get_theme_mod( 'content_h4_size' ) ) {
			?>
			.entry-content h4 {
				font-size: <?php echo intval( get_theme_mod( 'content_h4_size' ) ); ?>px;
			}
			<?php
		}

		if ( get_theme_mod( 'content_h5_size' ) ) {
			?>
			.entry-content h5 {
				font-size: <?php echo intval( get_theme_mod( 'content_h5_size' ) ); ?>px;
			}
			<?php
		}

		if ( get_theme_mod( 'content_h6_size' ) ) {
			?>
			.entry-content h6 {
				font-size: <?php echo intval( get_theme_mod( 'content_h6_size' ) ); ?>px;
			}
			<?php
		}

		if ( get_theme_mod( 'content_body_size' ) ) {
			?>
			.entry-content {
				font-size: <?php echo intval( get_theme_mod( 'content_body_size' ) ); ?>px;
			}
			<?php
		}

		//
		// Typography / Widgets
		//
		if ( get_theme_mod( 'theme_widget_text_size' ) ) {
			?>
			.sidebar .widget,
			.footer .widget,
			.widget_meta li,
			.widget_pages li,
			.widget_categories li,
			.widget_archive li,
			.widget_nav_menu li,
			.widget_recent_entries li {
				font-size: <?php echo intval( get_theme_mod( 'theme_widget_text_size' ) ); ?>px;
			}
			<?php
		}

		if ( get_theme_mod( 'theme_widget_title_size' ) ) {
			?>
			.widget-title {
				font-size: <?php echo intval( get_theme_mod( 'theme_widget_title_size' ) ); ?>px;
			}
			<?php
		}


		//
		// Global Colors
		//
		$site_accent_color = get_theme_mod( 'site_accent_color' );

		if ( ! empty( $site_accent_color ) ) {
			$site_accent_color_dark = vidiho_pro_color_luminance( $site_accent_color, -.4 );
			?>
			a,
			.entry-title a:hover,
			.sidebar .social-icon:hover,
			.footer .social-icon:hover,
			.text-theme,
			.entry-meta a:hover,
			.item-media-title a:hover,
			.navigation a:hover,
			.navigation .current,
			.widget_meta li a:hover,
			.widget_pages li a:hover,
			.widget_categories li a:hover,
			.widget_archive li a:hover,
			.widget_nav_menu li a:hover {
				color: <?php echo sanitize_hex_color( $site_accent_color ); ?>;
			}

			a:hover {
				color: <?php echo sanitize_hex_color( vidiho_pro_color_luminance( $site_accent_color, .1 ) ); ?>;
			}

			a:focus {
				outline: 1px dotted <?php echo sanitize_hex_color( $site_accent_color ); ?>;
			}

			.widget-title::after {
				background-color: <?php echo sanitize_hex_color( $site_accent_color ); ?>;
			}

			.page-hero-categories a:hover,
			.item-media-categories a:hover,
			.navigation a:hover,
			.navigation .current,
			.sidebar .social-icon:hover,
			.footer .social-icon:hover {
				border-color: <?php echo sanitize_hex_color( $site_accent_color ); ?>;
			}

			.btn:focus,
			input[type="submit"]:focus,
			button[type="submit"]:focus {
				box-shadow: 0 0 10px <?php echo sanitize_hex_color( vidiho_pro_hex2rgba( $site_accent_color, .7 ) ); ?>;
			}

			.item-vertical-link::before {
				background-image: linear-gradient(to top, <?php echo sanitize_hex_color( $site_accent_color_dark ); ?> transparent);
			}
			<?php
		}

		$site_text_color = get_theme_mod( 'site_text_color' );

		if ( ! empty( $site_text_color ) ) {
			$site_text_color_light = vidiho_pro_color_luminance( $site_text_color, 0.35 );
			?>
			body,
			.instagram-pics li a,
			.widget_meta li a,
			.widget_pages li a,
			.widget_categories li a,
			.widget_archive li a,
			.widget_nav_menu li a,
			.entry-tags a,
			.tag-cloud-link,
			.entry-title a,
			.entry-meta a,
			.entry-meta span::after,
			.item-media-title a,
			.item-media-meta a,
			.navigation a,
			.navigation .page-numbers,
			.page-links .page-number,
			.sidebar .social-icon,
			.footer-widgets .social-icon,
			.row-slider-nav .slick-arrow,
			.widget,
			.widget-title,
			.ci-contact-widget-item i,
			.ci-schedule-widget-table {
				color: <?php echo sanitize_hex_color( $site_text_color ); ?>;
			}

			blockquote,
			blockquote cite,
			.comment-metadata a,
			.section-subtitle,
			.section-subtitle a,
			.entry-meta,
			.item-media-categories a,
			.item-media-meta,
			.item-media-excerpt,
			.widget-section-newsletter-content {
				color: <?php echo sanitize_hex_color( $site_text_color_light ); ?>;
			}

			.row-slider-nav .slick-arrow {
				border-color: <?php echo sanitize_hex_color( $site_text_color ); ?>;
			}

			.navigation a,
			.navigation .page-numbers,
			.page-links .page-number,
			.entry-tags a,
			.tag-cloud-link,
			.btn-transparent,
			.sidebar .social-icon,
			.footer-widgets .social-icon {
				border-color: <?php echo sanitize_hex_color( $site_text_color_light ); ?>;
			}
			<?php
		}

		$site_border_color = get_theme_mod( 'site_border_color' );

		if ( ! empty( $site_border_color ) ) {
			?>
			blockquote,
			input,
			textarea,
			select,
			input:hover,
			textarea:hover,
			select:hover,
			input:focus,
			textarea:focus,
			select:focus,
			.no-comments,
			.widget select,
			.ci-schedule-widget-table tr,
			.widget_recent_comments li,
			.widget_rss li,
			.widget_recent_entries li,
			select,
			.entry-author-box,
			.item-media,
			.widget_meta li a,
			.widget_pages li a,
			.widget_categories li a,
			.widget_archive li a,
			.widget_nav_menu li a {
				border-color: <?php echo sanitize_hex_color( $site_border_color ); ?>;
			}
			<?php
		}

		$css = ob_get_clean();
		return apply_filters( 'vidiho_pro_customizer_css', $css );
	}

	function vidiho_pro_get_hero_styles() {
		$hero  = vidiho_pro_get_hero_data();
		$style = '';

		if ( ! $hero['show'] ) {
			return apply_filters( 'vidiho_pro_hero_styles', $style, $hero );
		}

		$styles_selector  = '.page-hero';
		$overlay_selector = '.page-hero::before';

		$support = get_theme_support( 'vidiho-pro-hero' );
		$support = $support[0];
		if ( is_page_template( 'templates/builder.php' ) && true === $support['required'] ) {
			$styles_selector  = '.header';
			$overlay_selector = '.header::before';
		}

		$styles_selector  = apply_filters( 'vidiho_pro_hero_styles_selector', $styles_selector );
		$overlay_selector = apply_filters( 'vidiho_pro_hero_styles_overlay_selector', $overlay_selector );

		if ( $hero['overlay_color'] ) {
			$style .= $overlay_selector . ' { ';
			$style .= sprintf( 'background-color: %s; ',
				$hero['overlay_color']
			);
			$style .= '} ' . PHP_EOL;
		}

		if ( $hero['bg_color'] || $hero['image'] || $hero['text_color'] ) {
			$style .= $styles_selector . ' { ';

			if ( $hero['bg_color'] ) {
				$style .= sprintf( 'background-color: %s; ',
					$hero['bg_color']
				);
			}

			if ( $hero['text_color'] ) {
				$style .= sprintf( 'color: %s; ',
					$hero['text_color']
				);
			}

			if ( ! is_page_template( array(
				'templates/front-page.php',
				'templates/front-page-elementor.php',
			) ) && $hero['image'] ) {
				$style .= sprintf( 'background-image: url(%s); ',
					$hero['image']
				);

				if ( $hero['image_repeat'] ) {
					$style .= sprintf( 'background-repeat: %s; ',
						$hero['image_repeat']
					);
				}

				if ( $hero['image_position_x'] && $hero['image_position_y'] ) {
					$style .= sprintf( 'background-position: %s %s; ',
						$hero['image_position_x'],
						$hero['image_position_y']
					);
				}

				if ( $hero['image_attachment'] ) {
					$style .= sprintf( 'background-attachment: %s; ',
						$hero['image_attachment']
					);
				}

				if ( ! $hero['image_cover'] ) {
					$style .= 'background-size: auto; ';
				}
			}

			$style .= '}' . PHP_EOL;
		}

		if ( is_page_template( array(
			'templates/front-page.php',
			'templates/front-page-elementor.php',
		) ) && $hero['bg_hover_color'] ) {

			$default_bg_color = '#132f3f';
			$left_rule        = sprintf( 'background-image: linear-gradient(to right, %1$s 50%%, %2$s 50%%);', $hero['bg_hover_color'], $default_bg_color );
			$right_rule       = sprintf( 'background-image: linear-gradient(to right, %1$s 50%%, %2$s 50%%);', $default_bg_color, $hero['bg_hover_color'] );

			if ( $hero['bg_color'] ) {
				$left_rule  = sprintf( 'background-image: linear-gradient(to right, %1$s 50%%, %2$s 50%%);', $hero['bg_hover_color'], $hero['bg_color'] );
				$right_rule = sprintf( 'background-image: linear-gradient(to right, %1$s 50%%, %2$s 50%%);', $hero['bg_color'], $hero['bg_hover_color'] );
			}

			$style .= "@media (min-width: 1170px) {
			  .page-hero.hover-left {
			    {$left_rule}
			  }
			
			  .page-hero.hover-right {
			    {$right_rule}
			  }
			}" . PHP_EOL;
		}

		return apply_filters( 'vidiho_pro_hero_styles', $style, $hero );
	}

	if ( ! function_exists( 'vidiho_pro_get_all_customizer_css' ) ) :
		function vidiho_pro_get_all_customizer_css() {
			$styles = array(
				'customizer' => vidiho_pro_get_customizer_css(),
				'hero'       => vidiho_pro_get_hero_styles(),
			);

			$styles = apply_filters( 'vidiho_pro_all_customizer_css', $styles );

			return implode( PHP_EOL, $styles );
		}
	endif;
