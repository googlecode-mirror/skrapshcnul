<div class="ls_profile_card">
	<?php
	if (isset($profile['profile_img'])) {
		$image_size= getimagesize($profile['profile_img']);
		$margin_left = (160 - $image_size[0])/2; 
		$margin_top = (180 - $image_size[1])/2; ?>
		<div class="profile-img">
			<img src="<?php echo $profile['profile_img'];?>" 
				style="margin-left: <?php echo $margin_left ?>px;margin-top: <?php echo $margin_top ?>px;" />
		</div>
	<?php } ?>
	<div class="profile-featured-data">
		<div class="profile-name">
			<span><?php echo $profile['first_name'];?>,<?php echo $profile['last_name'];?></span>
			<div id="profile-stats">
				<?php if(isset($user_status['verified_name'])) { ?>
					<div id="user-verification u-v-verified">
						<div class="user-verification user-verfied"></div>
						<div>Verified</div>
					</div>
				<?php } else { ?>
					<?php /* <div id="user-verification">
						<div class="user-verification-icon"></div>
						<div class="user-verification-text">Not verified</div>
					</div> */ ?>
				<?php }?>
			</div>
		</div>
		<div>
			<?php echo $profile['headline'];?>
		</div>
		<div>
			<?php if(!empty($profile['location'])) { ?>
				Lives in <?php echo $profile['location']->name;?>
			<?php } ?>
		</div>
	</div>
	<div class="clearfix">
		&nbsp;
	</div>
</div>