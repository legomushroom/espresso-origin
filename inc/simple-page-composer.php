<?php

/* -----------------------------------------------------------------------------
 * Include The Simple Page Composer
 * -------------------------------------------------------------------------- */
require_once( get_template_directory().'/components/simple-page-composer/simple-page-composer.php' );

/* -----------------------------------------------------------------------------
 * Section Settings
 * -------------------------------------------------------------------------- */
add_filter( 'vwspc_filter_init_sections', 'vw_init_spc_sections' );
if ( ! function_exists( 'vw_init_spc_sections' ) ) {
	function vw_init_spc_sections( $available_sections ) {
		$sections = array(
			'post_box' => array(
				'title' =>'Post Box',
				'options' => array(
					'title' => array(
						'title' => 'Title',
						'description' => 'Enter the title',
						'field' => 'text',
						'default' => '',
					),
					'number' => array(
						'title' => 'Number of post',
						'description' => 'Enter the number',
						'field' => 'number',
						'default' => 5,
					),
					'offset' => array(
						'title' => 'Post Offset',
						'description' => 'Enter the number of the first posts to be skipped',
						'field' => 'number',
						'default' => 0,
					),
					'category' => array(
						'title' => 'Category',
						'description' => 'Choose a post category to be shown up',
						'field' => 'category_with_all_option',
						'default' => '0',
					),
					'exclude_categories' => array(
						'title' => 'Exclude Categories',
						'description' => 'Choose the post categories to be excluded',
						'field' => 'categories',
						'default' => '',
					),
					'posts_order' => array(
						'title' => 'Posts Order',
						'description' => 'Choose the post s ordering',
						'field' => 'select',
						'default' => 'latest_posts',
						'options' => array(
							'latest_posts' => 'Latest Posts',
							'latest_gallery_posts' => 'Latest Gallery Posts',
							'latest_video_posts' => 'Latest Video Posts',
							'latest_audio_posts' => 'Latest Audio Posts',
							'latest_featured' => 'Latest Featured Posts',
							'latest_reviews' => 'Latest Reviews',
							'most_viewed' => 'Most Viewed',
							'most_review_scores' => 'Most Review Scores',
						),
					),
					'layout' => array(
						'title' => 'Layout',
						'description' => 'Choose the post box layout (Only 3-columns layout will be shown)',
						'field' => 'select',
						'default' => 'classic',
						'options' => array(
							'small-left-thumbnail-col-3' => 'Small-left Thumbnail',
							'medium-1-col-3' => 'Medium Thumbnail 1',
							'medium-2-col-3' => 'Medium Thumbnail 2',
							'medium-3-col-3' => 'Medium Thumbnail 3',
							'medium-4-col-3' => 'Medium Thumbnail 4',
							'medium-5-col-3' => 'Medium Thumbnail 5',
							'slider-large-carousel' => 'Large Carousel',
							'mix-1-col-3' => 'Mixed Layout 1',
							'mix-2-col-3' => 'Mixed Layout 2',
							'mix-3-col-3' => 'Mixed Layout 3',
							'custom-1' => 'Custom 1',
							'custom-2' => 'Custom 2',
							'custom-3' => 'Custom 3',
							'custom-4' => 'Custom 4',
						),
					),
					'pagination' => array(
						'title' => 'Pagination',
						'description' => 'Show pagination',
						'field' => 'select',
						'default' => 'hide',
						'options' => array(
							'show' => 'Show',
							'hide' => 'Hide',
						),
					),
				),
			),

			'post_box_sidebar' => array(
				'title' =>'Post Box with Sidebar',
				'options' => array(
					'title' => array(
						'title' => 'Title',
						'description' => 'Enter the title',
						'field' => 'text',
						'default' => '',
					),
					'number' => array(
						'title' => 'Number of post',
						'description' => 'Enter the number',
						'field' => 'number',
						'default' => 5,
					),
					'offset' => array(
						'title' => 'Post Offset',
						'description' => 'Enter the number of the first posts to be skipped',
						'field' => 'number',
						'default' => 0,
					),
					'category' => array(
						'title' => 'Category',
						'description' => 'Choose a post category to be shown up',
						'field' => 'category_with_all_option',
						'default' => '0',
					),
					'exclude_categories' => array(
						'title' => 'Exclude Categories',
						'description' => 'Choose the post categories to be excluded',
						'field' => 'categories',
						'default' => '',
					),
					'posts_order' => array(
						'title' => 'Posts Order',
						'description' => 'Choose the post s ordering',
						'field' => 'select',
						'default' => 'latest_posts',
						'options' => array(
							'latest_posts' => 'Latest Posts',
							'latest_gallery_posts' => 'Latest Gallery Posts',
							'latest_video_posts' => 'Latest Video Posts',
							'latest_audio_posts' => 'Latest Audio Posts',
							'latest_featured' => 'Latest Featured Posts',
							'latest_reviews' => 'Latest Reviews',
							'most_viewed' => 'Most Viewed',
							'most_review_scores' => 'Most Review Scores',
						),
					),
					'layout' => array(
						'title' => 'Layout',
						'description' => 'Choose the post box layout',
						'field' => 'select',
						'default' => 'large',
						'options' => array(
							'small-top-thumbnail-col-4' => 'Small-top Thumbnail',
							'medium-1-col-2' => 'Medium Thumbnail 1',
							'medium-2-col-2' => 'Medium Thumbnail 2',
							'medium-3-col-2' => 'Medium Thumbnail 3',
							'medium-4-col-2' => 'Medium Thumbnail 4',
							'medium-5-col-2' => 'Medium Thumbnail 5',
							'medium-6-col-1' => 'Medium Thumbnail 6',
							'large' => 'Large Thumbnail',
							'slider-large-carousel' => 'Large Carousel',
							'slider-medium' => 'Medium Slider',
							'mix-1-col-2' => 'Mixed Layout 1',
							'mix-2-col-2' => 'Mixed Layout 2',
							'mix-3-col-2' => 'Mixed Layout 3',
							'custom-1' => 'Custom 1',
							'custom-2' => 'Custom 2',
							'custom-3' => 'Custom 3',
							'custom-4' => 'Custom 4',
						),
					),
					'pagination' => array(
						'title' => 'Pagination',
						'description' => 'Show pagination',
						'field' => 'select',
						'default' => 'hide',
						'options' => array(
							'show' => 'Show',
							'hide' => 'Hide',
						),
					),
					'sidebar' => array(
						'title' => 'Sidebar',
						'description' => 'Choose a sidebar to be shown up',
						'field' => 'sidebar',
						'default' => '0',
					),
				),
			),

			'post_slider' => array(
				'title' => 'Post Slider',
				'options' => array(
					'number' => array(
						'title' => 'Number of slide',
						'description' => 'Enter the number',
						'field' => 'number',
						'default' => 3,
					),
					'category' => array(
						'title' => 'Category',
						'description' => 'Choose a post category to be shown up',
						'field' => 'category_with_all_option',
						'default' => '0',
					),
					'posts_order' => array(
						'title' => 'Posts Order',
						'description' => 'Choose the post s ordering',
						'field' => 'select',
						'default' => '0',
						'options' => array(
							'latest_posts' => 'Latest Posts',
							'latest_featured' => 'Latest Featured Posts',
							'latest_reviews' => 'Latest Reviews',
							'most_review_scores' => 'Most Review Scores',
						),
					),
				),
			),

			'full_page_link' => array(
				'title' => 'Full Page Link Section',
				'options' => array(
					'page' => array(
						'title' => 'Page',
						'description' => 'Choose the page for linking',
						'field' => 'page',
						'default' => '0',
					),
					'title' => array(
						'title' => 'Title',
						'description' => 'The section title',
						'field' => 'text',
						'default' => '',
					),
					'subtitle' => array(
						'title' => 'Subtitle',
						'description' => 'The section subtitle',
						'field' => 'text',
						'default' => '',
					),
					'button_label' => array(
						'title' => 'Button Label',
						'description' => 'The button label',
						'field' => 'text',
						'default' => '',
					),
				),
			),

			'custom_content' => array(
				'title' => 'Custom Content',
				'options' => array(
					'title' => array(
						'title' => 'Title',
						'description' => 'The section title',
						'field' => 'text',
						'default' => '',
					),
					'content' => array(
						'title' => 'Content',
						'description' => 'Enter the content (HTML is allowance)',
						'field' => 'html',
						'default' => '',
					),
					'sidebar' => array(
						'title' => 'Sidebar',
						'description' => 'Choose a sidebar to be shown up',
						'field' => 'sidebar',
						'default' => '0',
					),
				),
			),
		);

		return array_merge( $sections, $available_sections);
	}
}

