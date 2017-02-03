<?php
require_once get_template_directory().'/inc/menu/mega-menu-edit.php';

/**
 * Additional items on main menu
 */
add_filter( 'vw_filter_main_menu_additional_items', 'vw_main_menu_additional_items' );
if ( ! function_exists( 'vw_main_menu_additional_items' ) ) {
	function vw_main_menu_additional_items( $content ) {
		// Nav Logo
		$nav_logo_html = '';
		$nav_logo = vw_get_theme_option( 'nav_logo' );
		if ( ! empty( $nav_logo['url'] ) ) {
			$nav_logo_html .= '<li class="vw-menu-additional-logo">';
			$nav_logo_html .= '<a href="'.home_url().'">';
			$nav_logo_html .= '<img class="animated" src="'.esc_url( $nav_logo['url'] ).'" height="'.esc_attr( $nav_logo['height'] ).'" width="'.esc_attr( $nav_logo['width'] ).'" alt="'.esc_attr( get_bloginfo( 'name' ) ).'">';
			$nav_logo_html .= '</a>';
			$nav_logo_html .= '</li>';
		}

		return $nav_logo_html;
	}
}

/**
 * Additional icons on main menu
 */
// add_filter( 'vw_filter_main_menu_additional_items', 'vw_main_menu_additional_icons' );
if ( ! function_exists( 'vw_main_menu_additional_icons' ) ) {
	function vw_main_menu_additional_icons( $content ) {
		$html = apply_filters( 'vw_filter_main_menu_additional_icons', '' );

		if ( ! empty( $html ) ) {
			$html = '<li class="vw-menu-additional-icons">'.$html.'</li>';
		}

		return $content.$html;
	}
}

/**
 * Show posts on mega menu
 */
add_action( 'vw_action_mega_menu_render_as_category', 'vw_mega_menu_render_as_category_recent', 10, 2 );
if ( ! function_exists( 'vw_mega_menu_render_as_category_recent' ) ) {
	function vw_mega_menu_render_as_category_recent( $item, $depth ) {
		if ( $item->object != 'category' ) return;

		if ( $item->vw_menu_type == 'category' ) { 
			$post_args = array(
				'posts_per_page' => 3,
				'offset'=> 0,
				'cat' => $item->object_id,
				'ignore_sticky_posts' => 1,
				'meta_query' => array(
					array( // Query only posts that have a featured image
						'key' => '_thumbnail_id',
						'compare' => 'EXISTS'
					),
				),
			);
			query_posts( apply_filters( 'vw_filter_mega_menu_category_query_args', $post_args ) );

			$template_file = sprintf( 'templates/mega-post-menu.php' );
			include( locate_template( $template_file, false, false ) );

			wp_reset_query();
		}
	}
}