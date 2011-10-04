var center_lat = null, center_lng = null, radius = null;
var selecting = false;
var circle = null;

function initialize_lunchsparks_googlemap() {  
  var latlng = new google.maps.LatLng(1.293444, 103.836751);
  var myOptions = {
    zoom: 12,
    center: latlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  var map = new google.maps.Map(document.getElementById("map_canvas"),
    myOptions);

  google.maps.event.addListener(map, 'click', function(event) {
    if (!selecting) {
      selecting = true;
      center_lat = event.latLng.lat();
      center_lng = event.latLng.lng();      
    }
    else {
      selecting = false;
    }
  });
  
  google.maps.event.addListener(map, 'mousemove', function(event) {
    if (selecting) {            
      radius = google.maps.geometry.spherical.computeDistanceBetween(
        new google.maps.LatLng(center_lat, center_lng),
        event.latLng
      );        

      var populationOptions = {
        clickable: false,
        strokeColor: "#FF0000",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#FF0000",
        fillOpacity: 0.30,
        map: map,
        center: new google.maps.LatLng(center_lat, center_lng),
        radius: radius
      };

      if (circle != null) {
        circle.setMap(null);
      }
      circle = new google.maps.Circle(populationOptions);
    }
  });
}

