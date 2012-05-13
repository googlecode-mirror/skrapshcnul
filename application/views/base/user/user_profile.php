<div class="m-content">
	
	<script data-main="/skin/js/main"></script>
	
	
	<div class="container c-pages">
		
		<div class="clearfix">&nbsp;</div>
		
		<div class="row-fluid">
			<div class="span3">
				<?php $this -> load -> view("base/user/profile/profile_summary_small.php");?>
				<?php $this -> load -> view("base/user/profile/social_elements.php");?>
				<?php $this -> load -> view("base/user/profile/my_ratings.php");?>
				<?php //$this -> load -> view("base/user/profile/social_share.php");?>
				<?php //$this -> load -> view("base/user/profile/profile_card.php");?>
				<div class="clearfix">&nbsp;</div>
			</div>
			<div class="span9">
				<div style="padding: 5px;border-left: 1px solid #EFEFEF;">
					<?php $this -> load -> view("base/user/includes/admin.php");?>
					<div class="tabbable">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#tab-overview" data-toggle="tab">Overview</a>
							</li>
							<li>
								<a href="#tab-preferences" data-toggle="tab">Preferences</a>
							</li>
							<li>
								<a href="#tab-projects" data-toggle="tab">Projects</a>
							</li>
							<li>
								<a href="#tab-people" data-toggle="tab">People</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab-overview">
								<?php $this -> load -> view("base/user/profile/profile_summary_large.php");?>
								<?php $this -> load -> view("base/user/profile/upcoming_lunches.php");?>
								<?php //$this -> load -> view("base/user/profile/activities.php");?>
							</div>
							<div class="tab-pane" id="tab-preferences">
								<?php $this -> load -> view("base/user/profile/preferences.php");?>
							</div>
							<div class="tab-pane" id="tab-projects">
								<?php $this -> load -> view("base/user/profile/projects.php");?>
							</div>
							<div class="tab-pane" id="tab-people">
								<?php $this -> load -> view("base/user/profile/people_had_lunch_with.php");?>
								<?php $this -> load -> view("base/user/profile/people_lunch_wishlist.php");?>
								<?php $this -> load -> view("base/user/profile/people_similar.php");?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix">&nbsp;</div>
