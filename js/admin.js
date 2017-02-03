/* -----------------------------------------------------------------------------
 * Page Template Meta-box
 * -------------------------------------------------------------------------- */
;(function( $, window, document, undefined ){
	"use strict";
	
	$( document ).ready( function () {
		// $( '#vw_review' ).review_editor();

		/* -----------------------------------------------------------------------------
		 * Post format
		 * -------------------------------------------------------------------------- */
		$('#post-formats-select input[type="radio"]').live( 'change', function() {
			var val = $(this).val();
			if( val == '0' ) {
				val = 'standard';
			}

			$( '#vw_post_format_gallery' ).hide();
			$( '#vw_post_format_audio' ).hide();
			$( '#vw_post_format_video' ).hide();

			if ( 'gallery' == val ) {
				$( '#vw_post_format_gallery' ).show();
			} else if ( 'audio' == val ) {
				$( '#vw_post_format_audio' ).show();
			} else if ( 'video' == val ) {
				$( '#vw_post_format_video' ).show();
			}
		} ).filter(':checked').trigger( 'change' );
		
		/* -----------------------------------------------------------------------------
		 * Page template
		 * -------------------------------------------------------------------------- */
		/*$( '#page_template' ).change( function() {
			var template = $( '#page_template' ).val();

			// Page Composer Template
			if ( 'page_simple_composer.php' == template || 'page_full_width.php' == template ) {
				$( '#acf-page_sidebar' ).hide();

			} else {
				$( '#acf-page_sidebar' ).show();
				
			}
		} ).triggerHandler( 'change' );*/

		// -----------------------------------------------------------------------------
		// Fitvids - keep video ratio
		// 
		$( '.postbox .embed-code' ).fitVids( { customSelector: "iframe[src*='maps.google.'], iframe[src*='soundcloud.']" });

	} );
})( jQuery, window , document );

/* -----------------------------------------------------------------------------
 * Media button
 * -------------------------------------------------------------------------- */
;(function( $, window, document, undefined ){
	var MEDIA_BOX_BUTTON = {
		defaults: {
			callback: null
		},

		init: function( el, options ) {
			this.options = $.extend({}, this.defaults, options);

			this.onClickButton = $.proxy( this.onClickButton, this );
			this.onSendToEditor = $.proxy( this.onSendToEditor, this );
			this.$button = $( el );

			this.$button.click( this.onClickButton );
		},

		onClickButton: function( e ) {
			if (e.button == 0) { // Only left click
				this.wp_send_to_editor = window.send_to_editor;
				window.send_to_editor = this.onSendToEditor;

				tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true' );
				return false;
			}
		},

		onSendToEditor: function( html ) {
			var imgurl = $( 'img', '<div>'+html+'</div>' ).attr( 'src' );

			if ( this.options.callback && "function" === typeof(this.options.callback) ) {
				this.options.callback( imgurl, html );
			}

			tb_remove();
			window.send_to_editor = this.wp_send_to_editor;
		},
	}

	$.fn.media_box_button = function( arg1, arg2 ) {
		return this.each(function() {
			var media_box = $.extend({}, MEDIA_BOX_BUTTON);

			if ( "function" === typeof( arg1 ) ) {
				media_box.init( this, $.extend( { callback: arg1 }, arg2 ) );
			} else {
				media_box.init( this, arg1 );
			}
		});
	};
})( jQuery, window , document );

/* -----------------------------------------------------------------------------
 * UUID
 * https://github.com/eburtsev/jquery-uuid/blob/master/jquery-uuid.js
 * -------------------------------------------------------------------------- */
;(function( $, window, document, undefined ){
	$.uuid = function() {
		return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
			var r = Math.random()*16|0, v = c == 'x' ? r : (r&0x3|0x8);
			return v.toString(16);
		});
	};
})( jQuery, window , document );

/**
 * ReplaceAll by Fagner Brack (MIT Licensed)
 * Replaces all occurrences of a substring in a string
 * Calling: "".replaceAll(token, newToken, ignoreCase=boolean)
 */
// String.prototype.replaceAll=function(c,e,d){var a,b=-1;if((a=this.toString())&&"string"===typeof c)for(d=!0===d?c.toLowerCase():void 0;-1!==(b=void 0!==d?a.toLowerCase().indexOf(d,0<=b?b+e.length:0):a.indexOf(c,0<=b?b+e.length:0));)a=a.substring(0,b).concat(e).concat(a.substring(b+c.length));return a};

/* .stripHTML() */
// String.prototype.stripHTML = function() { return this.replace(/<[^>]+>/ig,""); };