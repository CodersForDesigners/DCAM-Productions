jQuery(function ($) {
	'use strict';

	var $window = $(window);
	var $body = $('body');

	/* -----------------------------------------
	 Responsive Menus Init with mmenu
	 ----------------------------------------- */
	var $navWrap = $('.nav');
	var $navSubmenus = $navWrap.find('ul');
	var $mainNav = $('.navigation-main');
	var $mobileNav = $('#mobilemenu');

	$mainNav.each(function () {
		var $this = $(this);
		$this.clone()
			.removeAttr('id')
			.removeClass()
			.appendTo($mobileNav.find('ul'));
	});
	$mobileNav.find('li').removeAttr('id');

	$mobileNav.mmenu({
		offCanvas: {
			position: 'top',
			zposition: 'front'
		},
		autoHeight: true,
		navbars: [
			{
				position: 'top',
				content: [
					'prev',
					'title',
					'close'
				]
			}
		]
	});

	/* -----------------------------------------
	Menu classes based on available free space
	----------------------------------------- */
	function setMenuClasses() {
		if (!$navWrap.is(':visible')) {
			return;
		}

		var windowWidth = $window.width();

		$navSubmenus.each(function () {
			var $this = $(this);
			var $parent = $this.parent();
			$parent.removeClass('nav-open-left');
			var leftOffset = $this.offset().left + $this.outerWidth();

			if (leftOffset > windowWidth) {
				$parent.addClass('nav-open-left');
			}
		});
	}

	setMenuClasses();

	var resizeTimer;

	$window.on('resize', function () {
	  clearTimeout(resizeTimer);
	  resizeTimer = setTimeout(function () {
			setMenuClasses();
	  }, 350);
	});

	/* -----------------------------------------
	 Header Search Toggle
	 ----------------------------------------- */
	var $searchTrigger = $('.head-search-trigger');
	var $headSearchForm = $('.head-search-form');

	function dismissHeadSearch(e) {
		if (e) {
			e.preventDefault();
		}

		$headSearchForm.removeClass('head-search-expanded');
		$body.focus();
	}

	function displayHeadSearch(e) {
		if (e) {
			e.preventDefault();
		}

		$headSearchForm
			.addClass('head-search-expanded')
			.find('input')
			.focus();
	}

	function isHeadSearchVisible() {
		return $headSearchForm.hasClass('head-search-expanded')
	}

	$searchTrigger.on('click', displayHeadSearch);

	/* Event propagations */
	$(document).on('keydown', function (e) {
		e = e || window.e;
		if (e.keyCode === 27 && isHeadSearchVisible()) {
			dismissHeadSearch(e);
		}
	});

	$body
		.on('click', function (e) {
			if (isHeadSearchVisible()) {
				dismissHeadSearch();
			}
		})
		.find('.head-search-form, .head-search-trigger')
		.on('click', function (e) {
			e.stopPropagation();
		});

	/* -----------------------------------------
	 Responsive Videos with fitVids
	 ----------------------------------------- */
	$body.fitVids({
		ignore: '.page-hero-video-wrap',
	});

	/* -----------------------------------------
	 Grid Animations Init
	 ----------------------------------------- */
	var $itemEffectLists = $('.row-effect');

	if ($itemEffectLists.length && window.AnimOnScroll) {
		$itemEffectLists.each(function () {
			var el = $(this).get(0);

			new AnimOnScroll(el, {
				minDuration: 0.4,
				maxDuration: 0.7,
				viewportFactor: 0.2
			});
		});
	}

	/* -----------------------------------------
	 Video Backgrounds
	 ----------------------------------------- */
	var $videoBg = $('.vidiho-pro-video-background');

	// YouTube videos
	function onYouTubeAPIReady($videoBg) {
		if (typeof YT === 'undefined' || typeof YT.Player === 'undefined') {
			return setTimeout(onYouTubeAPIReady.bind(null, $videoBg), 333);
		}

		var $videoWrap = $videoBg.parents('.vidiho-pro-video-wrap');
		var $video = $videoBg.find('div').get(0);
		var ytPlayer = new YT.Player($video, {
			videoId: $videoBg.data('video-id'),
			playerVars: {
				autoplay: 1,
				controls: 0,
				showinfo: 0,
				modestbranding: 1,
				loop: 1,
				playlist: $videoBg.data('video-id'),
				fs: 0,
				cc_load_policy: 0,
				iv_load_policy: 3,
				autohide: 0
			},
			events: {
				onReady: function (event) {
					event.target.mute();
				},
				onStateChange: function (event) {
					if (event.data === YT.PlayerState.PLAYING) {
						$videoWrap.addClass('visible');
					}
				}
			}
		});
	}

	function onVimeoAPIReady($videoBg) {
		if (typeof Vimeo === 'undefined' || typeof Vimeo.Player === 'undefined') {
			return setTimeout(onVimeoAPIReady.bind(null, $videoBg), 333);
		}

		var $videoWrap = $videoBg.parents('.vidiho-pro-video-wrap');
		var player = new Vimeo.Player($videoBg, {
			id: $videoBg.data('video-id'),
			loop: true,
			autoplay: true,
			byline: false,
			title: false,
			autopause: false,
			muted: true,
		});

		player.setVolume(0);

		// Cuepoints seem to be the best way to determine
		// if the video is actually playing or not
		player.addCuePoint(.1).catch(function () {
			$videoWrap.addClass('visible');
		});

		player.on('cuepoint', function () {
			$videoWrap.addClass('visible');
		});
	}

	if ($videoBg.length && window.innerWidth > 1080) {
		$videoBg.each(function () {
			var $this = $(this);
			var firstScript = $('script');
			var videoType = $this.data('video-type');

			if (videoType === 'youtube') {
				if (!$('#youtube-api-script').length) {
					var tag = $('<script />', { id: 'youtube-api-script' });
					tag.attr('src', 'https://www.youtube.com/player_api');
					firstScript.parent().prepend(tag);
				}
				onYouTubeAPIReady($this);
			} else if (videoType === 'vimeo') {
				if (!$('#vimeo-api-script').length) {
					var tag = $('<script />', { id: 'vimeo-api-script' });
					tag.attr('src', 'https://player.vimeo.com/api/player.js');
					firstScript.parent().prepend(tag);
				}
				onVimeoAPIReady($this);
			}
		});
	}

	/* -----------------------------------------
	 Video Items
	 ----------------------------------------- */
	function isVimeo (src) {
		return src.indexOf('vimeo') > -1;
	}

	function isYoutube (src) {
		return src.indexOf('youtu') > -1;
	}

	// Hero Videos
	var $triggers = $('.page-hero-video-trigger');

	$triggers.on('click', function (event) {
		event.preventDefault();

		var $this = $(this);
		var $video = $this.parents('.page-hero-video-wrap').first();

		var iframe = $video.data('video-iframe');
		var $iframe = $( iframe );
		var source = '';

		if ( '' !== iframe ) {
			source = $iframe.attr( 'src' );
		} else {
			source = $video.data('video-src');
		}

		if ( '' !== iframe ) {
			var url = $iframe.attr( 'src' );
			if ( url.indexOf( '?' ) > - 1 ) {
				$iframe.attr( 'src', url + '&autoplay=1' );
			} else {
				$iframe.attr( 'src', url + '?autoplay=1' );
			}

			$iframe.attr( 'allow', 'autoplay; encrypted - media' );
		}

		var $nativeVideo = $('<video />', {
			class: 'ci-video',
			autoplay: true,
			src: source,
		}).on('playing', function () {
			// Add the controls when the video
			// has loaded to avoid a bad case of FOUC
			var $this = $(this);
			setTimeout(function () {
				$this.attr('controls', true);
			}, 1500);
		});

		$this.find('.video-trigger-icon').addClass('loading');

		if (isVimeo(source) || isYoutube(source)) {
			$video.append($iframe);
		} else {
			$video.append($nativeVideo);
		}
	});

	/* -----------------------------------------
	 Sticky videos
	 ----------------------------------------- */
	var $videoWrap = $('.page-hero-video-sticky');
	var $video = $('.page-hero-video-wrap');
	var videoWrapHeight = $videoWrap.outerHeight();
	var offset = 50;

	if ($videoWrap.length) {
		$window.on('scroll', function() {
			var windowScrollTop = $window.scrollTop();
			var videoBottom = videoWrapHeight + $videoWrap.offset().top;

			if (windowScrollTop > videoBottom + offset) {
				$videoWrap.css('height', videoWrapHeight);
				$video.fadeIn().addClass('stuck');
			} else {
				$videoWrap.css('height', 'auto');
				$video.removeClass('stuck');
			}
		});
	}

	/* -----------------------------------------
	 Hero Slideshow
	 ----------------------------------------- */
	var $heroSlideshow = $('.page-hero-slideshow');
	var navigation = $heroSlideshow.data('navigation');
	var effect = $heroSlideshow.data('effect');
	var speed = $heroSlideshow.data('slide-speed');
	var auto = $heroSlideshow.data('autoslide');

	if ($heroSlideshow.length) {
		var slider = $heroSlideshow.slick({
			arrows: navigation === 'arrows',
			dots: navigation === 'dots',
			fade: effect === 'fade',
			autoplaySpeed: speed,
			autoplay: auto === true,
			appendArrows: '.page-hero-content',
			prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-arrow-left"></i></button>',
			nextArrow: '<button type="button" class="slick-next"><i class="fas fa-arrow-right"></i></button>'
		});

		var $pageHero = $('.page-hero');

		// Reset video players on slide change
		slider.on('beforeChange', function (event, slick, currentSlide) {
			var $slide = slick.$slides.eq(currentSlide);
			var $iframe = $slide.find('iframe');
			var $video = $slide.find('video');
			$iframe.remove();
			$video.remove();
			$slide.find('.video-trigger-icon').removeClass('loading');
		});

		$('.slick-prev')
			.on('click', function () {
				slider.slick('slickPrev');
			})
			.on('mouseover', function () {
				$pageHero.addClass('hover-left')
			})
			.on('mouseout', function () {
				$pageHero.removeClass('hover-left')
			});

		$('.slick-next')
			.on('click', function () {
				slider.slick('slickNext');
			})
			.on('mouseover', function () {
				$pageHero.addClass('hover-right')
			})
			.on('mouseout', function () {
				$pageHero.removeClass('hover-right')
			});
	}

	/* -----------------------------------------
	 Categories Slideshow
	 ----------------------------------------- */
	function getBreakpointsFromClasses(classes) {
		return classes.split(' ').map(function (c) {
			var classData = c.split('-');
			var breakpoint;
			var slideNo;

			if (classData[1] === 'lg') {
				breakpoint = 1200;
				slideNo = 12 / parseInt(classData[2]);
			} else if (classData[1] === 'md' ) {
				breakpoint = 992;
				slideNo = 12 / parseInt(classData[2]);
			} else if (classData[1] === '6') {
				breakpoint = 768;
				slideNo = 2;
			}

			return {
				breakpoint: breakpoint,
				settings: {
					slidesToShow: slideNo,
					slidesToScroll: slideNo
				}
			}
		});
	}

	function initializeRowSliders($sliders) {
		$sliders.each(function () {
			var $this = $(this);
			var classes = $this
				.find('div[class^="col"]')
				.first()
				.attr('class');
			var slidesNo = 12 / parseInt(classes.split(' ')[0].split('-')[2]);

			$this.not('.slick-initialized').slick({
				infinite: false,
				slidesToShow: slidesNo,
				slidesToScroll: slidesNo,
				appendArrows: $this.parent().find('.row-slider-nav'),
				prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-arrow-left"></i></button>',
				nextArrow: '<button type="button" class="slick-next"><i class="fas fa-arrow-right"></i></button>',
				responsive: getBreakpointsFromClasses(classes),
			});
		});
	}

	/* -----------------------------------------
	 Elementor Init
	 ----------------------------------------- */
	$(document).on('elementor/render/latest_posts', function(e, data) {
		var $rowSliders = $(this).find('.row-slider');
		initializeRowSliders($rowSliders);
	});

	$(document).on('elementor/render/latest_videos', function(e, data) {
		var $rowSliders = $(this).find('.row-slider');
		initializeRowSliders($rowSliders);
	});

	$(document).on('elementor/render/post_type_items', function(e, data) {
		var $rowSliders = $(this).find('.row-slider');
		initializeRowSliders($rowSliders);
	});

	$window.on('load', function () {
		initializeRowSliders($('.row-slider'));

		/* -----------------------------------------
		 Isotope Grid
		 ----------------------------------------- */
		var $grid = $('.row-isotope').isotope();

		var $filters = $('.item-filter');
		$filters.on('click', function (event) {
			var $this = $(this);
			var filterValue = $this.data('filter');
			$filters.removeClass('filter-active');
			$this.addClass('filter-active');

			// Remove all grid effects which might interfere
			// with isotope's animations
			$($grid).removeClass(function (index, className) {
				return (className.match(/(^|\s)row-effect*\S+/g) || []).join(' ');
			});

			$grid.isotope({ filter: filterValue });
			event.preventDefault();
		});
	});
});
