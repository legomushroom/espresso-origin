<?php get_header(); ?>

<div class="vw-page-wrapper clearfix <?php vw_the_sidebar_position_class(); ?>">
	<div class="container">
		<div class="row">

			<div class="vw-page-content" role="main" itemprop="articleBody">

				<?php if ( have_posts() ) : ?>

					<?php do_action( 'vw_action_before_single_post' ); ?>

					<?php while ( have_posts() ) : the_post(); ?>
						<article <?php post_class( 'vw-main-post' ); ?>>

							<?php vw_the_breadcrumb(); ?>

							<?php vw_the_category(); ?>
							
							<h1 class="entry-title"><?php the_title(); ?></h1>
							
							<?php vw_the_subtitle(); ?>

							<span class="author vcard hidden"><span class="fn"><?php echo esc_attr( get_the_author() ); ?></span></span>
							<span class="updated hidden"><?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?></span>
							
							<?php vw_the_post_meta_large() ?>
							
							<?php vw_the_post_share_box() ?>

							<?php if ( vw_get_paged() == 1 ) : ?>

								<?php vw_the_embeded_media(); ?>
								
							<?php endif; ?>

							<div class="vw-post-content clearfix"><?php the_content(); ?></div>

							<?php vw_the_link_pages(); ?>

							<?php the_tags( '<div class="vw-tag-links"><span class="vw-tag-links-title">'.__( 'Tags:', 'envirra' ).'</span>', '', '</div>' ); ?>

						</article><!-- #post-## -->

					<?php endwhile; ?>

					<?php do_action( 'vw_action_after_single_post' ); ?>

					<?php vw_the_post_footer_sections(); ?>

				<?php endif; ?>

			</div>

			<?php get_sidebar(); ?>
		
		</div>
	</div>

</div>

<?php get_footer(); ?>