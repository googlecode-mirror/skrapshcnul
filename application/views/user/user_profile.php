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
	
	<div id="user-profile" class="m-content-2-col-left-xl dashboard">
		
		<div id="ls_cover">
			<div class="cover_background">
				<img src="<?php echo $profile['cover_background']; ?>" />
			</div>
		</div>
		<div id="ls_social_share_container">
			<?php $this -> load -> view("user/profile/social_share.php");?>
		</div>
		<div id="ls_profile_card_container">
			<?php $this -> load -> view("user/profile/profile_card.php");?>
		</div>
		<div class="clearfix">&nbsp;</div>
		
		<div class="dashboard-activity">
			<?php $this -> load -> view("user/profile/upcoming_lunches.php");?>
			<?php $this -> load -> view("user/profile/activities.php");?>
		</div>
		<div class="clearfix">&nbsp;</div>
		
	</div>
	
	
	<div class="m-content-2-col-right-xs">
		<?php $this -> load -> view("user/profile/social_elements.php");?>
		<?php $this -> load -> view("user/profile/my_ratings.php");?>
		<?php $this -> load -> view("user/profile/people_had_lunch_with.php");?>
		<?php $this -> load -> view("user/profile/lunch_wishlist.php");?>
		<div class="clearfix">&nbsp;<br /></div>
		
	</div>
	
</div>
<div class="clearfix"></div>
