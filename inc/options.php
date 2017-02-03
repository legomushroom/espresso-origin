<?php

if ( ! defined( 'VW_CONST_REDUX_ASSET_URL' ) ) define( 'VW_CONST_REDUX_ASSET_URL', get_template_directory_uri() . '/images/admin' );

/* -----------------------------------------------------------------------------
 * Theme Option Proxy
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_get_theme_option' ) ) {
	function vw_get_theme_option( $opt_name, $default = null ) {
		global $vw_espresso;
		if ( isset( $vw_espresso[ $opt_name ] ) ) return $vw_espresso[ $opt_name ];
		else return $default;
	}
}

/* -----------------------------------------------------------------------------
 * Prepare Options
 * -------------------------------------------------------------------------- */
$theme = wp_get_theme();
$vw_opt_name = 'vw_espresso';

$help_html = '<a href="http://envirra.com/themes/espresso/document/" target="_blank"><img src="'.get_template_directory_uri().'/images/admin/help-documentation.png"></a>';
$help_html .= '<a href="http://envirra.com/themes/espresso/document/#troubleshooting" target="_blank"><img src="'.get_template_directory_uri().'/images/admin/help-troubleshooting.png"></a>';
$help_html .= '<a href="http://themeforest.net/user/envirra/portfolio?ref=envirra" target="_blank"><img src="'.get_template_directory_uri().'/images/admin/help-more-themes.png"></a>';

$args = array(
	// TYPICAL -> Change these values as you need/desire
	'opt_name'             => $vw_opt_name,
	// This is where your data is stored in the database and also becomes your global variable name.
	'display_name'         => $theme->get( 'Name' ),
	// Name that appears at the top of your panel
	'display_version'      => $theme->get( 'Version' ), 
	// Version that appears at the top of your panel
	'menu_type'            => 'menu',
	//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
	'allow_sub_menu'       => true,
	// Show the sections below the admin menu item or not
	'menu_title'           => 'Theme Options',
	'page_title'           => 'Theme Options',
	// You will need to generate a Google API key to use this feature.
	// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
	'google_api_key'       => 'AIzaSyCNyDK8sPUuf9bTcG1TdFFLAVUfA1IDm38',
	// Set it you want google fonts to update weekly. A google_api_key value is required.
	'google_update_weekly' => false,
	// Must be defined to add google fonts to the typography module
	'async_typography'     => true,
	// Use a asynchronous font on the front end or font string
	//'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
	'admin_bar'            => true,
	// Show the panel pages on the admin bar
	'admin_bar_icon'       => 'dashicons-portfolio',
	// Choose an icon for the admin bar menu
	'admin_bar_priority'   => 50,
	// Choose an priority for the admin bar menu
	'global_variable'      => '',
	// Set a different name for your global variable other than the opt_name
	'dev_mode'             => false,
	// Show the time the page took to load, etc
	'update_notice'        => false,
	// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
	'customizer'           => true,
	// Enable basic customizer support
	//'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
	//'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

	// OPTIONAL -> Give you extra features
	'page_priority'        => null,
	// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	'page_parent'          => 'themes.php',
	// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	'page_permissions'     => 'manage_options',
	// Permissions needed to access the options panel.
	'menu_icon'            => '',
	// Specify a custom URL to an icon
	'last_tab'             => '',
	// Force your panel to always open to a specific tab (by id)
	'page_icon'            => 'icon-themes',
	// Icon displayed in the admin panel next to your menu_title
	'page_slug'            => 'vw_theme_options',
	// Page slug used to denote the panel
	'save_defaults'        => true,
	// On load save the defaults to DB before user clicks save or not
	'default_show'         => false,
	// If true, shows the default value next to each field that is not the default value.
	'default_mark'         => '',
	// What to print by the field's title if the value shown is default. Suggested: *
	'show_import_export'   => true,
	// Shows the Import/Export panel when not used as a field.

	// CAREFUL -> These options are for advanced use only
	'transient_time'       => 60 * MINUTE_IN_SECONDS,
	'output'               => true,
	// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
	'output_tag'           => true,
	// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
	// 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

	// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	'database'             => '',
	// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	'system_info'          => false,
	// REMOVE

	//'compiler'             => true,

	// HINTS
	'hints'                => array(
		'icon'          => 'el el-question-sign',
		'icon_position' => 'right',
		'icon_color'    => 'lightgray',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color'   => 'light',
			'shadow'  => true,
			'rounded' => false,
			'style'   => '',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'click mouseleave',
			),
		),
	)
);

if ( ! class_exists( 'Redux' ) ) return;

Redux::setArgs( $vw_opt_name, $args );

/**
General
 */

Redux::setSection( $vw_opt_name, array(
	'title' => 'General',
	'id'    => 'vw-options-general',
	'desc'  => '',
	'icon'  => 'el el-website',
	'fields'     => array(
	   array(
			'id'=>'theme_info_1',
			'type' => 'raw', 
			'content' => $help_html,
		),
		
		array(
			'id'=>'site_enable_open_graph',
			'type' => 'switch', 
			'title' => 'Enable Facebook Open Graph Supports',
			'default' => 1,
		),

		array(
			'id'=>'site_force_enable_rtl',
			'type' => 'switch', 
			'title' => 'Force Enable RTL',
			'subtitle'=> 'Enabling this option, The site will be shown in RTL direction. Otherwise, The RTL will be turned on automatically when site language is also RTL language.',
			'default' => 0,
		),

		array(
			'id'=>'page_force_disable_comments',
			'type' => 'switch', 
			'title' => 'Force Disable Page Comments',
			'subtitle'=> 'Enabling this option, All page comment will be disabled.',
			'default' => 0,
		),

		array(
			'id'=>'site_404',
			'type' => 'select',
			'title' => '404 Page', 
			'subtitle' => 'Select the page to be displayed on page/post not found',
			'data' => 'page',
		),
	),
) );

/**
Site
 */

Redux::setSection( $vw_opt_name, array(
	'title'      => 'Site',
	'desc'       => '',
	'id'         => 'vw-options-site',
	'icon'       => 'el el-home',
	'fields'     => array(
		array(
			'id'=>'site_layout',
			'type' => 'select',
			'title' => 'Site Layout', 
			'subtitle' => 'Select the site layout.',
			'options' => array(
				'full-width' => 'Full-Width',
				'boxed' => 'Boxed',
			),
			'default' => 'full-width',
		),
		
		array(
			'id'=>'site_enable_sticky_sidebar',
			'type' => 'switch', 
			'title' => 'Enable Sticky Sidebar',
			'desc' => 'Sidebars will be sticky when scrolling through a long content.',
			'default' => 1,
		),
	),
) );

