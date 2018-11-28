<?php
/**
 * Custom template tags for this theme
 */

add_action( 'vidiho_pro_head_mast', 'vidiho_pro_header_right', 10 );
add_action( 'vidiho_pro_head_mast', 'vidiho_pro_header_split', 20 );
add_action( 'vidiho_pro_head_mast', 'vidiho_pro_header_full', 30 );

add_action( 'vidiho_pro_head_intro_info', 'vidiho_pro_head_intro_info_text', 10 );

add_action( 'vidiho_pro_head_intro_addons', 'vidiho_pro_head_intro_addons_social', 10 );
add_action( 'vidiho_pro_head_intro_addons', 'vidiho_pro_head_intro_addons_lang_select', 20 );
add_action( 'vidiho_pro_head_intro_addons', 'vidiho_pro_head_intro_addons_search', 30 );

add_action( 'vidiho_pro_the_post_header', 'vidiho_pro_the_post_entry_meta', 10 );
add_action( 'vidiho_pro_the_post_header', 'vidiho_pro_the_post_entry_title', 20 );

add_action( 'vidiho_pro_the_post_entry_meta', 'vidiho_pro_the_post_entry_sticky_label', 10 );
add_action( 'vidiho_pro_the_post_entry_meta', 'vidiho_pro_the_post_entry_date', 20 );
add_action( 'vidiho_pro_the_post_entry_meta', 'vidiho_pro_the_post_entry_categories', 30 );
add_action( 'vidiho_pro_the_post_entry_meta', 'vidiho_pro_the_post_entry_author', 40 );
add_action( 'vidiho_pro_the_post_entry_meta', 'vidiho_pro_the_post_entry_comments_link', 50 );

function vidiho_pro_header() {
	do_action( 'vidiho_pro_before_header' );

	?>
	<header class="<?php vidiho_pro_the_header_classes(); ?>">

		<?php do_action( 'vidiho_pro_before_head_mast' ); ?>

		<div class="container">
			<div class="row">
				<div class="col-12">

					<div class="head-mast">
						<div class="row align-items-center">
							<?php
								/**
								 * vidiho_pro_head_mast hook.
								 *
								 * @hooked vidiho_pro_header_right - 10
								 * @hooked vidiho_pro_header_split - 20
								 * @hooked vidiho_pro_header_full - 30
								 */
								do_action( 'vidiho_pro_head_mast', get_theme_mod( 'header_layout', vidiho_pro_header_layout_default() ) );
							?>
						</div>
					</div>

				</div>
			</div>
		</div>

		<?php do_action( 'vidiho_pro_after_head_mast' ); ?>

	</header>
	<?php

	do_action( 'vidiho_pro_after_header' );
}

function vidiho_pro_head_intro_info_text() {
	if ( get_theme_mod( 'header_top_bar_text_1' ) ) {
		?><span><?php echo wp_kses_post( get_theme_mod( 'header_top_bar_text_1' ) ); ?></span><?php
	}

	if ( get_theme_mod( 'header_top_bar_text_2' ) ) {
		?><span><?php echo wp_kses_post( get_theme_mod( 'header_top_bar_text_2' ) ); ?></span><?php
	}
}

function vidiho_pro_head_intro_addons_social() {
	if ( get_theme_mod( 'theme_header_top_bar_show_social_icons', 1 ) ) {
		vidiho_pro_the_social_icons();
	}
}

function vidiho_pro_head_intro_addons_search() {
	if ( get_theme_mod( 'theme_header_top_bar_show_search', 1 ) ) {
		?>
		<div class="head-search">
			<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="head-search-form">
				<label for="head-search-input" class="sr-only"><?php esc_html_e( 'Search for:', 'vidiho-pro' ); ?></label>
				<input type="search" name="s" id="head-search-input" class="head-search-input" placeholder="<?php esc_attr_e( 'Type and hit enter to search', 'vidiho-pro' ); ?>">
			</form>
			<a href="#" class="head-search-trigger">
				<i class="fas fa-search"></i>
			</a>
		</div>
		<?php
	}
}

