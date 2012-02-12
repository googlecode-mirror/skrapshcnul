<div class="widget-box">
	<div class="widget-box-container" style="border-radius: 3px;background: #DCF7DD;text-align: center;font-size: 90%;">
		
		<div style="margin: 5px 0;">
			<?php if (isset($profile['social_links']['lunchsparks'])) { ?>
				<a href="<?php echo $profile['social_links']['lunchsparks'] ?>"><img src="/skin/images/24/ls_icon_btn_ldpi_24.png" /></a>
			<?php } ?>
			<?php if (isset($profile['social_links']['linkedin'])) { ?>
				<a href="<?php echo $profile['social_links']['linkedin'] ?>"><img src="/skin/images/24/social_linkedin_box_blue.png" /></a>
			<?php } ?>
			<?php if (isset($profile['social_links']['twitter'])) { ?>
				<a href="<?php echo $profile['social_links']['twitter'] ?>"><img src="/skin/images/24/social_twitter_box_blue.png" /></a>
			<?php } ?>
		</div>
		
		<div >
			<a id="add_to_lunch_wishlist" class="add-to-lunch-wishlist-btn" href="javascript:void(0);"  ls:t_uid="<?php echo $target_user_id ?>">Add To Lunch Wishlist</a>
		</div>
	</div>
	<div class="clearfix"></div>
</div>