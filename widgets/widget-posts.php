<?php

add_action( 'widgets_init', 'vw_widgets_init_posts' );
if ( ! function_exists( 'vw_widgets_init_posts' ) ) {
	function vw_widgets_init_posts() {
		register_widget( 'Vw_widget_posts' );
	}
}

if ( ! class_exists( 'Vw_widget_posts' ) ) {
	class Vw_widget_posts extends WP_Widget {
		private $default = array(
			'title' => '',
			'cat_ids' => array( 0 ),
			'style' => 'small-left-thumbnail-col-1',
			'count' => '5',
			'order' => 'latest',
		);

		public function __construct() {
			// widget actual processes
			parent::__construct(
		 		'vw_widget_posts', // Base ID
				VW_THEME_NAME.': Posts', // Name
				array( 'description' => 'Display posts' ) // Args
			);
		}

		function widget( $args, $instance ) {
			extract($args);

			if ( function_exists( 'icl_t' ) ) {
				$instance['title'] = icl_t( VW_THEME_NAME.' Widget', $this->id.'_title', $instance['title'] );
			}

			if ( ! empty( $instance['title'] ) ) {
				$title = apply_filters( 'widget_title', wp_kses_data( $instance['title'] ), $instance, $this->id_base);
			}
			
			$cat_ids = $instance['cat_ids'];
			$style = $instance['style'];
			$count = intval( $instance['count'] );
			$order = strip_tags( $instance['order'] );

			/**
			 * Begin render widget
			 */
			
			echo $before_widget;
			if ( $instance['title'] ) echo $before_title . $title . $after_title;

			global $post;

			$query_args = array(
				'post_type' => 'post',
				'ignore_sticky_posts' => true,
				'posts_per_page' => $count,
				'order' => 'DESC',
				// 'meta_key' => '_thumbnail_id', // DEV: Only posts that have featured image
			);

			if ( ! empty( $cat_ids ) ) {
				$query_args['cat'] = implode( ',', $cat_ids );
			}

			if ( $style == 'slider-carousel' ) {
				$query_args['meta_key'] = '_thumbnail_id'; // Only posts that have featured image
			}

			if ( $order == 'latest_posts' ) {
				// do nothing, it's a default ordering

			} elseif ( $order == 'latest_gallery_posts' ) {
				$query_args['tax_query'] =  array(
					array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => array( 'post-format-gallery' )
					)
				);

			} elseif ( $order == 'latest_video_posts' ) {
				$query_args['tax_query'] =  array(
					array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => array( 'post-format-video' )
					)
				);

			} elseif ( $order == 'latest_audio_posts' ) {
				$query_args['tax_query'] =  array(
					array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => array( 'post-format-audio' )
					)
				);

			} elseif ( $order == 'latest_featured' ) {
				$query_args['meta_query'][] = array(
					'key' => 'vw_post_featured',
					'value' => '1',
					'compare' => '=',
				);

			} elseif ( $order == 'latest_reviews' ) {
				$query_args['meta_query'][] = array(
					'key' => 'vw_enable_review',
					'value' => '1',
					'compare' => '=',
				);

			} elseif ( $order == 'most_review_scores' ) {
				$query_args['orderby'] = 'meta_value_num';
				$query_args['meta_key'] = 'vw_review_average_score';
				$query_args['meta_query'][] = array(
					'key' => 'vw_enable_review',
					'value' => '1',
					'compare' => '=',
				);

			} elseif ( $order == 'most_viewed' ) {
				$query_args['orderby'] = 'meta_value_num';
				$query_args['meta_key'] = 'vw_post_views_all';

			}

			query_posts( apply_filters( 'vw_filter_widget_posts_query', $query_args, $args['widget_id'] ) );
			
			$template_file = vw_build_template_path( 'templates/post-loop/loop-%s', $style );

			include( locate_template( $template_file, false, false ) );
			wp_reset_query();
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$new_instance = wp_parse_args( (array) $new_instance, $this->default );
			$instance['title'] = wp_kses_data( $new_instance['title'] );
			$instance['cat_ids'] = wp_kses_data( $new_instance['cat_ids'] );
			$instance['style'] = strip_tags( $new_instance['style'] );
			$instance['order'] = strip_tags( $new_instance['order'] );
			$instance['count'] = intval( $new_instance['count'] );

			if ( function_exists( 'icl_register_string' ) ) {
				icl_register_string( VW_THEME_NAME.' Widget', $this->id.'_title', $instance['title'] );
			}
			
			return $instance;
		}

		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->default );

			$title = $instance['title'];
			$cat_ids = $instance['cat_ids'];
			$style = strip_tags( $instance['style'] );
			$order = strip_tags( $instance['order'] );
			$count = intval( $instance['count'] );
			?>

			<!-- title -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">Title:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>

			<!-- categories -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('cat_ids') ); ?>">Categories:</label>
				<select class="widefat" multiple="multiple" id="<?php echo esc_attr( $this->get_field_id( 'cat_ids' ) ); ?>[]" name="<?php echo esc_attr( $this->get_field_name( 'cat_ids' ) ); ?>[]">
					<option value="0" <?php if ( in_array( 0, $cat_ids ) ) { echo ' selected="selected"' ; } ?>>(All)</option>
					<?php $categories = get_categories();
					foreach ( $categories as $category ): ?>
					<option value="<?php echo $category->cat_ID; ?>" <?php if ( in_array( $category->cat_ID , $cat_ids ) ) { echo ' selected="selected"' ; } ?>><?php echo $category->cat_name; ?></option>
					<?php endforeach; ?>
				</select>
			</p>

			<!-- style -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('style') ); ?>">Layout Style:</label>
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id('style') ); ?>" name="<?php echo esc_attr( $this->get_field_name('style') ); ?>">
					<option value="mix-3-col-1" <?php selected( $style, 'mix-3-col-1' ); ?>>Mixed Layout 3</option>
					<option value="text-no-thumbnail" <?php selected( $style, 'text-no-thumbnail' ); ?>>Text (No Thumbnail)</option>
					<option value="small-left-thumbnail-col-1" <?php selected( $style, 'small-left-thumbnail-col-1' ); ?>>Small-Left Thumbnail</option>
					<option value="slider-medium" <?php selected( $style, 'slider-medium' ); ?>>Medium Slider</option>
					<option value="slider-medium-2" <?php selected( $style, 'slider-medium-2' ); ?>>Medium Slider 2</option>
					<option value="slider-small" <?php selected( $style, 'slider-small' ); ?>>Small Slider</option>
				</select>
			</p>

			<!-- order -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('order') ); ?>">Post Order:</label>
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id('order') ); ?>" name="<?php echo esc_attr( $this->get_field_name('order') ); ?>">
					<option value="latest_posts" <?php selected( $order, 'latest_posts' ); ?>>Latest Posts</option>
					<option value="latest_gallery_posts" <?php selected( $order, 'latest_gallery_posts' ); ?>>Latest Gallery Posts</option>
					<option value="latest_video_posts" <?php selected( $order, 'latest_video_posts' ); ?>>Latest Video Posts</option>
					<option value="latest_audio_posts" <?php selected( $order, 'latest_audio_posts' ); ?>>Latest Audio Posts</option>
					<option value="latest_featured" <?php selected( $order, 'latest_featured' ); ?>>Latest Featured Posts</option>
					<option value="latest_reviews" <?php selected( $order, 'latest_reviews' ); ?>>Latest Reviews</option>
					<option value="most_viewed" <?php selected( $order, 'most_viewed' ); ?>>Most Viewed</option>
					<option value="most_review_scores" <?php selected( $order, 'most_review_scores' ); ?>>Most Reviews Scores</option>
				</select>
			</p>

			<!-- count -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('count') ); ?>">Number of posts to show:</label>
				<input id="<?php echo esc_attr( $this->get_field_id('count') ); ?>" name="<?php echo esc_attr( $this->get_field_name('count') ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>" size="3">
			</p>

			<?php
		}
	}
}