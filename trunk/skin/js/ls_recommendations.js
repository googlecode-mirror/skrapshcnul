/**
 * @author stiucsib86
 */

function user_recommendation_confirm(element) {
	var el = jQuery(element);
	
	var oid = (el.attr('ls-oid'));
	var url = '/jsonp/recommendation/confirm';
	
	jQuery.getJSON(url+'?alt=json&callback=?', {
		recommendation_id: oid
	}, function(data) {
		console.log(data);
		if (data.results) {
			// TODO Handle results
		} else {
			// TODO Handle failed results
		}
	});
	
}

function user_recommendation_reject(element) {
	var el = jQuery(element);
	
	var oid = (el.attr('ls-oid'));
	var url = '/jsonp/recommendation/reject';
	
	jQuery.getJSON(url+'?alt=json&callback=?', {
		recommendation_id: oid
	}, function(data) {
		console.log(data);
		if (data.results) {
			// TODO Handle results
		} else {
			// TODO Handle failed results
		}
	});
	
}

function user_recommendation_rsvp_confirm(element) {
	var el = jQuery(element);
	
	var oid = (el.attr('ls-oid'));
	var url = '/jsonp/events/rsvp';
	
	if (confirm("You are about to accept this event suggestion. You will NOT be able to change it later. Are you sure you want to continue?")) {
		jQuery.getJSON(url+'?alt=json&callback=?', {
			'action': 'confirm',
			'oid': oid,
		}, function(data) {
			console.log(data);
			console.log(data.results);
			if (data.results) {
				el.parent().parent().html('You have accepted this event suggestion.');
			} else if (data.errors){
				alert("There are error processing your request.");
				console.warn(data.errors);
			}
		});
	} else {
		jQuery(element).removeAttr('checked', '');
		jQuery('label[for='+jQuery(element).attr('id')+']').removeClass('ui-state-active');
		console.log(jQuery(element).attr('checked'));
		return false;
	}
}

function user_recommendation_rsvp_reject(element) {
	
	var el = jQuery(element);
	
	var oid = (el.attr('ls-oid'));
	var url = '/jsonp/events/rsvp';
	
	if (confirm("You are about to reject this event suggestion. You will NOT be able to change it later. Are you sure you want to continue?")) {
		jQuery.getJSON(url+'?alt=json&callback=?', {
			'action': 'reject',
			'oid': oid,
		}, function(data) {
			console.log(data);
			if (data.results) {
				el.parent().parent().html('You have rejected this event suggestion.');
			} else {
				alert("There are error processing your request.");
				console.warn(data.errors);
			}
		});
	} else {
		jQuery(element).removeAttr('checked', '');
		jQuery('label[for='+jQuery(element).attr('id')+']').removeClass('ui-state-active');
		console.log(jQuery(element).attr('checked'));
		return false;
	}
}
