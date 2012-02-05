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
		
		<?php echo form_open();?>
		<div id="pick">
			<div class="box-container">
				<div class="title">
					Name:
					<div class="description">A name for your own reference.</div>  
				</div>
				<input required="required" type="text" name="name" id="name" value="<?php echo isset($schedule['name']) ? $schedule['name'] : ''; ?>" placeholder="A name for reference." >
			</div>
			<div id="pick-a-date" class="box-container">
				<div class="title">
					Pick a date: 
					<div class="description"></div> 
				</div>
				<input required="required" type="text" name="start_date" id="start_date" class="datepicker" value="<?php echo isset($schedule['start_date']) ? $schedule['start_date'] : '';?>" placeholder="yyyy-mm-dd">
				
				<script>
				jQuery(function() {
					jQuery( ".datepicker" ).datepicker("option", "dateFormat", "yy-mm-dd");
					jQuery( ".datepicker" ).val('<?php echo isset($schedule['start_date']) ? $schedule['start_date'] : '';?>');
				});
				</script>
				
				<div>
					<div style="200px;display: inline-block;float:left;width:100px;">
						<input type="checkbox" name="schedule_repeat" value="Repeat" onchange="schedule_repeat_toggle()" <?php echo isset($schedule['repeat_params']) && !empty($schedule['repeat_params'])  ? 'checked' : '';?> /><span>Repeat</span>
					</div>
					<div style="display: inline-block;">
						<div id="day_checkbox_container" style="<?php echo isset($schedule['repeat_params']) && !empty($schedule['repeat_params'])  ? '' : 'display: none;';?>">
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
								<input id="repeat_<?php echo $key; ?>" name="<?php echo $key; ?>" type="checkbox" <?php echo isset($schedule['repeat_days']) && in_array($key, $schedule['repeat_days']) ? 'checked' : '';?>>
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
					<input onchange="schedule_add_time_validation()" type="text" name="start_time" id="start_time" class="timepicker" value="<?php echo isset($schedule['start_time']) ? $schedule['start_time'] : '';?>" style="display:inline-block;" placeholder="08:00">
					<span> to </span>
					<input onchange="schedule_add_time_validation()" type="text" name="end_time" id="end_time" class="timepicker" value="<?php echo isset($schedule['end_time']) ? $schedule['end_time'] : '';?>" style="display:inline-block;" placeholder="23:00">
				</div>
				<div id="timepicker_message"></div>
			</div>
			<div id="pick-a-location" class="box-container">
				<div class="title">Pick a location: </div>
				<div id="map_canvas" style="width:100%; height:300px; border: 1px solid #CCC;"></div>
				<i>Hint: Click on the map to choose your place, move the mouse to specify how far you wish to travel, click the second time to finish</i>
			</div>
			<input type="hidden" name="center_lat" id="center_lat" value="">
			<input type="hidden" name="center_lng" id="center_lng" value="">
			<input type="hidden" name="radius" id="radius" value="">
			
		</div>
		<br />
		<div class="button-set">
			<input type="submit" id="add_pick_button" value="Update Schedule" onclick="return schedule_validate();">
		</div>
		<?php echo form_close();?>
		<br />
	</div>
</div>

<script>
	jQuery(document).ready( function() {
		<?php if (isset($schedule['center_lat']) && isset($schedule['center_lng']) && isset($schedule['radius'])) { ?>
			initialize_lunchsparks_googlemap(<?php echo $schedule['center_lat'] ?>, <?php echo $schedule['center_lng'] ?>, <?php echo $schedule['radius'] ?>)
		<?php } else { ?>
			initialize_lunchsparks_googlemap();
		<?php } ?>
	}); 
</script>
