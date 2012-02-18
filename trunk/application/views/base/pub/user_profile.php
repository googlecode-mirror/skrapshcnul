<div class="m-content">
	<div class="c-pages shadow-rounded" style="padding:0px;">
		<div id="user-profile" class="m-content-2-col-left-xl dashboard">
			
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
