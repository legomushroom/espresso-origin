<?php
/* -----------------------------------------------------------------------------
 * BackStretch
 * -------------------------------------------------------------------------- */
add_filter( 'vw_filter_localize_main_js', 'vw_backstretch_localize' );
if ( ! function_exists( 'vw_backstretch_localize' ) ) {
	function vw_backstretch_localize( $data ) {
		$data['VW_CONST_BACKSTRETCH_OPT_FADE'] = VW_CONST_BACKSTRETCH_OPT_FADE;
		$data['VW_CONST_BACKSTRETCH_OPT_CENTEREDY'] = VW_CONST_BACKSTRETCH_OPT_CENTEREDY;
		$data['VW_CONST_BACKSTRETCH_OPT_CENTEREDX'] = VW_CONST_BACKSTRETCH_OPT_CENTEREDX;
		$data['VW_CONST_BACKSTRETCH_OPT_DURATION'] = VW_CONST_BACKSTRETCH_OPT_DURATION;
		
		return $data;
	}
}

add_action( 'wp_footer', 'vw_enqueue_scripts_backstretch', 99 );
if ( ! function_exists( 'vw_enqueue_scripts_backstretch' ) ) {
	function vw_enqueue_scripts_backstretch() {
		// if ( function_exists( 'is_product' ) && is_product() ) return;
		if ( is_page() && ! is_page_template( 'page_big_featured_image.php' )
		 || ( function_exists( 'is_shop' ) && vw_is_shop() && get_page_template_slug( vw_get_shop_page_id() ) != 'page_big_featured_image.php' ) ) {
			return;
		}

		if ( have_posts() ) { the_post();
			global $post;

			$image_urls = array();
			$image_captions = array();

			if ( is_single() && has_post_format( 'gallery' ) ) {
				$attachments = get_post_meta( get_the_ID(), 'vw_post_format_gallery_images', false );
				
				foreach ( $attachments as $attachment_ID ) {
					$full_image_url = wp_get_attachment_image_src( $attachment_ID, VW_CONST_THUMBNAIL_SIZE_PAGE_TILE_BACKGROUND );
					if ( $full_image_url ) {
						$image_urls[] = $full_image_url[0];

						$image_caption = get_post( $attachment_ID )->post_excerpt;
						if ( ! empty( $image_caption ) ) {
							$image_captions[] = sprintf( '<div class="vw-featured-image-caption hidden"><i class="vw-icon icon-iconic-camera"></i> %s</div>', esc_html( $image_caption ) );
						}
					}
				}
			}
			
			if ( ( is_single() && has_post_thumbnail() && empty( $image_urls ) ) || is_page() || ( function_exists( 'is_shop' ) && vw_is_shop() ) ) {

				if ( function_exists( 'is_shop' ) && vw_is_shop() ) {
					$featured_image_id = vw_get_featured_image_id( vw_get_shop_page_id() );
				} else {
					$featured_image_id = vw_get_featured_image_id( $post->ID );
				}

				$full_image_url = wp_get_attachment_image_src( $featured_image_id, VW_CONST_THUMBNAIL_SIZE_PAGE_TILE_BACKGROUND );
				if ( $full_image_url ) $image_urls[] = $full_image_url[0];

				$attachment = get_post( $featured_image_id );
				if ( ! empty( $attachment ) && ! empty( $attachment->post_excerpt ) ) {
					$image_captions[] = sprintf( '<div class="vw-featured-image-caption hidden"><i class="vw-icon icon-iconic-camera"></i> %s</div>', esc_html( $attachment->post_excerpt ) );
				}
			}

			// if ( is_category() ) {
			// 	$image_id = vw_get_category_option( vw_get_archive_category_id(), 'category_background_image' );
			// 	$full_image_url = wp_get_attachment_image_src( $image_id, VW_CONST_THUMBNAIL_SIZE_PAGE_TILE_BACKGROUND );

			// 	if ( $full_image_url ) $image_urls[] = $full_image_url[0];
			// }

			if ( function_exists( 'is_product_category' ) && is_product_category() ) {
				global $wp_query;
				$cat_obj = $wp_query->get_queried_object();
				$image_id = vw_get_product_category_option( $cat_obj->term_id, 'category_background_image' );
				$full_image_url = wp_get_attachment_image_src( $image_id, VW_CONST_THUMBNAIL_SIZE_PAGE_TILE_BACKGROUND );

				if ( $full_image_url ) $image_urls[] = $full_image_url[0];
			}

			if ( ! empty( $image_urls ) ) { ?>

				<script id="vw-backstretch-image-captions-template" type="text/template">
					<div class="vw-page-title-image-captions vw-featured-image-caption-wrapper">
						<?php echo implode( '', $image_captions ); ?>
					</div>
				</script>

				<script type='text/javascript'>
					"use strict";
					if ( jQuery.backstretch ) {
						var $target = jQuery( '.vw-page-title-section' );
						$target.backstretch(
							['<?php echo implode( "','", $image_urls ) ?>'], {
								fade: <?php echo VW_CONST_BACKSTRETCH_OPT_FADE; ?>,
								centeredY: <?php echo VW_CONST_BACKSTRETCH_OPT_CENTEREDY; ?>,
								centeredX: <?php echo VW_CONST_BACKSTRETCH_OPT_CENTEREDX; ?>,
								duration: <?php echo VW_CONST_BACKSTRETCH_OPT_DURATION; ?>,
							}
						).removeClass( 'vw-has-no-background' ).addClass( 'vw-backstretch vw-has-background' );

						var $image_captions = jQuery( '#vw-backstretch-image-captions-template' ).html();
						$target.find( '.vw-page-title-box' ).before( $image_captions );

						jQuery( '.vw-gallery-direction-button.vw-gallery-direction-next' ).click( function() {
							$target.backstretch("next");
						} );

						jQuery( '.vw-gallery-direction-button.vw-gallery-direction-prev' ).click( function() {
							$target.backstretch("prev");
						} );

						jQuery(window).on("backstretch.after", function (e, instance, index) {
							jQuery( '.vw-page-title-image-captions .vw-featured-image-caption' )
								.addClass( 'hidden' )
								.eq( index ).removeClass( 'hidden' );
						});
					}
				</script>

			<?php }

			rewind_posts();
		}
	}
}