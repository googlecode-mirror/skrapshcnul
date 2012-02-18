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
						$googleMapImg .= urlencode( $event['location']['name'] );
						$googleMapImg .= '&zoom=14&size=190x140&sensor=false'; ?>
						<img src ="<?php echo $googleMapImg; ?>" />
					</div>
				</div>
				<div class="content-table-2-col-right" style="padding: 10px 0;">
					<div class="column-2-left-xl">
						<div>
							<span class="title">Date: </span> <span><?php echo $event['date'] ?></span>
						</div>
						<div>
							<span class="title">Location: </span> 
							<span>
								<a href="http://maps.google.com/maps/place?q=<?php echo  $event['location']['name'] . ", " . $event['location']['location'] ?>" target="_blank">
									<?php echo  $event['location']['name'] . ", " . $event['location']['location'] ?>
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
					
					<div class="column-2-right-xs" style="text-align: center;">
						<div>
							Write a review about your meetup!
						</div>
						<div style="margin: 10px;">
							<a href="/survey/?event_id=<?php echo $event['event_id'] ?>" >
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