<div class="vw-post-loop vw-post-loop-mix vw-post-loop-mix-2 vw-post-loop-mix-2-col-3">

	<div class="row">
		<div class="col-md-4 col-sm-12">
			<?php if( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'templates/post-loop/post-medium-4', get_post_format() ); ?>
			<?php endif; ?>
		</div>

		<div class="col-md-8 col-sm-12">
			<div class="vw-block-grid vw-block-grid-xs-1 vw-block-grid-sm-2">

			<?php while( have_posts() ) : the_post(); ?>
				<div class="vw-block-grid-item">
					<?php get_template_part( 'templates/post-loop/post-small-left-thumbnail', get_post_format() ); ?>
				</div>
			<?php endwhile; ?>

			</div>
		</div>
	</div>
</div>