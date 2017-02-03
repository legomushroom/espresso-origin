/* -----------------------------------------------------------------------------
 * Page Template Meta-box
 * -------------------------------------------------------------------------- */
;(function( $, window, document, undefined ){
	"use strict";
	
	$( document ).ready( function () {
		$( '#vw_review_editor' ).review_editor();
	} );
})( jQuery, window , document );

/* -----------------------------------------------------------------------------
 * Review Editor
 * -------------------------------------------------------------------------- */
;(function( $, window, document, undefined ){
	var REVIEW_EDITOR = {

		init: function( el ) {
			this.on_click_add_row = $.proxy( this.on_click_add_row, this );
			this.on_click_delete_row = $.proxy( this.on_click_delete_row, this );
			this.on_click_enable_review = $.proxy( this.on_click_enable_review, this );

			this.$metabox = $( el );
			this.$metabox.find( '#vw-add-review-score' ).click( this.on_click_add_row );
			this.$placeholder = $( '.rwmb-review_score-wrapper .review-scores' );
			this.init_items();
			this.$placeholder.sortable( { handle: ".move-icon" } );

			this.$metabox.find( '#vw_enable_review' ).click( this.on_click_enable_review ).triggerHandler( 'click' );
		},

		init_items: function() {
			var $inputs = $( '#postcustom input[type=text]' );
			for ( var i = 1; i <= 10; i++ ) {
				// Get label value
				var $label = $inputs.filter( '[value=vw_review_score_'+i+'_label]' );
				if ( ! $label.length ) break;
				var meta_id = $label.attr( 'id' ).match(/[0-9]+/);
				var label_value = $( '#postcustom *[name=meta\\['+meta_id+'\\]\\[value\\]]' ).val();

				// Get score value
				var $score = $inputs.filter( '[value=vw_review_score_'+i+'_score]' );
				if ( ! $score.length ) break;
				meta_id = $score.attr( 'id' ).match(/[0-9]+/);
				var score_value = $( '#postcustom *[name=meta\\['+meta_id+'\\]\\[value\\]]' ).val();
				

				this.add_row( label_value, score_value );
			};
		},

		init_row: function( $row ) {
			$row.find( '.delete-icon' ).click( this.on_click_delete_row );
		},

		add_row: function( label, score ) {
			var id = $.uuid();
			var $row = $(
				'<div id="'+id+'" class="review-score-row">'
					+ '<i class="move-icon icon-entypo-menu"></i>'
					+ '<span class="review-score-label">Label</span>'
					+ '<input type="text" class="rwmb-text" name="vw_review_score_label['+id+']">'
					+ '<span class="review-score-label">Score</span>'
					+ '<input type="number" class="rwmb-number" name="vw_review_score_score['+id+']" step="1" min="0" max="100" placeholder="">'
					+ '<i class="delete-icon icon-entypo-cancel"></i>'
				+'</div>'
				);
			$row.find( '.rwmb-text' ).val( label );
			$row.find( '.rwmb-number' ).val( score );
			this.$placeholder.append( $row );
			this.init_row( $row );
		},

		on_click_add_row: function() {
			this.add_row( '', 50 );
		},

		on_click_delete_row: function( e ) {
			var $icon = $( e.target );
			$icon.parents( '.review-score-row' ).remove();
		},

		on_click_enable_review: function( e ) {
			var $checkbox = $( e.target );
			var $fields = this.$metabox.find( '.field-review-summary, .field-review-score, .field-review-score-style, .field-review-position' );

			if ( $checkbox.is( ':checked' ) ) {
				$fields.show();
			} else {
				$fields.hide();
			}
		},
	}

	$.fn.review_editor = function() {
		return this.each(function() {
			var review_editor = $.extend( {}, REVIEW_EDITOR );

			review_editor.init( this );
		});
	};
})( jQuery, window , document );