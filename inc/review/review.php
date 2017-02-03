<?php

defined( 'VW_CONST_REVIEW_URL' ) || define( 'VW_CONST_REVIEW_URL', get_template_directory_uri().'/inc/review' );
defined( 'VW_CONST_REVIEW_DEFAULT_SCORE_STYLE' ) || define( 'VW_CONST_REVIEW_DEFAULT_SCORE_STYLE', 'image' );
defined( 'VW_CONST_REVIEW_DEFAULT_POSITION' ) || define( 'VW_CONST_REVIEW_DEFAULT_POSITION', 'bottom' );

/* -----------------------------------------------------------------------------
 * Enqueue Scripts
 * -------------------------------------------------------------------------- */
add_action( 'admin_enqueue_scripts', 'vwrev_enqueue_scripts' );
if ( ! function_exists( 'vwrev_enqueue_scripts' ) ) {
	function vwrev_enqueue_scripts() {
		wp_enqueue_script( 'vwjs-review', VW_CONST_REVIEW_URL.'/review-editor.js', array( 'jquery' ), VW_THEME_VERSION, true );
		wp_enqueue_style( 'vwcss-icon-entypo' );
	}
}

/* -----------------------------------------------------------------------------
 * Register meta boxes
 * -------------------------------------------------------------------------- */
add_filter( 'rwmb_meta_boxes', 'vwrev_register_meta_boxes' );
if ( ! function_exists( 'vwrev_register_review_meta_boxes' ) ) {
	function vwrev_register_meta_boxes( $meta_boxes ) {

		require_once 'meta-box-field-review-score.php';

		$meta_boxes[] = array(
			'id' => 'vw_review_editor',
			'title' => 'Review Options',
			'pages' => array( 'post' ),
			'fields' => array(
				array(
					'name' => 'Enable Review',
					'id' => 'vw_enable_review',
					'type' => 'checkbox',
				),
				array(
					'name' => 'Position',
					'id' => 'vw_review_position',
					'class' => 'field-review-position',
					'type' => 'select',
					'std' => VW_CONST_REVIEW_DEFAULT_POSITION,
					'options' => array(
						'top' => 'Top',
						'top-floating' => 'Top - Floating',
						'bottom' => 'Bottom',
						'custom' => 'Custom (using shortcode [review])',
					),
				),
				array(
					'name' => 'Review Summary',
					'id' => 'vw_review_summary',
					'class' => 'field-review-summary',
					'type' => 'textarea',
				),
				array(
					'name' => 'Pros',
					'id' => 'vw_review_pros',
					'class' => 'field-review-pros',
					'type' => 'textarea',
				),
				array(
					'name' => 'Cons',
					'id' => 'vw_review_cons',
					'class' => 'field-review-cons',
					'type' => 'textarea',
				),
				array(
					'name' => 'Score Style',
					'id' => 'vw_review_score_style',
					'class' => 'field-review-score-style',
					'type' => 'select',
					'std' => VW_CONST_REVIEW_DEFAULT_SCORE_STYLE,
					'options' => array(
						// 'star' => 'Star',
						'points' => 'Points',
						'percentage' => 'Percentage',
					),
				),
				array(
					'name' => 'Review Score',
					'id' => 'vw_review_scores',
					'class' => 'field-review-score',
					'type' => 'review_score',
				),
			)
		);

		return $meta_boxes;
	}
}

if ( ! function_exists( 'vw_has_review' ) ) {
	function vw_has_review() {
		return
			get_post_meta( get_the_id(), 'vw_enable_review', true )
			&& get_post_meta( get_the_id(), 'vw_review_score_1_score', true );
	}
}

