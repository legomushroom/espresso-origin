<?php
// Define content width
if ( ! isset( $content_width ) ) {
	$content_width = 1140;
}

/* -----------------------------------------------------------------------------
 * Setup theme
 * -------------------------------------------------------------------------- */
add_action( 'after_setup_theme', 'vw_after_theme_setup' );
if ( ! function_exists( 'vw_after_theme_setup' ) ) {
	function vw_after_theme_setup() {
		/**
		 * Make theme translatable
		 */
		load_theme_textdomain( 'envirra', get_stylesheet_directory() . '/languages' );

		/**
		 * Add supported features
		 */
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-formats', array( 'audio', 'gallery', 'video' ) );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
		add_theme_support( 'title-tag' );

		/**
		 * Define thumbnail sizes
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'vw_one_six_thumbnail', 165, 116, true );
		add_image_size( 'vw_one_half_thumbnail', 555, 278, true );
		add_image_size( 'vw_one_third_thumbnail', 360, 240, true );
		add_image_size( 'vw_two_third_thumbnail', 750, 375, true );
		add_image_size( 'vw_two_third_thumbnail_no_crop', 750, 0, false );
		add_image_size( 'vw_small_thumbnail', 85, 60, true );
		add_image_size( 'vw_full_width_thumbnail', 1263, 560, true );

		/**
		 * Register menu
		 */
		register_nav_menu( 'vw_menu_main', 'Main Menu' );
		register_nav_menu( 'vw_menu_mobile', 'Mobile Menu' );
		register_nav_menu( 'vw_menu_top', 'Top Menu' );
		register_nav_menu( 'vw_menu_bottom', 'Bottom Menu' );

		/**
		 * Add custom filters
		 */		
		add_filter( 'widget_title', 'do_shortcode', 10, 2 );
		add_filter( 'widget_text', 'do_shortcode', 10, 2 );
		add_filter( 'excerpt_length', 'vw_custom_excerpt_length' );

		/**
		 * Init avoid duplicate post
		 */
		if ( vw_get_theme_option( 'blog_avoid_duplicate_post' ) ) {
			global $vw_duplicate_posts;
			$vw_duplicate_posts = array();
		}
	}
}

/* -----------------------------------------------------------------------------
 * Add Site Meta in Header
 * -------------------------------------------------------------------------- */
add_filter( 'wp_head', 'vw_site_meta' );
if ( ! function_exists( 'vw_site_meta' ) ) {
	function vw_site_meta() {
		get_template_part( '/templates/site-meta' );
	}
}

/* -----------------------------------------------------------------------------
 * Add Custom Excerpt More
 * -------------------------------------------------------------------------- */
add_filter( 'excerpt_more', 'vw_custom_excerpt_more' );
if ( ! function_exists( 'vw_custom_excerpt_more' ) ) {
	function vw_custom_excerpt_more( $length ) {
		return ' ...';
	}
}

/* -----------------------------------------------------------------------------
 * Add Body Classes
 * -------------------------------------------------------------------------- */
add_filter( 'body_class', 'vw_body_class_options' );
if ( ! function_exists( 'vw_body_class_options' ) ) {
	function vw_body_class_options( $classes ) {

		// Option class
		if ( vw_get_theme_option( 'site_enable_sticky_menu' ) ) {
			$classes[] = 'vw-site-enable-sticky-menu';
		}

		if ( vw_get_theme_option( 'blog_enable_masonry_layout' ) ) {
			$classes[] = 'vw-blog-enable-masonry-layout';
		}

		if ( vw_get_theme_option( 'slider_enable_kenburns' ) ) {
			$classes[] = 'vw-enable-kenburns';
		}

		if ( vw_get_theme_option( 'blog_enable_video_lightbox' ) ) {
			$classes[] = 'vw-enable-video-lightbox';
		}

		// Site layout class
		$site_layout = vw_get_theme_option( 'site_layout' );
		$classes[] = sprintf( 'vw-site-layout-%s', $site_layout );

		// Post layout class for single post page
		if ( is_single() ) {
			$post_layout = vw_get_post_layout();
			$classes[] = sprintf( 'vw-post-layout-%s', $post_layout );
		}

		return $classes;
	}
}

/* -----------------------------------------------------------------------------
 * Add Site Title
 * -------------------------------------------------------------------------- */

/**
 * Backwards compatibility
 */
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	add_action( 'wp_head', 'vw_render_site_title' );
	if ( ! function_exists( 'vw_render_site_title' ) ) {
		function vw_render_site_title() {
			?><title><?php wp_title( '|', true, 'right' ); ?></title><?php
		}
	}
}

/* -----------------------------------------------------------------------------
 * Post Classes
 * -------------------------------------------------------------------------- */
