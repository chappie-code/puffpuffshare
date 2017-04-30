<?php

/* -----------------------------------------------------------------------------
 * Render Custom JS
 * -------------------------------------------------------------------------- */
add_action( 'wp_footer', 'vw_render_footer_js', 99 );
if ( ! function_exists( 'vw_render_footer_js' ) ) {
	function vw_render_footer_js() {
		?>
		<!-- Theme's Custom JS -->
		<?php
		/**
		 * Render Tracking Code
		 */
		echo vw_get_theme_option( 'tracking_code' );

		/**
		 * Render Custom JS code
		 */
		echo vw_get_theme_option( 'custom_js' );

		/**
		 * Render Custom JS
		 */
		?>
		<script type='text/javascript'>
			;(function( $, window, document, undefined ){
				"use strict";

				$( document ).ready( function () {
					/* Render registered custom scripts */
					<?php do_action( 'vw_action_render_custom_jquery' ); ?>

					/* Render custom jquery option */
					<?php echo vw_get_theme_option( 'custom_jquery' ); ?>

				} );

				$( window ).ready( function() {
					
				} );
				
			})( jQuery, window , document );

		</script>
		<!-- End Theme's Custom JS -->
		<?php 
	}
}