<div class="section row-item">
	<div class="section-top">
		Event Requests
		<div class="caption">Yippie! We have a meetup suggestion for you!</div>
	</div>
	<div class="section-middle">
		<?php if(!empty($events['suggestions'])) { ?>
			<?php foreach($events['suggestions'] as $event) { ?>
			<div class="stream-item row-item col-2">
				<div class="content-table-2-col-left">
					<div class="g-static-maps">
						<?php /* <img src="{{getGStaticMapAddress(<?php echo $event['location'] ?>);}}" /> */ ?>
						<img src ="" ls-location="<?php echo urlencode($event['location']['location']); ?>" ls-latlong="<?php echo $event['location']['geo_lat'].','.$event['location']['geo_long'] ?>" />
					</div>
				</div>
				
				<div class="content-table-2-col-right">
					<div class="column-2-left-xl">
						<div>
							<span class="label">Date: </span> <span><?php echo $event['date'] ?></span>
						</div>
						<div>
							<span class="label">Location: </span> 
							<span>
								<a href="/places/<?php echo  $event['location']['place_id']; ?>" target="_blank">
									<?php echo  $event['location']['name']; ?>
								</a>
							</span>
						</div>
						
						<div>
							<span class="label">Suggested users for this meetup: </span>
						</div>
						<div>
							<?php foreach($event['participant'] as $user) { ?>
							<a href="<?php echo $user['rec_id_profile']['ls_pub_url']; ?>"  class="ls-profile-hover" ls-data-userid="<?php echo $user['rec_id_profile']['user_id'] ?>">
								<div class="lunch-with profile-img-45 inset-image ">
									<img title="<?php echo $user['rec_id_profile']['firstname']; ?>" src="<?php echo $user['rec_id_profile']['profile_img']; ?>">
								</div>
							</a>
							<?php } ?>
							
						</div>
						<div class="clearfix"></div>
						
					</div>
					
					<div class="column-2-right-xs" style="text-align: center;">
					
					<?php if($event['event_status'] != -1) { ?>
						<?php ## If not accepted, then show radio buttons */ ?>
						<?php if ($event['current_user']['rsvp'] == 1) { ?>
							
							You have accepted this event suggestion.
							
						<?php } elseif ($event['current_user']['rsvp'] == -1) { ?>
							
							You have rejected this event suggestion. 
							
						<?php } else { ?>
							<div>RSVP?</div>
							<div style="padding: 20px 5px;" class="radio_buttonset">
								<input type="radio" id="event_recommendation_radio<?php echo $event['current_user']['user_id'] ?>_1" name="event_recommendation_radio<?php echo $event['current_user']['user_id'] ?>_1" ls-user_id="<?php echo $event['current_user']['user_id'] ?>" ls-event_id="<?php echo $event['event_id'] ?>" onclick="event_recommendation_rsvp_confirm(this);" />
								<label for="event_recommendation_radio<?php echo $event['current_user']['user_id'] ?>_1">Yes</label>
								<input type="radio" id="event_recommendation_radio<?php echo $event['current_user']['user_id'] ?>_0" name="event_recommendation_radio<?php echo $event['current_user']['user_id'] ?>_0" ls-user_id="<?php echo $event['current_user']['user_id'] ?>" ls-event_id="<?php echo $event['event_id'] ?>" onclick="event_recommendation_rsvp_reject(this);" />
								<label for="event_recommendation_radio<?php echo $event['current_user']['user_id'] ?>_0">No</label>
							</div>
						<?php } ?>
					<?php } else { ?>
						This event has been cancelled.
					<?php } ?>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			
			<?php }?>
			
		<?php } else { ?>
			<div class="content-unavailable">You have no upcoming event.</div>
		<?php }?>
	</div>
</div>