function vidiho_pro_head_intro_addons_lang_select() {
	if ( class_exists( 'SitePress' ) && get_theme_mod( 'theme_header_top_bar_show_lang_select', 1 ) ) {
		$languages = apply_filters( 'wpml_active_languages', null, apply_filters( 'vidiho_pro_head_intro_addons_lang_select_args', array(
			'skip_missing'  => 0,
			'link_empty_to' => '',
			'orderby'       => 'custom',
			'order'         => 'asc',
		) ) );

		$current_lang_code = apply_filters( 'wpml_current_language', null );
		$current_lang = $languages[ $current_lang_code ];
		unset( $languages[ $current_lang_code ] );

		if ( ! empty( $languages ) ) {
			?>
			<div class="head-language-selector">
				<div class="head-language-dropdown">
					<a href="<?php echo esc_url( $current_lang['url'] ); ?>" class="head-language-dropdown-trigger">
						<?php echo esc_html( $current_lang['native_name'] ); ?>
					</a>

					<ul class="head-language-dropdown-options">
						<?php foreach ( $languages as $lang ) : ?>
							<li><a href="<?php echo esc_url( $lang['url'] ); ?>"><?php echo esc_html( $lang['native_name'] ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<?php
		}
	}
}

function vidiho_pro_footer() {
	$sidebars           = array( 'footer-1', 'footer-2', 'footer-3', 'footer-4' );
	$classes            = vidiho_pro_footer_widget_area_classes( get_theme_mod( 'footer_layout', vidiho_pro_footer_layout_default() ) );
	$has_active_sidebar = false;
	foreach ( $sidebars as $sidebar ) {
		if ( is_active_sidebar( $sidebar ) && $classes[ $sidebar ]['active'] ) {
			$has_active_sidebar = true;
			break;
		}
	}

	do_action( 'vidiho_pro_before_footer' );

	?>
	<footer class="<?php vidiho_pro_the_footer_classes(); ?>">
		<?php if ( $has_active_sidebar ) : ?>
			<div class="footer-widgets">
				<div class="container">
					<div class="row">
						<?php foreach ( $sidebars as $sidebar ) : ?>
							<?php if ( $classes[ $sidebar ]['active'] ) : ?>
								<div class="<?php echo esc_attr( $classes[ $sidebar ]['class'] ); ?>">
									<?php dynamic_sidebar( $sidebar ); ?>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php vidiho_pro_footer_bottom_bar(); ?>
	</footer>
	<?php

	do_action( 'vidiho_pro_after_footer' );
}

function vidiho_pro_footer_bottom_bar() {
	if ( ! get_theme_mod( 'footer_show_bottom_bar', 1 ) ) {
		return;
	}

	do_action( 'vidiho_pro_before_footer_info' );

	?>
	<div class="footer-info">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6 col-12">
					<?php $credits = get_theme_mod( 'footer_text', vidiho_pro_get_default_footer_text() ); ?>
					<?php if ( $credits || is_customize_preview() ) : ?>
						<p class="footer-copy text-lg-left text-center"><?php echo vidiho_pro_sanitize_footer_text( $credits ); ?></p>
					<?php endif; ?>
				</div>
				<?php
//					if ( get_theme_support( 'vidiho-pro-footer-text-right' ) ) {
//						var_dump( get_theme_mod( 'footer_text_right', vidiho_pro_get_default_footer_text( 'right' ) ) );
//					}
				?>

				<div class="col-lg-6 col-12">
					<?php if ( get_theme_mod( 'footer_show_social_icons', 1 ) ) : ?>
						<div class="footer-info-addons text-lg-right text-center">
							<?php vidiho_pro_the_social_icons(); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php

	do_action( 'vidiho_pro_after_footer_info' );

}

function vidiho_pro_get_default_footer_text( $position = 'left' ) {
	if ( 'right' === $position && get_theme_support( 'vidiho-pro-footer-text-right' ) ) {
		$text = sprintf( __( 'Powered by <a href="%s">WordPress</a>', 'vidiho-pro' ),
			esc_url( 'https://wordpress.org/' )
		);
	} else {
		if ( ! defined( 'VIDIHO_PRO_WHITELABEL' ) || ! VIDIHO_PRO_WHITELABEL ) {
			$text = sprintf( __( 'A theme by <a href="%s">CSSIgniter</a>', 'vidiho-pro' ),
				esc_url( 'https://www.cssigniter.com/' )
			);
		} else {
			$text = sprintf( __( '<a href="%1$s">%2$s</a>', 'vidiho-pro' ),
				esc_url( home_url( '/' ) ),
				get_bloginfo( 'name' )
			);
		}
	}

	return apply_filters( 'vidiho_pro_default_footer_text', $text, $position );
}

function vidiho_pro_sanitize_footer_text( $text ) {
	return wp_kses( $text, vidiho_pro_get_allowed_tags( 'guide' ) );
}


function vidiho_pro_header_right( $layout ) {
	if ( 'right' !== $layout ) {
		return;
	}
	?>
	<div class="col-lg-3 col-md-6 col-8">
		<?php vidiho_pro_the_site_identity(); ?>
	</div>

	<div class="col-lg-9 col-md-6 col-4">
		<nav class="nav">
			<?php
				ob_start();
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'container'      => '',
					'menu_id'        => 'header-menu-1',
					'menu_class'     => 'navigation-main navigation-main-right',
				) );
				$menu = trim( ob_get_flush() );
			?>
		</nav>
		<?php if ( ! empty( $menu ) ) : ?>
			<a href="#mobilemenu" class="mobile-nav-trigger"><i class="fas fa-bars"></i> <?php esc_html_e( 'Menu', 'vidiho-pro' ); ?></a>
		<?php endif; ?>
	</div>
	<?php
}

