<?php

add_action( 'widgets_init', 'vw_widgets_init_categories' );
if ( ! function_exists( 'vw_widgets_init_categories' ) ) {
	function vw_widgets_init_categories() {
		register_widget( 'Vw_widget_categories' );
	}
}

if ( ! class_exists( 'Vw_widget_categories' ) ) {
	class Vw_widget_categories extends WP_Widget {
		private $default = array(
			'title' => '',
			'cat_ids' => array( 0 ),
		);

		public function __construct() {
			// widget actual processes
			parent::__construct(
		 		'vw_widget_categories', // Base ID
				VW_THEME_NAME.': Categories', // Name
				array( 'description' => 'Display a list of categories' ) // Args
			);
		}

		function widget( $args, $instance ) {
			extract($args);

			if ( function_exists( 'icl_t' ) ) {
				$instance['title'] = icl_t( VW_THEME_NAME.' Widget', $this->id.'_title', $instance['title'] );
			}

			if ( ! empty( $instance['title'] ) ) {
				$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base);
			}
			
			$cat_ids = $instance['cat_ids'];

			echo $before_widget;
			if ( $instance['title'] ) echo $before_title . $title . $after_title;

			$cats_args = array(
				'pad_counts' => true,
			);

			if ( ! empty( $cat_ids ) ) {
				$cats_args['include'] = esc_html( implode( ',', $cat_ids ) );
			}

			$categories = get_categories( apply_filters( 'vw_filter_widget_categories_args', $cats_args ) );

			$template_file = vw_build_template_path( 'templates/widgets/categories' );
			include( locate_template( $template_file, false, false ) );

			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$new_instance = wp_parse_args( (array) $new_instance, $this->default );
			$instance['title'] = wp_kses_data( $new_instance['title'] );
			$instance['cat_ids'] = $new_instance['cat_ids'];

			if ( function_exists( 'icl_register_string' ) ) {
				icl_register_string( VW_THEME_NAME.' Widget', $this->id.'_title', $instance['title'] );
			}
			
			return $instance;
		}

		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->default );

			$title = $instance['title'];
			$cat_ids = $instance['cat_ids'];
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
					<option value="<?php echo esc_attr( $category->cat_ID ); ?>" <?php if ( in_array( $category->cat_ID , $cat_ids ) ) { echo ' selected="selected"' ; } ?>><?php echo $category->cat_name; ?></option>
					<?php endforeach; ?>
				</select>
			</p>

			<?php
		}
	}
}