<?php
// Define content width
if ( ! isset( $content_width ) ) {
	$content_width = 1140;
}

/* -----------------------------------------------------------------------------
 * Setup theme
 * -------------------------------------------------------------------------- */
add_action( 'after_setup_theme', 'vw_after_theme_setup' );
if ( ! function_exists( 'vw_after_theme_setup' ) ) {
	function vw_after_theme_setup() {
		/**
		 * Make theme translatable
		 */
		load_theme_textdomain( 'envirra', get_stylesheet_directory() . '/languages' );

		/**
		 * Add supported features
		 */
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-formats', array( 'audio', 'gallery', 'video' ) );
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

		/**
		 * Define thumbnail sizes
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'vw_one_third_thumbnail', 360, 240, true ); // Size 1/3, Ratio 2:1
		add_image_size( 'vw_one_third_thumbnail_no_crop', 360, 0, false ); // Size 1/3, Ratio 2:1
		add_image_size( 'vw_two_third_thumbnail', 750, 375, true );  // Size 2/3, Ratio 2:1
		add_image_size( 'vw_two_third_thumbnail_no_crop', 750, 0, false );  // Size 2/3, Ratio 2:1
		add_image_size( 'vw_small_squared_thumbnail', 60, 60, true ); // Squared
		add_image_size( 'vw_full_width_thumbnail', 1263, 560, true ); // Size 1/1
		add_image_size( 'vw_category_thumbnail', 200, 200, true ); // Squared

		/**
		 * Register menu
		 */
		register_nav_menu( 'vw_menu_main', 'Main Menu' );
		register_nav_menu( 'vw_menu_mobile', 'Mobile Menu' );
		register_nav_menu( 'vw_menu_top', 'Top Menu' );
		register_nav_menu( 'vw_menu_bottom', 'Bottom Menu' );

		/**
		 * Add custom filters
		 */		
		add_filter( 'widget_title', 'do_shortcode', 10, 2 );
		add_filter( 'widget_text', 'do_shortcode', 10, 2 );

	}
}

/* -----------------------------------------------------------------------------
 * Add Site Meta in Header
 * -------------------------------------------------------------------------- */
add_filter( 'wp_head', 'vw_site_meta' );
if ( ! function_exists( 'vw_site_meta' ) ) {
	function vw_site_meta() {
		get_template_part( '/templates/site-meta' );
	}
}

/* -----------------------------------------------------------------------------
 * Add Blog Custom Excerpt Length
 * -------------------------------------------------------------------------- */
add_filter( 'excerpt_length', 'vw_custom_excerpt_length' );
if ( ! function_exists( 'vw_custom_excerpt_length' ) ) {
	function vw_custom_excerpt_length( $length ) {
		return intval( vw_get_theme_option( 'blog_excerpt_length' ) );
	}
}

/* -----------------------------------------------------------------------------
 * Add Custom Excerpt More
 * -------------------------------------------------------------------------- */
add_filter( 'excerpt_more', 'vw_custom_excerpt_more' );
if ( ! function_exists( 'vw_custom_excerpt_more' ) ) {
	function vw_custom_excerpt_more( $length ) {
		return '';
	}
}

/* -----------------------------------------------------------------------------
 * Add Body Classes
 * -------------------------------------------------------------------------- */
add_filter( 'body_class', 'vw_body_class_options' );
if ( ! function_exists( 'vw_body_class_options' ) ) {
	function vw_body_class_options( $classes ) {

		// Option class
		if ( vw_get_theme_option( 'site_enable_sticky_menu' ) ) {
			$classes[] = 'vw-site-enable-sticky-menu';
		}

		// Site layout class
		$site_layout = vw_get_theme_option( 'site_layout' );
		$classes[] = sprintf( 'vw-site-layout-%s', $site_layout );

		// Background ads class
		if ( vw_get_theme_option( 'bg_ads_enable' ) ) {
			$classes[] = 'vw-bg-ads-enabled';
		}

		// Post layout class for single post page
		if ( is_single() ) {
			$post_layout = vw_get_post_layout();
			$classes[] = sprintf( 'vw-post-layout-%s', $post_layout );
		}

		return $classes;
	}
}

