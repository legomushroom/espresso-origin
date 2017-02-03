<!-- Top Bar -->
<div class="vw-top-bar">

	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="vw-top-bar-inner">

					<div class="vw-top-bar-left">
						<?php get_template_part( 'templates/menu-top' ); ?>
					</div>
					
					<div class="vw-top-bar-right">
						<?php vw_the_site_social_profiles(); ?>

						<?php echo apply_filters( 'vw_filter_top_bar_right_additional_items', '' ); ?>
					</div>

				</div>
			</div>
		</div>
	</div>

</div>
<!-- End Top Bar -->