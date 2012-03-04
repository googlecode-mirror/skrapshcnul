<div id="places_map"></div>

<script>
var map;
var infowindow;

jQuery(document).ready(function(){
	function initialize() {
		var pyrmont = new google.maps.LatLng(-33.8665433,151.1956316);
		map = new google.maps.Map(document.getElementById('places_map'), {
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			center: pyrmont,
			zoom: 15
		});
		
		var request = {
			location: pyrmont,
			radius: '500',
			types: ['store']
		};
		infowindow = new google.maps.InfoWindow();
		service = new google.maps.places.PlacesService(map);
		console.log(service);
		service.search(request, callback);
	}
	
	function callback(results, status) {
		if (status == google.maps.places.PlacesServiceStatus.OK) {
			for (var i = 0; i < results.length; i++) {
				var place = results[i];
				createMarker(results[i]); 
			}
		}
	}
	function createMarker(place) {
		var placeLoc = place.geometry.location;
		var marker = new google.maps.Marker({
			map: map,
 			position: place.geometry.location
		});
		
		google.maps.event.addListener(marker, 'click', function() {
			infowindow.setContent(place.name);
			infowindow.open(map, this);
		});
	}
	
	google.maps.event.addDomListener(window, 'load', initialize);
});
</script>