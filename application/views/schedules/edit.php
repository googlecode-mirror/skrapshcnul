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
		
		<?php echo form_open("schedules/edit");?>
		<div id="pick">
			<div class="box-container">
				<div class="title">
					Name:
					<div class="description">A name for your own reference.</div>  
				</div>
				<input required="required" type="text" name="name" id="name" value="<?php echo isset($_REQUEST['name']) ? $_REQUEST['name'] : ''; ?>" placeholder="A name for reference." >
			</div>
			<div id="pick-a-date" class="box-container">
				<div class="title">
					Pick a date: 
					<div class="description"></div> 
				</div>
				<input required="required" type="text" name="start_date" id="start_date" class="datepicker" value="<?php echo isset($_REQUEST['start_date']) ? $_REQUEST['start_date'] : '';?>" placeholder="mm/dd/yyyy">
				<div>
					<div style="200px;display: inline-block;float:left;width:100px;">
						<input type="checkbox" name="schedule_repeat" value="Repeat" onchange="schedule_repeat_toggle()" /><span>Repeat</span>
					</div>
					<div style="display: inline-block;">
						<div id="day_checkbox_container" style="display: none;">
							<div>
								<select id="repeat_frequency" name="repeat_frequency">
									<option value="weekly">Weekly</option>
									<option value="monthly">Monthly</option>
									<option value="yearly">Yearly</option>
								</select>
							</div>
							
							<?php $days_in_week = array(
								'SU' => 'Sunday',
								'MO' => 'Monday',
								'TU' => 'Tuesday',
								'WE' => 'Wednesday',
								'TH' => 'Thursday',
								'FR' => 'Friday',
								'SA' => 'Saturday',
							); ?>
							<?php foreach ($days_in_week as $key => $value) { ?>
							<span class="">
								<input id="repeat_<?php echo $key; ?>" name="<?php echo $key; ?>" type="checkbox">
								<label for="repeat_<?php echo $key; ?>"><?php echo $value; ?></label>
							</span>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<div id="pick-a-time" class="box-container">
				 <div class="title">Pick a time</div>
				<div>
					<input onchange="schedule_add_time_validation()" type="text" name="start_time" id="start_time" class="timepicker" value="<?php echo isset($_REQUEST['start_time']) ? $_REQUEST['start_time'] : '';?>" style="display:inline-block;" placeholder="08:00">
					<span> to </span>
					<input onchange="schedule_add_time_validation()" type="text" name="end_time" id="end_time" class="timepicker" value="<?php echo isset($_REQUEST['end_time']) ? $_REQUEST['end_time'] : '';?>" style="display:inline-block;" placeholder="23:00">
				</div>
				<div id="timepicker_message"></div>
			</div>
			<div id="pick-a-location" class="box-container">
				<div class="title">Pick a location: </div>
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
			<input type="submit" id="add_pick_button" value="Add Schedule" onclick="return schedule_validate();">
		</div>
		<?php echo form_close();?>
		<br />
	</div>
</div>

<script>
	jQuery(document).ready( function() {
		initialize_lunchsparks_googlemap();
	}); 
</script>
