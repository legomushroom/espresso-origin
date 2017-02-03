<div class="vw-post-loop vw-post-loop-slider vw-post-loop-slider-large-carousel">
	<div class="swiper-container">
		<div class="swiper-wrapper">
		<?php while( have_posts() ) : the_post(); ?>
			<div class="swiper-slide">
				<?php get_template_part( 'templates/post-loop/post-slide-large-carousel', get_post_format() ); ?>
			</div>
		<?php endwhile; ?>
		</div>
	</div>
</div>