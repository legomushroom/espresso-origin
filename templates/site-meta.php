<!-- Site Meta From Theme -->
<link rel="profile" href="http://gmpg.org/xfn/11">

<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">

<meta name="description" content="<?php echo esc_attr( get_bloginfo('description') ); ?>">

<link href="//www.google-analytics.com" rel="dns-prefetch">

<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes">

<?php $fav_icon = vw_get_theme_option( 'fav_icon' );
if( ! empty( $fav_icon['url'] ) ) : ?><link rel="shortcut icon" href="<?php echo esc_url( $fav_icon['url'] ); ?>"><?php endif; ?>
		
<?php $fav_icon_iphone = vw_get_theme_option( 'fav_icon_iphone' );
if( ! empty( $fav_icon_iphone['url'] ) ) : ?><link rel="apple-touch-icon" href="<?php echo esc_url( $fav_icon_iphone['url'] ); ?>"><?php endif; ?>

<?php $fav_icon_iphone_retina = vw_get_theme_option( 'fav_icon_iphone_retina' );
if( ! empty( $fav_icon_iphone_retina['url'] ) ) : ?><link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url( $fav_icon_iphone_retina['url'] ); ?>"><?php endif; ?>

<?php $fav_icon_ipad = vw_get_theme_option( 'fav_icon_ipad' );
if( ! empty( $fav_icon_ipad['url'] ) ) : ?><link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url( $fav_icon_ipad['url'] ); ?>"><?php endif; ?>

<?php $fav_icon_ipad_retina = vw_get_theme_option( 'fav_icon_ipad_retina' );
if( ! empty( $fav_icon_ipad_retina['url'] ) ) : ?><link rel="apple-touch-icon" sizes="144x144" href="<?php echo esc_url( $fav_icon_ipad_retina['url'] ); ?>"><?php endif; ?>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- End Site Meta From Theme -->