<!-- Site Header : Left Logo -->
<header class="vw-site-header vw-site-header-style-left-logo clearfix" <?php vw_itemtype('WPHeader'); ?>>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="vw-site-header-inner">
					<?php get_template_part( 'templates/logo' ); ?>

					<div class="vw-mobile-nav-button-wrapper">
						<span class="vw-mobile-nav-button">
							<span class="vw-hamburger-icon"><span></span></span>
						</span>
					</div>
				
					<?php get_template_part( 'templates/header-ads' ); ?>
				</div>
			</div>
		</div>
	</div>

	<?php get_template_part( 'templates/menu-main' ); ?>
	
	<?php get_template_part( 'templates/menu-mobile' ); ?>
</header>
<!-- End Site Header : Left Logo -->