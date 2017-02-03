<div class="vw-post-box vw-post-style-medium vw-post-style-medium-5 <?php vw_the_post_format_class(); ?>" <?php vw_itemtype('Article'); ?>>
	<?php vw_itemprop_meta( 'datePublished', get_the_time('c') ); ?>
	<?php vw_post_publisher(); ?>

	<div class="vw-post-box-thumbnail">
		<?php the_post_thumbnail( VW_CONST_THUMBNAIL_SIZE_POST_MEDIUM ); ?>
		<?php vw_the_post_format_icon(); ?>
		<?php vw_the_review_summary_bar(); ?>

		<?php vw_the_category(); ?>
		<h3 class="vw-post-box-title" <?php vw_itemprop('headline'); ?>>
			<a href="<?php the_permalink(); ?>" class="" <?php vw_itemprop('url'); ?>>
				<?php the_title(); ?>
			</a>
		</h3>

		<a href="<?php the_permalink(); ?>" class="vw-box-link" <?php vw_itemprop('url'); ?>>
			<?php the_title(); ?>
		</a>
	</div>
	
</div>