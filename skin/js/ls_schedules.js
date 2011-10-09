function displayPickHistory() {
	jQuery.post("schedules/select", function(data) {
		var data = eval(data);
		//convert from json to array of objects
		jQuery("#pick-history-ul").html("");
		for(var i = 0; i < data.length; ++i) {
			var p = data[i];
			jQuery("#pick-history-ul").append("<li>" + p.user_id + " " + p.index + " " + p.date + " " + p.time + " " + p.center_lat + " " + p.center_lng + " " + p.radius + "<a class='delete-link' id = '" + p.index + "'> [X]</a>" + "</li>");
		}
	});
}

jQuery(document).ready( function() {
	jQuery(".datepicker").datepicker({})

	jQuery('.timepicker').timepicker({
		ampm : true, //don't change; modifying this requires changes in schedules_model
		hourMin : 8,
		hourMax : 23
	});
	
	initialize_lunchsparks_googlemap();
	
	jQuery("#add_pick_button").click(function() {
		jQuery("#9").innerHTML = "a";
		var date = jQuery("#datepicker").attr("value");
		var startTime = jQuery("#start_time").attr("value");
		var endTime = jQuery("#end_time").attr("value");
		
		if (center_lat == null || center_lat == '' || center_lng == null || radius == null) {
			alert('Please select the location on map.');
			jQuery('#map_canvas').focus();
			return false;
		}
		
		var location = center_lat + ", " + center_lng + ", " + radius;
		jQuery('input[name=center_lat]').val(center_lat);
		jQuery('input[name=center_lng]').val(center_lng);
		jQuery('input[name=radius]').val(radius);
		return true;
		
		jQuery.post("schedules/insert", {
			'date' : date,
			'time' : time,
			'center_lat' : center_lat,
			'center_lng' : center_lng,
			'radius' : radius
		}, function(data) {
			//displayPickHistory();
			//refresh pick-history-ul
			alert(data);
		});
	});
});

/*
jQuery(document).ready(function() {
	jQuery("#datepicker").datepicker({
	});

	jQuery('#timepicker').timepicker({
		ampm : true, //don't change; modifying this requires changes in schedules_model
		hourMin : 8,
		hourMax : 23
	});

	jQuery(".delete-link").live('click', function() {
		jQuery.post("schedules/delete", {
			'index' : this.id
		}, function(data) {
			displayPickHistory();
			console.log(data);
		});
	});
	displayPickHistory();
	
});
*/