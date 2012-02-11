<div class="m-content">
	<div class="c-pages shadow-rounded">
		<h2><?php echo $tpl_page_title; ?></h2>
		<h3 class="sub-heading">Events listed below requires your attention.</h3>
		
		<div class="section row-item">
			<div class="section-top">
				Suggestions
				<div class="caption">Hi there! We have a few suggestion here for your next meetup!</div>
			</div>
			<div class="section-middle">
				<?php if(!empty($events['auto_recommendation'])) { ?>
					<?php foreach($events['auto_recommendation'] as $item) { ?>
					<div class="stream-item row-item">
						<div class="clearfix"></div>
						<div style="display: inline-block; vertical-align: middle;">
							<a href="<?php echo $item['rec_id_profile']['ls_pub_url']; ?>"  class="ls-profile-hover" ls-data-userid="<?php echo $item['rec_id_profile']['user_id'] ?>">
								<div class="lunch-with inset-image profile-img-80">
									<img title="<?php echo $item['rec_id_profile']['firstname']; ?>" src="<?php echo $item['rec_id_profile']['profile_img']; ?>">
								</div>
							</a>
						</div>
						<div style="display: inline-block;">
							<div style="padding: 20px;" class="radio_buttonset">
								<input type="radio" id="radio<?php echo $item['index'] ?>_1" name="radio<?php echo $item['index'] ?>" <?php echo $item['selected'] ? 'checked="checked"' : ''; ?> ls-oid="<?php echo $item['index'] ?>" onclick="user_recommendation_confirm(this);" />
								<label for="radio<?php echo $item['index'] ?>_1">Yes</label>
								<input type="radio" id="radio<?php echo $item['index'] ?>_0" name="radio<?php echo $item['index'] ?>" <?php echo !$item['selected'] ? 'checked="checked"' : ''; ?> ls-oid="<?php echo $item['index'] ?>" onclick="user_recommendation_reject(this);" />
								<label for="radio<?php echo $item['index'] ?>_0">No</label>
							</div>
						</div>
						
						<div class="clearfix"></div>
					</div>
					<?php }?>
				<?php } else { ?>
					<div class="content-unavailable">You have no recommendation.</div>
				<?php }?>
			</div>
		</div>
		
		<div class="clearfix">&nbsp;</div>
		
		<div class="section row-item">
			<div class="section-top">
				Upcoming Events
				<div class="caption">Yippie! We have a meetup suggestion for you!</div>
			</div>
			<div class="section-middle">
				<?php if(!empty($events['suggestions'])) { ?>
					<?php foreach($events['suggestions'] as $event) { ?>
					<div class="stream-item row-item col-2">
						<div class="content-table-2-col-left">
							<div class="g-static-maps">
								<?php /* <img src="{{getGStaticMapAddress(<?php echo $event['location'] ?>);}}" /> */ ?>
								<?php 
								$googleMapImg = 'http://maps.googleapis.com/maps/api/staticmap?center=';
								$googleMapImg .= urlencode($event['location']);
								$googleMapImg .= '&zoom=14&size=190x140&sensor=false'; ?>
								<img src ="<?php echo $googleMapImg; ?>" />
							</div>
						</div>
						
						<div class="content-table-2-col-right">
							<div class="column-2-left">
								<div>
									<span class="label">Date: </span> <span><?php echo $event['date'] ?></span>
								</div>
								<div>
									<span class="label">Location: </span> 
									<span>
										<a href="http://maps.google.com/maps/place?q=<?php echo $event['location'] ?>" target="_blank">
											<?php echo $event['location'] ?>
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
							<div class="column-2-right" style="text-align: center;">
								
								<?php ## If not accepted, then show radio buttons */ ?>
								<?php if ($event['current_user']['rsvp'] == 1) { ?>
									
									You have accepted this event suggestion.
									
								<?php } elseif ($event['current_user']['rsvp'] == -1) { ?>
									
									You have rejected this event suggestion. 
									
								<?php } else { ?>
									<div>RSVP?</div>
									<div style="padding: 20px;" class="radio_buttonset">
										<input type="radio" id="radio<?php echo $event['current_user']['id'] ?>_1" name="radio<?php echo $event['current_user']['id'] ?>" ls-oid="<?php echo $event['current_user']['id'] ?>" onclick="user_recommendation_rsvp_confirm(this);" />
										<label for="radio<?php echo $event['current_user']['id'] ?>_1">Yes</label>
										<input type="radio" id="radio<?php echo $event['current_user']['id'] ?>_0" name="radio<?php echo $event['current_user']['id'] ?>" ls-oid="<?php echo $event['current_user']['id'] ?>" onclick="user_recommendation_rsvp_reject(this);" />
										<label for="radio<?php echo $event['current_user']['id'] ?>_0">No</label>
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
		
		<div class="clearfix">&nbsp;</div>
		
		<div class="section row-item">
			<div class="section-top">
				Past Events
				<div class="caption">List of your past events.</div>
			</div>
			<div class="section-middle">
				<?php if(!empty($events['past_events'])) { ?>
					<?php foreach($events['past_events'] as $event) { ?>
					<div class="stream-item row-item col-2">
						
						<div class="content-table-2-col-left">
							<div class="g-static-maps">
								<?php /* <img src="{{getGStaticMapAddress(<?php echo $event['location'] ?>);}}" /> */ ?>
								<?php 
								$googleMapImg = 'http://maps.googleapis.com/maps/api/staticmap?center=';
								$googleMapImg .= urlencode($event['location']);
								$googleMapImg .= '&zoom=14&size=190x140&sensor=false'; ?>
								<img src ="<?php echo $googleMapImg; ?>" />
							</div>
						</div>
						<div class="content-table-2-col-right" style="padding: 10px 0;">
							<div class="column-2-left">
								<div>
									<span class="title">Date: </span> <span><?php echo $event['date'] ?></span>
								</div>
								<div>
									<span class="title">Location: </span> 
									<span>
										<a href="http://maps.google.com/maps/place?q=<?php echo $event['location'] ?>" target="_blank">
											<?php echo $event['location'] ?>
										</a>
									</span>
								</div>
								<div>
									<span class="label">Suggested users for this meetup: </span>
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
							</div>
							
							<div class="column-2-right" style="text-align: center;">
								<div>
									Write a review about your meetup!
								</div>
								<div style="margin: 10px;">
									<a href="/survey/<?php echo $event['id'] ?>" >
										<span class="button">Review</span>
									</a>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</div>
					<?php } ?>
				<?php } else { ?>
					<div class="content-unavailable">You have no past event.</div>
				<?php }?>
			</div>
		</div>
	</div>
	<div class="clearfix">&nbsp;</div>
</div>

<script>
jQuery(document).ready(function() {
	jQuery( ".radio_buttonset" ).buttonset();
});
</script>
