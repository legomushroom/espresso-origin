<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

/* -----------------------------------------------------------------------------
 * Review Score Field
 * -------------------------------------------------------------------------- */
if ( ! class_exists( 'RWMB_Review_score_Field' ) ) {
	class RWMB_Review_score_Field extends RWMB_Field {
		/**
		 * Get field HTML
		 *
		 * @param string $html
		 * @param mixed  $meta
		 * @param array  $field
		 *
		 * @return string
		 */
		static function html( $meta, $field ) {
			ob_start(); ?>
			<input type="button" id="vw-add-review-score" class="button" value="Add Score">
			<div class="review-scores"></div>
			<?php
			return ob_get_clean();
		}
	}
}

add_action( 'save_post', 'vw_save_review_scores' );
if ( ! function_exists( 'vw_save_review_scores' ) ) {
	function vw_save_review_scores() {
		// Avoid loosing data after auto save
		if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || (defined('DOING_AJAX') && DOING_AJAX) || isset($_REQUEST['bulk_edit']))
			return;

		// Avoid save post from the other option
		if ( ! isset( $_POST['vw_enable_review'] ) )		
			return;

		global $post;

		if ( 'post' != get_post_type( $post ) ) return;

		$counter = 1;
		$total_score = 0;
		if ( isset( $_POST['vw_review_score_score'] ) ) {
			foreach( $_POST['vw_review_score_score'] as $id=>$score ) {
				update_post_meta( $post->ID, 'vw_review_score_'.$counter.'_label', $_POST[ 'vw_review_score_label' ][ $id ] );
				update_post_meta( $post->ID, 'vw_review_score_'.$counter.'_score', $score );
				$total_score += floatval( $score );
				$counter++;
			}
		}

		delete_post_meta( $post->ID, 'vw_review_score_'.$counter.'_label' );
		delete_post_meta( $post->ID, 'vw_review_score_'.$counter.'_score' );

		update_post_meta( $post->ID, 'vw_review_average_score', round( $total_score / ( max( $counter - 1, 1 ) ), 2 ) );
	}
}