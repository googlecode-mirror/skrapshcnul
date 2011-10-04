	<script>
	$(function() {
		$("#datepicker").datepicker({    
		});        
    
    $('#timepicker').timepicker({
      ampm: true,
      hourMin: 8,
      hourMax: 23      
    });
    
    $("#add_new_lunch_button").click(function() {
      $(this).hide();      
      $("#pick").show();
      initialize_lunchsparks_googlemap();
      $("#add_this_lunch_button").show();
    });
    
    $("#add_this_lunch_button").click(function(){
      var date = $("#datepicker").attr("value");
      var time = $("#timepicker").attr("value");
      var location = center_lat + ", " + center_lng + ", " + radius;
      $("#pick-history").html(date + "<br/>" + time + "<br/>" + location);
    })
  });
	</script>

  <style>
    .ui-timepicker-div .ui-widget-header{ margin-bottom: 8px; }
    .ui-timepicker-div dl{ text-align: left; }
    .ui-timepicker-div dl dt{ height: 25px; }
    .ui-timepicker-div dl dd{ margin: -25px 0 10px 65px; }
    .ui-timepicker-div td { font-size: 90%; }
  </style>
  
<p/>

<div id="pick-history" style="background-color: #efefef; padding: 10px; -webkit-border-radius: 12px; -moz-border-radius: 12px; margin-right: 10px">
  Nothing to show.
  <ul id ="pick-history-ul">
  </ul>
</div>

<hr/>

<div id="pick" style="display:none;">
  <div id="pick-a-date">
    Pick a date:
    <input type="text" id="datepicker" style="border:solid thin;" value="">
  </div>

  <div id="pick-a-time">
    Pick a time:
    <input type="text" id="timepicker" style="border:solid thin;" value="">
  </div>

  <div id="pick-a-location">
    Pick a location:<br/>
    <i>Hint: Click on the map to choose your place, 
      move the mouse to specify how far you wish to travel,
      click the second time to finish</i>
    <div id="map_canvas" style="width:500px; height:300px; border:solid thin;"></div>
  </div>
</div>

<div>
  <br/>
  <input type="button" id="add_new_lunch_button" style="display:inline;" value="Add new lunch">
  <input type="button" id="add_this_lunch_button" style="display:none;" value="Add">
</div>
