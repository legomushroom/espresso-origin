<?php

add_action( 'after_setup_theme', 'vw_setup_sidebars' );
function vw_setup_sidebars() {
	add_action( 'widgets_init', 'vw_register_sidebars' );
}

/* -----------------------------------------------------------------------------
 * Register sidebars
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_register_sidebars' ) ) {
	function vw_register_sidebars() {
		/**
		 * Blog widget sidebar
		 */

		register_sidebar( array(
			'name' => __( 'Blog Right Sidebar', 'envirra' ),
			'id'   => 'blog-right-sidebar',
			'description'   => __( 'These are widgets for the Blog sidebar.', 'envirra' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>'
		) );

		register_sidebar( array(
			'name' => __( 'Blog Left Sidebar', 'envirra' ),
			'id'   => 'blog-left-sidebar',
			'description'   => __( 'These are widgets for the Blog sidebar.', 'envirra' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>'
		) );

		/**
		 * Page widget sidebar
		 */
		register_sidebar( array(
			'name' => __( 'Page Sidebar', 'envirra' ),
			'id'   => 'page-sidebar',
			'description'   => __( 'These are widgets for the static page.', 'envirra' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>'
		) );
		
		/**
		 * Footer sidebar
		 */
		register_sidebar( array(
			'name' => __( 'Footer Sidebar 1', 'envirra' ),
			'id'   => 'footer-sidebar-1',
			'description'   => __( 'These are widgets for the Footer.', 'envirra' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>'
		) );
		register_sidebar( array(
			'name' => __( 'Footer Sidebar 2', 'envirra' ),
			'id'   => 'footer-sidebar-2',
			'description'   => __( 'These are widgets for the Footer.', 'envirra' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>'
		) );
		register_sidebar( array(
			'name' => __( 'Footer Sidebar 3', 'envirra' ),
			'id'   => 'footer-sidebar-3',
			'description'   => __( 'These are widgets for the Footer.', 'envirra' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>'
		) );
		register_sidebar( array(
			'name' => __( 'Footer Sidebar 4', 'envirra' ),
			'id'   => 'footer-sidebar-4',
			'description'   => __( 'These are widgets for the Footer.', 'envirra' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>'
		) );
	}
}