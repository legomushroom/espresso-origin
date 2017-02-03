<?php
/* -----------------------------------------------------------------------------
 * Constants
 * -------------------------------------------------------------------------- */
if ( ! defined( 'VW_THEME_VERSION' ) ) define( 'VW_THEME_VERSION', '1.3.6' );
if ( ! defined( 'VW_THEME_NAME' ) ) define( 'VW_THEME_NAME', 'ESPRESSO' );
if ( ! defined( 'MINUTES_IN_SECONDS' ) ) define( 'MINUTES_IN_SECONDS', 60 );

// Avatar size
if ( ! defined( 'VW_CONST_AVATAR_SIZE_SMALL' ) ) define( 'VW_CONST_AVATAR_SIZE_SMALL', 25 );
if ( ! defined( 'VW_CONST_AVATAR_SIZE_MEDIUM' ) ) define( 'VW_CONST_AVATAR_SIZE_MEDIUM', 80 );
if ( ! defined( 'VW_CONST_AVATAR_SIZE_LARGE' ) ) define( 'VW_CONST_AVATAR_SIZE_LARGE', 110 );
if ( ! defined( 'VW_CONST_AVATAR_SIZE_XLARGE' ) ) define( 'VW_CONST_AVATAR_SIZE_XLARGE', 245 );
if ( ! defined( 'VW_CONST_DISABLE_RETINA_AVATAR' ) ) define( 'VW_CONST_DISABLE_RETINA_AVATAR', true );

// Backstretch
if ( ! defined( 'VW_CONST_BACKSTRETCH_OPT_FADE' ) ) define( 'VW_CONST_BACKSTRETCH_OPT_FADE', 600 );
if ( ! defined( 'VW_CONST_BACKSTRETCH_OPT_CENTEREDX' ) ) define( 'VW_CONST_BACKSTRETCH_OPT_CENTEREDX', 'true' ); // True/False must be a string
if ( ! defined( 'VW_CONST_BACKSTRETCH_OPT_CENTEREDY' ) ) define( 'VW_CONST_BACKSTRETCH_OPT_CENTEREDY', 'true' ); // True/False must be a string
if ( ! defined( 'VW_CONST_BACKSTRETCH_OPT_DURATION' ) ) define( 'VW_CONST_BACKSTRETCH_OPT_DURATION', 5000 );

// Configuration
if ( ! defined( 'VW_CONST_LOAD_ALL_HEADER_GOOGLE_FONT_STYLES' ) ) define( 'VW_CONST_LOAD_ALL_HEADER_GOOGLE_FONT_STYLES', true );
if ( ! defined( 'VW_CONST_LOAD_ALL_BODY_GOOGLE_FONT_STYLES' ) ) define( 'VW_CONST_LOAD_ALL_BODY_GOOGLE_FONT_STYLES', true );
if ( ! defined( 'VW_CONST_PAGINATE_LINKS_END_SIZE' ) ) define( 'VW_CONST_PAGINATE_LINKS_END_SIZE', 1 );
if ( ! defined( 'VW_CONST_PAGINATE_LINKS_MID_SIZE' ) ) define( 'VW_CONST_PAGINATE_LINKS_MID_SIZE', 3 );
if ( ! defined( 'VW_CONST_WIDGET_COMMENT_EXCERPT_LENGTH' ) ) define( 'VW_CONST_WIDGET_COMMENT_EXCERPT_LENGTH', 30 );
if ( ! defined( 'VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER' ) ) define( 'VW_CONST_ENQUEUE_SCRIPTS_ON_FOOTER', true );

