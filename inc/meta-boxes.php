<?php
// require_once get_template_directory().'/components/meta-box/meta-box.php';

/* -----------------------------------------------------------------------------
 * Register meta boxes
 * -------------------------------------------------------------------------- */
add_filter( 'rwmb_meta_boxes', 'vw_register_meta_boxes' );
if ( ! function_exists( 'vw_register_meta_boxes' ) ) {
	function vw_register_meta_boxes( $meta_boxes ) {
		
		/* -----------------------------------------------------------------------------
		 * Page - Gallery
		 * -------------------------------------------------------------------------- */
		// $meta_boxes[] = array(
		// 	'id' => 'vw_page_gallery',
		// 	'title' => 'Page - Gallery',
		// 	'pages' => array( 'page' ),
		// 	'fields' => array(
		// 		array(
		// 			'name' => 'Gallery',
		// 			'id' => 'vw_page_gallery_project',
		// 			'type' => 'post',
		// 			'post_type' => 'portfolio',
		// 		),
		// 	)
		// );

		/* -----------------------------------------------------------------------------
		 * Post Formats
		 * -------------------------------------------------------------------------- */
		$meta_boxes[] = array(
			'id' => 'vw_post_format_gallery',
			'title' => 'Gallery Post Options',
			'pages' => array( 'post' ),
			'fields' => array(
				array(
					'name' => 'Gallery Images',
					'id' => 'vw_post_format_gallery_images',
					'type' => 'image_advanced',
				),
			)
		);

		$meta_boxes[] = array(
			'id' => 'vw_post_format_audio',
			'title' => 'Audio Post Options',
			'pages' => array( 'post' ),
			'fields' => array(
				array(
					'name' => 'Sound Cloud Audio Source',
					'id' => 'vw_post_format_audio_oembed_url',
					'type' => 'oembed',
					'desc' => 'Paste page URL from SoundCloud',
				),
				array(
					'name' => 'Embed Audio Code',
					'id' => 'vw_post_format_audio_oembed_code',
					'type' => 'textarea',
					'desc' => 'Paste an embed code',
				),
			)
		);

		$meta_boxes[] = array(
			'id' => 'vw_post_format_video',
			'title' => 'Video Post Options',
			'pages' => array( 'post' ),
			'fields' => array(
				array(
					'name' => 'Video Source',
					'id' => 'vw_post_format_video_oembed_url',
					'type' => 'oembed',
					'desc' => 'Paste page URL from YouTube, Vimeo.',
				),
				array(
					'name' => 'Embed Video Code',
					'id' => 'vw_post_format_video_oembed_code',
					'type' => 'textarea',
					'desc' => 'Paste an embed code',
				),
			)
		);

		return $meta_boxes;
	}
}