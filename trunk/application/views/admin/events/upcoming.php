<h2>Upcoming Events</h2>
<div>
	Total records: <?php echo isset($results['events_upcoming_count']) ? $results['events_upcoming_count'] : 0;?>
</div>
<div>
	<?php if (!empty($results['events_upcoming'])) { ?>
		
		<?php foreach($results['events_upcoming'] as $event) { ?>
			<div class="stream-item row-item col-2">
				<div class="clearfix"></div>
				
				<div class="content-table-2-col-right" style="padding: 10px 0;">
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
						<?php foreach($event['participants'] as $user) { ?>
						<a href="<?php echo $user['user_profile']['ls_pub_url']; ?>"  class="ls-profile-hover" ls-data-userid="<?php echo $user['user_profile']['user_id'] ?>">
							<div class="lunch-with profile-img-45 inset-image ">
								<img title="<?php echo $user['user_profile']['firstname']; ?>" src="<?php echo $user['user_profile']['profile_img']; ?>">
							</div>
						</a>
						<?php } ?>
						
					</div>
					<div class="clearfix"></div>
					
				</div>
				
				<div class="clearfix"></div>
			</div>
			
		<?php }?>

	<?php } else {?>
	<div class="">
		No records found.
	</div>
	<?php }?>
</div>
