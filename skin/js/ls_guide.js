/* Steps Completed */

var cookie_name_steps_completed = "cn_stepcomp"

jQuery(document).ready(function() {
	
	switch(document.title) {
		case 'Synchronize':
		case 'Preferences' :
		case 'Schedules' :
		case 'Events' :
			steps_completed_initialize();
			break;
		default :
			break;
	}
	
});

function steps_completed_initialize() {
	
	// Define default settings.
	var settings = {
		isDismissed : false,
		isHidden : false,
		step1 : false,
		step2 : false,
		step3 : false,
		step4 : false
	}
	
	jQuery("#steps-completed").show('slow');
	
	console.log(jQuery.cookie(cookie_name_steps_completed));
	if (jQuery.cookie(cookie_name_steps_completed) == null) {
		//console.log(jQuery(settings).serialize());
		console.log(JSON.stringify(settings));
		jQuery.cookie(cookie_name_steps_completed, settings);
	}
}

function steps_completed_update() {
	
	
	
}

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