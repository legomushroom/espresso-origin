<?php
if ( defined( 'VW_CONST_ENABLE_SHORTCODES' ) ) {
	add_action( 'after_setup_theme', 'vw_init_shortcodes' );
}

/* -----------------------------------------------------------------------------
 * Register Shortcodes
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_init_shortcodes' ) ) {
	function vw_init_shortcodes() {
		add_action( 'wp_enqueue_scripts', 'vwsc_enqueue_front_assets' );
	}
}

/* -----------------------------------------------------------------------------
 * Enqueue Front-end Assets
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vwsc_enqueue_front_assets' ) ) {
	function vwsc_enqueue_front_assets() {
		wp_enqueue_script( 'vwscjs-main', get_template_directory_uri().'/js/shortcodes.js', array(
			'jquery',
			'jquery-effects-fade',
			'jquery-ui-accordion',
			'jquery-ui-tabs',
		), VW_THEME_VERSION, true );
	}
}

/* -----------------------------------------------------------------------------
 * 404 Text
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_shortcode_404' ) ) {
	function vw_shortcode_404( $atts, $content = null ) {
		if ( empty( $content ) ) $content = '404';
		return sprintf( '<h3 class="vw-404-text">%s</h3>', $content );
	}
}

/* -----------------------------------------------------------------------------
 * Author
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_shortcode_author' ) ) {
	function vw_shortcode_author( $atts, $content = null ) {
		$defaults = array(
			'title' => '',
			'user' => '',
		);
		
		$instance = shortcode_atts( $defaults, $atts );

		$instance['user'] = strip_tags( $instance['user'] );

		if ( empty( $instance['user'] ) ) {
			global $post;
			$user = get_user_by( 'id', $post->post_author );

		} else {
			$user = get_user_by( 'login', $instance['user'] );
			
		}

		if ( empty( $user ) ) {
			$user = get_user_by( 'id', get_the_author_meta( 'ID' ) );

			if ( empty( $user ) ) { return; }
		}

		/* Start render HTML */
		ob_start();

		include( locate_template( 'templates/author-info.php', false, false ) );

		return ob_get_clean();
	}
}

