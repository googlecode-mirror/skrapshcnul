<div style="background: #F8F8F8; border: 1px solid #CCCCCC; padding: 10px; margin: 10px 0;">
	<div class="title" style="background: #F1F1F1; padding: 10px; cursor: pointer;" onclick="jQuery(this).next().slideToggle('slow');">
		Create new event.
	</div>
	<div style="display:none;">
		<form method="post" id="form_new_recommendation">
			<div>
				<div style="display: inline-block; vertical-align: top;">
					<label>Deadline: </label>
					<div class="caption">
						Enter the deadline for user to accept the event. (YYYY-MM-DD HH:MM:SS)
					</div>
					<input type="text" id="deadline" name="deadline" placeholder="YYYY-MM-DD HH:MM:SS" />
				</div>
			</div>
			<div>
				<div style="display: inline-block; vertical-align: top;">
					<label>Datetime: </label>
					<div class="caption">
						Enter the date for the event. (YYYY-MM-DD HH:MM:SS)
					</div>
					<input type="text" id="event_date" name="event_date" placeholder="YYYY-MM-DD HH:MM:SS" />
				</div>
			</div>
			<div>
				<div style="display: inline-block; vertical-align: top;">
					<label>Location: </label>
					<div class="caption">
						Enter the location name, or address, for the event.
					</div>
					<input type="text" id="event_location_name" name="event_location_name" class="ls-autocomplete-places" placeholder="71 Ayer Rajah Crescent, Singapore 139951." />
				</div>
				<div style="display: inline-block; vertical-align: top;">
					<label>Event Location Id </label>
					<div class="caption">
						(Autocompled field.)
					</div>
					<input type="text" id="event_location" name="event_location" placeholder="Place Id" />
				</div>
			</div>
			<div>
				<div style="display: inline-block; vertical-align: top;">
					<label>Participants.</label>
					<div class="caption">
						Enter the name of the user. Select from the dropdown list.
					</div>
					<input type="text" id="user_name" name="user_name" class="ls-autocomplete-users" placeholder="alias, firstname, lastname" />
				</div>
				<div class="profile-selector-frame placeholder">
					<div class="background">
						Placeholder for selected user profiles.
					</div>
				</div>
			</div>
			<div>
				<label>Reason</label>
				<div class="caption">
					Enter the reason for the meetup.
				</div>
				<div>
					<textarea id="reason" name="reason"></textarea>	
				</div>
				
			</div>
			<input type="submit" />
		</form>
	</div>
</div>

<script>
jQuery(document).ready(function() {
	new Ls_autocomplete();
});

jQuery("#form_new_recommendation").submit(function() {
	//alert('Handler for .submit() called.');
	var str = jQuery("#form_new_recommendation").serialize();
	jQuery.getJSON('/jsonp/events/add/?alt=json&callback=?&'+str, {
	}, function(data){
		console.log(data);
		if (data.results) {
			// On success
			alert("Events entry created.");
			location.reload(true);
		} else {
			// Handle error
			alert("Error! The reason could be: (1) Some information hasn't been filled yet; (2) Some user hasn't confirmed his recommendation yet; (3) Database error.");
		}
	});
  	return false;
});
</script>