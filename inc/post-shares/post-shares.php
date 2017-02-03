<?php

if ( ! defined( 'VW_CONST_POST_SHARES_URL' ) ) define( 'VW_CONST_POST_SHARES_URL', get_template_directory_uri().'/inc/post-shares' );
if ( ! defined( 'VW_CONST_POST_SHARES_META_KEY' ) ) define( 'VW_CONST_POST_SHARES_META_KEY', 'vw_share_count' );

if ( is_single() ) {
}
	add_action( 'wp_footer', 'vwpsh_render_post_shares_dialog' );
	add_action( 'wp_enqueue_scripts', 'vwpsh_enqueue_scripts' );

if ( ! function_exists( 'vwpsh_enqueue_scripts' ) ) {
	function vwpsh_enqueue_scripts() {
		wp_enqueue_script( 'vwjs-post-shares', VW_CONST_POST_SHARES_URL.'/post-shares.js', array( 'jquery' ), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );
		wp_localize_script( 'vwjs-post-shares', 'vw_post_shares', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'is_caching_enabled' => vw_is_caching_enabled(),
		) );
	}
}

if ( ! function_exists( 'vwpsh_render_post_shares_dialog' ) ) {
	function vwpsh_render_post_shares_dialog() {
		$post_id = get_the_id();
		$post_url = esc_url( get_permalink() );
		$post_title = urlencode( get_the_title() );
		$thumbnail_url = '';
		if ( has_post_thumbnail() ) {
			$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full' );
			$thumbnail_url = $thumbnail[0];
		}

		$facebook_url = sprintf( 'http://www.facebook.com/sharer.php?u=%s', $post_url );
		$twitter_url = sprintf( 'https://twitter.com/intent/tweet?status=%s', $post_title.'%20-%20'.$post_url );
		$pinterest_url = sprintf( 'http://pinterest.com/pin/create/button/?url=%s&media=%s&description=%s', $post_url, $thumbnail_url, $post_title );
		$gplus_url = sprintf( 'http://plus.google.com/share?url=%s', $post_url );
		?>
		<div id="vw-post-shares-dialog" class="zoom-anim-dialog mfp-hide">
			<span class="vw-post-shares-subtitle"><?php _e( 'SHARE', 'envirra' ); ?></span>
			<h1 class="vw-header-font vw-post-shares-title"><?php the_title(); ?></h1>
			<div class="vw-post-shares-socials">
				<a class="vw-post-shares-social vw-post-shares-social-facebook" href="<?php echo esc_url( $facebook_url ); ?>" data-post-id="<?php echo esc_attr( $post_id ); ?>" data-share-to="facebook" data-width="500" data-height="300"><i class="vw-icon icon-social-facebook"></i></a>
				<a class="vw-post-shares-social vw-post-shares-social-twitter" href="<?php echo esc_url( $twitter_url ); ?>" data-post-id="<?php echo esc_attr( $post_id ); ?>" data-share-to="twitter" data-width="500" data-height="300"><i class="vw-icon icon-social-twitter"></i></a>
				<a class="vw-post-shares-social vw-post-shares-social-pinterest" href="<?php echo esc_url( $pinterest_url ); ?>" data-post-id="<?php echo esc_attr( $post_id ); ?>" data-share-to="pinterest" data-width="750" data-height="300"><i class="vw-icon icon-social-pinterest"></i></a>
				<a class="vw-post-shares-social vw-post-shares-social-gplus" href="<?php echo esc_url( $gplus_url ); ?>" data-post-id="<?php echo esc_attr( $post_id ); ?>" data-share-to="gplus" data-width="500" data-height="475"><i class="vw-icon icon-social-gplus"></i></a>
			</div>
		</div>
		<?php
	}
}

add_action( 'wp_ajax_vwpsh-count-share', 'vwpsh_count_share' );
add_action( 'wp_ajax_nopriv_vwpsh-count-share', 'vwpsh_count_share' );
if ( ! function_exists( 'vwpsh_count_share' ) ) {
	function vwpsh_count_share() {
		$post_id = FALSE;
		$social = FALSE;

		if( isset( $_POST['post_id'] ) && ! empty( $_POST['post_id'] ) && intval( $_POST['post_id'] ) > 0 ) {
			$post_id = intval( $_POST[ 'post_id' ] );
		}

		if( isset( $_POST['social'] ) && ! empty( $_POST['social'] ) ) {
			$social = $_POST[ 'social' ];

			if ( ! in_array( $social, array( 'facebook', 'twitter', 'pinterest', 'gplus' ) ) ) {
				$social = FALSE;
			}
		}

		if ( ! empty( $post_id ) && ! empty( $social ) ) {
			// Update total sharing counter
			$total_counter = intval( get_post_meta( $post_id, VW_CONST_POST_SHARES_META_KEY, true ) );
			if ( empty( $total_counter ) ) {
				$total_counter = 0;
			}
			$total_counter++;
			update_post_meta( $post_id, VW_CONST_POST_SHARES_META_KEY, $total_counter );

			// Update specific social sharing counter
			$social_meta_key = VW_CONST_POST_SHARES_META_KEY.'_'.$social;
			$social_counter = intval( get_post_meta( $post_id, $social_meta_key, true ) );
			if ( empty( $social_counter ) ) {
				$social_counter = 0;
			}
			$social_counter++;
			update_post_meta( $post_id, $social_meta_key, $social_counter );

			echo vw_number_prefixes( $total_counter );

		} else {
			echo 'Theme[post-shares]: Invalid given data';

		}

		exit;
	}
}

if ( ! function_exists( 'vwpsh_get_total_shares' ) ) {
	function vwpsh_get_total_shares( $post_id = null ) {
		if ( empty( $post_id ) ) {
			$post_id = get_the_id();
		}

		return intval( get_post_meta( $post_id, VW_CONST_POST_SHARES_META_KEY, true ) );
	}
}

if ( ! function_exists( 'vw_the_post_shares' ) ) {
	function vw_the_post_shares( $classes='' ) {
		$total_counter = vwpsh_get_total_shares();
		?>
		<a class="vw-post-share-count <?php echo esc_attr( $classes ); ?>" href="#vw-post-shares-dialog" title="<?php echo esc_attr__( 'Shares', 'envirra' ); ?>">
			<i class="vw-icon icon-iconic-share"></i> <span class="vw-post-share-number"><?php echo vw_number_prefixes( $total_counter ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'vw_the_post_share_icons' ) ) {
	function vw_the_post_share_icons() {
		get_template_part( 'templates/post-share-icons' );
	}
}

if ( ! function_exists( 'vw_the_post_share_box' ) ) {
	function vw_the_post_share_box() {
		get_template_part( 'templates/post-share-box' );
	}
}