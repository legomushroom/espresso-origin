<div class="vw-post-box vw-post-style-slide <?php vw_the_post_format_class(); ?>" <?php vw_itemtype('Article'); ?>>
	<?php vw_itemprop_meta( 'datePublished', get_the_time('c') ); ?>
	<?php vw_post_publisher(); ?>

	<?php if ( has_post_thumbnail() ) : ?>
		<a class="vw-post-box-thumbnail" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
			<?php the_post_thumbnail( VW_CONST_THUMBNAIL_SIZE_POST_SLIDER_SMALL ); ?>
		</a>
	<?php endif; ?>

	<div class="vw-post-box-inner">
		<?php vw_the_category(); ?>
		<h3 class="vw-post-box-title" <?php vw_itemprop('headline'); ?>><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'envirra'), the_title_attribute('echo=0') ); ?>" rel="bookmark" <?php vw_itemprop('url'); ?>><?php the_title(); ?></a></h3>
	</div>
	
</div>