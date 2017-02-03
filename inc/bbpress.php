<?php
/* -----------------------------------------------------------------------------
 * Custom bbPress Functions
 * -------------------------------------------------------------------------- */
/**
 * Enqueue Scripts
 */
add_action( 'wp_enqueue_scripts', 'vw_enqueue_bbpress_script' );
if ( ! function_exists( 'vw_enqueue_bbpress_script' ) ) {
	function vw_enqueue_bbpress_script() {
		if ( vw_is_rtl() ) {
			// RTL styles
			wp_enqueue_style( 'vwcss-bbpress-rtl', get_template_directory_uri().'/css/custom-bbpress-rtl.css', array( 'vwcss-theme-rtl', 'bbp-default' ), VW_THEME_VERSION );
		} else {
			// Default styles
			wp_enqueue_style( 'vwcss-bbpress', get_template_directory_uri().'/css/custom-bbpress.css', array( 'vwcss-theme', 'bbp-default' ), VW_THEME_VERSION );
		}
	}
}

/**
 * Apply breaking news option
 */
add_filter( 'vw_filter_is_enable_breaking_news', 'vw_bbp_is_enable_breaking_news' );
if ( ! function_exists( 'vw_bbp_is_enable_breaking_news' ) ) {
	function vw_bbp_is_enable_breaking_news( $is_enabled ) {
		if ( vw_is_bbpress() ) {
			return vw_get_theme_option( 'bbpress_show_breaking_news' );

		} else {
			return $is_enabled;
		}
	}
}

/**
 * Apply sidebar position option
 */
add_filter( 'vw_filter_sidebar_position', 'vw_bbp_sidebar_position' );
if ( ! function_exists( 'vw_bbp_sidebar_position' ) ) {
	function vw_bbp_sidebar_position( $sidebar_position ) {
		if ( vw_is_bbpress() ) {
			return vw_get_theme_option( 'bbpress_default_sidebar_position' );

		} else {
			return $sidebar_position;
		}
	}
}

/**
 * Apply left sidebar option
 */
add_filter( 'vw_filter_left_sidebar', 'vw_bbp_left_sidebar' );
if ( ! function_exists( 'vw_bbp_left_sidebar' ) ) {
	function vw_bbp_left_sidebar( $sidebar ) {
		if ( vw_is_bbpress() ) {
			return vw_get_theme_option( 'bbpress_default_left_sidebar' );

		} else {
			return $sidebar;
		}
	}
}

/**
 * Apply right sidebar option
 */
add_filter( 'vw_filter_right_sidebar', 'vw_bbp_right_sidebar' );
if ( ! function_exists( 'vw_bbp_right_sidebar' ) ) {
	function vw_bbp_right_sidebar( $sidebar ) {
		if ( vw_is_bbpress() ) {
			return vw_get_theme_option( 'bbpress_default_right_sidebar' );

		} else {
			return $sidebar;
		}
	}
}

/**
 * Remove breadcrumb from the forum archive page
 */
add_filter( 'bbp_no_breadcrumb', 'vw_bbp_no_breadcrumb' );
if ( ! function_exists( 'vw_bbp_no_breadcrumb' ) ) {
	function vw_bbp_no_breadcrumb( $arg ) {
		if ( bbp_is_forum_archive() ) {
			return true;
		}
	}
}

/**
 * Replace root link when the custom forum page is specified
 */
add_filter( 'bbp_breadcrumbs', 'vw_bbp_breadcrumbs_replace_root_link' );
if ( ! function_exists( 'vw_bbp_breadcrumbs_replace_root_link' ) ) {
	function vw_bbp_breadcrumbs_replace_root_link( $crumbs ) {
		$bbpress_forum_page = vw_get_theme_option( 'bbpress_forum_page' );

		if ( ! empty( $bbpress_forum_page ) ) {
			if ( isset( $crumbs[0] ) && preg_match( '|<a href=".*" class="bbp-breadcrumb-root">.*</a>|', $crumbs[0] ) ) {
				$permalink = get_permalink( $bbpress_forum_page );
				$title = get_the_title( $bbpress_forum_page );
				$crumbs[0] = sprintf( '<a href="%s" class="bbp-breadcrumb-root">%s</a>', esc_attr( $permalink ), $title );
			}
		}

		return $crumbs;
	}
}

/**
 * Remove the home link from breadcrumb
 */
add_filter( 'bbp_after_get_breadcrumb_parse_args', 'vw_bbp_after_get_breadcrumb_parse_args' );
if ( ! function_exists( 'vw_bbp_after_get_breadcrumb_parse_args' ) ) {
	function vw_bbp_after_get_breadcrumb_parse_args( $args ) {
		$args['include_home'] = false;
		return $args;
	}
}

/* -----------------------------------------------------------------------------
 * Utility Functions
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_is_bbpress' ) ) {
	function vw_is_bbpress() {
		return function_exists( 'is_bbpress' ) && is_bbpress();
	}
}