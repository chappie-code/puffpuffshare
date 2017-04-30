<?php
/**
 * Plugin Name: Advanced Image Grabber
 * Plugin URI: http://www.wolopress.com/advanced-image-grabber/
 * Description: Advanced Image Grabber can import all images into your media library from external webpage urls. You can select the images to upload and import selected images automatically by one click. This plugin is extremely useful for the people who doesn't want to spend hours to search image in web and manually upload to wordpress media library. You can use Advanced Image Grabber at frontend inside post/page or theme with shortcode [aig_frontend] or php functions too. 
 * Version: 1.0
 * Author: Mansur Ahamed
 * Author URI: http://www.wolopress.com/
 * License: GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
 */

define(ADVANCED_IMAGE_GRABBER, plugin_dir_url(__FILE__));
require_once('class_image_grabber.php');
require_once('views.php');
add_action( 'admin_menu', 'advanced_image_grabber_admin_menu' );

function advanced_image_grabber_admin_menu() {
	add_management_page( 
		'Advanced Image Grabber',
		'Image Grabber',
		'manage_options',
		'advanced-image-grabber',
		array('Advanced_Image_Grabber_views','adminSettingsPage')
	);
}

?>