<div class="dashboard-stream-box well-container">
	
	<h3 class="dashboard-stream-box-top">
		People I had lunch with  (<?php echo ($profile_stats['lunch_buddy_list']) ? sizeof($profile_stats['lunch_buddy_list']) : '0'; ?>)
	</h3>
	
	<div class="dashboard-stream-box-middle dashboard-stream-box-container">
		<div class="activity-stream">
			<div id="user-lunch-buddy-list">
				<?php if ($profile_stats['lunch_buddy_list']) { ?>
				<?php foreach($profile_stats['lunch_buddy_list'] as $lunch_buddy) { ?>
				<div class="lunch-buddy-item">
					<a href="/pub/<?php echo !empty($lunch_buddy->alias) ? $lunch_buddy->alias : $lunch_buddy->target_user_id;?>">
						<div class="lunch-with profile-img-45 ls-profile-hover inset-image" ls-data-userid="<?php echo $lunch_buddy->target_user_id; ?>">
							<img title="<?php echo $lunch_buddy->firstname;?>" src="<?php echo ($lunch_buddy->profile_img) ? $lunch_buddy->profile_img :  '/skin/images/160/silhouette_male.jpg'; ?>">
						</div>
					</a>
				</div>
				<?php }?>
				<?php } else { ?>
					<div style="text-align: center;">You have 0 lunch record.</div>
				<?php }?>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>

<div class="clearfix">&nbsp;</div>
