<?php 
/* -----------------------------------------------------------------------------
 * Breadcrumb
 * Credit to Author: Mallikarjun Yawalkar
 * Plugin URI: http://wordpress.org/extends/plugins/rdfa-breadcrumb
 * Version: 2.2
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_the_breadcrumb' ) ) {
	function vw_the_breadcrumb( $args = array() ) {

		if ( vw_is_yoast_breadcrumb_enabled() ) {
			/* For Yoast Breadcrumb */
			yoast_breadcrumb('<div class="vw-breadcrumb vw-breadcrumb-yoast">','</div>');

		} else {
			$defaults = array(
				'title' => '',
				'show_home' => true,
				'singular_post_taxonomy'=> 'category',
			);

			$args = wp_parse_args( $args, $defaults );

			$title = '';
			if ( ! empty( $args['title'] ) ) {
				$title = '<span class="vw-breadcrumb-title">' . $args['title'] . '</span>';
			}

			$separator = __( '<span class="vw-breadcrumb-separator">&raquo;</span>', 'envirra' );

			$items = vw_get_breadcrumb_items( array(
					'show_home' => $args['show_home'],
				) );
			
			$breadcrumbs = '<div class="vw-breadcrumb vw-breadcrumb-envirra">';
			$breadcrumbs .= $title;
			$breadcrumbs .= '<span>'.join( "{$separator}", $items ).'</span>';
			$breadcrumbs .= '</div>';

			echo $breadcrumbs;
		}
	}
}

if ( ! function_exists( 'vw_get_breadcrumb_items' ) ) {
	function vw_get_breadcrumb_items( $args = array() ) {
		$defaults = array(
			'show_home' => true,
		);

		$args = wp_parse_args( $args, $defaults );

		global $wp_query;

		$item = array();

		$show_on_front = get_option( 'show_on_front' );

		/* Front page. */
		if ( is_front_page() ) {
			$item['last'] = __( 'Home', 'envirra' );
		}

		/* Link to front page. */
		if ( !is_front_page() && $args['show_home'] )
			$item[] = '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="'. home_url( '/' ) .'" class="home">' . __( 'Home', 'envirra' ) . '</a></span>';

		/* If bbPress is installed and we're on a bbPress page. */
		if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
			$item = array_merge( $item, vw_breadcrumb_get_bbpress_items() );
		}

		elseif ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
			$item = array_merge( $item, vw_breadcrumb_get_woocommerce_items() );
		}

		/* If viewing a home/post page. */
		elseif ( is_home() ) {
			$home_page = get_page( $wp_query->get_queried_object_id() );
			$item = array_merge( $item, vw_breadcrumb_get_parents( $home_page->post_parent ) );
			$item['last'] = get_the_title( $home_page->ID );
		}

		/* If viewing a singular post. */
		elseif ( is_singular() ) {

			$post = $wp_query->get_queried_object();
			$post_id = (int) $wp_query->get_queried_object_id();
			$post_type = $post->post_type;

			$post_type_object = get_post_type_object( $post_type );

			if ( 'post' === $wp_query->post->post_type ) {
				// $item[] = '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">' . get_the_title( get_option( 'page_for_posts' ) ) . '</a></span>';
				$categories = get_the_category( $post_id );
				$item = array_merge( $item, vw_breadcrumb_get_term_parents( $categories[0]->term_id, $categories[0]->taxonomy ) );
			}

			if ( 'page' !== $wp_query->post->post_type ) {

				/* If there's an archive page, add it. */
				
				if ( function_exists( 'get_post_type_archive_link' ) && !empty( $post_type_object->has_archive ) )
					$item[] = '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_post_type_archive_link( $post_type ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '">' . esc_html( $post_type_object->labels->name ) . '</a></span>';

				if ( isset( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) && is_taxonomy_hierarchical( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) ) {
					$terms = wp_get_object_terms( $post_id, $args["singular_{$wp_query->post->post_type}_taxonomy"] );
					$item = array_merge( $item, vw_breadcrumb_get_term_parents( $terms[0], $args["singular_{$wp_query->post->post_type}_taxonomy"] ) );
				}

				elseif ( isset( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) )
					$item[] = get_the_term_list( $post_id, $args["singular_{$wp_query->post->post_type}_taxonomy"], '', ', ', '' );
			}

			if ( ( is_post_type_hierarchical( $wp_query->post->post_type ) || 'attachment' === $wp_query->post->post_type ) && $parents = vw_breadcrumb_get_parents( $wp_query->post->post_parent ) ) {
				$item = array_merge( $item, $parents );
			}

			$item['last'] = get_the_title();
		}

		/* If viewing any type of archive. */
		else if ( is_archive() ) {

			if ( is_category() || is_tag() || is_tax() ) {

				$term = $wp_query->get_queried_object();
				$taxonomy = get_taxonomy( $term->taxonomy );

				if ( ( is_taxonomy_hierarchical( $term->taxonomy ) && $term->parent ) && $parents = vw_breadcrumb_get_term_parents( $term->parent, $term->taxonomy ) )
					$item = array_merge( $item, $parents );

				$item['last'] = $term->name;
			}

			else if ( function_exists( 'is_post_type_archive' ) && is_post_type_archive() ) {
				$post_type_object = get_post_type_object( get_query_var( 'post_type' ) );
				$item['last'] = $post_type_object->labels->name;
			}

			else if ( is_date() ) {

				if ( is_day() )
					$item['last'] = __( 'Archives for ', 'envirra' ) . esc_html( get_the_time( 'F j, Y' ) );

				elseif ( is_month() )
					$item['last'] = __( 'Archives for ', 'envirra' ) . single_month_title( ' ', false );

				elseif ( is_year() )
					$item['last'] = __( 'Archives for ', 'envirra' ) . esc_html( get_the_time( 'Y' ) );
			}

			else if ( is_author() )
				$item['last'] = __( 'Archives by: ', 'envirra' ) . esc_html( get_the_author_meta( 'display_name', $wp_query->post->post_author ) );
		}

		/* If viewing search results. */
		else if ( is_search() )
			$item['last'] = __( 'Search results for "', 'envirra' ) . esc_html( get_search_query() ) . '"';

		/* If viewing a 404 error page. */
		else if ( is_404() )
			$item['last'] = __( 'Page Not Found', 'envirra' );

		if ( isset( $item['last'] ) ) {
			$item['last'] = sprintf( '<span class="vw-breadcrumb-item-last">%s</span>', $item['last'] );
		}
		
		return apply_filters( 'vw_filter_breadcrumb_items', $item );
	}
}

