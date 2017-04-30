/* -----------------------------------------------------------------------------
 * Document ready
 * -------------------------------------------------------------------------- */
;(function( $, window, document, undefined ){
	"use strict";
	
	$( document ).ready( function ($) {
		// Affix
		$('#sidebar').affix({
			offset: {
				top: $('#sidebar').offset().top,
			}
		})

		// Smooth scroll
		$('a[href*=#]:not([href=#])').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				if (target.length) {
					$('html,body').animate({
						scrollTop: target.offset().top
					}, 250);
					return false;
				}
			}
		});

	} );
})( jQuery, window , document );