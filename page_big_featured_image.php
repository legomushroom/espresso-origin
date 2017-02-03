<?php 
/**
 * Template Name: Big Featured Image
 */
get_header(); ?>

<?php get_template_part( '/templates/page-title' ); ?>

<div class="vw-page-wrapper clearfix <?php vw_the_sidebar_position_class(); ?>">
	<div class="container">
		<div class="row">

			<div class="vw-page-content" role="main" itemprop="articleBody">

				<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>
						<article <?php post_class(); ?>>
						
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