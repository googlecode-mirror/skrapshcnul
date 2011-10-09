<div class="widget-box">
	<h4>Activities</h4>
	<div class="activity-stream">
		<?php foreach($activity_list as $item) {
		?>
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
	</div>
</div>
<div class="clearfix"></div>