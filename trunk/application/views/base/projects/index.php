<div class="m-content">
	<?php if ($has_edit_permission == TRUE) { ?>
		<div class="edit-this-page">
			<a href="/projects/edit/<?php echo $project['project_id']; ?>" class="button">Edit This Page</a>
		</div>
	<?php } ?>
	
	<div id="places-container" class="c-pages" style="padding: 0px;">
		
		<div class="dashboard-activity">
			<div class="dashboard-summary-large">
				<?php $this -> load -> view("base/projects/includes/dashboard.php");?>
				<?php $this -> load -> view("base/projects/includes/statistics.php");?>
			</div>
		</div>
		
		<div class="m-content-2-col-left-xl">
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
		
		<div class="m-content-2-col-right-xs">
			<?php $this -> load -> view("base/projects/sidebar/external_urls.php");?>
			<?php $this -> load -> view("base/projects/sidebar/apps.php");?>
			<?php $this -> load -> view("base/projects/sidebar/share.php");?>
			<?php $this -> load -> view("base/projects/sidebar/misc.php");?>
		</div>
		
		<?php //var_dump($project) ?>
		
		<div class="clearfix">&nbsp;</div>
	</div>
</div>
<div class="clearfix">&nbsp;</div>