/**
Renderers
 */

/* -----------------------------------------------------------------------------
 * Render Section: Post Slider
 * -------------------------------------------------------------------------- */
add_action( 'vwspc_action_render_section_post_slider', 'vw_render_spc_section_post_slider' );
if ( ! function_exists( 'vw_render_spc_section_post_slider' ) ) {
	function vw_render_spc_section_post_slider( $args ) {
		extract( $args );
		$number_of_slide = get_post_meta( $page_id, $field_prefix.'_number', true );
		$category = get_post_meta( $page_id, $field_prefix.'_category', true );
		$posts_order = get_post_meta( $page_id, $field_prefix.'_posts_order', true );

		printf( $before_section, 'post-slider-section', esc_attr( vwspc_next_section_id() ) );

		// echo '<div class="container"><div class="row"><div class="col-md-12">';
		$slider_args = array(
			'cat' => $category,
			'posts_order' => $posts_order,
			'number_of_post' => $number_of_slide,
			'template' => 'large',
		);

		vw_the_post_slider( $slider_args );
		// echo '</div></div></div>';

		echo $after_section;
	}
}

/* -----------------------------------------------------------------------------
 * Render Section: Post Box
 * -------------------------------------------------------------------------- */
add_action( 'vwspc_action_render_section_post_box', 'vw_render_spc_section_post_box' );
if ( ! function_exists( 'vw_render_spc_section_post_box' ) ) {
	function vw_render_spc_section_post_box( $args ) {
		extract( $args );
		$number_of_post = get_post_meta( $page_id, $field_prefix.'_number', true );
		$offset = intval( get_post_meta( $page_id, $field_prefix.'_offset', true ) );
		$layout = get_post_meta( $page_id, $field_prefix.'_layout', true );
		$title = get_post_meta( $page_id, $field_prefix.'_title', true );
		$category = get_post_meta( $page_id, $field_prefix.'_category', true );
		$exclude_categories = get_post_meta( $page_id, $field_prefix.'_exclude_categories', true );
		$posts_order = get_post_meta( $page_id, $field_prefix.'_posts_order', true );
		$pagination = get_post_meta( $page_id, $field_prefix.'_pagination', true );
		$paged = vw_get_paged();

		$title_class = '';
		$additional_classes = ' '; // Need a space
		$additional_classes .= 'vwspc-post-box-layout-'.$layout;

		printf( $before_section, esc_attr( 'post-box'.$additional_classes ), esc_attr( vwspc_next_section_id() ) );

		$query_args = array(
			'post_type' => 'post',
			'paged' => $paged,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'ignore_sticky_posts' => true,
			'posts_per_page' => $number_of_post,
			'meta_query' => array(),
		);

		if ( $offset > 0 ) {
			$query_args['offset'] = $offset;

			if ( $paged > 1 ) {
				// Wordpress is not support Offset on Pagination. This is a hack.
				$query_args['offset'] += ( $paged - 1 ) * $number_of_post;
			}
		}

		if ( ! empty( $category ) ) {
			$query_args['cat'] = $category;

			if ( ! empty( $title ) ) {
				$title_class .= ' '.vw_get_the_category_class( $category );
			}
		}

		if ( ! empty( $exclude_categories ) ) {
			$query_args['category__not_in'] = explode( ',', $exclude_categories );
		}

		if ( $posts_order == 'latest_posts' ) {
			// do nothing, it's a default ordering

		} elseif ( $posts_order == 'latest_gallery_posts' ) {
			$query_args['tax_query'] =  array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array( 'post-format-gallery' )
				)
			);

		} elseif ( $posts_order == 'latest_video_posts' ) {
			$query_args['tax_query'] =  array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array( 'post-format-video' )
				)
			);

		} elseif ( $posts_order == 'latest_audio_posts' ) {
			$query_args['tax_query'] =  array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array( 'post-format-audio' )
				)
			);

		} elseif ( $posts_order == 'latest_featured' ) {
			$query_args['meta_query'][] = array(
				'key' => 'vw_post_featured',
				'value' => '1',
				'compare' => '=',
			);

		} elseif ( $posts_order == 'latest_reviews' ) {
			$query_args['meta_query'][] = array(
				'key' => 'vw_enable_review',
				'value' => '1',
				'compare' => '=',
			);

		} elseif ( $posts_order == 'most_review_scores' ) {
			$query_args['orderby'] = 'meta_value_num';
			$query_args['meta_key'] = 'vw_review_average_score';
			$query_args['meta_query'][] = array(
				'key' => 'vw_enable_review',
				'value' => '1',
				'compare' => '=',
			);

		} elseif ( $posts_order == 'most_viewed' ) {
			$query_args['orderby'] = 'meta_value_num';
			$query_args['meta_key'] = 'vw_post_views_all';

		}

		if ( 'slider-carousel' == $layout ) {
			$query_args['meta_query'][] = array(
				'key' => '_thumbnail_id',
				'compare' => 'EXISTS'
			);
		}

		// ==== Begin temp query =====================================
		// $query_args['p'] = 1292;
		// $query_args['post__in'] = array( 1292, 1304 );
		// $query_args['meta_query'][] = array(
		// 	'key' => '_thumbnail_id',
		// 	'compare' => 'EXISTS'
		// );
		// ==== End temp query =====================================
		
		vw_enable_avoid_duplicate_post();
		query_posts( apply_filters( 'vw_filter_spc_post_box_query', $query_args ) );

		// $template_file = sprintf( 'templates/post-loop/loop-%s.php', $layout );

		?>
		<div class="container vwspc-section-content">
			<?php if ( ! empty ( $title ) ) : ?>
			<h2 class="vwspc-section-title"><?php printf( '<span class="%2$s">%1$s</span>', do_shortcode( esc_html( $title ) ), esc_attr( $title_class ) ); ?></h2>
			<?php endif; ?>

			<?php
			get_template_part( 'templates/post-loop/loop', $layout );
			// include( locate_template( $template_file, false, false ) );
			?>

			<?php if ( 'show' == $pagination ) vw_the_pagination(); ?>
		</div>
		<?php
		echo $after_section;
		vw_disable_avoid_duplicate_post();
		wp_reset_query();
	}
}

