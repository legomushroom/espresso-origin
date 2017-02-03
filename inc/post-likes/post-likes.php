<?php

defined( 'VW_CONST_POST_LIKES_URL' ) || define( 'VW_CONST_POST_LIKES_URL', get_template_directory_uri().'/inc/post-likes' );
defined( 'VW_CONST_POST_LIKES_TIMEOUT' ) || define( 'VW_CONST_POST_LIKES_TIMEOUT', 604800 ); // 60*60*24*7 for 1 week, unit in seconds
defined( 'VW_CONST_POST_LIKES_DISABLE_REALTIME' ) || define( 'VW_CONST_POST_LIKES_DISABLE_REALTIME', false ); // Force no ajax request when caching engine is enabled

add_action( 'wp_enqueue_scripts', 'vwplk_enqueue_scripts' );
if ( ! function_exists( 'vwplk_enqueue_scripts' ) ) {
	function vwplk_enqueue_scripts() {
		wp_enqueue_script( 'vwjs-post-likes', VW_CONST_POST_LIKES_URL.'/post-likes.js', array( 'jquery' ), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );
		wp_localize_script( 'vwjs-post-likes', 'vw_post_likes', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'liked_message' => __( 'You already like this', 'envirra' ),
			'is_caching_enabled' => ( ! VW_CONST_POST_LIKES_DISABLE_REALTIME && vw_is_caching_enabled() ),
		) );
	}
}

add_action( 'publish_post', 'vwplk_init_post_likes' );
if ( ! function_exists( 'vwplk_init_post_likes' ) ) {
	function vwplk_init_post_likes( $post_id ) {
		if( ! is_numeric( $post_id ) ) return;

		add_post_meta( $post_id, 'vw_post_likes', '0', true );
	}
}

add_action( 'wp_ajax_vwplk-get-likes', 'vwplk_ajax_get_likes' );
add_action( 'wp_ajax_nopriv_vwplk-get-likes', 'vwplk_ajax_get_likes' );
if ( ! function_exists( 'vwplk_ajax_get_likes' ) ) {
	function vwplk_ajax_get_likes() {
		$result = array();

		if( isset( $_POST['post_ids'] ) && ! empty( $_POST['post_ids'] ) ) {
			foreach ( $_POST['post_ids'] as $html_post_id ) {
				$post_id = intval( $_POST['likes_id'] );
				$result[ $html_post_id ] = vwplk_get_like_button( $post_id );
			}
		}

		echo json_encode( $result );
		
		exit;
	}
}

add_action( 'wp_ajax_vwplk-add-like', 'vwplk_ajax_add_like' );
add_action( 'wp_ajax_nopriv_vwplk-add-like', 'vwplk_ajax_add_like' );
if ( ! function_exists( 'vwplk_ajax_add_like' ) ) {
	function vwplk_ajax_add_like() {
		if( isset( $_POST['likes_id'] ) ) {
			$post_id = intval( $_POST['likes_id'] );
			
			if( ! is_int( $post_id ) || isset( $_COOKIE[ 'vw_post_likes_'. $post_id ] ) ) exit;

			$likes = get_post_meta( $post_id, 'vw_post_likes', true );
			if( ! $likes ){
				$likes = 0;
				add_post_meta( $post_id, 'vw_post_likes', $likes, true );
			}

			update_post_meta( $post_id, 'vw_post_likes', intval( $likes+1 ), $likes );
			setcookie( 'vw_post_likes_'. $post_id, $post_id, time() + VW_CONST_POST_LIKES_TIMEOUT, '/' );
			
		}

		echo vwplk_get_like_button( $post_id );

		exit;
	}
}

if ( ! function_exists( 'vwplk_like_shortcode' ) ) {
	function vwplk_like_shortcode( $atts, $content = null ) {
		ob_start();
		vw_the_likes();
		return ob_get_clean();
	}
}

if ( ! function_exists( 'vwplk_get_like_button' ) ) {
	function vwplk_get_like_button( $post_id ) {
		$likes_count = intval( get_post_meta( $post_id, 'vw_post_likes', true ) );
		
		$output = '<i class="vw-icon icon-iconic-heart"></i>';
		$output .= '<span class="vw-post-likes-number">'.number_format_i18n( $likes_count ).'</span>';
  
  		return $output;
	}
}

/* -----------------------------------------------------------------------------
 * Template Tag
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_the_likes' ) ) {
	function vw_the_likes() {
		global $post;

		$classes = '';
		if( isset( $_COOKIE[ 'vw_post_likes_'. $post->ID ] ) ) {
			$classes .= ' vw-post-liked';
		}

		printf( '<a href="#" class="vw-post-meta-icon vw-post-likes-count %2$s" id="vw-post-likes-id-%1$s" data-post-id="%1$s" title="%3$s">', esc_attr( $post->ID ), esc_attr( $classes ), esc_attr( __( 'Likes', 'envirra' ) ) );
		echo vwplk_get_like_button( $post->ID );
		echo '</a>';
	}
}