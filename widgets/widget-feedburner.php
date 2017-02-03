<?php

add_action( 'widgets_init', 'vw_widgets_init_feedburner' );
if ( ! function_exists( 'vw_widgets_init_feedburner' ) ) {
	function vw_widgets_init_feedburner() {
		register_widget( 'Vw_widget_feedburner' );
	}
}

if ( ! class_exists( 'Vw_widget_feedburner' ) ) {
	class Vw_widget_feedburner extends WP_Widget {
		private $default = array(
			'title' => '',
			'feedburner_id' => '',
		);

		public function __construct() {
			// widget actual processes
			parent::__construct(
				'vw_widget_feedburner', // Base ID
				VW_THEME_NAME.': FeedBurner', // Name
				array( 'description' => __( 'Subscribe to feedburner via email', 'envirra' ) ) // Args
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
			
			$feedburner_id = $instance['feedburner_id'];

			echo $before_widget;
			if ( $instance['title'] ) echo $before_title . $title . $after_title;

			?>
			<div class="vw-widget-feedburner-container">
				<h3 class="vw-widget-feedburner-text"><?php _e( 'Subscribe to our email newsletter.', 'envirra' ); ?></h3>
				<form action="https://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('https://feedburner.google.com/fb/a/mailverify?uri=<?php echo esc_js( $feedburner_id ); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
					<input class="vw-widget-feedburner-email" type="text" name="email" value="<?php esc_attr_e( 'Enter your e-mail address' , 'envirra' ) ; ?>" onfocus="if (this.value == '<?php echo esc_js( __( 'Enter your e-mail address' , 'envirra' ) ); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo esc_js( __( 'Enter your e-mail address' , 'envirra' ) ); ?>';}">
					<input type="hidden" value="<?php echo esc_attr( $feedburner_id ); ?>" name="uri">
					<input type="hidden" name="loc" value="en_US">
					<input class="feedburner-subscribe" type="submit" name="submit" value="<?php esc_attr_e( 'Subscribe' , 'envirra' ) ; ?>"> 
				</form>
			</div>
			<?php

			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$new_instance = wp_parse_args( (array) $new_instance, $this->default );
			$instance['title'] = wp_kses_data( $new_instance['title'] );
			$instance['feedburner_id'] = strip_tags( $new_instance['feedburner_id'] );

			if ( function_exists( 'icl_register_string' ) ) {
				icl_register_string( VW_THEME_NAME.' Widget', $this->id.'_title', $instance['title'] );
			}

			return $instance;
		}

		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->default );

			$title = $instance['title'];
			$feedburner_id = strip_tags( $instance['feedburner_id'] );
			?>

			<!-- title -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">Title</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>

			<!-- feedburner_id -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('feedburner_id') ); ?>">FeedBurner ID</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('feedburner_id') ); ?>" name="<?php echo esc_attr( $this->get_field_name('feedburner_id') ); ?>" type="text" value="<?php echo esc_attr($feedburner_id); ?>" />
			</p>

			<?php
		}
	}
}