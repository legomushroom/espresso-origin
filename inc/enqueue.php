<?php
/* -----------------------------------------------------------------------------
 * Register Theme's Scripts & Styles
 * -------------------------------------------------------------------------- */
add_action( 'wp_enqueue_scripts', 'vw_register_scripts' );
add_action( 'admin_enqueue_scripts', 'vw_register_scripts' );
if ( ! function_exists( 'vw_register_scripts' ) ) {
	function vw_register_scripts() {
		// Register only
		wp_register_script( 'vwjs-bootstrap-dropdown', get_template_directory_uri().'/js/bootstrap/bootstrap.dropdown.js', array( 'jquery' ), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );

		// Include both frontend and backend
		wp_enqueue_script( 'vwjs-fitvids', get_template_directory_uri().'/js/jquery.fitvids.js', array( 'jquery' ), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );

		if ( is_admin() ) {
			// Bootstrap for admin
			$screen = get_current_screen();
			if ( $screen->id != 'toplevel_page_theme_options' ) {
				wp_enqueue_style( 'vwcss-bootstrap-admin', get_template_directory_uri().'/components/bootstrap-admin/bootstrap.css', array(), VW_THEME_VERSION );
				wp_enqueue_script( 'vwjs-bootstrap-admin', get_template_directory_uri().'/components/bootstrap-admin/bootstrap.js', array( 'jquery' ), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );
			}

			// Libs
			wp_enqueue_style( 'vwcss-icon-entypo', get_template_directory_uri().'/components/font-icons/entypo/css/entypo.css', array(), VW_THEME_VERSION );

			// Admin scripts
			wp_enqueue_style( 'vwcss-admin', get_template_directory_uri().'/css/admin.css', array(), VW_THEME_VERSION );
			wp_enqueue_script( 'vwjs-admin', get_template_directory_uri().'/js/admin.js', array( 'jquery' ), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );

		} else {
			// Pace : Preloader
			wp_enqueue_script( 'vwjs-pace', get_template_directory_uri().'/components/pace/pace.min.js', array(), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );

			// jQuery
			wp_enqueue_script( 'jquery' );

			// Comments
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) && ! is_page_template( 'page_simple_composer.php' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}

			// Font icons
			wp_enqueue_style( 'vwcss-icon-entypo', get_template_directory_uri().'/components/font-icons/entypo/css/entypo.css', array(), VW_THEME_VERSION );
			wp_enqueue_style( 'vwcss-icon-social', get_template_directory_uri().'/components/font-icons/social-icons/css/zocial.css', array(), VW_THEME_VERSION );
			if ( vw_get_theme_option( 'icon_iconic' ) )	wp_enqueue_style( 'vwcss-icon-iconic', get_template_directory_uri().'/components/font-icons/iconic/css/iconic.css', array(), VW_THEME_VERSION );
			if ( vw_get_theme_option( 'icon_elusive' ) )	wp_enqueue_style( 'vwcss-icon-elusive', get_template_directory_uri().'/components/font-icons/elusive/css/elusive.css', array(), VW_THEME_VERSION );
			if ( vw_get_theme_option( 'icon_awesome' ) )	wp_enqueue_style( 'vwcss-icon-awesome', get_template_directory_uri().'/components/font-icons/awesome/css/awesome.css', array(), VW_THEME_VERSION );
			if ( vw_get_theme_option( 'icon_typicons' ) )	wp_enqueue_style( 'vwcss-icon-typicons', get_template_directory_uri().'/components/font-icons/typicons/css/typicons.css', array(), VW_THEME_VERSION );

			// Required Libs for ALL PAGES
			if ( vw_is_rtl() ) {
				wp_enqueue_style( 'vwcss-bootstrap-rtl', get_template_directory_uri().'/css/bootstrap-rtl.css', array(), VW_THEME_VERSION );
			} else {
				wp_enqueue_style( 'vwcss-bootstrap', get_template_directory_uri().'/css/bootstrap.css', array(), VW_THEME_VERSION );
			}
			// wp_enqueue_script( 'vwjs-bootstrap-tabs', get_template_directory_uri().'/js/bootstrap/bootstrap.tabs.js', array( 'jquery' ), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );
			wp_enqueue_script( 'vwjs-backstretch', get_template_directory_uri().'/js/jquery-backstretch/jquery.backstretch.js', array( 'jquery' ), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );
			wp_enqueue_script( 'vwjs-hoverintent', get_template_directory_uri().'/js/jquery.hoverIntent.js', array( 'jquery' ), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );
			wp_enqueue_script( 'vwjs-imagesloaded', get_template_directory_uri().'/js/imagesloaded.pkgd.js', array( 'jquery' ), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );
			wp_enqueue_script( 'vwjs-isotope', get_template_directory_uri().'/js/isotope.pkgd.min.js', array( 'jquery' ), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );
			wp_enqueue_script( 'vwjs-jquery-easing', get_template_directory_uri().'/js/jquery.easing.compatibility.js', array( 'jquery' ), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );
			wp_enqueue_script( 'vwjs-magnific-popup', get_template_directory_uri().'/js/jquery.magnific-popup.js', array( 'jquery' ), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );
			wp_enqueue_script( 'vwjs-modernizr', get_template_directory_uri().'/js/modernizr.min.js', array( 'jquery' ), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );
			wp_enqueue_script( 'vwjs-imgliquid', get_template_directory_uri().'/js/imgLiquid.js', array( 'jquery' ), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );
			wp_enqueue_script( 'vwjs-raty', get_template_directory_uri().'/js/raty/jquery.raty.js', array( 'jquery' ), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );
			wp_enqueue_script( 'vwjs-superfish', get_template_directory_uri().'/js/jquery-superfish/superfish.js', array( 'jquery' ), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );
			wp_enqueue_script( 'vwjs-tipsy', get_template_directory_uri().'/js/jquery-tipsy/jquery.tipsy.js', array( 'jquery' ), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );
			wp_enqueue_script( 'vwjs-newsticker', get_template_directory_uri().'/js/jquery.newsTicker.js', array( 'jquery' ), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );
			if ( vw_get_theme_option( 'site_enable_sticky_sidebar' ) ) wp_enqueue_script( 'vwjs-hcsticky', get_template_directory_uri().'/js/jquery-hc-sticky/jquery.hc-sticky.js', array( 'jquery' ), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );
			if ( vw_get_theme_option( 'site_enable_sticky_menu' ) ) wp_enqueue_script( 'vwjs-sticky', get_template_directory_uri().'/js/jquery.sticky.js', array( 'jquery' ), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );

			// wp_enqueue_script( 'vwjs-waypoint', get_template_directory_uri().'/js/waypoint/jquery.waypoints.js', array( 'jquery' ), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );
			// if ( defined( 'VW_DEV_MODE' ) ) wp_enqueue_script( 'vwjs-waypoint-debug', get_template_directory_uri().'/js/waypoint/waypoints.debug.js', array( 'jquery' ), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );

			wp_enqueue_script( 'vwjs-swiper', get_template_directory_uri().'/js/swiper/swiper.jquery.js', array(), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );
			
			// mmenu (off-canvas menu)
			wp_enqueue_script( 'vwjs-mmenu', get_template_directory_uri().'/js/jquery-mmenu/js/jquery.mmenu.min.all.js', array( 'jquery' ), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );
			wp_enqueue_style( 'vwcss-mmenu', get_template_directory_uri().'/js/jquery-mmenu/css/jquery.mmenu.custom.css', array(), VW_THEME_VERSION );

			// Main script
			wp_enqueue_script( 'vwjs-main', get_template_directory_uri().'/js/main.js', array( 'jquery' ), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );
			wp_localize_script( 'vwjs-main', 'vw_main_js', apply_filters( 'vw_filter_localize_main_js', array(
				'theme_path' => get_template_directory_uri(),
				'ajaxurl' => admin_url( 'admin-ajax.php' ),

				'slider_slide_duration' => vw_get_theme_option( 'slider_slide_duration' ),
				'slider_transition_speed' => vw_get_theme_option( 'slider_transition_speed' ),
			) ) );

			// Include main theme when loaded on child theme
			if ( is_child_theme() ) wp_enqueue_style( 'vwcss-theme-root', get_template_directory_uri().'/style.css', array(), VW_THEME_VERSION );

			// Main theme
			if ( vw_is_rtl() ) {
				// RTL styles
				wp_enqueue_style( 'vwcss-theme-rtl', get_template_directory_uri().'/style-rtl.css', array(), VW_THEME_VERSION );

			} else {
				// Default styles
				wp_enqueue_style( 'vwcss-theme', get_bloginfo( 'stylesheet_url' ), array(), VW_THEME_VERSION );
				
			}
		}
	}
}