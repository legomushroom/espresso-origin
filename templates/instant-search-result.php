<li class="vw-instant-search-result-item clearfix">
	<a class="vw-instant-search-result-link" href="<?php echo get_permalink(); ?>">
		<span class="vw-instant-search-result-thumbnail">
			<?php the_post_thumbnail( VW_CONST_THUMBNAIL_SIZE_INSTANT_SEARCH ); ?>
		</span>
		<div class="vw-instant-search-result-content">
			<div class="vw-instant-search-result-title vw-header-font"><?php the_title(); ?></div>
			<div class="vw-instant-search-result-date"><?php echo get_the_date(); ?></div>
		</div>
	</a>
</li>