<div class="section row-item">
	<div class="section-top">
		Upcoming Events
		<div class="caption">Scheduled events for you!</div>
	</div>
	<div class="section-middle">
		<?php if(!empty($events['upcoming'])) { ?>
			<?php foreach($events['upcoming'] as $event) { ?>
			<div class="stream-item row-item col-2">
				<div class="content-table-2-col-left">
					<div class="g-static-maps">
						<?php /* <img src="{{getGStaticMapAddress(<?php echo $event['location'] ?>);}}" /> */ ?>
						<?php 
						$googleMapImg = 'http://maps.googleapis.com/maps/api/staticmap?center=';
						$googleMapImg .= urlencode( $event['location']['name'] );
						$googleMapImg .= '&zoom=14&size=190x140&sensor=false'; ?>
						<img src ="<?php echo $googleMapImg; ?>" />
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
								<a href="http://maps.google.com/maps/place?q=<?php echo  $event['location']['name'] . ", " . $event['location']['location'] ?>" target="_blank">
									<?php echo  $event['location']['name'] . ", " . $event['location']['location'] ?>
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
					
					<?php //var_dump($event) ?>
					<div class="column-2-right-xs" style="text-align: center;">
						
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