function vidiho_pro_header_split( $layout ) {
	if ( 'split' !== $layout || ! apply_filters( 'vidiho_pro_support_menu_2', true ) ) {
		return;
	}

	?>
	<div class="col-lg-5 col-12 hidden-md-down">
		<nav class="nav">
			<?php wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'container'      => '',
				'menu_id'        => 'header-menu-1',
				'menu_class'     => 'navigation-main',
			) ); ?>
		</nav>
	</div>

	<div class="col-lg-2 col-md-6 col-8 text-lg-center">
		<?php vidiho_pro_the_site_identity(); ?>
	</div>

	<div class="col-lg-5 col-md-6 col-4">
		<nav class="nav">
			<?php wp_nav_menu( array(
				'theme_location' => 'menu-2',
				'container'      => '',
				'menu_id'        => 'header-menu-2',
				'menu_class'     => 'navigation-main navigation-main-right',
			) ); ?>
		</nav>
		<a href="#mobilemenu" class="mobile-nav-trigger"><i class="fas fa-bars"></i> <?php esc_html_e( 'Menu', 'vidiho-pro' ); ?></a>
	</div>
	<?php
}

function vidiho_pro_header_full( $layout ) {
	if ( 'full' !== $layout ) {
		return;
	}

	$classes = '';
	$align   = get_theme_mod( 'header_logo_alignment', vidiho_pro_header_logo_alignment_default() );
	if ( 'center' === $align ) {
		$classes = 'text-lg-center';
	}

	?>
	<div class="col-lg-12 col-md-6 col-8 <?php echo esc_attr( $classes ); ?>">
		<?php vidiho_pro_the_site_identity(); ?>
	</div>

	<div class="col-lg-12 col-md-6 col-4 <?php echo esc_attr( $classes ); ?>">
		<nav class="nav">
			<?php wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'container'      => '',
				'menu_id'        => 'header-menu-1',
				'menu_class'     => 'navigation-main',
			) ); ?>
		</nav>
		<a href="#mobilemenu" class="mobile-nav-trigger"><i class="fas fa-bars"></i> <?php esc_html_e( 'Menu', 'vidiho-pro' ); ?></a>
	</div>
	<?php
}



/**
 * Echoes the logo / site title / description, depending on customizer options.
 */