add_filter( 'post_class', 'vw_post_classes' );
function vw_post_classes( $classes ) {
	if ( ! post_password_required() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}

/* -----------------------------------------------------------------------------
 * Allow Font File Uploads
 * -------------------------------------------------------------------------- */
add_filter( 'upload_mimes', 'vw_allowed_upload_mimes' );
if ( ! function_exists( 'vw_allowed_upload_mimes' ) ) {
	function vw_allowed_upload_mimes( $existing_mimes = array() ) {
		$existing_mimes['ttf'] = 'font/ttf';
		$existing_mimes['otf'] = 'font/opentype';
		$existing_mimes['woff'] = 'font/woff';
		$existing_mimes['svg'] = 'font/svg';
		$existing_mimes['eot'] = 'font/eot';
		
		return $existing_mimes;
	}
}

/* -----------------------------------------------------------------------------
 * Add Link To Author Page
 * -------------------------------------------------------------------------- */
add_filter( 'get_comment', 'vw_force_comment_author_url' );
function vw_force_comment_author_url( $comment ) {
	// does the comment have a valid author URL?
	$no_url = !$comment->comment_author_url || $comment->comment_author_url == 'http://';

	if ( $comment->user_id && $no_url ) {
		// comment was written by a registered user but with no author URL
		$comment->comment_author_url = get_author_posts_url( $comment->user_id );
	}

	return $comment;
}

/* -----------------------------------------------------------------------------
 * Post box class
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_post_box_class' ) ) {
	function vw_post_box_class( $class = '' ) {		
		$classes = array( 'vw-post-box' );

		if ( ! empty( $class ) ) {
			$classes[] = $class;
		}

		if ( has_post_format() ) {
			$classes[] = ' vw-post-box-format-'.get_post_format();
		} else {
			$classes[] = ' vw-post-box-format-standard';
		}

		if ( vw_has_review() ) {
			$classes[] = ' vw-post-box-has-review';
		} else {
			$classes[] = ' vw-post-box-has-no-review';
		}

		echo ' class="' . esc_attr( join( ' ', $classes ) ) . '" ';
	}
}

/* -----------------------------------------------------------------------------
 * Remove extra padding in image caption
 * -------------------------------------------------------------------------- */
add_filter( 'img_caption_shortcode_width', 'vw_remove_caption_padding' );
if ( ! function_exists( 'vw_remove_caption_padding' ) ) {
	function vw_remove_caption_padding( $width ) {
		return $width - 10;
	}
}

/* -----------------------------------------------------------------------------
 * Before/After Post Content
 * -------------------------------------------------------------------------- */
add_filter( 'the_content', 'vw_before_after_post_content', 99 );
if ( ! function_exists( 'vw_before_after_post_content' ) ) {
	function vw_before_after_post_content( $content ) {
		if ( ! is_single() ) return $content;
		
		$before = vw_get_theme_option( 'before_post_content' );
		if ( ! empty( $before ) ) {
			$content = '<div class="vw-before-post-content">'. $before . '</div>' . $content;
		}

		$after = vw_get_theme_option( 'after_post_content' );
		if ( ! empty( $after ) ) {
			$content = $content . '<div class="vw-after-post-content">'. $after . '</div>';
		}

		return $content;
	}
}

/* -----------------------------------------------------------------------------
 * Avoid duplicate post
 * -------------------------------------------------------------------------- */
global $vw_duplicate_posts;
$vw_duplicate_posts = false; // Must be initialed as an array before using

if ( ! function_exists( 'vw_enable_avoid_duplicate_post' ) ) {
	function vw_enable_avoid_duplicate_post() {
		global $vw_duplicate_posts;
		if ( $vw_duplicate_posts !== false ) {
			add_action( 'pre_get_posts', 'vw_avoid_duplicate_post' );
			add_action( 'the_post', 'vw_do_not_duplicate_this_post' );
		}
	}
}

if ( ! function_exists( 'vw_disable_avoid_duplicate_post' ) ) {
	function vw_disable_avoid_duplicate_post() {
		global $vw_duplicate_posts;
		if ( $vw_duplicate_posts !== false ) {
			remove_action( 'pre_get_posts', 'vw_avoid_duplicate_post' );
		}
	}
}

if ( ! function_exists( 'vw_avoid_duplicate_post' ) ) {
	function vw_avoid_duplicate_post( $query ) {
		global $vw_duplicate_posts;
		$query->set( 'post__not_in', $vw_duplicate_posts );
	}
}

if ( ! function_exists( 'vw_do_not_duplicate_this_post' ) ) {
	function vw_do_not_duplicate_this_post( $post_object ) {
		global $vw_duplicate_posts;
		$vw_duplicate_posts[] = $post_object->ID;

	}
}

/* -----------------------------------------------------------------------------
 * Prevent XSS
 * -------------------------------------------------------------------------- */

add_filter( 'the_excerpt', 'vw_security_excerpt' );
if ( ! function_exists( 'vw_security_excerpt' ) ) {
	function vw_security_excerpt( $content ) {
		return wp_kses_data( $content );
	}
}