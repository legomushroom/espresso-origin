<!-- Top Menu -->
<nav class="vw-menu-top-wrapper">
<?php
if ( has_nav_menu('vw_menu_top' ) ) {
	wp_nav_menu( apply_filters( 'vw_filter_menu_top_args', array(
		'theme_location' => 'vw_menu_top',
		'container' => false,
		'menu_class' => 'vw-menu vw-menu-location-top vw-menu-type-text clearfix',
		'link_before' => '<span>',
		'link_after' => '</span>',
		'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth' => 3,
		'walker' => new Vw_Walker_Nav_Text_Menu()
	) ) );
}
?>
</nav>
<!-- End Top Menu -->