/* -----------------------------------------------------------------------------
 * Accordion
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_shortcode_accordion' ) ) {
	function vw_shortcode_accordions( $atts, $content = null ) {
		global $vw_shortcode_accordions;
		$vw_shortcode_accordions = array();

		// Parse inner shortcode
		do_shortcode( $content );

		$html = "<div class='vw-accordions'>". implode( $vw_shortcode_accordions, '' ) . "</div>";
		unset( $vw_shortcode_accordions );
		return $html;
	}
}

if ( ! function_exists( 'vw_shortcode_accordion' ) ) {
	function vw_shortcode_accordion( $atts, $content = null ) {
		$defaults = array(
			'title' => 'Accordion Title',
			'icon' => '',
			'open' => 'false',
		);
		
		extract( shortcode_atts( $defaults, $atts) );

		$icon_html = '';
		if ( ! empty( $icon ) ) {
			$icon_html = "<i class='icon-".esc_attr( $icon )."'></i> ";
		}
	
		$html = '<div class="vw-accordion" data-open="'.esc_attr( $open ).'">';
		$html .= '<div class="vw-accordion-header"><span class="vw-accordion-header-text">'.$icon_html.$title.'</span></div>';
		$html .= '<div class="vw-accordion-content">'.do_shortcode( $content ).'</div>';
		$html .= '</div>';

		global $vw_shortcode_accordions;
		$vw_shortcode_accordions[] = $html;
		return $html;
	}
}

/* -----------------------------------------------------------------------------
 * Button
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_shortcode_button' ) ) {
	function vw_shortcode_button( $atts, $content = 'Submit' ) {
		$defaults = array(
			'style' => '',
			'icon' => '',
			'target' => '_self',
			'url' => '#',
			'fullwidth' => '' // true, ''
		);
		
		extract( shortcode_atts( $defaults, $atts) );

		$icon_html = '';
		if ( ! empty( $icon ) ) {
			$icon_html = " ";
			$icon_html = sprintf( '<i class="vw-icon icon-%s"></i>', esc_attr( $icon ) );
		}

		if ( $url == 'home' ) $url = get_home_url();

		$classes = '';
		if( $fullwidth == 'true' ) $classes .= ' vw-button-full-width';

		return "<a class='".esc_attr( "vw-button vw-button-{$style} {$classes}" )."' href='".esc_url( $url )."' target='".esc_attr( $target )."'>{$icon_html}{$content}</a>";
	}
}

/* -----------------------------------------------------------------------------
 * Columns / Row
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_shortcode_row' ) ) {
	function vw_shortcode_row(  $atts, $content = null ) {
		global $vw_shortcode_columns;
		$vw_shortcode_columns = array();

		// Parse inner shortcode
		do_shortcode( $content );

		$html = "<div class='vw-row-shortcode'>". implode( $vw_shortcode_columns, '' ) . "</div>";
		unset( $vw_shortcode_columns );
		return $html;
	}
}

if ( ! function_exists( 'vw_shortcode_column' ) ) {
	function vw_shortcode_column( $atts, $content = null ) {
		$defaults = array(
			'size' => '1/2', // 1/1, 1/2, 1/3, 2/3, 1/4, 3/4, 1/5, 2/5, 3/5
			'class' => ''
		);
		
		extract( shortcode_atts( $defaults, $atts ) );

		$classes = array( 'vw-column-shortcode', $class );

		if ( '1/2' == $size ) : $classes[] = 'vw-one-half';
		elseif ( '1/3' == $size ) : $classes[] = 'vw-one-third';
		elseif ( '2/3' == $size ) : $classes[] = 'vw-two-third';
		elseif ( '1/4' == $size ) : $classes[] = 'vw-one-fourth';
		elseif ( '3/4' == $size ) : $classes[] = 'vw-three-fourth';
		elseif ( '1/5' == $size ) : $classes[] = 'vw-one-fifth';
		elseif ( '2/5' == $size ) : $classes[] = 'vw-two-fifth';
		elseif ( '3/5' == $size ) : $classes[] = 'vw-three-fifth';
		endif;

		$html = sprintf( "<div class='%s'>%s</div>", esc_attr( implode( $classes, ' ' ) ), do_shortcode( $content ) );

		global $vw_shortcode_columns;
		$vw_shortcode_columns[] = $html;
		return $html;
	}
}

/* -----------------------------------------------------------------------------
 * Custom Font 1/2
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_shortcode_custom_font_1' ) ) {
	function vw_shortcode_custom_font_1(  $atts, $content = null ) {
		$html = "<span class='vw-custom-font-1'>" . do_shortcode( $content ) . "</span>";
		return $html;
	}
}

if ( ! function_exists( 'vw_shortcode_custom_font_2' ) ) {
	function vw_shortcode_custom_font_2(  $atts, $content = null ) {
		$html = "<span class='vw-custom-font-2'>" . do_shortcode( $content ) . "</span>";
		return $html;
	}
}


/* -----------------------------------------------------------------------------
 * Dropcap
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_shortcode_dropcap' ) ) {
	function vw_shortcode_dropcap( $atts, $content = null ) {
		$defaults = array(
			'style' => 'standard', // standard, circle, box
		);
		
		extract( shortcode_atts( $defaults, $atts) );

		return "<span class='vw-dropcap ".esc_attr( 'vw-dropcap-'.$style )."'>{$content}</span>";
	}
}

/* -----------------------------------------------------------------------------
 * Emphasize
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_shortcode_emphasize' ) ) {
	function vw_shortcode_emphasize( $atts, $content = null ) {
		$defaults = array(
			'color' => '',
		);
		
		extract( shortcode_atts( $defaults, $atts) );

		$style = '';
		if ( ! empty( $color ) ) {
			$color = preg_replace( "/&quot;|&#039;/", '', $color ); /* Remove html entities for widget title */
			$style .= sprintf( 'color: %s;', esc_attr( $color ) );
		}

		if ( ! empty( $style ) ) {
			$style = sprintf( 'style="%s" ', esc_attr( $style ) );
		}

		return "<em {$style}>{$content}</em>";
	}
}

/* -----------------------------------------------------------------------------
 * Gap
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_shortcode_gap' ) ) {
	function vw_shortcode_gap( $atts, $content = null ) {
		$defaults = array(
			'size' => '30',
		);
		
		extract( shortcode_atts( $defaults, $atts) );

		$style = '';
		if ( ! empty( $color ) ) {
			$color = preg_replace( "/&quot;|&#039;/", '', $color ); /* Remove html entities for widget title */
			$style .= sprintf( 'color: %s;', $color );
		}

		$style = sprintf( 'style="%s" ', esc_attr( $style ) );

		return sprintf( '<span class="vw-gap clearfix" style="margin-top: %spx"></span>', esc_attr( $size ) );
	}
}

