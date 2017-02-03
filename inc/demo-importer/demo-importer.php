<?php
defined( 'VW_DEMO_IMPORT_PATH' ) || define( 'VW_DEMO_IMPORT_PATH', get_template_directory().'/inc/demo-importer' );
defined( 'VW_DEMO_IMPORT_SAMPLE_HOME' ) || define( 'VW_DEMO_IMPORT_SAMPLE_HOME', 'Sample Home' );
defined( 'VW_DEMO_IMPORT_SAMPLE_BLOG' ) || define( 'VW_DEMO_IMPORT_SAMPLE_BLOG', 'Sample Blog' );
defined( 'VW_DEMO_IMPORT_THEME_OPTION_PAGE' ) || define( 'VW_DEMO_IMPORT_THEME_OPTION_PAGE', 'toplevel_page_vw_theme_options' );

if ( ! function_exists( 'vwdemo_import_custom_sidebars' ) ) {
	function vwdemo_import_custom_sidebars() {
		echo '<p>Import custom sidebars</p>';

		$file_path = VW_DEMO_IMPORT_PATH.'/demo-content/custom_sidebars.txt';
		if ( file_exists( $file_path ) ) {
			$sidebar_data = file_get_contents( $file_path );
			update_option( 'sbg_sidebars', unserialize( $sidebar_data ) );

			call_user_func_array( array( 'SidebarGenerator', 'init' ), array() );
		}
	}

}

if ( ! function_exists( 'vwdemo_import_widgets' ) ) {
	function vwdemo_import_widgets() {
		echo '<p>Import widgets</p>';

		$file_path = VW_DEMO_IMPORT_PATH.'/demo-content/widgets.txt';
		if ( file_exists( $file_path ) ) {
			wie_process_import_file( $file_path );
		}
	}
}

if ( ! function_exists( 'vwdemo_setup_menu' ) ) {
	function vwdemo_setup_menu() {
		$top_menu_slug = 'sample-main-menu';
		$main_menu_slug = 'sample-main-menu';
		$mobile_menu_slug = 'sample-main-menu';
		$bottom_menu_slug = 'sample-main-menu';

		$locations = get_theme_mod('nav_menu_locations');
		$all_menu = get_terms('nav_menu');

		$top_menu = get_term_by( 'slug', $top_menu_slug, 'nav_menu' );
		if ( isset( $top_menu->term_id ) ) {
			$locations['vw_menu_top'] = $top_menu->term_id;
		}

		$main_menu = get_term_by( 'slug', $main_menu_slug, 'nav_menu' );
		if ( isset( $main_menu->term_id ) ) {
			$locations['vw_menu_main'] = $main_menu->term_id;
		}

		$mobile_menu = get_term_by( 'slug', $mobile_menu_slug, 'nav_menu' );
		if ( isset( $mobile_menu->term_id ) ) {
			$locations['vw_menu_mobile'] = $mobile_menu->term_id;
		}

		$bottom_menu = get_term_by( 'slug', $bottom_menu_slug, 'nav_menu' );
		if ( isset( $bottom_menu->term_id ) ) {
			$locations['vw_menu_bottom'] = $bottom_menu->term_id;
		}

		set_theme_mod( 'nav_menu_locations', $locations );
	}
}

if ( ! function_exists( 'vwdemo_setup_homepage' ) ) {
	function vwdemo_setup_homepage() {
		$front_page = get_page_by_title( VW_DEMO_IMPORT_SAMPLE_HOME );
		if ( ! empty( $front_page ) ) {
			update_option( 'page_on_front', $front_page->ID );
		}
		
		$blog_page = get_page_by_title( VW_DEMO_IMPORT_SAMPLE_BLOG );
		if ( ! empty( $blog_page ) ) {
			update_option( 'page_for_posts', $blog_page->ID );
		}

		update_option( 'show_on_front', 'page' );
	}
}

if ( ! function_exists( 'vwdemo_setup_finish' ) ) {
	function vwdemo_setup_finish() {
		echo '<p>Import finished, Have fun!</p>';
	}
}

if ( ! function_exists( 'vwdemo_start_import' ) ) {
	function vwdemo_start_import() {
		define( 'WP_LOAD_IMPORTERS', true );

		// Load all importer functions from theme options panel plugin
		if ( function_exists( 'vw_load_importer' ) ) {
			vw_load_importer();
		}

		add_action( 'import_start', 'vwdemo_import_custom_sidebars', 91 );
		add_action( 'import_start', 'vwdemo_import_widgets', 92 );
		add_action( 'import_end', 'vwdemo_setup_menu' );
		add_action( 'import_end', 'vwdemo_setup_homepage' );
		add_action( 'import_end', 'vwdemo_setup_finish' );
		add_filter( 'http_request_args', 'vwdemo_disable_reject_unsafe_urls', 11, 2 );
		
		$wp_import = new WP_Import();
		$wp_import->fetch_attachments = $wp_import->allow_fetch_attachments();
		
		// Import
		$file_path = VW_DEMO_IMPORT_PATH.'/demo-content/demo-content.xml';
		if ( file_exists( $file_path ) ) {
			$wp_import->import( $file_path );
		}

		die();
	}
	add_action( 'wp_ajax_vwdemo_start_import', 'vwdemo_start_import' );
}

if ( ! function_exists( 'vwdemo_disable_reject_unsafe_urls' ) ) {
	function vwdemo_disable_reject_unsafe_urls( $r, $url ) {
		// add_filter( 'http_request_reject_unsafe_urls', '__return_false' );
		$r['reject_unsafe_urls'] = false;
		return $r;
	}
}

if ( ! function_exists( 'vwdemo_js' ) ) {
	function vwdemo_js( $hook_suffix ) {
		// var_dump($hook_suffix);
		if( $hook_suffix == VW_DEMO_IMPORT_THEME_OPTION_PAGE ) {
			wp_enqueue_script('jquery');
    		wp_enqueue_script('thickbox');
    		wp_enqueue_style('thickbox');

			add_action('admin_footer', 'vwdemo_footer_script');
		}
	}

	add_action('admin_enqueue_scripts', 'vwdemo_js');
}

if ( ! function_exists( 'vwdemo_footer_script' ) ) {
	function vwdemo_footer_script() {
		?>
		<script type="text/javascript">
		//<![CDATA[
		;(function( $, window, document, undefined ){
			$( ' <span>&nbsp;</span> <a id="vw_import_demo" class="thickbox button" title="Import Demo Content" href="<?php echo admin_url( 'admin-ajax.php?action=vwdemo_start_import&amp;width=full&amp;height=full' ) ?>">Import Demo</a>' ).appendTo( $( '.redux-container .redux-action_bar' ) );
			
			$( document ).ready( function ($) {
				// var template_directory = '<?php echo get_template_directory_uri() ?>';
				$( '#vw_import_demo' ).click( function( e ) {
					if ( ! confirm( 'Are you sure to import demo content? The existing content may be replaced' ) ) {
						e.stopPropagation();
						return false;
					}
				} )
			} );
		})( jQuery, window , document );
		//]]>
		</script>

		<style>
			#TB_ajaxContent { width: auto !important; height: auto !important; }
			#TB_overlay { z-index: 100 !important; }
			#TB_window { overflow: scroll; }
		</style>
		<?php
	}
}