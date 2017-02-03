<?php
/* -----------------------------------------------------------------------------
 * Scroll to top button
 * -------------------------------------------------------------------------- */

add_action( 'wp_footer', 'vw_init_scroll_to_top' );
if ( ! function_exists( 'vw_init_scroll_to_top' ) ) {
	function vw_init_scroll_to_top() {
		?>
		<span class="vw-scroll-to-top"><i class="vw-icon icon-entypo-up-open"></i></span>
		<?php
	}
}