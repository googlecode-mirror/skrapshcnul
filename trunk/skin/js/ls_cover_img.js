jQuery(document).ready(function() {
	jQuery('.cover_background').hover(function() {
		jQuery('.after_cover_background').fadeTo(0.5);
	}, function() {
		jQuery('.after_cover_background').fadeTo(1);
	});
});