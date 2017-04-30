<?php 

if ( ! function_exists( 'vw_is_enable_breaking_news' ) ) {
	function vw_is_enable_breaking_news() {
		if ( vw_get_theme_option( 'enable_breaking_news' ) ) {
			if ( is_front_page() ) {
				$is_enable_breaking_news = vw_get_theme_option( 'show_breaking_news_on_front_page' );

			} else {
				$is_enable_breaking_news = true;

			}

		} else {
			$is_enable_breaking_news = false;

		}

		return apply_filters( 'vw_filter_is_enable_breaking_news', $is_enable_breaking_news );
	}
}

if ( ! function_exists( 'vw_get_breaking_news_posts' ) ) {
	function vw_get_breaking_news_posts() {
		$args = array(
			'post_type' => 'post',
			'ignore_sticky_posts' => true,
			'posts_per_page' => 8,
			'offset' => 0,
		);

		$source = vw_get_theme_option( 'breaking_news_source' );

		if ( 'random' == $source ) {
			$args['orderby'] = 'rand';

		} else if ( 'featured' == $source ) {
			$args['meta_query'][] = array(
				'key' => 'vw_post_featured',
				'value' => '1',
				'compare' => '=',
			);
			
		}

		return new WP_Query( apply_filters( 'vw_filter_breaking_news_query_args', $args ) );
	}
}