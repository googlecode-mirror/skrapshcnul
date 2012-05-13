
function initiate_geolocation(geo_lat, geo_lng) {
	
	/* Default Location */
	var geo_lat = 1.293444;
	var geo_lng = 103.836751;
	
	var latlng = new google.maps.LatLng(geo_lat, geo_lng);
	var myOptions = {
		zoom : 12,
		center : latlng,
		mapTypeId : google.maps.MapTypeId.ROADMAP
	};

	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	
	if(navigator.geolocation) {
		console.log('Geolocation permission granted.');
		navigator.geolocation.getCurrentPosition(function(position) {
			handle_geolocation_query(position);
		} , function() {
			handle_errors();
		});
	} else {
		yqlgeo.get('visitor', normalize_yql_response);
	}
}

function handle_errors(error) {
	switch(error.code) {
		case error.PERMISSION_DENIED:
			alert("user did not share geolocation data");
			break;

		case error.POSITION_UNAVAILABLE:
			alert("could not detect current position");
			break;

		case error.TIMEOUT:
			alert("retrieving position timedout");
			break;

		default:
			alert("unknown error");
			break;
	}
}

function normalize_yql_response(response) {
	if(response.error) {
		var error = {
			code : 0
		};
		handle_error(error);
		return;
	}

	var position = {
		coords : {
			latitude : response.place.centroid.latitude,
			longitude : response.place.centroid.longitude
		},
		address : {
			city : response.place.locality2.content,
			region : response.place.admin1.content,
			country : response.place.country.content
		}
	};

	handle_geolocation_query(position);
}

function handle_geolocation_query(position) {
	
	console.log('Lat: ' + position.coords.latitude + ' Lon: ' + position.coords.longitude);
	
	var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
	
	/*var infowindow = new google.maps.InfoWindow({
      map: map,
      position: pos,
      content: 'Location found using HTML5.'
    });*/
    
    map.setCenter(pos);
    
    setMarkers(persons);
}

function setMarkers(locations) {
	var shape = {
		coord: [1, 1, 1, 20, 18, 20, 18 , 1],
		type: 'poly'
	};
	for (var i = 0; i < locations.length; i++) {
		
		var beach = locations[i];
		
		function writeToGMap(pos) {
			console.log('param (pos): ' + pos);
			
			var image = new google.maps.MarkerImage(beach[2],
				// This marker is 20 pixels wide by 32 pixels tall.
				new google.maps.Size(32, 32),
				// The origin for this image is 0,0.
				new google.maps.Point(0,0),
				// The anchor for this image is the base of the flagpole at 0,32.
				new google.maps.Point(16, 42)
			);
			var shadow = new google.maps.MarkerImage('/skin/images/40/pin-white-transparent.png',
				// The shadow image is larger in the horizontal dimension
				// while the position and offset are the same as for the main image.
				new google.maps.Size(40, 53),
				new google.maps.Point(0,0),
				new google.maps.Point(20, 46)
			);
			
			var myLatLng = new google.maps.LatLng(pos);
			var marker = new google.maps.Marker({
				position: myLatLng,
				map: map,
	        	shadow: shadow,
				icon: image,
				shape: shape,
				title: beach[3],
				zIndex: beach[0]
			});
		}
		
		codeAddress(beach[1], function(data) {
			writeToGMap(data);
		});
		
	}
	
}
