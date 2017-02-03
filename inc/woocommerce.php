<?php
/* -----------------------------------------------------------------------------
 * Custom WooCommerce Functions
 * -------------------------------------------------------------------------- */
/**
 * Enqueue Scripts
 */
add_action( 'wp_enqueue_scripts', 'vw_enqueue_woocommerce_script' );
if ( ! function_exists( 'vw_enqueue_woocommerce_script' ) ) {
	function vw_enqueue_woocommerce_script() {
		if ( vw_is_rtl() ) {
			// RTL styles
			wp_enqueue_style( 'vwcss-woocommerce-rtl', get_template_directory_uri().'/css/custom-woocommerce-rtl.css', array( 'vwcss-theme-rtl' ), VW_THEME_VERSION );
		} else {
			// Default styles
			wp_enqueue_style( 'vwcss-woocommerce', get_template_directory_uri().'/css/custom-woocommerce.css', array( 'vwcss-theme' ), VW_THEME_VERSION );
		}
	}
}

/**
 * Manage WooCommerce features
 */
add_action( 'after_setup_theme', 'vw_setup_woocommerce' );
if ( ! function_exists( 'vw_setup_woocommerce' ) ) {
	function vw_setup_woocommerce() {
		add_theme_support( 'woocommerce' );

		/* Remove page title */
		add_filter( 'woocommerce_show_page_title', '__return_false' );

		/* Hide archive description */
		remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
	}
}

/**
 * Remove WooCommerce style
 */
add_filter( 'woocommerce_enqueue_styles', 'vw_woocommerce_dequeue_styles' );
if ( ! function_exists( 'vw_woocommerce_dequeue_styles' ) ) {
	function vw_woocommerce_dequeue_styles( $enqueue_styles ) {
		/* Remove the gloss */
		unset( $enqueue_styles['woocommerce-general'] );
		
		/* Remove the layout */
		unset( $enqueue_styles['woocommerce-layout'] );

		/* Remove the small screen optimization */
		unset( $enqueue_styles['woocommerce-smallscreen'] );

		return $enqueue_styles;
	}
}

/**
 * Update image size for this theme
 */
add_action( 'after_switch_theme', 'vw_setup_woocommerce_image_dimensions' );
if ( ! function_exists( 'vw_setup_woocommerce_image_dimensions' ) ) {
	function vw_setup_woocommerce_image_dimensions() {
		$catalog = array(
			'width' 	=> '360',	// px
			'height'	=> '360',	// px
			'crop'		=> 1
		);
	 
		$single = array(
			'width' 	=> '750',	// px
			'height'	=> '750',	// px
			'crop'		=> 1
		);
	 
		$thumbnail = array(
			'width' 	=> '360',	// px
			'height'	=> '360',	// px
			'crop'		=> 1
		);
	 
		// Image sizes
		update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
		update_option( 'shop_single_image_size', $single ); 		// Single product image
		update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
	}
}

/**
 * Apply show breaking news option
 */
add_filter( 'vw_filter_is_enable_breaking_news', 'vw_woocommerce_is_enable_breaking_news' );
if ( ! function_exists( 'vw_woocommerce_is_enable_breaking_news' ) ) {
	function vw_woocommerce_is_enable_breaking_news( $is_enabled ) {
		if ( vw_is_woocommerce() ) {
			return vw_get_theme_option( 'woocommerce_show_breaking_news' );

		} else {
			return $is_enabled;
		}
	}
}

/**
 * Apply sidebar position option
 */
add_filter( 'vw_filter_sidebar_position', 'vw_woocommerce_sidebar_position' );
if ( ! function_exists( 'vw_woocommerce_sidebar_position' ) ) {
	function vw_woocommerce_sidebar_position( $sidebar_position ) {
		if ( vw_is_woocommerce() ) {
			if ( is_product() ) {
				$sidebar_position = vw_get_theme_option( 'woocommerce_product_default_sidebar_position' );
				
			} else {
				$woo_sidebar_position = get_post_meta( vw_get_shop_page_id(), 'vw_sidebar_position', true );

				if ( $woo_sidebar_position != 'default' && ! empty( $woo_sidebar_position ) ) {
					$sidebar_position = $woo_sidebar_position;
				}
			}
		}
		
		return $sidebar_position;
	}
}

