<div class="dashboard-stream-box">
	<span class="title">
		<span class="user-icon-set u-i-s-dashboard-widget-icon"></span>
		Upcoming Lunches
	</span>
	<div class="dashboard-stream-box-container">
		<div class="activity-stream">
			<?php if(!empty($profile_stats['upcoming_lunches'])) { ?>
				<?php foreach($profile_stats['upcoming_lunches'] as $item) { ?>
				<div class="stream-item">
					<div class="stream-item-2-col-left">
						<div class="profile-img-thumb profile-img-50">
							<img src="<?php echo $user_profile['profile_img'];?>" />
						</div>
					</div>
					<div class="stream-item-2-col-right">
						<div class="stream-content">
							<?php echo $item['message'];?>
						</div>
						<div class="stream-content-footer">
							<?php echo unix_to_human($item['created_on']);?>
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