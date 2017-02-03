<?php
define( 'INSTANT_SEARCH_PLUGIN_DIR', dirname( __FILE__ ) );
defined( 'INSTANT_SEARCH_PLUGIN_URL' ) || define( 'INSTANT_SEARCH_PLUGIN_URL', get_template_directory_uri().'/inc/instant-search' );

/**
 * Do search
 */
add_action( 'wp_ajax_vw_instant_search', 'vw_instant_search' );
add_action( 'wp_ajax_nopriv_vw_instant_search', 'vw_instant_search' );
if ( ! function_exists( 'vw_instant_search' ) ) {
	function vw_instant_search() {
		if (isset($_GET['s'])){
			$q = htmlspecialchars($_GET['s']);
			$q = sanitize_text_field($q);
			$q = esc_sql($q);
		}else{
			echo json_encode(apply_filters( 'instant_search_res', array() ) );
			die();
		}

		$query = array(
			// 'post_type' => apply_filters('vw_instant_search_post_type', array( 'post', 'page' ) ),
			'suppress_filters' => true,
			'update_post_term_cache' => false,
			'update_post_meta_cache' => false,
			'post_status' => 'publish',
			'order' => 'DESC',
			'orderby' => 'post_date',
			'posts_per_page' => 6,
			's' => $q
		);

		query_posts( apply_filters( 'vw_filter_instant_search_query_args', $query ));

		// Check if any posts were found.
		if ( ! have_posts() ){
			$html = '<li class="vw-instant-search-no-result">';
			$html .= '<span class="vw-instant-search-result-title">'.__( 'No result was found.', 'envirra' ).'</span>';
			$html .= '</li>';
			echo $html;
			die();
		}

		//Create an array with the results
		$html = '';
		while ( have_posts() ) { the_post();
			ob_start();
			get_template_part( 'templates/instant-search-result' );
			$html .= ob_get_clean();
		}

		$html .= '<li class="vw-instant-search-all-result">';
		$html .= '<a href="'.get_search_link().'"><span class="vw-instant-search-result-title vw-header-font">'.__( 'View all results &raquo;', 'envirra' ).'</span></a>';
		$html .= '</li>';

		echo $html;
		wp_reset_query();
		die();
	}
}

/**
 * Register scripts
 */
add_action( 'wp_enqueue_scripts', 'vw_instant_search_localize' );
if ( ! function_exists( 'vw_instant_search_localize' ) ) {
	function vw_instant_search_localize(){
		wp_enqueue_script( 'instant-search', INSTANT_SEARCH_PLUGIN_URL.'/instant-search.js', array( 'jquery' ), VW_THEME_VERSION, VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER );
		wp_localize_script( 'instant-search', 'instant_search', array(
			'blog_url' => home_url(),
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'placeholder' => __( 'Search', 'envirra' ),
		));
	}
}

/**
 * Add search icon in main menu
 */
add_filter( 'vw_filter_top_bar_right_additional_items', 'vw_instant_search_add_icon', 11 );
if ( ! function_exists( 'vw_instant_search_add_icon' ) ) {
	function vw_instant_search_add_icon( $content ) {
		ob_start();
		?>
			<a class="vw-instant-search-buton main-menu-link"><i class="vw-icon icon-entypo-search"></i></a>
		<?php

		return $content.ob_get_clean();
	}
}

add_filter( 'vw_filter_add_mobile_menu_buttons', 'vw_instant_search_add_icon_to_mobile_nav' );
if ( ! function_exists( 'vw_instant_search_add_icon_to_mobile_nav' ) ) {
	function vw_instant_search_add_icon_to_mobile_nav( $content ) {
		ob_start();
		?>
		<span class="vw-search-buton main-menu-item">
			<a class="vw-search-buton" href="<?php echo get_search_link(); ?>"><i class="vw-icon icon-iconic-search"></i></a>
		</span>
		<?php

		return $content.ob_get_clean();
	}
}