// Thumbnail size
if ( ! defined( 'VW_CONST_THUMBNAIL_SIZE_POST_SMALL_TOP_THUMBNAIL' ) ) define( 'VW_CONST_THUMBNAIL_SIZE_POST_SMALL_TOP_THUMBNAIL', 'vw_one_six_thumbnail' );
if ( ! defined( 'VW_CONST_THUMBNAIL_SIZE_POST_SMALL_LEFT_THUMBNAIL' ) ) define( 'VW_CONST_THUMBNAIL_SIZE_POST_SMALL_LEFT_THUMBNAIL', 'vw_small_thumbnail' );
if ( ! defined( 'VW_CONST_THUMBNAIL_SIZE_POST_SLIDER_SMALL' ) ) define( 'VW_CONST_THUMBNAIL_SIZE_POST_SLIDER_SMALL', 'vw_one_third_thumbnail' );
if ( ! defined( 'VW_CONST_THUMBNAIL_SIZE_POST_SLIDER_MEDIUM' ) ) define( 'VW_CONST_THUMBNAIL_SIZE_POST_SLIDER_MEDIUM', 'vw_two_third_thumbnail' );
if ( ! defined( 'VW_CONST_THUMBNAIL_SIZE_POST_SLIDER_MEDIUM_2' ) ) define( 'VW_CONST_THUMBNAIL_SIZE_POST_SLIDER_MEDIUM_2', 'vw_one_half_thumbnail' );
if ( ! defined( 'VW_CONST_THUMBNAIL_SIZE_POST_SLIDER_LARGE' ) ) define( 'VW_CONST_THUMBNAIL_SIZE_POST_SLIDER_LARGE', 'vw_full_width_thumbnail' );
if ( ! defined( 'VW_CONST_THUMBNAIL_SIZE_POST_SLIDER_LARGE_CAROUSEL' ) ) define( 'VW_CONST_THUMBNAIL_SIZE_POST_SLIDER_LARGE_CAROUSEL', 'vw_one_third_thumbnail' );
if ( ! defined( 'VW_CONST_THUMBNAIL_SIZE_PAGE_TILE_BACKGROUND' ) ) define( 'VW_CONST_THUMBNAIL_SIZE_PAGE_TILE_BACKGROUND', 'vw_full_width_thumbnail' );
if ( ! defined( 'VW_CONST_THUMBNAIL_SIZE_INSTANT_SEARCH' ) ) define( 'VW_CONST_THUMBNAIL_SIZE_INSTANT_SEARCH', 'vw_small_thumbnail' );
if ( ! defined( 'VW_CONST_THUMBNAIL_SIZE_EMBEDED_GALLERY_SLIDER' ) ) define( 'VW_CONST_THUMBNAIL_SIZE_EMBEDED_GALLERY_SLIDER', 'vw_full_width_thumbnail' );
/*new*/if ( ! defined( 'VW_CONST_THUMBNAIL_SIZE_POST_LARGE' ) ) define( 'VW_CONST_THUMBNAIL_SIZE_POST_LARGE', 'vw_two_third_thumbnail' );
/*new*/if ( ! defined( 'VW_CONST_THUMBNAIL_SIZE_POST_MEDIUM' ) ) define( 'VW_CONST_THUMBNAIL_SIZE_POST_MEDIUM', 'vw_one_third_thumbnail' );

if ( ! defined( 'VW_CONST_THUMBNAIL_SIZE_CATEGORY' ) ) define( 'VW_CONST_THUMBNAIL_SIZE_CATEGORY', 'vw_category_thumbnail' );
if ( ! defined( 'VW_CONST_THUMBNAIL_SIZE_SINGLE_POST_CLASSIC' ) ) define( 'VW_CONST_THUMBNAIL_SIZE_SINGLE_POST_CLASSIC', 'vw_two_third_thumbnail_no_crop' );
if ( ! defined( 'VW_CONST_THUMBNAIL_SIZE_CUSTOM_TILED_GALLERY' ) ) define( 'VW_CONST_THUMBNAIL_SIZE_CUSTOM_TILED_GALLERY', 'vw_two_third_thumbnail' );

// Excerpt length
if ( ! defined( 'VW_CONST_EXCERPT_LENGTH_MEDIUM_6' ) ) define( 'VW_CONST_EXCERPT_LENGTH_MEDIUM_6', 33 );

/* -----------------------------------------------------------------------------
 * Includes
 * -------------------------------------------------------------------------- */
if ( function_exists( 'vw_load_theme_options_panel' ) ) {
	vw_load_theme_options_panel();
} else if ( ! class_exists( 'ReduxFramework' ) ) {
	require_once get_template_directory().'/inc/default-theme-options.php';
	
	if ( is_admin() ) {
		require_once get_template_directory().'/inc/theme-options-mockup.php';
	}
}

