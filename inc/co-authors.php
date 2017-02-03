<?php
/* -----------------------------------------------------------------------------
 * Co-Authors Plus Support
 * https://wordpress.org/plugins/co-authors-plus/
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_has_coauthors' ) ) {
	function vw_has_coauthors() {
		return defined( 'COAUTHORS_PLUS_VERSION' );
	}
}