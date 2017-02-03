+function ( $ ) { "use strict";
	var VWSPC_PAGE_COMPOSER = {
		defaults: {
			selector: '#vwspc-container',
		},

		init: function( options ) {
			this.options = $.extend( {}, this.defaults, options );
			this.bind_proxy();

			this.$container = $( this.options.selector );
			if ( ! this.$container.length ) return;

			this.init_add_section_menu();
			this.init_sections();
		},

		init_sections: function() {
			this.$sections = this.$container.find( '.vwspc-sections' );

			for ( var i = 1; i <= 50; i++ ) {
				var custom_field_name = 'vwspc_section_'+i;
				var section_type = this.get_custom_field_value( custom_field_name );
				if ( ! section_type ) break;

				this.add_section( section_type, custom_field_name );
			}

			this.$sections.sortable( { handle: ".vwspc-section-handle, .vwspc-section-label", placeholder: 'vwspc-sortable-placeholder', forcePlaceholderSize: true, stop: this.on_stop_sorting } );
			this.$sections.find( '.vwspc-section-loading' ).remove();
		},

		init_add_section_menu: function() {
			this.$add_section_button = this.$container.find( '#add-section-button' ).dropdown();
			var $menu_list = this.$container.find( '.vwspc-toolbox .dropdown-menu' );
			
			$.each( vwspc_sections, function( section_type, section_settings ) {
				var $menu_item = $( '<li role="presentation"><a role="menuitem" tabindex="-1" href="#"></a></li>' );
				$menu_item.find( 'a' )
					.data( 'vwspc-section-type', section_type )
					.html( section_settings.title );
				$menu_list.append( $menu_item );
			} );
			$menu_list.find( 'a' ).click( this.on_click_add_section );
		},

		init_section: function( $new_section ) {
			$new_section.find( '.vwspc-section-bar, .vwspc-section-open-option' ).click( this.on_click_open_option );
			$new_section.find( '.vwspc-section-delete-section' ).click( this.on_click_delete_section );
			this.init_wp_editor( $new_section );
		},

		init_wp_editor: function( $section ) {
			setTimeout(function(){
				if ( 0 == $section.find( '.wp-editor-area' ).length ) return;
				var textarea = $section.find('.vwspc-field.wp-editor-area');
				var editor_id = textarea.attr( 'data-vwspc-editor-id' );
				tinyMCEPreInit.mceInit[editor_id] = $.extend( {}, tinyMCEPreInit.mceInit['vwspc-wp-editor-id'] );
				tinyMCEPreInit.mceInit[editor_id].elements = editor_id;
				tinyMCEPreInit.mceInit[editor_id].selector  = '#'+editor_id;
				tinyMCEPreInit.mceInit[editor_id].height  = '250px';
				// tinyMCEPreInit.mceInit[editor_id].body_class = tinyMCEPreInit.mceInit[editor_id].body_class.replace(/vwspc-wp-editor-id/g, editor_id);
				tinyMCEPreInit.qtInit[editor_id] = tinyMCEPreInit.qtInit['vwspc-wp-editor-id'];
				tinyMCEPreInit.qtInit[editor_id].id  = editor_id;
				// tinyMCEPreInit.mceInit[editor_id].setup = function(editor) {
				// 	tinymce.editors[editor_id].setContent( window.switchEditors.wpautop( textarea.val() ), {format : 'html'});
					// editor.setContent( window.switchEditors.wpautop( textarea.val() ), {format : 'raw'});
					// $( '#wp-'+editor_id+'-wrap.html-active .switch-html' ).trigger( 'click' );
				// };
				
				setTimeout(function(){
					// $( '#wp-'+editor_id+'-wrap .switch-tmce' ).trigger( 'click' );
					// $section.find( '.switch-html' ).trigger( 'click' );
					$section.find( '.switch-tmce' ).trigger( 'click' );
				}, 100);

				// try {
					// tinymce.init(tinyMCEPreInit.mceInit[editor_id]);
					// tinymce.remove('#'+editor_id);
					// tinyMCE.execCommand("mceRemoveControl", true, editor_id);
					// tinyMCE.execCommand("mceAddControl", true, editor_id);
				// } catch (e) {}

				try {
					if ( ! textarea.attr( 'data-vwspc-quicktag-initialed' ) ) {
						quicktags(tinyMCEPreInit.qtInit[editor_id]);
						QTags._buttonsInit();
						textarea.attr( 'data-vwspc-quicktag-initialed', true );
					}
				} catch (e) {}

			}, 100);
		},

		add_section: function( section_type, custom_field_name ) {
			if ( 'undefined' === typeof vwspc_sections[section_type] ) return;
			
			var uuid = $.uuid();
			var id = 'vwspc_sections['+uuid+']';
			var $new_section = $( $( '#vwspc-template-section' ).html() );
			$new_section.find( '.vwspc-section-type' ).attr( 'name', id+'[_type]' ).val( section_type );
			$new_section.find( '.vwspc-section-order' ).val( uuid );
			$new_section.find( '.vwspc-section-label' ).html( vwspc_sections[section_type].title );

			var $new_option = this.render_section_options( section_type, id, custom_field_name );
			$new_section.find( '.vwspc-section-options' ).append( $new_option );

			this.$sections.append( $new_section );
			this.init_section( $new_section );
			
			return $new_section;
		},

		get_custom_field_value: function( custom_field_name ) {
			if ( ! custom_field_name ) return false;
			var $custom_field = $( '#postcustom input[value='+custom_field_name+']' );
			if ( ! $custom_field.length ) return false;

			var meta_id = $custom_field.attr( 'id' ).match(/[0-9]+/);
			return $( '#postcustom *[name=meta\\['+meta_id+'\\]\\[value\\]]' ).val();
		},

		render_section_options: function( section_type, id, custom_field_name ) {
			var self = this;
			var section_setting = vwspc_sections[ section_type ];
			var options = [];
			$.each( section_setting.options, function( name, option ) {
				var $new_option = $( $( '#vwspc-template-section-option' ).html() );	
				$new_option.addClass( 'vwspc-field-type-'+option.field );
				$new_option.find( '.vwspc-section-option-label' ).html( option.title );
				$new_option.find( '.vwspc-section-option-description' ).html( option.description );
				$new_option.find( '.vwspc-section-option-field-wrapper' ).append(
					self.render_field[ option.field ].call( self, option, id+'['+name+']', self.get_custom_field_value( custom_field_name+'_'+name ) )
				);	
				options.push( $new_option );
			} );

			return options;
		},

		bind_proxy: function() {
			this.on_click_add_section = $.proxy( this.on_click_add_section, this );
			this.on_click_delete_section = $.proxy( this.on_click_delete_section, this );
			this.on_click_open_option = $.proxy( this.on_click_open_option, this );
			this.on_stop_sorting = $.proxy( this.on_stop_sorting, this );
		},

		on_click_add_section: function( e ) {
			var section_type = $( e.target ).data( 'vwspc-section-type' );
			var $new_section = this.add_section( section_type, false );
			$new_section.find( '.vwspc-section-open-option' ).trigger( 'click' );
			this.$add_section_button.dropdown( 'toggle' );
			return false;
		},

		on_click_delete_section: function( e ) {
			$( e.target ).parents( '.vwspc-section' ).remove();
			return false;
		},

		on_click_open_option: function( e ) {
			var $section_options = $( e.target ).parents( '.vwspc-section' ).find( '.vwspc-section-options' );
			$section_options.slideToggle();
			return false;
		},

		on_stop_sorting: function( e, ui ) {
			var textarea = ui.item.find('.vwspc-field.wp-editor-area');

			if ( textarea.length == 0 ) return;

			var editor_id = textarea.attr( 'data-vwspc-editor-id' );

			tinymce.remove('#'+editor_id);
			this.init_wp_editor( ui.item );

			ui.item.find( '.switch-html' ).trigger( 'click' );
			ui.item.find( '.switch-tmce' ).trigger( 'click' );
		},

		show: function() {
			$( '#postdivrich' ).hide();
			this.$container.show();
		},

		hide: function() {
			$( '#postdivrich' ).show();
			this.$container.hide();
		},

		render_field: {

			select: function( option, id, value ) {
				var $field = $( $( '#vwspc-template-field-select' ).html() );
				$.each( option.options, function( value, label ) {
					$field.append( $( '<option>' ).attr( 'value', value ).html( label ) );
				} );
				$field.attr( 'name', id ).val( value || option.default );
				return $field;
			},

			number: function( option, id, value ) {
				var $field = $( $( '#vwspc-template-field-number' ).html() );
				$field.attr( 'name', id ).val( value || option.default );
				return $field;
			},

			text: function( option, id, value ) {
				var $field = $( $( '#vwspc-template-field-text' ).html() );
				$field.attr( 'name', id ).val( value || option.default );
				return $field;
			},

			html: function( option, id, value ) {
				var editor_id = 'vwspc-wp-editor-' + $.uuid();
				var html = $( '#vwspc-template-field-html' ).html()
							.replace( /vwspc-wp-editor-id/g, editor_id )
							.replace( /vwspc-wp-editor-field-name/g, id );
				var $field = $( html );

				$field.find('.vwspc-field.wp-editor-area')
					.attr( 'data-vwspc-editor-id', editor_id )
					.val( value || option.default );

				return $field;
			},


			page: function( option, id, value ) {
				var $field = $( $( '#vwspc-template-field-page' ).html() );
				$field.attr( 'name', id ).val( value || option.default );
				return $field;
			},

			category: function( option, id, value ) {
				var $field = $( $( '#vwspc-template-field-category' ).html() );
				$field.attr( 'name', id ).val( value || option.default );
				return $field;
			},

			category_with_all_option: function( option, id, value ) {
				var $field = $( $( '#vwspc-template-field-category_with_all_option' ).html() );
				$field.attr( 'name', id ).val( value || option.default );
				return $field;
			},

			categories: function( option, id, value ) {
				var $field = $( $( '#vwpc-template-field-categories' ).html() );
				if ( ! value ) value = '';

				$field.find( 'input[type=checkbox],input[type=hidden]' ).each( function( i, el ) {
					$(el).attr( 'name', id+'[]' );
				} );
				
				var selected_checkboxes = value.split( ',' );
				$.each( selected_checkboxes, function( i, el ) {
					if ( ! el ) return;
					$field.find( 'input[value='+el+']' ).prop('checked', true);
				} );

				return $field;
			},

			sidebar: function( option, id, value ) {
				var $field = $( $( '#vwspc-template-field-sidebar' ).html() );
				$field.attr( 'name', id ).val( value || option.default );
				return $field;
			},
		},

	}

	$.extend( {
		page_composer: function( action ) {
			if ( 'show' == action ) {
				VWSPC_PAGE_COMPOSER.show();
			} else if ( 'hide' == action ) {
				VWSPC_PAGE_COMPOSER.hide();
			}
		},
		// vwsce_on_load: {},
	} );

	/* -----------------------------------------------------------------------------
	 * Document Ready
	 * -------------------------------------------------------------------------- */
	$( document ).ready( function() {
		VWSPC_PAGE_COMPOSER.init();

		$( '#page_template' ).change( function() {
			var template = $( '#page_template' ).val();

			// Page Composer Template
			if ( vwspc_settings.page_template_slug == template ) {
				
				$.page_composer( 'show' );
				// $( '#vw_page_options' ).hide();

			} else {
				$.page_composer( 'hide' );
				// $( '#vw_page_options' ).show();
			}
		} ).triggerHandler( 'change' );
	} );

}( window.jQuery );

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