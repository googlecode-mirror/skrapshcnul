<script>
  function displayPickHistory() {    
    $.post("schedules/select", function(data) {
      var data = eval(data); //convert from json to array of objects
      $("#pick-history-ul").html("");
      for (var i = 0; i < data.length; ++i) {
        var p = data[i];        
        $("#pick-history-ul").append("<li>" + 
          p.user_id + " " + p.index + " " +
          p.date + " " + p.time + " " +
          p.center_lat + " " + p.center_lng + " " + p.radius +
          "<a class='delete-link' id = '" + p.index + "'> [X]</a>" +
          "</li>");
      }
    });        
  }
  
  $(document).ready(function() {
    $("#datepicker").datepicker({    
    });

    $('#timepicker').timepicker({
      ampm: true, //don't change; modifying this requires changes in schedules_model
      hourMin: 8,
      hourMax: 23
    });
    
    $("#add_pick_button").click(function(){
      $("#9").innerHTML = "a";
      var date = $("#datepicker").attr("value");
      var time = $("#timepicker").attr("value");
      var location = center_lat + ", " + center_lng + ", " + radius;     
      $.post("schedules/insert", {
        'date': date, 
        'time': time,  
        'center_lat': center_lat, 
        'center_lng': center_lng, 
        'radius': radius 
      }, function(data) {        
        displayPickHistory(); //refresh pick-history-ul
      });
    });
    
    $(".delete-link").live('click', function(){      
      $.post("schedules/delete", {
        'index' : this.id
      }, function(data) {
        displayPickHistory();
        console.log(data);
      });
    });
    
    displayPickHistory();
    initialize_lunchsparks_googlemap();
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
  Your history:
  <ul id ="pick-history-ul">    
  </ul>
</div>

<hr/>

<div id="pick">
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
  <input type="button" id="add_pick_button" value="Add">
</div>
