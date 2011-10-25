<div class="widget-box">
	<h4 class="widget-title">People I had lunch with (<?php echo sizeof($profile_stats['lunch_buddy_list']);?>)</h4>
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
	<div class="clearfix"></div>
</div>