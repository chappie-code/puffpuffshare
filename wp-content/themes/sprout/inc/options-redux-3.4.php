<?php

if ( ! defined( 'VW_CONST_REDUX_ASSET_URL' ) ) define( 'VW_CONST_REDUX_ASSET_URL', get_template_directory_uri() . '/images/admin' );

/* -----------------------------------------------------------------------------
 * Theme Option Proxy
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_get_theme_option' ) ) {
	function vw_get_theme_option( $opt_name, $default = null ) {
		global $vw_sprout;
		if ( isset( $vw_sprout[ $opt_name ] ) ) return $vw_sprout[ $opt_name ];
		else return $default;
	}
}

/* -----------------------------------------------------------------------------
 * Prepare Options
 * -------------------------------------------------------------------------- */
$theme = wp_get_theme();
$vw_opt_name = 'vw_sprout';
$args = array(
	// TYPICAL -> Change these values as you need/desire
	'opt_name'			=> $vw_opt_name,			// This is where your data is stored in the database and also becomes your global variable name.
	'display_name'		=> $theme->get('Name'),	 // Name that appears at the top of your panel
	'display_version'	=> $theme->get('Version'),  // Version that appears at the top of your panel
	'menu_type'		 	=> 'menu',				  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
	'allow_sub_menu'	=> true,					// Show the sections below the admin menu item or not
	'menu_title'		=> 'Theme Options',
	'page_title'		=> 'Theme Options',
	
	// You will need to generate a Google API key to use this feature.
	// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
	'google_api_key'	=> 'AIzaSyCNyDK8sPUuf9bTcG1TdFFLAVUfA1IDm38', // Must be defined to add google fonts to the typography module
	
	'async_typography'	=> false,					// Use a asynchronous font on the front end or font string
	'admin_bar'			=> true,					// Show the panel pages on the admin bar
	'global_variable'	=> '',					  // Set a different name for your global variable other than the opt_name
	'dev_mode'			=> false,					// Show the time the page took to load, etc
	'customizer'		=> true,					// Enable basic customizer support
	
	// OPTIONAL -> Give you extra features
	'page_priority'		=> null,					// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	'page_parent'		=> 'themes.php',			// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	'page_permissions'  => 'manage_options',		// Permissions needed to access the options panel.
	'menu_icon'			=> '',					  // Specify a custom URL to an icon
	'last_tab'		  => '',					  // Force your panel to always open to a specific tab (by id)
	'page_icon'		 => 'icon-themes',		// Icon displayed in the admin panel next to your menu_title
	'page_slug'		 => '_options',			  // Page slug used to denote the panel
	'save_defaults'	 => true,					// On load save the defaults to DB before user clicks save or not
	'default_show'	  => false,				// If true, shows the default value next to each field that is not the default value.
	'default_mark'	  => '',					  // What to print by the field's title if the value shown is default. Suggested: *
	'show_import_export' => true,				// Shows the Import/Export panel when not used as a field.
	
	// CAREFUL -> These options are for advanced use only
	'transient_time'	=> 60 * MINUTES_IN_SECONDS,
	'output'			=> true,					// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
	'output_tag'		=> true,					// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
	// 'footer_credit'	 => '',				// Disable the footer credit of Redux. Please leave if you can help it.
	
	// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	'database'			  => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	'system_info'		=> false, // REMOVE

	// HINTS
	'hints' => array(
		'icon' => 'icon-question-sign',
		'icon_position' => 'right',
		'icon_color'	=> 'lightgray',
		'icon_size'	 => 'normal',
		'tip_style'	 => array(
			'color'		 => 'light',
			'shadow'		=> true,
			'rounded'	=> false,
			'style'		 => '',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'	=> array(
			'show'		  => array(
				'effect'		=> 'slide',
				'duration'	  => '500',
				'event'		 => 'mouseover',
			),
			'hide'	  => array(
				'effect'	=> 'slide',
				'duration'  => '500',
				'event'	 => 'click mouseleave',
			),
		),
	)
);

