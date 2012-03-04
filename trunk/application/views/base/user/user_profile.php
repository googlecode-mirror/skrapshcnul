<div class="m-content">
	<div id="announcements" class="shadow" style="border-radius: 3px;">
		<?php /*if (1 || $this->session->userdata('linkedin_pulled') == FALSE) { ?>
		<div  id="announcement-linkedin" class="ui-state-highlight ui-corner-all" style="padding: 10px; margin: 15px 0px;">
			<div class="close-btn" onclick="$('#announcement-linkedin').toggle('slow')"></div>
			<p>Opps, seems like we have no information about you yet!</p>
			<a href="<?php echo base_url().'synchronize/'; ?>" class="button" style="padding: 5px 10px;">Sync your profiles</a>
			<div class="clearfix"></div>
		</div>
		<?php } */?>
	</div>
	
	<div class="c-pages" style="padding:0px;">
		<div id="user-profile" class="m-content-2-col-left-xl dashboard">
			
			<?php /*<div id="ls_cover">
				<div class="cover_background">
					<img src="<?php echo $profile['cover_background']; ?>" />
				</div>
			</div> */ ?>
			
			<div id="ls_social_share_container">
				<?php //$this -> load -> view("base/user/profile/social_share.php");?>
			</div>
			
			<?php //$this -> load -> view("base/user/profile/profile_card.php");?>
			<?php $this -> load -> view("base/user/profile/profile_summary_large.php");?>
			
			<?php $this -> load -> view("base/user/profile/preferences.php");?>
			
			<div class="clearfix">&nbsp;</div>
			
			<div id="tabs" class="activity-stream">
				<?php $this -> load -> view("base/user/profile/upcoming_lunches.php");?>
				<?php //$this -> load -> view("base/user/profile/activities.php");?>
			</div>
			<div class="clearfix">&nbsp;</div>
			
		</div>
		
		
		<div class="m-content-2-col-right-xs">
			<?php $this -> load -> view("base/user/profile/social_elements.php");?>
			<?php $this -> load -> view("base/user/profile/my_ratings.php");?>
			<?php $this -> load -> view("base/user/profile/people_had_lunch_with.php");?>
			<?php $this -> load -> view("base/user/profile/lunch_wishlist.php");?>
			<?php $this -> load -> view("base/user/profile/similar_people.php");?>
			<div class="clearfix">&nbsp;<br /></div>
			
		</div>
	</div>
	
</div>
<div class="clearfix"></div>
