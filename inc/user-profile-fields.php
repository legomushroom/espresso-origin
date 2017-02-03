<?php 

add_filter( 'user_contactmethods', 'vw_user_social_links' );
if ( ! function_exists( 'vw_user_social_links' ) ) {
	function vw_user_social_links( $contact_methods ) {
		$contact_methods['public_email'] = 'Public Email';
		$contact_methods['twitter'] = 'Twitter';
		$contact_methods['facebook'] = 'Facebook';
		$contact_methods['google_plus'] = 'Google+';
		$contact_methods['pinterest'] = 'Pinterest';
		$contact_methods['tumblr'] = 'Tumblr';
		$contact_methods['instagram'] = 'Instagram';
		$contact_methods['500px'] = '500px';
		$contact_methods['dribbble'] = 'Dribbble';
		$contact_methods['flickr'] = 'Flickr';
		$contact_methods['linkedin'] = 'LinkedIn';
		$contact_methods['skype'] = 'Skype';
		$contact_methods['soundcloud'] = 'SoundCloud';
		$contact_methods['youtube'] = 'YouTube';
		$contact_methods['vimeo'] = 'Vimeo';

		return $contact_methods;
	}
}

if ( ! function_exists( 'vw_the_user_social_links' ) ) {
	function vw_the_user_social_links( $author = null ) {
		vw_render_user_social_link( $author, 'twitter',		'icon-social-twitter',		__( 'Twitter', 'envirra' ) );
		vw_render_user_social_link( $author, 'facebook',		'icon-social-facebook',		__( 'Facebook', 'envirra' ) );
		vw_render_user_social_link( $author, 'google_plus',	'icon-social-gplus',		__( 'Google+', 'envirra' ) );
		vw_render_user_social_link( $author, 'pinterest',	'icon-social-pinterest',	__( 'Pinterest', 'envirra' ) );
		vw_render_user_social_link( $author, 'tumblr',		'icon-social-tumblr',		__( 'Tumblr', 'envirra' ) );
		vw_render_user_social_link( $author, 'instagram',	'icon-social-instagram',	__( 'Instagram', 'envirra' ) );
		vw_render_user_social_link( $author, '500px',		'icon-social-fivehundredpx',__( '500px', 'envirra' ) );
		vw_render_user_social_link( $author, 'dribbble',		'icon-social-dribbble',		__( 'Dribbble', 'envirra' ) );
		vw_render_user_social_link( $author, 'flickr',		'icon-social-flickr',		__( 'Flickr', 'envirra' ) );
		vw_render_user_social_link( $author, 'linkedin',		'icon-social-linkedin',		__( 'Linkedin', 'envirra' ) );
		vw_render_user_social_link( $author, 'skype',		'icon-social-skype',		__( 'Skype', 'envirra' ) );
		vw_render_user_social_link( $author, 'soundcloud',	'icon-social-soundcloud',	__( 'SoundCloud', 'envirra' ) );
		vw_render_user_social_link( $author, 'youtube',		'icon-social-youtube',		__( 'Youtube', 'envirra' ) );
		vw_render_user_social_link( $author, 'vimeo',		'icon-social-vimeo',		__( 'Vimeo', 'envirra' ) );
		vw_render_user_social_link( $author, 'public_email',	'icon-social-email',		__( 'Email', 'envirra' ) );
	}
}
if ( ! function_exists( 'vw_render_user_social_link' ) ) {
	function vw_render_user_social_link( $author, $social_field, $social_icon, $social_label ) {
		if ( ! $author ) {
			$author = vw_get_current_author();
		}
		$social_link = esc_url( get_the_author_meta( $social_field, $author->ID ) );

		if ( ! empty( $social_link ) ) :
		?>
		<a class="vw-icon-social <?php esc_attr( sprintf( 'vw-%1s', $social_icon ) ); ?>" rel="author" href="<?php echo esc_url( $social_link ); ?>" title="<?php echo esc_attr( $social_label ); ?>" target="_blank" <?php vw_itemprop('url'); ?>>
			<i class="<?php echo esc_attr( $social_icon ); ?> icon-small"></i>
		</a>
		<?php endif;
	}
}