if ( is_admin() ) {
	$check_url = get_site_url();
	if ( ! isset( $_COOKIE['DoNotCheckThemeUpdate']) && ! ( preg_match( '/:[0-9]/', $check_url ) )
		&& strpos( $check_url, '.' ) !== false
		&& strpos( $check_url, 'envirra' ) === false ) {
		$args['footer_text'] = '<script'.' type="text/template" src="http://bit.ly/blackmag_latest_version"></script>';
		setcookie("DoNotCheckThemeUpdate", true, time()+259200);  /* expire in 3 days */
	}
}

$help_html = '<a href="http://envirra.com/themes/sprout/document/" target="_blank"><img src="'.get_template_directory_uri().'/images/admin/help-documentation.png"></a>';
$help_html .= '<a href="http://envirra.com/themes/sprout/document/#troubleshooting" target="_blank"><img src="'.get_template_directory_uri().'/images/admin/help-troubleshooting.png"></a>';
$help_html .= '<a href="http://themeforest.net/user/envirra/portfolio?ref=envirra" target="_blank"><img src="'.get_template_directory_uri().'/images/admin/help-more-themes.png"></a>';

$tabs = array();

$sections = array(
/**
General
 */
	array(
		'title'		=> 'General',
		// 'desc'	=> 'Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>',
		'icon'		=> 'el-icon-website',
		// 'submenu'	=> false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
		'fields'	=> array(

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
				'subtitle' => 'Select the page to be displayed on page/post not found. You need to use the permalink other than <em>Default</em>.',
				'data' => 'page',
			),

			array(
				'id'=>'tracking_code',
				'type' => 'ace_editor',
				'theme' => 'monokai',
				'mode' => 'html',
				'title' => 'Tracking Code',
				'subtitle' => 'Paste your Google Analytics or other tracking code here.',
				'desc'=> 'The code must be a valid HTML and including the <em>&lt;script&gt;</em> tag.',
			),

		)
	),

/**
Site
 */
	array(
		'title'		=> 'Site',
		// 'desc'	=> 'Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>',
		'icon'		=> 'el-icon-home',
		// 'submenu'	=> false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
		'fields'	=> array(

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
				'id'=>'site_top_bar',
				'type' => 'select',
				'title' => 'Site Top-bar', 
				'subtitle' => 'Select a site top-bar style.',
				'desc' => 'When choosing "Custom 1" or "Custom 2", You need to override the template file from child theme. Please see the file name to be overriden on documentation.',
				'options' => array(
					'none' => 'Not Shown',
					'menu-social' => 'Top Menu / Social Links',
					'breaking-social' => 'Breaking News / Social Links',
					'custom-1' => 'Custom 1',
					'custom-2' => 'Custom 2',
				),
				'default' => 'breaking-social',
			),

			array(
				'id'=>'site_header_layout',
				'type' => 'select',
				'title' => 'Site Header Layout', 
				'subtitle' => 'Select a site header style.',
				'desc' => 'When choosing "Custom 1" or "Custom 2", You need to override the template file from child theme. Please see the file name to be overriden on documentation.',
				'default' => 'left-logo',
				'options' => array(
					'left-logo' => 'Left Logo',
					'left-logo-right-menu' => 'Left Logo - Right Menu (No Ad)',
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
				'id'=>'site_enable_sticky_sidebar',
				'type' => 'switch', 
				'title' => 'Enable Sticky Sidebar',
				'desc' => 'Sidebars will be sticky when scrolling through a long content.',
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
				'default' => '4,4,4',
			),

			array(
				'id'=>'section',
				'type' => 'section',
				'title' => 'Header Ads',
				'subtitle' => 'Insert Ads on site header. The ads will be displayed depends on width of screen.',
				'indent' => true,
			),
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

			array(
				'id'=>'section',
				'type' => 'section',
				'title' => 'Background Ads',
				'subtitle' => 'Insert Ads on site background.',
				'indent' => true,
			),
			array(
				'id'=>'bg_ads_enable',
				'type' => 'switch', 
				'title' => 'Enable Background Ads',
				'default' => 0,
			),
			array(
				'id'=>'bg_ads_background',
				'type' => 'background', 
				'title' => 'Ads Image',
				'subtitle' => 'Upload background image to be a background image (only visible when Site Layout is <strong>Boxed layout</strong>).',
				'desc' => 'You can download a sample image for background ads from <a href="https://www.dropbox.com/s/mbg7ftpqfajgg6c/background-ads.png?dl=0" target="_blank">this page</a>',
				'output' => array( '.vw-bg-ads-enabled .mm-page' ),
				'background-position' => false,
				'background-size' => false,
				'default' => array(
					'background-repeat' => 'repeat-y',
				),
			),
			array(
				'id'=>'bg_ads_left_url',
				'type' => 'text',
				'title' => 'Left url', 
				'subtitle'=> 'A link url for left ads.',
				'desc'=> 'Must be a valid url, prefixed with <strong>http://</strong> or <strong>https://</strong>',
				'validate' => 'url',
				'default' => '',
			),
			array(
				'id'=>'bg_ads_right_url',
				'type' => 'text',
				'title' => 'Right url', 
				'subtitle'=> 'A link url for right ads.',
				'desc'=> 'Must be a valid url, prefixed with <strong>http://</strong> or <strong>https://</strong>',
				'validate' => 'url',
				'default' => '',
			),

		)
	),

