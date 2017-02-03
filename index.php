<?php get_header(); ?>

<div class="vw-page-wrapper clearfix <?php vw_the_sidebar_position_class(); ?>">
	<div class="container">
		<div class="row">

			<div class="vw-page-content" role="main">
				
				<?php if ( is_search() ) : ?>

					<div class="vw-page-title-box clearfix">
						<div class="vw-page-title-box-inner">
							<h1 class="vw-page-title">
								<?php if ( get_search_query() ) : ?>

									<?php printf( __( 'Search Result for &ldquo;%s&rdquo;', 'envirra' ), get_search_query() ); ?>

								<?php else : ?>

									<?php _e( 'Search', 'envirra' ); ?>

								<?php endif; ?>
							</h1>
						</div>
					</div>

					<?php if ( ! have_posts() ) : ?>
						<div class="vw-no-search-result"><?php _e( 'No posts or pages were found.', 'envirra' ); ?></div>
					<?php endif; ?>

				<?php endif; ?>

				<?php if ( is_search() && get_search_query() == '' ) : ?>

					<?php the_widget( 'WP_Widget_Search' ); ?>

				<?php else: ?>

					<?php if ( have_posts() ) : ?>

						<?php do_action( 'vw_action_before_archive_posts' ); ?>

						<?php get_template_part( 'templates/post-loop/loop', vw_get_archive_blog_layout() ); ?>

						<?php do_action( 'vw_action_after_archive_posts' ); ?>

						<?php vw_the_pagination(); ?>

					<?php endif; ?>

				<?php endif; ?>
				
			</div>

			<?php get_sidebar(); ?>
		
		</div>
	</div>

</div>

<?php get_footer(); ?>