Redux::setSection( $vw_opt_name, array(
	'title'      => 'Site Header',
	'desc'       => '',
	'id'         => 'vw-options-site-header',
	'subsection' => true,
	'fields'     => array(
	   array(
			'id'=>'site_top_bar',
			'type' => 'select',
			'title' => 'Site Top-bar', 
			'subtitle' => 'Select a site top-bar style.',
			'desc' => 'When choosing "Custom 1" or "Custom 2", You need to override the template file from child theme. Please see the file name to be overriden on documentation.',
			'options' => array(
				'none' => 'Not Shown',
				'menu-social' => 'Top Menu / Social Links',
				'social-menu' => 'Social Links / Top Menu',
				'custom-1' => 'Custom 1',
				'custom-2' => 'Custom 2',
			),
			'default' => 'menu-social',
		),

		array(
			'id'=>'site_header_layout',
			'type' => 'select',
			'title' => 'Site Header Layout', 
			'subtitle' => 'Select a site header style.',
			'desc' => 'When choosing "Custom 1" or "Custom 2", You need to override the template file from child theme. Please see the file name to be overriden on documentation.',
			'default' => 'centered-logo',
			'options' => array(
				'left-logo' => 'Left Logo',
				'centered-logo' => 'Centered Logo',
				'custom-1' => 'Custom 1',
				'custom-2' => 'Custom 2',
			),
		),

		array(
			'id'=>'site_enable_sticky_menu',
			'type' => 'switch', 
			'title' => 'Enable Sticky Menu',
			'desc' => 'Sticky menu will be disabled on mobile resolution.',
			'default' => 1,
		),

		array(
			'id'		=> 'site_header_padding',
			'type'		=> 'spacing',
			'title'		=> 'Site Header Padding', 
			'subtitle'	=> 'A top and bottom padding for site header.',
			'output'	=> array( '.vw-site-header-inner' ),
			'units'	=> 'px',
			'top'	=> true,
			'right'	=> false,
			'bottom'=> true,
			'left'	=> false,
			'default'	=> array(
				'top' => '15px',
				'bottom' => '10px',
			),
		),
	),
) );

Redux::setSection( $vw_opt_name, array(
	'title'      => 'Header Ads',
	'desc'       => 'Insert Ads on site header. The ads will be displayed depends on width of screen.',
	'id'         => 'vw-options-site-header-ads',
	'subsection' => true,
	'fields'     => array(
	   array(
			'id'=>'header_ads_banner',
			'type' => 'ace_editor',
			'theme' => 'monokai',
			'mode' => 'html',
			'title' => '728x90 Ads',
			'subtitle' => 'Paste your ads code here. If you are using Responsive Ads, Please enter the code only on this option.',
		),

		array(
			'id'=>'header_ads_leaderboard',
			'type' => 'ace_editor',
			'theme' => 'monokai',
			'mode' => 'html',
			'title' => '468x60 Ads',
			'subtitle' => 'Paste your ads code here.',
		),
	),
) );

Redux::setSection( $vw_opt_name, array(
	'title'      => 'Site Footer',
	'desc'       => '',
	'id'         => 'vw-options-site-footer',
	'subsection' => true,
	'fields'     => array(
	   array(
			'id'=>'site_bottom_bar',
			'type' => 'select',
			'title' => 'Site Bottom-bar', 
			'subtitle' => 'Select the site bottom-bar style.',
			'desc' => 'When choosing "Custom 1" or "Custom 2", You need to override the template file from child theme. Please see the file name to be overriden on documentation.',
			'options' => array(
				'none' => 'Not Shown',
				'copyright-menu' => 'Copyright / Bottom Menu',
				'copyright-social' => 'Copyright / Social Links',
				'menu-social' => 'Bottom Menu / Social Links',
				'menu-copyright' => 'Bottom Menu / Copyright',
				'custom-1' => 'Custom 1',
				'custom-2' => 'Custom 2',
			),
			'default' => 'copyright-social',
		),

		array(
			'id'=>'copyright_text',
			'type' => 'textarea', 
			'title' => 'Copyright',
			'subtitle'=> 'Enter copyright text',
			'default' => 'Copyright &copy;, All Rights Reserved.',
		),

		array(
			'id'=>'site_footer_layout',
			'type' => 'image_select',
			'title' => 'Site Footer Layout', 
			'subtitle' => 'Select footer sidebar layout.',
			'options' => array(
					'3,3,3,3' => array('alt' => '1/4 + 1/4 + 1/4 + 1/4 Column', 'img' => VW_CONST_REDUX_ASSET_URL.'/footer-layout-1_4-1_4-1_4-1_4.png'),
					'6,3,3' => array('alt' => '1/2 + 1/4 + 1/4 Column', 'img' => VW_CONST_REDUX_ASSET_URL.'/footer-layout-1_2-1_4-1_4.png'),
					'3,3,6' => array('alt' => '1/4 + 1/4 + 1/2 Column', 'img' => VW_CONST_REDUX_ASSET_URL.'/footer-layout-1_4-1_4-1_2.png'),
					'6,6' => array('alt' => '1/2 + 1/2 Column', 'img' => VW_CONST_REDUX_ASSET_URL.'/footer-layout-1_2-1_2.png'),
					'4,4,4' => array('alt' => '1/3 + 1/3 + 1/3 Column', 'img' => VW_CONST_REDUX_ASSET_URL.'/footer-layout-1_3-1_3-1_3.png'),
					'8,4' => array('alt' => '2/3 + 1/3 Column', 'img' => VW_CONST_REDUX_ASSET_URL.'/footer-layout-2_3-1_3.png'),
					'4,8' => array('alt' => '1/3 + 2/3 Column', 'img' => VW_CONST_REDUX_ASSET_URL.'/footer-layout-1_3-2_3.png'),
					'3,6,3' => array('alt' => '1/4 + 1/2 + 1/4 Column', 'img' => VW_CONST_REDUX_ASSET_URL.'/footer-layout-1_4-1_2-1_4.png'),
					'12' => array('alt' => '1/1 Column', 'img' => VW_CONST_REDUX_ASSET_URL.'/footer-layout-1_1.png'),
					'none' => array('alt' => 'No footer', 'img' => VW_CONST_REDUX_ASSET_URL.'/footer-layout-none.png'),
				),
			'default' => '6,3,3',
		),
	),
) );

/**
Blog/Archive
 */

