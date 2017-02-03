<?php
/* -----------------------------------------------------------------------------
 * Mega Menu Walker
 * -------------------------------------------------------------------------- */
if ( ! class_exists( 'Vw_Walker_Nav_Mega_Menu', false ) ) {
	class Vw_Walker_Nav_Mega_Menu extends Walker_Nav_Menu {

		// add classes to ul sub-menus
		function start_lvl( &$output, $depth = 0, $args = array() ) {
			// depth dependent classes
			$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
			$display_depth = ( $depth + 1); // because it counts the first submenu as 0
			$classes = array(
				'sub-menu',
				( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
				( $display_depth >=2 ? 'sub-sub-menu' : '' ),
				'menu-depth-' . $display_depth
				);
			$class_names = implode( ' ', $classes );

			// build html
			$output .= "\n" . $indent . '<ul class="' . esc_attr( $class_names ) . '">' . "\n";
		}
		  
		// add main/sub classes to li's and links
		 function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
		  
			// depth dependent classes
			$depth_classes = array(
				( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
				( $depth >=2 ? 'sub-sub-menu-item' : '' ),
				( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
				'menu-item-depth-' . $depth
			);
			// if ( $depth == 0 ) {
			// 	$depth_classes[] = $this->vw_menu_class;
			// }
			$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
		  
			// passed classes
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;

			if ( $depth == 0 ) {
				$classes[] = 'vw-mega-menu-type-'.$item->vw_menu_type;

				if ( strpos( $item->vw_menu_type, 'category' ) === 0 ) {
					$classes[] = 'vw-mega-menu-has-posts';
				}

				if ( $item->object == 'category' ) {
					$classes[] = vw_get_the_category_class( $item->object_id );
				}
			}

			$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
		  
			// build html
			$output .= $indent . '<li class="' . esc_attr( 'nav-menu-item-'. $item->ID . ' ' . $depth_class_names . ' ' . $class_names ) . '">';
		  
			// link attributes
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
			$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
			$attributes .= ' '.vw_get_itemprop('url').' ';
		  
			$item_output = sprintf( '%1$s<a %2$s>%3$s%4$s%5$s</a>%6$s',
				$args->before,
				$attributes,
				$args->link_before,
				apply_filters( 'the_title', $item->title, $item->ID ),
				$args->link_after,
				$args->after
			);

			/* Add custom menu */
			if ( $item->vw_menu_type == 'category' || in_array( 'menu-item-has-children', $item->classes ) ) {
				$item_output .= '<div class="sub-menu-wrapper">';
			}
			// var_dump($item);

			// build html
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

		function end_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
			global $wp_query;
			global $post;

			/* Add mega menu */
			if ( $depth == 0 ) {
				ob_start();
				do_action( 'vw_action_mega_menu_render_as_'.$item->vw_menu_type, $item, $depth );
				$output .= ob_get_clean();
			}

			if ( $item->vw_menu_type == 'category' || in_array( 'menu-item-has-children', $item->classes ) ) {
				$output .= "</div>\n"; // .sub-menu-wrapper
			}
			
			$output .= "</li>\n";
		}

		/*function display_element ( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
			// check, whether there are children for the given ID and append it to the element with a (new) ID
			$element->hasChildren = isset( $children_elements[ $element->ID ] ) && ! empty( $children_elements[ $element->ID ] );

			$fn_output = parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

			if ( $depth > 0 ) {
				$output .= '<div class="sub-menu-wrapper">';
			}

			return $fn_output;
		}*/
	}
}

/* -----------------------------------------------------------------------------
 * Text Menu Walker
 * -------------------------------------------------------------------------- */
if ( ! class_exists( 'Vw_Walker_Nav_Text_Menu', false ) ) {
	class Vw_Walker_Nav_Text_Menu extends Walker_Nav_Menu {

		// add classes to ul sub-menus
		function start_lvl( &$output, $depth = 0, $args = array() ) {
			// depth dependent classes
			$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
			$display_depth = ( $depth + 1); // because it counts the first submenu as 0
			$classes = array(
				'sub-menu',
				( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
				( $display_depth >=2 ? 'sub-sub-menu' : '' ),
				'menu-depth-' . $display_depth
				);
			$class_names = implode( ' ', $classes );
		  
			// build html
			$output .= "\n" . $indent . '<ul class="' . esc_attr( $class_names ) . '">' . "\n";
		}
		
		// add main/sub classes to li's and links
		 function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			global $wp_query;
			$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

			// depth dependent classes
			$depth_classes = array(
				( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
				( $depth >=2 ? 'sub-sub-menu-item' : '' ),
				( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
				'menu-item-depth-' . $depth
			);
			$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

			// passed classes
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

			// build html
			$output .= $indent . '<li class="' . esc_attr( 'nav-menu-item-'. $item->ID . ' ' . $depth_class_names . ' ' . $class_names ) . '">';

			// link attributes
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
			$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

			$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
				$args->before,
				$attributes,
				$args->link_before,
				apply_filters( 'the_title', $item->title, $item->ID ),
				$args->link_after,
				$args->after
			);

			// build html
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
}

if ( ! class_exists( 'vw_icon_text_menu_walker', false ) ) {
	class vw_icon_text_menu_walker extends Walker_Nav_Menu {
		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;

			foreach ( $classes as $key => $class ) {
				if ( false !== strpos( $class, 'icon-' ) ) {
					$item->title = sprintf( '<i class="%s"></i>', esc_attr( $class ) );
					$classes[$key] = '';
				} else if ( 'large-menu' == $class ) {
					$classes[$key] = ''; // Do not accept large menu
				}
			}

			$item->classes = $classes;
			if (!empty($args));
			parent::start_el($output, $item, $depth, $args);
		}
	}
}