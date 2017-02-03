<?php vw_query_breaking_news_posts(); ?>
<?php if ( have_posts() ) : ?>
	
<div class="vw-breaking-news-bar">
	<div class="clearfix"></div>
	<div class="vw-breaking-news">
		<?php get_template_part( 'templates/post-loop/loop-slider-large-carousel' ); ?>
	</div>
</div>

<?php endif; ?>
<?php wp_reset_query(); ?>