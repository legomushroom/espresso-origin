<?php

add_action( 'init', 'vw_setup_custom_tiled_gallery' );
function vw_setup_custom_tiled_gallery() {
	$enable_custom_gallery = vw_get_theme_option( 'blog_enable_custom_tiled_gallery', '1' );

	// add_filter( 'use_default_gallery_style', '__return_false' ); // Disable default gallery style
	
	if ( $enable_custom_gallery ) {
		add_filter( 'post_gallery', 'vw_custom_tiled_gallery', 10, 2 );
	}
}

/* -----------------------------------------------------------------------------
 * Render custom post gallery
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_custom_tiled_gallery' ) ) {
	function vw_custom_tiled_gallery( $null, $attr = array() ) {
		global $post, $wp_locale;
		static $instance = 0;
		$instance++;

		extract(shortcode_atts(array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post->ID,
			'itemtag'    => 'figure',
			'captiontag' => 'figcaption',
			'columns'    => 3,
			'size'       => VW_CONST_THUMBNAIL_SIZE_CUSTOM_TILED_GALLERY,
			'include'    => '',
			'exclude'    => ''
		), $attr));

		$id = intval($id);
		if ( 'RAND' == $order )
		$orderby = 'none';
		
		if ( !empty($include) ) {
			$include = preg_replace( '/[^0-9,]+/', '', $include );
			$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		} elseif ( !empty($exclude) ) {
			$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
			$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		} else {
			$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}
		
		if ( empty($attachments) )
		return '';
		
		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment )
				$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
			return $output;
		}
		
		$itemtag = tag_escape($itemtag);
		$captiontag = tag_escape($captiontag);
		$float = is_rtl() ? 'right' : 'left';
		$gallery_layout = vw_get_theme_option( 'blog_custom_tiled_gallery_layout', '213' );
		
		$output = "<div id='".esc_attr( 'gallery-'.$instance )."' class='vw-custom-tiled-gallery ".esc_attr( 'galleryid-'.$id )." clearfix' data-gallery-layout='".esc_attr( $gallery_layout )."'>";
		
		if($itemtag != '' && $captiontag != '') {
			$i = 1;
			foreach ( $attachments as $id => $attachment ) {
				$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, false, false);
				$link = str_replace( '<a', '<a title="'.esc_attr( wp_strip_all_tags( $attachment->post_excerpt ) ).'" ', $link);
				
				$output .= "<{$itemtag} class='gallery-item'>";
				$output .= "$link";
				
				if ( $captiontag && trim($attachment->post_excerpt) ) {
					$output .= "
					<{$captiontag} class='gallery-caption'>
					" . wptexturize($attachment->post_excerpt) . "
					</{$captiontag}>";
				}
				$output .= "</{$itemtag}>";
				$i++;
			}
		}
		
		$output .= "</div>\n";
		return $output;
	}
}