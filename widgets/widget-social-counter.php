<?php

if ( ! defined( 'VW_CONST_SOCIAL_COUNTER_CACHE_EXPIRE' ) ) define( 'VW_CONST_SOCIAL_COUNTER_CACHE_EXPIRE', 14400 ); // 60*60*4 = 4 Hrs cache
if ( ! defined( 'VW_CONST_SOCIAL_COUNTER_GOOGLE_API_KEY' ) ) define( 'VW_CONST_SOCIAL_COUNTER_GOOGLE_API_KEY', 'AIzaSyCNyDK8sPUuf9bTcG1TdFFLAVUfA1IDm38' );
if ( ! defined( 'VW_CONST_SOCIAL_COUNTER_FACEBOOK_APP_ID' ) ) define( 'VW_CONST_SOCIAL_COUNTER_FACEBOOK_APP_ID', '463044130538358' );
if ( ! defined( 'VW_CONST_SOCIAL_COUNTER_FACEBOOK_APP_SECRET' ) ) define( 'VW_CONST_SOCIAL_COUNTER_FACEBOOK_APP_SECRET', 'f2baf676b95716d7022df64829f22070' );

add_action( 'widgets_init', 'vw_widgets_init_social_counter' );
if ( ! function_exists( 'vw_widgets_init_social_counter' ) ) {
	function vw_widgets_init_social_counter() {
		register_widget( 'Vw_widget_social_counter' );
	}
}

