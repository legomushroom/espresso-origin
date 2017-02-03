<div class="vw-post-box vw-post-style-medium vw-post-style-medium-6 <?php vw_the_post_format_class(); ?>" <?php vw_itemtype('Article'); ?>>	
	<?php vw_itemprop_meta( 'datePublished', get_the_time('c') ); ?>
	<?php vw_post_publisher(); ?>

	<?php if ( has_post_thumbnail() ) : ?>
	<div class="vw-post-box-thumbnail-wrapper">
		<a class="vw-post-box-thumbnail" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
			<?php the_post_thumbnail( VW_CONST_THUMBNAIL_SIZE_POST_MEDIUM ); ?>
			<?php vw_the_post_format_icon(); ?>
			<?php vw_the_review_summary_bar(); ?>
		</a>
	</div>
	<?php endif; ?>

	<div class="vw-post-box-inner">

		<?php vw_the_category(); ?>
		<h3 class="vw-post-box-title" <?php vw_itemprop('headline'); ?>>
			<a href="<?php the_permalink(); ?>" class="" <?php vw_itemprop('url'); ?>>
				<?php the_title(); ?>
			</a>
		</h3>

		<div class="vw-post-meta">
			
			<?php vw_the_author(); ?>

			<span class="vw-post-meta-separator">/</span>

			<?php vw_the_post_date(); ?>

			<span class="vw-post-meta-separator">/</span>

			<?php vw_the_comment_link(); ?>
			
		</div>

		<div class="vw-post-box-excerpt"><?php vw_the_excerpt( VW_CONST_EXCERPT_LENGTH_MEDIUM_6 ); ?></div>
	
	</div>

</div>