/* -----------------------------------------------------------------------------
 * Headline
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_shortcode_headline' ) ) {
	function vw_shortcode_headline( $atts, $content = null ) {
		if ( ! empty( $content ) ) {
			echo '<div class="vw-headline">';
			echo $content;
			echo '</div>';
		}
	}
}

/* -----------------------------------------------------------------------------
 * Image
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_shortcode_image' ) ) {
	function vw_shortcode_image( $atts, $content = null ) {
		$defaults = array(
			'src' => '',
			'alt' => '',
			'width' => '',
			'height' => '',
			'link' => '',
			'newwindow' => true,
		);
		
		extract( shortcode_atts( $defaults, $atts) );

		$attrs = array();

		if ( empty( $src ) ) return;
		$attrs[] = 'src="'.esc_url( $src ).'"';
		

		if ( ! empty( $alt ) ) {
			$attrs[] = 'alt="'.esc_attr( $alt ).'"';
		}

		if ( ! empty( $width ) ) {
			$attrs[] = 'width="'.esc_attr( $width ).'"';
		}

		if ( ! empty( $height ) ) {
			$attrs[] = 'height="'.esc_attr( $height ).'"';
		}

		// Render
		$html = '<img '.implode( ' ' , $attrs ).' >';

		if ( ! empty( $link ) ) {
			$target = '';
			if ( $newwindow ) {
				$target = ' target="_blank"';
			}

			$html = '<a href="'.esc_url( $link ).'" '.$target.'>' . $html . '</a>';
		}

		return $html;
	}
}

/* -----------------------------------------------------------------------------
 * Infobox
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_shortcode_infobox' ) ) {
	function vw_shortcode_infobox( $atts, $content = null ) {
		$defaults = array(
			'title' => '',
		);
		
		extract( shortcode_atts( $defaults, $atts) );

		$title_html = '';
		if ( !empty( $title ) ) {
			$title_html = '<h3 class="vw-infobox-title"><span>'.$title.'</span></h3>';
		}

		$content_html = '';
		if ( ! empty( $content ) ) {
			$content_html = '<div class="vw-infobox-content">'.do_shortcode( $content ).'</div>';
		}

		$html = '<div class="vw-infobox"><div class="vw-infobox-inner">';
		$html .= $title_html . $content_html;
		$html .= '</div></div>';
		return $html;
	}
}

/* -----------------------------------------------------------------------------
 * List
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_shortcode_list' ) ) {
	function vw_shortcode_list( $atts, $content = null ) {
		global $vw_shortcode_list;
		$vw_shortcode_list = array();

		// Parse inner shortcode
		do_shortcode( $content );

		$html = "<ul class='vw-list-shortcode'>". implode( $vw_shortcode_list, '' ) . "</ul>";
		unset( $vw_shortcode_list );
		return $html;
	}
}

/* -----------------------------------------------------------------------------
 * List Item
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_shortcode_list_item' ) ) {
	function vw_shortcode_list_item( $atts, $content = null ) {
		$defaults = array(
			'icon' => '',
		);
		
		extract( shortcode_atts( $defaults, $atts) );

		$icon_html = '';
		if ( ! empty( $icon ) ) {
			$icon_html = "<i class='vw-icon icon-".esc_attr( $icon )."'></i> ";
		}
		$html = "<li>{$icon_html}".do_shortcode( $content )."</li>";

		global $vw_shortcode_list;
		$vw_shortcode_list[] = $html;
		return $html;
	}
}

/* -----------------------------------------------------------------------------
 * Logo
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_shortcode_logo' ) ) {
	function vw_shortcode_logo( $atts, $content = null ) {
		$defaults = array(
			'width' => '', // px
		);
		extract( shortcode_atts( $defaults, $atts) );

		$logo = vw_get_theme_option( 'logo' );
		$logo_2x = vw_get_theme_option( 'logo_2x' );

		if ( empty( $logo[ 'url' ] ) ) return;
		if ( ! empty( $width ) ) {
			$logo[ 'width' ] = $width;
		}

		ob_start();
		?>
		<div class="vw-logo-shortcode">
			<?php if ( ! empty( $logo_2x[ 'url' ] ) ): ?><img class="vw-logo-2x" src="<?php echo esc_url( $logo_2x[ 'url' ] ); ?>" width="<?php echo esc_attr( $logo[ 'width' ] ) ?>" height="<?php echo esc_attr( $logo[ 'height' ] ) ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"><?php endif; ?>
			<img class="vw-logo" src="<?php echo esc_url( $logo[ 'url' ] ); ?>" width="<?php echo esc_attr( $logo[ 'width' ] ) ?>" height="<?php echo esc_attr( $logo[ 'height' ] ) ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
		</div>
		<?php

		return ob_get_clean();
	}
}

/* -----------------------------------------------------------------------------
 * Mark
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_shortcode_mark' ) ) {
	function vw_shortcode_mark( $atts, $content = null ) {
		$defaults = array(
			'style' => 'yellow', // grey, dark, yellow
		);
		
		extract( shortcode_atts( $defaults, $atts) );

		return "<mark class='vw-mark-shortcode vw-mark-style-".esc_attr( $style )."'>".do_shortcode( $content )."</mark>";
	}
}

/* -----------------------------------------------------------------------------
 * Posts
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_shortcode_posts' ) ) {
	function vw_shortcode_posts( $atts, $content = null ) {
		global $vw_posts_shortcode_id;
		
		$defaults = array(
			'title' => '',// title
			'cat' => '',// category ID
			'cat_name' => '',// category name
			'cat_exclude' => '', // category IDs, separated by comma (,)
			'tag' => '', // tag slugs, separated by comma (,)
			'layout' => 'medium-1-col-3',
			'count' => '6',
			'offset' => '0',
			'order' => 'latest', // latest, random, popular, viewed, latest_reviews
			'pagination' => 'hide',
		);
		
		extract( shortcode_atts( $defaults, $atts) );

		global $post;

		$query_args = array(
			'post_type' => 'post',
			'ignore_sticky_posts' => true,
			'posts_per_page' => $count,
			'paged' => vw_get_paged(),
			'order' => 'DESC',
			// 'meta_key' => '_thumbnail_id', // DEV: Only posts that have featured image
		);

		// Option: offset
		if ( intval( $offset ) > 0 ) {
			$query_args['offset'] = intval( $offset );

			if ( vw_get_paged() > 1 ) {
				// Wordpress is not support Offset on Pagination. This is a hack.
				$query_args['offset'] += ( vw_get_paged() - 1 ) * $count;
			}
		}

		// Option: cat_name
		if ( ! empty( $cat_name ) ) {
			$query_args['category_name'] = $cat_name;

			if ( ! empty( $title ) ) {
				$category = get_category_by_slug( $cat_name );
				if ( ! empty( $category ) ) {
					$title = '<span class="'.esc_attr( vw_get_the_category_class( $category->term_id ) ).'">'.$title.'</span>';
				}
			}
		}

		// Option: cat
		if ( ! empty( $cat ) ) {
			$query_args['cat'] = $cat;

			if ( ! empty( $title ) ) {
				$title = '<span class="'.esc_attr( vw_get_the_category_class( $cat ) ).'">'.$title.'</span>';
			}
		}

		// Option: cat_exclude
		if ( ! empty( $cat_exclude ) ) {
			$query_args['category__not_in'] = explode( ',', $cat_exclude );
		}

		// Option: tag
		if ( ! empty( $tag ) ) {
			$query_args['tag'] = $tag;
		}

		// Option: order
		if ( 'random' == $order ) {
			$query_args['orderby'] = 'rand';
			
		} elseif ( 'featured' == $order ) {
			$query_args['meta_query'][] = array(
				'key' => 'vw_post_featured',
				'value' => '1',
				'compare' => '=',
			);
			
		} elseif ( 'latest_gallery' == $order ) {
			$query_args['tax_query'][] = array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => 'post-format-gallery',
			);

		} elseif ( 'latest_video' == $order ) {
			$query_args['tax_query'][] = array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => 'post-format-video',
			);

		} elseif ( 'latest_audio' == $order ) {
			$query_args['tax_query'][] = array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => 'post-format-audio',
			);

		} elseif ( 'latest_reviews' == $order ) {
			$query_args['meta_query'][] = array(
				'key' => 'vw_enable_review',
				'value' => '1',
				'compare' => '=',
			);

		} elseif ( 'most_viewed' == $order ) {
			$query_args['orderby'] = 'meta_value_num';
			$query_args['meta_key'] = 'vw_post_views_all';
			
		} elseif ( 'most_review_score' == $order ) {
			$query_args['orderby'] = 'meta_value_num';
			$query_args['meta_key'] = 'vw_review_average_score';

		} else { // 'latest' == $order
			$query_args['orderby'] = 'post_date';
		}

		query_posts( $query_args, $atts );

		$template_file = sprintf( 'templates/post-loop/loop-%s.php', $layout );

		ob_start();
		?>
		<div id="vw_post_shortcode_id_<?php echo esc_attr( ++$vw_posts_shortcode_id ); ?>" class="vw-post-shortcode">
			<?php if ( ! empty ( $title ) ) : ?>
			<h2 class="vw-post-shortcode-title"><?php echo $title; ?></h2>
			<?php endif; ?>

			<?php include( locate_template( $template_file, false, false ) ); ?>

			<?php if ( 'show' == $pagination ) vw_the_pagination(); ?>
		</div>
		<?php

		wp_reset_query();

		return ob_get_clean();
	}
}

/* -----------------------------------------------------------------------------
 * Pricing Table
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_shortcode_pricing_table' ) ) {
	function vw_shortcode_pricing_table( $atts, $content = null ) {
		global $vw_shortcode_pricing;
		$vw_shortcode_pricing = array();

		// Parse inner shortcode
		do_shortcode( $content );

		$html = "<div class='vw-pricing-table vw-row-shortcode'>". implode( $vw_shortcode_pricing, '' ) . "</div>";

		// Add column class
		$col_count = count( $vw_shortcode_pricing );
		$col_class = '';

		if ( 1 == $col_count ) $col_class = '';
		elseif ( 2 == $col_count ) $col_class = 'vw-one-half';
		elseif ( 3 == $col_count ) $col_class = 'vw-one-third';
		elseif ( 4 == $col_count ) $col_class = 'vw-one-fourth';
		else $col_class = 'vw-one-fifth';

		$html = str_replace( '##VW_COLUMN_SIZE##', esc_attr( $col_class ), $html );

		unset( $vw_shortcode_pricing );
		return $html;
	}
}

/* -----------------------------------------------------------------------------
 * Pricing Item
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_shortcode_pricing_item' ) ) {
	function vw_shortcode_pricing_item( $atts, $content = null ) {
		$defaults = array(
			'title' => '',
			'price' => '',
			'currency' => '$',
			'per' => '',
			'button' => '',
			'link' => '',
			'featured' => '',
		);
		
		extract( shortcode_atts( $defaults, $atts) );
		$html = '';

		ob_start();
		?>
		<div class="vw-column-shortcode ##VW_COLUMN_SIZE##">
		<div class="vw-pricing-item <?php if ( $featured ) echo esc_attr( 'vw-pricing-featured' ); ?>">
			<div class="vw-pricing-header">
				<?php if ( ! empty( $title ) ) : ?>
				<div class="vw-pricing-title"><span><?php echo $title; ?></span></div>
				<?php endif; ?>

				<div class="vw-pricing-info">
					
					<div class="vw-pricing-price">
						<?php if ( ! empty( $currency ) ) : ?>
						<div class="vw-pricing-currency"><?php echo $currency; ?></div>
						<?php endif; ?>

						<?php if ( ! empty( $price ) ) : ?>
						<span><?php echo $price; ?></span>
						<?php endif; ?>
					</div>

					<?php if ( ! empty( $per ) ) : ?>
					<div class="vw-pricing-per"><?php echo $per; ?></div>
					<?php endif; ?>
				</div>
			</div>
			<div class="vw-pricing-content">
				<?php echo do_shortcode( $content ); ?>

				<?php if ( ! empty( $button ) ) : ?>
				<div class="vw-pricing-footer clear">
					<a class="vw-button" href="<?php echo esc_url( $link ); ?>"><?php echo $button; ?></a>
				</div>
				<?php endif; ?>

			</div>
		</div>
		</div>
		<?php
		$html = ob_get_clean();

		global $vw_shortcode_pricing;
		$vw_shortcode_pricing[] = $html;
		return $html;
	}
}

/* -----------------------------------------------------------------------------
 * Quote
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_shortcode_quote' ) ) {
	function vw_shortcode_quote( $atts, $content = null ) {
		$defaults = array(
			'align' => 'left', // left, right, none
			'cite' => ''
		);
		
		extract( shortcode_atts( $defaults, $atts) );

		$align = esc_attr( $align );

		$cite_html = '';
		if ( !empty( $cite ) ) {
			$cite_html = sprintf( '<div class="vw-quote-cite">&mdash; %s</div>', $cite );
		}

		return "<div class='vw-quote ".esc_attr( 'vw-quote-align-'.$align )."'><i class='vw-quote-icon icon-iconic-quote-left'></i>".do_shortcode( $content ).$cite_html."</div>";
	}
}

/* -----------------------------------------------------------------------------
 * Site Social Icons
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_shortcode_site_social_icons' ) ) {
	function vw_shortcode_site_social_icons( $atts, $content = null ) {
		ob_start();
		echo '<span class="vw-short-code-site-social-icons">';
		vw_the_site_social_profiles();
		echo '</span>';
		return ob_get_clean();
	}
}

/* -----------------------------------------------------------------------------
 * Tabs
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_shortcode_tabs' ) ) {
	function vw_shortcode_tabs( $atts, $content = null ) {
		$defaults = array(
			'style' => 'top-tab', // top-tab, left-tab
			'align' => 'left', // Only style=sidebar / left, right
		);
		
		extract( shortcode_atts( $defaults, $atts) );

		$tabs_html = '';
		$GLOBALS['vw_tab_headers'] = '';
		$GLOBALS['vw_tab_contents'] = '';

		if ( preg_match_all( '|\[tab.*\].*\[\/tab\]|Uims', $content, $tabs, PREG_SET_ORDER ) ) {
			foreach ( $tabs as $item ) {
				do_shortcode( $item[0] );
			}
		}

		$html = '<div class="clearfix"></div>';
		$html .= '<div class="vw-tabs vw-style-'.esc_attr( $style ).'">';
		$html .= '<div class="vw-tab-titles hidden-xs clearfix">'.$GLOBALS['vw_tab_headers'].'</div>';
		$html .= $GLOBALS['vw_tab_contents'];
		$html .= '<div class="clearfix"></div>';
		$html .= '</div>';
		return $html;
	}
}

/* -----------------------------------------------------------------------------
 * Tab Item
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_shortcode_tab_item' ) ) {
	function vw_shortcode_tab_item( $atts, $content = null ) {
		$defaults = array(
			'title' => 'Tab',
			'icon' => '',
		);
		
		extract( shortcode_atts( $defaults, $atts) );

		$icon_html = '';
		if ( ! empty( $icon ) ) {
			$icon_html = "<i class='icon-".esc_attr( $icon )."'></i> ";
		}

		if ( ! isset( $GLOBALS['vw_tab_id'] ) ) {
			$GLOBALS['vw_tab_id'] = 0;
		}
		$GLOBALS['vw_tab_id']++;

		$tab_inner_html = $icon_html.$title;

		$tab_header_html = sprintf( '<a class="vw-tab-title tab-id-%1$s" href="#tab-%1$s" data-tab-id="%1$s">', $GLOBALS['vw_tab_id'] );
		$tab_header_html .= $tab_inner_html . '</a>';

		$tab_content_html = sprintf( '<a class="vw-tab-title vw-full-tab visible-xs tab-id-%1$s" href="#tab-%1$s" data-tab-id="%1$s">', $GLOBALS['vw_tab_id'] );
		$tab_content_html .= $tab_inner_html . '</a>';
		$tab_content_html .= sprintf( '<div id="tab-%1$s" class="vw-tab-content" data-tab-id="%1$s">', $GLOBALS['vw_tab_id'] ) . do_shortcode( $content ) . '</div>';

		// Return
		$GLOBALS['vw_tab_headers'] .= $tab_header_html;
		$GLOBALS['vw_tab_contents'] .= $tab_content_html;
	}
}

/* -----------------------------------------------------------------------------
 * Title
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_shortcode_title' ) ) {
	function vw_shortcode_title( $atts, $content = null ) {
		$defaults = array();
		
		extract( shortcode_atts( $defaults, $atts) );

		return "<h5 class='vw-title-shortcode'><span>" . $content . "</span></h5>";
	}
}

/* -----------------------------------------------------------------------------
 * Fix the smk sidebar (using return instead echo)
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_smk_sidebar_shortcode' ) ) {
	function vw_smk_sidebar_shortcode( $atts ) {
		extract( shortcode_atts( array(
			'name' => 'Default Sidebar',
		), $atts ) );
		ob_start();
		smk_custom_dynamic_sidebar($name);
		return ob_get_clean();
	}
}

/* -----------------------------------------------------------------------------
 * Force default width for flexmap
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_flexmap_shortcode_attrs' ) ) {
	function vw_flexmap_shortcode_attrs($attrs) {
		if ( ! isset( $attrs['width'] ) )
			$attrs['width'] = '100%';
		
		return $attrs;
	}
	add_filter('flexmap_shortcode_attrs', 'vw_flexmap_shortcode_attrs');
}

/* -----------------------------------------------------------------------------
 * Configure Shortcode Editor
 * -------------------------------------------------------------------------- */

