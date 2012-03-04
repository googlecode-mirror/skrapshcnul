jQuery(document).ready(function() {
	jQuery('.cover_background').hover(function() {
		jQuery('.after_cover_background').slideToggle('slow');
	}, function() {
		jQuery('.after_cover_background').slideToggle('slow');
	});
});