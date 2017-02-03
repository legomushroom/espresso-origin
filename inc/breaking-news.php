<?php 

if ( ! function_exists( 'vw_is_enable_breaking_news' ) ) {
	function vw_is_enable_breaking_news() {
		if ( vw_get_theme_option( 'enable_breaking_news' ) ) {
			if ( is_front_page() ) {
				$is_enable_breaking_news = vw_get_theme_option( 'show_breaking_news_on_front_page' );

			} else {
				$is_enable_breaking_news = true;

			}

		} else {
			$is_enable_breaking_news = false;

		}

		return apply_filters( 'vw_filter_is_enable_breaking_news', $is_enable_breaking_news );
	}
}

add_filter( 'vw_filter_is_enable_breaking_news', 'vw_force_disable_breaking_news_for_fullwidth' );
if ( ! function_exists( 'vw_force_disable_breaking_news_for_fullwidth' ) ) {
	function vw_force_disable_breaking_news_for_fullwidth( $is_enabled ) {
		if ( is_single() && 'full-width' == vw_get_post_layout() ) {
			$is_enabled = false;

		} else if ( is_page() && is_page_template( 'page_big_featured_image.php' ) ) {
			$is_enabled = false;

		} else if ( function_exists( 'is_shop' ) && vw_is_shop() && get_page_template_slug( vw_get_shop_page_id() ) == 'page_big_featured_image.php' ) {
			$is_enabled = false;

		}

		return $is_enabled;
	}
}

if ( ! function_exists( 'vw_query_breaking_news_posts' ) ) {
	function vw_query_breaking_news_posts() {
		$query_args = array(
			'post_type' => 'post',
			'ignore_sticky_posts' => true,
			'posts_per_page' => 8,
			'offset' => 0,
			'meta_query' => array(
				array(
					'key' => '_thumbnail_id',
					'compare' => 'EXISTS'
				),
			),
		);

		$source = vw_get_theme_option( 'breaking_news_source' );
		if ( 'random' == $source ) {
			$query_args['orderby'] = 'rand';
			
		} else if ( 'featured' == $source ) {
			$query_args['meta_query'][] = array(
				'key' => 'vw_post_featured',
				'value' => '1',
				'compare' => '=',
			);

		}

		/*
		if ( is_category() ) {
			$query_args['cat'] = get_queried_object_id();

		} else if ( is_tag() ) {
			$query_args['tag_id'] = get_queried_object_id();

		}
		*/

		query_posts( apply_filters( 'vw_filter_breaking_news_query_args', $query_args ) );
	}
}