Redux::setSection( $vw_opt_name, array(
	'title'      => 'Blog / Archive',
	'desc'       => '',
	'id'         => 'vw-options-blog',
	'icon'       => 'el el-pencil',
	'fields'     => array(
		array(
			'id'=>'blog_default_layout',
			'type' => 'select',
			'title' => 'Default Blog Layout', 
			'subtitle' => 'Select default blog layout for blog page, search page, archive and category.',
			'options' => array(
				'medium-1-col-2' => 'Medium Thumbnail 1',
				'medium-1-col-3' => 'Medium Thumbnail 1 (3 Columns)',
				'medium-2-col-2' => 'Medium Thumbnail 2',
				'medium-2-col-3' => 'Medium Thumbnail 2 (3 Columns)',
				'medium-3-col-2' => 'Medium Thumbnail 3',
				'medium-3-col-3' => 'Medium Thumbnail 3 (3 Columns)',
				'medium-4-col-2' => 'Medium Thumbnail 4',
				'medium-4-col-3' => 'Medium Thumbnail 4 (3 Columns)',
				'medium-5-col-2' => 'Medium Thumbnail 5',
				'medium-5-col-3' => 'Medium Thumbnail 5 (3 Columns)',
				'medium-6-col-1' => 'Medium Thumbnail 6',
				'large' => 'Large Thumbnail',
				'custom-1' => 'Custom 1',
				'custom-2' => 'Custom 2',
				'custom-3' => 'Custom 3',
				'custom-4' => 'Custom 4',
			),
			'default' => 'medium-1-col-2',
		),

		array(
			'id'=>'blog_default_sidebar_position',
			'type' => 'select',
			'title' => 'Default Sidebar Position', 
			'subtitle' => 'Select default sidebar position.',
			'options' => array(
				'none' => 'None',
				'right' => 'Right',
				'left' => 'Left',
				'mini-content-right' => 'Left (mini) / Content / Right',
				'left-content-mini' => 'Left / Content / Right (mini)',
				'content-mini-right' => 'Content / Left (mini) / Right',
			),
			'default' => 'right',
		),

		array(
			'id'=>'blog_default_left_sidebar',
			'type' => 'select',
			'title' => 'Default Left Sidebar', 
			'subtitle' => 'Select default sidebar.',
			'data' => 'sidebar',
			'default' => 'blog-left-sidebar',
		),

		array(
			'id'=>'blog_default_right_sidebar',
			'type' => 'select',
			'title' => 'Default Right Sidebar', 
			'subtitle' => 'Select default sidebar.',
			'data' => 'sidebar',
			'default' => 'blog-right-sidebar',
		),

		array(
			'id'		=> 'blog_excerpt_length',
			'type'		=> 'text',
			'title'		=> 'Excerpt Length', 
			'subtitle'	=> 'The number of first words to be show when the custom excerpt is not provided.',
			'validate'	=> 'numeric',
			'default'	=> '50',
		),

		array(
			'id'=>'blog_enable_masonry_layout',
			'type' => 'switch', 
			'title' => 'Enable Masonry Grid',
			'subtitle'=> 'Turn on this option to show a post grid in a masonry layout.',
			'default' => 1,
		),

		array(
			'id'=>'blog_enable_more_articles',
			'type' => 'switch', 
			'title' => 'Enable More Stories',
			'subtitle'=> 'Turn on this option to show a floating windows for more story.',
			'default' => 1,
		),

		array(
			'id'=>'blog_avoid_duplicate_post',
			'type' => 'switch', 
			'title' => 'Avoid Duplicate Posts',
			'subtitle'=> 'Turn on this option to a duplicate posts in the same page.',
			'default' => 0,
		),
	),
) );

Redux::setSection( $vw_opt_name, array(
	'title'      => 'Post Views',
	'desc'       => '',
	'id'         => 'vw-options-blog-post-views',
	'subsection' => true,
	'fields'     => array(
	  array(
			'id'=>'blog_enable_post_views',
			'type' => 'switch', 
			'title' => 'Enable Post Views',
			'subtitle'=> 'Turn on this option to show the post views.',
			'default' => 1,
		),

		array(
			'id'		=> 'post_views_forgery',
			'type'		=> 'text',
			'title'		=> 'Post Views Forgery', 
			'subtitle'	=> 'Enter the number to add to real number of post views for each post',
			'desc'	=> 'i.e. If post has 65 views and you put 100, your post will display 165 views.',
			'validate'	=> 'numeric',
			'default'	=> '0',
		),
	),
) );

Redux::setSection( $vw_opt_name, array(
	'title'      => 'Breaking News',
	'desc'       => '',
	'id'         => 'vw-options-blog-breaking-news',
	'subsection' => true,
	'fields'     => array(
	  array(
			'id'=>'enable_breaking_news',
			'type' => 'switch',
			'title' => 'Enable Breaking News', 
			'subtitle' => 'Enable this option to show the breaking news as a slider at header.',
			'default' => 1,
		),
		array(
			'id'=>'show_breaking_news_on_front_page',
			'type' => 'switch',
			'title' => 'Show Breaking News on Front Page ', 
			'subtitle' => 'When breaking news is enabled, Show the breaking news bar on front page or not.',
			'default' => 0,
		),
		
		array(
			'id'=>'breaking_news_source',
			'type' => 'select',
			'title' => 'Show posts from', 
			'options' => array(
				'latest' => 'Latest posts',
				'featured' => 'Featured posts',
				'random' => 'Random posts',
			),
			'default' => 'latest',
		),
	),
) );

/**
Single Post
 */

Redux::setSection( $vw_opt_name, array(
	'title'      => 'Single Post',
	'desc'       => 'An options for single post page.',
	'id'         => 'vw-options-single',
	'icon'       => 'el el-edit',
	'fields'     => array(
		array(
			'id'=>'post_default_layout',
			'type' => 'select',
			'title' => 'Default Post Layout', 
			'subtitle' => 'Select default post layout.',
			'options' => array(
				'classic' => 'Classic',
				'classic-no-featured-image' => 'Classic - No Featured Image',
				'full-width' => 'Full-Width',
				'custom-1' => 'Custom 1',
				'custom-2' => 'Custom 2',
			),
			'default' => 'classic',
		),

		array(
			'id'=>'post_default_sidebar_position',
			'type' => 'select',
			'title' => 'Default Post Sidebar Position', 
			'subtitle' => 'Select default sidebar position for post.',
			'options' => array(
				'none' => 'None',
				'right' => 'Right',
				'left' => 'Left',
				'mini-content-right' => 'Left (mini) / Content / Right',
				'left-content-mini' => 'Left / Content / Right (mini)',
				'content-left-right' => 'Content / Left (mini) / Right',
			),
			'default' => 'right',
		),

		array(
			'id'		=> 'full_featured_image_height',
			'type'		=> 'text',
			'title'		=> 'Height of Full-Width Featured Image', 
			'subtitle'	=> '',
			'desc'	=> 'px',
			'validate'	=> 'numeric',
			'default'	=> '200',
		),

		array(
			'id'=>'enable_next_page_links',
			'type' => 'switch',
			'title' => 'Enable Next/Previous Page Links', 
			'subtitle' => 'Displays next/previous page-links for paginated posts. If disabled, A numeric pagination will be displayed.', 
			'default' => 0,
		),

		array(
			'id'=>'before_post_content',
			'type' => 'editor', 
			'title' => 'Before Post Content',
			'subtitle'=> 'Enter the content to be placed before post content (Ads or any snippets code).',
		),

		array(
			'id'=>'after_post_content',
			'type' => 'editor', 
			'title' => 'After Post Content',
			'subtitle'=> 'Enter the content to be placed after post content (Ads or any snippets code).',
		),

		array(
			'id' => 'post_footer_sections',
			'type' => 'sorter',
			'title' => 'Post Footer Sections',
			'subtitle' => 'Organize how you want the order of additional sections to appear on the footer of post.',
			'options' => array(
				'enabled' => array(
					'post-navigation' => 'Next/Previous Post',
					'about-author' => 'About Author',
					'related-posts' => 'Related Posts',
					'comments' => 'Comments',
				),
				'disabled' => array(
					'custom-1' => 'Custom Section 1',
					'custom-2' => 'Custom Section 2',
				)
			),
		),

		array(
			'id'=>'post_footer_section_custom_1',
			'type' => 'editor', 
			'title' => 'Post Footer - Custom Section 1',
			'subtitle'=> 'Enter the content.',
		),

		array(
			'id'=>'post_footer_section_custom_2',
			'type' => 'editor', 
			'title' => 'Post Footer - Custom Section 2',
			'subtitle'=> 'Enter the content.',
		),
	),
) );