require_once get_template_directory().'/components/custom-sidebar-generator.php';
require_once get_template_directory().'/components/sticky-sidebar/sticky-sidebar.php';
require_once get_template_directory().'/components/scroll-to-top.php';
require_once get_template_directory().'/components/more-articles.php';

require_once get_template_directory().'/inc/schema.org.php';
require_once get_template_directory().'/inc/setup-theme.php';
require_once get_template_directory().'/inc/theme-updater.php';
require_once get_template_directory().'/inc/facebook-open-graph.php';
require_once get_template_directory().'/inc/breaking-news.php';
require_once get_template_directory().'/inc/instant-search/instant-search.php';
// require_once get_template_directory().'/inc/post-likes/post-likes.php';
require_once get_template_directory().'/inc/review/review.php';
require_once get_template_directory().'/inc/post-views/post-views.php';
require_once get_template_directory().'/inc/post-shares/post-shares.php';
require_once get_template_directory().'/inc/user-profile-fields.php';
require_once get_template_directory().'/inc/breadcrumb.php';
require_once get_template_directory().'/inc/backstretch.php';

require_once get_template_directory().'/inc/options.php';
require_once get_template_directory().'/inc/enqueue.php';
require_once get_template_directory().'/inc/simple-page-composer.php';
require_once get_template_directory().'/inc/sidebars.php';
require_once get_template_directory().'/inc/shortcodes.php';
require_once get_template_directory().'/inc/menu/menu.php';
require_once get_template_directory().'/inc/menu/menu-walkers.php';
require_once get_template_directory().'/inc/menu/mega-menu.php';
require_once get_template_directory().'/inc/template-tags.php';
require_once get_template_directory().'/inc/custom-tiled-gallery.php';
require_once get_template_directory().'/inc/custom-font.php';
require_once get_template_directory().'/inc/custom-css.php';
// require_once get_template_directory().'/inc/quick-translation.php';

/**
 * Third-party plugins support
 */
if ( function_exists( 'is_woocommerce' ) ) require_once get_template_directory().'/inc/woocommerce.php';
if ( function_exists( 'is_bbpress' ) ) require_once get_template_directory().'/inc/bbpress.php';
if ( function_exists( 'is_buddypress' ) ) require_once get_template_directory().'/inc/buddypress.php';
require_once get_template_directory().'/inc/co-authors.php';

/**
 * Include widgets
 */
require_once get_template_directory().'/widgets/widget-author.php';
require_once get_template_directory().'/widgets/widget-author-list.php';
require_once get_template_directory().'/widgets/widget-categories.php';
require_once get_template_directory().'/widgets/widget-custom-banner.php';
require_once get_template_directory().'/widgets/widget-feedburner.php';
require_once get_template_directory().'/widgets/widget-latest-comments.php';
require_once get_template_directory().'/widgets/widget-login.php';
require_once get_template_directory().'/widgets/widget-popular-post.php';
require_once get_template_directory().'/widgets/widget-posts.php';
require_once get_template_directory().'/widgets/widget-post-tabbed.php';
require_once get_template_directory().'/widgets/widget-social-counter.php';

if ( is_admin() ) {
	// Plugin activation
	require_once get_template_directory().'/inc/plugin-activation.php';

	// Meta-box
	require_once get_template_directory().'/inc/meta-boxes.php';
	
	// Demo importer
	require_once get_template_directory().'/inc/demo-importer/demo-importer.php';

	// Advanced Custom Fields
	if( class_exists( 'acf' ) ) {

		if( ! class_exists( 'acf_field_sidebar_selector_plugin' ) ) {
			require_once get_template_directory().'/components/acf-sidebar-selector/acf-sidebar_selector.php';
		}

		if ( ! defined( 'VW_DEV_MODE' ) ) { // do not load under development mode
			if ( ! defined( 'ACF_LITE' ) ) define( 'ACF_LITE' , true );
			require_once get_template_directory().'/inc/acf-fields.php';
		}
	}
}

