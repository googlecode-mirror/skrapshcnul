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
	
	jQuery.getJSON(url+'?alt=json&callback=?', {
		'action': 'confirm',
		'oid': oid,
	}, function(data) {
		console.log(data);
		if (data.results) {
			// TODO Handle results
		} else {
			// TODO Handle failed results
		}
	});
	
}

function user_recommendation_rsvp_reject(element) {
	
	var el = jQuery(element);
	
	var oid = (el.attr('ls-oid'));
	var url = '/jsonp/events/rsvp';
	
	jQuery.getJSON(url+'?alt=json&callback=?', {
		'action': 'reject',
		'oid': oid,
	}, function(data) {
		console.log(data);
		if (data.results) {
			// TODO Handle results
		} else {
			// TODO Handle failed results
		}
	});
	
}