function vidiho_pro_the_site_identity() {
	do_action( 'vidiho_pro_before_site_identity' );

	?><div class="site-branding"><?php

	if ( has_custom_logo() && get_theme_mod( 'show_site_title', 1 ) ) {
		the_custom_logo();

		?><h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1><?php
	} elseif ( has_custom_logo() ) {
		?><h1 class="site-logo"><?php the_custom_logo(); ?></h1><?php
	} elseif ( get_theme_mod( 'show_site_title', 1 ) ) {
		?><h1 class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1><?php
	}

	if ( get_theme_mod( 'show_site_description', 1 ) ) {
		$description = get_bloginfo( 'description', 'display' );
		if ( $description || is_customize_preview() ) {
			?><p class="site-tagline"><?php echo $description; /* WPCS: xss ok. */ ?></p><?php
		}
	}

	?></div><?php

	do_action( 'vidiho_pro_after_site_identity' );
}

/**
 * Echoes header classes based on customizer options
 */
function vidiho_pro_the_header_classes() {
	$classes = apply_filters( 'vidiho_pro_header_classes', array(
		'header',
		get_theme_mod( 'header_fullwidth' ) ? 'header-fullwidth' : '',
		get_theme_mod( 'theme_header_primary_menu_sticky' ) ? 'head-sticky' : '',
	) );

	$classes = array_filter( $classes );

	echo esc_attr( implode( ' ', $classes ) );
}

/**
 * Echoes header classes based on customizer options
 */
function vidiho_pro_the_footer_classes() {
	$classes = apply_filters( 'vidiho_pro_footer_classes', array(
		'footer',
		get_theme_mod( 'footer_fullwidth' ) ? 'footer-fullwidth' : '',
	) );

	$classes = array_filter( $classes );

	echo esc_attr( implode( ' ', $classes ) );
}

function vidiho_pro_the_post_thumbnail( $size = false ) {
	if ( ! $size ) {
		$size = 'post-thumbnail';
	}

	if ( ! has_post_thumbnail() ) {
		return;
	}

	if (
		( is_singular( 'post' ) && ! get_theme_mod( 'post_show_featured', 1 ) )
		||
		( is_singular( 'vidiho_pro_video' ) && ! get_theme_mod( 'video_show_featured', 1 ) )
	) {
		return;
	}

	do_action( 'vidiho_pro_before_the_post_thumbnail' );

	if ( is_singular() && get_the_ID() === get_queried_object_id() ) {
		$caption = vidiho_pro_get_image_lightbox_caption( get_post_thumbnail_id() );
		?>
		<figure class="entry-thumb">
			<a class="vidiho-pro-lightbox" href="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'large' ) ); ?>" title="<?php echo esc_attr( $caption ); ?>">
				<?php the_post_thumbnail( $size ); ?>
			</a>
		</figure>
		<?php
	} else {
		?>
		<figure class="entry-thumb">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( $size ); ?>
			</a>
		</figure>
		<?php
	}

	do_action( 'vidiho_pro_after_the_post_thumbnail' );
}

function vidiho_pro_the_post_header() {
	ob_start();

	/**
	 * vidiho_pro_the_post_header hook.
	 *
	 * @hooked vidiho_pro_the_post_entry_meta - 10
	 * @hooked vidiho_pro_the_post_entry_title - 20
	 */
	do_action( 'vidiho_pro_the_post_header' );

	$html = ob_get_clean();

	if ( trim( $html ) ) {
		$html = sprintf( '<header class="entry-header">%s</header>', $html );
	}

	do_action( 'vidiho_pro_before_the_post_header', $html );

	echo $html; // WPCS: XSS ok.

	do_action( 'vidiho_pro_after_the_post_header', $html );
}

function vidiho_pro_the_post_entry_title() {
	if ( is_singular() && get_the_ID() === get_queried_object_id() ) {
		$hero = vidiho_pro_get_hero_data();

		if ( ! $hero['page_title_hide'] ) {
			?>
			<h1 class="entry-title">
				<?php the_title(); ?>
			</h1>
			<?php
		}
	} else {
		?>
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h1>
		<?php
	}
}