/* -----------------------------------------------------------------------------
 * Show the warning when there is no widget in sidebar
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_show_no_widget_warning' ) ) {
	function vw_show_no_widget_warning( $text = '' ) {
		if ( current_user_can( 'manage_options' ) ) {
			printf( '<div class="vw-no-widget-warning"><i class="icon-entypo-attention"></i> Please add widgets into <a href="%s" target="_blank">sidebar</a>.</div>', admin_url( 'widgets.php' ) );
		}
	}
}

/* -----------------------------------------------------------------------------
 * Get blog layout
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_get_blog_layout' ) ) {
	function vw_get_blog_layout() {
		$blog_layout = vw_get_theme_option( 'blog_default_layout' );

		if ( is_category() ) {
			$category_blog_layout = vw_get_category_option( vw_get_archive_category_id(), 'category_blog_layout', 'site-default' );

			if ( $category_blog_layout != 'site-default' ) {
				$blog_layout = $category_blog_layout;
			}
		}

		return $blog_layout;
	}
}

/* -----------------------------------------------------------------------------
 * Sidebar position functions
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_get_sidebar_position' ) ) {
	function vw_get_sidebar_position() {
		$sidebar_position = vw_get_theme_option( 'blog_default_sidebar_position' );

		if ( is_category() ) {
			$category_sidebar_position = vw_get_category_option( vw_get_archive_category_id(), 'vw_sidebar_position', 'default' );

			if ( $category_sidebar_position != 'default' ) {
				$sidebar_position = $category_sidebar_position;
			}

		} elseif ( is_single() || is_page() ) {
			global $post;
			$post_sidebar_position = get_post_meta( $post->ID, 'vw_sidebar_position', true );
			
			if ( $post_sidebar_position != 'default' && ! empty( $post_sidebar_position ) ) {
				$sidebar_position = $post_sidebar_position;
			}
		}

		return apply_filters( 'vw_filter_sidebar_position', $sidebar_position );
	}
}

if ( ! function_exists( 'vw_the_sidebar_position_class' ) ) {
	function vw_the_sidebar_position_class() {
		echo esc_attr( sprintf( 'vw-sidebar-position-%s', vw_get_sidebar_position() ) );
	}
}

/* -----------------------------------------------------------------------------
 * Get blog sidebar functions
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_get_left_sidebar' ) ) {
	function vw_get_left_sidebar() {
		$sidebar = vw_get_theme_option( 'blog_default_left_sidebar' );

		if ( is_category() ) {
			$category_sidebar = vw_get_category_option( vw_get_archive_category_id(), 'vw_left_sidebar' );

			if ( ! empty( $category_sidebar ) ) {
				$sidebar = $category_sidebar;
			}

		} elseif( is_single() || is_page() ) {
			global $post;
			$post_sidebar = get_post_meta( $post->ID, 'vw_left_sidebar', true );

			if ( ! empty( $post_sidebar ) ) {
				$sidebar = $post_sidebar;
			}
		}

		return apply_filters( 'vw_filter_left_sidebar', $sidebar );
	}
}

if ( ! function_exists( 'vw_get_right_sidebar' ) ) {
	function vw_get_right_sidebar() {
		$sidebar = vw_get_theme_option( 'blog_default_right_sidebar' );

		if ( is_category() ) {
			$category_sidebar = vw_get_category_option( vw_get_archive_category_id(), 'vw_right_sidebar' );

			if ( ! empty( $category_sidebar ) ) {
				$sidebar = $category_sidebar;
			}

		} elseif( is_single() || is_page() ) {
			global $post;
			$post_sidebar = get_post_meta( $post->ID, 'vw_right_sidebar', true );

			if ( ! empty( $post_sidebar ) ) {
				$sidebar = $post_sidebar;
			}
		}

		return apply_filters( 'vw_filter_right_sidebar', $sidebar );
	}
}

/* -----------------------------------------------------------------------------
 * Get Related Posts
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_get_related_posts' ) ) {
	function vw_get_related_posts( $count = 3, $post_ID = null ) {
		if ( empty( $post_ID ) ) {
			$post_ID = get_the_ID();
		}
		$args = array(
			'post__not_in' => array($post_ID),
			'posts_per_page'=> $count,
			'ignore_sticky_posts'=> 1,
			// 'meta_key' => '_thumbnail_id', //Only posts that have featured image
		);
		// Find the related posts
		$tags = wp_get_post_tags( $post_ID, array( 'fields' => 'ids' ) );
		if ( $tags ) {
			// Find the related posts by tag
			foreach( $tags as $tag ) {
				$args['tag__in'][] = $tag;
			}
		} else {
			// Find the related posts by category when no tag.
			$cats = wp_get_post_categories( $post_ID, array('fields' => 'ids') );
			if ( $cats ) {
				foreach ( $cats as $cat_ID ) {
					$args['category__in'][] = $cat_ID;
				}
			}
		}
		
		return new WP_Query( $args );
	}
}

/* -----------------------------------------------------------------------------
 * Get current author
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_get_current_author' ) ) {
	function vw_get_current_author() {
		global $post;

		if ( ! is_author() && isset( $post->post_author ) ) {
			return get_userdata( $post->post_author );

		} else {
			return (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));

		}
	}
}

/* -----------------------------------------------------------------------------
 * Get Avatar with Retina Supports
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_get_avatar' ) ) {
	function vw_get_avatar( $id_or_email, $size = '96', $default = '', $alt = false ) {
		$html = '';

		if ( defined( 'VW_CONST_DISABLE_RETINA_AVATAR' ) && VW_CONST_DISABLE_RETINA_AVATAR ) {

			$html = get_avatar( $id_or_email, $size, $default, $alt );

		} else {

			$retina_size = $size*2;
			$html = get_avatar( $id_or_email, $retina_size, $default, $alt );
			$html = str_replace( '=\''.$retina_size.'\'', '=\''.$size.'\'', $html );

		}

		// Add schema.org
		$html = str_replace( '<img ', '<img itemprop="image" ', $html );

		return $html;
	}
}

/* -----------------------------------------------------------------------------
 * Get Post Layout
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_get_post_layout' ) ) {
	function vw_get_post_layout() {
		global $post;
		$post_layout = get_post_meta( $post->ID, 'vw_post_layout', true );

		if ( 'default' == $post_layout || empty( $post_layout ) ) {
			$post_layout = vw_get_theme_option( 'post_default_layout' );
		}

		return apply_filters( 'vw_filter_post_layout', $post_layout, $post );
	}
}

/* -----------------------------------------------------------------------------
 * Render Comments
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_render_comments' ) ) {
	function vw_render_comments( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; ?>

		<li <?php comment_class(); ?> id="li-comment-<?php echo esc_attr( get_comment_ID() ); ?>">
			<div id="comment-<?php echo esc_attr( get_comment_ID() ); ?>" class="comment-body clearfix"> 

				<?php echo get_avatar($comment, $size = '100'); ?>

				<div class="comment-text">

					<div class="author">
						<div class="author-name vw-header-font"><?php comment_author_link(); ?></div>
						<div class="date">
							<?php printf(__('%1$s at %2$s', 'envirra'), get_comment_date(),  get_comment_time() ) ?><?php edit_comment_link( __( '(Edit)', 'envirra'),'  ','' ) ?>
							<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
						</div>  
					</div>

					<div class="text"><?php comment_text(); ?></div>

					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em><?php _e( 'Your comment is awaiting moderation.', 'envirra' ) ?></em>
						<br>
					<?php endif; ?>

				</div>

			</div>
		<?php
	}
}

/* -----------------------------------------------------------------------------
 * Get Archive Blog Layout
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_get_archive_blog_layout' ) ) {
	function vw_get_archive_blog_layout() {
		$blog_layout = vw_get_theme_option( 'blog_default_layout' );

		if ( is_category() ) {
			$category_blog_layout = vw_get_category_option( vw_get_archive_category_id(), 'category_blog_layout', $blog_layout );

			if ( $category_blog_layout != 'site-default' ) $blog_layout = $category_blog_layout;

		} elseif ( is_search() ) {
			$blog_layout = 'large';
		}

		return $blog_layout;
	}
}

/* -----------------------------------------------------------------------------
 * Number prefixs
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_number_prefixes' ) ) {
	function vw_number_prefixes( $number ) {
		if ( $number>1000000000 ) return round( ( $number/1000000000 ), 1 ).'B';
		elseif ( $number>1000000 ) return round( ( $number/1000000 ), 1 ).'M';
		elseif ( $number>1000 ) return round( ( $number/1000 ), 1 ).'k';
		else return number_format( intval( $number ) );
	}
}

/* -----------------------------------------------------------------------------
 * Is Caching Enabled?
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_is_caching_enabled' ) ) {
	function vw_is_caching_enabled() {
		return defined( 'WP_CACHE' ) && WP_CACHE;
	}
}

/* -----------------------------------------------------------------------------
 * Get Archive Date for Displaying on Archive Page
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_get_archive_date' ) ) {
	function vw_get_archive_date() {
		if ( is_year() ) {
			return get_the_date( _x( 'Y', 'yearly archives date format', 'envirra' ) );	

		} elseif ( is_month() ) {
			return get_the_date( _x( 'F Y', 'monthly archives date format', 'envirra' ) );

		} else {
			return get_the_date();
			
		}
	}
}

/* -----------------------------------------------------------------------------
 * Get Author Avatar
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_get_author_avatar' ) ) {
	function vw_get_author_avatar( $author = null, $size=VW_CONST_AVATAR_SIZE_LARGE ) {
		if ( ! $author ) {
			$author = vw_get_current_author();
		}

		return vw_get_avatar( get_the_author_meta( 'user_email', $author->ID ), $size, '', get_the_author_meta( 'display_name', $author->ID ) );
	}
}

/* -----------------------------------------------------------------------------
 * Build Template Path
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_build_template_path' ) ) {
	function vw_build_template_path( $slug, $name='', $format = '' ) {
		$new_name = $name;

		if ( ! empty( $format ) ) {
			$new_name .= '-'.$format;
		}
		
		return sprintf( $slug.'.php', $new_name );
	}
}

/* -----------------------------------------------------------------------------
 * Custom Walker, duplicated from Walker_Category_Checklist
 * -------------------------------------------------------------------------- */
