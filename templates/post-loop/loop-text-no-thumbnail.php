<div class="vw-post-loop vw-post-loop-text-no-thumbnail">	
	<div class="row">
		<div class="col-sm-12">
			
			<?php while( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'templates/post-loop/post-text-no-thumbnail', get_post_format() ); ?>
			<?php endwhile; ?>

		</div>
	</div>
</div>