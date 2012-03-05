<div class="dashboard-stream-box">
	
	<div class="dashboard-stream-box-top">
		<div class="title"> Upcoming Lunches </div>
	</div>
	
	<div class="dashboard-stream-box-middle dashboard-stream-box-container">
		<div class="activity-stream">
			
			<?php //var_dump($events['upcoming']); ?>
			
			<?php if(!empty($events['upcoming'])) { ?>
				<?php foreach($events['upcoming'] as $item) { ?>
				<div class="stream-item">
					<?php //var_dump($item); ?>
					<div class="stream-item-2-col-left">
						<div class="profile-img-thumb profile-img-50">
							<img src="<?php echo $profile['profile_img'];?>" />
						</div>
					</div>
					<div class="stream-item-2-col-right stream-content">
						<div class="stream-content-header"></div>
						<div class="stream-content-middle">
							<span>Scheduled meetup at </span>
							<strong><a href="/places/<?php echo $item['location']['place_id'];?>">
								<?php echo $item['location']['name'];?>
							</a></strong>
							<span class=""> with
								<?php $i = 0; ?> 
								<?php foreach($item['participant'] as $participant) { ?>
									<?php echo ($i++ > 0) ? ', ' : '' ; ?>
									<?php //var_dump($participant);?>
									<a href="<?php echo $participant['rec_id_profile']['ls_pub_url'];?>" class="ls-profile-hover" ls-data-userid="<?php echo $participant['rec_id_profile']['user_id'];?>">
										<?php echo $participant['rec_id_profile']['firstname'];?>
									</a>
								<?php } ?>
							</span>
						</div>
						<div class="stream-content-footer">
							<span> on <?php echo ($item['created_on']);?>.</span>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<?php }?>
			<?php } else { ?>
				<div class="">You have no upcoming lunches.</div>
			<?php }?>
		</div>
	</div>
</div>
<div class="clearfix">&nbsp;</div>
