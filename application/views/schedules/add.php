<div class="m-content">
	<div class="m-content-2-col-left">
		<?php $this -> load -> view('schedules/includes/sidetab');?>
	</div>
	<div class="m-content-2-col-right">
		<?php /* <div id="pick-history" style="background-color: #efefef; padding: 10px; -webkit-border-radius: 12px; -moz-border-radius: 12px; margin-right: 10px">
		 Your history:
		 <ul id ="pick-history-ul">
		 </ul>
		 </div> */
		?>

		<div class="hr">
			<h2 class="hr-text">Add Schedules</h2>
		</div>
		
		<?php echo form_open("schedules/add");?>
		<div id="pick">
			<div>
				<label>Name: </label>
				<input type="text" name="name" id="name" value="<?php echo isset($_REQUEST['name']) ? $_REQUEST['name'] : ''; ?>" placeholder="A name for reference.">
			</div>
			<div id="pick-a-date">
				<label>Pick a date: </label>
				<input type="text" name="start_date" id="start_date" class="datepicker" value="<?php echo isset($_REQUEST['start_date']) ? $_REQUEST['start_date'] : '';?>" placeholder="mm/dd/yyyy">
			</div>
			<div id="pick-a-time">
				<label>Pick a time</label>
				<div></div>
				<input type="text" name="start_time" id="start_time" class="timepicker" value="<?php echo isset($_REQUEST['start_time']) ? $_REQUEST['start_time'] : '';?>" style="display:inline-block;" placeholder="08:00 am">
				<span> to </span>
				<input type="text" name="end_time" id="end_time" class="timepicker" value="<?php echo isset($_REQUEST['end_time']) ? $_REQUEST['end_time'] : '';?>" style="display:inline-block;" placeholder="08:00 am">
			</div>
			<div id="pick-a-location">
				<label>Pick a location: </label>
				<div id="map_canvas" style="width:100%; height:300px; border: 1px solid #CCC;"></div>
				<i>Hint: Click on the map to choose your place,
				move the mouse to specify how far you wish to travel,
				click the second time to finish</i>
			</div>
			<input type="hidden" name="center_lat" id="center_lat" value="">
			<input type="hidden" name="center_lng" id="center_lng" value="">
			<input type="hidden" name="radius" id="radius" value="">
		</div>
		<br />
		<div class="button-set">
			<input type="submit" id="add_pick_button" value="Add Schedule">
		</div>
		<?php echo form_close();?>
		<br />
	</div>
</div>

<script>
	jQuery(document).ready( function() {
		initialize_lunchsparks_googlemap();
	}
	); 
</script>
