<?php

add_action( 'widgets_init', 'vw_widgets_init_latest_comments' );
if ( ! function_exists( 'vw_widgets_init_latest_comments' ) ) {
	function vw_widgets_init_latest_comments() {
		register_widget( 'Vw_widget_latest_comments' );
	}
}

if ( ! class_exists( 'Vw_widget_latest_comments' ) ) {
	class Vw_widget_latest_comments extends WP_Widget {
		private $default = array(
			'title' => '',
			'count' => '5',
		);

		public function __construct() {
			// widget actual processes
			parent::__construct(
		 		'vw_widget_latest_comments', // Base ID
				VW_THEME_NAME.': Latest Comments', // Name
				array( 'description' => 'Display latest comments' ) // Args
			);
		}

		function widget( $args, $instance ) {
			extract( $args );

			if ( function_exists( 'icl_t' ) ) {
				$instance['title'] = icl_t( VW_THEME_NAME.' Widget', $this->id.'_title', $instance['title'] );
			}

			if ( ! empty( $instance['title'] ) ) {
				$title = apply_filters( 'widget_title', wp_kses_data( $instance['title'] ), $instance, $this->id_base);
			}

			$count = intval( $instance['count'] );

			/**
			 * Begin render widget
			 */
			echo $before_widget;
			if ( $instance['title'] ) echo $before_title . $title . $after_title;

			$comments = get_comments( array(
				'status' => 'approve',
				'number' => $count,
			) );

			$template_file = sprintf( 'templates/post-loop/loop-small-comments.php' );

			include( locate_template( $template_file, false, false ) );

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

			$title = strip_tags( $instance['title'] );
			$count = $instance['count'];
			?>

			<!-- title -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e('Title:','envirra-backend'); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>

			<!-- count -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('count') ); ?>"><?php _e('Number of comments to show:','envirra-backend'); ?></label>
				<input id="<?php echo esc_attr( $this->get_field_id('count') ); ?>" name="<?php echo esc_attr( $this->get_field_name('count') ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>" size="3">
			</p>

			<?php
		}
	}
}