<?php

/* -----------------------------------------------------------------------------
 * Render Custom CSS
 * -------------------------------------------------------------------------- */
add_action( 'wp_head', 'vw_render_custom_css', 99 );
if ( ! function_exists( 'vw_render_custom_css' ) ) {
	function vw_render_custom_css() {
		global $vw_sprout;
	?>
	<!-- Theme's Custom CSS -->
	<style type="text/css">
		
		a, a:hover,
		.vw-page-title-box .vw-label,
		.vw-post-categories a,
		.vw-page-subtitle,
		.vw-review-total-score,
		.vw-breaking-news-date,
		.vw-date-box-date,
		.vw-post-style-classic .vw-post-box-title a:hover,
		.vw-post-likes-count.vw-post-liked .vw-icon,
		.vw-menu-location-bottom .main-menu-link:hover,
		.vw-accordion-header.ui-accordion-header-active span,
		.vw-404-text,
		#wp-calendar thead,
		.vw-accordion .ui-state-hover span,
		.vw-breadcrumb a:hover,
		.vw-post-tabed-tab.ui-state-active, .vw-post-tabed-tab.ui-state-hover a,
		.vw-tabs.vw-style-top-tab .vw-tab-title.active,
		h1 em, h2 em, h3 em, h4 em, h5 em, h6 em
		{
			color: <?php echo $vw_sprout['accent_color'] ?>;
		}

		.vw-site-social-profile-icon:hover,
		.vw-breaking-news-label,
		.vw-author-socials a:hover,
		.vw-post-style-box:hover,
		.vw-post-box:hover .vw-post-format-icon i,
		.vw-gallery-direction-button:hover,
		.widget_tag_cloud .tagcloud a:hover,
		.vw-page-navigation-pagination .page-numbers:hover,
		.vw-page-navigation-pagination .page-numbers.current,
		#wp-calendar tbody td:hover,
		.vw-widget-category-post-count,
		.vwspc-section-full-page-link:hover .vw-button,
		
		.vw-tag-links a,
		.vw-hamburger-icon:hover,
		.pace .pace-progress,
		.vw-review-summary-bar .vw-review-score,
		.vw-review-total-score span, .vw-review-score-percentage .vw-review-item-score, .vw-review-score-points .vw-review-item-score,
		.vw-pricing-featured .vw-pricing-header,
		.vw-bxslider .bx-prev:hover, .vw-bxslider .bx-next:hover,
		.no-touch input[type=button]:hover, .no-touch input[type=submit]:hover, .no-touch button:hover, .no-touch .vw-button:hover,
		.vw-page-content .vw-page-title-box .vw-label,
		.vw-breaking-news-title,
		.vw-post-style-small-left-thumbnail .vw-post-view-count,
		.vw-quote-icon,
		.vw-dropcap-circle, .vw-dropcap-box,
		.vw-accordion .ui-icon:before,
		.vw-post-categories .vw-sticky-link,
		.vw-pagination-load-more:hover
		{
			background-color: <?php echo $vw_sprout['accent_color'] ?>;
		}

		.vw-about-author-section .vw-author-name,
		.vw-post-meta-large .vw-date-box,
		#wp-calendar caption,
		.vw-widget-feedburner-text,
		.vw-login-title,
		.widget_search label,
		.widget_vw_widget_author .vw-widget-author-title
		{
			border-color: <?php echo $vw_sprout['accent_color'] ?>;
		}

		.vw-menu-location-top.sf-arrows .main-menu-link.sf-with-ul:after {
			border-top-color: <?php echo $vw_sprout['top_main_menu_link']['regular'] ?>;
		}
		.vw-menu-location-top.sf-arrows .sub-menu-link.sf-with-ul:after {
			border-left-color: <?php echo $vw_sprout['top_main_menu_link']['regular'] ?>;
		}

		.sf-arrows > li > .sf-with-ul:focus:after, .sf-arrows > li:hover > .sf-with-ul:after, .sf-arrows > .sfHover > .sf-with-ul:after {
			border-top-color: <?php echo $vw_sprout['accent_color'] ?> !important;
		}

		.vw-menu-location-top .main-menu-link,
		.vw-top-bar .vw-site-social-profile-icon,
		.vw-top-bar-right .vw-cart-button, .vw-top-bar-right .vw-instant-search-buton {
			color: <?php echo $vw_sprout['top_main_menu_link']['regular'] ?>;
		}
		
		.vw-menu-location-main .main-menu-item.current-menu-item,
		.vw-menu-location-main .main-menu-item.current-menu-parent,
		.vw-menu-location-main .main-menu-item.current-menu-ancestor {
			background-color: <?php echo $vw_sprout['main_main_menu_hover_background']; ?>;
			color: <?php echo $vw_sprout['top_main_menu_link']['hover'] ?>;
		}

		.vw-menu-location-top .main-menu-item:hover .main-menu-link {
			color: <?php echo $vw_sprout['top_main_menu_link']['hover'] ?>;
		}

		<?php if ( isset( $vw_sprout['logo']['width'] ) ): ?>
		.vw-site-header-style-left-logo-right-menu .vw-logo-wrapper {
			min-width: <?php echo $vw_sprout['logo']['width']; ?>px;
		}
		<?php endif; ?>

		.rtl .vw-menu-additional-logo img {
			margin-left: <?php echo $vw_sprout['nav_logo_margin']['margin-right']; ?>;
			margin-right: <?php echo $vw_sprout['nav_logo_margin']['margin-left']; ?>;
		}

		/* Header font */
		input[type=button], input[type=submit], button, .vw-button,
		.vw-header-font-family,
		.vw-copyright {
			font-family: <?php echo $vw_sprout['typography_header']['font-family'] ?>;
		}

		/* Body font */
		.vw-breaking-news-link {
			font-family: <?php echo $vw_sprout['typography_body']['font-family'] ?>;
		}

		.vw-page-title-section.vw-has-background .col-sm-12 {
			padding-top: <?php echo $vw_sprout['full_featured_image_height'] ?>px;
		}

		.vw-sticky-wrapper.is-sticky .vw-menu-main-wrapper.vw-sticky {
			background-color: <?php echo vw_rgba( $vw_sprout['main_menu_background']['color'], 0.95 ); ?>;
		}

		/* WooCommerce */
		
		.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price,
		.woocommerce #content div.product p.price, .woocommerce #content div.product span.price, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce-page #content div.product p.price, .woocommerce-page #content div.product span.price, .woocommerce-page div.product p.price, .woocommerce-page div.product span.price,
		.woocommerce .widget_shopping_cart .widget_shopping_cart_content .total .amount, .woocommerce-page .widget_shopping_cart .widget_shopping_cart_content .total .amount,
		.woocommerce .product_list_widget .quantity, .woocommerce .product_list_widget .amount, .woocommerce-page .product_list_widget .quantity, .woocommerce-page .product_list_widget .amount
		{
			color: <?php echo $vw_sprout['accent_color'] ?>;
		}

		.woocommerce .widget_layered_nav_filters ul li a, .woocommerce-page .widget_layered_nav_filters ul li a,
		.widget_product_tag_cloud .tagcloud a:hover, .widget_tag_cloud .tagcloud a:hover,
		woocommerce #content input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce-page #content input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover, .woocommerce #content input.button.alt:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce-page #content input.button.alt:hover, .woocommerce-page #respond input#submit.alt:hover, .woocommerce-page a.button.alt:hover, .woocommerce-page button.button.alt:hover, .woocommerce-page input.button.alt:hover,
		.woocommerce span.onsale, .woocommerce-page span.onsale,
		.vw-cart-button-count
		{
			background-color: <?php echo $vw_sprout['accent_color'] ?>;
		}

		/* bbPress */
		#bbpress-forums .bbp-forum-title {
			color: <?php echo $vw_sprout['typography_header']['color'] ?>;
		}

		/* buddypress */
		#buddypress div.item-list-tabs ul li.current a:hover, #buddypress div.item-list-tabs ul li.selected a:hover,
		#buddypress .comment-reply-link:hover, #buddypress a.button:hover, #buddypress button:hover, #buddypress div.generic-button a:hover, #buddypress input[type=button]:hover, #buddypress input[type=reset]:hover, #buddypress input[type=submit]:hover, #buddypress ul.button-nav li a:hover, a.bp-title-button:hover
		{
			background-color: <?php echo $vw_sprout['accent_color'] ?>;
		}

		/* Custom Styles */
		<?php do_action( 'vw_action_render_custom_css' ); ?>
	</style>
	<!-- End Theme's Custom CSS -->
	<?php
	}
}

/* -----------------------------------------------------------------------------
 * Render Custom CSS option
 * -------------------------------------------------------------------------- */
add_action( 'vw_action_render_custom_css', 'vw_render_custom_css_option' );
if ( ! function_exists( 'vw_render_custom_css_option' ) ) {
	function vw_render_custom_css_option() {
		echo vw_get_theme_option( 'custom_css' );
	}
}