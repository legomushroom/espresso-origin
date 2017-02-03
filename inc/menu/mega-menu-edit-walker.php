<?php
if ( ! class_exists( 'Vw_Walker_Nav_Mega_Menu_Edit', false ) && class_exists( 'Walker_Nav_Menu_Edit', false ) ) {
	class Vw_Walker_Nav_Mega_Menu_Edit extends Walker_Nav_Menu_Edit {
		var $vw_insert_point_str = '<p class="field-description';

		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$tmp_output = '';
			parent::start_el( $tmp_output, $item, $depth, $args, $id );
			$this->vw_insert_custom_fields( $tmp_output, $item, $depth );
			$output .= $tmp_output;
		}

		function vw_insert_custom_fields( &$tmp_output, $item, $depth ) {
			// Find the position for insertion
			$insert_pos = $this->vw_find_insertion_position( $tmp_output );
			if ( false === $insert_pos ) return;

			// Get custom fields html
			$custom_fields_html = apply_filters( 'vw_filter_mega_menu_edit_custom_field', $item, $depth );
			if ( ! is_string( $custom_fields_html ) || empty( $custom_fields_html ) ) return;

			// Insert them
			$tmp_output = substr($tmp_output, 0, $insert_pos) . $custom_fields_html . substr($tmp_output, $insert_pos);
		}

		function vw_find_insertion_position( &$tmp_output ) {
			return strpos( $tmp_output, $this->vw_insert_point_str );
		}
	}
}