/**
 * Apply left sidebar option
 */
add_filter( 'vw_filter_left_sidebar', 'vw_woocommerce_left_sidebar' );
if ( ! function_exists( 'vw_woocommerce_left_sidebar' ) ) {
	function vw_woocommerce_left_sidebar( $sidebar ) {
		if ( vw_is_woocommerce() ) {
			if ( is_product() ) {
				$sidebar = vw_get_theme_option( 'woocommerce_product_default_left_sidebar' );
				
			} else {
				$woo_sidebar = get_post_meta( vw_get_shop_page_id(), 'vw_left_sidebar', true );

				if ( ! empty( $woo_sidebar ) ) {
					$sidebar = $woo_sidebar;
				}
			}
		}
		
		return $sidebar;
	}
}

/**
 * Apply right sidebar option
 */
add_filter( 'vw_filter_right_sidebar', 'vw_woocommerce_right_sidebar' );
if ( ! function_exists( 'vw_woocommerce_right_sidebar' ) ) {
	function vw_woocommerce_right_sidebar( $sidebar ) {
		if ( vw_is_woocommerce() ) {
			if ( is_product() ) {
				$sidebar = vw_get_theme_option( 'woocommerce_product_default_right_sidebar' );
				
			} else {
				$woo_sidebar = get_post_meta( vw_get_shop_page_id(), 'vw_right_sidebar', true );

				if ( ! empty( $woo_sidebar ) ) {
					$sidebar = $woo_sidebar;
				}
			}
		}

		return $sidebar;
	}
}

/**
 * Change the breacrumb separater
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'vw_change_breadcrumb_delimiter' );
if ( ! function_exists( 'vw_change_breadcrumb_delimiter' ) ) {
	function vw_change_breadcrumb_delimiter( $defaults ) {
		$defaults['delimiter'] = ' <span class="breadcrumb-delimiter">/</span> ';
		$defaults['wrap_before'] = '<div class="vw-woocommerce-breadcrumb header-font" itemprop="breadcrumb">';
		$defaults['wrap_after'] = '</div>';
		$defaults['home'] = __( 'Shop', 'envirra' );

		return $defaults;
	}
}

/**
 * Change home url
 */
// add_filter( 'woocommerce_breadcrumb_home_url', 'vw_woo_get_shop_permalink' );
if ( ! function_exists( 'vw_woo_get_shop_permalink' ) ) {
	function vw_woo_get_shop_permalink() {
	    return get_permalink( vw_get_shop_page_id() );
	}
}

/**
 * Change shop columns
 */
add_filter( 'loop_shop_columns', 'vw_woo_product_columns' );
if ( ! function_exists( 'vw_woo_product_columns' ) ) {
	function vw_woo_product_columns() {
		switch ( vw_get_sidebar_position() ) {
			case 'none':
				return 4;

			case 'mini-content-right':
			case 'left-content-mini':
			case 'content-mini-right':
				return 2;
			
			default: /* left & right */
				return 3;
		}
	}
}

/**
 * Apply product per page option
 */
add_filter( 'loop_shop_per_page', 'vw_woo_setup_product_per_page' );
if ( ! function_exists( 'vw_woo_setup_product_per_page' ) ) {
	function vw_woo_setup_product_per_page() {
		return vw_get_theme_option( 'woocommerce_products_per_page' );
	}
}

/**
 * Add body classes
 */
