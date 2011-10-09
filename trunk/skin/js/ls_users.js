jQuery(document).ready(function($) {
	// User verification
	jQuery("#user-verification").hover(function() {
		jQuery(".user-verification-text").show("slide", {
			direction : "left"
		}, 500);
	}, function() {
		jQuery(".user-verification-text").hide("slide", {
			direction : "left"
		}, 500);
	});
});
