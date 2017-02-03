<?php get_header(); ?>

<div class="vw-page-wrapper clearfix <?php vw_the_sidebar_position_class(); ?>">
	<div class="container">
		<div class="row">

			<div class="vw-page-content" role="main" itemprop="mainContentOfPage">
				<?php if ( '0' !== get_post_meta( get_queried_object_id(), 'vw_show_page_title', true ) ) : ?>
					<div class="vw-page-title-box clearfix">
						<div class="vw-page-title-box-inner">
							<h1 class="vw-page-title"><?php the_title(); ?></h1>
							<?php $subtitle = get_post_meta( $post->ID, 'vw_page_subtitle', true ); ?>
							<?php if ( $subtitle ) : ?>
							<div class="vw-page-description"><p><?php echo wp_kses_data( $subtitle ); ?></p></div>
							<?php endif;?>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>
						<article <?php post_class( 'vw-main-post clearfix' ); ?>>
						
							<?php vw_the_featured_image(); ?>

							<?php the_content(); ?>

							<?php wp_link_pages( array(
								'before'      => '<div class="vw-page-links"><span class="vw-page-links-title">' . __( 'Pages:', 'envirra' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span class="vw-page-link">',
								'link_after'  => '</span>',
							) ); ?>

						</article><!-- #post-## -->

					<?php endwhile; ?>

					<?php if ( ! vw_get_theme_option( 'page_force_disable_comments' ) && ( comments_open() || get_comments_number() ) ) comments_template(); ?>

				<?php endif; ?>

			</div>

			<?php get_sidebar(); ?>
		
		</div>
	</div>

</div>

<?php get_footer(); ?>