/* -----------------------------------------------------------------------------
 * Post Likes
 * -------------------------------------------------------------------------- */
;(function( $, window, document, undefined ){
	"use strict";

	$( document ).ready( function ($) {
		var $post_likes = $( '.vw-post-likes-count' );
		$post_likes.click( function() {
				var link = $(this);
				if( link.hasClass( 'vw-post-liked' ) ) return false;
			
				var id = $(this).data('post-id');
				
				$.post( vw_post_likes.ajaxurl, { action:'vwplk-add-like', likes_id:id }, function(data){
					link.html(data).addClass('vw-post-liked').attr( 'title', vw_post_likes.liked_message );
				} );
			
				return false;
		} );
		
		if ( vw_post_likes.is_caching_enabled ) {
			// Get like button when caching engine is enabled
			var post_likes_ids = [];
			$post_likes.each( function(){
				post_likes_ids.push( $(this).data( 'post-id' ) );
			} );
			
			$.post( vw_post_likes.ajaxurl, { action:'vwplk-get-likes', post_ids:post_likes_ids }, function(data){
				$.each( data, function( id, liked_button_html ) {
					$( '[id='+id+']' ).html( liked_button_html );
				} )
			}, 'json' );
		}

	} );

})( jQuery, window , document );