if ( ! class_exists( 'Vw_widget_social_counter' ) ) {
	class Vw_widget_social_counter extends WP_Widget {
		private $default = array(
			'title' => '',
			'twitter' => '',
			'twitter_key' => 'cE8DXsNyLhcZ8ruKDyMC6s8yL',
			'twitter_secret' => 'GVH7joVCtCZDN6cDjMNkJk5kP2p2OIkesMgd1alBUNJk8XxnX5',
			'facebook' => '',
			'youtube' => '',
			'instagram' => '',
			'googleplus' => '',
			'vimeo' => '',
			'soundcloud' => '',
			'soundcloud_client_id' => '9ced2d0a6f0a41f2567110de3c9a8ad0',
			'pinterest' => '',
			'vk' => '',
			'dribbble' => '',
			'is_saved' => false,
		);

		public function __construct() {
			// widget actual processes
			parent::__construct(
		 		'vw_widget_social_counter', // Base ID
				VW_THEME_NAME.': Social Counter', // Name
				array( 'description' => 'Display social icon with counter' ) // Args
			);
		}

		function widget( $args, $instance ) {
			extract($args);

			if ( function_exists( 'icl_t' ) ) {
				$instance['title'] = icl_t( VW_THEME_NAME.' Widget', $this->id.'_title', $instance['title'] );
			}

			$title_html = '';
			if ( ! empty( $instance['title'] ) ) {
				$title_html = apply_filters( 'widget_title', wp_kses_data( $instance['title'] ), $instance, $this->id_base);
			}

			$twitter = strip_tags( $instance['twitter'] );
			$twitter_key = strip_tags( $instance['twitter_key'] );
			$twitter_secret = strip_tags( $instance['twitter_secret'] );
			$facebook = strip_tags( $instance['facebook'] );
			$instagram = strip_tags( $instance['instagram'] );
			$youtube = strip_tags( $instance['youtube'] );
			$googleplus = strip_tags( $instance['googleplus'] );
			$vimeo = strip_tags( $instance['vimeo'] );
			$soundcloud = strip_tags( $instance['soundcloud'] );
			$soundcloud_client_id = strip_tags( $instance['soundcloud_client_id'] );
			$pinterest = strip_tags( $instance['pinterest'] );
			$vk = strip_tags( $instance['vk'] );
			$dribbble = strip_tags( $instance['dribbble'] );

			echo $before_widget;
			if ( $instance['title'] ) echo $before_title . $title_html . $after_title;

			if ( $twitter ) {
				$twitter_count = vw_get_twitter_count( $twitter, $twitter_key, $twitter_secret );
				?>
					<div class="vw-social-counter vw-social-counter-twitter">
						<a class="vw-social-counter-icon" href="<?php echo esc_url( $twitter_count['page_url'] ); ?>" title="<?php esc_attr_e( 'Follow our twitter', 'envirra' ) ?>" target="_blank"><i class="icon-social-twitter"></i></a>
						<div class="vw-social-counter-counter">
							<div class="vw-social-counter-count"><?php echo vw_number_prefixes( $twitter_count['count'] ); ?></div>
							<div class="vw-social-counter-unit"><?php _e( 'Followers', 'envirra' ) ?></div>
						</div>
						<div class="clearfix"></div>
					</div>
				<?php
			}

			if ( $facebook ) {
				$facebook_count = vw_get_facebook_count( $facebook );
				?>
					<div class="vw-social-counter vw-social-counter-facebook">
						<a class="vw-social-counter-icon" href="<?php echo esc_url( $facebook_count['page_url'] ); ?>" title="<?php esc_attr_e( 'Like our facebook', 'envirra' ) ?>" target="_blank"><i class="icon-social-facebook"></i></a>
						<div class="vw-social-counter-counter">
							<div class="vw-social-counter-count"><?php echo vw_number_prefixes( $facebook_count['count'] ); ?></div>
							<div class="vw-social-counter-unit"><?php _e( 'Fans', 'envirra' ) ?></div>
						</div>
						<div class="clearfix"></div>
					</div>
				<?php
			}

			if ( $instagram ) {
				$instagram_count = vw_get_instagram_count( $instagram );
				?>
					<div class="vw-social-counter vw-social-counter-instagram">
						<a class="vw-social-counter-icon" href="<?php echo esc_url( $instagram_count['page_url'] ); ?>" title="<?php esc_attr_e( 'Follow our instagram', 'envirra' ) ?>" target="_blank"><i class="icon-social-instagram"></i></a>
						<div class="vw-social-counter-counter">
							<div class="vw-social-counter-count"><?php echo vw_number_prefixes( $instagram_count['count'] ); ?></div>
							<div class="vw-social-counter-unit"><?php _e( 'Followers', 'envirra' ) ?></div>
						</div>
						<div class="clearfix"></div>
					</div>
				<?php
			}

			if ( $youtube ) {
				$youtube_count = vw_get_youtube_count( $youtube );
				?>
					<div class="vw-social-counter vw-social-counter-youtube">
						<a class="vw-social-counter-icon" href="<?php echo esc_url( $youtube_count['page_url'] ); ?>" title="<?php esc_attr_e( 'Subscribe our youtube', 'envirra' ) ?>" target="_blank"><i class="icon-social-youtube"></i></a>
						<div class="vw-social-counter-counter">
							<div class="vw-social-counter-count"><?php echo vw_number_prefixes( $youtube_count['count'] ); ?></div>
							<div class="vw-social-counter-unit"><?php _e( 'Subscribers', 'envirra' ) ?></div>
						</div>
						<div class="clearfix"></div>
					</div>
				<?php
			}

			if ( $googleplus ) {
				$googleplus_count = vw_get_googleplus_count( $googleplus );
				?>
					<div class="vw-social-counter vw-social-counter-googleplus">
						<a class="vw-social-counter-icon" href="<?php echo esc_url( $googleplus_count['page_url'] ); ?>" title="<?php esc_attr_e( '+1 our page', 'envirra' ) ?>" target="_blank"><i class="icon-social-gplus"></i></a>
						<div class="vw-social-counter-counter">
							<div class="vw-social-counter-count"><?php echo vw_number_prefixes( $googleplus_count['count'] ); ?></div>
							<div class="vw-social-counter-unit"><?php _e( 'People', 'envirra' ) ?></div>
						</div>
						<div class="clearfix"></div>
					</div>
				<?php
			}

			if ( $vimeo ) {
				$vimeo_count = vw_get_vimeo_count( $vimeo );
				?>
					<div class="vw-social-counter vw-social-counter-vimeo">
						<a class="vw-social-counter-icon" href="<?php echo esc_url( $vimeo_count['page_url'] ); ?>" title="<?php esc_attr_e( 'Subscribe our page', 'envirra' ) ?>" target="_blank"><i class="icon-social-vimeo"></i></a>
						<div class="vw-social-counter-counter">
							<div class="vw-social-counter-count"><?php echo vw_number_prefixes( $vimeo_count['count'] ); ?></div>
							<div class="vw-social-counter-unit"><?php _e( 'Subscribers', 'envirra' ) ?></div>
						</div>
						<div class="clearfix"></div>
					</div>
				<?php
			}

			if ( $soundcloud ) {
				$soundcloud_count = vw_get_soundcloud_count( $soundcloud );
				?>
					<div class="vw-social-counter vw-social-counter-soundcloud">
						<a class="vw-social-counter-icon" href="<?php echo esc_url( $soundcloud_count['page_url'] ); ?>" title="<?php esc_attr_e( 'Follow our Soundcloud', 'envirra' ) ?>" target="_blank"><i class="icon-social-soundcloud"></i></a>
						<div class="vw-social-counter-counter">
							<div class="vw-social-counter-count"><?php echo vw_number_prefixes( $soundcloud_count['count'], $soundcloud_client_id ); ?></div>
							<div class="vw-social-counter-unit"><?php _e( 'Followers', 'envirra' ) ?></div>
						</div>
						<div class="clearfix"></div>
					</div>
				<?php
			}

			if ( $pinterest ) {
				$pinterest_count = vw_get_pinterest_count( $pinterest );
				?>
					<div class="vw-social-counter vw-social-counter-pinterest">
						<a class="vw-social-counter-icon" href="<?php echo esc_url( $pinterest_count['page_url'] ); ?>" title="<?php esc_attr_e( 'Follow our pinterest', 'envirra' ) ?>" target="_blank"><i class="icon-social-pinterest"></i></a>
						<div class="vw-social-counter-counter">
							<div class="vw-social-counter-count"><?php echo vw_number_prefixes( $pinterest_count['count'] ); ?></div>
							<div class="vw-social-counter-unit"><?php _e( 'Followers', 'envirra' ) ?></div>
						</div>
						<div class="clearfix"></div>
					</div>
				<?php
			}

			if ( $vk ) {
				$vk_count = vw_get_vk_count( $vk );
				?>
					<div class="vw-social-counter vw-social-counter-vk">
						<a class="vw-social-counter-icon" href="<?php echo esc_url( $vk_count['page_url'] ); ?>" title="<?php esc_attr_e( 'Follow our vk', 'envirra' ) ?>" target="_blank"><i class="icon-social-vk"></i></a>
						<div class="vw-social-counter-counter">
							<div class="vw-social-counter-count"><?php echo vw_number_prefixes( $vk_count['count'] ); ?></div>
							<div class="vw-social-counter-unit"><?php _e( 'Members', 'envirra' ) ?></div>
						</div>
						<div class="clearfix"></div>
					</div>
				<?php
			}

			if ( $dribbble ) {
				$dribbble_count = vw_get_dribbble_count( $dribbble );
				?>
					<div class="vw-social-counter vw-social-counter-dribbble">
						<a class="vw-social-counter-icon" href="<?php echo esc_url( $dribbble_count['page_url'] ); ?>" title="<?php esc_attr_e( 'Follow our Dribbble', 'envirra' ) ?>" target="_blank"><i class="icon-social-dribbble"></i></a>
						<div class="vw-social-counter-counter">
							<div class="vw-social-counter-count"><?php echo vw_number_prefixes( $dribbble_count['count'] ); ?></div>
							<div class="vw-social-counter-unit"><?php _e( 'Followers', 'envirra' ) ?></div>
						</div>
						<div class="clearfix"></div>
					</div>
				<?php
			}
			?>
			<div class="clearfix"></div>
			<?php

			wp_reset_postdata();
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$new_instance = wp_parse_args( (array) $new_instance, $this->default );
			$instance['title'] = wp_kses_data( $new_instance['title'] );
			$instance['twitter'] = strip_tags( $new_instance['twitter'] );
			$instance['twitter_key'] = strip_tags( $new_instance['twitter_key'] );
			$instance['twitter_secret'] = strip_tags( $new_instance['twitter_secret'] );
			$instance['facebook'] = strip_tags( $new_instance['facebook'] );
			$instance['instagram'] = strip_tags( $new_instance['instagram'] );
			$instance['youtube'] = strip_tags( $new_instance['youtube'] );
			$instance['googleplus'] = strip_tags( $new_instance['googleplus'] );
			$instance['vimeo'] = strip_tags( $new_instance['vimeo'] );
			$instance['soundcloud'] = strip_tags( $new_instance['soundcloud'] );
			$instance['soundcloud_client_id'] = strip_tags( $new_instance['soundcloud_client_id'] );
			$instance['pinterest'] = strip_tags( $new_instance['pinterest'] );
			$instance['vk'] = strip_tags( $new_instance['vk'] );
			$instance['dribbble'] = strip_tags( $new_instance['dribbble'] );
			$instance['is_saved'] = true;

			delete_transient( 'vw_social_counter_twitter' );
			delete_transient( 'vw_social_counter_facebook' );
			delete_transient( 'vw_social_counter_instagram' );
			delete_transient( 'vw_social_counter_youtube' );
			delete_transient( 'vw_social_counter_googleplus' );
			delete_transient( 'vw_social_counter_vimeo' );
			delete_transient( 'vw_social_counter_soundcloud' );
			delete_transient( 'vw_social_counter_pinterest' );
			delete_transient( 'vw_social_counter_vk' );
			delete_transient( 'vw_social_counter_dribbble' );

			if ( function_exists( 'icl_register_string' ) ) {
				icl_register_string( VW_THEME_NAME.' Widget', $this->id.'_title', $instance['title'] );
			}

			return $instance;
		}

		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, $this->default );

			$title = $instance['title'];
			$twitter = strip_tags( $instance['twitter'] );
			$twitter_key = strip_tags( $instance['twitter_key'] );
			$twitter_secret = strip_tags( $instance['twitter_secret'] );
			$facebook = strip_tags( $instance['facebook'] );
			$instagram = strip_tags( $instance['instagram'] );
			$youtube = strip_tags( $instance['youtube'] );
			$googleplus = strip_tags( $instance['googleplus'] );
			$vimeo = strip_tags( $instance['vimeo'] );
			$soundcloud = strip_tags( $instance['soundcloud'] );
			$soundcloud_client_id = strip_tags( $instance['soundcloud_client_id'] );
			$pinterest = strip_tags( $instance['pinterest'] );
			$vk = strip_tags( $instance['vk'] );
			$dribbble = strip_tags( $instance['dribbble'] );
			?>

			<!-- title -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">Title:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>

			<!-- twitter username -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('twitter') ); ?>">Twitter Username:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('twitter') ); ?>" name="<?php echo esc_attr( $this->get_field_name('twitter') ); ?>" type="text" value="<?php echo esc_attr($twitter); ?>" />
			</p>

			<!-- twitter consumer key -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('twitter_key') ); ?>">Twitter consumer key:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('twitter_key') ); ?>" name="<?php echo esc_attr( $this->get_field_name('twitter_key') ); ?>" type="text" value="<?php echo esc_attr($twitter_key); ?>" />
			</p>

			<!-- twitter consumer secret -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('twitter_secret') ); ?>">Twitter Consumer Secret:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('twitter_secret') ); ?>" name="<?php echo esc_attr( $this->get_field_name('twitter_secret') ); ?>" type="text" value="<?php echo esc_attr($twitter_secret); ?>" />
			</p>

			<!-- facebook id -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('facebook') ); ?>">Facebook Page ID:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('facebook') ); ?>" name="<?php echo esc_attr( $this->get_field_name('facebook') ); ?>" type="text" value="<?php echo esc_attr($facebook); ?>" />
				<p class="description">The value should be a page id like "<strong>80655071208</strong>".You can find the page id <a href="http://findmyfacebookid.com/" target="_blank">here</a>.</p>
			</p>

			<!-- instagram id -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('instagram') ); ?>">Instagram ID:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('instagram') ); ?>" name="<?php echo esc_attr( $this->get_field_name('instagram') ); ?>" type="text" value="<?php echo esc_attr($instagram); ?>" />
			</p>

			<!-- youtube username -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('youtube') ); ?>">Youtube Username:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('youtube') ); ?>" name="<?php echo esc_attr( $this->get_field_name('youtube') ); ?>" type="text" value="<?php echo esc_attr($youtube); ?>" />
			</p>

			<!-- googleplus username -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('googleplus') ); ?>">Google+ Page Name:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('googleplus') ); ?>" name="<?php echo esc_attr( $this->get_field_name('googleplus') ); ?>" type="text" value="<?php echo esc_attr($googleplus); ?>" />
				<p class="description">The value should be a name or id like "<strong>+envato</strong>"" or "<strong>107285294994146126204</strong>"</p>
			</p>

			<!-- vimeo channel name -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('vimeo') ); ?>">Vimeo Channel Name/ID:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('vimeo') ); ?>" name="<?php echo esc_attr( $this->get_field_name('vimeo') ); ?>" type="text" value="<?php echo esc_attr($vimeo); ?>" />
				<p class="description">The value should be a name or id from your channel url like "<strong>staffpicks</strong>"" or "<strong>31259</strong>"</p>
			</p>

			<!-- soundcloud username -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('soundcloud') ); ?>">Soundcloud Username:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('soundcloud') ); ?>" name="<?php echo esc_attr( $this->get_field_name('soundcloud') ); ?>" type="text" value="<?php echo esc_attr($soundcloud); ?>" />
			</p>

			<!-- soundcloud client id -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('soundcloud_client_id') ); ?>">Soundcloud Client ID:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('soundcloud_client_id') ); ?>" name="<?php echo esc_attr( $this->get_field_name('soundcloud_client_id') ); ?>" type="text" value="<?php echo esc_attr($soundcloud_client_id); ?>" />
			</p>

			<!-- pinterest username -->
			<!-- <p>
				<label for="<?php echo esc_attr( $this->get_field_id('pinterest') ); ?>">Pinterest Username:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('pinterest') ); ?>" name="<?php echo esc_attr( $this->get_field_name('pinterest') ); ?>" type="text" value="<?php echo esc_attr($pinterest); ?>" />
			</p> -->

			<!-- vk group id -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('vk') ); ?>">VK Group ID:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('vk') ); ?>" name="<?php echo esc_attr( $this->get_field_name('vk') ); ?>" type="text" value="<?php echo esc_attr($vk); ?>" />
			</p>

			<!-- dribbble username -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('dribbble') ); ?>">Dribbble Username:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('dribbble') ); ?>" name="<?php echo esc_attr( $this->get_field_name('dribbble') ); ?>" type="text" value="<?php echo esc_attr($dribbble); ?>" />
			</p>


			<?php
		}
	}
}

