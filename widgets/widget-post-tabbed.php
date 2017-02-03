<?php

add_action( 'widgets_init', 'vw_widgets_init_post_tabbed' );
if ( ! function_exists( 'vw_widgets_init_post_tabbed' ) ) {
	function vw_widgets_init_post_tabbed() {
		register_widget( 'Vw_widget_post_tabbed' );
	}
}

if ( ! class_exists( 'Vw_widget_post_tabbed' ) ) {
	class Vw_widget_post_tabbed extends WP_Widget {
		private $default = array(
			'count' => '5',
			'order' => 'latest',
		);

		public function __construct() {
			// widget actual processes
			parent::__construct(
		 		'vw_widget_post_tabbed', // Base ID
				VW_THEME_NAME.': Popular, Recent, Comments', // Name
				array( 'description' => 'Display latest posts in a tabbed style' ) // Args
			);
		}

		function widget( $args, $instance ) {
			extract($args);

			// wp_enqueue_script( 'jquery-ui-tabs' );
			// wp_enqueue_script( 'jquery-effects-fade' );

			$count = intval( $instance['count'] );
			$order = strip_tags( $instance['order'] );

			echo $before_widget;

			global $post;
			?>

			<div class="vw-fixed-tab vw-fixed-tab-3-cols clearfix">
				<ul>
					<li><a href="#" class="vw-fixed-tab-title is-active"><i class="vw-icon icon-entypo-star"></i></a></li>
					<li><a href="#" class="vw-fixed-tab-title"><i class="vw-icon icon-entypo-clock"></i></a></li>
					<li><a href="#" class="vw-fixed-tab-title"><i class="vw-icon icon-entypo-comment"></i></a></li>
				</ul>

				<div class="vw-fixed-tab-content vw-fixed-tab-id-1 is-active">
					<?php
					$query_args = array(
						'post_type' => 'post',
						'ignore_sticky_posts' => true,
						'posts_per_page' => $count,
					);

					if ( 'liked' == $order ) {
						$query_args['orderby'] = 'meta_value_num';
						$query_args['meta_key'] = 'vw_post_likes';

					} else { // ( 'viewed' == $order )
						$query_args['orderby'] = 'meta_value_num';
						$query_args['meta_key'] = 'vw_post_views_all';

					}
					
					query_posts( apply_filters( 'vw_filter_widget_post_tabbed_query_1', $query_args ) );

					$template_file = 'templates/post-loop/loop-small-left-thumbnail-col-1.php';

					include( locate_template( $template_file, false, false ) );
					wp_reset_query();
					?>
				</div>

				<div class="vw-fixed-tab-content vw-fixed-tab-id-2">
					<?php
					$query_args = array(
						'post_type' => 'post',
						'ignore_sticky_posts' => true,
						'posts_per_page' => $count,
						// 'meta_key' => '_thumbnail_id', // DEV: Only posts that have featured image
					);

					query_posts( apply_filters( 'vw_filter_widget_post_tabbed_query_2', $query_args ) );

					$template_file = 'templates/post-loop/loop-small-left-thumbnail-col-1.php';

					include( locate_template( $template_file, false, false ) );
					wp_reset_query();
					?>
				</div>

				<div class="vw-fixed-tab-content vw-fixed-tab-id-3">
					<?php 
					$comments = get_comments( array(
						'status' => 'approve',
						'number' => $count,
					) );

					$template_file = sprintf( 'templates/post-loop/loop-small-comments.php' );

					include( locate_template( $template_file, false, false ) );
					?>
				</div>

			</div>
			<?php
			
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$new_instance = wp_parse_args( (array) $new_instance, $this->default );
			$instance['order'] = strip_tags( $new_instance['order'] );
			$instance['count'] = intval( $new_instance['count'] );
			return $instance;
		}

		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->default );

			$order = strip_tags( $instance['order'] );
			$count = intval( $instance['count'] );
			?>

			<!-- order -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('order') ); ?>">Post Order:</label>
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id('order') ); ?>" name="<?php echo esc_attr( $this->get_field_name('order') ); ?>">
					<option value="liked" <?php selected( $order, 'liked' ); ?>>Most Liked</option>
					<option value="viewed" <?php selected( $order, 'viewed' ); ?>>Most Viewed</option>
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