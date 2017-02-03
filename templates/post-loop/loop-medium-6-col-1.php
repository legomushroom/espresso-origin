<div class="vw-post-loop vw-post-loop-medium-6 vw-post-loop-medium-6-col-1">
	<div class="row">
		<div class="col-sm-12">

			<?php while( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'templates/post-loop/post-medium-6', get_post_format() ); ?>
			<?php endwhile; ?>

		</div>
	</div>
</div>