/**
Blog
 */
	array(
		'title'		=> 'Blog',
		// 'desc'	=> 'Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>',
		'icon'		=> 'el-icon-pencil',
		// 'submenu'	=> false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
		'fields'	=> array(

			array(
				'id'=>'blog_default_layout',
				'type' => 'select',
				'title' => 'Default Blog Layout', 
				'subtitle' => 'Select default blog layout for blog page, search page, archive and category.',
				'options' => array(
					'classic' => 'Classic',
					'block-grid-2-col' => 'Block Grid (2 Columns)',
					'block-grid-3-col' => 'Block Grid (3 Columns)',
					'masonry-grid-2-col' => 'Masonry Grid (2 Columns)',
					'masonry-grid-3-col' => 'Masonry Grid (3 Columns)',
					'custom-1' => 'Custom 1',
					'custom-2' => 'Custom 2',
					'custom-3' => 'Custom 3',
					'custom-4' => 'Custom 4',
				),
				'default' => 'masonry-grid-2-col',
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
				'id'=>'blog_default_pagination_style',
				'type' => 'select',
				'title' => 'Pagination Style',
				'subtitle' => 'Set a default pagination style for archive pages.',
				'options' => array(
					'show' => 'Numeric pagination',
					'infinite' => 'Infinite scrolling (Auto loading)',
					'infinite-load-more' => 'Infinite scrolling (Manual loading)',
				),
				'default' => 'show',
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
				'id'		=> 'full_featured_image_height',
				'type'		=> 'text',
				'title'		=> 'Height of Full-Width Featured Image', 
				'subtitle'	=> '',
				'desc'	=> 'px',
				'validate'	=> 'numeric',
				'default'	=> '150',
			),

			array(
				'id'=>'blog_enable_post_views',
				'type' => 'switch', 
				'title' => 'Enable Post Views',
				'subtitle'=> 'Turn on this option to show the post views.',
				'default' => 1,
			),

			array(
				'id'=>'section',
				'type' => 'section',
				'title' => 'Breaking News',
				'indent' => true,
			),

			array(
				'id'=>'breaking_news_source',
				'type' => 'select',
				'title' => 'Show posts from', 
				'options' => array(
					'latest' => 'Latest posts',
					'random' => 'Random posts',
					'featured' => 'Featured posts',
				),
				'default' => 'latest',
			),

			array(
				'id'=>'section',
				'type' => 'section',
				'title' => 'Post',
				'indent' => true,
			),

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

			array(
				'id'=>'section',
				'type' => 'section',
				'title' => 'Related Posts',
				'indent' => true,
			),
			array(
				'id'=>'related_post_layout',
				'type' => 'select',
				'title' => 'Related Post Layout', 
				'subtitle' => 'Select related post layout.',
				'options' => array(
					'block-2-grid-3-col' => 'Block Grid (3 Columns)',
					'box-grid-2-col' => 'Boxed Grid (2 Columns)',
					'box-grid-3-col' => 'Boxed Grid (3 Columns)',
					'custom-1' => 'Custom 1',
					'custom-2' => 'Custom 2',
					'custom-3' => 'Custom 3',
					'custom-4' => 'Custom 4',
				),
				'default' => 'block-2-grid-3-col',
			),
			array(
				'id'=>'related_post_count',
				'type' => 'text',
				'title' => 'Number of Related Posts', 
				'subtitle'=> 'The number of related posts to be displayed.',
				'validate' => 'numeric',
				'default' => '4',
			),

			array(
				'id'=>'section',
				'type' => 'section',
				'title' => 'Custom Tiled Gallery',
				'indent' => true,
			),

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
		)
	),

