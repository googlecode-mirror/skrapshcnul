<script type="text/javascript"
src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
	var map;
	function initialize() {
		var myOptions = {
			zoom : 8,
			center : new google.maps.LatLng(-34.397, 150.644),
			mapTypeId : google.maps.MapTypeId.ROADMAP
		};
		map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);
	}


	google.maps.event.addDomListener(window, 'load', initialize);

</script>
<div id="map_canvas"></div>