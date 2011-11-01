<div class="widget-box">
	<div class="widget-box-title-bar">
		<h4 class="widget-title">People I had lunch with  (<?php echo ($profile_stats['lunch_buddy_list']) ? sizeof($profile_stats['lunch_buddy_list']) : '0'; ?>)</h4>
	</div>
	<div class="widget-box-container">
		<div id="user-lunch-buddy-list">
			<?php if ($profile_stats['lunch_buddy_list']) { ?>
			<?php foreach($profile_stats['lunch_buddy_list'] as $lunch_buddy) { ?>
			<div class="lunch-buddy-item">
				<a href="/pub/<?php echo !empty($lunch_buddy->alias) ? $lunch_buddy->alias : $lunch_buddy->target_user_id;?>">
					<div class="lunch-with profile-img-45">
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
	<div class="clearfix"></div>
</div>