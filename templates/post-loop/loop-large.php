<div class="vw-post-loop vw-post-loop-large">	
	<div class="row">
		<div class="col-sm-12">
			
			<?php while( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'templates/post-loop/post-large', get_post_format() ); ?>
			<?php endwhile; ?>

		</div>
	</div>
</div>