/* -----------------------------------------------------------------------------
 * Add Site Title
 * -------------------------------------------------------------------------- */
add_filter( 'wp_title', 'vw_wp_title', 10, 2 );
if ( ! function_exists( 'vw_wp_title' ) ) {
	function vw_wp_title( $title, $sep ) {
		global $paged, $page;

		if ( is_feed() ) {
			return $title;
		}

		// Add the site name.
		$title .= get_bloginfo( 'name' );

		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title = "$title $sep $site_description";
		}

		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 ) {
			$title = "$title $sep " . sprintf( __( 'Page %s', 'envirra' ), max( $paged, $page ) );
		}

		return $title;
	}
}

/* -----------------------------------------------------------------------------
 * Post Classes
 * -------------------------------------------------------------------------- */
add_filter( 'post_class', 'vw_post_classes' );
function vw_post_classes( $classes ) {
	if ( ! post_password_required() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}

/* -----------------------------------------------------------------------------
 * Allow Font File Uploads
 * -------------------------------------------------------------------------- */
add_filter( 'upload_mimes', 'vw_allowed_upload_mimes' );
if ( ! function_exists( 'vw_allowed_upload_mimes' ) ) {
	function vw_allowed_upload_mimes( $existing_mimes = array() ) {
		$existing_mimes['ttf'] = 'font/ttf';
		$existing_mimes['otf'] = 'font/opentype';
		$existing_mimes['woff'] = 'font/woff';
		$existing_mimes['svg'] = 'font/svg';
		$existing_mimes['eot'] = 'font/eot';
		
		return $existing_mimes;
	}
}

/* -----------------------------------------------------------------------------
 * Add Link To Author Page
 * -------------------------------------------------------------------------- */
add_filter( 'get_comment', 'vw_force_comment_author_url' );
function vw_force_comment_author_url( $comment ) {
	// does the comment have a valid author URL?
	$no_url = !$comment->comment_author_url || $comment->comment_author_url == 'http://';

	if ( $comment->user_id && $no_url ) {
		// comment was written by a registered user but with no author URL
		$comment->comment_author_url = get_author_posts_url( $comment->user_id );
	}

	return $comment;
}

/* -----------------------------------------------------------------------------
 * Post box class
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_post_box_class' ) ) {
	function vw_post_box_class( $class = '' ) {		
		$classes = array( 'vw-post-box' );

		if ( ! empty( $class ) ) {
			$classes[] = $class;
		}

		if ( has_post_format() ) {
			$classes[] = ' vw-post-box-format-'.get_post_format();
		} else {
			$classes[] = ' vw-post-box-format-standard';
		}

		if ( vw_has_review() ) {
			$classes[] = ' vw-post-box-has-review';
		} else {
			$classes[] = ' vw-post-box-has-no-review';
		}

		echo ' class="' . esc_attr( join( ' ', $classes ) ) . '" ';
	}
}

/* -----------------------------------------------------------------------------
 * Remove extra padding in image caption
 * -------------------------------------------------------------------------- */
add_filter( 'img_caption_shortcode_width', 'vw_remove_caption_padding' );
if ( ! function_exists( 'vw_remove_caption_padding' ) ) {
	function vw_remove_caption_padding( $width ) {
		return $width - 10;
	}
}

/* -----------------------------------------------------------------------------
 * Allow skype protocol
 * -------------------------------------------------------------------------- */
function vw_allow_skype_protocol( $protocols ){
    $protocols[] = 'skype';
    return $protocols;
}
add_filter( 'kses_allowed_protocols' , 'vw_allow_skype_protocol' );