function vidiho_pro_the_post_entry_meta() {
	ob_start();

	/**
	 * vidiho_pro_the_post_entry_meta hook.
	 *
	 * @hooked vidiho_pro_the_post_entry_sticky_label - 10
	 * @hooked vidiho_pro_the_post_entry_date - 20
	 * @hooked vidiho_pro_the_post_entry_categories - 30
	 * @hooked vidiho_pro_the_post_entry_author - 40
	 * @hooked vidiho_pro_the_post_entry_comments_link - 50
	 */
	do_action( 'vidiho_pro_the_post_entry_meta' );

	$html = ob_get_clean();

	if ( trim( $html ) ) {
		$html = sprintf( '<div class="entry-meta">%s</div>', $html );
	}

	do_action( 'vidiho_pro_before_the_post_entry_meta', $html );

	echo $html; // WPCS: XSS ok.

	do_action( 'vidiho_pro_after_the_post_entry_meta', $html );
}

function vidiho_pro_the_post_entry_sticky_label() {
	if ( 'post' !== get_post_type() ) {
		return;
	}

	if ( ! is_singular() && is_sticky() ) {
		?>
		<span class="entry-meta-item entry-sticky">
			<?php esc_html_e( 'Featured', 'vidiho-pro' ); ?>
		</span>
		<?php
	}
}

function vidiho_pro_the_post_entry_date() {
	if ( 'post' !== get_post_type() ) {
		return;
	}

	if ( get_theme_mod( 'post_show_date', 1 ) ) {
		?>
		<span class="entry-meta-item">
			<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date(); ?></time>
		</span>
		<?php
	}
}

function vidiho_pro_the_post_entry_categories() {
	if ( 'post' !== get_post_type() ) {
		return;
	}

	if ( get_theme_mod( 'post_show_categories', 1 ) ) {
		?>
		<span class="entry-meta-item entry-categories">
			<?php the_category( ', ' ); ?>
		</span>
		<?php
	}
}

function vidiho_pro_the_post_entry_author() {
	if ( 'post' !== get_post_type() ) {
		return;
	}

	if ( get_theme_mod( 'post_show_author', 1 ) ) {
		?>
		<span class="entry-meta-item entry-author">
			<?php
				printf(
					/* translators: %s is the author's name. */
					esc_html_x( 'by %s', 'post author', 'vidiho-pro' ),
					'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
				);
			?>
		</span>
		<?php
	}
}

function vidiho_pro_the_post_entry_comments_link() {
	if ( 'post' !== get_post_type() ) {
		return;
	}

	if ( get_theme_mod( 'post_show_comments', 1 ) ) {
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			?>
			<span class="entry-meta-item entry-comments-link">
				<?php
					/* translators: %s: post title */
					comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'vidiho-pro' ), array(
						'span' => array(
							'class' => array(),
						),
					) ), get_the_title() ) );
				?>
			</span>
			<?php
		}
	}
}

function vidiho_pro_the_post_author_box() {

	do_action( 'vidiho_pro_before_the_post_author_box' );

	get_template_part( 'template-parts/authorbox' );

	do_action( 'vidiho_pro_after_the_post_author_box' );
}

/**
 * @param string $$context May be 'global' or 'user'. If false, it will try to decide by itself.
 */
