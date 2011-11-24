<div class="m-content">
	<div id="announcements" class="shadow">
	</div>
	
	<div id="user-profile" class="m-content-2-col-left-xl dashboard">
		
		<div id="ls_cover">
			<div class="cover_background">
				<img src="<?php echo $profile['cover_background']; ?>" />
			</div>
		</div>
		<div id="ls_social_share_container">
			<?php $this -> load -> view("pub/profile/social_share.php");?>
		</div>
		<div id="ls_profile_card_container">
			<?php $this -> load -> view("user/profile/profile_card.php");?>
		</div>
		<div class="clearfix">&nbsp;</div>
		
		<div id="tabs" class="dashboard-activity" style="border: 1px solid #EFEFEF;">
			<ul>
				<li><a href="#tabs-1">Activites</a></li>
				<li><a href="#tabs-2">Preferences</a></li>
			</ul>
			
			<div id="tabs-1">
				<?php $this -> load -> view("user/profile/upcoming_lunches.php");?>
				<?php $this -> load -> view("user/profile/activities.php");?>
			</div>
			<div id="tabs-2">
				<?php $this -> load -> view("user/profile/preferences.php");?>
			</div>
			<script>
			jQuery(function() {
				jQuery( "#tabs" ).tabs();
			});
			</script>
		</div>
		<div class="clearfix">&nbsp;</div>
	</div>
	
	
	<div class="m-content-2-col-right-xs">
		<?php $this -> load -> view("user/profile/social_elements.php");?>
		<?php $this -> load -> view("pub/profile/my_ratings.php");?>
		<?php $this -> load -> view("pub/profile/lunch_wishlist.php");?>
		<?php $this -> load -> view("pub/profile/people_had_lunch_with.php");?>
		<div class="clearfix">&nbsp;<br /></div>
		
	</div>
	
</div>
<div class="clearfix"></div>
