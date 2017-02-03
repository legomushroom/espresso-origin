<div class="vw-post-loop vw-post-loop-slider vw-post-loop-slider-large">
	<div class="clearfix"></div>
	<div class="swiper-container vw-swiper-large-nav">
		<div class="swiper-wrapper">
		<?php while( have_posts() ) : the_post(); ?>
			<div class="swiper-slide">
				<?php get_template_part( 'templates/post-loop/post-slide-large', get_post_format() ); ?>
			</div>
		<?php endwhile; ?>
		</div>
	</div>
</div>