add_filter( 'body_class', 'vw_woo_body_class_options' );
if ( ! function_exists( 'vw_woo_body_class_options' ) ) {
	function vw_woo_body_class_options( $classes ) {
		if ( is_woocommerce() ) {
			if ( is_product() ) {
				$is_enable_sidebar = vw_get_theme_option( 'woocommerce_enable_product_sidebar' );

				if ( $is_enable_sidebar ) {
					$classes[] = 'woocommerce-enable-product-sidebar';
				} else {
					$classes[] = 'woocommerce-disable-product-sidebar';
				}
			} else {
				$is_enable_sidebar = vw_get_theme_option( 'woocommerce_enable_shop_sidebar' );

				if ( $is_enable_sidebar ) {
					$classes[] = 'woocommerce-enable-shop-sidebar';
				} else {
					$classes[] = 'woocommerce-disable-shop-sidebar';
				}
			}
		}

		return $classes;
	}
}

/* -----------------------------------------------------------------------------
 * Custom WooCommerce Functions
 * -------------------------------------------------------------------------- */

if ( ! function_exists( 'vw_has_woocommerce' ) ) {
	function vw_has_woocommerce() {
		return function_exists( 'is_woocommerce' );
	}
}

if ( ! function_exists( 'vw_is_woocommerce' ) ) {
	function vw_is_woocommerce() {
		return function_exists( 'is_woocommerce' ) && is_woocommerce();		
	}
}

if ( ! function_exists( 'vw_is_shop' ) ) {
	function vw_is_shop() {
		return function_exists( 'is_shop' ) && is_shop();
	}
}

if ( ! function_exists( 'vw_get_shop_page_id' ) ) {
	function vw_get_shop_page_id() {
		return wc_get_page_id( 'shop' );
	}
}

if ( ! function_exists( 'vw_woo_get_cart_permalink' ) ) {
	function vw_woo_get_cart_permalink() {
		global $woocommerce;
		return $woocommerce->cart->get_cart_url();
	}
}

/* -----------------------------------------------------------------------------
 * Template Tag: Cart Button
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_woo_render_cart_button' ) ) {
	function vw_woo_render_cart_button() {
		global $woocommerce;
		?>

		<a class="vw-cart-button main-menu-link" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'envirra'); ?>">
			<i class="vw-icon icon-iconic-basket"></i>
			<?php if ( $woocommerce->cart->cart_contents_count ) : ?>
				<span class="vw-cart-button-count"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
			<?php endif; ?>
		</a>

		<?php
	}
}

if ( ! function_exists( 'vw_woo_render_cart_panel' ) ) {
	function vw_woo_render_cart_panel() {
		if ( ! is_woocommerce() ) return;
		?>

		<div class="vw-cart-button-panel">
			<?php the_widget( 'WC_Widget_Cart' ); ?>
		</div>

		<?php
	}
}

add_filter( 'add_to_cart_fragments', 'vw_woo_add_cart_fragment' );
if ( ! function_exists( 'vw_woo_add_cart_fragment' ) ) {
	function vw_woo_add_cart_fragment( $fragments ) {
		global $woocommerce;
		
		ob_start();
		vw_woo_render_cart_button();
		$fragments['.vw-cart-button'] = ob_get_clean();
		
		return $fragments;
	}
}

/**
 * Add cart icon in main menu
 */
// add_filter( 'vw_filter_top_bar_right_additional_items', 'vw_woo_add_cart_icon' );
if ( ! function_exists( 'vw_woo_add_cart_icon' ) ) {
	function vw_woo_add_cart_icon( $content ) {
		ob_start();
		?>
		<span class="vw-cart-button-wrapper main-menu-item">
			<?php vw_woo_render_cart_button(); ?>
			<?php vw_woo_render_cart_panel(); ?>
		</span>

		<?php
		return $content.ob_get_clean();
	}
}

/**
 * Add cart icon in mobile menu
 */

add_filter( 'vw_filter_add_mobile_menu_buttons', 'vw_woo_add_cart_icon_to_mobile_menu' );
if ( ! function_exists( 'vw_woo_add_cart_icon_to_mobile_menu' ) ) {
	function vw_woo_add_cart_icon_to_mobile_menu() {
		if ( ! vw_has_woocommerce() ) return;
	}
}