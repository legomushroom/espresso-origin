<div class="vw-post-loop vw-post-loop-mix vw-post-loop-mix-3 vw-post-loop-mix-3-col-1">

	<?php if( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'templates/post-loop/post-medium-4', get_post_format() ); ?>
	<?php endif; ?>

	<?php while( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'templates/post-loop/post-small-left-thumbnail', get_post_format() ); ?>
	<?php endwhile; ?>

</div>