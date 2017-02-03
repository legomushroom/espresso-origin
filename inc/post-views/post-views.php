<?php
/**
 * Credits: Juliobox, BAW Post Views Count, http://www.boiteaweb.fr/pvc
 */
defined( 'VW_CONST_POST_VIEWS_URL' ) || define( 'VW_CONST_POST_VIEWS_URL', get_template_directory_uri().'/inc/post-views' );

global $timings;
// $timings = apply_filters( 'vw_post_views_timings', array( 'all'=>'', 'day'=>'Ymd', 'week'=>'YW', 'month'=>'Ym', 'year'=>'Y' ) );
$timings = apply_filters( 'vw_post_views_timings', array( 'all'=>'', 'week'=>'YW', 'month'=>'Ym', 'year'=>'Y' ) );

if ( defined( 'WP_CACHE' ) && WP_CACHE ) {
	require 'ajax-counter.php';

} else {
	add_action( 'wp_head', 'vw_count_post_views' );

}

/* -----------------------------------------------------------------------------
 * If post views enabled
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_post_views_enabled' ) ) {
	function vw_post_views_enabled() {
		return vw_get_theme_option( 'blog_enable_post_views', true );
	}
}

/* -----------------------------------------------------------------------------
 * Count Post Views
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_count_post_views' ) ) {
	function vw_count_post_views( $post_id = '' ) {
		global $post, $timings;

		if ( ! vw_post_views_enabled() ) return;

		if ( ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) && ! is_single() ) {
			return;
		}

		if ( empty( $post_id ) ) {
			$post_id = $post->ID;
		}

		foreach ( $timings as $time=>$date ) {
			if ( $time != 'all' ) {
				$date = '-' . date( $date );
			}

			// Filtered meta key name
			$meta_key_filtered = apply_filters( 'vw_post_views_meta_key', 'vw_post_views_' . $time . $date, $time, $date );
			$count = (int)get_post_meta( $post_id, $meta_key_filtered, true );
			$count++;
			update_post_meta( $post_id, $meta_key_filtered, $count );

			// Normal meta key name
			$meta_key = 'vw_post_views_' . $time . $date;
			if( $meta_key_filtered != $meta_key ):
				$count = (int)get_post_meta( $post_id, $meta_key, true );
				$count++;
				update_post_meta( $post_id, $meta_key, $count );
			endif;
			//// I update 2 times with 2 different meta names because i need to keep my own count too, in bonus of hacked/filtered count.
		}
	}
}

/* -----------------------------------------------------------------------------
 * Add Post Views Column in Admin
 * -------------------------------------------------------------------------- */
add_filter( 'manage_posts_columns', 'vw_posts_column_views' );
if ( ! function_exists( 'vw_posts_column_views' ) ) {
	function vw_posts_column_views( $defaults ) {
		$defaults['vw_post_views'] = __( 'Views', 'envirra' );
		return $defaults;
	}
}

add_action( 'manage_posts_custom_column', 'vw_posts_custom_column_views', 5, 2 );
if ( ! function_exists( 'vw_posts_custom_column_views' ) ) {
	function vw_posts_custom_column_views( $column_name, $id ) {
		if ( $column_name === 'vw_post_views' ){
			$count = vw_get_post_views( get_the_ID() );

			echo '<span class="vw-post-views">';
			printf( __( '%s Views', 'envirra' ), number_format_i18n( $count ) );
			echo '</span>';
		}
	}
}

/* -----------------------------------------------------------------------------
 * Render Post Views Element
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_the_post_views' ) ) {
	function vw_the_post_views( $post_id = '' ) {
		echo vw_get_the_post_views( $post_id );
	}
}

if ( ! function_exists( 'vw_get_post_views' ) ) {
	function vw_get_post_views( $post_id = '' ) {
		global $post;

		if( empty( $post_id ) ) $post_id = $post->ID;

		$count = get_post_meta( $post_id, 'vw_post_views_all', true );

		if( $count == '' ) {
			$count = 0;
		}

		return $count + vw_get_theme_option( 'post_views_forgery' );
	}
}

if ( ! function_exists( 'vw_get_the_post_views' ) ) {
	function vw_get_the_post_views( $post_id = '' ) {
		global $post;

		if ( ! vw_post_views_enabled() ) return;

		if( empty( $post_id ) ) $post_id = $post->ID;

		$count = vw_get_post_views( $post_id );
		$output = '<span class="vw-post-meta-icon vw-post-view-count vw-post-views-id-'.esc_attr($post_id).'" data-post-id="'.esc_attr($post_id).'" title="'.esc_attr__( 'Views', 'envirra' ).'">';
		$output .= ' <i class="vw-icon icon-entypo-eye"></i>';
		$output .= ' <span class="vw-post-view-number">'.vw_number_prefixes( $count ).'</span>';
		$output .= '</span>';

		return $output;
	}
}


if ( ! function_exists( 'vw_the_post_views_text' ) ) {
	function vw_the_post_views_text( $post_id = '' ) {
		echo vw_get_the_post_views_text( $post_id );
	}
}

if ( ! function_exists( 'vw_get_the_post_views_text' ) ) {
	function vw_get_the_post_views_text( $post_id = '' ) {
		global $post;

		if ( ! vw_post_views_enabled() ) return;

		if( empty( $post_id ) ) $post_id = $post->ID;

		$count = vw_get_post_views( $post_id );
		$output = '<span class="vw-post-meta-icon vw-post-view-count vw-post-views-id-'.esc_attr($post_id).'" data-post-id="'.esc_attr($post_id).'" title="'.esc_attr__( 'Views', 'envirra' ).'">';
		$output .= ' <span class="vw-post-view-number">'.sprintf( '%s Views', vw_number_prefixes( $count ) ).'</span>';
		$output .= '</span>';

		return $output;
	}
}