Redux::setSection( $vw_opt_name, array(
	'title'      => 'Related Posts',
	'desc'       => '',
	'id'         => 'vw-options-single-related-posts',
	'subsection' => true,
	'fields'     => array(
	  array(
			'id'=>'related_post_layout',
			'type' => 'select',
			'title' => 'Related Post Layout', 
			'subtitle' => 'Select related post layout.',
			'options' => array(
				'small-left-thumbnail-col-2' => 'Small-left Thumbnail',
				'small-top-thumbnail-2-col-4' => 'Small-top Thumbnail 2',
				'medium-5-col-2' => 'Medium Thumbnail 5',
				
				'custom-1' => 'Custom 1',
				'custom-2' => 'Custom 2',
				'custom-3' => 'Custom 3',
				'custom-4' => 'Custom 4',
			),
			'default' => 'small-top-thumbnail-2-col-4',
		),
		array(
			'id'=>'related_post_count',
			'type' => 'text',
			'title' => 'Number of Related Posts', 
			'subtitle'=> 'The number of related posts to be displayed.',
			'validate' => 'numeric',
			'default' => '4',
		),
	),
) );

Redux::setSection( $vw_opt_name, array(
	'title'      => 'Review',
	'desc'       => '',
	'id'         => 'vw-options-single-review',
	'subsection' => true,
	'fields'     => array(
	  array(
			'id'=>'enable_pros_cons',
			'type' => 'switch',
			'title' => 'Enable Pros/Cons Section', 
			'default' => 1,
		),

		array(
			'id'=>'enable_user_rating',
			'type' => 'switch',
			'title' => 'Enable User Rating', 
			'default' => 1,
		),
	),
) );

Redux::setSection( $vw_opt_name, array(
	'title'      => 'Custom Tiled Gallery',
	'desc'       => '',
	'id'         => 'vw-options-single-tiled-gallery',
	'subsection' => true,
	'fields'     => array(
	  array(
			'id' => 'blog_enable_custom_tiled_gallery',
			'type' => 'switch',
			'title' => 'Enable Custom Tiled Gallery',
			'subtitle' => 'Turn it off if you need to use the Jetpack Carousel or other gallery plugins.',
			'default' => '1' // 1 = checked | 0 = unchecked
		),

		array(
			'id' => 'blog_custom_tiled_gallery_layout',
			'type' => 'text',
			'title' => 'Tiled Gallery Layout',
			'subtitle' => 'A numbers representing the number of columns for each row. Example, "213" is the 1st row has 2 images, 2nd row has 1 image, 3rd row has 3 images.',
			'validate' => 'numeric',
			'default' => '213'
		),
	),
) );

/**
Typography
 */

Redux::setSection( $vw_opt_name, array(
	'title'      => 'Typography',
	'desc'       => '',
	'id'         => 'vw-options-typography',
	'icon'       => 'el el-fontsize',
	'fields'     => array(
		array(
			'id'            => 'typography_header',
			'type'          => 'typography',
			'title'         => 'Header',
			//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
			'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
			'font-backup'   => true,    // Select a backup non-google font in addition to a google font
			//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
			//'subsets'       => false, // Only appears if google is true and subsets not set to false
			'font-size'     => false,
			'line-height'   => false,
			//'word-spacing'  => true,  // Defaults to false
			'letter-spacing'=> true,  // Defaults to false
			//'color'         => false,
			'text-align'      => false,
			'text-transform'  => true,
			//'preview'       => false, // Disable the previewer
			'all_styles'    => VW_CONST_LOAD_ALL_HEADER_GOOGLE_FONT_STYLES,    // Enable all Google Font style/weight variations to be added to the page
			'output'        => array(
				'h1, h2, h3, h4, h5, h6, .vw-header-font',
				'.vw-social-counter-count',
				'.vw-page-navigation-pagination .page-numbers',
				'#wp-calendar caption',
				'.vw-accordion-header-text',
				'.vw-tab-title',
				'.vw-post-categories',
				'.vw-review-item-title',
				'.vw-previous-link-page, .vw-next-link-page',

				'#bbpress-forums .bbp-topic-title .bbp-topic-permalink, #bbpress-forums .bbp-forum-info .bbp-forum-title',
				'#bbpress-forums #bbp-user-wrapper h2.entry-title',
				'.widget.widget_display_topics li .bbp-forum-title, .widget.widget_display_replies li .bbp-forum-title'
				), // An array of CSS selectors to apply this font style to dynamically
			// 'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
			'units'         => 'px', // Defaults to px
			'subtitle'      => 'Choose font for header text.',
			'default'       => array(
				'color'         => '#3e3e3e',
				'font-style'    => '400',
				'font-family'   => 'Oswald',
				'google'        => true,
				'text-transform'        => 'uppercase',
				'letter-spacing'        => '0px',
			),
		),

		array(
			'id'            => 'typography_main_menu',
			'type'          => 'typography',
			'title'         => 'Main Menu',
			//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
			'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
			'font-backup'   => true,    // Select a backup non-google font in addition to a google font
			//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
			//'subsets'       => false, // Only appears if google is true and subsets not set to false
			//'font-size'     => false,
			'line-height'   => false,
			//'word-spacing'  => true,  // Defaults to false
			'letter-spacing'=> true,  // Defaults to false
			'color'         => false,
			'text-align'      => false,
			'text-transform'  => true,
			//'preview'       => false, // Disable the previewer
			'all_styles'    => false,    // Enable all Google Font style/weight variations to be added to the page
			'output'        => array( '.vw-menu-location-main .main-menu-link' ), // An array of CSS selectors to apply this font style to dynamically
			// 'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
			'units'         => 'px', // Defaults to px
			'subtitle'      => 'Choose font for body text.',
			'default'       => array(
				'font-style'    => '400',
				'font-family'   => 'Oswald',
				'google'        => true,
				'font-size'     => '16px',
				'text-transform'        => 'uppercase',
				'letter-spacing' => '1px',
			),
		),

		array(
			'id'            => 'typography_body',
			'type'          => 'typography',
			'title'         => 'Body',
			//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
			'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
			'font-backup'   => true,    // Select a backup non-google font in addition to a google font
			//'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
			//'subsets'       => false, // Only appears if google is true and subsets not set to false
			//'font-size'     => false,
			'line-height'   => false,
			//'word-spacing'  => true,  // Defaults to false
			//'letter-spacing'=> true,  // Defaults to false
			//'color'         => false,
			'text-align'      => false,
			//'preview'       => false, // Disable the previewer
			'all_styles'    => VW_CONST_LOAD_ALL_BODY_GOOGLE_FONT_STYLES,    // Enable all Google Font style/weight variations to be added to the page
			'output'        => array( 'body', 'cite' ), // An array of CSS selectors to apply this font style to dynamically
			// 'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
			'units'         => 'px', // Defaults to px
			'subtitle'      => 'Choose font for body text.',
			'default'       => array(
				'color'         => '#666666',
				'font-style'    => '400',
				'font-family'   => 'Open Sans',
				'google'        => true,
				'font-size'     => '14px',
			),
		),
	),
) );

