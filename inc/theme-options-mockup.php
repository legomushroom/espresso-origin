<?php
/* -----------------------------------------------------------------------------
 * This file will be loaded only ReduxFramework is not activated
 * To show instruction for installing of required plugins
 * -------------------------------------------------------------------------- */
/** Step 2 (from text above). */
add_action( 'admin_menu', 'vw_theme_options_mockup_menu' );

/** Step 1. */
function vw_theme_options_mockup_menu() {
	add_menu_page( 'My Plugin Options', 'Theme Options', 'manage_options', '_options', 'vw_theme_option_mockup_content' );
}

/** Step 3. */
function vw_theme_option_mockup_content() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

	?>
		<div class="wrap">
			<h2>Theme options panel is not enabled</h2>
			<p>Please <strong><u>install required plugins</u></strong> and <strong><u>activate them</u></strong> to enable theme options panel.</p>

			<div class="popular-tags">
				<p><img src="http://envirra.com/themes/sprout/document/img/install-required-plugins.png" alt=""></p>
			</div>

		</div>
	<?php
}