/* -----------------------------------------------------------------------------
 * Get Counter Functions
 * -------------------------------------------------------------------------- */

if ( ! function_exists( 'vw_save_social_counter' ) ) {
	function vw_save_social_counter( $key, $counter ) {
		if ( is_null( $counter['count'] ) ){
			// When getting counter failed.
			$saved_counter = get_option( $key, array() );

			if ( ! empty( $saved_counter['count'] ) && $saved_counter['page_url'] == $counter['page_url'] ) {
				// Restore previous counter
				$counter['count'] = $saved_counter['count'];
			} else {
				$counter['count'] = 0;
			}

		} else {
			// Save the counter when getting counter successfully.
			update_option( $key, $counter );
		}

		set_transient( $key, $counter, VW_CONST_SOCIAL_COUNTER_CACHE_EXPIRE );

		return $counter;
	}
}

if ( ! function_exists( 'vw_get_twitter_count' ) ) {
	function vw_get_twitter_count( $twitter_id, $consumer_key, $consumer_secret ) {
		$counter_key = 'vw_social_counter_twitter';

		/**
		 * Check for cached version
		 */
		$twitter = get_transient( $counter_key );
		if ( $twitter !== false ) return $twitter;

		/**
		 * Getting counter
		 */
		$twitter = array();
		$twitter['page_url'] = "http://www.twitter.com/$twitter_id";
		$twitter['count'] = null;

		if( $twitter_id && $consumer_key && $consumer_secret ) {
			$token = get_option( 'vw_twitter_token' );
			if( ! $token ) {
				// preparing credentials
				$credentials = $consumer_key . ':' . $consumer_secret;
				$toSend = base64_encode( $credentials );

				// http post arguments
				$args = array(
					'method' => 'POST',
					'httpversion' => '1.1',
					'blocking' => true,
					'sslverify' => false,
					'headers' => array(
						'Authorization' => 'Basic ' . $toSend,
						'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8'
					),
					'body' => array( 'grant_type' => 'client_credentials' )
				);

				$response = wp_remote_post('https://api.twitter.com/oauth2/token', $args);

				$keys = json_decode( wp_remote_retrieve_body( $response ) );

				if( $keys ) {
					// saving token to wp_options table
					update_option( 'vw_twitter_token', $keys->access_token );
					$token = $keys->access_token;
				}
			}

			// we have bearer token wether we obtained it from API or from options
			$args = array(
				'httpversion' => '1.1',
				'blocking' => true,
				'sslverify' => false,
				'headers' => array(
					'Authorization' => "Bearer $token"
				)
			);
		
			$api_url = "https://api.twitter.com/1.1/users/show.json?screen_name=$twitter_id";
			$response = wp_remote_get( $api_url, $args );

			if ( ! is_wp_error( $response ) ) {
				$twitter_reply = json_decode( wp_remote_retrieve_body( $response ) );
				if ( isset( $twitter_reply->followers_count ) ) {
					$twitter['count'] = $twitter_reply->followers_count;
				}
			} else {
				// Delete token for getting a new token on the next request
				delete_option( 'vw_twitter_token' );
			}
		}

		/**
		 * Save counter
		 */
		return vw_save_social_counter( $counter_key, $twitter );
	}
}

