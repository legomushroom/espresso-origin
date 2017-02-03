<div class="vw-post-loop vw-post-loop-small-top-thumbnail vw-post-loop-small-top-thumbnail-2 vw-post-loop-col-2">	
	<div class="row">
		<div class="col-sm-12">

			<div class="vw-block-grid vw-block-grid-xs-2 vw-block-grid-md-4">
			
			<?php while( have_posts() ) : the_post(); ?>

				<div class="vw-block-grid-item">
					<?php get_template_part( 'templates/post-loop/post-small-top-thumbnail', get_post_format() ); ?>
				</div>

			<?php endwhile; ?>

			</div>

		</div>
	</div>
</div>