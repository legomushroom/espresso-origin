<?php

/**
 * Add wrapper to sidebars
 */
if ( ! is_admin() ) {
	/* add this only frontend to prevent a problem of widget lost when saving widget */
	add_action( 'dynamic_sidebar_before', 'vwssb_dynamic_sidebar_before' );
	add_action( 'dynamic_sidebar_after', 'vwssb_dynamic_sidebar_after' );
}

if ( ! function_exists( 'vwssb_dynamic_sidebar_before' ) ) {
	function vwssb_dynamic_sidebar_before() {
		echo '<div class="vw-sticky-sidebar-wrapper">';
		echo '<div class="vw-sticky-sidebar">';
	}
}

if ( ! function_exists( 'vwssb_dynamic_sidebar_after' ) ) {
	function vwssb_dynamic_sidebar_after() {
		echo '</div>';
		echo '</div>';
	}
}