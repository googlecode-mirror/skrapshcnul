<div id="ls_profile_card_container">
<div style="display:none;">
	
	<div class="ls_profile_card_container ls_profile_card_0">
		
		<?php if (isset($profile['profile_img'])) { ?>
			<div class="profile-img">
				<img src="<?php echo $profile['profile_img'];?>" />
			</div>
		<?php } ?>
		<div class="profile-card-featured-data">
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
					Lives in <?php echo $profile['location']['name'];?>
				<?php } ?>
			</div>
			
			<div style="font-size: 80%; font-weight: normal; margin-top: 10px;">
				<?php if(!empty($profile['interests'])) { ?>
				<strong>Interest:</strong> <?php echo ($profile['interests'][0]);?>
				<?php } ?>
			</div>
		</div>
		
	</div>
	
	<div class="ls_profile_card_container ls_profile_card_1">
		<div class="profile_card_data">
			<?php if(!empty($profile['positions'])) { ?>
				<div><strong>Working Experience</strong></div>
				<ul>
				<?php $i = 0; ?>
				<?php foreach($profile['positions'] as $position) { ?>
					<li><?php echo $position['title'] ?> at <?php echo $position['company']['name'] ?></li>
					<?php  if (++$i > 6) { break; }  ?>
				<?php } ?>
				</ul>
			<?php } ?>
			
			<?php /*if(!empty($profile['educations'])) { ?>
			<div><strong>Education</strong></div>
				<?php foreach($profile['educations'] as $education) { ?>
					<ul>
						<li><?php echo $education->{'school-name'} ?> 
							(<?php echo $education->{'start-date'}->{'year'} ?> - 
							<?php echo $education->{'end-date'}->{'year'} ?>)
						</li>
					</ul>
				<?php } ?>
			<?php } */ ?>
		</div>
	</div>
</div>
</div>

<?php //var_dump($profile['educations']); ?>

<div id="ls_profile_card"><!-- card contain here --></div>

<div class="clearfix">&nbsp;</div>

