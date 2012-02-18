<div class="m-content">
	<div class="c-pages shadow-rounded">
		<?php /* <div id="pick-history" style="background-color: #efefef; padding: 10px; -webkit-border-radius: 12px; -moz-border-radius: 12px; margin-right: 10px">
		 Your history:
		 <ul id ="pick-history-ul">
		 </ul>
		 </div> */
		?>

		<h2><?php echo $tpl_page_title;?></h2>
		<h3 class="sub-heading">Enter your preferences here. Our system will pickup the keywords from here.</h3>
		<?php echo form_open();?>
		<div id="pick">
			<div class="box-container">
				<div class="title">
					Name:
					<div class="description">
						A name for your own reference.
					</div>
				</div>
				<input required="required" type="text" name="name" id="name" value="<?php echo isset($schedule['name']) ? $schedule['name'] : '';?>" placeholder="A name for reference." >
			</div>
			<div id="pick-a-date" class="box-container">
				<div class="title">
					Pick a date: <div class="description"></div>
				</div>
				<div>
					<?php $days_in_week = array('SU' => 'Sunday', 'MO' => 'Monday', 'TU' => 'Tuesday', 'WE' => 'Wednesday', 'TH' => 'Thursday', 'FR' => 'Friday', 'SA' => 'Saturday', );?>
					<?php $slots_in_day = array('LUNCH' => 'Lunch', 'DINNER' => 'Dinner' );?>
					<?php foreach ($days_in_week as $key => $value) { ?>
					<div style="display: inline-block;">
						<div style="display: inline-block;">
							<input id="repeat_day_<?php echo $key;?>" name="DAY[]" value="<?php echo $value; ?>" type="hidden" <?php echo isset($schedule['repeat_params']['DAY']) && in_array($value, $schedule['repeat_params']['DAY']) ? 'checked' : '';?>>
							<label for="repeat_day_<?php echo $key;?>"><?php echo $value;?></label> 
						</div>
						<?php foreach ($slots_in_day as $key2 => $value2) { ?>
							<div>
								<input id="<?php echo $value;?>_<?php echo $key2;?>" name="<?php echo $value;?>_<?php echo $key2;?>" type="checkbox" <?php echo isset($schedule['repeat_params'][$value][$key2]) && $schedule['repeat_params'][$value][$key2] ? 'checked' : '';?>>
								<label for="<?php echo $value;?>_<?php echo $key2;?>"><?php echo $value2;?></label> 
							</div>
						<?php }?>
					</div>
					<?php }?>
				</div>
			</div>
			<div id="pick-a-location" class="box-container">
				<div class="title">
					Pick a location:
				</div>
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
	initialize_lunchsparks_googlemap(<?php echo $schedule['center_lat']
	?>,<?php echo $schedule['center_lng']
	?>,<?php echo $schedule['radius']
	?>)<?php } else {?>
		initialize_lunchsparks_googlemap();

	<?php }?>
});
</script>
