<div id="ProjectScreenshotsModel" class="screenshots">
	<div class="dashboard-stream-box-top">
		<div class="title"> Screenshots </div>
	</div>
	
	<div class="dashboard-stream-box-middle dashboard-stream-box-container">
		<div class="activity-stream">
			<?php if (!is_array($project['screenshots']) && sizeof($project['screenshots']) > 0 ) { ?>
				 <?php foreach ($project['screenshots'] as $screenshot) { ?>
			 	 <div>
			 	 	<img src="<?php echo $screenshot['src'] ?>" style="max-width: 150px;" />
			 	 </div>
				 <?php } ?>
			<?php } else { ?>
				 <div class="content-unavailable">
					No screenshot.
				 </div>
			<?php } ?>
		</div>
	</div>
</div>

<script>
// TODO 
// Update data via JSON call.
var initialData = <?php echo (json_encode($project['screenshots']));?>;

var ProjectScreenshotsModel = function(screenshots) {
    var self = this;
    self.screenshots = ko.observableArray(ko.utils.arrayMap(screenshots, function(screenshot) {
        return { 
        	project_screenshot_id: screenshot.project_screenshot_id, 
        	updated_on: screenshot.updated_on,
        	src: screenshot.src,
        	is_external: screenshot.is_external,
        	screenshot_details: screenshot.screenshot_details,
        	updated_on: screenshot.updated_on
        };
    }));
    self.lastSavedJson = ko.observable("");
};
 
ko.applyBindings(new ProjectScreenshotsModel(initialData), document.getElementById("ProjectScreenshotsModel"));
</script>
