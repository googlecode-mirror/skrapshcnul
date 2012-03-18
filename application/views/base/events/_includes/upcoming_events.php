<div class="section row-item">
	<div class="section-top">
		Upcoming Events
		<div class="caption">Scheduled events for you!</div>
	</div>
	<div class="section-middle">
		<?php if(!empty($events['upcoming'])) { ?>
			<?php foreach($events['upcoming'] as $event) { ?>
				<div class="row-fluid">
					<div class="span3" style="text-align: center;">
						<div class="g-static-maps">
							<?php /* <img src="{{getGStaticMapAddress(<?php echo $event['location'] ?>);}}" /> */ ?>
							<img src ="" ls-location="<?php echo urlencode($event['location']['location']); ?>" ls-latlong="<?php echo $event['location']['geo_lat'].','.$event['location']['geo_long'] ?>" />
						</div>
					</div>
					
					<div class="span9">
						<div class="row-fluid">
							<div class="span7">
								<div class="row-fluid">
									<div class="span2"><span>Date </span></div>
									<div class="span9"><span><?php echo date_format(date_create($event['date']), 'l jS F Y \o\n g:ia '); ?></span></div>
								</div>
								<div class="row-fluid">
									<div class="span2"><span>Location </span></div>
									<div class="span9">
										<a href="/places/<?php echo  $event['location']['place_id']; ?>" target="_blank">
											<?php echo  $event['location']['name']; ?>
										</a>
									</div>
								</div>
								<div class="row-fluid">
									<div>
										<span>Suggested users for this meetup: </span>
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
								</div>
								<div class="clearfix"></div>
							</div>
							
							<div class="span5">
								<?php if($event['event_status'] != -1) { ?>
									<h3>RSVP</h3>
									<?php ## If not accepted, then show radio buttons */ ?>
									<?php if ($event['current_user']['rsvp'] == 1) { ?>
										
										You have accepted this event suggestion.
										
									<?php } elseif ($event['current_user']['rsvp'] == -1) { ?>
										
										You have rejected this event suggestion. 
										
									<?php } else { ?>
										<div style="padding: 10px 5px;" class="radio_buttonset">
											<label class="radio">
												<input type="radio" id="event_recommendation_radio_<?php echo $event['event_id'] ?>_1" name="event_recommendation_radio<?php echo $event['current_user']['user_id'] ?>_1" ls-user_id="<?php echo $event['current_user']['user_id'] ?>" ls-event_id="<?php echo $event['event_id'] ?>" onclick="event_recommendation_rsvp_confirm(this);" />
												Yes, I'm will attend this meetup.
											</label>
											<label class="radio">
												<input type="radio" id="event_recommendation_radio_<?php echo $event['event_id'] ?>_0" name="event_recommendation_radio<?php echo $event['current_user']['user_id'] ?>_0" ls-user_id="<?php echo $event['current_user']['user_id'] ?>" ls-event_id="<?php echo $event['event_id'] ?>" onclick="event_recommendation_rsvp_reject(this);" />
												No, I'm not attending this meetup.
											</label>
										</div>
									<?php } ?>
								<?php } else { ?>
									This event has been cancelled.
								<?php } ?>
							</div>
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