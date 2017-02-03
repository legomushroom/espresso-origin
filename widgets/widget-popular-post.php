<?php

add_action( 'widgets_init', 'vw_widgets_init_popular_post' );
if ( ! function_exists( 'vw_widgets_init_popular_post' ) ) {
	function vw_widgets_init_popular_post() {
		register_widget( 'Vw_widget_popular_post' );
	}
}

if ( ! class_exists( 'Vw_widget_popular_post' ) ) {
	class Vw_widget_popular_post extends WP_Widget {
		private $default = array(
			'title' => '',
			'count' => '5',
		);

		public function __construct() {
			// widget actual processes
			parent::__construct(
		 		'vw_widget_popular_post', // Base ID
				VW_THEME_NAME.': Popular Posts', // Name
				array( 'description' => 'Display popular posts in a tabbed style' ) // Args
			);
		}

		function widget( $args, $instance ) {
			extract($args);

			$count = intval( $instance['count'] );

			global $timings;
			$key_for_week = sprintf( 'vw_post_views_%s-%s', 'week', date( $timings['week'] ) );
			$key_for_month = sprintf( 'vw_post_views_%s-%s', 'month', date( $timings['month'] ) );
			$key_for_all_time = 'vw_post_views_all';

			$query_args = array(
				'post_type' => 'post',
				'ignore_sticky_posts' => true,
				'posts_per_page' => $count,
				'orderby' => 'meta_value_num',
			);

			if ( function_exists( 'icl_t' ) ) {
				$instance['title'] = icl_t( VW_THEME_NAME.' Widget', $this->id.'_title', $instance['title'] );
			}

			if ( ! empty( $instance['title'] ) ) {
				$title = apply_filters( 'widget_title', wp_kses_data( $instance['title'] ), $instance, $this->id_base);
			}

			echo $before_widget;
			if ( $instance['title'] ) echo $before_title . $title . $after_title;

			global $post;
			?>
			<div class="vw-fixed-tab vw-fixed-tab-3-cols clearfix">
				<ul>
					<li><a href="#" class="vw-fixed-tab-title is-active vw-header-font"><?php _e( 'Week' , 'envirra' ) ?></a></li>
					<li><a href="#" class="vw-fixed-tab-title vw-header-font"><?php _e( 'Month' , 'envirra' ) ?></a></li>
					<li><a href="#" class="vw-fixed-tab-title vw-header-font"><?php _e( 'All Time' , 'envirra' ) ?></a></li>
				</ul>

				<div class="vw-fixed-tab-content vw-fixed-tab-id-1 is-active">
					<?php
					$query_args['meta_key'] = $key_for_week;

					query_posts( apply_filters( 'vw_filter_widget_popular_post_tab_1_query', $query_args ) );

					$template_file = 'templates/post-loop/loop-small-left-thumbnail-col-1.php';

					include( locate_template( $template_file, false, false ) );
					wp_reset_query();
					?>
				</div>

				<div class="vw-fixed-tab-content vw-fixed-tab-id-2">
					<?php
					$query_args['meta_key'] = $key_for_month;

					query_posts( apply_filters( 'vw_filter_widget_popular_post_tab_2_query', $query_args ) );

					$template_file = 'templates/post-loop/loop-small-left-thumbnail-col-1.php';

					include( locate_template( $template_file, false, false ) );
					wp_reset_query();
					?>
				</div>

				<div class="vw-fixed-tab-content vw-fixed-tab-id-3">
					<?php
					$query_args['meta_key'] = $key_for_all_time;

					query_posts( apply_filters( 'vw_filter_widget_popular_post_tab_3_query', $query_args ) );

					$template_file = 'templates/post-loop/loop-small-left-thumbnail-col-1.php';

					include( locate_template( $template_file, false, false ) );
					wp_reset_query();
					?>
				</div>
			</div>
			<?php

			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$new_instance = wp_parse_args( (array) $new_instance, $this->default );
			$instance['title'] = wp_kses_data( $new_instance['title'] );
			$instance['count'] = intval( $new_instance['count'] );

			if ( function_exists( 'icl_register_string' ) ) {
				icl_register_string( VW_THEME_NAME.' Widget', $this->id.'_title', $instance['title'] );
			}

			return $instance;
		}

		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->default );

			$title = $instance['title'];
			$count = intval( $instance['count'] );
			?>

			<!-- title -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">Title:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
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