if ( ! function_exists( 'vw_get_facebook_count' ) ) {
	function vw_get_facebook_count( $page_id ) {
		$counter_key = 'vw_social_counter_facebook';

		/**
		 * Check for cached version
		 */
		$facebook = get_transient( $counter_key );
		if ( $facebook !== false ) return $facebook;

		/**
		 * Getting counter
		 */
		$facebook = array();
		$facebook['page_url'] = "https://www.facebook.com/".$page_id;
		$facebook['count'] = null;

		if( $page_id ) {
			$token = get_option( 'vw_facebook_token' );
			if( ! $token ) {
				// we have bearer token wether we obtained it from API or from options
				$args = array(
					'httpversion' => '1.1',
					'blocking' => true,
					// 'sslverify' => false,
					'headers' => array(),
				);

				$response = wp_remote_get( 'https://graph.facebook.com/oauth/access_token?client_id='.VW_CONST_SOCIAL_COUNTER_FACEBOOK_APP_ID.'&client_secret='.VW_CONST_SOCIAL_COUNTER_FACEBOOK_APP_SECRET.'&grant_type=client_credentials', $args );

				$body = wp_remote_retrieve_body( $response );

				if( strpos( $body, 'access_token=' ) !== false ) {
					// saving token to wp_options table
					$key = str_replace( 'access_token=', '', $body );
					update_option( 'vw_facebook_token', $key );
					$token = $key;
				} else {
					// Delete token for getting a new token on the next request
					delete_option( 'vw_facebook_token' );
				}
			}

			// we have bearer token wether we obtained it from API or from options
			$args = array(
				'httpversion' => '1.1',
				'blocking' => true,
				// 'sslverify' => false,
				'headers' => array(),
			);

			add_filter( 'https_ssl_verify', '__return_false' );
			$api_url = 'https://graph.facebook.com/v2.3/'.$page_id.'?access_token='.$token;
			$response = wp_remote_get( $api_url, $args );

			if ( ! is_wp_error( $response ) ) {
				$facebook_reply = json_decode( wp_remote_retrieve_body( $response ) );
				if ( isset( $facebook_reply->likes ) ) {
					$facebook['count'] = $facebook_reply->likes;
				}
			} else {
				// Delete token for getting a new token on the next request
				delete_option( 'vw_facebook_token' );
			}
		}

		/**
		 * Save counter
		 */
		return vw_save_social_counter( $counter_key, $facebook );
	}
}

