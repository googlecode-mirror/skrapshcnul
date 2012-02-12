<div id="profile-summary-large">
	<div class="profile-summary-large">
		
		<?php if (isset($profile['profile_img'])) { ?>
			<div class="profile-img">
				<img src="<?php echo $profile['profile_img'];?>" />
			</div>
		<?php } ?>
		<div class="profile-featured-data">
			<div class="profile-name">
				<span><?php echo $profile['first_name'];?>,<?php echo $profile['last_name'];?></span>
				<div id="profile-stats">
					<?php if(isset($profile['verification']) && $profile['verification']['status']) { ?>
						<div id="user-verification" class="u-v-verified">
							<div class="user-verification-icon user-verfied"> </div>
							<div class="user-verification-text"> verified </div>
						</div>
					<?php } else { ?>
						<?php /* <div id="user-verification">
							<div class="user-verification-icon"></div>
							<div class="user-verification-text"> not verified </div>
						</div> */ ?>
					<?php }?>
				</div>
			</div>
			<div class="headline">
				<?php echo $profile['headline'];?>
			</div>
			
			<div class="others">
				<?php if(!empty($profile['location'])) { ?>
					Lives in <strong><a href="http://maps.google.com/maps?q=<?php echo $profile['location']['name'];?>" target="_blank"><?php echo $profile['location']['name'];?></a></strong>
				<?php } ?>
			</div>
			
			<?php /*<div class="others">
				<?php if(!empty($profile['interests'])) { ?>
				Interest in <strong><?php echo ($profile['interests'][0]);?></strong>
				<?php } ?>
			</div> */ ?>
		</div>
	</div>
	
</div>
<div class="clearfix">&nbsp;</div>

