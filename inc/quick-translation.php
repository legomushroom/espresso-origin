<?php

/* -----------------------------------------------------------------------------
 * Quick Translation
 * -------------------------------------------------------------------------- */
add_action( 'after_setup_theme', 'vw_init_quick_translation' );
if ( ! function_exists( 'vw_init_quick_translation' ) ) {
	function vw_init_quick_translation() {
		if ( vw_get_theme_option( 'enable_quick_translation' ) ) {
			add_filter( 'gettext', 'vw_quick_translation', 20, 3 );
			
		}
	}
}

if ( ! function_exists( 'vw_quick_translation' ) ) {
	function vw_quick_translation( $translated_text, $text, $domain ) {
		// No custom translate for other text domain
		if ( 'envirra' != $domain ) return $translated_text;

		$user_translated_text = vw_get_theme_option( sprintf( '_translate__%s', $text ) );

		if ( ! empty( $user_translated_text ) ) {
			return $user_translated_text;

		} else {
			return $translated_text;
			
		}
	}
}