if ( ! function_exists( 'vw_breadcrumb_get_woocommerce_items' ) ) {
	function vw_breadcrumb_get_woocommerce_items() {
		$item = array();
		$shop_page_id = wc_get_page_id( 'shop' );

		if ( get_option( 'page_on_front' ) != $shop_page_id ) {
			$shop_name = $shop_page_id ? get_the_title( $shop_page_id ) : '';
			if ( ! is_shop() ) {
				$item[] = '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_permalink( $shop_page_id ) . '">' . $shop_name . '</a></span>';
			} else {
				$item[ 'last' ] = $shop_name;
			}
		}

		if ( is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) {
			$current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			
		} elseif ( is_product() ) {
			global $post;
			$terms = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) );
			$current_term = $terms[0];
		}

		if ( ! empty( $current_term ) ) {
			if ( is_taxonomy_hierarchical( $current_term->taxonomy ) ) {
				$item = array_merge( $item, vw_breadcrumb_get_term_parents( $current_term->parent, $current_term->taxonomy ) );
			}

			if ( is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) {
				$item[ 'last' ] = $current_term->name;
			} else {
				$item[] = '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_term_link( $current_term->term_id, $current_term->taxonomy ) . '">' . $current_term->name . '</a></span>';
			}
		}

		if ( is_product() ) {
			$item[ 'last' ] = get_the_title();
		}

		return apply_filters( 'vw_breadcrumb_get_woocommerce_items', $item );
	}
}

