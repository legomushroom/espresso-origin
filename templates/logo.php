<!-- Logo -->
<div class="vw-logo-wrapper" <?php vw_itemtype('Organization'); ?>>
	
	<a class="vw-logo-link" href="<?php echo home_url(); ?>" <?php vw_itemprop('url'); ?>>
		<?php $logo = vw_get_theme_option( 'logo' ); ?>
		<?php $logo_2x = vw_get_theme_option( 'logo_2x' ); ?>

		<!-- Site Logo -->
		<?php if ( ! empty( $logo[ 'url' ] ) ): ?>

			<!-- Retina Site Logo -->
			<?php if ( ! empty( $logo_2x[ 'url' ] ) ): ?>
				<img class="vw-logo-2x" src="<?php echo esc_url( $logo_2x[ 'url' ] ); ?>" width="<?php echo esc_attr( $logo[ 'width' ] ) ?>" height="<?php echo esc_attr( $logo[ 'height' ] ) ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" <?php vw_itemprop('logo'); ?>>
			<?php endif; ?>

			<img class="vw-logo" src="<?php echo esc_url( $logo[ 'url' ] ); ?>" width="<?php echo esc_attr( $logo[ 'width' ] ) ?>" height="<?php echo esc_attr( $logo[ 'height' ] ) ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" <?php vw_itemprop('logo'); ?>>

		<?php else: ?>

			<h1 class="vw-site-title" <?php vw_itemprop('name'); ?>><?php bloginfo( 'name' ); ?></h1>

			<?php if ( get_bloginfo( 'description' ) ): ?>
				<h2 class="vw-site-tagline" <?php vw_itemprop('description'); ?>><?php bloginfo( 'description' ) ?></h2>
			<?php endif; ?>
			
		<?php endif; ?>
	</a>

</div>
<!-- End Logo -->