function vidiho_pro_the_social_icons( $context = false ) {
	$networks = vidiho_pro_get_social_networks();

	$global_urls = array();
	$user_urls   = array();
	$used_urls   = array();

	$global_rss = get_theme_mod( 'theme_rss_feed', get_bloginfo( 'rss2_url' ) );
	$user_rss   = get_author_feed_link( get_the_author_meta( 'ID' ) );
	$used_rss   = '';

	foreach ( $networks as $network ) {
		if ( get_theme_mod( 'theme_social_' . $network['name'] ) ) {
			$global_urls[ $network['name'] ] = get_theme_mod( 'theme_social_' . $network['name'] );
		}
	}

	foreach ( $networks as $network ) {
		if ( get_the_author_meta( 'user_' . $network['name'] ) ) {
			$user_urls[ $network['name'] ] = get_the_author_meta( 'user_' . $network['name'] );
		}
	}

	if ( 'user' === $context ) {
		$used_urls = $user_urls;
		$used_rss  = $user_rss;
	} elseif ( 'global' === $context ) {
		$used_urls = $global_urls;
		$used_rss  = $global_rss;
	} else {
		$used_urls = $global_urls;
		$used_rss  = $global_rss;

		if ( in_the_loop() ) {
			$used_urls = $user_urls;
			$used_rss  = $user_rss;
		}
	}

	$used_urls = apply_filters( 'vidiho_pro_social_icons_used_urls', $used_urls, $context, $global_urls, $user_urls );
	$used_rss  = apply_filters( 'vidiho_pro_social_icons_used_rss', $used_rss, $context, $global_rss, $user_rss );

	$has_rss = $used_rss ? true : false;

	// Set the target attribute for social icons.
	$target = '';
	if ( get_theme_mod( 'theme_social_target', 1 ) ) {
		$target = 'target="_blank"';
	}

	if ( count( $used_urls ) > 0 || $has_rss ) {
		do_action( 'vidiho_pro_before_the_social_icons' );
		?>
		<ul class="list-social-icons">
			<?php
				$template = '<li><a href="%1$s" class="social-icon" %2$s><i class="%3$s"></i></a></li>';

				foreach ( $networks as $network ) {
					if ( ! empty( $used_urls[ $network['name'] ] ) ) {
						echo sprintf( $template,
							esc_url( $used_urls[ $network['name'] ] ),
							$target,
							esc_attr( $network['icon'] )
						);
					}
				}

				if ( $has_rss ) {
					echo sprintf( $template,
						$used_rss,
						$target,
						esc_attr( 'fas fa-rss' )
					);
				}
			?>
		</ul>
		<?php
		do_action( 'vidiho_pro_after_the_social_icons' );
	}
}


/**
 * Echoes pagination links if applicable. Output depends on pagination method selected from the customizer.
 *
 * @uses the_post_pagination()
 * @uses previous_posts_link()
 * @uses next_posts_link()
 *
 * @param array $args An array of arguments to change default behavior.
 * @param WP_Query|null $query A WP_Query object to paginate. Defaults to null and uses the global $wp_query
 *
 * @return void
 */
function vidiho_pro_posts_pagination( $args = array(), WP_Query $query = null ) {
	$args = wp_parse_args( $args, apply_filters( 'vidiho_pro_posts_pagination_default_args', array(
		'mid_size'           => 1,
		'prev_text'          => _x( 'Previous', 'previous post', 'vidiho-pro' ),
		'next_text'          => _x( 'Next', 'next post', 'vidiho-pro' ),
		'screen_reader_text' => __( 'Posts navigation', 'vidiho-pro' ),
		'container_id'       => '',
		'container_class'    => '',
	), $query ) );

	global $wp_query;

	if ( ! is_null( $query ) ) {
		$old_wp_query = $wp_query;
		$wp_query     = $query;
	}

	$output = '';
	$method = get_theme_mod( 'pagination_method', 'numbers' );

	if ( $wp_query->max_num_pages > 1 ) {

		switch ( $method ) {
			case 'text':
				$output = get_the_posts_navigation( $args );
				break;
			case 'numbers':
			default:
				$output = get_the_posts_pagination( $args );
				break;
		}

		if ( ! empty( $args['container_id'] ) || ! empty( $args['container_class'] ) ) {
			$output = sprintf( '<div id="%2$s" class="%3$s">%1$s</div>', $output, esc_attr( $args['container_id'] ), esc_attr( $args['container_class'] ) );
		}
	}

	if ( ! is_null( $query ) ) {
		$wp_query = $old_wp_query;
	}

	// All markup is from native WordPress functions. The wrapping div is properly escaped above.
	$output_safe = $output;

	echo $output_safe;
}

/**
 * Echoes row classes based on whether the current template has a visible sidebar or not,
 * and depending on sidebar visibility option on single post/pages/etc.
 */
function vidiho_pro_the_row_classes() {
	$info = vidiho_pro_get_layout_info();
	echo esc_attr( $info['row_classes'] );
}

/**
 * Echoes container classes based on whether
 * the current template has a visible sidebar or not
 */
function vidiho_pro_the_container_classes() {
	$info = vidiho_pro_get_layout_info();
	echo esc_attr( $info['container_classes'] );
}

/**
 * Echoes container classes based on whether
 * the current template has a visible sidebar or not
 */
function vidiho_pro_the_sidebar_classes() {
	$info = vidiho_pro_get_layout_info();
	echo esc_attr( $info['sidebar_classes'] );
}