function vw_shortcode_editor_init() {
	$button_style_options = array(
		'primary' => 'Primary',
		'black' => 'Black',
		'orange' => 'Orange',
		'red' => 'Red',
		'yellow' => 'Yellow',
		'blue' => 'Blue',
		'green' => 'Green',
		'purple' => 'Purple',
		'pink' => 'Pink',
	);

	$shortcodes = array();

	$shortcodes[ 'accordion' ] = array(
		'atts' => array(
			'title' => array(
				'title' => 'Title',
				'desc' => '',
				'default' => '',
				'type' => 'text',
			),
			'open' => array(
				'title' => 'Open',
				'desc' => 'Open this toggle by default',
				'default' => 'false',
				'type' => 'dropdown',
				'options' => array(
					'false' => 'False',
					'true' => 'True',
				),
			),
			'content' => array(
				'title' => 'Content',
				'desc' => '',
				'default' => 'Lorem ipsum',
				'type' => 'html',
				'render_as' => 'content',
			),
		),
	);

	$shortcodes[ 'posts' ] = array(
		'atts' => array(
			'title' => array(
				'title' => 'Title',
				'desc' => '',
				'default' => '',
				'type' => 'text',
			),
			'count' => array(
				'title' => 'Post Counts',
				'desc' => 'Number of post to be shown',
				'default' => '6',
				'type' => 'text',
			),
			'offset' => array(
				'title' => 'Skip posts',
				'desc' => 'Number of post to displace or pass over',
				'default' => '6',
				'type' => 'text',
			),
			'cat_name' => array(
				'title' => 'Post Category',
				'desc' => 'Slug of category',
				'default' => '',
				'type' => 'text',
			),
			'cat_exclude' => array(
				'title' => 'Exclude Categories',
				'desc' => 'ID of categories to be excluded. Separated by comma',
				'default' => '',
				'type' => 'text',
			),
			'tag' => array(
				'title' => 'Post Tagged',
				'desc' => 'Slug of tags. Separated by comma',
				'default' => '',
				'type' => 'text',
			),
			'layout' => array(
				'title' => 'Layout',
				'desc' => 'Layout of posts',
				'default' => 'medium-1-col-2',
				'type' => 'dropdown',
				'options' => array(
					'small-left-thumbnail-col-3' => 'Small-left Thumbnail',
					'small-top-thumbnail-col-4' => 'Small-top Thumbnail',
					'medium-1-col-2' => 'Medium Thumbnail 1 (2 Cols)',
					'medium-1-col-3' => 'Medium Thumbnail 1 (3 Cols)',
					'medium-2-col-2' => 'Medium Thumbnail 2 (2 Cols)',
					'medium-2-col-3' => 'Medium Thumbnail 2 (3 Cols)',
					'medium-3-col-2' => 'Medium Thumbnail 3 (2 Cols)',
					'medium-3-col-3' => 'Medium Thumbnail 3 (3 Cols)',
					'medium-4-col-2' => 'Medium Thumbnail 4 (2 Cols)',
					'medium-4-col-3' => 'Medium Thumbnail 4 (3 Cols)',
					'medium-5-col-2' => 'Medium Thumbnail 5 (2 Cols)',
					'medium-5-col-3' => 'Medium Thumbnail 5 (3 Cols)',
					'medium-6-col-1' => 'Medium Thumbnail 6 (1 Col)',
					'mix-1-col-2' => 'Mixed Layout 1 (2 Cols)',
					'mix-1-col-3' => 'Mixed Layout 1 (3 Cols)',
					'mix-2-col-2' => 'Mixed Layout 2 (2 Cols)',
					'mix-2-col-3' => 'Mixed Layout 2 (3 Cols)',
					'mix-3-col-2' => 'Mixed Layout 3 (2 Cols)',
					'mix-3-col-3' => 'Mixed Layout 3 (3 Cols)',
					'large' => 'Large Thumbnail',
					'slider-large-carousel' => 'Large Carousel',
					'slider-medium' => 'Medium Slider',
					'custom-1' => 'Custom 1',
					'custom-2' => 'Custom 2',
					'custom-3' => 'Custom 3',
					'custom-4' => 'Custom 4',
				),
			),
			'order' => array(
				'title' => 'Order',
				'desc' => 'Ordering of posts',
				'default' => 'latest',
				'type' => 'dropdown',
				'options' => array(
					'latest' => 'Latest Posts',
					'random' => 'Random Posts',
					'featured' => 'Featured Posts',
					'latest_gallery' => 'Latest Gallery Posts',
					'latest_video' => 'Latest Video Posts',
					'latest_audio' => 'Latest Audio Posts',
					'latest_reviews' => 'Latest Reviews',
					'most_viewed' => 'Most Viewed',
					'most_review_score' => 'Most Review Score',
				),
			),
			'pagination' => array(
				'title' => 'Pagination',
				'desc' => 'Show pagination',
				'default' => 'hide',
				'type' => 'dropdown',
				'options' => array(
					'show' => 'Show',
					'hide' => 'Hide',
				),
			),
		),
	);

	$shortcodes[ 'button' ] = array(
		'atts' => array(
			'label' => array(
				'title' => 'Label',
				'desc' => '',
				'default' => '',
				'type' => 'text',
				'render_as' => 'content',
			),
			'style' => array(
				'title' => 'Style',
				'desc' => '',
				'default' => 'primary',
				'type' => 'dropdown',
				'options' => $button_style_options,
			),
			'url' => array(
				'title' => 'Link to Url',
				'desc' => '',
				'default' => '',
				'type' => 'text',
			),
			'target' => array(
				'title' => 'Link Target',
				'desc' => 'The location to open link, enter "_blank" for open the link in new window',
				'default' => '_self',
				'type' => 'text',
			),
			'icon' => array(
				'title' => 'Icon',
				'desc' => '',
				'default' => '',
				'type' => 'icon',
			),
			'fullwidth' => array(
				'title' => 'Full Width',
				'desc' => 'Expand button to fit the container',
				'default' => 'false',
				'type' => 'dropdown',
				'options' => array(
					'false' => 'False',
					'true' => 'True',
				),
			),
		),
	);

	$shortcodes[ 'dropcap' ] = array(
		'atts' => array(
			'text' => array(
				'title' => 'Character',
				'desc' => 'The character to be a dropcap',
				'default' => '',
				'type' => 'text',
				'render_as' => 'content',
			),
		),
	);

	$shortcodes[ 'infobox' ] = array(
		'atts' => array(
			'title' => array(
				'title' => 'Title',
				'desc' => '',
				'default' => '',
				'type' => 'text',
			),
			'text' => array(
				'title' => 'Content',
				'desc' => '',
				'default' => '',
				'type' => 'html',
				'render_as' => 'content',
			),
		),
	);

	$shortcodes[ 'mark' ] = array(
		'atts' => array(
			'text' => array(
				'title' => 'Text',
				'desc' => 'the text to be marked',
				'default' => '',
				'type' => 'text',
				'render_as' => 'content',
			),
		),
	);

	$shortcodes[ 'quote' ] = array(
		'atts' => array(
			'text' => array(
				'title' => 'Text',
				'desc' => '',
				'default' => '',
				'type' => 'text',
				'render_as' => 'content',
			),
			'cite' => array(
				'title' => 'Cite',
				'desc' => '',
				'default' => '',
				'type' => 'text',
			),
			'align' => array(
				'title' => 'Align',
				'desc' => '',
				'default' => 'none',
				'type' => 'dropdown',
				'options' => array(
					'none' => 'None',
					'left' => 'Left',
					'right' => 'Right',
				),
			),
		),
	);

	$shortcodes[ 'title' ] = array(
		'atts' => array(
			'text' => array(
				'title' => 'Title',
				'desc' => 'The title text',
				'default' => '',
				'type' => 'text',
				'render_as' => 'content',
			),
		),
	);

	global $vwsce;
	$vwsce->register_shortcodes( $shortcodes );
}
add_action( 'vwsce_editor_init', 'vw_shortcode_editor_init' );

