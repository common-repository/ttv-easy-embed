(function( $ ) {
	'use strict';

	jQuery(document).ready(function(a) {
		if (jQuery('body').hasClass('twitch-integration_page_streamweasels-rail')) {

			var clipboard = new ClipboardJS('#sw-copy-shortcode');

			clipboard.on('success', function (e) {
				jQuery(e.trigger).addClass('tooltipped');
				jQuery(e.trigger).on('mouseleave', function() {
					jQuery(e.trigger).removeClass('tooltipped');
				})
			  });

			  jQuery('#sw-rail-border-colour').wpColorPicker();
			  jQuery('#sw-rail-controls-bg-colour').wpColorPicker();
			  jQuery('#sw-rail-controls-arrow-colour').wpColorPicker();
			  
		}
	})


})( jQuery );
