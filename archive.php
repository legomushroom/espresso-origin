<?php get_header(); ?>

<div class="vw-page-wrapper clearfix <?php vw_the_sidebar_position_class(); ?>">
	<div class="container">
		<div class="row">

			<div class="vw-page-content" role="main">
					<div class="vw-page-title-box clearfix">
						<?php if ( is_author() ) : ?>

								<div class="vw-page-title-box-inner">
									<?php $author = vw_get_current_author(); ?>
									<span class="vw-label vw-header-font"><?php _e( 'Author Archive', 'envirra' ); ?></span>
									<h1 class="vw-page-title"><?php echo $author->display_name; ?></h1>
								</div>

						<?php elseif ( is_category() ) : ?>

							<?php $the_category_thumbnail = vw_get_the_category_thumbnail();
							$cat_ID = get_query_var('cat');
							if ( $the_category_thumbnail ) : ?>
							<div class="vw-page-title-thumbnail"><?php echo $the_category_thumbnail; ?></div>
							<?php endif; ?>
							
							<div class="vw-page-title-box-inner">
								<span class="vw-label vw-header-font"><?php _e( 'Posts In Category', 'envirra' ); ?></span>

								<h1 class="vw-page-title"><?php echo single_cat_title( '', false ); ?></h1>

								<?php if ( category_description( $cat_ID ) ) : ?>
								<div class="vw-page-description"><?php echo category_description( $cat_ID ); ?></div>
								<?php endif; ?>
							</div>

						<?php elseif ( is_day() || is_month() || is_year() ) : ?>

								<div class="vw-page-title-box-inner">
									<span class="vw-label vw-header-font"><?php _e( 'Post Archive', 'envirra' ); ?></span>
									<h1 class="vw-page-title"><?php echo vw_get_archive_date(); ?></h1>
								</div>

						<?php elseif ( is_tag() ) : ?>

								<div class="vw-page-title-box-inner">

									<?php $term = get_queried_object(); ?>
									<span class="vw-label vw-header-font"><?php _e( 'Posts Tagged', 'envirra' ); ?></span>
									<h1 class="vw-page-title"><?php echo single_tag_title( '', false ); ?></h1>

									<?php if ( ! empty( $term->description ) ) : ?>
									<div class="vw-page-description"><?php echo $term->description; ?></div>
									<?php endif; ?>
								</div>

						<?php endif; ?>
					</div>

					<?php if ( is_author() ) : ?>
						<div class="vw-author-archive-info clearfix">
							<?php vw_the_author_avatar( $author, VW_CONST_AVATAR_SIZE_LARGE ); ?>
							<p class="vw-author-bio" <?php vw_itemprop('description'); ?>><?php echo nl2br( $author->user_description ); ?></p>

							<div class="vw-author-socials">
								<?php vw_the_user_social_links(); ?>
							</div>
						</div>
					<?php endif; ?>

				<?php if ( have_posts() ) : ?>

					<?php do_action( 'vw_action_before_archive_posts' ); ?>

					<?php get_template_part( 'templates/post-loop/loop', vw_get_archive_blog_layout() ); ?>

					<?php do_action( 'vw_action_after_archive_posts' ); ?>

					<?php vw_the_pagination(); ?>

				<?php endif; ?>

			</div>

			<?php get_sidebar(); ?>
		
		</div>
	</div>

</div>

<?php get_footer(); ?>