class Vw_Walker_Category_Checklist extends Walker  {
	var $tree_type = 'category';
	var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');
	var $field_name = 'post_category';

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent<ul class='children'>\n";
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
		extract($args);
		if ( empty($taxonomy) )
			$taxonomy = 'category';

		$name = $this->field_name;

		$class = in_array( $category->term_id, $popular_cats ) ? ' class="popular-category"' : '';
		$output .= "\n<li id='".esc_attr("{$taxonomy}-{$category->term_id}")."' $class>" . '<label class="selectit"><input value="' . esc_attr( $category->term_id ) . '" type="checkbox" name="'.esc_attr($name).'[]" id="'.esc_attr( 'in-'.$taxonomy.'-' . $category->term_id ) . '"' . checked( in_array( $category->term_id, $selected_cats ), true, false ) . disabled( empty( $args['disabled'] ), false, false ) . ' /> ' . esc_html( apply_filters('the_category', $category->name )) . '</label>';
	}

	function end_el( &$output, $category, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}

	function set_field_name( $field_name ) {
		$this->field_name = $field_name;
	}
}

/* -----------------------------------------------------------------------------
 * Get current page number
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_get_paged' ) ) {
	function vw_get_paged() {
		if ( get_query_var('paged') ) { return intval( get_query_var('paged') ); }
		elseif ( get_query_var('page') ) { return intval( get_query_var('page') ); }
		else { return 1; }
	}
}

/* -----------------------------------------------------------------------------
 * Hex with opacity
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_rgba' ) ) {
	function vw_rgba( $hex, $opacity=1 ) {
		preg_match_all( '/([0-9a-f]{2})/i', $hex, $match );
		return sprintf( 'rgba(%s,%s,%s,%s)', hexdec($match[1][0]), hexdec($match[1][1]), hexdec($match[1][2]), $opacity );
	}
}

/* -----------------------------------------------------------------------------
 * Check RTL mode
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_is_rtl' ) ) {
	function vw_is_rtl() {
		return is_rtl() || vw_get_theme_option( 'site_force_enable_rtl', false );
	}
}

/* -----------------------------------------------------------------------------
 * Check any custom post type
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_is_custom_post_type' ) ) {
	function vw_is_custom_post_type( $post = NULL ) {
		$all_custom_post_types = get_post_types( array ( '_builtin' => FALSE ) );
		// there are no custom post types
		if ( empty ( $all_custom_post_types ) )
			return FALSE;

		if ( empty( $post ) ) {
			$post = get_queried_object();
		}

		$custom_types      = array_keys( $all_custom_post_types );
		$current_post_type = get_post_type( $post );

		// could not detect current type
		if ( ! $current_post_type )
			return FALSE;

		return in_array( $current_post_type, $custom_types );
	}
}

/* -----------------------------------------------------------------------------
 * Check if the current query have more post
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_have_more_post' ) ) {
	function vw_have_more_post() {
		global $wp_query;
		return $wp_query->current_post + 1 < $wp_query->post_count;
	}
}

/* -----------------------------------------------------------------------------
 * Avoid duplicate post
 * -------------------------------------------------------------------------- */
