<?php

add_action( 'widgets_init', 'vw_widgets_init_author' );
if ( ! function_exists( 'vw_widgets_init_author' ) ) {
	function vw_widgets_init_author() {
		register_widget( 'Vw_widget_author' );
	}
}

if ( ! class_exists( 'Vw_widget_author' ) ) {
	class Vw_widget_author extends WP_Widget {
		private $default = array(
			'title' => '',
			'user' => '',
		);

		public function __construct() {
			// widget actual processes
			parent::__construct(
		 		'vw_widget_author', // Base ID
				VW_THEME_NAME.': Author', // Name
				array( 'description' => 'Display information of the selected author' ) // Args
			);
		}

		function widget( $args, $instance ) {
			extract($args);

			if ( function_exists( 'icl_t' ) ) {
				$instance['title'] = icl_t( VW_THEME_NAME.' Widget', $this->id.'_title', $instance['title'] );
			}

			$html = vw_shortcode_author( $instance );

			if ( ! empty( $html ) ) {
				echo $before_widget;
				echo $html;
				echo $after_widget;
			}
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$new_instance = wp_parse_args( (array) $new_instance, $this->default );
			$instance['title'] = wp_kses_data( $new_instance['title'] );
			$instance['user'] = strip_tags( $new_instance['user'] );

			if ( function_exists( 'icl_register_string' ) ) {
				icl_register_string( VW_THEME_NAME.' Widget', $this->id.'_title', $instance['title'] );
			}

			return $instance;
		}

		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->default );

			$title = $instance['title'];
			$user = strip_tags( $instance['user'] );
			?>

			<!-- title -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">Title:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>

			<!-- author username -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('user') ); ?>">Username:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('user') ); ?>" name="<?php echo esc_attr( $this->get_field_name('user') ); ?>" type="text" value="<?php echo esc_attr($user); ?>" />
			</p>

			<?php
		}
	}
}