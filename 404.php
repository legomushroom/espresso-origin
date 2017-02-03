<?php get_header(); ?>

<div class="vw-page-wrapper clearfix">
	<div class="container">
		<div class="row">
			<div class="vw-page-content col-sm-12" role="main">

				<?php
				$page_404_id = vw_get_theme_option( 'site_404' );
				if ( !empty( $page_404_id ) ) : ?>
					<?php
					$page_404 = get_post( $page_404_id );
					echo apply_filters( 'the_content', $page_404->post_content ); 
					?>

				<?php else : ?>
					<?php echo do_shortcode( '[404]' ); ?>
					<h1>That page doesn't exist!</h1>
					<p><?php _e( "The page you were looking for appears to have been moved, deleted or does not exist.", 'envirra' ); ?></p>

				<?php endif; ?>

			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>