/* -----------------------------------------------------------------------------
 * Render Section: Post Box with Sidebar
 * -------------------------------------------------------------------------- */
add_action( 'vwspc_action_render_section_post_box_sidebar', 'vw_render_spc_section_post_box_sidebar' );
if ( ! function_exists( 'vw_render_spc_section_post_box_sidebar' ) ) {
	function vw_render_spc_section_post_box_sidebar( $args ) {
		extract( $args );
		$number_of_post = get_post_meta( $page_id, $field_prefix.'_number', true );
		$offset = intval( get_post_meta( $page_id, $field_prefix.'_offset', true ) );
		$layout = get_post_meta( $page_id, $field_prefix.'_layout', true );
		$title = get_post_meta( $page_id, $field_prefix.'_title', true );
		$category = get_post_meta( $page_id, $field_prefix.'_category', true );
		$exclude_categories = get_post_meta( $page_id, $field_prefix.'_exclude_categories', true );
		$posts_order = get_post_meta( $page_id, $field_prefix.'_posts_order', true );
		$pagination = get_post_meta( $page_id, $field_prefix.'_pagination', true );
		$sidebar = get_post_meta( $page_id, $field_prefix.'_sidebar', true );
		$paged = vw_get_paged();

		$title_class = '';
		$additional_classes = ' '; // Need a space
		$additional_classes .= 'vwspc-post-box-layout-'.$layout;

		printf( $before_section, esc_attr( 'post-box-sidebar'.$additional_classes ), esc_attr( vwspc_next_section_id() ) );

		$query_args = array(
			'post_type' => 'post',
			'paged' => $paged,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'ignore_sticky_posts' => true,
			'posts_per_page' => $number_of_post,
			'meta_query' => array(),
		);

		if ( $offset > 0 ) {
			$query_args['offset'] = $offset;

			if ( $paged > 1 ) {
				// Wordpress is not support Offset on Pagination. This is a hack.
				$query_args['offset'] += ( $paged - 1 ) * $number_of_post;
			}
		}

		if ( ! empty( $category ) ) {
			$query_args['cat'] = $category;
			
			if ( ! empty( $title ) ) {
				$title_class .= ' '.vw_get_the_category_class( $category );
			}
		}

		if ( ! empty( $exclude_categories ) ) {
			$query_args['category__not_in'] = explode( ',', $exclude_categories );
		}

		if ( $posts_order == 'latest_posts' ) {
			// do nothing, it's a default ordering

		} elseif ( $posts_order == 'latest_gallery_posts' ) {
			$query_args['tax_query'] =  array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array( 'post-format-gallery' )
				)
			);

		} elseif ( $posts_order == 'latest_video_posts' ) {
			$query_args['tax_query'] =  array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array( 'post-format-video' )
				)
			);

		} elseif ( $posts_order == 'latest_audio_posts' ) {
			$query_args['tax_query'] =  array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => array( 'post-format-audio' )
				)
			);

		} elseif ( $posts_order == 'latest_featured' ) {
			$query_args['meta_query'][] = array(
				'key' => 'vw_post_featured',
				'value' => '1',
				'compare' => '=',
			);

		} elseif ( $posts_order == 'latest_reviews' ) {
			$query_args['meta_query'][] = array(
				'key' => 'vw_enable_review',
				'value' => '1',
				'compare' => '=',
			);

		} elseif ( $posts_order == 'most_review_scores' ) {
			$query_args['orderby'] = 'meta_value_num';
			$query_args['meta_key'] = 'vw_review_average_score';
			$query_args['meta_query'][] = array(
				'key' => 'vw_enable_review',
				'value' => '1',
				'compare' => '=',
			);

		} elseif ( $posts_order == 'most_viewed' ) {
			$query_args['orderby'] = 'meta_value_num';
			$query_args['meta_key'] = 'vw_post_views_all';

		}

		// ==== Begin temp query =====================================
		// $query_args['p'] = 1292;
		// $query_args['post__in'] = array( 1292, 1304 );
		// $query_args['meta_query'][] = array(
		// 	'key' => '_thumbnail_id',
		// 	'compare' => 'EXISTS'
		// );
		// ==== End temp query =====================================
		vw_enable_avoid_duplicate_post();
		query_posts( apply_filters( 'vw_filter_spc_post_box_sidebar_query', $query_args ) );

		// $template_file = sprintf( 'templates/post-loop/loop-%s.php', $layout );

		?>
		<div class="container">

			<div class="row">
				<div class="col-md-8 vwspc-section-content">
					<?php if ( ! empty ( $title ) ) : ?>
					<h2 class="vwspc-section-title"><?php printf( '<span class="%2$s">%1$s</span>', do_shortcode( esc_html( $title ) ), esc_attr( $title_class ) ); ?></h2>
					<?php endif; ?>

					<?php
					// include( locate_template( $template_file, false, false ) );
					get_template_part( 'templates/post-loop/loop', $layout );
					?>

					<?php if ( 'show' == $pagination ) vw_the_pagination(); ?>
				</div>
				<div class="col-md-4 vwspc-section-sidebar">
					<?php dynamic_sidebar( $sidebar ); ?>
				</div>
			</div>
			
		</div>
		<?php
		echo $after_section;

		vw_disable_avoid_duplicate_post();
		wp_reset_query();
	}
}

