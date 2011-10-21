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
			<img src="<?php echo $profile['cover_background']; ?>" />
		</div>
	</div>
	<div id="ls_profile_card_container">
		<?php $this -> load -> view("user/profile/profile_card.php");?>
	</div>
	<div class="clearfix">
		&nbsp;
	</div>
	<div class="m-content-2-col-left">
		<?php $this -> load -> view("user/profile/my_ratings.php");?>
		<?php $this -> load -> view("user/profile/people_had_lunch_with.php");?>
	</div>
	<div id="user-profile" class="m-content-2-col-right">
		<div>
			<?php $this -> load -> view("user/profile/upcoming_lunches.php");?>
		</div>
		<div>
			<?php $this -> load -> view("user/profile/activities.php");?>
		</div>
		<div class="clearfix">
			&nbsp;
		</div>
	</div>
</div>
<div class="clearfix"></div>
