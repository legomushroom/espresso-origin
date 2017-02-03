<div class="vw-post-loop vw-post-loop-medium-1 vw-post-loop-medium-1-col-2">
	<div class="row">
		<div class="col-sm-12">
			<div class="vw-isotope vw-block-grid vw-block-grid-xs-1 vw-block-grid-sm-2">

			<?php while( have_posts() ) : the_post(); ?>
				<div class="vw-block-grid-item">
					<?php get_template_part( 'templates/post-loop/post-medium-1', get_post_format() ); ?>
				</div>
			<?php endwhile; ?>

			</div>
		</div>
	</div>
</div>