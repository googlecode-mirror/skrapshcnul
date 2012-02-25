/* Steps Completed */

var cookie_name_steps_completed = "cn_stepcompleted"

jQuery(document).ready(function() {
	if (jQuery('#steps-completed').length > 0) {
		new Ls_steps_completed();
		Ls_steps_completed.initialize();
	}
});

var Ls_steps_completed = function() {
	// Default Settings for Steps Completed
	Ls_steps_completed.settings = {
		isDismissed : false,
		isHidden : false,
	}
	Ls_steps_completed.states = {
		
	}
}

Ls_steps_completed.initialize = function() {
	
	if (jQuery.cookie(cookie_name_steps_completed) == null) {
		//console.log(jQuery(settings).serialize());
		//console.log(JSON.stringify(settings));
		jQuery.cookie(cookie_name_steps_completed, JSON.stringify(Ls_steps_completed.settings));
	} else {
		Ls_steps_completed.settings = JSON.parse(jQuery.cookie(cookie_name_steps_completed));
	}
	
	if (Ls_steps_completed.settings.isDismissed) { jQuery('#steps-completed').hide(); }
	else { jQuery('#steps-completed').show(); }
	
	console.log(Ls_steps_completed.settings);
	console.log(Ls_steps_completed.settings.isHidden);
	if (Ls_steps_completed.settings.isHidden) { jQuery('#steps-completed-body').hide(); }
	else { jQuery('#steps-completed-body').show(); }
	
	Ls_steps_completed.update();
	setInterval('Ls_steps_completed.update()', 10000);
}

Ls_steps_completed.update = function() {
	
	jQuery.getJSON('/jsonp/guides/steps_completed?alt=json&callback=?',{}, function(data) {
		//if (window.console) console.log(data);
		if (data.results) {
			Ls_steps_completed.states = data.results;
			Ls_steps_completed.update_view();
		}
	});
}

Ls_steps_completed.update_view = function() {
	// Create local copy of settings
	var states = Ls_steps_completed.states;
	
	if (states.step1.state == 'Completed') { jQuery('.steps-completed-item.step1 .completed-overlay').removeClass('incomplete'); } 
	else { jQuery('.steps-completed-item.step1 .completed-overlay').addClass('incomplete'); }
	
	if (states.step2.state == 'Completed') { jQuery('.steps-completed-item.step2 .completed-overlay').removeClass('incomplete'); } 
	else { jQuery('.steps-completed-item.step2 .completed-overlay').addClass('incomplete'); }
	
	if (states.step3.state == 'Completed') { jQuery('.steps-completed-item.step3 .completed-overlay').removeClass('incomplete'); } 
	else { jQuery('.steps-completed-item.step3 .completed-overlay').addClass('incomplete'); }
	
	if (states.step4.state == 'Completed') { jQuery('.steps-completed-item.step4 .completed-overlay').removeClass('incomplete'); } 
	else { jQuery('.steps-completed-item.step4 .completed-overlay').addClass('incomplete'); }
	
	if (window.console) console.log(states);
	if (window.console) console.log('Steps Completed updated.');
}

jQuery(document).ready(function() {
	jQuery('#steps-completed-title-btn').click(function() {
		if (confirm("This will disable this guide permanently. Continue?")) {
			/*jQuery.getJSON('/json/steps_completed_toggle_disabled', function(data) {
				if(data.results){
					jQuery('#steps-completed').slideUp('slow');
				}
			});*/
			Ls_steps_completed.settings.isDismissed = true;
			jQuery.cookie(cookie_name_steps_completed, JSON.stringify(Ls_steps_completed.settings));
		} else {
			return false;
		}
		return false;
	});
	
	jQuery('#steps-completed-title').click(function() {
		/*jQuery.getJSON('/json/steps_completed_toggle_hide', function(data) {
			if(data.results){
				if (jQuery('#steps-completed-body').css('display') == 'none') {
					jQuery('#steps-completed-body').slideDown('slow');	
				} else {
					jQuery('#steps-completed-body').slideUp('slow');
				}
			}
		});*/
		if (jQuery('#steps-completed-body').css('display') == 'none') {
			Ls_steps_completed.settings.isHidden = false;
			jQuery('#steps-completed-body').slideDown('slow');
			jQuery.cookie(cookie_name_steps_completed, JSON.stringify(Ls_steps_completed.settings));
		} else {
			Ls_steps_completed.settings.isHidden = true;
			jQuery('#steps-completed-body').slideUp('slow');
			jQuery.cookie(cookie_name_steps_completed, JSON.stringify(Ls_steps_completed.settings));
		}
		
		return true;
	});
});