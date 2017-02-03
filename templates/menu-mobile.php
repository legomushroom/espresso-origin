<!-- Mobile Menu -->
<nav class="vw-menu-mobile-wrapper">

	<?php
	$menu_location = has_nav_menu( 'vw_menu_mobile' ) ?  'vw_menu_mobile': 'vw_menu_main';
	if ( has_nav_menu( $menu_location ) ) {
		wp_nav_menu( apply_filters( 'vw_filter_navigation_mobile_args', array(
			'theme_location' => $menu_location,
			'container' => false,
			'menu_class' => 'vw-menu-location-mobile',
			'link_before' => '<span>',
			'link_after' => '</span>',
			'items_wrap' => '<ul id="%1$s" class="%2$s">'.vw_mobile_menu_add_buttons().'%3$s</ul>',
			'depth' => 3,
			'walker' => new Vw_Walker_Nav_Text_Menu()
		) ) );
	}
	?>

</nav>
<!-- End Mobile Menu -->