<?php

add_action( 'widgets_init', 'vw_widgets_init_login' );
if ( ! function_exists( 'vw_widgets_init_login' ) ) {
	function vw_widgets_init_login() {
		register_widget( 'Vw_widget_login' );
	}
}

if ( ! class_exists( 'Vw_widget_login' ) ) {
	class Vw_widget_login extends WP_Widget {
		private $default = array(
			'title' => '',
		);

		public function __construct() {
			// widget actual processes
			parent::__construct(
				'vw_widget_login', // Base ID
				VW_THEME_NAME.': Login', // Name
				array( 'description' => 'Show login form' ) // Args
			);
		}

		function widget( $args, $instance ) {
			extract($args);

			if ( function_exists( 'icl_t' ) ) {
				$instance['title'] = icl_t( VW_THEME_NAME.' Widget', $this->id.'_title', $instance['title'] );
			}

			echo $before_widget;

			global $user_ID, $user_identity, $user_level;
			if ( $user_ID ) : ?>
			
				<h3 class="vw-login-title"><?php printf( __( 'Welcome %s', 'envirra' ), esc_html( $user_identity ) ) ?></h3>

				<div class="vw-loggedin-form clearfix">
					<?php echo vw_get_author_avatar( get_userdata( $user_ID ) ); ?>
					<div class="vw-loggedin-user-info">
						<ul class="vw-loggedin-form-links">
							<li><a href="<?php echo admin_url(); ?>"><?php _e( 'Dashboard' , 'envirra' ) ?> </a></li>
							<li><a href="<?php echo admin_url( 'profile.php' ); ?>"><?php _e( 'Your Profile' , 'envirra' ) ?> </a></li>
							<li><a href="<?php echo wp_logout_url( get_permalink() ); ?>"><?php _e( 'Logout' , 'envirra' ) ?> </a></li>
						</ul>
					</div>
				</div>
			<?php else :

				if ( ! empty( $instance['title'] ) ) printf( '<h3 class="vw-login-title">%s</h3>', wp_kses_data( $instance['title'] ) ); ?>

				<div class="vw-login-form">
					<form action="<?php echo wp_login_url( get_permalink() ); ?>" method="post">
						<p class="vw-login-form-username"><input type="text" name="log" id="log" value="<?php echo esc_attr__( 'Username' , 'envirra' ); ?>" onfocus="if (this.value == '<?php echo esc_js( __( 'Username' , 'envirra' ) ); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo esc_js( __( 'Username' , 'envirra' ) ); ?>';}"  size="33" /></p>
						<p class="vw-login-form-pass"><input type="password" name="pwd" id="pwd" value="<?php echo esc_attr__( 'Password' , 'envirra' ) ?>" onfocus="if (this.value == '<?php echo esc_js( __( 'Password' , 'envirra' ) ) ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo esc_js( __( 'Password' , 'envirra' ) ); ?>';}" size="33" /></p>
						<p>
							<label for="rememberme" class="vw-login-form-remember"><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> <?php _e( 'Remember Me' , 'envirra' ) ?></label>
							<a class="vw-login-form-lost-password" href="<?php echo wp_lostpassword_url( get_permalink() ); ?>"><?php _e( 'Lost your password?' , 'envirra' ) ?></a></p>

						<input type="submit" name="submit" value="<?php _e( 'Log in' , 'envirra' ) ?>" class="vw-login-form-login-button" />
						<?php if ( get_option('users_can_register') ) : ?>
							<a class="vw-login-form-register-button btn" href="<?php echo wp_registration_url(); ?>"><?php _e( 'Register' , 'envirra' ) ?></a>
						<?php endif; ?>
						<input type="hidden" name="redirect_to" value="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>"/>
					</form>
				</div>
			<?php endif;

			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$new_instance = wp_parse_args( (array) $new_instance, $this->default );
			$instance['title'] = wp_kses_data( $new_instance['title'] );

			if ( function_exists( 'icl_register_string' ) ) {
				icl_register_string( VW_THEME_NAME.' Widget', $this->id.'_title', $instance['title'] );
			}
			
			return $instance;
		}

		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->default );

			$title = $instance['title'];
			?>

			<!-- title -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">Title</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>

			<?php
		}
	}
}