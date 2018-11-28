/**
 * Base Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Base Theme Customizer preview reload changes asynchronously.
 *
 * https://developer.wordpress.org/themes/customize-api/tools-for-improved-user-experience/#using-postmessage-for-improved-setting-previewing
 */

(function ($) {
	function createStyleSheet(settingName, styles) {
		var $styleElement;

		style = '<style class="' + settingName + '">';
		style += styles.reduce(function (rules, style) {
			rules += style.selectors + '{' + style.property + ':' + style.value + ';} ';
			return rules;
		}, '');
		style += '</style>';

		$styleElement = $('.' + settingName);

		if ($styleElement.length) {
			$styleElement.replaceWith(style);
		} else {
			$('head').append(style);
		}
	}

	//
	// Site title and description.
	//
	wp.customize('blogname', function (value) {
		value.bind(function (to) {
			$('.site-logo a').text(to);
		});
	});

	wp.customize('blogdescription', function (value) {
		value.bind(function (to) {
			$('.site-tagline').text(to);
		});
	});

	//
	// Hero section
	//
	wp.customize('hero_text_color', function (value) {
		value.bind(function (to) {
			$('.page-hero').css('color', to);
		});
	});

	wp.customize('hero_image', function (value) {
		value.bind(function (to) {
			$('.page-hero').css('background-image', 'url(' + to + ')');
		});
	});

	wp.customize('hero_bg_color', function (value) {
		value.bind(function (to) {
			$('.page-hero').css('background-color', to);
		});
	});

	wp.customize('hero_image_repeat', function (value) {
		value.bind(function (to) {
			$('.page-hero').css('background-repeat', to);
		});
	});

	wp.customize('hero_image_position_x', function (value) {
		value.bind(function (to) {
			var $pageHero = $('.page-hero');
			var currentPosition = $pageHero.css('background-position');
			var newPosition = currentPosition.split(' ').map(function (pos, index) {
				return index === 0 ? to : pos;
			}).join(' ');

			$pageHero.css('background-position', newPosition);
		});
	});

	wp.customize('hero_image_position_y', function (value) {
		value.bind(function (to) {
			var $pageHero = $('.page-hero');
			var currentPosition = $pageHero.css('background-position');
			var newPosition = currentPosition.split(' ').map(function (pos, index) {
				return index === 1 ? to : pos;
			}).join(' ');

			$pageHero.css('background-position', newPosition);
		});
	});

	wp.customize('hero_image_attachment', function (value) {
		value.bind(function (to) {
			$('.page-hero').css('background-attachment', to);
		});
	});

	wp.customize('hero_image_cover', function (value) {
		value.bind(function (to) {
			if (!to) {
				$('.page-hero').css('background-size', 'auto');
			} else {
				$('.page-hero').css('background-size', 'cover');
			}
		});
	});

	//
	// Header Main Menu Bar
	//
	wp.customize('header_primary_menu_padding', function (value) {
		value.bind(function (to) {
			$('.head-mast').css({
				paddingTop: to + 'px',
				paddingBottom: to + 'px'
			});
		});
	});

	wp.customize('header_primary_menu_text_size', function (value) {
		value.bind(function (to) {
			$('.navigation-main > li > a').css('.navigation-main > li > a', to + 'px');
		});
	});

	wp.customize('header_primary_menu_bg_color', function (value) {
		value.bind(function (to) {
			$('.head-mast, .head-sticky.is_stuck').css('background-color', to);
		});
	});

	wp.customize('header_primary_menu_text_color', function (value) {
		value.bind(function (to) {
			$('.site-logo a, ' +
				'.site-tagline,' +
				'.navigation-main > li > a').css('color', to);

			$('.navigation-main .nav-button > a').css('border-color', to);
		});
	});

	wp.customize('header_primary_menu_active_color', function (value) {
		value.bind(function (to) {
			$('.navigation-main > .current-menu-item > a,' +
				'.navigation-main > .current-menu-parent > a,' +
				'.navigation-main > .current-menu-ancestor > a').css('color', to);
		});
	});

	wp.customize('header_primary_submenu_bg_color', function (value) {
		value.bind(function (to) {
			$('.navigation-main ul').css('background-color', to);
		});
	});

	wp.customize('header_primary_submenu_text_color', function (value) {
		value.bind(function (to) {
			$('.navigation-main li li a').css('color', to);
		});
	});

	wp.customize('header_primary_submenu_active_text_color', function (value) {
		value.bind(function (to) {
			$('.navigation-main li .current-menu-item > a,' +
				'.navigation-main li .current-menu-parent > a,' +
				'.navigation-main li .current-menu-ancestor > a').css('color', to);
		});
	});

	wp.customize('theme_header_primary_menu_sticky', function (value) {
		wp.customize.selectiveRefresh.bind('partial-content-rendered', function (placement) {
			$('.head-sticky').css({
				position: 'fixed',
				zIndex: 99,
			});
		});
	});

	//
	// Footer Colors
	//
	wp.customize('footer_bg_color', function (value) {
		value.bind(function (to) {
			$('.footer-widgets').css({
				'padding-top': '50px',
				'background-color': to,
			});
		});
	});

	wp.customize('footer_text_color', function (value) {
		value.bind(function (to) {
			$('.footer-widgets,' +
				'.footer-widgets .widget,' +
				'.footer-widgets .widget-title,' +
				'.footer h1,.footer h2,.footer h3,' +
				'.footer h4,.footer h5,.footer h6,' +
				'.footer-widgets .ci-contact-widget-item i').css('color', to);
		});
	});

	wp.customize('footer_link_color', function (value) {
		value.bind(function (to) {
			$('.footer-widgets a,' +
				'.footer-widgets .widget a').css('color', to);
		});
	});

	wp.customize('footer_bottom_bg_color', function (value) {
		value.bind(function (to) {
			$('.footer-info').css('background-color', to);
		});
	});

	wp.customize('footer_bottom_text_color', function (value) {
		value.bind(function (to) {
			$('.footer-info').css('color', to);
		});
	});

	wp.customize('footer_bottom_link_color', function (value) {
		value.bind(function (to) {
			$('.footer-info a').css('color', to);
		});
	});

	wp.customize('footer_titles_color', function (value) {
		value.bind(function (to) {
			$('.footer .widget-title, .footer h1,.footer h2, ' +
				'.footer h3, .footer h4, .footer h5, .footer h6').css('color', to);
		});
	});

	//
	// Sidebar Colors
	//
	wp.customize('sidebar_bg_color', function (value) {
		value.bind(function (to) {
			$('.sidebar').css({
				backgroundColor: to,
				padding: '20px',
			});
		});
	});

	wp.customize('sidebar_text_color', function (value) {
		value.bind(function (to) {
			$('.sidebar,' +
				'.sidebar .widget,' +
				'.sidebar .ci-contact-widget-item i').css('color', to);
		});
	});

	wp.customize('sidebar_link_color', function (value) {
		value.bind(function (to) {
			$('.sidebar a, .sidebar .widget a').css('color', to);
		});
	});

	wp.customize('sidebar_border_color', function (value) {
		value.bind(function (to) {
			$('.sidebar select, .sidebar input, .sidebar textarea').css('border-color', to);

			$('.sidebar .widget_recent_comments li,' +
				'.sidebar .widget_recent_entries li,' +
				'.sidebar .widget_rss li,' +
				'.sidebar .widget_meta li a,' +
				'.sidebar .widget_pages li a,' +
				'.sidebar .widget_categories li a,' +
				'.sidebar .widget_archive li a,' +
				'.sidebar .widget_nav_menu li a').css('border-bottom-color', to);
		});
	});

	wp.customize('sidebar_titles_color', function (value) {
		value.bind(function (to) {
			$('.sidebar .widget-title').css('color', to);
		});
	});

	//
	// Button colors
	//
	wp.customize('site_button_bg_color', function (value) {
		value.bind(function (to) {
			$('.btn,' +
				'.button,' +
				'.comment-reply-link,' +
				'input[type="submit"],' +
				'input[type="reset"],' +
				'button[type="submit"]').css('background-color', to);
		});
	});

	wp.customize('site_button_text_color', function (value) {
		value.bind(function (to) {
			$('.btn,' +
				'.button,' +
				'.comment-reply-link,' +
				'input[type="submit"],' +
				'input[type="reset"],' +
				'button[type="submit"]').css('color', to);
		});
	});

	wp.customize('site_button_hover_bg_color', function (value) {
		value.bind(function (to) {
			var style = '<style class="site_button_hover_bg_color">' +
				'.btn:hover,' +
				'.button:hover,' +
				'.comment-reply-link:hover,' +
				'input[type="submit"]:hover,' +
				'input[type="reset"]:hover,' +
				'button[type="submit"]:hover' +
				'{ background-color: ' + to + ' !important; }</style>';

			var $el = $('.site_button_hover_bg_color');

			if ($el.length) {
				$el.replaceWith(style);
			} else {
				$('head').append(style);
			}
		});
	});

	wp.customize('site_button_hover_text_color', function (value) {
		value.bind(function (to) {
			var style = '<style class="site_button_hover_text_color">' +
				'.btn:hover,' +
				'.button:hover,' +
				'.comment-reply-link:hover,' +
				'input[type="submit"]:hover,' +
				'input[type="reset"]:hover,' +
				'button[type="submit"]:hover' +
				'{ color: ' + to + ' !important; }</style>';

			var $el = $('.site_button_hover_bg_color');

			if ($el.length) {
				$el.replaceWith(style);
			} else {
				$('head').append(style);
			}
		});
	});

	wp.customize('site_button_border_color', function (value) {
		value.bind(function (to) {
			$('.btn,' +
				'.button,' +
				'.comment-reply-link,' +
				'input[type="submit"],' +
				'input[type="reset"],' +
				'button[type="submit"]')
				.not('.customize-partial-edit-shortcut-button')
				.css('border-color', to);
		});
	});

	//
	// Typography / Content
	//
	wp.customize('content_h1_size', function (value) {
		value.bind(function (to) {
			$('.entry-content h1, .entry-title').css('font-size', to + 'px');
		});
	});

	wp.customize('content_h2_size', function (value) {
		value.bind(function (to) {
			$('.entry-content h2').css('font-size', to + 'px');
		});
	});

	wp.customize('content_h3_size', function (value) {
		value.bind(function (to) {
			$('.entry-content h3').css('font-size', to + 'px');
		});
	});

	wp.customize('content_h4_size', function (value) {
		value.bind(function (to) {
			$('.entry-content h4').css('font-size', to + 'px');
		});
	});

	wp.customize('content_h5_size', function (value) {
		value.bind(function (to) {
			$('.entry-content h5').css('font-size', to + 'px');
		});
	});

	wp.customize('content_h6_size', function (value) {
		value.bind(function (to) {
			$('.entry-content h6').css('font-size', to + 'px');
		});
	});

	wp.customize('content_body_size', function (value) {
		value.bind(function (to) {
			$('.entry-content').css('font-size', to + 'px');
		});
	});

	//
	// Typography / Widgets
	//
	wp.customize('theme_widget_text_size', function (value) {
		value.bind(function (to) {
			$('.sidebar .widget,' +
				'.footer .widget,' +
				'.widget_meta li,' +
				'.widget_pages li,' +
				'.widget_categories li,' +
				'.widget_archive li,' +
				'.widget_nav_menu li,' +
				'.widget_recent_entries li').css('font-size', to + 'px');
		});
	});

	wp.customize('theme_widget_title_size', function (value) {
		value.bind(function (to) {
			$('.widget-title').css('font-size', to + 'px');
		});
	});

	wp.customize('theme_lightbox', function (value) {
		value.bind(function (to) {
			if (to) {
				$(".vidiho-pro-lightbox, a[data-lightbox^='gal']").magnificPopup({
					type: 'image',
					mainClass: 'mfp-with-zoom',
					gallery: {
						enabled: true
					},
					zoom: {
						enabled: true
					}
				});
			} else {
				$(".vidiho-pro-lightbox, a[data-lightbox^='gal']").off('click');
			}
		});
	});


	//
	// Theme global colors
	//
	wp.customize('site_accent_color', function (value) {
		value.bind(function (to) {
			createStyleSheet('site_accent_color', [
				{
					property: 'color',
					value: to,
					selectors: 'a,' +
					'.entry-title a:hover,' +
					'.social-icon:hover,' +
					'.text-theme,' +
					'.entry-meta a:hover,' +
					'.item-media-title a:hover,' +
					'.navigation a:hover,' +
					'.navigation .current,' +
					'.widget_meta li a:hover,' +
					'.widget_pages li a:hover,' +
					'.widget_categories li a:hover,' +
					'.widget_archive li a:hover,' +
					'.widget_nav_menu li a:hover,' +
					'a:hover',
				},
				{
					property: 'background-color',
					value: to,
					selectors: '.widget-title::after',
				},
				{
					property: 'border-color',
					value: to,
					selectors: '.page-hero-categories a:hover,' +
					'.item-media-categories a:hover,' +
					'.navigation a:hover,' +
					'.navigation .current',
				},
				{
					property: 'background-image',
					value: 'linear-gradient(to top, ' + to + ' transparent)',
					selectors: '.item-vertical-link::before',
				},
				{
					property: 'box-shadow',
					value: '0 0 10px ' + to,
					selectors: '.btn:focus,' +
					'input[type="submit"]:focus,' +
					'button[type="submit"]:focus',
				},
			]);
		});
	});

	wp.customize('site_text_color', function (value) {
		value.bind(function (to) {
			createStyleSheet('site_text_color', [
				{
					property: 'color',
					value: to,
					selectors: 'body,' +
					'.instagram-pics li a,' +
					'.widget_meta li a,' +
					'.widget_pages li a,' +
					'.widget_categories li a,' +
					'.widget_archive li a,' +
					'.widget_nav_menu li a,' +
					'.entry-tags a,' +
					'.tag-cloud-link,' +
					'.entry-title a,' +
					'.entry-meta a,' +
					'.entry-meta span::after,' +
					'.item-media-title a,' +
					'.item-media-meta a,' +
					'.navigation a,' +
					'.navigation .page-numbers,' +
					'.page-links .page-number,' +
					'.sidebar .social-icon,' +
					'.footer-widgets .social-icon,' +
					'.row-slider-nav .slick-arrow,' +
					'.widget,' +
					'.widget-title,' +
					'.ci-contact-widget-item i,' +
					'.ci-schedule-widget-table,' +
					'blockquote,' +
					'blockquote cite,' +
					'.comment-metadata a,' +
					'.section-subtitle,' +
					'.section-subtitle a,' +
					'.entry-meta,' +
					'.item-media-categories a,' +
					'.item-media-meta,' +
					'.item-media-excerpt,' +
					'.widget-section-newsletter-content',
				},
				{
					property: 'border-color',
					value: to,
					selectors: '.navigation a,' +
					'.navigation .page-numbers,' +
					'.page-links .page-number,' +
					'.entry-tags a,' +
					'.tag-cloud-link,' +
					'.btn-transparent,' +
					'.sidebar .social-icon,' +
					'.footer-widgets .social-icon,' +
					'.row-slider-nav .slick-arrow',
				},
			]);
		});
	});

	wp.customize('site_border_color', function (value) {
		value.bind(function (to) {
			createStyleSheet('site_border_color', [
				{
					property: 'border-color',
					value: to,
					selectors: 'blockquote,' +
					'input,' +
					'textarea,' +
					'select,' +
					'input:hover,' +
					'textarea:hover,' +
					'select:hover,' +
					'input:focus,' +
					'textarea:focus,' +
					'select:focus,' +
					'.no-comments,' +
					'.widget select,' +
					'.ci-schedule-widget-table tr,' +
					'.widget_recent_comments li,' +
					'.widget_rss li,' +
					'.widget_recent_entries li,' +
					'select,' +
					'.entry-author-box,' +
					'.item-media,' +
					'.widget_meta li a,' +
					'.widget_pages li a,' +
					'.widget_categories li a,' +
					'.widget_archive li a,' +
					'.widget_nav_menu li a'
				}
			]);
		});
	});
})(jQuery);
