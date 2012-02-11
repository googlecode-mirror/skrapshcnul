function codeLatLng() {
	var input = document.getElementById("latlng").value;
	var latlngStr = input.split(",", 2);
	var lat = parseFloat(latlngStr[0]);
	var lng = parseFloat(latlngStr[1]);
	var latlng = new google.maps.LatLng(lat, lng);
	geocoder.geocode({
		'latLng' : latlng
	}, function(results, status) {
		if(status == google.maps.GeocoderStatus.OK) {
			if(results[1]) {
				map.setZoom(11);
				marker = new google.maps.Marker({
					position : latlng,
					map : map
				});
				infowindow.setContent(results[1].formatted_address);
				infowindow.open(map, marker);
			} else {
				console.log("No results found");
			}
		} else {
			console.log("Geocoder failed due to: " + status);
		}
	});
}

function codeAddress(address) {
	if (address = 'undefined') {
		var address = document.getElementById("address").value;
	}
	
	geocoder.geocode({
		'address' : address
	}, function(results, status) {
		console.log('codeAddress(): '+ results );
		if(status == google.maps.GeocoderStatus.OK) {
			map.setCenter(results[0].geometry.location);
			var marker = new google.maps.Marker({
				map : map,
				position : results[0].geometry.location
			});
		} else {
			alert("Geocode was not successful for the following reason: " + status);
		}
	});
}