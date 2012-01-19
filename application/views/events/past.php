<div class="m-content">
	<div class="m-content-2-col-left">
		<?php $this -> load -> view('events/includes/sidetab');?>
	</div>
	<div class="m-content-2-col-right">
		<div class="hr">
			<h2 class="hr-text"><?php echo $head_title; ?></h2>		
		</div>
		<div>
				
			<?php if(!empty($events['past_events'])) { ?>
				
				<div>Yippie! We have a meetup suggestion for you!</div>
				
				<?php foreach($events['past_events'] as $event) { ?>
				<div class="stream-item row-item col-2">
					<div class="clearfix"></div>
					
					<div class="content-table-2-col-left">
						
						<?php //echo $event['event_id'] ?>
						<?php //echo $event['created_on'] ?>
						<?php //echo $event['updated_on'] ?>
						
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
					
					<div class="clearfix"></div>
				</div>
				
				<?php } ?>
				
				
			<?php } else { ?>
				<div class="">You have no past event.</div>
			<?php }?>
		</div>
	</div>
</div>

<script>
jQuery(document).ready(function() {
	jQuery( ".radio_buttonset" ).buttonset();
});
</script>
