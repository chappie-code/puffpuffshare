<?php
/*
Plugin Name: Sprout Theme Options Panel
Plugin URI: http://themeforest.net/user/envirra/portfolio?ref=envirra
Description: Theme options panel for Sprout Theme.
Version: 1.3.0
Author: Envirra
Author URI: http://themeforest.net/user/envirra/portfolio?ref=envirra
*/

if ( ! function_exists( 'vw_load_theme_options_panel' ) ) {
	function vw_load_theme_options_panel() {
		// Load ReduxFramework for Theme Options Panel
		if ( ! class_exists( 'ReduxFramework' ) ) {
			require_once 'redux-framework/redux-framework.php';
		}

		// Load Metabox for Post Format Options Panel
		if ( ! defined( 'RWMB_VER' ) ) {
			require_once 'meta-box/meta-box.php';
		}

		// Load ACF for Post/Page Options Panel
		if ( ! class_exists( 'acf' ) ) {
			require_once 'advanced-custom-fields/acf.php';
		}
	}
}

if ( ! function_exists( 'vw_load_importer' ) ) {
	function vw_load_importer() {
		error_reporting( E_ALL & ~E_NOTICE & ~E_STRICT );
		set_time_limit(0);
		ini_set( 'max_execution_time', 0 );

		// Load Importer
		if ( ! class_exists( 'WP_Import' ) ) {
			require_once 'wordpress-importer/wordpress-importer.php';
		}

		// Load Widget Importer
		if ( ! function_exists( 'wie_process_import_file' ) ) {
			require_once 'widget-importer-exporter/widgets.php';
			require_once 'widget-importer-exporter/import.php';
		}
	}
}