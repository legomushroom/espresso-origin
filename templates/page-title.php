<?php /* Init the post data */
if ( is_single() && have_posts() ) { the_post(); }
?>
<div class="vw-page-title-section vw-has-no-background clearfix">
	<div class="vw-page-title-section-overlay">
		
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="vw-page-title-section-inner">
						<?php if ( is_single() && has_post_format( 'gallery' ) ): ?>
						<div class="vw-gallery-direction-nav">
							<a href="#" class="vw-gallery-direction-button vw-gallery-direction-prev">
								<i class="vw-icon icon-entypo-left-open-big"></i>
							</a>
							<a href="#" class="vw-gallery-direction-button vw-gallery-direction-next">
								<i class="vw-icon icon-entypo-right-open-big"></i>
							</a>
						</div>
						<?php endif; ?>
						
						<div class="vw-page-title-box clearfix">

							<?php if ( apply_filters( 'vw_filter_is_custom_page_title', false ) ) : ?>
							
								<?php do_action( 'vw_action_custom_page_title' ); ?>

							<?php elseif ( function_exists( 'is_shop' ) && vw_is_shop() ) :
								$shop_page_id = vw_get_shop_page_id();
								$shop_name = $shop_page_id ? get_the_title( $shop_page_id ) : __( 'Shop', 'envirra' );
								$subtitle = get_post_meta( $shop_page_id, 'vw_page_subtitle', true );
								?>

								<div class="vw-page-title-box-inner">
									<h1 class="vw-page-title"><?php echo $shop_name; ?></h1>
									<?php if ( $subtitle ) : ?>
									<div class="vw-page-description"><p><?php echo esc_html( $subtitle ); ?></p></div>
									<?php endif;?>
								</div>

							<?php elseif ( function_exists( 'is_product' ) && is_product() ) : ?>

								<div class="vw-page-title-box-inner">
									<h1 class="vw-page-title"><?php _e( 'Product', 'envirra' ); ?></h1>
								</div>

							<?php elseif ( function_exists( 'is_product_tag' ) && is_product_tag() ) : ?>

								<div class="vw-page-title-box-inner">
									<h1 class="vw-page-title"><?php echo single_tag_title( '', false ); ?></h1>
								</div>

							<?php elseif ( function_exists( 'is_product_category' ) && is_product_category() ) : ?>

								<?php $the_category_thumbnail = vw_get_the_category_thumbnail();
								if ( $the_category_thumbnail ) : ?>
								<div class="vw-page-title-thumbnail"><?php echo $the_category_thumbnail; ?></div>
								<?php endif; ?>
								
								<div class="vw-page-title-box-inner">
									<h1 class="vw-page-title"><?php echo single_cat_title( '', false ); ?></h1>

									<?php if ( category_description() ) : ?>
									<div class="vw-page-description"><?php echo category_description(); ?></div>
									<?php endif; ?>
								</div>

							<?php elseif ( function_exists( 'bbp_is_forum_archive' ) && bbp_is_forum_archive() ) : ?>

								<div class="vw-page-title-box-inner">
									<h1 class="vw-page-title"><?php _e( 'Forums', 'envirra' ); ?></h1>
								</div>

							<?php elseif ( is_page() ) : ?>
	
								<div class="vw-page-title-box-inner">
									<h1 class="vw-page-title"><?php the_title(); ?></h1>
									<?php $subtitle = get_post_meta( $post->ID, 'vw_page_subtitle', true ); ?>
									<?php if ( $subtitle ) : ?>
									<div class="vw-page-description"><p><?php echo esc_html( $subtitle ); ?></p></div>
									<?php endif;?>
								</div>
								
							<?php elseif ( is_single() ) : ?>

								<div class="vw-page-title-box-inner">
									<?php vw_the_category(); ?>
									<h1 class="vw-page-title"><?php the_title(); ?></h1>

									<?php vw_the_subtitle(); ?>
									<?php vw_the_post_meta_large() ?>
								</div>

							<?php elseif ( is_search() ) : ?>
								
								<div class="vw-page-title-box-inner">
									<h1 class="vw-page-title">
										<?php if ( get_search_query() ) : ?>

											<?php printf( __( 'Search Result for &ldquo;%s&rdquo;', 'envirra' ), get_search_query() ); ?>

										<?php else : ?>

											<?php _e( 'Search', 'envirra' ); ?>

										<?php endif; ?>
									</h1>
								</div>

							<?php elseif ( is_404() ) : ?>

								<div class="vw-page-title-box-inner">
									<h1 class="vw-page-title"><?php _e( "We Couldn't Find Your Page!", 'envirra' ); ?></h1>
								</div>

							<?php elseif ( is_home() ) : ?>

								<div class="vw-page-title-box-inner">
									<h1 class="vw-page-title"><?php _e( 'Blog', 'envirra' ); ?></h1>
								</div>

							<?php else : ?>

								<div class="vw-page-title-box-inner">
									<?php if ( is_single() ) : vw_the_category(); endif; ?>
									<h1 class="vw-page-title"><?php _e( 'Archives', 'envirra' ); ?></h1>
								</div>

							<?php endif; ?>
					
							<div class="vw-page-title-divider"></div>

						</div>
					</div>
				</div>

			</div>
		</div>

	</div>
</div>

<?php /* Rewind the post data */
if ( is_single() && have_posts() ) { rewind_posts(); }
?>