Redux::setSection( $vw_opt_name, array(
	'title'      => 'Custom Font 1',
	'desc'       => "Upload your font files for using as font name <strong>Custom Font 1</strong>. You can also use the shortcode <strong>[customfont1]Your Text[/customfont1]</strong> in the content.</strong>",
	'id'         => 'vw-options-typography-custom-font-1',
	'subsection' => true,
	'fields'     => array(
	  array(
			'id'=>'custom_font1_ttf',
			'type' => 'media',
			'preview'=> false,
			'mode'=> 'font',
			'title' => '.TTF/.OTF Font File',
		),
		array(
			'id'=>'custom_font1_woff',
			'type' => 'media',
			'preview'=> false,
			'mode'=> 'font',
			'title' => '.WOFF Font File',
		),
		array(
			'id'=>'custom_font1_svg',
			'type' => 'media',
			'preview'=> false,
			'mode'=> 'font',
			'title' => '.SVG Font File',
		),
		array(
			'id'=>'custom_font1_eot',
			'type' => 'media',
			'preview'=> false,
			'mode'=> 'font',
			'title' => '.EOT Font File',
		),
	),
) );

Redux::setSection( $vw_opt_name, array(
	'title'      => 'Custom Font 2',
	'desc'       => '',
	'id'         => 'vw-options-typography-custom-font-2',
	'subsection' => true,
	'fields'     => array(
	  array(
			'id'=>'custom_font2_ttf',
			'type' => 'media',
			'preview'=> false,
			'mode'=> 'font',
			'title' => '.TTF/.OTF Font File',
		),
		array(
			'id'=>'custom_font2_woff',
			'type' => 'media',
			'preview'=> false,
			'mode'=> 'font',
			'title' => '.WOFF Font File',
		),
		array(
			'id'=>'custom_font2_svg',
			'type' => 'media',
			'preview'=> false,
			'mode'=> 'font',
			'title' => '.SVG Font File',
		),
		array(
			'id'=>'custom_font2_eot',
			'type' => 'media',
			'preview'=> false,
			'mode'=> 'font',
			'title' => '.EOT Font File',
		),
	),
) );


/**
Logo / Favicon
 */

Redux::setSection( $vw_opt_name, array(
	'title'      => 'Logo / Favicon',
	'desc'       => '',
	'id'         => 'vw-options-logo',
	'icon'       => 'el el-star-empty',
	'fields'     => array(
		array(
			'id'		=> 'logo',
			'type'		=> 'media',
			'title'		=> 'Original Logo', 
			'subtitle'	=> 'Upload the original site logo.',
		),
		array(
			'id'		=> 'logo_2x',
			'type'		=> 'media',
			'title'		=> 'Retina Logo', 
			'subtitle'	=> 'The retina logo must be double size (2X) of the original logo.',
		),
		array(
			'id' => 'logo_margin',
			'type' => 'spacing',
			'title' => 'Logo Margin', 
			'subtitle' => 'Adjust logo margin here.',
			'mode' => 'margin',
			'units'=> array( 'px' ),
			'output' => array( '.vw-logo-link' ),
			'default' => array(
				'margin-top' => '30px',
				'margin-bottom' => '30px',
				'margin-left' => '0px',
				'margin-right' => '0px',
				'units' => 'px',
			),
		),
		array(
			'id' => 'fav_icon',
			'type' => 'media',
			'title' => 'Favicon (16x16)', 
			'subtitle' => 'Default Favicon.',
		),
		array(
			'id' => 'fav_icon_iphone',
			'type' => 'media',
			'title' => 'Apple iPhone Icon (57x57)', 
			'subtitle' => 'Icon for Classic iphone.',
		),
		array(
			'id' => 'fav_icon_iphone_retina',
			'type' => 'media',
			'title' => 'Apple iPhone Retina Icon (114x114)', 
			'subtitle' => 'Icon for Retina iPhone.',
		),
		array(
			'id' => 'fav_icon_ipad',
			'type' => 'media',
			'title' => 'Apple iPad Icon (72x72)', 
			'subtitle' => 'Icon for Classic iPad.',
		),
		array(
			'id' => 'fav_icon_ipad_retina',
			'type' => 'media',
			'title' => 'Apple iPad Retina Icon (144x144)', 
			'subtitle' => 'Icon for Retina iPad.',
		),
	),
) );


/**
Font Icons
 */

Redux::setSection( $vw_opt_name, array(
	'title'      => 'Font Icons',
	'desc'       => 'You can choose additional icon fonts. The default font icons that are already in use are <a href="https://useiconic.com/icons/">Iconic</a> (Icon listing <a href="'.get_template_directory_uri().'/components/font-icons/iconic/demo.html">here</a>) and <a href="http://zocial.smcllns.com">Zocial</a> (Icon listing <a href="'.get_template_directory_uri().'/components/font-icons/social-icons/demo.html">here</a>).',
	'id'         => 'vw-options-font-icons',
	'icon'       => 'el el-puzzle',
	'fields'     => array(
		array(
			'id' => 'icon_iconic',
			'type' => 'switch',
			'title' => 'Include Iconic Icons', 
			'desc' => 'by <a href="http://somerandomdude.com/work/iconic">P.J. Onori</a>, The icon listing is <a href="'.get_template_directory_uri().'/framework/font-icons/iconic/demo.html">here</a>',
			'default' => 0
		),
		array(
			'id' => 'icon_elusive',
			'type' => 'switch',
			'title' => 'Include Elusive Icons', 
			'desc' => 'by <a href="http://aristeides.com">Aristeides Stathopoulos</a>, The icon listing is <a href="'.get_template_directory_uri().'/components/font-icons/elusive/demo.html">here</a>',
			'default' => 0
		),
		array(
			'id' => 'icon_awesome',
			'type' => 'switch',
			'title' => 'Include Font Awesome Icons', 
			'desc' => 'by <a href="http://fontawesome.io">Dav Gandy</a>, The icon listing is <a href="'.get_template_directory_uri().'/components/font-icons/awesome/demo.html">here</a>',
			'default' => 0
		),
		/*array(
			'id' => 'icon_entypo',
			'type' => 'switch',
			'title' => 'Include Entypo Icons', 
			'desc' => 'by <a href="http://entypo.com">Entypo.com</a>, The icon listing is <a href="'.get_template_directory_uri().'/components/font-icons/entypo/demo.html">here</a>',
			'default' => 1
		),*/
		array(
			'id' => 'icon_typicons',
			'type' => 'switch',
			'title' => 'Include Typicons Icons', 
			'desc' => 'by <a href="http://typicons.com">Stephen Hutchings</a>, The icon listing is <a href="'.get_template_directory_uri().'/framework/font-icons/typicons/demo.html">here</a>',
			'default' => 0
		),
	),
) );


/**
Social Profiles
 */

