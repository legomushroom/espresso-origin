<?php
/***
http://www.wpexplorer.com/adding-custom-attributes-to-wordpress-menus/
*/

add_filter( 'vw_filter_mega_menu_edit_custom_field', 'vw_mega_menu_edit_custom_field', 10, 2 );
if ( ! function_exists( 'vw_mega_menu_edit_custom_field' ) ) {
	function vw_mega_menu_edit_custom_field( $item, $depth ) {
		// if ( 0 != $depth || $item->object != 'category' ) return '';
		if ( 0 != $depth ) return '';

		$item_id = esc_attr( $item->ID );

		ob_start();
		?>
		<p class="description description-wide vw-mega-menu-option">
			<label for="edit-menu-item-vw-menu-type-<?php echo $item_id; ?>">
				<?php _e( 'Mega Menu Type', 'envirra' ); ?><br />
				<select class="widefat edit-menu-item-vw-menu-type" id="edit-menu-item-vw-menu-type-<?php echo $item_id; ?>" name="menu-item-vw-menu-type[<?php echo $item_id; ?>]">
					<option value="classic" <?php selected( $item->vw_menu_type, 'classic' ); ?>><?php _e( 'Classic Menu', 'envirra' ) ?></option>
					<option value="category" <?php selected( $item->vw_menu_type, 'category' ); ?>><?php _e( 'Category Mega Menu', 'envirra' ) ?></option>
					<option value="links-4-cols" <?php selected( $item->vw_menu_type, 'links-4-cols' ); ?>><?php _e( '4 Columns Links Mega Menu', 'envirra' ) ?></option>
				</select>
			</label>
		</p>
		<?php
		return ob_get_clean();
	}
}

add_filter( 'wp_edit_nav_menu_walker', 'vw_custom_nav_edit_walker', 10, 2 );
function vw_custom_nav_edit_walker( $walker, $menu_id ) {
	require_once 'mega-menu-edit-walker.php';
	return 'Vw_Walker_Nav_Mega_Menu_Edit';
}

/*
 * Adds value of new field to $item object that will be passed to     Walker_Nav_Menu_Edit_Custom
 */
add_filter( 'wp_setup_nav_menu_item','vw_custom_nav_item' );
function vw_custom_nav_item( $menu_item ) {
	$menu_item->vw_menu_type = get_post_meta( $menu_item->ID, '_vw_menu_type', true );

	if ( empty( $menu_item->vw_menu_type ) ) {
		$menu_item->vw_menu_type = 'classic';
	}

	return $menu_item;
}

/*
 * Saves new field to postmeta for navigation
 */
add_action( 'wp_update_nav_menu_item', 'vw_custom_nav_update', 10, 3 );
function vw_custom_nav_update( $menu_id, $menu_item_db_id, $args ) {
	if ( isset( $_REQUEST['menu-item-vw-menu-type'][$menu_item_db_id] ) ) {
		$custom_value = $_REQUEST['menu-item-vw-menu-type'][$menu_item_db_id];
		update_post_meta( $menu_item_db_id, '_vw_menu_type', $custom_value );
	}
}