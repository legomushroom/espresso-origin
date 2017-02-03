<div class="vw-post-loop vw-post-loop-small-left-thumbnail vw-post-loop-col-3">	
	<div class="row">
		<div class="col-sm-12">

			<div class="vw-block-grid vw-block-grid-xs-1 vw-block-grid-sm-3">
			
			<?php while( have_posts() ) : the_post(); ?>

				<div class="vw-block-grid-item">
					<?php get_template_part( 'templates/post-loop/post-small-left-thumbnail', get_post_format() ); ?>
				</div>

			<?php endwhile; ?>

			</div>

		</div>
	</div>
</div>