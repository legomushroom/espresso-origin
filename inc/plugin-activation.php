<?php
require_once get_template_directory().'/components/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'vw_register_required_plugins' );
if ( ! function_exists( 'vw_register_required_plugins' ) ) {
	function vw_register_required_plugins() {

		$plugins = array(

			// This is an example of how to include a plugin pre-packaged with a theme
			// array(
			// 	'name'               => 'TGM Example Plugin', // The plugin name.
			// 	'slug'               => 'tgm-example-plugin', // The plugin slug (typically the folder name).
			// 	'source'             => get_stylesheet_directory() . '/lib/plugins/tgm-example-plugin.zip', // The plugin source.
			// 	'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			// 	'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
			// 	'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			// 	'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			// 	'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			// ),

			array(
				'name' => 'ESPRESSO Theme Options Panel',
				'slug' => 'espresso-theme-options-panel',
				'required' => true,
				'version' => '1.3.0',
				'source' => get_template_directory_uri().'/plugins/espresso-theme-options-panel.zip',
			),

			array(
				'name' => 'ESPRESSO Shortcodes',
				'slug' => 'espresso-shortcodes',
				'required' => true,
				'version' => '1.0.0',
				'source' => get_template_directory_uri().'/plugins/espresso-shortcodes.zip',
			),

		);

		tgmpa( $plugins, array(
			'is_automatic' => true,
			'strings' => array(
				'notice_ask_to_update' => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s. <br>Please delete the plugin and re-install.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s. <br>Please delete the plugins listed above and re-install.', 'envirra' ), // %1$s = plugin name(s).
			),
		) );
	}
}