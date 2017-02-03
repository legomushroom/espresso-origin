if ( jQuery ) {
	jQuery( document ).ready( function() {
		setTimeout( function() {
			jQuery.ajax( {
				type: "GET",
				url: vw_post_views.ajaxurl,
				data: "postviews_id="+vw_post_views.post_id+"&action=postviews",
				cache: false
			} )
		}, 1500 );
	} );
} else {
	console.warn( 'Theme: jQuery does not loaded properly. Post views counter will be disabled.' );
}