if ( ! function_exists( 'vw_get_instagram_count' ) ) {
	function vw_get_instagram_count( $username ) {
		$counter_key = 'vw_social_counter_instagram';

		/**
		 * Check for cached version
		 */
		$instagram = get_transient( $counter_key );
		if ( $instagram !== false ) return $instagram;

		/**
		 * Getting counter
		 */
		$api_url = 'http://instagram.com/'.$username.'/';
		$instagram = array();
		$instagram['page_url'] = $api_url;
		$instagram['count'] = null;
		
		$raw_page_content = vw_get_subscriber_counter( $api_url ); 

		if ( ! is_wp_error( $raw_page_content ) ) {
			if ( preg_match( '|"followed_by":[ ]*{"count":[ ]*([0-9]+)|', $raw_page_content, $match ) ) {
				$instagram['count'] = $match[1];
			}
		}

		/**
		 * Save counter
		 */
		return vw_save_social_counter( $counter_key, $instagram );
	}
}

if ( ! function_exists( 'vw_get_youtube_count' ) ) {
	function vw_get_youtube_count( $channel_id ) {
		$counter_key = 'vw_social_counter_youtube';

		/**
		 * Check for cached version
		 */
		$youtube = get_transient( $counter_key );
		if ( $youtube !== false ) return $youtube;

		/**
		 * Getting counter
		 */
		$youtube = array();
		$youtube['page_url'] = sprintf( 'https://www.youtube.com/channel/%1$s/', $channel_id );
		$youtube['count'] = null;
		$api_url = sprintf( 'https://www.googleapis.com/youtube/v3/channels?part=statistics&id=%1$s&key=%2$s', $channel_id, VW_CONST_SOCIAL_COUNTER_GOOGLE_API_KEY );
		$alt_api_url = sprintf( 'https://www.googleapis.com/youtube/v3/channels?part=statistics&forUsername=%1$s&key=%2$s', $channel_id, VW_CONST_SOCIAL_COUNTER_GOOGLE_API_KEY );

		$data = vw_get_subscriber_counter($api_url);

		if ( ! is_wp_error( $data ) ) {
			$json = json_decode( $data );

			if ( isset( $json->items[0]->statistics->subscriberCount ) ) {
				$youtube['count'] = $json->items[0]->statistics->subscriberCount;
			} else {

				/* Try again with alternative url for getting statistics from user id */
				$youtube['page_url'] = sprintf( 'https://www.youtube.com/user/%1$s/', $channel_id );
				$data = vw_get_subscriber_counter( $alt_api_url );
				$json = json_decode( $data );
				if ( isset( $json->items[0]->statistics->subscriberCount ) ) {
					$youtube['count'] = $json->items[0]->statistics->subscriberCount;
				}
			}
		}

		/**
		 * Save counter
		 */
		return vw_save_social_counter( $counter_key, $youtube );
	}
}

