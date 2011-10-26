<div class="widget-box">
	<div class="widget-box-title-bar">
		<h4 class="widget-title">People I had lunch with (<?php echo sizeof($profile_stats['lunch_buddy_list']);?>)</h4>
	</div>
	
	<div class="widget-box-container">
		<div>
			<?php if ($profile_stats['lunch_buddy_list']) { ?>
			<?php foreach($profile_stats['lunch_buddy_list'] as $lunch_buddy) { ?>
			<div class="lunch-with profile-img-45">
				<img title="<?php echo $lunch_buddy['name'];?>" src="<?php echo $lunch_buddy['profile_img'];?>">
			</div>
			<?php }?>
			<?php } else { ?>
				<div style="text-align: center;">You have 0 lunch record.</div>
			<?php }?>
		</div>
	</div>
	<div class="clearfix"></div>
</div>