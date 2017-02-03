<?php
$sidebar_position = vw_get_sidebar_position();
$has_left_sidebar = in_array( $sidebar_position, array( 'left', 'mini-content-right', 'left-content-mini', 'content-mini-right' ) );
$has_right_sidebar = in_array( $sidebar_position, array( 'right', 'mini-content-right', 'left-content-mini', 'content-mini-right' ) );

if ( $sidebar_position != 'none' ) : ?>

	<?php if ( $has_left_sidebar ) : ?>
	<aside class="vw-page-sidebar vw-page-sidebar-left" <?php vw_itemtype('WPSideBar'); ?>>
		<meta <?php vw_itemprop('name'); ?> content="Left Sidebar">

		<?php dynamic_sidebar( vw_get_left_sidebar() ); ?>

	</aside>
	<?php endif; ?>

	<?php if ( $has_right_sidebar ) : ?>
	<aside class="vw-page-sidebar vw-page-sidebar-right" <?php vw_itemtype('WPSideBar'); ?>>
		<meta <?php vw_itemprop('name'); ?> content="Right Sidebar">

		<?php dynamic_sidebar( vw_get_right_sidebar() ); ?>

	</aside>
	<?php endif; ?>

<?php endif; ?>