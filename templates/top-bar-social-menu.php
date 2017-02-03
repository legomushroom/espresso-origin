<!-- Top Bar -->
<div class="vw-top-bar vw-top-bar-social-menu">

	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="vw-top-bar-inner">

					<div class="vw-top-bar-left">
						<?php vw_the_site_social_profiles(); ?>

						<?php echo apply_filters( 'vw_filter_top_bar_right_additional_items', '' ); ?>
					</div>
					
					<div class="vw-top-bar-right">
						<?php get_template_part( 'templates/menu-top' ); ?>
					</div>

				</div>
			</div>
		</div>
	</div>

</div>
<!-- End Top Bar -->