<?php

/* -----------------------------------------------------------------------------
 * Post Views Script
 * -------------------------------------------------------------------------- */
add_action( 'wp_enqueue_scripts', 'vw_enqueue_post_views_scripts' );
if ( ! function_exists( 'vw_enqueue_post_views_scripts' ) ) {
	function vw_enqueue_post_views_scripts() {
		global $post;

		if ( ! vw_post_views_enabled() ) return;

		if ( is_single() ) {
			wp_enqueue_script( 'vwjs-post-views', VW_CONST_POST_VIEWS_URL.'/post-views-ajax.js', array( 'jquery' ) );
			wp_localize_script( 'vwjs-post-views', 'vw_post_views', array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'post_id' => intval( $post->ID )
			) );
		}
	}
}

/* -----------------------------------------------------------------------------
 * Post Views AJAX
 * -------------------------------------------------------------------------- */
add_action( 'wp_ajax_postviews', 'vw_ajax_count_post_views' );
add_action( 'wp_ajax_nopriv_postviews', 'vw_ajax_count_post_views' );
if ( ! function_exists( 'vw_ajax_count_post_views' ) ) {
	function vw_ajax_count_post_views() {

		if ( ! vw_post_views_enabled() ) return;

		if( ! empty( $_GET['postviews_id'] ) ) {
			$post_id = intval( $_GET['postviews_id'] );

			if( $post_id > 0 ) {
				vw_count_post_views( $post_id );
				vw_the_post_views( $post_id );
			}
		}

		exit();
	}
}