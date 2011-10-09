var center_lat = null, center_lng = null, radius = null;
var selecting = false;
var circle = null;

function initialize_lunchsparks_googlemap() {
	var latlng = new google.maps.LatLng(1.293444, 103.836751);
	var myOptions = {
		zoom : 12,
		center : latlng,
		mapTypeId : google.maps.MapTypeId.ROADMAP
	};

	var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

	google.maps.event.addListener(map, 'click', function(event) {
		if(!selecting) {
			selecting = true;
			center_lat = event.latLng.lat();
			center_lng = event.latLng.lng();
		} else {
			selecting = false;
		}
	});

	google.maps.event.addListener(map, 'mousemove', function(event) {
		if(selecting) {
			radius = google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng(center_lat, center_lng), event.latLng);

			var populationOptions = {
				clickable : false,
				strokeColor : "#FF0000",
				strokeOpacity : 0.8,
				strokeWeight : 2,
				fillColor : "#FF0000",
				fillOpacity : 0.30,
				map : map,
				center : new google.maps.LatLng(center_lat, center_lng),
				radius : radius
			};

			if(circle != null) {
				circle.setMap(null);
			}
			circle = new google.maps.Circle(populationOptions);
		}
	});
}

function ls_draw_maps(el_id, lat, lng, radius) {
	jQuery.each(jQuery(".map-canvas"), function(index, value) {
		alert(jQuery(value));
		jQuery(value).attr("id", "newId");
	});
	el = jQuery("#map-canvas-" + el_id.id);
	var latlng = new google.maps.LatLng(-34.397, 150.644);
	var myOptions = {
		zoom : 8,
		center : latlng,
		mapTypeId : google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map(el, myOptions);
}

function ls_draw_circle(center_lat, center_lng, radius_meter) {

	// Dummy Data
	var center_lat = 1.293444;
	var center_lng = 103.870053307129;
	var radius_meter = 2000;

	// Calculations
	var latlngs = new google.maps.MVCArray();
	var radius = meterToDecimalDegree(radius_meter);
	var pi2 = Math.PI * 2;
	var steps = Math.round(radius_meter / 100 * 2);
	alert("Steps: " + steps);
	for(var i = 0; i < steps; i++) {
		var lat = center_lat + radius * Math.cos(i / steps * pi2);
		var lng = center_lng + radius * Math.sin(i / steps * pi2);
		var newLocation = new google.maps.LatLng(lat, lng);
		//alert(newLocation);
		latlngs.push(newLocation);
	}
	var encodeString = google.maps.geometry.encoding.encodePath(latlngs);
	alert(encodeString);
	var polyline_data = encodeString;
	//jQuery("#test-map").attr("src","http://maps.google.com/maps/api/staticmap?size=600x500&path=fillcolor:0x00FF00|weight:1|color:0xFFFFFF|enc:"+polyline_data);
}

function getGStaticMapEncoded(center_lat, center_lng, radius_meter) {
	
	//jQuery('body').append(center_lat + " | " + center_lng + " | " + radius_meter + " | ");
	
	center_lat = parseFloat(center_lat);
	center_lng = parseFloat(center_lng);
	radius_meter = parseFloat(radius_meter);
	
	// Dummy Data
	/*var center_lat = 1.29687635042505;
	var center_lng = 103.870053307129;
	var radius_meter = 2675.70179093281;*/
	
	// Calculations
	var latlngs = new google.maps.MVCArray();
	var radius = meterToDecimalDegree(radius_meter);
	var pi2 = Math.PI * 2;
	var steps = Math.round(radius_meter / 100 * 1.5);

	for(var i = 0; i < steps; i++) {
		var lat = (center_lat + (radius * Math.cos(i / steps * pi2)));
		//jQuery('body').append(lat + " | ");
		var lng = center_lng + radius * Math.sin(i / steps * pi2);
		var newLocation = new google.maps.LatLng(lat, lng);
		latlngs.push(newLocation);
	}
	var encoded_polygon = google.maps.geometry.encoding.encodePath(latlngs);
	//jQuery('body').append(encoded_polygon);
	var map_width = 400;
	var map_height = 200;
	var g_url = 'http://maps.google.com/maps/api/staticmap?size=' + map_width + 'x' + map_height + '&sensor=true&path=fillcolor:0x00FF00|weight:1|color:0xFFFFFF|enc:';
	return g_url + encoded_polygon;
}

function meterToDecimalDegree(value) {
	return (value / 1.11) * 0.00001;
}

function returntxt() {
	return "test.png";
}

function ScheduleController() {
	var scope = this;

	scope.returntxt = function(center_lat, center_lng, radius_meter) {
		return getGStaticMapEncoded(center_lat, center_lng, radius_meter);
	};
}