global $vw_duplicate_posts;
$vw_duplicate_posts = false; // Must be initialed as an array before using

if ( ! function_exists( 'vw_enable_avoid_duplicate_post' ) ) {
	function vw_enable_avoid_duplicate_post() {
		global $vw_duplicate_posts;
		if ( $vw_duplicate_posts !== false ) {
			add_action( 'pre_get_posts', 'vw_avoid_duplicate_post' );
			add_action( 'the_post', 'vw_do_not_duplicate_this_post' );
		}
	}
}

if ( ! function_exists( 'vw_disable_avoid_duplicate_post' ) ) {
	function vw_disable_avoid_duplicate_post() {
		global $vw_duplicate_posts;
		if ( $vw_duplicate_posts !== false ) {
			remove_action( 'pre_get_posts', 'vw_avoid_duplicate_post' );
		}
	}
}

if ( ! function_exists( 'vw_avoid_duplicate_post' ) ) {
	function vw_avoid_duplicate_post( $query ) {
		global $vw_duplicate_posts;
		$query->set( 'post__not_in', $vw_duplicate_posts );
	}
}

if ( ! function_exists( 'vw_do_not_duplicate_this_post' ) ) {
	function vw_do_not_duplicate_this_post( $post_object ) {
		global $vw_duplicate_posts;
		$vw_duplicate_posts[] = $post_object->ID;

	}
}

