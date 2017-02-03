<?php

add_action( 'widgets_init', 'vw_widgets_init_custom_banner' );
if ( ! function_exists( 'vw_widgets_init_custom_banner' ) ) {
	function vw_widgets_init_custom_banner() {
		register_widget( 'Vw_widget_custom_banner' );
	}
}

if ( ! class_exists( 'Vw_widget_custom_banner' ) ) {
	class Vw_widget_custom_banner extends WP_Widget {
		private $default = array(
			'title' => '',
			'subtitle' => '',
			'button_name' => '',
			'link' => '',
			'image_url' => '',
		);

		public function __construct() {
			// widget actual processes
			parent::__construct(
		 		'vw_widget_custom_banner', // Base ID
				VW_THEME_NAME.': Custom Banner', // Name
				array( 'description' => 'Display a custom banner' ) // Args
			);
		}

		function widget( $args, $instance ) {
			extract($args);

			if ( function_exists( 'icl_t' ) ) {
				$instance['title'] = icl_t( VW_THEME_NAME.' Widget', $this->id.'_title', $instance['title'] );
				$instance['subtitle'] = icl_t( VW_THEME_NAME.' Widget', $this->id.'_subtitle', $instance['subtitle'] );
				$instance['button_name'] = icl_t( VW_THEME_NAME.' Widget', $this->id.'_button_name', $instance['button_name'] );
			}

			echo $before_widget;
			?>
			<div class="vw-custom-banner" style="background-image: url( <?php echo esc_url( $instance['image_url'] ); ?> )">

				<div class="vw-custom-banner-inner">
					<h1 class="vw-custom-banner-title"><?php echo $instance['title']; ?></h1>

					<?php if( $instance['subtitle'] ) : ?>
					<span class="vw-custom-banner-subtitle"><?php echo $instance['subtitle']; ?></span>
					<?php endif; ?>

					<?php if( $instance['button_name'] ) : ?>
					<a class="vw-custom-banner-button vw-header-font-family" href="<?php echo esc_url( $instance['link'] ); ?>"><?php echo $instance['button_name']; ?><i class="vw-icon icon-entypo-right-open"></i></a>
					<?php endif; ?>
				</div>

			</div>
			<?php
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$new_instance = wp_parse_args( (array) $new_instance, $this->default );
			$instance['title'] = wp_kses_data( $new_instance['title'] );
			$instance['subtitle'] = wp_kses_data( $new_instance['subtitle'] );
			$instance['image_url'] = esc_url( $new_instance['image_url'] );
			$instance['button_name'] = wp_kses_data( $new_instance['button_name'] );
			$instance['link'] = esc_url( $new_instance['link'] );

			if ( function_exists( 'icl_register_string' ) ) {
				icl_register_string( VW_THEME_NAME.' Widget', $this->id.'_title', $instance['title'] );
			}

			return $instance;
		}

		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->default );

			$title = $instance['title'];
			$subtitle = $instance['subtitle'];
			$image_url = $instance['image_url'];
			$button_name = $instance['button_name'];
			$link = $instance['link'];
			?>

			<!-- title -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">Title:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>

			<!-- subtitle -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('subtitle') ); ?>">Subtitle:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('subtitle') ); ?>" name="<?php echo esc_attr( $this->get_field_name('subtitle') ); ?>" type="text" value="<?php echo esc_attr($subtitle); ?>" />
			</p>

			<!-- image_url -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('image_url') ); ?>">Image Url:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('image_url') ); ?>" name="<?php echo esc_attr( $this->get_field_name('image_url') ); ?>" type="text" value="<?php echo esc_attr($image_url); ?>" />
			</p>

			<!-- button_name -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('button_name') ); ?>">Button Name:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('button_name') ); ?>" name="<?php echo esc_attr( $this->get_field_name('button_name') ); ?>" type="text" value="<?php echo esc_attr($button_name); ?>" />
			</p>

			<!-- link -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('link') ); ?>">Link To:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link') ); ?>" type="text" value="<?php echo esc_attr($link); ?>" />
			</p>

			<?php
		}
	}
}