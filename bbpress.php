<?php get_header(); ?>

<?php
	// get_template_part( 'templates/page-title', apply_filters( 'vw_filter_page_title_template_name', '' ) );
?>

<div class="vw-page-wrapper clearfix <?php vw_the_sidebar_position_class(); ?>">
	<div class="container">
		<div class="row">

			<div class="vw-page-content" role="main" itemprop="mainContentOfPage">

				<?php while ( have_posts() ) : the_post(); ?>
						<div class="vw-page-title-box clearfix">
							<?php if ( is_author() || 1 ) : ?>
								
								<h1 class="vw-page-title"><?php the_title(); ?></h1>
								<?php $subtitle = get_post_meta( $post->ID, 'vw_page_subtitle', true ); ?>
								<?php if ( $subtitle ) : ?>
								<div class="vw-page-description"><p><?php echo wp_kses_data( $subtitle ); ?></p></div>
								<?php endif;?>

							<?php endif; ?>
						</div>
					<?php the_content(); ?>

				<?php endwhile; ?>

			</div>

			<?php get_sidebar(); ?>

		</div>
	</div>
</div>

<?php get_footer(); ?>