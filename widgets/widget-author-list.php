<?php

add_action( 'widgets_init', 'vw_widgets_init_authors' );
if ( ! function_exists( 'vw_widgets_init_authors' ) ) {
	function vw_widgets_init_authors() {
		register_widget( 'Vw_widget_author_list' );
	}
}

if ( ! class_exists( 'Vw_widget_author_list' ) ) {
	class Vw_widget_author_list extends WP_Widget {
		private $default = array(
			'title' => '',
			'count' => '8',
			'role' => '',
		);

		public function __construct() {
			// widget actual processes
			parent::__construct(
		 		'vw_widget_author_list', // Base ID
				VW_THEME_NAME.': Author List', // Name
				array( 'description' => 'Display authors' ) // Args
			);
		}

		function widget( $args, $instance ) {
			global $wp_roles;
			extract($args);

			if ( function_exists( 'icl_t' ) ) {
				$instance['title'] = icl_t( VW_THEME_NAME.' Widget', $this->id.'_title', $instance['title'] );
			}

			$instance = wp_parse_args( (array) $instance, $this->default );
			if ( ! array_key_exists( $instance['role'], $wp_roles->roles ) ) {
				$instance['role'] = $this->default['role'];
			}

			$title_html = '';
			if ( ! empty( $instance['title'] ) ) {
				$title_html = apply_filters( 'widget_title', wp_kses_data( $instance['title'] ), $instance, $this->id_base);
			}

			$count = intval( $instance['count'] );		

			echo $before_widget;
			if ( $instance['title'] ) echo $before_title . $title_html . $after_title;

			$authors = get_users( apply_filters( 'vw_filter_widget_author_list_args', array(
				'role' => $instance['role'],
				'order' => 'DESC',
				'orderby' => 'post_count',
				'number' => $count
			) ) );

			echo '<ul class="clearfix">';
			foreach ( $authors as $author ) : ?>
				<li>
					<a href="<?php echo esc_url( get_author_posts_url( $author->ID ) ); ?>" title="<?php echo esc_attr( get_the_author_meta( 'display_name', $author->ID ) ); ?>" rel="bookmark">
						<?php vw_the_author_avatar( $author, VW_CONST_AVATAR_SIZE_MEDIUM ); ?>
					</a>
				</li>
			<?php endforeach;
			echo '</ul>';

			wp_reset_postdata();
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$new_instance = wp_parse_args( (array) $new_instance, $this->default );
			$instance['title'] = wp_kses_data( $new_instance['title'] );
			$instance['count'] = intval( $new_instance['count'] );
			$instance['role'] = strip_tags( $new_instance['role'] );

			if ( function_exists( 'icl_register_string' ) ) {
				icl_register_string( VW_THEME_NAME.' Widget', $this->id.'_title', $instance['title'] );
			}

			return $instance;
		}

		function form( $instance ) {
			global $wp_roles;

			$instance = wp_parse_args( (array) $instance, $this->default );

			$title = $instance['title'];
			$role = strip_tags( $instance['role'] );
			$count = intval( $instance['count'] );
			?>

			<!-- title -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">Title:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>

			<!-- role -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('role') ); ?>">Author Role:</label>
				<select id="<?php echo esc_attr( $this->get_field_id('role') ); ?>" name="<?php echo esc_attr( $this->get_field_name('role') ); ?>">
					<option value="">All</option>
					<?php foreach ( $wp_roles->roles as $slug => $role_data ) : ?>
					<option value="<?php echo esc_attr( $slug ); ?>" <?php selected( $role, $slug ); ?>><?php echo $role_data['name']; ?></option>
				<?php endforeach; ?>
				</select>
			</p>

			<!-- count -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('count') ); ?>">Number of authors to show:</label>
				<input id="<?php echo esc_attr( $this->get_field_id('count') ); ?>" name="<?php echo esc_attr( $this->get_field_name('count') ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>" size="3">
			</p>

			<?php
		}
	}
}