if ( ! function_exists( 'vw_get_stared_score' ) ) {
	function vw_get_stared_score( $score ) {
		return $score * 5 / 100; // 5-starts based
	}
}
/* -----------------------------------------------------------------------------
 * Template Tag
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_the_review' ) ) {
	function vw_the_review() {
		if ( ! vw_has_review() ) return;

		get_template_part( 'templates/post-review' );
	}
}

if ( ! function_exists( 'vw_the_post_review_star' ) ) {
	function vw_the_post_review_star() {
		if ( ! vw_has_review() ) return;

		$total_score = get_post_meta( get_the_id(), 'vw_review_average_score', true );

		printf( '<span class="vw-post-review-star" data-score="%s"></span>', esc_attr( vw_get_stared_score( $total_score ) ) );
	}
}

if ( ! function_exists( 'vw_the_review_summary_bar' ) ) {
	function vw_the_review_summary_bar() {
		if ( ! vw_has_review() ) return;

		$total_score = get_post_meta( get_the_id(), 'vw_review_average_score', true );
		?>
			<span class="vw-review-summary-bar">
				<span class="vw-review-score-bar" style="width: <?php echo esc_attr( $total_score ); ?>%;">
					<span class="vw-review-score"><?php echo number_format( $total_score, 0 ) ?><span>%</span></span>
				</span>
				<span></span>
			</span>
		<?php
	}
}

/* -----------------------------------------------------------------------------
 * Shortcode
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vwrev_review_shortcode' ) ) {
	function vwrev_review_shortcode( $atts, $content = null ) {
		ob_start();
		vw_the_review();
		return ob_get_clean();
	}
}

/* -----------------------------------------------------------------------------
 * Insert Review Box
 * ------------------------------------------------------------------------- */
add_filter( 'the_content', 'vwrev_insert_review_box' );
if ( ! function_exists( 'vwrev_insert_review_box' ) ) {
	function vwrev_insert_review_box( $content ) {
		global $post;
		$location = get_post_meta( $post->ID, 'vw_review_position', true );

		if ( ! is_single() || empty( $location ) || $location == 'custom' ) {
			return $content;
		}

		ob_start();
		vw_the_review();
		$review = ob_get_clean();

		if ( 'bottom' == $location ) {
			return $content .= $review;

		} elseif ( 'top' == $location || 'top-floating' == $location ) {
			return $review .= $content;

		} else {
			return $content;

		}
	}
}

/* -----------------------------------------------------------------------------
 * User rating
 * ------------------------------------------------------------------------- */
add_action( 'after_setup_theme', 'vw_init_user_rating' );
if ( ! function_exists( 'vw_init_user_rating' ) ) {
	function vw_init_user_rating() {
		if ( vw_get_theme_option( 'enable_user_rating' ) ) {
			add_action( 'wp_ajax_user_rating', 'vw_ajax_count_user_rating' );
			add_action( 'wp_ajax_nopriv_user_rating', 'vw_ajax_count_user_rating' );

			/*if ( ! vw_is_caching_enabled() ) {
			}*/
		}
	}
}

if ( ! function_exists( 'vw_ajax_count_user_rating' ) ) {
	function vw_ajax_count_user_rating() {

		// Allow only ajax
		if ( ! defined( 'DOING_AJAX' ) || !DOING_AJAX ) {
			return;
		}

		/*if ( ! vw_is_caching_enabled() ) {
			$nonce = $_POST['requestNonce'];
			if ( ! wp_verify_nonce( $nonce, 'b99-request-nonce' ) ){
				exit();
			}
		}*/
		$post_id = 0;
		$rating = 0;

		if( ! empty( $_GET['post_id'] ) ) {
			$post_id = intval( $_GET['post_id'] );
		}

		if( ! empty( $_GET['rating'] ) ) {
			$rating = floatval( $_GET['rating'] );
		}

		$count = vw_add_user_rating( $post_id, $rating );

		if ( $count ) {
			printf( __( '%s User ratings' , 'envirra' ), $count );
		}

		exit();
	}
}

if ( ! function_exists( 'vw_user_rating_count' ) ) {
	function vw_add_user_rating( $post_id, $rating ) {
		if( $post_id > 0 && ( $rating > 0.0 && $rating <= 5.0 ) ) {
			// Increase number of users
			$count = intval( get_post_meta( $post_id, 'vw_user_rating_count', true ) );
			$count++;
			update_post_meta( $post_id, 'vw_user_rating_count', $count );

			// Sum rating
			$sum = floatval( get_post_meta( $post_id, 'vw_user_rating_sum', true ) );
			$sum += round( $rating, 1 );
			update_post_meta( $post_id, 'vw_user_rating_sum', $sum );

			return $count;
		}
	}
}