Redux::setSection( $vw_opt_name, array(
	'title'      => 'Social Profiles',
	'desc'       => "These are options for setting up the site's social media profiles.",
	'id'         => 'vw-options-social',
	'icon'       => 'el el-share-alt',
	'fields'     => array(
		array(
			'id' => 'social_delicious',
			'type' => 'text',
			'title' => 'Delicious URL', 
			'subtitle' => 'Enter URL to your account page.',
			'placeholder' => 'http://',
			'validate' => 'url',
		),
		array(
			'id' => 'social_digg',
			'type' => 'text',
			'title' => 'Digg URL', 
			'subtitle' => 'Enter URL to your account page.',
			'placeholder' => 'http://',
			'validate' => 'url',
		),
		array(
			'id' => 'social_dribbble',
			'type' => 'text',
			'title' => 'Dribbble URL', 
			'subtitle' => 'Enter URL to your account page.',
			'placeholder' => 'http://',
			'validate' => 'url',
		),
		array(
			'id' => 'social_facebook',
			'type' => 'text',
			'title' => 'Facebook URL', 
			'subtitle' => 'Enter URL to your account page.',
			'placeholder' => 'http://',
			'default' => 'https://facebook.com',
			'validate' => 'url',
		),
		array(
			'id' => 'social_flickr',
			'type' => 'text',
			'title' => 'Flickr URL', 
			'subtitle' => 'Enter URL to your account page.',
			'placeholder' => 'http://',
			'validate' => 'url',
		),
		array(
			'id' => 'social_forrst',
			'type' => 'text',
			'title' => 'Forrst URL', 
			'subtitle' => 'Enter URL to your account page.',
			'placeholder' => 'http://',
			'validate' => 'url',
		),
		array(
			'id' => 'social_github',
			'type' => 'text',
			'title' => 'Github URL', 
			'subtitle' => 'Enter URL to your account page.',
			'placeholder' => 'http://',
			'validate' => 'url',
		),
		array(
			'id' => 'social_googleplus',
			'type' => 'text',
			'title' => 'Google+ URL', 
			'subtitle' => 'Enter URL to your account page.',
			'placeholder' => 'http://',
			'validate' => 'url',
			'default' => 'https://plus.google.com',
		),
		array(
			'id' => 'social_instagram',
			'type' => 'text',
			'title' => 'Instagram URL', 
			'subtitle' => 'Enter URL to your account page.',
			'placeholder' => 'http://',
			'validate' => 'url',
		),
		array(
			'id' => 'social_lastfm',
			'type' => 'text',
			'title' => 'Last.fm URL', 
			'subtitle' => 'Enter URL to your account page.',
			'placeholder' => 'http://',
			'validate' => 'url',
		),
		array(
			'id' => 'social_linkedin',
			'type' => 'text',
			'title' => 'Linkedin URL', 
			'subtitle' => 'Enter URL to your account page.',
			'placeholder' => 'http://',
			'validate' => 'url',
		),
		array(
			'id' => 'social_pinterest',
			'type' => 'text',
			'title' => 'Pinterest URL', 
			'subtitle' => 'Enter URL to your account page.',
			'placeholder' => 'http://',
			'validate' => 'url',
		),
		array(
			'id' => 'social_rss',
			'type' => 'text',
			'title' => 'Rss URL', 
			'subtitle' => 'Enter URL to your account page.',
			'placeholder' => 'http://',
			'validate' => 'url',
		),
		array(
			'id' => 'social_skype',
			'type' => 'text',
			'title' => 'Skype URL', 
			'subtitle' => 'Enter URL to your account page.',
			'placeholder' => 'http://',
			'validate' => 'url',
		),
		array(
			'id' => 'social_tumblr',
			'type' => 'text',
			'title' => 'Tumblr URL', 
			'subtitle' => 'Enter URL to your account page.',
			'placeholder' => 'http://',
			'validate' => 'url',
		),
		array(
			'id' => 'social_twitter',
			'type' => 'text',
			'title' => 'Twitter URL', 
			'subtitle' => 'Enter URL to your account page.',
			'placeholder' => 'http://',
			'default' => 'https://twitter.com',
			'validate' => 'url',
		),
		array(
			'id' => 'social_vimeo',
			'type' => 'text',
			'title' => 'Vimeo URL', 
			'subtitle' => 'Enter URL to your account page.',
			'placeholder' => 'http://',
			'validate' => 'url',
		),
		array(
			'id' => 'social_yahoo',
			'type' => 'text',
			'title' => 'Yahoo URL', 
			'subtitle' => 'Enter URL to your account page.',
			'placeholder' => 'http://',
			'validate' => 'url',
		),
		array(
			'id' => 'social_youtube',
			'type' => 'text',
			'title' => 'Youtube URL', 
			'subtitle' => 'Enter URL to your account page.',
			'placeholder' => 'http://',
			'validate' => 'url',
		),
	),
) );

/**
Gallery Slider
 */

Redux::setSection( $vw_opt_name, array(
	'title'      => 'Gallery Slider',
	'desc'       => 'These are the options for the image gallery slider that is displayed in the blog entry, page composer.',
	'id'         => 'vw-options-gallery-slider',
	'icon'       => 'el el-picture',
	'fields'     => array(
		array(
			'id' => 'slider_slide_duration',
			'type' => 'text',
			'title' => 'Slideshow Duration', 
			'subtitle' => 'The time for showing slide, in milliseconds.',
			'validate' => 'numeric',
			'default' => '4000',
		),
		array(
			'id' => 'slider_transition_speed',
			'type' => 'text',
			'title' => 'Transition Speed', 
			'subtitle' => 'The time for transition, in milliseconds.',
			'validate' => 'numeric',
			'default' => '500',
		),

		array(
			'id'=>'slider_enable_kenburns',
			'type' => 'switch',
			'title' => 'Enable Kenburns Effect', 
			'subtitle' => 'Enable kenburns effect for a large slider.',
			'default' => 1,
		),
	),
) );

/**
Colors
 */

Redux::setSection( $vw_opt_name, array(
	'title'      => 'Colors / Background',
	'desc'       => 'These are options for theme colors and background.',
	'id'         => 'vw-options-colors',
	'icon'       => 'el el-tint',
	'fields'     => array(
		array(
			'id'=>'accent_color',
			'type' => 'color', 
			'title' => 'Accent Color',
			'subtitle'=> 'An accent color for theme.',
			'transparent' => false,
			'default' => '#c5ac57',
		),

		array(
			'id'=>'site_background',
			'type' => 'background', 
			'title' => 'Site Background',
			'subtitle' => 'Upload background image to be a site background (only visible when Site Layout is <strong>Boxed layout</strong>).',
			'output' => array( 'body' ),
		),

		array(
			'id'=>'header_background',
			'type' => 'background', 
			'title' => 'Header Background',
			'subtitle' => 'Upload background image for header',
			'output' => array( '.vw-site-header', '.vw-site-header-background' ),
			'default' => array(
				'background-color' => '#ffffff',
			),
		),

		array(
			'id'=>'body_background',
			'type' => 'background', 
			'title' => 'Body Background',
			'background-image'=> false,
			'background-repeat'=> false,
			'background-size'=> false,
			'background-attachment'=> false,
			'background-position'=> false,
			'transparent'=> false,
			'output' => array( '.vw-site-wrapper', '.vw-page-navigation-pagination' ),
			'default' => array(
				'background-color' => '#ffffff',
			),
		),
	),
) );