if ( ! function_exists( 'vw_breadcrumb_get_bbpress_items' ) ) {
	function vw_breadcrumb_get_bbpress_items() {
		$item = array();

		$post_type_object = get_post_type_object( bbp_get_forum_post_type() );

		if ( !empty( $post_type_object->has_archive ) && !bbp_is_forum_archive() )
			$item[] = '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_post_type_archive_link( bbp_get_forum_post_type() ) . '">' . bbp_get_forum_archive_title() . '</a></span>';

		if ( bbp_is_forum_archive() )
			$item[ 'last' ] = bbp_get_forum_archive_title();

		elseif ( bbp_is_topic_archive() )
			$item[ 'last' ] = bbp_get_topic_archive_title();

		elseif ( bbp_is_single_view() )
			$item[ 'last' ] = bbp_get_view_title();

		elseif ( bbp_is_single_topic() ) {

			$topic_id = get_queried_object_id();

			$item = array_merge( $item, vw_breadcrumb_get_parents( bbp_get_topic_forum_id( $topic_id ) ) );

			if ( bbp_is_topic_split() || bbp_is_topic_merge() || bbp_is_topic_edit() )
				$item[] = '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . bbp_get_topic_permalink( $topic_id ) . '">' . bbp_get_topic_title( $topic_id ) . '</a></span>';
			else
				$item[ 'last' ] = bbp_get_topic_title( $topic_id );

			if ( bbp_is_topic_split() )
				$item[ 'last' ] = __( 'Split', 'envirra' );

			elseif ( bbp_is_topic_merge() )
				$item[ 'last' ] = __( 'Merge', 'envirra' );

			elseif ( bbp_is_topic_edit() )
				$item[ 'last' ] = __( 'Edit', 'envirra' );
		}

		elseif ( bbp_is_single_reply() ) {

			$reply_id = get_queried_object_id();

			$item = array_merge( $item, vw_breadcrumb_get_parents( bbp_get_reply_topic_id( $reply_id ) ) );

			if ( !bbp_is_reply_edit() ) {
				$item[ 'last' ] = bbp_get_reply_title( $reply_id );

			} else {
				$item[] = '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . bbp_get_reply_url( $reply_id ) . '">' . bbp_get_reply_title( $reply_id ) . '</a></span>';
				$item[ 'last' ] = __( 'Edit', 'envirra' );
			}

		}

		elseif ( bbp_is_single_forum() ) {

			$forum_id = get_queried_object_id();
			$forum_parent_id = bbp_get_forum_parent_id( $forum_id );

			if ( 0 !== $forum_parent_id)
				$item = array_merge( $item, vw_breadcrumb_get_parents( $forum_parent_id ) );

			$item[ 'last' ] = bbp_get_forum_title( $forum_id );
		}

		elseif ( bbp_is_single_user() || bbp_is_single_user_edit() ) {

			if ( bbp_is_single_user_edit() ) {
				$item[] = '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . bbp_get_user_profile_url() . '">' . bbp_get_displayed_user_field( 'display_name' ) . '</a></span>';
				$item[ 'last' ] = __( 'Edit', 'envirra' );
			} else {
				$item[ 'last' ] = bbp_get_displayed_user_field( 'display_name' );
			}
		}

		return apply_filters( 'vw_breadcrumb_get_bbpress_items', $item );
	}
}

if ( ! function_exists( 'vw_breadcrumb_get_parents' ) ) {
	function vw_breadcrumb_get_parents( $post_id = '', $separator = '/' ) {
		$parents = array();

		if ( $post_id == 0 ){
			return $parents;
		}

		while ( $post_id ) {
			$page = get_page( $post_id );
			$parents[]  = '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">' . get_the_title( $post_id ) . '</a></span>';
			$post_id = $page->post_parent;
		}

		if ( $parents ) {
			$parents = array_reverse( $parents );
		}

		return $parents;
	}
}

if ( ! function_exists( 'vw_breadcrumb_get_term_parents' ) ) {
	function vw_breadcrumb_get_term_parents( $parent_id = '', $taxonomy = '', $separator = '/' ) {
		$html = array();
		$parents = array();

		if ( empty( $parent_id ) || empty( $taxonomy ) ){
			return $parents;
		}

		while ( $parent_id ) {
			$parent = get_term( $parent_id, $taxonomy );
			$parents[] = '<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_term_link( $parent, $taxonomy ) . '" title="' . esc_attr( $parent->name ) . '">' . esc_html( $parent->name ) . '</a></span>';
			$parent_id = $parent->parent;
		}

		if ( $parents )	{
			$parents = array_reverse( $parents );
		}

		return $parents;
	}
}

if ( ! function_exists( 'vw_is_yoast_breadcrumb_enabled' ) ) {
	function vw_is_yoast_breadcrumb_enabled() {
		$options = get_option( 'wpseo_internallinks' );

		return function_exists( 'yoast_breadcrumb' ) && $options['breadcrumbs-enable'] === true;
	}
}