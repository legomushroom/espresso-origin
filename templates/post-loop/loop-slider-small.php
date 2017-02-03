<div class="vw-post-loop vw-post-loop-slider vw-post-loop-slider-small vw-single-slider vw-swiper-small-nav">
	<div class="swiper-container">
		<div class="swiper-wrapper">
		<?php while( have_posts() ) : the_post(); ?>
			<div class="swiper-slide">
				<?php get_template_part( 'templates/post-loop/post-slide-small', get_post_format() ); ?>
			</div>
		<?php endwhile; ?>
		</div>
	</div>
</div>