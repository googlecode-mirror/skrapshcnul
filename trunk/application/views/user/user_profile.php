<div class="m-content">
	<div id="announcements" class="shadow">
		<?php if ($this->session->userdata('linkedin_pulled') == FALSE) { ?>
		<div  id="announcement-linkedin" class="ui-state-highlight ui-corner-all" style="padding: 10px;">
			<div class="close-btn" onclick="$('#announcement-linkedin').toggle('slow')"></div>
			<p>Opps, seems like we have no information about you yet!</p>
			<a href="<?php echo base_url().'user/sync/'; ?>" class="button">Sync your profiles</a>
			<div class="clearfix"></div>
		</div>
		<?php }?>
	</div>
	<div id="ls_cover">
		<div class="cover_background">
			<img src="<?php echo $user_profile['cover_background'];?>" />
		</div>
	</div>
	<div id="ls_profile_card_container">
		<div class="ls_profile_card">
			<div class="profile-img">
				<img src="<?php echo $user_profile['profile_img'];?>" />
			</div>
			<div class="profile-featured-data">
				<div>
					<?php echo $user_profile['name'];?>
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
	</div>
	<div class="clearfix">
		&nbsp;
	</div>
	<div class="m-content-2-col-left">
		<?php $this -> load -> view("user/people_had_lunch_with.php");?>
	</div>
	<div id="user-profile" class="m-content-2-col-right">
		<div>
			<?php $this -> load -> view("user/activities.php");?>
		</div>
		<div class="clearfix">
			&nbsp;
		</div>
	</div>
</div>
