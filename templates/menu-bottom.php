<!-- Bottom Menu -->
<nav class="vw-menu-bottom-wrapper">
<?php
if ( has_nav_menu('vw_menu_bottom' ) ) {
	wp_nav_menu( apply_filters( 'vw_filter_menu_bottom_args', array(
		'theme_location' => 'vw_menu_bottom',
		'container' => false,
		'menu_class' => 'vw-menu vw-menu-location-bottom vw-menu-type-text clearfix',
		'link_before' => '<span>',
		'link_after' => '</span>',
		'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth' => 1,
		'walker' => new Vw_Walker_Nav_Text_Menu()
	) ) );
}
?>
</nav>
<!-- End Bottom Menu -->