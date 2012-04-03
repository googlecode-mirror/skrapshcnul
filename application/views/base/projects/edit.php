<div class="m-content container">
	<div id="places-container" class="c-pages" style="padding: 10px;">
		
		<a href="/projects/<?php echo $project['project_id'] ?>" class="btn"><i class="icon-arrow-left"></i> Back</a>
		<div class="clearfix">&nbsp;</div>
		
		<ul id="nav-project-update" class="nav nav-tabs">
			<li>
				<a href="#basic-info" data-toggle="tab">Basic Information</a>
			</li>
			<li>
				<a href="#tags" data-toggle="tab">Tags</a>
			</li>
			<?php if(isset($is_logged_in_admin) && $is_logged_in_admin == TRUE) { ?>
			<li>
				<a href="#members" data-toggle="tab">Members</a>
			</li>
			<li>
				<a href="#verification" data-toggle="tab">Verification Status</a>
			</li>
			<?php } ?>
		</ul>
		
		<form name="update-project" class="form-horizontal">
			
			<input name="project_id" type="hidden" value="<?php echo $project['project_id']; ?>" />
			
			<div class="tab-content">
				<div class="tab-pane active" id="basic-info">
					<?php $this -> load -> view("base/projects/edit/project_information.php");?>
				</div>
				<div class="tab-pane" id="tags">
					<?php $this -> load -> view("base/projects/edit/tags.php");?>
				</div>
				<div class="tab-pane" id="members">
					<?php $this -> load -> view("base/projects/edit/team_members.php");?>
				</div>
				<?php if(isset($is_logged_in_admin) && $is_logged_in_admin == TRUE) { ?>
				<div class="tab-pane" id="verification">
					<?php $this -> load -> view("base/projects/edit/verification_status.php");?>
				</div>
				<?php } ?>
			</div>
			
			<div class="clearfix">&nbsp;</div>
			
			<div class="form-actions">
				<button type="submit" class="btn btn-primary btn-large">
					Save changes
				</button>
				<a href="/projects/<?php echo $project['project_id'] ?>" class="btn btn-small">Back</a>
			</div>
			
			<div class="clearfix">&nbsp;</div>
		</form>
		
	</div>
</div>
<script>
jQuery(function() {
	project_edit_init();
});

function project_edit_init() {
	
	jQuery('#nav-project-update a:first').tab('show');
	
	jQuery('form[name=update-project]').submit(function(){
		// TODO form validation
		try {
			var form_data = jQuery(this).serialize();
			
			jQuery.getJSON('/jsonp/projects/update/?alt=json&callback=?', form_data, function(data){
				if (data.results) {
					alert('Changes Saved.');
					window.location.reload();
				}
			});
			
		} catch(e) {
			if(window.console) console.warn(e);
		}
		return false;
	});
}

</script>
<div class="clearfix">&nbsp;</div>