/* -----------------------------------------------------------------------------
 * Render Section: Full Page Link
 * -------------------------------------------------------------------------- */
add_action( 'vwspc_action_render_section_full_page_link', 'vw_render_spc_section_full_page_link' );
if ( ! function_exists( 'vw_render_spc_section_full_page_link' ) ) {
	function vw_render_spc_section_full_page_link( $args ) {
		extract( $args );

		$title = get_post_meta( $page_id, $field_prefix.'_title', true );
		$subtitle = get_post_meta( $page_id, $field_prefix.'_subtitle', true );
		$button_label = get_post_meta( $page_id, $field_prefix.'_button_label', true );
		$page_id = get_post_meta( $page_id, $field_prefix.'_page', true );
		$page_url = get_permalink( $page_id );

		$featured_image_id = vw_get_featured_image_id( $page_id );
		$full_image_url = wp_get_attachment_image_src( $featured_image_id, VW_CONST_THUMBNAIL_SIZE_PAGE_TILE_BACKGROUND );

		if ( empty( $button_label ) ) {
			$button_label = __( 'VIEW', 'envirra' );
		}

		printf( $before_section, esc_attr( 'full-page-link' ), esc_attr(  vwspc_next_section_id() ) );

		?>
		<div class="vw-full-page-link-header">
			<?php if ( ! empty( $title ) ) : ?>
			<h3 class="vw-full-page-link-title">
				<a href="<?php echo esc_url( $page_url ); ?>"><?php echo do_shortcode( esc_html( $title ) ); ?></a>
			</h3>
			<?php endif; ?>

			<?php if ( ! empty( $subtitle ) ) : ?>
			<p class="vw-full-page-link-subtitle">
				<a href="<?php echo esc_url( $page_url ); ?>"><?php echo do_shortcode( esc_html( $subtitle ) ); ?></a>
			</p>
			<?php endif; ?>

			<a class="vw-button" href="<?php echo esc_url( $page_url ); ?>" rel="bookmark"><?php echo $button_label; ?></a>

			<img class="vw-full-page-link-background hidden" src="<?php echo esc_url( $full_image_url[0] ); ?>" alt="<?php echo esc_attr( $title ); ?>">
		</div>
		<?php

		echo $after_section;
	}
}