if ( ! function_exists( 'vw_get_googleplus_count' ) ) {
	function vw_get_googleplus_count( $username ) {
		$counter_key = 'vw_social_counter_googleplus';

		/**
		 * Check for cached version
		 */
		$googleplus = get_transient( $counter_key );
		if ( $googleplus !== false ) return $googleplus;

		/**
		 * Getting counter
		 */
		$googleplus = array();
		$googleplus['page_url'] = 'https://plus.google.com/'.$username;
		$googleplus['count'] = null;
		

		if ( preg_match( '/[^0-9]/', $username ) && strpos( $username, '+' ) !== 0 ) {
			// Reformat username
			$username = '+'.$username;
		}
		$api_url = sprintf( 'https://www.googleapis.com/plus/v1/people/%1$s?key=%2$s', $username, VW_CONST_SOCIAL_COUNTER_GOOGLE_API_KEY );
		
		$data = vw_get_subscriber_counter($api_url); 

		if ( ! is_wp_error( $data ) ) {
			$json = json_decode( $data );

			if ( isset( $json->url ) ) {
				$googleplus['page_url'] = $json->url;
			}

			if ( isset( $json->circledByCount ) ) {
				$googleplus['count'] = $json->circledByCount;

			} elseif ( isset( $json->plusOneCount ) ) {
				$googleplus['count'] = $json->plusOneCount;
				
			}
		}

		/**
		 * Save counter
		 */
		vw_save_social_counter( $counter_key, $googleplus );

		return $googleplus;
	}
}

