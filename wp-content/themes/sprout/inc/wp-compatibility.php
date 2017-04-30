<?php

/**
 * Fix Pagination Issue For WP 4.4.1
 */
global $wp_version;

if ( version_compare( $wp_version, '4.4.1', '==' ) ) {
	add_filter( 'redirect_canonical', 'vw_fix_pagination_issue_of_wp44', 11, 2 );

	if ( ! function_exists( 'vw_fix_pagination_issue_of_wp44' ) ) {
		function vw_fix_pagination_issue_of_wp44( $redirect_url, $requested_url ) {
			// Refer: https://core.trac.wordpress.org/ticket/35344
			global $wp_rewrite, $is_IIS, $wp_query, $wpdb, $wp;

			if ( is_singular() && get_query_var('page') && ( !is_front_page() || ( isset($wp_query->queried_object) && 'page' == get_option('show_on_front') && $wp_query->queried_object->ID == get_option('page_on_front') ) ) ) { 
				if ( !$redirect_url ) 
					$redirect_url = get_permalink( get_queried_object_id() ); 
					$page = get_query_var( 'page' ); 
				if ( is_front_page() ) { 
					$redirect_url = trailingslashit( $redirect_url ) . user_trailingslashit( "$wp_rewrite->pagination_base/$page", 'paged' ); 
				} else { 
					$redirect_url = trailingslashit( $redirect_url ) . user_trailingslashit( $page, 'single_paged' ); 
				} 
				$redirect['query'] = remove_query_arg( 'page', $redirect['query'] ); 
			}

			return $redirect_url;
		}
	}
}