Redux::setSection( $vw_opt_name, array(
	'title'      => 'Top Bar Colors',
	'desc'       => '',
	'id'         => 'vw-options-colors-top-bar',
	'subsection' => true,
	'fields'     => array(
	  array(
			'id'=>'topbar_background',
			'type' => 'color', 
			'title' => 'Background',
			'mode' => 'background',
			'transparent'=> false,
			'output' => array( '.vw-top-bar' ),
			'default' => '#ffffff'
		),
	),
) );

Redux::setSection( $vw_opt_name, array(
	'title'      => 'Top Menu Colors',
	'desc'       => '',
	'id'         => 'vw-options-colors-top-menu',
	'subsection' => true,
	'fields'     => array(
	  array(
			'id'=>'top_main_menu_link',
			'type' => 'link_color', 
			'title' => 'Menu Link',
			'visited' => false,
			'active' => false,
			'output' => array( '.vw-menu-location-top .main-menu-link' ),
			'default' => array(
				'regular' => '#888888',
				'hover' => '#3e3e3e',
			),
		),
		array(
			'id'=>'top_sub_menu_background',
			'type' => 'color', 
			'title' => 'Sub-Menu Background',
			'mode' => 'background',
			'transparent'=> false,
			'output' => array( '.vw-menu-location-top .sub-menu', '.vw-menu-location-top .main-menu-item:hover .main-menu-link' ),
			'default' => '#ffffff'
		),
		array(
			'id'=>'top_sub_menu_link',
			'type' => 'link_color', 
			'title' => 'Sub-Menu Link',
			'visited' => false,
			'active' => false,
			'output' => array( '.vw-menu-location-top .sub-menu-link' ),
			'default' => array(
				'regular' => '#111111',
				'hover' => '#888888',
			),
		),
		array(
			'id'=>'top_sub_menu_hover_background',
			'type' => 'color', 
			'title' => 'Sub-Menu Hover Background',
			'mode' => 'background',
			'transparent'=> false,
			'output' => array( '.vw-menu-location-top .sub-menu-link:hover' ),
			'default' => '#f5f5f5'
		),
	),
) );

Redux::setSection( $vw_opt_name, array(
	'title'      => 'Main Menu Colors',
	'desc'       => '',
	'id'         => 'vw-options-colors-main-menu',
	'subsection' => true,
	'fields'     => array(
	  array(
			'id'=>'main_menu_background',
			'type' => 'color', 
			'title' => 'Background',
			'mode' => 'background',
			'transparent'=> false,
			'output' => array( '.vw-menu-main-inner' ),
			'default' => '#3e3e3e',
		),
		array(
			'id'=>'main_main_menu_link',
			'type' => 'link_color', 
			'title' => 'Menu Link',
			'visited' => false,
			'active' => false,
			'output' => array( '.vw-menu-location-main .main-menu-link' ),
			'default' => array(
				'regular' => '#ffffff',
				'hover' => '#ffffff',
			),
		),
		array(
			'id'=>'main_main_menu_hover_background',
			'type' => 'color', 
			'title' => 'Menu Hover Background',
			'mode' => 'background',
			'transparent'=> false,
			'output' => array( '.vw-menu-location-main .main-menu-item:hover .main-menu-link' ),
			'default' => '#c5ac57',
		),
		array(
			'id'=>'main_sub_menu_background',
			'type' => 'color', 
			'title' => 'Sub-Menu Background',
			'mode' => 'background',
			'transparent'=> false,
			'output' => array( '.vw-menu-location-main .sub-menu' ),
			'default' => '#ffffff'
		),
		array(
			'id'=>'main_sub_menu_link',
			'type' => 'link_color', 
			'title' => 'Sub-Menu Link',
			'visited' => false,
			'active' => false,
			'output' => array( '.vw-menu-location-main .sub-menu-link' ),
			'default' => array(
				'regular' => '#111111',
				'hover' => '#888888',
			),
		),
		array(
			'id'=>'main_sub_menu_hover_background',
			'type' => 'color', 
			'title' => 'Sub-Menu Hover Background',
			'mode' => 'background',
			'transparent'=> false,
			'output' => array( '.vw-menu-location-main .sub-menu-link:hover' ),
			'default' => '#f5f5f5'
		),
	),
) );

Redux::setSection( $vw_opt_name, array(
	'title'      => 'Footer Colors',
	'desc'       => '',
	'id'         => 'vw-options-colors-footer',
	'subsection' => true,
	'fields'     => array(
	  array(
			'id'=>'footer_background',
			'type' => 'background', 
			'title' => 'Footer Background',
			'output' => array( '.vw-site-footer' ),
			'default' => array(
				'background-color' => '#222222',
			),
		),
		array(
			'id'=>'footer_header_color',
			'type' => 'color', 
			'title' => 'Header Color',
			'transparent'=> false,
			'output' => array(
				'.vw-site-footer-sidebars h1',
				'.vw-site-footer-sidebars h2',
				'.vw-site-footer-sidebars h3',
				'.vw-site-footer-sidebars h4',
				'.vw-site-footer-sidebars h5',
				'.vw-site-footer-sidebars h6',
				'.vw-site-footer-sidebars .widget-title',
				'.vw-site-footer-sidebars .vw-widget-category-title',
				'.vw-site-footer-sidebars .vw-social-counter-count'
				 ),
			'default' => '#ffffff'
		),
		array(
			'id'=>'footer_color',
			'type' => 'color', 
			'title' => 'Text/Link Color',
			'transparent'=> false,
			'output' => array( '.vw-site-footer-sidebars' ),
			'default' => '#dcdcdc'
		),
	),
) );

Redux::setSection( $vw_opt_name, array(
	'title'      => 'Bottom Bar Colors',
	'desc'       => '',
	'id'         => 'vw-options-colors-bottom-bar',
	'subsection' => true,
	'fields'     => array(
	  array(
			'id'=>'bottombar_background',
			'type' => 'color', 
			'title' => 'Background',
			'mode' => 'background',
			'transparent'=> false,
			'output' => array( '.vw-bottom-bar' ),
			'default' => '#111111'
		),
		array(
			'id'=>'bottombar_color',
			'type' => 'color', 
			'title' => 'Text Color',
			'transparent'=> false,
			'output' => array( '.vw-bottom-bar' ),
			'default' => '#b4b4b4'
		),
	),
) );

/**
WooCommerce
 */

