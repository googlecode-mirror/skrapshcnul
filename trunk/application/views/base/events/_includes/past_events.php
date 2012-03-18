<div class="section row-item">
	<div class="section-top">
		Past Events
		<div class="caption">List of your past events.</div>
	</div>
	<div class="section-middle">
		<?php if(!empty($events['past_events'])) { ?>
			<?php foreach($events['past_events'] as $event) { ?>
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
								<div>
									Write a review about your meetup!
								</div>
								<div style="margin: 10px;">
									<a href="/survey/?event_id=<?php echo $event['event_id'] ?>" >
										<span class="btn btn btn-success btn-large">Review</span>
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<?php } ?>
		<?php } else { ?>
			<div class="content-unavailable">You have no past event.</div>
		<?php }?>
	</div>
</div>