/* -----------------------------------------------------------------------------
 * Render Section: Custom Content
 * -------------------------------------------------------------------------- */
add_action( 'vwspc_action_render_section_custom_content', 'vw_render_spc_section_custom_content' );
if ( ! function_exists( 'vw_render_spc_section_custom_content' ) ) {
	function vw_render_spc_section_custom_content( $args ) {
		extract( $args );

		$title = get_post_meta( $page_id, $field_prefix.'_title', true );
		$sidebar = get_post_meta( $page_id, $field_prefix.'_sidebar', true );

		printf( $before_section, 'custom-section', vwspc_next_section_id() );
		echo '<div class="container"><div class="row">';

		if ( '0' == $sidebar ) :
		echo '<div class="col-sm-12 vwspc-content-column clearfix">';
		else :
		echo '<div class="col-md-8 vwspc-content-column clearfix">';
		endif;

		if ( ! empty( $title ) ) {
			printf( '<h3 class="vwspc-section-title">%s</h3>', '<span>'.do_shortcode( esc_html( $title ) ).'</span>' );
		}

		echo apply_filters( 'the_content', get_post_meta( $page_id, $field_prefix.'_content', true ) );
		echo '</div>';

		if ( '0' != $sidebar ) : ?>
			<div class="col-md-4 vwspc-sidebar-column">
				<aside class="vw-sidebar-wrapper">
					<div class="vw-sidebar-inner">
						<?php dynamic_sidebar( $sidebar ); ?>
					</div>
				</aside>
			</div>
		<?php
		endif;

		echo '</div></div>';

		echo $after_section;
	}
}