Redux::setSection( $vw_opt_name, array(
	'title'      => 'WooCommerce',
	'desc'       => 'These are options for WooCommerce. You need to install the <a href="http://wordpress.org/plugins/woocommerce/" target="_blank">WooCommerce plugin</a> before using these options.',
	'id'         => 'vw-options-woocommerce',
	'icon'       => 'el el-shopping-cart',
	'fields'     => array(
		// array(
		// 	'id'=>'woocommerce_show_breaking_news',
		// 	'type' => 'switch',
		// 	'title' => 'Show Breaking News', 
		// 	'subtitle' => 'When breaking news is enabled, Show the breaking news bar on WooCommerce Pages or not.',
		// 	'default' => 0,
		// ),
		array(
			'id'=>'woocommerce_show_breadcrumb',
			'type' => 'switch',
			'title' => 'Show Breadcrumb', 
			'subtitle' => 'Show a breadcrumb bar on WooCommerce Pages or not.',
			'default' => 1,
		),
		array(
			'id'		=> 'woocommerce_products_per_page',
			'type'		=> 'text',
			'title'		=> 'Products Per Page', 
			'subtitle'	=> 'Enter the number of products per page.',
			'validate'	=> 'numeric',
			'default'	=> '9',
		),
		array(
			'id'=>'woocommerce_product_default_sidebar_position',
			'type' => 'select',
			'title' => 'Sidebar Position for Product Page', 
			'subtitle' => 'Select default sidebar position.',
			'options' => array(
				'none' => 'None',
				'right' => 'Right',
				'left' => 'Left',
				'mini-content-right' => 'Left (mini) / Content / Right',
				'left-content-mini' => 'Left / Content / Right (mini)',
				'content-mini-right' => 'Content / Left (mini) / Right',
			),
			'default' => 'right',
		),

		array(
			'id'=>'woocommerce_product_default_left_sidebar',
			'type' => 'select',
			'title' => 'Left Sidebar for Product Page', 
			'subtitle' => 'Select default sidebar.',
			'data' => 'sidebar',
			'default' => 'blog-left-sidebar',
		),

		array(
			'id'=>'woocommerce_product_default_right_sidebar',
			'type' => 'select',
			'title' => 'Right Sidebar for Product Page', 
			'subtitle' => 'Select default sidebar.',
			'data' => 'sidebar',
			'default' => 'blog-right-sidebar',
		),
	),
) );

/**
bbPress
 */

Redux::setSection( $vw_opt_name, array(
	'title'      => 'bbPress',
	'desc'       => 'These are options for bbPress. You need to install the <a href="https://wordpress.org/plugins/bbpress/" target="_blank">bbPress plugin</a> before using these options.',
	'id'         => 'vw-options-bbpress',
	'icon'       => 'el el-group-alt',
	'fields'     => array(
		array(
			'id'=>'bbpress_forum_page',
			'type' => 'select',
			'title' => 'Custom Forum Home Page (optional)', 
			'subtitle' => 'Use this page for a forum archive page instead of the bbpress default page.',
			'desc' => 'You need to create a page and enter shortcode <code>[bbp-forum-index]</code> as a page content.',
			'data' => 'page',
		),

		// array(
		// 	'id'=>'bbpress_show_breaking_news',
		// 	'type' => 'switch',
		// 	'title' => 'Show Breaking News', 
		// 	'subtitle' => 'When breaking news is enabled, Show the breaking news bar on bbpress Pages or not.',
		// 	'default' => 0,
		// ),

		array(
			'id'=>'bbpress_default_sidebar_position',
			'type' => 'select',
			'title' => 'Sidebar Position', 
			'subtitle' => 'Select default sidebar position.',
			'options' => array(
				'none' => 'None',
				'right' => 'Right',
				'left' => 'Left',
				'mini-content-right' => 'Left (mini) / Content / Right',
				'left-content-mini' => 'Left / Content / Right (mini)',
				'content-mini-right' => 'Content / Left (mini) / Right',
			),
			'default' => 'right',
		),

		array(
			'id'=>'bbpress_default_left_sidebar',
			'type' => 'select',
			'title' => 'Left Sidebar', 
			'subtitle' => 'Select default sidebar.',
			'data' => 'sidebar',
			'default' => 'blog-left-sidebar',
		),

		array(
			'id'=>'bbpress_default_right_sidebar',
			'type' => 'select',
			'title' => 'Right Sidebar', 
			'subtitle' => 'Select default sidebar.',
			'data' => 'sidebar',
			'default' => 'blog-right-sidebar',
		),
	),
) );

/**
BuddyPress
 */

Redux::setSection( $vw_opt_name, array(
	'title'      => 'BuddyPress',
	'desc'       => 'These are options for Buddypress. You need to install the <a href="https://wordpress.org/plugins/buddypress/" target="_blank">BuddyPress plugin</a> before using these options.',
	'id'         => 'vw-options-buddypress',
	'icon'       => 'el el-group-alt',
	'fields'     => array(
		// array(
		// 	'id'=>'buddypress_show_breaking_news',
		// 	'type' => 'switch',
		// 	'title' => 'Show Breaking News', 
		// 	'subtitle' => 'When breaking news is enabled, Show the breaking news bar on buddypress Pages or not.',
		// 	'default' => 0,
		// ),

		array(
			'id'=>'buddypress_default_sidebar_position',
			'type' => 'select',
			'title' => 'Sidebar Position', 
			'subtitle' => 'Select default sidebar position.',
			'options' => array(
				'none' => 'None',
				'right' => 'Right',
				'left' => 'Left',
				'mini-content-right' => 'Left (mini) / Content / Right',
				'left-content-mini' => 'Left / Content / Right (mini)',
				'content-mini-right' => 'Content / Left (mini) / Right',
			),
			'default' => 'right',
		),

		array(
			'id'=>'buddypress_default_left_sidebar',
			'type' => 'select',
			'title' => 'Left Sidebar', 
			'subtitle' => 'Select default sidebar.',
			'data' => 'sidebar',
			'default' => 'blog-left-sidebar',
		),

		array(
			'id'=>'buddypress_default_right_sidebar',
			'type' => 'select',
			'title' => 'Right Sidebar', 
			'subtitle' => 'Select default sidebar.',
			'data' => 'sidebar',
			'default' => 'blog-right-sidebar',
		),
	),
) );

/**
Custom CSS
 */

Redux::setSection( $vw_opt_name, array(
	'title'      => 'Custom CSS',
	'desc'       => '',
	'id'         => 'vw-options-custom-css',
	'icon'       => 'el el-certificate',
	'fields'     => array(
		array(
			'id'=>'custom_css',
			'type' => 'ace_editor', 
			'theme' => 'monokai',
			'mode' => 'css',
			'title' => 'Custom CSS',
			'subtitle'=> 'Paste your CSS code here.',
		),
	),
) );

/**
Updater
 */

Redux::setSection( $vw_opt_name, array(
	'title'      => 'Updater',
	'desc'       => 'Specify your ThemeForest username and API Key in order to enable quick theme updates. Whenever we release new theme update, it will appear on your <a href="./update-core.php">update screen</a>.',
	'id'         => 'vw-options-updater',
	'icon'       => 'el el-refresh',
	'fields'     => array(
		array(
			'id' => 'themeforest_username',
			'type' => 'text',
			'title' => 'ThemeForest Username',
			'default' => '',
		),
		array(
			'id' => 'themeforest_api_key',
			'type' => 'text',
			'title' => 'ThemeForest API Key',
			'default' => '',
			'desc' => 'Where can I get <a href="http://themeforest.net/help/api">an API key?</a>',
		),
	),
) );

do_action( 'vw_action_init_theme_options', $vw_opt_name );

/* -----------------------------------------------------------------------------
 * Actions
 * -------------------------------------------------------------------------- */
add_action( 'redux/options/'.$vw_opt_name.'/saved', 'vw_options_saved' );
if ( ! function_exists( 'vw_options_saved' ) ) {
	function vw_options_saved() {
		if ( function_exists( 'icl_register_string' ) ) {
			$copyright_text = vw_get_theme_option( 'copyright_text' );
			icl_register_string( VW_THEME_NAME.' Copyright', strtolower(VW_THEME_NAME.'_copyright'), $copyright_text );
		}
	}
}