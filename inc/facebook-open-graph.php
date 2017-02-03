<?php

/* -----------------------------------------------------------------------------
 * Init Facebook Open Graph
 * -------------------------------------------------------------------------- */
add_action( 'wp_head', 'vw_init_facebook_open_graph' );
if ( ! function_exists( 'vw_init_facebook_open_graph' ) ) {
	function vw_init_facebook_open_graph() {
		if ( vw_get_theme_option( 'site_enable_open_graph' ) ) {
			vw_render_facebook_open_graph();
		}
	}
}

/* -----------------------------------------------------------------------------
 * Render Facebook Open Graph
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_render_facebook_open_graph' ) ) {
	function vw_render_facebook_open_graph() {
		global $post;
		?>
		<!-- Facebook Integration -->

		<meta property="og:site_name" content="<?php bloginfo('name'); ?>">

		<?php if ( is_singular() && have_posts() ) : setup_postdata( $post ); ?>
			<meta property="og:title" content="<?php echo esc_attr( wp_strip_all_tags( get_the_title(), true ) ); ?>">
			<meta property="og:description" content="<?php echo esc_attr( wp_strip_all_tags( get_the_excerpt(), true ) ); ?>">
			<meta property="og:url" content="<?php the_permalink(); ?>"/>
			<?php if ( has_post_thumbnail() ) : $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full' );	?>
			<meta property="og:image" content="<?php echo esc_url( $thumbnail[0] ); ?>" />
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>

		<?php else : ?>
			<meta property="og:title" content="<?php esc_attr( get_bloginfo('name') ); ?>">
			<meta property="og:description" content="<?php esc_attr( get_bloginfo('description') ); ?>">
			<meta property="og:url" content="<?php echo home_url(); ?>"/>

		<?php endif; ?>

		<!-- End Facebook Integration -->
		<?php
	}
}