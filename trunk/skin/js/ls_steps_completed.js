jQuery(document).ready(function() {
	jQuery('#steps-completed-title-btn').click(function() {
		if (confirm("This will disable this guide permanently. Continue?")) {
			jQuery.getJSON('/json/steps_completed_toggle_disabled', function(data) {
				if(data.results){
					jQuery('#steps-completed').slideUp('slow');
				}
			});
		} else {
			return false;
		}
		return false;
	});
	
	jQuery('#steps-completed-title').click(function() {
		jQuery.getJSON('/json/steps_completed_toggle_hide', function(data) {
			if(data.results){
				if (jQuery('#steps-completed-body').css('display') == 'none') {
					jQuery('#steps-completed-body').slideDown('slow');	
				} else {
					jQuery('#steps-completed-body').slideUp('slow');
				}
			}
		});
		return false;
	});
});