if ( ! function_exists( 'vwsce_theme_icon_iconic' ) ) {
	function vwsce_theme_icon_iconic( $icons ) {
		return array_merge( $icons, array(
			'icon-iconic-hash', 'icon-iconic-plus', 'icon-iconic-minus', 'icon-iconic-at', 
			'icon-iconic-pilcrow', 'icon-iconic-info', 'icon-iconic-left', 'icon-iconic-up', 
			'icon-iconic-right', 'icon-iconic-down', 'icon-iconic-undo', 'icon-iconic-exchange', 
			'icon-iconic-home', 'icon-iconic-split', 'icon-iconic-pause', 'icon-iconic-eject', 
			'icon-iconic-to-end', 'icon-iconic-to-start', 'icon-iconic-stop', 'icon-iconic-play', 
			'icon-iconic-sun-inv', 'icon-iconic-cloud', 'icon-iconic-umbrella', 'icon-iconic-star', 
			'icon-iconic-sun', 'icon-iconic-moon', 'icon-iconic-heart-empty', 'icon-iconic-heart', 
			'icon-iconic-cog', 'icon-iconic-flash', 'icon-iconic-key', 'icon-iconic-rain', 
			'icon-iconic-mail', 'icon-iconic-pencil', 'icon-iconic-pencil-neg', 'icon-iconic-pencil-alt', 
			'icon-iconic-ok', 'icon-iconic-ok-circle', 'icon-iconic-cancel', 'icon-iconic-cancel-circle', 
			'icon-iconic-help', 'icon-iconic-quote-left-alt', 'icon-iconic-quote-right-alt', 'icon-iconic-quote-left', 
			'icon-iconic-quote-right', 'icon-iconic-plus-circle', 'icon-iconic-minus-circle', 'icon-iconic-cw', 
			'icon-iconic-arrow-curved', 'icon-iconic-resize-vertical', 'icon-iconic-resize-horizontal', 'icon-iconic-play-circle2', 
			'icon-iconic-left-circle', 'icon-iconic-right-circle', 'icon-iconic-up-circle', 'icon-iconic-down-circle', 
			'icon-iconic-lock-empty', 'icon-iconic-lock-open-empty', 'icon-iconic-eye', 'icon-iconic-tag', 
			'icon-iconic-tag-empty', 'icon-iconic-download-cloud', 'icon-iconic-upload-cloud', 'icon-iconic-comment', 
			'icon-iconic-comment-inv', 'icon-iconic-comment-alt', 'icon-iconic-comment-inv-alt', 'icon-iconic-comment-alt2', 
			'icon-iconic-comment-inv-alt2', 'icon-iconic-chat', 'icon-iconic-chat-inv', 'icon-iconic-location', 
			'icon-iconic-location-inv', 'icon-iconic-location-alt', 'icon-iconic-compass', 'icon-iconic-trash', 
			'icon-iconic-trash-empty', 'icon-iconic-doc', 'icon-iconic-doc-inv', 'icon-iconic-doc-alt', 
			'icon-iconic-doc-inv-alt', 'icon-iconic-article', 'icon-iconic-article-alt', 'icon-iconic-rss', 
			'icon-iconic-rss-alt', 'icon-iconic-share', 'icon-iconic-calendar-inv', 'icon-iconic-resize-full', 
			'icon-iconic-resize-full-alt', 'icon-iconic-resize-small', 'icon-iconic-resize-small-alt', 'icon-iconic-move', 
			'icon-iconic-popup', 'icon-iconic-award-empty', 'icon-iconic-list', 'icon-iconic-list-nested', 
			'icon-iconic-bat-empty', 'icon-iconic-bat-half', 'icon-iconic-bat-full', 'icon-iconic-bat-charge', 
			'icon-iconic-equalizer', 'icon-iconic-cursor', 'icon-iconic-aperture', 'icon-iconic-aperture-alt', 
			'icon-iconic-steering-wheel', 'icon-iconic-brush', 'icon-iconic-brush-alt', 'icon-iconic-eyedropper', 
			'icon-iconic-layers', 'icon-iconic-layers-alt', 'icon-iconic-moon-inv', 'icon-iconic-chart-pie', 
			'icon-iconic-chart-pie-alt', 'icon-iconic-dial', 'icon-iconic-picture', 'icon-iconic-mic', 
			'icon-iconic-headphones', 'icon-iconic-video', 'icon-iconic-target', 'icon-iconic-award', 
			'icon-iconic-user', 'icon-iconic-lamp', 'icon-iconic-cd', 'icon-iconic-folder', 
			'icon-iconic-folder-empty', 'icon-iconic-calendar', 'icon-iconic-calendar-alt', 'icon-iconic-chart-bar', 
			'icon-iconic-pin', 'icon-iconic-attach', 'icon-iconic-book-alt', 'icon-iconic-book', 
			'icon-iconic-book-open', 'icon-iconic-upload', 'icon-iconic-download', 'icon-iconic-box', 
			'icon-iconic-mobile', 'icon-iconic-signal', 'icon-iconic-camera', 'icon-iconic-loop-alt', 
			'icon-iconic-loop', 'icon-iconic-volume-off', 'icon-iconic-volume-up', 'icon-iconic-search', 
			'icon-iconic-key-inv', 'icon-iconic-lock', 'icon-iconic-lock-open', 'icon-iconic-link', 
			'icon-iconic-wrench', 'icon-iconic-clock', 'icon-iconic-block',
		) );
	}

	add_filter( 'vwsce_icon_list', 'vwsce_theme_icon_iconic' );
}

if ( ! function_exists( 'vwsce_field_render_icon' ) ) {
	function vwsce_field_render_icon() {
		?>
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/components/font-icons/iconic/css/iconic.css">
		<?php
	}
	add_action( 'vwsce_after_build_editor', 'vwsce_field_render_icon' );
}