if ( ! function_exists( 'vw_get_vimeo_count' ) ) {
	function vw_get_vimeo_count( $channel_name ) {
		$counter_key = 'vw_social_counter_vimeo';

		/**
		 * Check for cached version
		 */
		$vimeo = get_transient( $counter_key );
		if ( $vimeo !== false ) return $vimeo;

		/**
		 * Getting counter
		 */
		$vimeo = array();
		$vimeo['page_url'] = 'https://vimeo.com/channels/'.$channel_name;
		$vimeo['count'] = null;
		$api_url = 'http://vimeo.com/api/v2/channel/'.$channel_name.'/info.json';
		
		$data = vw_get_subscriber_counter( $api_url ); 

		if ( ! is_wp_error( $data ) ) {
			$json = json_decode( $data );

			if ( isset( $json->url ) ) {
				$vimeo['page_url'] = $json->url;
			}

			if ( isset( $json->total_subscribers ) ) {
				$vimeo['count'] = $json->total_subscribers;
			}
		}

		/**
		 * Save counter
		 */
		return vw_save_social_counter( $counter_key, $vimeo );
	}
}

if ( ! function_exists( 'vw_get_soundcloud_count' ) ) {
	function vw_get_soundcloud_count( $user, $client_id='e15ea601b7aeb07705020236871018e9' ) {
		$counter_key = 'vw_social_counter_soundcloud';

		/**
		 * Check for cached version
		 */
		$soundcloud = get_transient( $counter_key );
		if ( $soundcloud !== false ) return $soundcloud;

		/**
		 * Getting counter
		 */
		$soundcloud['page_url'] = 'https://soundcloud.com/'.$user;
		$soundcloud['count'] = null;
		$api_url = 'http://api.soundcloud.com/users/' . $user . '.json?client_id=' . $client_id;
		
		$data = vw_get_subscriber_counter( $api_url ); 

		if ( ! is_wp_error( $data ) ) {
			$json = json_decode( $data );

			if ( isset( $json->permalink_url ) ) {
				$soundcloud['page_url'] = $json->permalink_url;
			}

			if ( isset( $json->followers_count ) ) {
				$soundcloud['count'] = $json->followers_count;
			}
		}

		/**
		 * Save counter
		 */
		return vw_save_social_counter( $counter_key, $soundcloud );
	}
}

