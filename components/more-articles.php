<?php
/* -----------------------------------------------------------------------------
 * More Articles
 * -------------------------------------------------------------------------- */
add_action( 'after_setup_theme', 'vw_init_more_articles' );
if ( ! function_exists( 'vw_init_more_articles' ) ) {
	function vw_init_more_articles() {
		if ( vw_get_theme_option( 'blog_enable_more_articles' ) ) {
			add_action( 'wp_footer', 'vw_render_more_articles' );
		}
	}
}

if ( ! function_exists( 'vw_render_more_articles' ) ) {
	function vw_render_more_articles() {
		if ( is_single() && 'post' == get_post_type() ) {
			$args = array(
				'post__not_in' => array( get_queried_object_id() ),
				'orderby' => 'rand',
				'posts_per_page'=> 1,
				'ignore_sticky_posts'=> 1,
				);

			query_posts( apply_filters( 'vw_filter_more_articles_query_args', $args ) );
			
			if ( have_posts() ) { the_post();
				get_template_part( 'templates/more-articles', get_post_format() );
			}

			wp_reset_query();
		}
	}
}