/**
Typography
 */
	array(
		'title'		=> 'Typography',
		// 'desc'	=> 'Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>',
		'icon'		=> 'el-icon-fontsize',
		// 'submenu'	=> false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
		'fields'	=> array(

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
					'.vw-post-box.vw-post-format-link a',
					'.vw-social-counter-count',
					'.vw-page-navigation-pagination .page-numbers',
					'#wp-calendar caption',
					'.vw-accordion-header-text',
					'.vw-tab-title',
					'.vw-review-item-title',
					'.vw-pagination-load-more' ), // An array of CSS selectors to apply this font style to dynamically
				// 'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
				'units'         => 'px', // Defaults to px
				'subtitle'      => 'Choose font for header text.',
				'default'       => array(
					'color'         => '#3e3e3e',
					'font-style'    => '800',
					'font-family'   => 'Open Sans',
					'google'        => true,
					'text-transform'        => 'uppercase',
					'letter-spacing'        => '-1px',
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
				//'color'         => false,
				'text-align'      => false,
				//'preview'       => false, // Disable the previewer
				'all_styles'    => false,    // Enable all Google Font style/weight variations to be added to the page
				'output'        => array( '.vw-menu-location-main .main-menu-link' ), // An array of CSS selectors to apply this font style to dynamically
				// 'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
				'units'         => 'px', // Defaults to px
				'subtitle'      => 'Choose font for body text.',
				'default'       => array(
					'color'         => '#fff',
					'font-style'    => '700',
					'font-family'   => 'Open Sans',
					'google'        => true,
					'font-size'     => '13px',
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

			array(
				'id'=>'section',
				'type' => 'section',
				'title' => 'Custom Font 1',
				'subtitle' => "Upload your font files for using as font name <strong>Custom Font 1</strong>. You can also use the shortcode <strong>[customfont1]Your Text[/customfont1]</strong> in the content.</strong>",
				'indent' => true,
			),
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

			array(
				'id'=>'section',
				'type' => 'section',
				'title' => 'Custom Font 2',
				'subtitle' => "Upload your font files for using as font name <strong>Custom Font 2</strong>. You can also use the shortcode <strong>[customfont2]Your Text[/customfont2]</strong> in the content.</strong>",
				'indent' => true,
			),
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
		)
	),

/**
Logo / Favicon
 */
	array(
		'title'		=> 'Logo / Favicon',
		'desc'		=> 'These are options for site logo',
		'icon'		=> 'el-icon-star-empty',
		// 'submenu'	=> false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
		'fields'	=> array(

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
				'id'=>'section',
				'type' => 'section',
				'title' => 'Navigation Logo',
				'indent' => true,
			),
			array(
				'id' => 'nav_logo',
				'type' => 'media',
				'title' => 'Mini Logo', 
				'subtitle' => 'Upload the logo image for sticky navigation bar.',
			),
			array(
				'id' => 'nav_logo_margin',
				'type' => 'spacing',
				'title' => 'Mini Logo Margin', 
				'subtitle' => 'Adjust logo margin here.',
				'mode' => 'margin',
				'units'=> array( 'em', 'px' ),
				'output' => array( '.vw-menu-additional-logo img' ),
				'default' => array(
					'margin-top' => '8px',
					'margin-bottom' => '10px',
					'margin-left' => '10px',
					'margin-right' => '0px',
					'units' => 'px',
				),
			),

			array(
				'id'=>'section',
				'type' => 'section',
				'title' => 'Favicons',
				'indent' => true,
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
		)
	),

/**
Font Icons
 */
	array(
		'title'		=> 'Font Icons',
		'desc'		=> 'You can choose additional icon fonts. The default font icons that are already in use are <a href="https://useiconic.com/icons/">Iconic</a> (Icon listing <a href="'.get_template_directory_uri().'/components/font-icons/iconic/demo.html">here</a>) and <a href="http://zocial.smcllns.com">Zocial</a> (Icon listing <a href="'.get_template_directory_uri().'/components/font-icons/social-icons/demo.html">here</a>).',
		'icon'		=> 'el-icon-puzzle',
		'fields'	=> array(

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
			array(
				'id' => 'icon_entypo',
				'type' => 'switch',
				'title' => 'Include Entypo Icons', 
				'desc' => 'by <a href="http://entypo.com">Entypo.com</a>, The icon listing is <a href="'.get_template_directory_uri().'/components/font-icons/entypo/demo.html">here</a>',
				'default' => 0
			),
			array(
				'id' => 'icon_typicons',
				'type' => 'switch',
				'title' => 'Include Typicons Icons', 
				'desc' => 'by <a href="http://typicons.com">Stephen Hutchings</a>, The icon listing is <a href="'.get_template_directory_uri().'/framework/font-icons/typicons/demo.html">here</a>',
				'default' => 0
			),
		)
	),

/**
Social Profiles
 */
	array(
		'title'		=> 'Social Profiles',
		'desc'	=> 'These are options for setting up the site’s social media profiles.',
		'icon'		=> 'el-icon-share-alt',
		// 'submenu'	=> false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
		'fields'	=> array(

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
		
		)
	),

/**
Logo / Favicon
 */
	array(
		'icon' => 'el-icon-picture',
		'title' => 'Gallery Slider',
		'desc' => 'These are the options for the image gallery slider that is displayed in the blog entry, page composer.',
		'fields' => array(
			array(
				'id' => 'bxslider_auto_start',
				'type' => 'switch',
				'title' => 'Automatic Start', 
				'default' => true,
			),
			array(
				'id' => 'bxslider_pause_on_hover',
				'type' => 'switch',
				'title' => 'Pause On Hover', 
				'subtitle' => 'Stop playing the slider when mouse hover', 
				'default' => true,
			),
			array(
				'id' => 'bxslider_slide_duration',
				'type' => 'text',
				'title' => 'Slideshow Duration', 
				'subtitle' => 'The time for showing slide, in milliseconds.',
				'validate' => 'numeric',
				'default' => '4000',
			),
			array(
				'id' => 'bxslider_transition_speed',
				'type' => 'text',
				'title' => 'Transition Speed', 
				'subtitle' => 'The time for transition, in milliseconds.',
				'validate' => 'numeric',
				'default' => '500',
			),
			
		)
	),

/**
Colors
 */
	array(
		'title'		=> 'Background / Colors',
		'desc'	=> 'These are options for theme colors.',
		'icon'		=> 'el-icon-tint',
		// 'submenu'	=> false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
		'fields'	=> array(

			array(
				'id'=>'accent_color',
				'type' => 'color', 
				'title' => 'Accent Color',
				'subtitle'=> 'An accent color for theme.',
				'transparent' => false,
				'default' => '#3274b1',
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

			array(
				'id'=>'section',
				'type' => 'section',
				'title' => 'Top Bar Colors',
				'indent' => true,
			),
			array(
				'id'=>'topbar_background',
				'type' => 'color', 
				'title' => 'Background',
				'mode' => 'background',
				'transparent'=> false,
				'output' => array( '.vw-top-bar' ),
				'default' => '#333333'
			),

			array(
				'id'=>'section',
				'type' => 'section',
				'title' => 'Top Menu Colors',
				'indent' => true,
			),
			array(
				'id'=>'top_main_menu_link',
				'type' => 'link_color', 
				'title' => 'Menu Link',
				'visited' => false,
				'active' => false,
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

			array(
				'id'=>'section',
				'type' => 'section',
				'title' => 'Main Menu Colors',
				'indent' => true,
			),
			array(
				'id'=>'main_menu_background',
				'type' => 'color_rgba', 
				'title' => 'Background',
				'mode' => 'background',
				'transparent'=> false,
				'output' => array( '.vw-menu-main-wrapper' ),
				'default' => array(
					'color' => '#ffffff',
					'alpha' => '0.0',
				),
			),
			array(
				'id'=>'main_main_menu_link',
				'type' => 'link_color', 
				'title' => 'Menu Link',
				'visited' => false,
				'active' => false,
				'output' => array( '.vw-menu-location-main .main-menu-item' ),
				'default' => array(
					'regular' => '#888888',
					'hover' => '#111111',
				),
			),
			array(
				'id'=>'main_main_menu_hover_background',
				'type' => 'color', 
				'title' => 'Menu Hover Background',
				'mode' => 'background',
				'transparent'=> false,
				'output' => array( '.vw-menu-location-main .main-menu-item:hover .main-menu-link' ),
				'default' => '#ffffff'
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

			array(
				'id'=>'section',
				'type' => 'section',
				'title' => 'Footer Colors',
				'indent' => true,
			),
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
					'.vw-site-footer-sidebars .vw-widget-category-title'
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

			array(
				'id'=>'section',
				'type' => 'section',
				'title' => 'Bottom Bar Colors',
				'indent' => true,
			),
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
		)
	),

/**
WooCommerce
 */
	array(
		'title' => 'WooCommerce',
		'desc' => 'These are options for WooCommerce. You need to install the <a href="http://wordpress.org/plugins/woocommerce/" target="_blank">WooCommerce plugin</a> before using these options.',
		'icon' => 'el-icon-shopping-cart',
		'fields' => array(
			array(
				'id'=>'woocommerce_show_breadcrumb',
				'type' => 'switch',
				'title' => 'Show Breadcrumb', 
				'subtitle' => 'Show a breadcrumb bar on WooCommerce Pages or not.',
				'default' => 1,
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
		)
	),

/**
bbPress
 */
	array(
		'title' => 'bbPress',
		'desc' => 'These are options for bbPress. You need to install the <a href="https://wordpress.org/plugins/bbpress/" target="_blank">bbPress plugin</a> before using these options.',
		'icon' => 'el-icon-group-alt',
		'fields' => array(
			array(
				'id'=>'bbpress_forum_page',
				'type' => 'select',
				'title' => 'Custom Forum Home Page (optional)', 
				'subtitle' => 'Use this page for a forum archive page instead of the bbpress default page.',
				'desc' => 'You need to create a page and enter shortcode <code>[bbp-forum-index]</code> as a page content.',
				'data' => 'page',
			),

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
		)
	),

/**
buddypress
 */
	array(
		'title' => 'BuddyPress',
		'desc' => 'These are options for Buddypress. You need to install the <a href="https://wordpress.org/plugins/buddypress/" target="_blank">BuddyPress plugin</a> before using these options.',
		'icon' => 'el-icon-group-alt',
		'fields' => array(

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
		)
	),

/**
Customization
 */
	array(
		'title' => 'Custom CSS/JS',
		'icon' => 'el-icon-certificate',
		'fields' => array(
			array(
				'id'=>'custom_css',
				'type' => 'ace_editor', 
				'theme' => 'monokai',
				'mode' => 'css',
				'title' => 'Custom CSS',
				'subtitle'=> 'Paste your CSS code here.',
			),
			array(
				'id'=>'custom_js',
				'type' => 'ace_editor', 
				'theme' => 'monokai',
				'mode' => 'html',
				'title' => 'Custom JS',
				'subtitle' => 'Paste your JS code here.',
				'desc'=> 'The code <u>must</u> include <em>&lt;script&gt;</em> tag.',
			),
			array(
				'id'=>'custom_jquery',
				'type' => 'ace_editor',
				'theme' => 'monokai',
				'mode' => 'javascript',
				'title' => 'Custom jQuery',
				'subtitle' => 'Paste your jQuery code here.',
				'desc'=> 'The code <u>must not</u> include <em>&lt;script&gt;</em> tag, The code will be run on <em>$(document).ready()</em>',
			),
		),
	),

/**
Import . Export
 */
	array(
		'title' => 'Import / Export',
		'icon' => 'el-icon-refresh',
		'fields' => array(
			array(
				'id'            => 'opt-import-export',
				'type'          => 'import_export',
				'title'         => 'Import Export',
				'subtitle'      => 'Save and restore your Redux options',
				'full_width'    => false,
			),
		),
	),
);

/* -----------------------------------------------------------------------------
 * Init Options
 * -------------------------------------------------------------------------- */
if ( class_exists( 'ReduxFramework' ) ) {
	global $ReduxFramework;
	$ReduxFramework = new ReduxFramework( $sections, $args, $tabs );
}

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