<?php
$post_id = get_the_id();
$post_url = urlencode( get_permalink() );
$post_title = urlencode( get_the_title() );
$thumbnail_url = '';
if ( has_post_thumbnail() ) {
	$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full' );
	$thumbnail_url = $thumbnail[0];
}

$facebook_url = sprintf( 'http://www.facebook.com/sharer.php?u=%s', $post_url );
$twitter_url = sprintf( 'http://twitter.com/home?status=%s', $post_title.'%20-%20'.$post_url );
$pinterest_url = sprintf( 'http://pinterest.com/pin/create/button/?url=%s&media=%s&description=%s', $post_url, $thumbnail_url, $post_title );
$gplus_url = sprintf( 'http://plus.google.com/share?url=%s', $post_url );
?>
<div class="vw-post-share-box">
	<div class="vw-post-share-big-number">
		<div class="vw-number"><?php echo vw_number_prefixes( vwpsh_get_total_shares() ); ?></div>
		<div class="vw-unit"><?php _e( 'Shares', 'envirra' ); ?></div>
	</div>

	<a class="vw-post-share-box-button vw-post-shares-social vw-post-shares-social-facebook" href="<?php echo esc_url( $facebook_url ); ?>" data-post-id="<?php echo esc_attr( $post_id ); ?>" data-share-to="facebook" data-width="500" data-height="300" title="<?php echo esc_attr__( 'Share to Facebook', 'envirra' );?>">
		<i class="vw-icon icon-social-facebook"></i>
		<span class="vw-button-label"><?php _e( 'Facebook', 'envirra' ); ?></span>
	</a>

	<a class="vw-post-share-box-button vw-post-shares-social vw-post-shares-social-twitter" href="<?php echo esc_url( $twitter_url ); ?>" data-post-id="<?php echo esc_attr( $post_id ); ?>" data-share-to="twitter" data-width="500" data-height="300" title="<?php echo esc_attr__( 'Share to Twitter', 'envirra' );?>">
		<i class="vw-icon icon-social-twitter"></i>
		<span class="vw-button-label"><?php _e( 'Twitter', 'envirra' ); ?></span>
	</a>

	<a class="vw-post-share-box-button vw-post-shares-social vw-post-shares-social-pinterest" href="<?php echo esc_url( $pinterest_url ); ?>" data-post-id="<?php echo esc_attr( $post_id ); ?>" data-share-to="pinterest" data-width="750" data-height="300" title="<?php echo esc_attr__( 'Share to Pinterest', 'envirra' );?>">
		<i class="vw-icon icon-social-pinterest"></i>
		<span class="vw-button-label"><?php _e( 'Pinterest', 'envirra' ); ?></span>
	</a>

	<a class="vw-post-share-box-button vw-post-shares-social vw-post-shares-social-gplus" href="<?php echo esc_url( $gplus_url ); ?>" data-post-id="<?php echo esc_attr( $post_id ); ?>" data-share-to="gplus" data-width="500" data-height="475" title="<?php echo esc_attr__( 'Share to Google+', 'envirra' );?>">
		<i class="vw-icon icon-social-gplus"></i>
		<span class="vw-button-label"><?php _e( 'Google+', 'envirra' ); ?></span>
	</a>
</div>