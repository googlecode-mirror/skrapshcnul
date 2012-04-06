<div class="m-content container">
	
	<?php $this -> load -> view("base/projects/includes/_admin.php");?>
			
	<div id="places-container" class="c-pages" style="padding: 0px;">
		
		<div class="dashboard-activity">
			<div class="dashboard-summary-large">
				<?php $this -> load -> view("base/projects/includes/dashboard.php");?>
				<?php $this -> load -> view("base/projects/includes/statistics.php");?>
			</div>
		</div>
		<div class="clearfix">&nbsp;</div>
		
		<div class="row-fluid">
			<div class="span9">
				<div class="others">
					<?php $this -> load -> view("base/projects/includes/description.php");?>
				</div>
				<div class="others">
					<?php $this -> load -> view("base/projects/includes/screenshots.php");?>
				</div>
				<div class="others">
					<?php $this -> load -> view("base/projects/includes/videos.php");?>
				</div>
				<div class="others">
					<?php $this -> load -> view("base/projects/includes/team_members.php");?>
				</div>
			</div>
			<div class="span3">
				<?php $this -> load -> view("base/projects/sidebar/external_urls.php");?>
				<?php $this -> load -> view("base/projects/sidebar/apps.php");?>
				<?php //$this -> load -> view("base/projects/sidebar/share.php");?>
				<?php $this -> load -> view("base/projects/sidebar/misc.php");?>
			</div>
		</div>
		
		<div class="clearfix">&nbsp;</div>
	</div>
</div>
<div class="clearfix">&nbsp;</div>

