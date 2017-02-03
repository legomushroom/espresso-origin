<?php
/* -----------------------------------------------------------------------------
 * Menu Functions
 * -------------------------------------------------------------------------- */

/**
 * Add additional buttons in mobile menu
 */
if ( ! function_exists( 'vw_mobile_menu_add_buttons' ) ) {
	function vw_mobile_menu_add_buttons() {
		$content = apply_filters( 'vw_filter_add_mobile_menu_buttons', '' );
		
		if ( ! empty( $content ) ) {
			return '<li class="vw-mobile-additional-buttons">'.$content.'</li>';
		}
	}
}