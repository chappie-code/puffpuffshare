<?php
/* -----------------------------------------------------------------------------
 * Custom BuddyPress Functions
 * -------------------------------------------------------------------------- */

/**
 * Apply breaking news option
 */
add_filter( 'vw_filter_is_enable_breaking_news', 'vw_bp_is_enable_breaking_news' );
if ( ! function_exists( 'vw_bp_is_enable_breaking_news' ) ) {
	function vw_bp_is_enable_breaking_news( $is_enabled ) {
		if ( vw_is_buddypress() ) {
			return vw_get_theme_option( 'buddypress_show_breaking_news' );

		} else {
			return $is_enabled;

		}
	}
}

/**
 * Apply sidebar position option
 */
add_filter( 'vw_filter_sidebar_position', 'vw_bp_sidebar_position' );
if ( ! function_exists( 'vw_bp_sidebar_position' ) ) {
	function vw_bp_sidebar_position( $sidebar_position ) {
		if ( vw_is_buddypress() ) {
			return vw_get_theme_option( 'buddypress_default_sidebar_position' );

		} else {
			return $sidebar_position;

		}
	}
}

/**
 * Apply left sidebar option
 */
add_filter( 'vw_filter_left_sidebar', 'vw_bp_left_sidebar' );
if ( ! function_exists( 'vw_bp_left_sidebar' ) ) {
	function vw_bp_left_sidebar( $sidebar ) {
		if ( vw_is_buddypress() ) {
			return vw_get_theme_option( 'buddypress_default_left_sidebar' );

		} else {
			return $sidebar;

		}
	}
}

/**
 * Apply right sidebar option
 */
add_filter( 'vw_filter_right_sidebar', 'vw_bp_right_sidebar' );
if ( ! function_exists( 'vw_bp_right_sidebar' ) ) {
	function vw_bp_right_sidebar( $sidebar ) {
		if ( vw_is_buddypress() ) {
			return vw_get_theme_option( 'buddypress_default_right_sidebar' );

		} else {
			return $sidebar;

		}
	}
}

/* -----------------------------------------------------------------------------
 * Utility Functions
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'vw_is_buddypress' ) ) {
	function vw_is_buddypress() {
		return function_exists( 'is_buddypress' ) && is_buddypress();
	}
}