/* -----------------------------------------------------------------------------
 * Load Template
 * To support auto grid (just for reduce a ton of template files)
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_get_template_part' ) ) {
	function vw_get_template_part( $slug, $name = null, $params = array() ) {
		$templates = array();

		if ( vw_is_starts_with( $name, 'grid-' ) ) {

			// For grid template (auto generator)
			if ( preg_match( '|^grid-(.+)-col-([0-9])|', $name, $matches ) ) {
				$post_style = $matches[1];
				$col_size = $matches[2];
			}

			$templates[] = "{$slug}-grid.php";

		} else {

			// For normal template
			if ( isset( $name ) && ! empty( $name ) ) {
				$templates[] = "{$slug}-{$name}.php";
			}
			$templates[] = "{$slug}.php";

		}

		$_template_file = locate_template( $templates, false, false );

		/* Extract as a local variables */
		// if (is_array($wp_quer-y>query_vars)) extract($wp_query->query_vars, EXTR_SKIP);
		// extract($params, EXTR_SKIP);

		if ( ! empty( $_template_file ) ) {

			// do_action( "vw_action_before_get_template_part_{$slug}", $slug, $name );

			include( $_template_file );

			// do_action( "vw_action_after_get_template_part_{$slug}", $slug, $name );

		}
	}
}

/* -----------------------------------------------------------------------------
 * Start with
 * -------------------------------------------------------------------------- */
function vw_is_starts_with( $haystack, $needle ) {
	//Thanks for such fastest method http://stackoverflow.com/questions/834303/startswith-and-endswith-functions-in-php
    return substr($haystack, 0, strlen($needle)) === $needle;
}