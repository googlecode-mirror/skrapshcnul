<div style="background: #F8F8F8; border: 1px solid #CCCCCC; padding: 10px; margin: 10px 0;">
	<div class="title" style="background: #F1F1F1; padding: 10px; cursor: pointer;" onclick="jQuery(this).next().slideToggle('slow');">
		Create new event.
	</div>
	<div style="display:block;">
		<form method="post" id="form_new_recommendation">
			<div>
				<div style="display: inline-block; vertical-align: top;">
					<label>Datetime: </label>
					<div class="caption">
						Enter the date for the event.
					</div>
					<input type="text" id="event_date" name="event_date" placeholder="YYYY-MM-DD HH:MM:SS" />
				</div>
			</div>
			<div>
				<div style="display: inline-block; vertical-align: top;">
					<label>Location: </label>
					<div class="caption">
						Enter the location for the event. (Remember to put in the full address, with postal code.)
					</div>
					<input type="text" id="event_location" name="event_location" placeholder="71 Ayer Rajah Crescent, Singapore 139951." />
				</div>
			</div>
			<div>
				<div style="display: inline-block; vertical-align: top;">
					<label>Participants.</label>
					<div class="caption">
						Enter the name of the user. Select from the dropdown list.
					</div>
					<input type="text" id="user_name" name="user_name" class="ls_user_autocomplete" placeholder="alias, firstname, lastname" />
				</div>
				<div class="profile-selector-frame">
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
	jQuery('.ls_user_autocomplete').each( function() {
		var el = jQuery(this);
		el.autocomplete({
			source: function( request, response ) {
				var keywords = el.val();
				jQuery.getJSON("/jsonp/autocomplete/name?callback=?",
				{ 
					keywords: keywords,
				}, function(data) {
					//console.log(data);
					response( jQuery.map( data.results, function( item ) {
						return {
							label: item.firstname + (item.lastname ? ", " + item.lastname : ""),
							value: item.firstname + (item.lastname ? ", " + item.lastname : ""),
							user_id: item.user_id,
							profile_img: item.profile_img,
							ls_pub_url : item.lunchsparks,
							firstname : item.firstname
						}
					}));
				});
			},
			minLength: 2,
			select: function( event, ui ) {
				console.log( ui.item ?
					"Selected: " + ui.item.label :
					"Nothing selected, input was " + this.value);
				//el.next().val(ui.item.user_id);
				//el.parent().next().children(":first").attr('ls-data-userid', ui.item.user_id);
				el.parent().next().append(
					'<div class="container ls-profile-hover" ls-data-userid="'+ui.item.user_id+'">'+
						'<div class="profile-img-45 hover-profile-card inset-image" ls:uid="'+ui.item.user_id+'">'+
							'<a href="'+ui.item.ls_pub_url+'">'+
								'<img title="'+ui.item.firstname+'" src="'+ui.item.profile_img+'">'+
							'</a>'+
						'</div>'+
					'</div>'+
					'<input type="hidden" name="user_ids[]" value="'+ui.item.user_id+'" />' 
				).each(function(){
					profile_hover_init();
				});
			},
			open: function() {
				jQuery( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
			},
			close: function() {
				jQuery( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
				jQuery(this).val('');
			}
		});
	});
});

</script>

<script>
jQuery("#form_new_recommendation").submit(function() {
	alert('Handler for .submit() called.');
	var str = jQuery("#form_new_recommendation").serialize();
	jQuery.getJSON('/jsonp/events/add/?alt=json&callback=?&'+str, {
	}, function(data){
		console.log(data);
		if (data.results) {
			
		} else {
			// Handle error
		}
	});
  	return false;
});
</script>