if ( ! function_exists( 'vw_get_pinterest_count' ) ) {
	function vw_get_pinterest_count( $username ) {
		$counter_key = 'vw_social_counter_pinterest';

		/**
		 * Check for cached version
		 */
		$pinterest = get_transient( $counter_key );
		if ( $pinterest !== false ) return $pinterest;

		/**
		 * Getting counter
		 */
		$api_url = 'https://www.pinterest.com/'.$username.'/';
		$pinterest['page_url'] = $api_url;
		$pinterest['count'] = null;
		add_filter( 'https_ssl_verify', '__return_false' );
		$data = vw_get_subscriber_counter( $api_url ); 
		if ( ! is_wp_error( $data ) ) {
			$doc = new DOMDocument();
			@$doc->loadHTML( $data );
			$metas = $doc->getElementsByTagName( 'meta' );
			for ( $i = 0; $i < $metas->length; $i++ ){
				$meta = $metas->item( $i );
				if( $meta->getAttribute('name') == 'pinterestapp:followers' ){
					$pinterest['count'] = $meta->getAttribute( 'content' );
					break;
				}
			}
		}

		/**
		 * Save counter
		 */
		return vw_save_social_counter( $counter_key, $pinterest );
	}
}

if ( ! function_exists( 'vw_get_vk_count' ) ) {
	function vw_get_vk_count( $group_id ) {
		$counter_key = 'vw_social_counter_vk';

		/**
		 * Check for cached version
		 */
		$pinterest = get_transient( $counter_key );
		if ( $pinterest !== false ) return $pinterest;

		/**
		 * Getting counter
		 */
		$vk['page_url'] = 'http://vk.com/'.$group_id;
		$vk['count'] = null;
		$api_url = 'http://api.vk.com/method/groups.getById?gid='.$group_id.'&fields=members_count';
		
		$data = vw_get_subscriber_counter( $api_url ); 

		if ( ! is_wp_error( $data ) ) {
			$json = json_decode( $data );

			if ( isset( $json->response[0]->members_count ) ) {
				$vk['count'] = $json->response[0]->members_count;
			}
		}

		/**
		 * Save counter
		 */
		return vw_save_social_counter( $counter_key, $vk );
	}
}

if ( ! function_exists( 'vw_get_dribbble_count' ) ) {
	function vw_get_dribbble_count( $username ) {
		$counter_key = 'vw_social_counter_dribbble';

		/**
		 * Check for cached version
		 */
		$pinterest = get_transient( $counter_key );
		if ( $pinterest !== false ) return $pinterest;

		/**
		 * Getting counter
		 */
		$dribbble['page_url'] = 'https://dribbble.com/'.$username;
		$dribbble['count'] = null;
		$api_url = 'http://api.dribbble.com/'.$username;
		
		$data = vw_get_subscriber_counter( $api_url ); 

		if ( ! is_wp_error( $data ) ) {
			$json = json_decode( $data );

			if ( isset( $json->url ) ) {
				$dribbble['page_url'] = $json->url;
			}

			if ( isset( $json->followers_count ) ) {
				$dribbble['count'] = $json->followers_count;
			}
		}

		/**
		 * Save counter
		 */
		return vw_save_social_counter( $counter_key, $dribbble );
	}
}

if ( ! function_exists( 'vw_get_subscriber_counter' ) ) {
	function vw_get_subscriber_counter( $api_url ) {
		$args = array(
			'httpversion' => '1.1',
			'blocking' => true,
			'user-agent' => 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
		);

		$response = wp_remote_get( $api_url, $args );
		if ( ! is_wp_error( $response ) ) {
			return wp_remote_retrieve_body( $response );
		}
	}
}