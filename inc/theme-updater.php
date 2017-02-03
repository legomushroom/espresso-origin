<?php

/* -----------------------------------------------------------------------------
 * Theme Updater
 * -------------------------------------------------------------------------- */
add_action( 'after_setup_theme', 'vw_setup_theme_updater' );
if ( ! function_exists( 'vw_setup_theme_updater' ) ) {
	function vw_setup_theme_updater() {
		if ( vw_get_theme_option( 'themeforest_username' ) && vw_get_theme_option( 'themeforest_username' ) ) {
			add_filter( 'pre_set_site_transient_update_themes', 'vw_themeforest_themes_update');
		}
	}
}

function vw_themeforest_themes_update( $updates ) {
	if ( isset( $updates->checked ) ) {
		include_once get_template_directory().'/pixelentity-themes-updater/class-pixelentity-themes-updater.php';
		
		$username = vw_get_theme_option( 'themeforest_username' );
		$apikey = vw_get_theme_option( 'themeforest_api_key' );

		if ( class_exists( 'Pixelentity_Themes_Updater' ) ) {
			$updater = new Pixelentity_Themes_Updater( $username,$apikey );
			$updates = $updater->check($updates);
		}
	}
	return $updates;
}