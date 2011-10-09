<div class="ls_profile_card">
	<div class="profile-img">
		<img src="<?php echo (isset($user_profile['profile_img'])) ? $user_profile['profile_img'] : '';?>" />
	</div>
	<div class="profile-featured-data">
		<div class="profile-name">
			<span><?php echo $user_profile['name'];?></span>
			<div id="profile-stats">
				<?php if(isset($user_status['verified_name'])) { ?>
					<div id="user-verification u-v-verified">
						<div class="user-verification user-verfied"></div>
						<div>Verified</div>
					</div>
				<?php } else { ?>
					<div id="user-verification">
						<div class="user-verification-icon"></div>
						<div class="user-verification-text">Not verified</div>
					</div>
				<?php }?>
			</div>
		</div>
		<div>
			<?php echo $user_profile['position'];?>
			at <?php echo $user_profile['company'];?>
		</div>
		<div>
			Lives in <?php echo $user_profile['country_lives'];?>
		</div>
	</div>
	<div class="clearfix">
		&nbsp;
	</div>
</div>