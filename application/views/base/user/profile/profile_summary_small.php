<div class="profile-img-container">
	<div class="shadow l"></div>
	<div class="shadow r"></div>
	<div class="profile-img">
		<img src="<?php echo $profile['profile_img'];?>" />
	</div>
</div>
<div class="clearfix"></div>
<div class="profile-name-sidebar">
	<div style="margin-bottom: 10px;">
		<span class="heading"><?php echo $profile['first_name'];?></span>
		<div class="profile-stats">
			<?php if(isset($profile['verification']) && $profile['verification']['status']) { ?>
				<div id="user-verification" class="u-v-verified">
					<div class="user-verification-icon user-verfied"> </div>
					<div class="user-verification-text"> verified </div>
				</div>
			<?php } ?>
		</div>
	</div>
	<div>
		from <strong><a href="http://maps.google.com/maps?q=<?php echo $profile['location']['name'];?>" target="_blank"><?php echo $profile['location']['name'];?></a></strong>
	</div>
</div>
<div class="clearfix">&nbsp;</div>

