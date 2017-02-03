<?php get_header(); ?>

<?php
$shop_page_id = vw_get_shop_page_id();

if ( ! is_product() && '0' !== get_post_meta( vw_get_shop_page_id(), 'vw_show_page_title', true ) ) {
	// get_template_part( 'templates/page-title', apply_filters( 'vw_filter_page_title_template_name', '' ) );
} ?>

<div class="vw-page-wrapper clearfix <?php vw_the_sidebar_position_class(); ?>">
	<div class="container">
		<div class="row">

			<div class="vw-page-content" role="main" itemprop="mainContentOfPage">
				<?php if ( is_product_category() ) : ?>
					<div class="vw-page-title-box clearfix">
						
						<div class="vw-page-title-box-inner">
							<div class="vw-page-title-box-inner">
								<span class="vw-label vw-header-font"><?php _e( 'Products in', 'envirra' ); ?></span>
								<h1 class="vw-page-title"><?php echo single_cat_title( '', false ); ?></h1>

								<?php if ( category_description() ) : ?>
								<div class="vw-page-description"><?php echo category_description(); ?></div>
								<?php endif; ?>
							</div>

						</div>
					</div>

				<?php elseif ( is_product_tag() ) : ?>
					<div class="vw-page-title-box clearfix">
						
						<div class="vw-page-title-box-inner">
							<span class="vw-label vw-header-font"><?php _e( 'Products Tagged', 'envirra' ); ?></span>

							<h1 class="vw-page-title"><?php echo single_tag_title( '', false ); ?></h1>
						</div>
					</div>

				<?php elseif ( ! is_product() && '0' !== get_post_meta( vw_get_shop_page_id(), 'vw_show_page_title', true ) ) : ?>
					<div class="vw-page-title-box clearfix">
						<?php 
						$shop_name = $shop_page_id ? get_the_title( $shop_page_id ) : __( 'Shop', 'envirra' );
						$subtitle = get_post_meta( $shop_page_id, 'vw_page_subtitle', true );
						?>

						<div class="vw-page-title-box-inner">
							<h1 class="vw-page-title"><?php echo $shop_name; ?></h1>
							<?php if ( $subtitle ) : ?>
							<div class="vw-page-description"><p><?php echo wp_kses_data( $subtitle ); ?></p></div>
							<?php endif;?>
						</div>
					</div>

				<?php endif; ?>

				<?php if ( vw_get_theme_option( 'woocommerce_show_breadcrumb' ) && ! is_shop() ) {
					vw_the_breadcrumb( array( 'show_home'=>false ) );
				} ?>

				<?php woocommerce_content(); ?>

			</div>

			<?php get_sidebar(); ?>
			
		</div>
	</div>
</div>

<?php get_footer(); ?>